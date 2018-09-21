<?php
class CmsselectsController extends AppController
{
	var $name = "Cmsselects";
	var $uses = array("Cmscategory");
	var $components = array("obAuth");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array(99))) $this->redirect('/');
		parent::beforeFilter();
	}

	function index() {

		$this->Session->del('documents_c_id');
		$this->Session->del('documents_word');
		$this->Session->del('documents_data');
		$this->Session->del('documents_d_id');
		$this->Session->del('documents_pages');

		$options['conditions'] = array('Cmscategory.delete_flag = '=>'0');
		$result = $this->Cmscategory->findAll($options['conditions'],null,'Cmscategory.c_id asc');
		if( $this->Cmscategory->sqlerror == false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('list', $result);
	}

}
?>
