<?php

$this->smarty->register_function('include_tpl', 'includeTpl', false);

class smartyanytime_plugins_inc extends smartyanytime_plugins {
	function start( ) {}
}

// インクルード用
function includeTpl($params, &$smarty) {

	$parts_id = $params['file'];

	// 各値の基本値を設定
	$file = ($params['file'])?($params['file']):('');
	$file = preg_replace('/^\//', '', $file);

	$file_path = WWWROOT .'/include/'. $file;

	if( $file && file_exists($file_path) ) {
		// 出力
		$smarty->display('file:' . $file_path ,'include_'.htmlentities($file),'include_'.htmlentities($file));
	}
}
?>