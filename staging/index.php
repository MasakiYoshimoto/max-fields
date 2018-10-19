<?php

	/////////////////////////////////////////////
	// ルートパス
	////////////////////////////////////////////
	define('WWWROOT',dirname(__FILE__));

	/////////////////////////////////////////////
	// ライブラリディレクトリ
	////////////////////////////////////////////
	define('SMARTYANYTIME_DIR'   , '/var/www/vhosts/evolve-max.com/httpdocs/staging/smartyanytime' );

	/////////////////////////////////////////////
	// 設定
	////////////////////////////////////////////
	require_once(SMARTYANYTIME_DIR.'/config/common_config.inc.php');
	require_once(SMARTYANYTIME_DIR.'/lib/smartyanytime.php');
	require_once(CONF_DIR.'/boot.php');

	/////////////////////////////////////////////
	// 開始
	////////////////////////////////////////////
	$obj = new smartyanytime;

	/////////////////////////////////////////////
	// 各種設定が正しく取得できなかった場合の処理
	////////////////////////////////////////////
//	$obj->smartyanytime['info']['document_root'] = '';

	$obj->displayPage();

?>