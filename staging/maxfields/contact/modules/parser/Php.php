<?php
class Parser_Php {

	var $setData = array();

	public function __construct() {}

	public function set($name, $value, $encode=true) {
		if($encode) $value = Form::htmlentitiesEx($value);
		$this->setData[$name] = $value;
	}

	public function display($file) {
		extract($this->setData, EXTR_SKIP);
		if(!file_exists(APP_DIR.'/modules/tpl/'.$file)) die('template not found !');
		include(APP_DIR.'/modules/tpl/'.$file);
		exit();
	}
}