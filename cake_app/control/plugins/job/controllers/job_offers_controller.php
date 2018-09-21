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
 * @property JobOffer $JobOffer
 *
 */
class JobOffersController extends JobAppController
{
	var $name = "JobOffers";
	var $uses = array("Job.JobOffer");
	var $components = array("obAuth","MySecurity","Arms");
	var $category_list;
	var $area_list;
	var $layout = false;

	function beforeFilter(){
		parent::beforeFilter();

		// 全体権限
		$auth = Configure::read('plugins.auth.job');
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
		include(realpath(APP.'../category.php'));

		$area = array();
		include(realpath(APP.'../area.php'));

		$this->category_list = $category;
		$this->area_list = $area;

		$this->set('job_category_list', $this->category_list);
		$this->set('job_area_list', $this->area_list);

	}

	function index() {

		// URLからの値をセット
		if($this->data['JobOffer']['search']) { // 検索したらページを１へ
			$this->data['JobOffer']['page'] = 1;
		}
		elseif( isset( $this->params[named]['page'] ) ) {
			$this->data['JobOffer']['page'] = $this->params[named]['page'];
		}
		elseif ($this->Session->check("offer_pages")) {
			$this->data['JobOffer']['page'] = $this->Session->read("offer_pages");
		}
		else {
			$this->data['JobOffer']['page'] = 1;
		}

		// セッション整理
		$this->Session->del("offer_pages");
		$this->Session->del("add_offer_data");
		$this->Session->del("edit_offer_data");

		// 情報取得
		$options =array();
		$options['conditions'] = array('JobOffer.deleted = '=>'0');
		$this->paginate=array( 'limit'=>LIST_MAX , 'page'=> $this->data['JobOffer']['page'] , 'order'=>'JobOffer.reg_date DESC, JobOffer.modified DESC' );

		$result = $this->paginate('JobOffer',$options['conditions']);
		if( $result === false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$cat_list = array();
		foreach($this->category_list as $value) {
			$cat_list+= $value;
		}
		for($i=0;$i<count($result);$i++) {
			if($result[$i]['JobOffer']['category']) {
				$cat = explode(',', $result[$i]['JobOffer']['category']);
				if(isset($cat_list[$cat[0]])) {
					$result[$i]['JobOffer']['category'] = $cat_list[$cat[0]];
				}
				else {
					$result[$i]['JobOffer']['category'] = '';
				}
			}

			$open_date = ( $result[$i]['JobOffer']['open_date'] == "0000-00-00" || $result[$i]['JobOffer']['open_date'] == "" ) ? (""):($result[$i]['JobOffer']['open_date']);
			$end_date = ( $result[$i]['JobOffer']['end_date'] == "0000-00-00" || $result[$i]['JobOffer']['end_date'] == "" ) ? (""):($result[$i]['JobOffer']['end_date'].' 23:59:59');

			$result[$i]['JobOffer']['status'] = 0;
			if($result[$i]['JobOffer']['disable'] == 1) {
				$result[$i]['JobOffer']['status'] = 9;
			}
			elseif( $open_date == "" && $end_date != "" ) {
				if( strtotime( $end_date ) < time() ) $result[$i]['JobOffer']['status'] = 2; // すでに予定が過ぎ去った
			}
			elseif( $open_date != "" && $end_date == "" ) {
				if( strtotime( $open_date ) > time() ) $result[$i]['JobOffer']['status'] = 1; // まだ予定が来ていない
			}
			elseif( $open_date != "" && $end_date != "" ) {
				if( strtotime( $open_date ) > time() && strtotime( $end_date ) > time() ) $result[$i]['JobOffer']['status'] = 1; // まだ予定が来ていない
				if( strtotime( $open_date ) < time() && strtotime( $end_date ) < time() ) $result[$i]['JobOffer']['status'] = 2; // すでに予定が過ぎ去った
			}
		}

		// ページング
		if( $this->params['paging']['JobOffer']['pageCount'] != 0 ) {
			$page_max = $this->params['paging']['JobOffer']['pageCount'];

			$page = ( $this->data['JobOffer']['page'] > $page_max ) ? ( $page_max ) : ( $this->data['JobOffer']['page'] );

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

		$this->Session->write("offer_pages",$this->data['JobOffer']['page']);
	}

	function add() {
		// アサイン
		$this->set('input', array('reg_date'=>date('Y/m/d')));
	}

	function adddo() {

		if( !isset($this->data['JobOffer']['mode']) ) $this->data['JobOffer']['mode'] = "";

		if( $this->data['JobOffer']['mode'] == 'confirm' ) {

			if(!isset($this->data['JobOffer']['category1']) || !$this->data['JobOffer']['category1']) $this->data['JobOffer']['category1'] = array();
			if(!isset($this->data['JobOffer']['category2']) || !$this->data['JobOffer']['category2']) $this->data['JobOffer']['category2'] = array();
			if(!isset($this->data['JobOffer']['category3']) || !$this->data['JobOffer']['category3']) $this->data['JobOffer']['category3'] = array();
//			if(!isset($this->data['JobOffer']['category4']) || !$this->data['JobOffer']['category4']) $this->data['JobOffer']['category4'] = array();
//			if(!isset($this->data['JobOffer']['category5']) || !$this->data['JobOffer']['category5']) $this->data['JobOffer']['category5'] = array();
//			if(!isset($this->data['JobOffer']['category6']) || !$this->data['JobOffer']['category6']) $this->data['JobOffer']['category6'] = array();
//			if(!isset($this->data['JobOffer']['category7']) || !$this->data['JobOffer']['category7']) $this->data['JobOffer']['category7'] = array();
//			if(!isset($this->data['JobOffer']['category8']) || !$this->data['JobOffer']['category8']) $this->data['JobOffer']['category8'] = array();
//			if(!isset($this->data['JobOffer']['category9']) || !$this->data['JobOffer']['category9']) $this->data['JobOffer']['category9'] = array();
//			if(!isset($this->data['JobOffer']['category10']) || !$this->data['JobOffer']['category10']) $this->data['JobOffer']['category10'] = array();

			$this->data['JobOffer']['category'] = array_merge(
				$this->data['JobOffer']['category1'],
				$this->data['JobOffer']['category2'],
				$this->data['JobOffer']['category3']
//				$this->data['JobOffer']['category4'],
//				$this->data['JobOffer']['category5'],
//				$this->data['JobOffer']['category6'],
//				$this->data['JobOffer']['category7'],
//				$this->data['JobOffer']['category8'],
//				$this->data['JobOffer']['category9'],
//				$this->data['JobOffer']['category10']
			);

			// バリデート
			$this->JobOffer->setValidation('addconf');
			$this->JobOffer->create($this->data['JobOffer']);
			if(!$this->JobOffer->validates()) {

				$this->set('input', $this->data['JobOffer']);

				$this->set('error', $this->JobOffer->invalidFields());
				$this->render('add');
				return false;
			}

			// 公開開始日・終了日
			if($this->data['JobOffer']['open_date'] && $this->data['JobOffer']['end_date'] && strtotime($this->data['JobOffer']['open_date']) > strtotime($this->data['JobOffer']['end_date'])) {
				echo 3;
				$tmp = $this->data['JobOffer']['open_date'];
				$this->data['JobOffer']['open_date'] = $this->data['JobOffer']['end_date'];
				$this->data['JobOffer']['end_date'] = $tmp;
			}

			// セッションへ
			$this->Session->write( 'add_offer_data' , $this->data['JobOffer'] );

			// エリア
			if($this->data['JobOffer']['location']) {
				if($this->area_list[$this->data['JobOffer']['location']]) {
					$this->data['JobOffer']['location'] = $this->area_list[$this->data['JobOffer']['location']];
				}
			}

			// カテゴリー
			for($i=1;$i<=10;$i++) {
				if($this->data['JobOffer']['category'.$i]) {
					$category = array();
					foreach($this->data['JobOffer']['category'.$i] as $value) {
						$type = ($i -1) * 1000 + 10000;
						if($this->category_list[$type][$value]) {
							$category[] = $this->category_list[$type][$value];
						}
					}

					if($category) {
						$this->data['JobOffer']['category'.$i] = '・'.implode("\r\n・", $category);
					}
					else {
						$this->data['JobOffer']['category'.$i] = '';
					}
				}
				else {
					$this->data['JobOffer']['category'.$i] = '';
				}
			}

			// アサイン
			$this->set('input', $this->data['JobOffer'] );

			// トークン設定
			$this->MySecurity->settoken();

			$this->render('add_conf');
		}
		else if( $this->data['JobOffer']['mode'] == 'add' ) {

			// 二重登録チェック
			if(!$this->MySecurity->checktoken('JobOffer')) {
				$this->redirect('/job/job_offers/');
				return false;
			}

			// セッションがあるか
			if ( !$this->Session->check("add_offer_data") ) {
				$this->set('error', array('エラーが発生しました'));
				$this->render('error');
				return false;
			}

			$data = $this->Session->read("add_offer_data");

			// データの整理
			$add_data=array();
			$add_data['catchcopy'] = $data['catchcopy'];
			$add_data['disable'] = $data['disable'];
			$add_data['category'] = $data['category'] ? implode(',', $data['category']) : '';
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
			$add_data['etc'] = $data['etc'];
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
			$add_data['etc'] = mysql_real_escape_string($add_data['etc']);
			$add_data['reg_date'] = mysql_real_escape_string($add_data['reg_date']);
			$add_data['open_date'] = mysql_real_escape_string($add_data['open_date']);
			$add_data['end_date'] = mysql_real_escape_string($add_data['end_date']);
			$add_data['created'] = mysql_real_escape_string($add_data['created']);
			$add_data['modified'] = mysql_real_escape_string($add_data['modified']);

			$prefix = $this->_getPrefix('JobOffer');

			$sql = "INSERT INTO ".$prefix."job_offers (";
			foreach($add_data as $key=>$value) {
				$sql .= $key.", ";
			}
			$sql .= "sort) ";
			$sql .= " SELECT ";
			foreach($add_data as $value) {
				$sql .= "\"" . $value . "\" , ";
			}
			$sql .= "max(sort)+1 "; // ソート番号
			$sql .= " FROM ".$prefix."job_offers;";

			$this->JobOffer->query($sql);

			if( mysql_errno()!=0 ) {
				$this->Session->del("add_offer_data");
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$last_id = mysql_insert_id();

			$this->Session->del("add_offer_data");

			$this->render('add_complete');

		}
		else if( $this->data['JobOffer']['mode'] == 'edit' ) {

			// セッションがあるか
			if ( !$this->Session->check("add_offer_data") ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$session_data = $this->Session->read("add_offer_data");

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
		$this->JobOffer->setValidation('id');
		$this->JobOffer->create($this->data['JobOffer']);
		if(!$this->JobOffer->validates()) {
			$this->render('error');
			return false;
		}

		$id = $this->data['JobOffer']['id'];

		// 情報取得
		$options =array();
		$options['conditions'] = array('JobOffer.id = '=>$id,'JobOffer.deleted = '=>'0');
		$tdata = $this->JobOffer->find('first',$options);
		if( $this->JobOffer->sqlerror == false || empty($tdata) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$cat = explode(',', $tdata['JobOffer']['category']);
		foreach($cat as $value) {
			for($i=1;$i<=10;$i++) {
				$type = ($i -1) * 1000 + 10000;
				if(isset($this->category_list[$type][$value]) && $this->category_list[$type][$value]) {
					$tdata['JobOffer']['category'.$i][] = $value;
				}
			}
		}

		if(!isset($tdata['JobOffer']['category1']) || !$tdata['JobOffer']['category1']) $tdata['JobOffer']['category1'] = array();
		if(!isset($tdata['JobOffer']['category2']) || !$tdata['JobOffer']['category2']) $tdata['JobOffer']['category2'] = array();
		if(!isset($tdata['JobOffer']['category3']) || !$tdata['JobOffer']['category3']) $tdata['JobOffer']['category3'] = array();
//		if(!isset($tdata['JobOffer']['category4']) || !$tdata['JobOffer']['category4']) $tdata['JobOffer']['category4'] = array();
//		if(!isset($tdata['JobOffer']['category5']) || !$tdata['JobOffer']['category5']) $tdata['JobOffer']['category5'] = array();
//		if(!isset($tdata['JobOffer']['category6']) || !$tdata['JobOffer']['category6']) $tdata['JobOffer']['category6'] = array();
//		if(!isset($tdata['JobOffer']['category7']) || !$tdata['JobOffer']['category7']) $tdata['JobOffer']['category7'] = array();
//		if(!isset($tdata['JobOffer']['category8']) || !$tdata['JobOffer']['category8']) $tdata['JobOffer']['category8'] = array();
//		if(!isset($tdata['JobOffer']['category9']) || !$tdata['JobOffer']['category9']) $tdata['JobOffer']['category9'] = array();
//		if(!isset($tdata['JobOffer']['category10']) || !$tdata['JobOffer']['category10']) $tdata['JobOffer']['category10'] = array();

		$tdata['JobOffer']['disable'] = ($tdata['JobOffer']['disable']==1)?('true'):('false');
		$tdata['JobOffer']['reg_date'] = ($tdata['JobOffer']['open_date'] && $tdata['JobOffer']['reg_date'] != '0000-00-00') ? date('Y/m/d', strtotime($tdata['JobOffer']['reg_date'])) : '';
		$tdata['JobOffer']['open_date'] = ($tdata['JobOffer']['open_date'] && $tdata['JobOffer']['open_date'] != '0000-00-00') ? date('Y/m/d', strtotime($tdata['JobOffer']['open_date'])) : '';
		$tdata['JobOffer']['end_date'] = ($tdata['JobOffer']['end_date'] && $tdata['JobOffer']['end_date'] != '0000-00-00') ? date('Y/m/d', strtotime($tdata['JobOffer']['end_date'])) : '';


		// アサイン
		$this->set('input', $tdata['JobOffer']);
		$this->set('original', $tdata['JobOffer']);
	}

	function editdo() {

		if( !isset($this->data['JobOffer']['mode']) ) $this->data['JobOffer']['mode'] = "";

		if( $this->data['JobOffer']['mode'] == 'confirm' ) {

			if(!isset($this->data['JobOffer']['category1']) || !$this->data['JobOffer']['category1']) $this->data['JobOffer']['category1'] = array();
			if(!isset($this->data['JobOffer']['category2']) || !$this->data['JobOffer']['category2']) $this->data['JobOffer']['category2'] = array();
			if(!isset($this->data['JobOffer']['category3']) || !$this->data['JobOffer']['category3']) $this->data['JobOffer']['category3'] = array();
//			if(!isset($this->data['JobOffer']['category4']) || !$this->data['JobOffer']['category4']) $this->data['JobOffer']['category4'] = array();
//			if(!isset($this->data['JobOffer']['category5']) || !$this->data['JobOffer']['category5']) $this->data['JobOffer']['category5'] = array();
//			if(!isset($this->data['JobOffer']['category6']) || !$this->data['JobOffer']['category6']) $this->data['JobOffer']['category6'] = array();
//			if(!isset($this->data['JobOffer']['category7']) || !$this->data['JobOffer']['category7']) $this->data['JobOffer']['category7'] = array();
//			if(!isset($this->data['JobOffer']['category8']) || !$this->data['JobOffer']['category8']) $this->data['JobOffer']['category8'] = array();
//			if(!isset($this->data['JobOffer']['category9']) || !$this->data['JobOffer']['category9']) $this->data['JobOffer']['category9'] = array();
//			if(!isset($this->data['JobOffer']['category10']) || !$this->data['JobOffer']['category10']) $this->data['JobOffer']['category10'] = array();

			$this->data['JobOffer']['category'] = array_merge(
				$this->data['JobOffer']['category1'],
				$this->data['JobOffer']['category2'],
				$this->data['JobOffer']['category3']
//				$this->data['JobOffer']['category4'],
//				$this->data['JobOffer']['category5'],
//				$this->data['JobOffer']['category6'],
//				$this->data['JobOffer']['category7'],
//				$this->data['JobOffer']['category8'],
//				$this->data['JobOffer']['category9'],
//				$this->data['JobOffer']['category10']
			);

			// バリデート
			$this->JobOffer->setValidation('id');
			$this->JobOffer->create($this->data['JobOffer']);
			if(!$this->JobOffer->validates()) {
				$this->render('error');
				return false;
			}

			$id = $this->data['JobOffer']['id'];

			// 情報取得
			$options =array();
			$options['conditions'] = array('JobOffer.id = '=>$id,'JobOffer.deleted = '=>'0');
			$original = $this->JobOffer->find('first',$options);
			if( $this->JobOffer->sqlerror == false || empty($original) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$this->set('original', $original['JobOffer'] );

			// バリデート
			$this->JobOffer->setValidation('editconf');
			$this->JobOffer->create($this->data['JobOffer']);
			if(!$this->JobOffer->validates()) {
				$this->set('input', $this->data['JobOffer']);

				$this->set('error', $this->JobOffer->invalidFields());
				$this->render('edit');
				return false;
			}

			// 公開開始日・終了日
			if($this->data['JobOffer']['open_date'] && $this->data['JobOffer']['end_date'] && strtotime($this->data['JobOffer']['open_date']) > strtotime($this->data['JobOffer']['end_date'])) {
				echo 3;
				$tmp = $this->data['JobOffer']['open_date'];
				$this->data['JobOffer']['open_date'] = $this->data['JobOffer']['end_date'];
				$this->data['JobOffer']['end_date'] = $tmp;
			}

			// セッションへ
			$this->Session->write( 'edit_offer_data' , $this->data['JobOffer'] );

			// カテゴリー
			for($i=1;$i<=10;$i++) {
				if($this->data['JobOffer']['category'.$i]) {
					$category = array();
					foreach($this->data['JobOffer']['category'.$i] as $value) {
						$type = ($i -1) * 1000 + 10000;
						if($this->category_list[$type][$value]) {
							$category[] = $this->category_list[$type][$value];
						}
					}

					if($category) {
						$this->data['JobOffer']['category'.$i] = '・'.implode("\r\n・", $category);
					}
					else {
						$this->data['JobOffer']['category'.$i] = '';
					}
				}
				else {
					$this->data['JobOffer']['category'.$i] = '';
				}
			}

			// エリア
			if($this->data['JobOffer']['location']) {
				if($this->area_list[$this->data['JobOffer']['location']]) {
					$this->data['JobOffer']['location'] = $this->area_list[$this->data['JobOffer']['location']];
				}
			}

			$this->set('input', $this->data['JobOffer'] );

			// トークン設定
			$this->MySecurity->settoken();

			$this->render('edit_conf');
		}
		else if( $this->data['JobOffer']['mode'] == 'up' ) {

			// 二重登録チェック
			if(!$this->MySecurity->checktoken('JobOffer')) {
				$this->redirect('/job/job_offers/');
				return false;
			}

			// セッションがあるか
			if ( !$this->Session->check("edit_offer_data") ) {
				$this->set('error', array('エラーが発生しました'));
				$this->render('error');
				return false;
			}

			$data = $this->Session->read("edit_offer_data");

			$id = $data['id'];

			// 情報取得
			$options =array();
			$options['conditions'] = array('JobOffer.id = '=>$id,'JobOffer.deleted = '=>'0');
			$original = $this->JobOffer->find('first',$options);
			if( $this->JobOffer->sqlerror == false || empty($original) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			// データの整理
			$up_data['id'] = $id;
			$up_data['catchcopy'] = $data['catchcopy'];
			$up_data['disable'] = $data['disable'];
			$up_data['category'] = $data['category'] ? implode(',', $data['category']) : '';
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
			$up_data['etc'] = $data['etc'];
			$up_data['reg_date'] = $data['reg_date'];
			$up_data['open_date'] = $data['open_date'];
			$up_data['end_date'] = $data['end_date'];
			$up_data['pic1'] = $data['pic1'];
			$up_data['modified'] = date('Y-m-d H:i:s');

			$this->JobOffer->create();
			$up_list = array();
			foreach($up_data as $key=>$value) {
				if($key == 'id') continue;
				$up_list[] = $key;
			}

			if(!$this->JobOffer->save($up_data,false,$up_list)){
				$this->Session->del("edit_offer_data");
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$this->Session->del("edit_offer_data");
			$this->render('edit_complete');

		}
		else if( $this->data['JobOffer']['mode'] == 'edit' ) {

			// セッションがあるか
			if ( !$this->Session->check("edit_offer_data") ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$session_data = $this->Session->read("edit_offer_data");

			$id = $session_data['id'];

			// 情報取得
			$options =array();
			$options['conditions'] = array('JobOffer.id = '=>$id,'JobOffer.deleted = '=>'0');
			$tdata = $this->JobOffer->find('first',$options);
			if( $this->JobOffer->sqlerror == false || empty($tdata) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$session_data['disable'] = ($session_data['disable'])?('true'):('false');

			$this->set('original', $tdata['JobOffer'] );
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
//		$this->JobOffer->setValidation('sort');
//		$this->JobOffer->create($this->data['JobOffer']);
//
//		if(!$this->JobOffer->validates()) {
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
//		$id = $this->data['JobOffer']['id'];
//		$sort_flag = $this->data['JobOffer']['sort_flag'];
//
//		$options['conditions'] = array('JobOffer.id = '=>$id,'JobOffer.deleted = '=>'0');
//		$result = $this->JobOffer->find('first',$options);
//		if( $this->JobOffer->sqlerror == false || empty($result) ) {
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		$options = array();
//		$options['conditions'] = array('JobOffer.deleted = '=>'0');
//		if($search_category) $options['conditions'] += array('JobOffer.category = ' => $search_category);
//		$options['fields'] = 'JobOffer.id,JobOffer.sort';
//		$options['field']  = 'JobOffer.sort';
//		$options['value']  =  $result['JobOffer']['sort'];
//
//		$result2 = $this->JobOffer->find('neighbors',$options);
//		if( $this->JobOffer->sqlerror == false || empty($result2) ) {
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		if( $sort_flag == 1 ) {
//			if($result2['next']['JobOffer']['id'] ) {
//				$change_data = array('id'=>$result2['next']['JobOffer']['id'],'sort'=>$result2['next']['JobOffer']['sort']);
//			}
//			else {
//				$this->redirect('/job/job_offers/');
//				return false;
//			}
//		}
//		elseif($sort_flag == 2) {
//			if($result2['prev']['JobOffer']['id'] ) {
//				$change_data = array('id'=>$result2['prev']['JobOffer']['id'],'sort'=>$result2['prev']['JobOffer']['sort']);
//			}
//			else {
//				$this->redirect('/job/job_offers/');
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
//		$this->JobOffer->create();
//		$lists=array('sort');
//		if(!$this->JobOffer->save($add_data,false,$lists)){
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		// データの整理
//		$add_data2['id'] = $change_data['id'];
//		$add_data2['sort'] = $result['JobOffer']['sort'];
//
//		// 登録処理
//		$this->JobOffer->create();
//		$lists=array('sort');
//		if(!$this->JobOffer->save($add_data2,false,$lists)){
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}
//
//		$this->redirect('/job/job_offers/');
//	}

	function del(){

		// バリデート
		$this->JobOffer->setValidation('id');
		$this->JobOffer->create($this->data['JobOffer']);
		if(!$this->JobOffer->validates()) {
			$this->render('error');
			return false;
		}

		// 二重削除チェック
		if(!$this->MySecurity->checktoken('JobOffer')) {
			$this->redirect('/job/job_offers/');
			return false;
		}

		// 登録済みのデータを取得します
		$options['conditions'] = array('JobOffer.id = '=>$this->data['JobOffer']['id'],'JobOffer.deleted = '=>'0');
		$data = $this->JobOffer->find('first',$options);
		if( $this->JobOffer->sqlerror == false || empty($data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// データの整理
		$del_data = array();
		$del_data['id'] = $this->data['JobOffer']['id'];
		$del_data['deleted'] = 1;

		// フラグを削除に変更
		$up_list = array('deleted');
		$this->JobOffer->create();
		if(!$this->JobOffer->save($del_data,false,$up_list)) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->render('del_complete');
	}
}
?>
