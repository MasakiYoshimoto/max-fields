<?php
include(MODULES_DIR.'/vendor/smarty/Smarty.class.php');
class Parser_Smarty {

	var $smarty;

	public function __construct() {
		$this->init();
	}

	public function init() {
		// smarty開始
		$this->smarty = new Smarty;

		// smartyの設定
		$this->smarty->template_dir = MODULES_DIR.'/tpl/';
		$this->smarty->compile_dir  = MODULES_DIR.'/vendor/smarty/tmp/compile/';
		$this->smarty->config_dir   = MODULES_DIR.'/vendor/smarty/tmp/config/';

		$this->smarty->debugging    = false;

		$this->smarty->left_delimiter="{{";
		$this->smarty->right_delimiter="}}";

		// フォルダの存在チェック&権限チェック
		if(!is_writable($this->smarty->compile_dir)) die('compile_dir is not writable !');
		if(!is_writable($this->smarty->config_dir))  die('config_dir is not writable !');
	}

	public function set($name, $value, $encode=true) {
		if($encode) $value = Form::htmlentitiesEx($value);
		$this->smarty->assign($name, $value);
	}

	public function display($file) {
		$this->smarty->display($this->smarty->template_dir.$file);
		exit();
	}
}