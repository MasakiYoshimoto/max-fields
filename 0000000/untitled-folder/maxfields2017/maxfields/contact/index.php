<?php
	//error_reporting(-1);
	ini_set('display_errors', 0);
	define('APP_DIR', dirname(__FILE__));
	define('MODULES_DIR', APP_DIR.'/modules');
	include(MODULES_DIR.'/Form.php');

	$form = new Form;
	$form->run();
