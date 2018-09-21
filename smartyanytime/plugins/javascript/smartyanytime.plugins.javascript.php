<?php

// 設定を取得
require_once(PLUGIN_DIR.'/javascript/config/config.inc.php');

// プログラム実行ページの登録
$this->registerPrograms(JAVASCRIPT_DEFAULT_PATH,'smartyanytime_plugins_javascript','start'); // 確認画面

class smartyanytime_plugins_javascript extends smartyanytime_plugins {

	function start() {

		if( !$_GET['s'] ) exit;
		$file = SA_JVASCRIPT_DIR.$_GET['s'].'.js';

		if(!file_exists($file) || is_dir($file) ) exit;

		if(strpos($file, '..') !== false) exit();

		header("Content-Type: text/javascript; charset=utf-8");
		print file_get_contents($file);
		exit();
	}

}
?>