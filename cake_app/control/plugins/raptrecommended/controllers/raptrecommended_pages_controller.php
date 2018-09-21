<?php
class RaptrecommendedPagesController extends RaptrecommendedAppController
{
	var $name = "RaptrecommendedPages";
	var $uses = array();
	var $components = array("obAuth");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array())) $this->redirect('/');
		parent::beforeFilter();
	}

	function index() {

	}

}
?>
