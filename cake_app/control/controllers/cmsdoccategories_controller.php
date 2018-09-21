<?php
class CmsdoccategoriesController extends AppController
{
	var $name = "Cmsdoccategories";
	var $uses = array("Cmsdoccategory","Cmscategory");
	var $components = array("obAuth","MySecurity","Arms");
	var $helpers = array("Paginator");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array())) $this->redirect('/');
		if(!USE_DEFAULT_FUNCTION) $this->redirect('/');
		if($this->obAuth->getGroupId()<CMS_CATEGORY_ALLOW_LEVEL) $this->redirect('/');
		parent::beforeFilter();
	}

	function index() {

		// 複数カテゴリー無かったら
		if( $this->categoryuse_num <= 1 ) $this->redirect('/tops');

		// カテゴリーを取得
		$options['conditions'] = array('Cmscategory.use_category = '=>'1','Cmscategory.delete_flag = '=>'0');
		$options['order'] = array('Cmscategory.c_id ASC');
		$ca_data = $this->Cmscategory->find('all',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->set('list', $ca_data);
	}

	function lists() {

		// URLからの値をセット
		if( !isset($this->data['Cmsdoccategory']['c_id']) && isset( $this->params[named]['cc'] ) ) {
			$this->data['Cmsdoccategory']['c_id'] = $this->params[named]['cc'];
		}

		// バリデート
		$this->Cmsdoccategory->setValidation('list');
		$this->Cmsdoccategory->create($this->data['Cmsdoccategory']);

		if(!$this->Cmsdoccategory->validates()) {
			$this->redirect('/tops');
		}

		$c_id = isset($this->data['Cmsdoccategory']['c_id'])?($this->data['Cmsdoccategory']['c_id']):("");

		if( $c_id == "" ) {
			// セッションがあるか
			if ( !$this->Session->check("doccategories_c_id") ) {
				$this->redirect('/tops');
			}
			else {
				$c_id = $this->Session->read("doccategories_c_id");
			}
		}

		// カテゴリ情報取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		if( $ca_data['Cmscategory']['use_category'] != 1 ) $this->redirect('/tops');

		// ドキュメントカテゴリーを取得
		$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
		$options['order'] = array('Cmsdoccategory.sort'=>'asc');
		$result = $this->Cmsdoccategory->find('all',$options);
		if( $result === false || $this->Cmsdoccategory->sqlerror === false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// トークン設定
		$this->MySecurity->settoken();

		$this->set('c_id', $c_id);
		$this->set('list', $result);
		$this->Session->write("doccategories_c_id",$c_id);

	}

	function add() {

		// セッションがあるか
		if ( !$this->Session->check("doccategories_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("doccategories_c_id");
		}

		// カテゴリ情報取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		if( $ca_data['Cmscategory']['use_category'] != 1 ) $this->redirect('/tops');

		$this->MySecurity->settoken();
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		$this->set('c_id', $c_id);

	}

	function adddo() {

		// セッションがあるか
		if ( !$this->Session->check("doccategories_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("doccategories_c_id");
		}

		// カテゴリ情報取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		if( $ca_data['Cmscategory']['use_category'] != 1 ) $this->redirect('/tops');

		// バリデート
		$this->Cmsdoccategory->setValidation('add');
		$this->Cmsdoccategory->create($this->data['Cmsdoccategory']);

		if(!$this->Cmsdoccategory->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Cmsdoccategory->invalidFields());
			$this->render('add');
			return false;
		}

		// 二重投稿禁止
		if(!$this->MySecurity->checktoken('Cmsdoccategory')) {
			$this->MySecurity->settoken();
			$this->redirect('/cmsdoccategories/');
			exit();
		}

		$add_data['c_id'] = $c_id;
		$add_data['name'] = $this->data['Cmsdoccategory']['name'];

		if(mysql_client_encoding()=="ujis") mb_convert_variables('EUCJP-win','UTF-8',$add_data);
		$add_data['c_id'] = mysql_real_escape_string($add_data['c_id']);
		$add_data['name'] = mysql_real_escape_string($add_data['name']);
		if(mysql_client_encoding()=="ujis") mb_convert_variables('UTF-8','EUCJP-win',$add_data);

		$prefix = $this->_getPrefix('Cmsdoccategory');

		$sql = "INSERT INTO ".$prefix."cmsdoccategories (c_id,name,sort) ";
		$sql .= " SELECT ";
		$sql .= "\"" . $add_data['c_id'] . "\" , " .
			"\"" . $add_data['name'] . "\" , " .
			"max(sort)+1 "; // ソート番号
		$sql .= " FROM ".$prefix."cmsdoccategories where c_id=\"" . $c_id . "\";";

		$this->Cmsdoccategory->query($sql);

		if( $this->Cmsdoccategory->sqlerror == false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->set('c_id', $c_id);

		$this->render('add_complete');
	}

	function edit() {

		// バリデート
		$this->Cmsdoccategory->setValidation('id');
		$this->Cmsdoccategory->create($this->data['Cmsdoccategory']);
		if(!$this->Cmsdoccategory->validates()) {
			$this->redirect('/tops');
		}

		// セッションがあるか
		if ( !$this->Session->check("doccategories_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("doccategories_c_id");
		}

		// ID取得
		$id = $this->data['Cmsdoccategory']['id'];

		// カテゴリ情報取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		if( $ca_data['Cmscategory']['use_category'] != 1 ) $this->redirect('/tops');

		// ドキュメントカテゴリーの取得
		$options = array();
		$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.id = '=>$id,'Cmsdoccategory.delete_flag = '=>'0');
		$result = $this->Cmsdoccategory->find('first',$options);
		if( $this->Cmsdoccategory->sqlerror == false || empty($result) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->MySecurity->settoken();
		$this->set('Cmsdoccategory', $result['Cmsdoccategory']);

	}

	function editdo() {

		// セッションがあるか
		if ( !$this->Session->check("doccategories_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("doccategories_c_id");
		}

		// カテゴリ情報取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		if( $ca_data['Cmscategory']['use_category'] != 1 ) $this->redirect('/tops');

		// バリデート
		$this->Cmsdoccategory->setValidation('edit');
		$this->Cmsdoccategory->create($this->data['Cmsdoccategory']);
		if(!$this->Cmsdoccategory->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Cmsdoccategory->invalidFields());
			$this->render('edit');
			return false;
		}

		// 二重投稿禁止
		if(!$this->MySecurity->checktoken('Cmsdoccategory')) {
			$this->MySecurity->settoken();
			$this->redirect('/cmsdoccategories/');
			exit();
		}

		$add_data['id'] = $this->data['Cmsdoccategory']['id'];
		$add_data['name'] = $this->data['Cmsdoccategory']['name'];

		$up_list = array('name');
		$this->Cmsdoccategory->create();
		$this->Cmsdoccategory->save($add_data,false,$up_list);
		if($this->Cmsdoccategory->sqlerror == false) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->render('edit_complete');
	}

	function sort() {

		// バリデート
		$this->Cmsdoccategory->setValidation('sort');
		$this->Cmsdoccategory->create($this->data['Cmsdoccategory']);

		if(!$this->Cmsdoccategory->validates()) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// セッションがあるか
		if ( !$this->Session->check("doccategories_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("doccategories_c_id");
		}

		$id = $this->data['Cmsdoccategory']['id'];
		$sort_flag = $this->data['Cmsdoccategory']['sort_flag'];

		$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.id = '=>$id,'Cmsdoccategory.delete_flag = '=>'0');
		$result = $this->Cmsdoccategory->find('first',$options);
		if( $this->Cmsdoccategory->sqlerror == false || empty($result) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$options = array();
		$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
		$options['fields'] = 'Cmsdoccategory.id,Cmsdoccategory.sort';
		$options['field']  = 'Cmsdoccategory.sort';
		$options['value']  =  $result['Cmsdoccategory']['sort'];

		$result2 = $this->Cmsdoccategory->find('neighbors',$options);
		if( $this->Cmsdoccategory->sqlerror == false || empty($result2) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		if( $sort_flag == 2 ) {
			if($result2['next']['Cmsdoccategory']['id'] ) {
				$change_data = array('id'=>$result2['next']['Cmsdoccategory']['id'],'sort'=>$result2['next']['Cmsdoccategory']['sort']);
			}
			else {
				$this->redirect('/cmsdoccategories/lists');
				return false;
			}
		}
		elseif($sort_flag == 1) {
			if($result2['prev']['Cmsdoccategory']['id'] ) {
				$change_data = array('id'=>$result2['prev']['Cmsdoccategory']['id'],'sort'=>$result2['prev']['Cmsdoccategory']['sort']);
			}
			else {
				$this->redirect('/cmsdoccategories/lists');
				return false;
			}
		}
		else {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// データの整理
		$add_data['id'] = $id;
		$add_data['sort'] = $change_data['sort'];

		// 登録処理
		$this->Cmsdoccategory->create();
		$lists=array('sort');
		if(!$this->Cmsdoccategory->save($add_data,false,$lists)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// データの整理
		$add_data2['id'] = $change_data['id'];
		$add_data2['sort'] = $result['Cmsdoccategory']['sort'];

		// 登録処理
		$this->Cmsdoccategory->create();
		$lists=array('sort');
		if(!$this->Cmsdoccategory->save($add_data2,false,$lists)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->redirect('/cmsdoccategories/lists');
	}

	function del() {

		if(!$this->MySecurity->checktoken('Cmsdoccategory')) {
			$this->redirect('/tops');
			return false;
		}

		// セッションがあるか
		if ( !$this->Session->check("doccategories_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("doccategories_c_id");
		}

		// バリデート
		$this->Cmsdoccategory->setValidation('del');
		$this->Cmsdoccategory->create($this->data['Cmsdoccategory']);
		if(!$this->Cmsdoccategory->validates()) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// カテゴリ情報取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		if( $ca_data['Cmscategory']['use_category'] != 1 ) $this->redirect('/tops');

		// カテゴリー非選択が出来ない場合は、ドキュメントで使用されていたらエラーとする
		if(!CMS_CATEGORY_USE_NOSELECT) {

			$options = array();
			$options['conditions'] = array('Cmsdocument.c_id = '=>$c_id, 'Cmsdocument.category = '=>$this->data['Cmsdoccategory']['del_id'],'Cmsdocument.delete_flag = '=>'0');
			$use_count = $this->Cmsdocument->find('count',$options);
			if( $this->Cmsdocument->sqlerror == false) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			if($use_count) {

				// ドキュメントカテゴリーを取得
				$options = array();
				$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
				$options['order'] = array('Cmsdoccategory.sort'=>'asc');
				$result = $this->Cmsdoccategory->find('all',$options);
				if( $result === false || $this->Cmsdoccategory->sqlerror === false ) {
					$this->set('error', array('エラーが発生しました。'));
					$this->render('error');
					return false;
				}

				// トークン設定
				$this->MySecurity->settoken();

				$this->set('c_id', $c_id);
				$this->set('list', $result);
				$this->Session->write("doccategories_c_id",$c_id);

				$this->set('error', array('このカテゴリーは使用されているため削除できません'));
				$this->render('lists');
				return false;
			}

		}

		// データの整理
		$del_data['id'] = $this->data['Cmsdoccategory']['del_id'];
		$del_data['delete_flag'] = 1;

		$up_list = array('delete_flag');
		$this->Cmsdoccategory->create();
		if(!$this->Cmsdoccategory->save($del_data,false,$up_list)) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// ドキュメント内のカテゴリーを0に変更
		$prefix = $this->_getPrefix('Cmsdoccategory');
		$this->Cmsdoccategory->query('update '.$prefix.'cmsdocuments set category = 0 where category = "' . mysql_real_escape_string($this->data['Cmsdoccategory']['del_id']) . '";');
		if(mysql_errno!=0) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->render('del');

	}
}
?>
