<?php
class CmscategoriesController extends AppController
{
	var $name = "Cmscategories";
	var $uses = array("Cmscategory","Cmsitemdata","Cmsdoccategory");
	var $components = array("obAuth","MySecurity","Arms");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array(99))) $this->redirect('/');
		parent::beforeFilter();
	}

	function index() {

		$options['conditions'] = array('Cmscategory.delete_flag = '=>'0');
		$options['order'] = array('Cmscategory.c_id asc');
		$result = $this->Cmscategory->find('all',$options);
		if( $this->Cmscategory->sqlerror == false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('list', $result);

		// トークン設定
		$this->MySecurity->settoken();

	}

	function up() {

		if(!$this->MySecurity->checktoken('Cmscategory')) {
			$this->MySecurity->settoken();
			return $this->_return_index();
		}

		// バリデート
		$this->Cmscategory->setValidation('up');

		$this->Cmscategory->create($this->data['Cmscategory']);

		if(!$this->Cmscategory->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Cmscategory->invalidFields());
			$this->_return_index();
			return false;
		}

		// データの整理
		$add_data['name'] = $this->data['Cmscategory']['up_name'];
		$add_data['c_id'] = $this->data['Cmscategory']['up_c_id'];
		$add_data['title_max'] = $this->data['Cmscategory']['up_title_max'];
		$add_data['use_rss'] = $this->data['Cmscategory']['up_use_rss'];
		$add_data['use_period'] = $this->data['Cmscategory']['up_use_period'];
		$add_data['use_mobile'] = $this->data['Cmscategory']['up_use_mobile'];
		$add_data['use_category'] = $this->data['Cmscategory']['up_use_category'];
		$add_data['use_link'] = $this->data['Cmscategory']['up_use_link'];
		$add_data['use_fulledit'] = $this->data['Cmscategory']['up_use_fulledit'];
		$add_data['use_filemanager'] = $this->data['Cmscategory']['use_filemanager'];
		$add_data['preview_page'] = $this->data['Cmscategory']['preview_page'];

		$up_list = array('name','title_max','use_rss','use_period','use_mobile','use_category','use_link','use_fulledit','use_filemanager','preview_page');
		$this->Cmscategory->create();
		if(!$this->Cmscategory->save($add_data,false,$up_list)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->render('up');

	}

	function add() {

		if(!$this->MySecurity->checktoken('Cmscategory')) {
			$this->MySecurity->settoken();
			return $this->_return_index();
		}

		// バリデート
		$this->Cmscategory->setValidation('add');

		$this->Cmscategory->create($this->data['Cmscategory']);

		if(!$this->Cmscategory->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Cmscategory->invalidFields());
			$this->_return_index();
			return false;
		}

		// データの整理
		$add_data['name'] = $this->data['Cmscategory']['name'];

		$this->Cmscategory->create();
		$up_list = array('name');
		if(!$this->Cmscategory->save($add_data,false,$up_list)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->render('add');

	}

	function del() {

		if(!$this->MySecurity->checktoken('Cmscategory')) {
			$this->MySecurity->settoken();
			return $this->_return_index();
		}

		// バリデート
		$this->Cmscategory->setValidation('del');

		$this->Cmscategory->create($this->data['Cmscategory']);

		if(!$this->Cmscategory->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Cmscategory->invalidFields());
			$this->_return_index();
			return false;
		}

		// データの整理
		$del_data['c_id'] = $this->data['Cmscategory']['del_c_id'];
		$del_data['delete_flag'] = 1;

		$up_list = array('delete_flag');
		$this->Cmscategory->create();
		if(!$this->Cmscategory->save($del_data,false,$up_list)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->Cmsdoccategory->create();
		if(!$this->Cmscategory->save($del_data,false,$up_list)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}


		$prefix = $this->_getPrefix('Cmscategory');

		$this->Cmsitemdata->query('update '.$prefix.'cmsitems set delete_flag = 1 where c_id = "' . mysql_real_escape_string($this->data['Cmscategory']['del_c_id']) . '";');
		$this->Cmsitemdata->query('update '.$prefix.'cmsdocuments set delete_flag = 1 where c_id = "' . mysql_real_escape_string($this->data['Cmscategory']['del_c_id']) . '";');
		$this->Cmsitemdata->query('update '.$prefix.'cmsitemdatas set delete_flag = 1 where c_id = "' . mysql_real_escape_string($this->data['Cmscategory']['del_c_id']) . '";');

		$this->render('del');

	}

	function _return_index() {

		$options['conditions'] = array('Cmscategory.delete_flag = '=>'0');
		$options['order'] = array('Cmscategory.c_id asc');
		$result = $this->Cmscategory->find('all',$options);
		if( $this->Cmscategory->sqlerror == false || empty($result) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('list', $result);

		$this->render('index');
		return false;
	}


}
?>
