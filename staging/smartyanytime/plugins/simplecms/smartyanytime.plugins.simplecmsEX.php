<?php

// プラグインの登録
$this->registerPlugins('before','smartyanytime_plugins_simplecmsEX','start');

// 設定を取得
require_once(PLUGIN_DIR.'/simplecms/config/config.inc.php');

// Smartyプラグインの登録
$this->smarty->register_function('cms_list', array('smartyanytime_plugins_simplecmsEX','cms_list'), false);
$this->smarty->register_function('cms_setlist', array('smartyanytime_plugins_simplecmsEX','cms_setlist'), false);
$this->smarty->register_function('cms_pagelist', array('smartyanytime_plugins_simplecmsEX','cms_pagelist'), false);
$this->smarty->register_function('cms_detail', array('smartyanytime_plugins_simplecmsEX','cms_detail'), false);
$this->smarty->register_function('cms_images', array('smartyanytime_plugins_simplecmsEX','cms_images'), false);
$this->smarty->register_function('cms_files', array('smartyanytime_plugins_simplecmsEX','cms_files'), false);
$this->smarty->register_function('cms_archives', array('smartyanytime_plugins_simplecmsEX','cms_archives'), false);
$this->smarty->register_function('cms_archives_list', array('smartyanytime_plugins_simplecmsEX','cms_archives_list'), false);
$this->smarty->register_function('cms_setarchives_list', array('smartyanytime_plugins_simplecmsEX','cms_setarchives_list'), false);
$this->smarty->register_function('cms_archives_pagelist', array('smartyanytime_plugins_simplecmsEX','cms_archives_pagelist'), false);
$this->smarty->register_function('cms_archives_date', array('smartyanytime_plugins_simplecmsEX','cms_archives_date'), false);
$this->smarty->register_function('cms_categories', array('smartyanytime_plugins_simplecmsEX','cms_categories'), false);
$this->smarty->register_function('cms_categories_list', array('smartyanytime_plugins_simplecmsEX','cms_categories_list'), false);
$this->smarty->register_function('cms_setcategories_list', array('smartyanytime_plugins_simplecmsEX','cms_setcategories_list'), false);
$this->smarty->register_function('cms_categories_pagelist', array('smartyanytime_plugins_simplecmsEX','cms_categories_pagelist'), false);
$this->smarty->register_function('cms_categories_name', array('smartyanytime_plugins_simplecmsEX','cms_categories_name'), false);
$this->smarty->register_function('cms_prevnext', array('smartyanytime_plugins_simplecmsEX','cms_prevnext'), false);

$this->smarty->register_function('cms_categories_sortid', array('smartyanytime_plugins_simplecmsEX','cms_categories_sortid'), false);

class smartyanytime_plugins_simplecmsEX extends smartyanytime_plugins_simplecms {

	/**
	 *  ドキュメントカテゴリーの順番を返却
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_categories_sortid($params, &$smarty) {

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecmsEX'];

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$name = ($params['name'])?($params['name']):('');
		$format = ($params['format'])?($params['format']):('');
		if(isset($name)===false) return;

		// すべてのドキュメントカテゴリーを取得
		$category = $cms->getCategoryALL($c_id);

		for($i=0;$i<count($category);$i++) {
			if($category[$i]['name']== $name) {
				$sortid = $i+1;
				if($format) {
					return sprintf($format, $sortid);
				}
				else {
					return $sortid;
				}
			}
		}

		return;
	}


	/**
	 *  ドキュメントカテゴリーすべて取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $id ドキュメントカテゴリーID
	 *  @return string ドキュメントカテゴリー名
	 */
	// カテゴリー名を取得
	function getCategoryALL ( $c_id ) {

		$data = "";

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );

		$sql = "SELECT * FROM ".DB_PREFIX."cmsdoccategories WHERE c_id = '" . $c_id . "' AND delete_flag='0' ORDER BY sort;";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return "";
		if ( mysql_num_rows ( $query ) == 0 ) return "";

		while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[] = $fetch;

		return $data;
	}

}

?>