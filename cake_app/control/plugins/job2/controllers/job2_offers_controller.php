<?php
/**
 * ==============================================
 * CakePHP Core Components
 * ==============================================
 * @property AuthComponent $Auth
 * @property AclComponent $Acl
 * @property CookieComponent $Cookie
 * @property EmailComponent $Email
 * @property RequestHandlerComponent $RequestHandler

 * @property SessionComponent $Session
 *
 * ==============================================
 * Other Components
 * ==============================================
 * @property MySecurityComponent $MySecurity
 * @property obAuthComponent $obAuth
 * @property ImgUpComponent $ImgUp
 *
 * ==============================================
 * Models
 * ==============================================
 * @property Job2Offer $Job2Offer
 *
 */
class Job2OffersController extends Job2AppController
{
	var $name = "Job2Offers";
	var $uses = array("Job2.Job2Offer");
	var $components = array("obAuth","MySecurity","Arms", 'ImgUp.ImgUp');
	var $category_list;
	var $area_list;
	var $layout = false;

	function beforeFilter(){
		parent::beforeFilter();

		// 全体権限
		$auth = Configure::read('plugins.auth.job2');
		$auth_group = ($auth['auth'])?(explode(',',$auth['auth'])):(array());
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock($auth_group)) $this->redirect('/');
		$this->set('group_id', $this->obAuth->getGroupId());
		$this->group_id = $this->obAuth->getGroupId();

		// 個別権限
		$auth_group = ($auth['controller'][$this->name][$this->action])?(explode(',',$auth['controller'][$this->name][$this->action])):(array());
		if(!$this->obAuth->lock($auth_group)) $this->redirect('/');

		$this->set('image_url', IMAGE_URL);
		$this->set('append_url', APPEND_URL);
		$this->set('file_temp_url', FILE_TEMP_URL );
		$this->set('max_file_size', JOB_MAX_FILE_SIZE);
		$this->set('magic', time());

		$category = array();
		include(realpath(APP.'../category3.php'));

		$area = array();
		include(realpath(APP.'../area2.php'));

		$this->category_list = $category;
		$this->area_list = $area;

