<?php

// Analytics用テンプレートを読込
define('ANALYTICS_TEMPLATE' , SMARTYANYTIME_DIR.'/tpl/analytics.html' );

// プラグインの登録
$this->registerPlugins('before','smartyanytime_plugins_analytics','start');

// Smartyプラグインの登録
$this->smarty->register_function('analytics', 'output_analytics', false);

class smartyanytime_plugins_analytics extends smartyanytime_plugins {

	/**
	 *  開始
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 */
	function start() {
		$this->_getAnalytics();
	}

	/**
	 *  アナリティクス情報の設定
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 */
	function _getAnalytics() {

		$analytics = array();

		if( USE_DB == true ) {
			$analytics = $this->_getAnalyticsDB();
		}
		else {
			if( file_exists(CONF_DIR.'/analytics_setting.php') ) require_once(CONF_DIR.'/analytics_setting.php');
		}

		$this->data['analytics'] = $analytics;
	}

	/**
	 *  DBからアナリティクス情報を取得
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return string アナリティクス情報
	 */
	function _getAnalyticsDB() {

		$sql = "SELECT * FROM ".DB_PREFIX."analytics WHERE id='1';";
		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) exit();
		if ( mysql_num_rows ( $query ) == 0 ) exit();

		$analytics = mysql_fetch_assoc ( $query );

		return $analytics;
	}
}

/**
 *  アナリティクス情報の出力
 *
 *  @author H.Kobayashi
 *  @param mix $params パラメータ
 *  @param obj $smarty smartyオブジェクト
 */
function output_analytics($params, &$smarty) {

	// テンプレート変数から値を取得
	$smartyanytime = $smarty->get_template_vars('smartyanytime');

	// 各値の基本値を設定
	$link = ($params['path'])?($params['path']):('');

	if( $link ) {
		// 再設定
		$smartyanytime['data']['analytics']['link'] = $link;
	}
	else {
		// インデックスファイルだったらディレクトリまでにする
		if(!$smartyanytime['info']['query_string'] && ($smartyanytime['info']['filename']=='index.html' || $smartyanytime['info']['filename']=='index.htm' || $smartyanytime['info']['filename']=='index.php' || $smartyanytime['info']['filename']=='index.cgi')) {
			$wwwroot = ($smartyanytime['info']['wwwroot']=='/')?(''):($smartyanytime['info']['wwwroot']);
			$dir = ($smartyanytime['info']['dir']=='/')?('/'):($smartyanytime['info']['dir'].'/');
			$smartyanytime['data']['analytics']['link'] = $wwwroot . $dir;
		}
		else if($smartyanytime['info']['status']=='404') {
			$smartyanytime['data']['analytics']['link'] = $smartyanytime['site']['page_404error'];
		}
	}

	// 値をアサイン
	$smarty->assign('analytics',$smartyanytime['data']['analytics']);

	// 出力
	$smarty->display('file:' . ANALYTICS_TEMPLATE ,'analytics','analytics');
}
?>