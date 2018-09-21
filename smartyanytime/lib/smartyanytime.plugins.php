<?php

class smartyanytime_plugins {

	var $smarty;
	var $smartyanytime;
	var $config;
	var $data;

	function __construct(&$smartyanytime=array(),&$data=array(),&$smarty,$config=array()) {
		$this->smartyanytime =& $smartyanytime;
		$this->smarty = $smarty;
		$this->config = $config;
		$this->data = & $data;
	}

	function reg() {}
}
?>