		$this->set('job_category_list', $this->category_list);
		$this->set('job_area_list', $this->area_list);

	}

	function index() {

		// URLからの値をセット
		if($this->data['Job2Offer']['search']) { // 検索したらページを１へ
			$this->data['Job2Offer']['page'] = 1;
		}
		elseif( isset( $this->params[named]['page'] ) ) {
			$this->data['Job2Offer']['page'] = $this->params[named]['page'];
		}
		elseif ($this->Session->check("offer2_pages")) {
			$this->data['Job2Offer']['page'] = $this->Session->read("offer2_pages");
		}
		else {
			$this->data['Job2Offer']['page'] = 1;
		}

		// セッション整理
		$this->Session->del("offer2_pages");
		$this->Session->del("add_offer2_data");
		$this->Session->del("edit_offer2_data");

		// 情報取得
		$options =array();
		$options['conditions'] = array('Job2Offer.deleted = '=>'0');
		$this->paginate=array( 'limit'=>LIST_MAX , 'page'=> $this->data['Job2Offer']['page'] , 'order'=>'Job2Offer.reg_date DESC, Job2Offer.modified DESC' );

		$result = $this->paginate('Job2Offer',$options['conditions']);
		if( $result === false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$cat_list = $this->category_list;
		for($i=0;$i<count($result);$i++) {
			if($result[$i]['Job2Offer']['category']) {
				$cat = explode(',', $result[$i]['Job2Offer']['category']);
				if(isset($cat_list[$cat[0]])) {
					$result[$i]['Job2Offer']['category'] = $cat_list[$cat[0]];
				}
				else {
					$result[$i]['Job2Offer']['category'] = '';
				}
			}

			$open_date = ( $result[$i]['Job2Offer']['open_date'] == "0000-00-00" || $result[$i]['Job2Offer']['open_date'] == "" ) ? (""):($result[$i]['Job2Offer']['open_date']);
			$end_date = ( $result[$i]['Job2Offer']['end_date'] == "0000-00-00" || $result[$i]['Job2Offer']['end_date'] == "" ) ? (""):($result[$i]['Job2Offer']['end_date'].' 23:59:59');

			$result[$i]['Job2Offer']['status'] = 0;
			if($result[$i]['Job2Offer']['disable'] == 1) {
				$result[$i]['Job2Offer']['status'] = 9;
			}
			elseif( $open_date == "" && $end_date != "" ) {
				if( strtotime( $end_date ) < time() ) $result[$i]['Job2Offer']['status'] = 2; // すでに予定が過ぎ去った
			}
			elseif( $open_date != "" && $end_date == "" ) {
				if( strtotime( $open_date ) > time() ) $result[$i]['Job2Offer']['status'] = 1; // まだ予定が来ていない
			}
			elseif( $open_date != "" && $end_date != "" ) {
				if( strtotime( $open_date ) > time() && strtotime( $end_date ) > time() ) $result[$i]['Job2Offer']['status'] = 1; // まだ予定が来ていない
				if( strtotime( $open_date ) < time() && strtotime( $end_date ) < time() ) $result[$i]['Job2Offer']['status'] = 2; // すでに予定が過ぎ去った
			}
		}

		// ページング
		if( $this->params['paging']['Job2Offer']['pageCount'] != 0 ) {
			$page_max = $this->params['paging']['Job2Offer']['pageCount'];

			$page = ( $this->data['Job2Offer']['page'] > $page_max ) ? ( $page_max ) : ( $this->data['Job2Offer']['page'] );

			$end_page = $page_max;
			if( $page_max > 5 ) {
				if( ($page+2) > 5 ) {
					$end_page = $page + 2;
				}
				else {
					$end_page = 5;
				}
			}
		}
		else {
			$page_max = 0;
			$end_page =0;
		}

		$end_page = ( $end_page > $page_max ) ? ( $page_max ) : ( $end_page );
		$start_page = $end_page - (5 -1 );
		$start_page = ( $start_page < 1 ) ? ( 1 ) : ( $start_page );

		// ページの作成
		for($i=$start_page;$i<=$end_page;$i++) {
			$pagelist[]['page'] = $i;
		}

		// トークン設定
		$this->MySecurity->settoken();
		$this->set('list', $result);
		$this->set('pagelist', $pagelist);

		$this->Session->write("offer2_pages",$this->data['Job2Offer']['page']);
	}

	function add() {
		// アサイン
		$this->set('input', array('reg_date'=>date('Y/m/d')));
	}

	function adddo() {

		if( !isset($this->data['Job2Offer']['mode']) ) $this->data['Job2Offer']['mode'] = "";

		if( $this->data['Job2Offer']['mode'] == 'confirm' ) {

			// バリデート
			$this->Job2Offer->setValidation('addconf');
			$this->Job2Offer->create($this->data['Job2Offer']);
			if(!$this->Job2Offer->validates()) {

				$this->set('input', $this->data['Job2Offer']);

				$this->set('error', $this->Job2Offer->invalidFields());
				$this->render('add');
				return false;
			}

			// 画像処理
			unset($this->data['Job2Offer']['id']); // 安全のためにID削除
			if(!$this->ImgUp->confirmImageAll()) {
				$this->set('error', array('エラーが発生しました'));
				$this->render('error');
				return false;
			}

			// 公開開始日・終了日
			if($this->data['Job2Offer']['open_date'] && $this->data['Job2Offer']['end_date'] && strtotime($this->data['Job2Offer']['open_date']) > strtotime($this->data['Job2Offer']['end_date'])) {
				echo 3;
				$tmp = $this->data['Job2Offer']['open_date'];
				$this->data['Job2Offer']['open_date'] = $this->data['Job2Offer']['end_date'];
				$this->data['Job2Offer']['end_date'] = $tmp;
			}

			// セッションへ
			$this->Session->write( 'add_offer2_data' , $this->data['Job2Offer'] );

			// 募集職種
			if($this->data['Job2Offer']['category']) {
				if($this->category_list[$this->data['Job2Offer']['category']]) {
					$this->data['Job2Offer']['category'] = $this->category_list[$this->data['Job2Offer']['category']];
				}
			}

			// エリア
			if($this->data['Job2Offer']['location']) {
				if($this->area_list[$this->data['Job2Offer']['location']]) {
					$this->data['Job2Offer']['location'] = $this->area_list[$this->data['Job2Offer']['location']];
				}
			}

			// アサイン
			$this->set('input', $this->data['Job2Offer'] );

			// トークン設定
			$this->MySecurity->settoken();

			$this->render('add_conf');
		}
		else if( $this->data['Job2Offer']['mode'] == 'add' ) {

			// 二重登録チェック
			if(!$this->MySecurity->checktoken('Job2Offer')) {
				$this->redirect('/job2/job2_offers/');
				return false;
			}

			// セッションがあるか
			if ( !$this->Session->check("add_offer2_data") ) {
				$this->set('error', array('エラーが発生しました'));
				$this->render('error');
				return false;
			}

			$data = $this->Session->read("add_offer2_data");

			// データの整理
			$add_data=array();
			$add_data['catchcopy'] = $data['catchcopy'];
			$add_data['disable'] = $data['disable'];
			$add_data['category'] = $data['category'];
			$add_data['location'] = $data['location'];
			$add_data['work'] = $data['work'];
			$add_data['require_ability'] = $data['require_ability'];
			$add_data['educational_background'] = $data['educational_background'];
			$add_data['wages_type'] = $data['wages_type'];
			$add_data['work_type'] = $data['work_type'];
			$add_data['holiday'] = $data['holiday'];
			$add_data['project_contents'] = $data['project_contents'];
			$add_data['treatment'] = $data['treatment'];
			$add_data['selection'] = $data['selection'];
			$add_data['reg_date'] = $data['reg_date'];
			$add_data['open_date'] = $data['open_date'];
			$add_data['end_date'] = $data['end_date'];
			$add_data['created'] = date('Y-m-d H:i:s');
			$add_data['modified'] = $add_data['created'];

			$add_data['catchcopy'] = mysql_real_escape_string($add_data['catchcopy']);
			$add_data['disable'] = mysql_real_escape_string($add_data['disable']);
			$add_data['category'] = mysql_real_escape_string($add_data['category']);
			$add_data['location'] = mysql_real_escape_string($add_data['location']);
			$add_data['work'] = mysql_real_escape_string($add_data['work']);
			$add_data['require_ability'] = mysql_real_escape_string($add_data['require_ability']);
			$add_data['educational_background'] = mysql_real_escape_string($add_data['educational_background']);
			$add_data['wages_type'] = mysql_real_escape_string($add_data['wages_type']);
			$add_data['work_type'] = mysql_real_escape_string($add_data['work_type']);
			$add_data['holiday'] = mysql_real_escape_string($add_data['holiday']);
			$add_data['project_contents'] = mysql_real_escape_string($add_data['project_contents']);
			$add_data['treatment'] = mysql_real_escape_string($add_data['treatment']);
			$add_data['selection'] = mysql_real_escape_string($add_data['selection']);
			$add_data['reg_date'] = mysql_real_escape_string($add_data['reg_date']);
			$add_data['open_date'] = mysql_real_escape_string($add_data['open_date']);
			$add_data['end_date'] = mysql_real_escape_string($add_data['end_date']);
			$add_data['created'] = mysql_real_escape_string($add_data['created']);
			$add_data['modified'] = mysql_real_escape_string($add_data['modified']);

			$prefix = $this->_getPrefix('Job2Offer');

			$sql = "INSERT INTO ".$prefix."job2_offers (";
			foreach($add_data as $key=>$value) {
				$sql .= $key.", ";
			}
			$sql .= "sort) ";
			$sql .= " SELECT ";
			foreach($add_data as $value) {
				$sql .= "\"" . $value . "\" , ";
			}
			$sql .= "max(sort)+1 "; // ソート番号
			$sql .= " FROM ".$prefix."job2_offers;";

			$this->Job2Offer->query($sql);

			if( mysql_errno()!=0 ) {
				$this->Session->del("add_offer2_data");
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$last_id = mysql_insert_id();

			// 画像関係の更新
			$this->Session->del("add_offer2_data.id"); // 安全のためにID削除
			if(!$this->ImgUp->completeImageAll(array('createName'=>array('key'=>$last_id, 'prefix'=>'job2'), 'session_name'=>'add_offer2_data', 'save'=>$last_id))) {
				$this->Session->del("add_offer2_data"); // セッション削除
				$this->set('error', array('エラーが発生しました'));
				$this->render('error');
				return false;
			}

			$this->Session->del("add_offer2_data");

			$this->render('add_complete');

		}
		else if( $this->data['Job2Offer']['mode'] == 'edit' ) {

			// セッションがあるか
			if ( !$this->Session->check("add_offer2_data") ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$session_data = $this->Session->read("add_offer2_data");

			$session_data['disable'] = ($session_data['disable']==1)?('true'):('false');

			$this->set('input', $session_data );

			$this->render('add');
		}
		else {
			$this->set('error', array('エラーが発生しました'));
			$this->render('error');
			return false;
		}

	}

	function edit() {

		// バリデート
		$this->Job2Offer->setValidation('id');
		$this->Job2Offer->create($this->data['Job2Offer']);
		if(!$this->Job2Offer->validates()) {
			$this->render('error');
			return false;
		}

		$id = $this->data['Job2Offer']['id'];

		// 情報取得
		$options =array();
		$options['conditions'] = array('Job2Offer.id = '=>$id,'Job2Offer.deleted = '=>'0');
		$tdata = $this->Job2Offer->find('first',$options);
		if( $this->Job2Offer->sqlerror == false || empty($tdata) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$tdata['Job2Offer']['disable'] = ($tdata['Job2Offer']['disable']==1)?('true'):('false');
		$tdata['Job2Offer']['reg_date'] = ($tdata['Job2Offer']['open_date'] && $tdata['Job2Offer']['reg_date'] != '0000-00-00') ? date('Y/m/d', strtotime($tdata['Job2Offer']['reg_date'])) : '';
		$tdata['Job2Offer']['open_date'] = ($tdata['Job2Offer']['open_date'] && $tdata['Job2Offer']['open_date'] != '0000-00-00') ? date('Y/m/d', strtotime($tdata['Job2Offer']['open_date'])) : '';
		$tdata['Job2Offer']['end_date'] = ($tdata['Job2Offer']['end_date'] && $tdata['Job2Offer']['end_date'] != '0000-00-00') ? date('Y/m/d', strtotime($tdata['Job2Offer']['end_date'])) : '';


		// アサイン
		$this->set('input', $tdata['Job2Offer']);
		$this->set('original', $tdata['Job2Offer']);
	}

	function editdo() {

		if( !isset($this->data['Job2Offer']['mode']) ) $this->data['Job2Offer']['mode'] = "";

		if( $this->data['Job2Offer']['mode'] == 'confirm' ) {

			// バリデート
			$this->Job2Offer->setValidation('id');
			$this->Job2Offer->create($this->data['Job2Offer']);
			if(!$this->Job2Offer->validates()) {
				$this->render('error');
				return false;
			}

			$id = $this->data['Job2Offer']['id'];

			// 情報取得
			$options =array();
			$options['conditions'] = array('Job2Offer.id = '=>$id,'Job2Offer.deleted = '=>'0');
			$original = $this->Job2Offer->find('first',$options);
			if( $this->Job2Offer->sqlerror == false || empty($original) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$this->set('original', $original['Job2Offer'] );

			// バリデート
			$this->Job2Offer->setValidation('editconf');
			$this->Job2Offer->create($this->data['Job2Offer']);
			if(!$this->Job2Offer->validates()) {
				$this->set('input', $this->data['Job2Offer']);

				$this->set('error', $this->Job2Offer->invalidFields());
				$this->render('edit');
				return false;
			}

			// 画像処理
			if(!$this->ImgUp->confirmImageAll(array(), $original)) {
				$this->set('error', array('エラーが発生しました'));
				$this->render('error');
				return false;
			}

			// 公開開始日・終了日
			if($this->data['Job2Offer']['open_date'] && $this->data['Job2Offer']['end_date'] && strtotime($this->data['Job2Offer']['open_date']) > strtotime($this->data['Job2Offer']['end_date'])) {
				echo 3;
				$tmp = $this->data['Job2Offer']['open_date'];
				$this->data['Job2Offer']['open_date'] = $this->data['Job2Offer']['end_date'];
				$this->data['Job2Offer']['end_date'] = $tmp;
			}

			// セッションへ
			$this->Session->write('edit_offer2_data' , $this->data['Job2Offer']);

			// エリア
			if($this->data['Job2Offer']['category']) {
				if($this->category_list[$this->data['Job2Offer']['category']]) {
					$this->data['Job2Offer']['category'] = $this->category_list[$this->data['Job2Offer']['category']];
				}
			}

			// エリア
			if($this->data['Job2Offer']['location']) {
				if($this->area_list[$this->data['Job2Offer']['location']]) {
					$this->data['Job2Offer']['location'] = $this->area_list[$this->data['Job2Offer']['location']];
				}
			}

			$this->set('input', $this->data['Job2Offer'] );

			// トークン設定
			$this->MySecurity->settoken();

			$this->render('edit_conf');
		}
		else if( $this->data['Job2Offer']['mode'] == 'up' ) {

			// 二重登録チェック
			if(!$this->MySecurity->checktoken('Job2Offer')) {
				$this->redirect('/job2/job2_offers/');
				return false;
			}

			// セッションがあるか
			if ( !$this->Session->check("edit_offer2_data") ) {
				$this->set('error', array('エラーが発生しました'));
				$this->render('error');
				return false;
			}

			$data = $this->Session->read("edit_offer2_data");

			$id = $data['id'];

			// 情報取得
			$options =array();
			$options['conditions'] = array('Job2Offer.id = '=>$id,'Job2Offer.deleted = '=>'0');
			$original = $this->Job2Offer->find('first',$options);
			if( $this->Job2Offer->sqlerror == false || empty($original) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			// 画像関係の更新
			$img = $this->ImgUp->completeImageAll(array('createName'=>array('key'=>$id, 'prefix'=>'job2'), 'session_name'=>'edit_offer2_data', 'save'=>false), $original);
			if($img === false) {
				$this->Session->del("edit_offer2_data"); // セッション削除
				$this->set('error', array('エラーが発生しました'));
				$this->render('error');
				return false;
			}

			// データのマージ
			$data = Set::merge($data, $img);

			// データの整理
			$up_data['id'] = $id;
			$up_data['catchcopy'] = $data['catchcopy'];
			$up_data['disable'] = $data['disable'];
			$up_data['category'] = $data['category'];
			$up_data['location'] = $data['location'];
			$up_data['work'] = $data['work'];
			$up_data['require_ability'] = $data['require_ability'];
			$up_data['educational_background'] = $data['educational_background'];
			$up_data['wages_type'] = $data['wages_type'];
			$up_data['work_type'] = $data['work_type'];
			$up_data['holiday'] = $data['holiday'];
			$up_data['project_contents'] = $data['project_contents'];
			$up_data['treatment'] = $data['treatment'];
			$up_data['selection'] = $data['selection'];
			$up_data['reg_date'] = $data['reg_date'];
			$up_data['open_date'] = $data['open_date'];
			$up_data['end_date'] = $data['end_date'];
			$up_data['pic1'] = $data['pic1'];
			$up_data['modified'] = date('Y-m-d H:i:s');

			$this->Job2Offer->create();
			$up_list = array();
			foreach($up_data as $key=>$value) {
				if($key == 'id') continue;
				$up_list[] = $key;
			}

			if(!$this->Job2Offer->save($up_data,false,$up_list)){
				$this->Session->del("edit_offer2_data");
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$this->Session->del("edit_offer2_data");
			$this->render('edit_complete');

		}
		else if( $this->data['Job2Offer']['mode'] == 'edit' ) {

			// セッションがあるか
			if ( !$this->Session->check("edit_offer2_data") ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$session_data = $this->Session->read("edit_offer2_data");

			$id = $session_data['id'];

			// 情報取得
			$options =array();
			$options['conditions'] = array('Job2Offer.id = '=>$id,'Job2Offer.deleted = '=>'0');
			$tdata = $this->Job2Offer->find('first',$options);
			if( $this->Job2Offer->sqlerror == false || empty($tdata) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$session_data['disable'] = ($session_data['disable'])?('true'):('false');

			$this->set('original', $tdata['Job2Offer'] );
			$this->set('input', $session_data );

			$this->render('edit');
		}
		else {
			$this->set('error', array('エラーが発生しました'));
			$this->render('error');
			return false;
		}

	}

//	function sort() {
//
//		// バリデート
//		$this->Job2Offer->setValidation('sort');
//		$this->Job2Offer->create($this->data['Job2Offer']);
//
//		if(!$this->Job2Offer->validates()) {
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		// セッションがあるか
//		if ( !$this->Session->check("job_search_contents.category") ) {
//			$search_category='';
//		}
//		else {
//			$search_category = $this->Session->read("job_search_contents.category");
//		}
//
//		$id = $this->data['Job2Offer']['id'];
//		$sort_flag = $this->data['Job2Offer']['sort_flag'];
//
//		$options['conditions'] = array('Job2Offer.id = '=>$id,'Job2Offer.deleted = '=>'0');
//		$result = $this->Job2Offer->find('first',$options);
//		if( $this->Job2Offer->sqlerror == false || empty($result) ) {
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		$options = array();
//		$options['conditions'] = array('Job2Offer.deleted = '=>'0');
//		if($search_category) $options['conditions'] += array('Job2Offer.category = ' => $search_category);
//		$options['fields'] = 'Job2Offer.id,Job2Offer.sort';
//		$options['field']  = 'Job2Offer.sort';
//		$options['value']  =  $result['Job2Offer']['sort'];
//
//		$result2 = $this->Job2Offer->find('neighbors',$options);
//		if( $this->Job2Offer->sqlerror == false || empty($result2) ) {
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		if( $sort_flag == 1 ) {
//			if($result2['next']['Job2Offer']['id'] ) {
//				$change_data = array('id'=>$result2['next']['Job2Offer']['id'],'sort'=>$result2['next']['Job2Offer']['sort']);
//			}
//			else {
//				$this->redirect('/job2/job2_offers/');
//				return false;
//			}
//		}
//		elseif($sort_flag == 2) {
//			if($result2['prev']['Job2Offer']['id'] ) {
//				$change_data = array('id'=>$result2['prev']['Job2Offer']['id'],'sort'=>$result2['prev']['Job2Offer']['sort']);
//			}
//			else {
//				$this->redirect('/job2/job2_offers/');
//				return false;
//			}
//		}
//		else {
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		// データの整理
//		$add_data['id'] = $id;
//		$add_data['sort'] = $change_data['sort'];
//
//		// 登録処理
//		$this->Job2Offer->create();
//		$lists=array('sort');
//		if(!$this->Job2Offer->save($add_data,false,$lists)){
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		// データの整理
//		$add_data2['id'] = $change_data['id'];
//		$add_data2['sort'] = $result['Job2Offer']['sort'];
//
//		// 登録処理
//		$this->Job2Offer->create();
//		$lists=array('sort');
//		if(!$this->Job2Offer->save($add_data2,false,$lists)){
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		$this->redirect('/job2/job2_offers/');
//	}

	function del(){

		// バリデート
		$this->Job2Offer->setValidation('id');
		$this->Job2Offer->create($this->data['Job2Offer']);
		if(!$this->Job2Offer->validates()) {
			$this->render('error');
			return false;
		}

		// 二重削除チェック
		if(!$this->MySecurity->checktoken('Job2Offer')) {
			$this->redirect('/job2/job2_offers/');
			return false;
		}

		// 登録済みのデータを取得します
		$options['conditions'] = array('Job2Offer.id = '=>$this->data['Job2Offer']['id'],'Job2Offer.deleted = '=>'0');
		$data = $this->Job2Offer->find('first',$options);
		if( $this->Job2Offer->sqlerror == false || empty($data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// データの整理
		$del_data = array();
		$del_data['id'] = $this->data['Job2Offer']['id'];
		$del_data['deleted'] = 1;

		// フラグを削除に変更
		$up_list = array('deleted');
		$this->Job2Offer->create();
		if(!$this->Job2Offer->save($del_data,false,$up_list)) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// 画像ファイル削除
		if(!$this->ImgUp->deleteImage($data)) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->render('del_complete');
	}
}
?>
