<?php

// プラグインの登録
$this->registerPlugins('before','smartyanytime_plugins_simplecms','start');

// 設定を取得
require_once(PLUGIN_DIR.'/simplecms/config/config.inc.php');

// Smartyプラグインの登録
//$this->smarty->register_function('cms_list', array('smartyanytime_plugins_simplecms','cms_list'), false);
//$this->smarty->register_function('cms_setlist', array('smartyanytime_plugins_simplecms','cms_setlist'), false);
//$this->smarty->register_function('cms_pagelist', array('smartyanytime_plugins_simplecms','cms_pagelist'), false);
//$this->smarty->register_function('cms_detail', array('smartyanytime_plugins_simplecms','cms_detail'), false);
//$this->smarty->register_function('cms_images', array('smartyanytime_plugins_simplecms','cms_images'), false);
//$this->smarty->register_function('cms_files', array('smartyanytime_plugins_simplecms','cms_files'), false);
//$this->smarty->register_function('cms_archives', array('smartyanytime_plugins_simplecms','cms_archives'), false);
//$this->smarty->register_function('cms_archives_list', array('smartyanytime_plugins_simplecms','cms_archives_list'), false);
//$this->smarty->register_function('cms_archives_pagelist', array('smartyanytime_plugins_simplecms','cms_archives_pagelist'), false);
//$this->smarty->register_function('cms_archives_date', array('smartyanytime_plugins_simplecms','cms_archives_date'), false);
//$this->smarty->register_function('cms_categories', array('smartyanytime_plugins_simplecms','cms_categories'), false);
//$this->smarty->register_function('cms_categories_list', array('smartyanytime_plugins_simplecms','cms_categories_list'), false);
//$this->smarty->register_function('cms_categories_pagelist', array('smartyanytime_plugins_simplecms','cms_categories_pagelist'), false);
//$this->smarty->register_function('cms_categories_name', array('smartyanytime_plugins_simplecms','cms_categories_name'), false);

class smartyanytime_plugins_simplecms extends smartyanytime_plugins {

	function start() {

		$wwwroot = ($this->smartyanytime['info']['wwwroot']=='/')?(''):($this->smartyanytime['info']['wwwroot']);

		$this->smarty->assign('site_url' , $this->smartyanytime['site']['site_url']);
		$this->smarty->assign('site_name' , $this->smartyanytime['site']['site_name']);
		$this->smarty->assign('title' , $this->smartyanytime['site']['title']);
		$this->smarty->assign('keywords' , $this->smartyanytime['site']['keywords']);
		$this->smarty->assign('description' , $this->smartyanytime['site']['description']);

		$this->smarty->assign('image_url' , $wwwroot.IMAGE_DIR);
		$this->smarty->assign('file_url' , $wwwroot.FILE_DIR);
		$this->smarty->assign( 'magic' , '?'.time());

		$this->_setLoginFlag();
	}

	function _setLoginFlag() {
		define('LOGIN_FLAG', $this->_checkLogin());
	}

	function _checkLogin() {
		if(!$_COOKIE['CakeCookie']['alc']) return false;

		// CAKEセッションデータの取得
		$query = mysql_query('SELECT data, expires FROM '.DB_PREFIX.'cake_sessions WHERE SHA1(id)="'.mysql_real_escape_string($_COOKIE['CakeCookie']['alc']).'";');
		if (mysql_errno() != 0) return false;
		if (mysql_num_rows($query) == 0) return false;

		$sessionData = mysql_fetch_assoc($query);
		// セッションへ設定
		if(!isset($_SESSION)) {
			session_start();
			$_SESSION = array(); // 初期化
		}

		$tmp = $_SESSION;

		session_decode($sessionData['data']);

		if(!$_SESSION['arms_product_cake']['User']['id'] || $sessionData['expires'] < time() || $_SESSION['loginUserAgent'] != sha1($_SERVER['HTTP_USER_AGENT'])) {
			$_SESSION = $tmp;
			return false;
		}

		$_SESSION = $tmp;
		return true;
	}

	/**
	 *  リスト表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_list($params, &$smarty) {

		$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
		$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$max = ($params['max'])?($params['max']):(10);
		$page_list = ($params['page_list'])?($params['page_list']):(5);
		$var_name = ($params['name'])?($params['name']):('default_list');
		$sort_order = ($params['sort_order'])?($params['sort_order']):(1);
		$sort_column = ($params['sort_column'])?($params['sort_column']):(4);
		$setting['link'] = ($params['link'])?($params['link']):($wwwroot.'/info/more.html');
		$setting['dl_class'] = ($params['dl_class'])?($params['dl_class']):('list');
		$setting['dt_class'] = ($params['dt_class'])?($params['dt_class']):('listday');
		$setting['dd_class'] = ($params['dd_class'])?($params['dd_class']):('listtext');
		$move = (isset($params['move'])!==false)?($params['move']):(true);
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_LIST_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// ページ遷移をしない場合はpageを1へ
		if(!$move) $_GET['p'] = 1;

		// smarty出力用IDを設定
		$output_name = $var_name.'_list_';
		$output_name .= $smarty->smartyanytime['info']['real_path'];

		// 値をアサイン
		$this->assign('default_list_setting',$setting);

		// リストを設定
		$cms->setList( $c_id , $max , $var_name ,$page_list , $sort_order , $sort_column );

		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  リスト用データのセット
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_setlist($params, &$smarty) {

		$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
		$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$max = ($params['max'])?($params['max']):(10);
		$page_list = ($params['page_list'])?($params['page_list']):(5);
		$var_name = ($params['name'])?($params['name']):('default_list');
		$sort_order = ($params['sort_order'])?($params['sort_order']):(1);
		$sort_column = ($params['sort_column'])?($params['sort_column']):(4);
		$move = (isset($params['move'])!==false)?($params['move']):(true);
		$preview = (isset($params['preview'])!==false)?($params['preview']):(true);

		if($_GET['p']) {
			$_GET['p'] = htmlentities($_GET['p'], ENT_QUOTES, 'UTF-8');
		}

		// ページ遷移をしない場合はpageを1へ
		if(!$move) $_GET['p'] = 1;

		// リストを設定
		$cms->setList( $c_id , $max , $var_name ,$page_list , $sort_order , $sort_column, $preview );

	}

	/**
	 *  ページ番号表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_pagelist($params, &$smarty) {

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		// 各値の基本値を設定
		$link = ($params['link'])?($params['link']):('index.html');
		$name = ($params['name'])?($params['name']):('default_list');
		$ul_id = ($params['ul_id'])?($params['ul_id']):('');

		// テンプレート変数から値を取得
		$list = $smarty->get_template_vars($name);

		// smarty出力用IDを設定
		$output_name = $name.'_pagelist_';
		$output_name .= $smarty->smartyanytime['info']['real_path'];
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_PAGELIST_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// 値をアサイン
		$smarty->assign('output_pagelist',$list['page_list']);
		$smarty->assign('output_pagelist_page',$list['page']);
		$this->assign('default_pagelist_setting',array('link'=>$link,'ul_id'=>$ul_id));

		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  詳細情報のセット(アサイン)
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_detail($params, &$smarty) {

		$dummy=array();
		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$category = ($params['category'])?($params['category']):(0);

		$_GET['d'] = htmlentities($_GET['d'], ENT_QUOTES, 'UTF-8');

		// リストを設定
		$cms->setDetail( $c_id, $category );

		print '';
	}

	/**
	 *  詳細画面-画像表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_images($params, &$smarty) {

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		// 各値の基本値を設定
		$setting['name'] = ($params['name'])?($params['name']):('default_imagelist');
		$setting['width'] = ($params['width'])?($params['width']):('100');
		$setting['height'] = ($params['height'])?($params['height']):('100');
		$setting['func'] = ($params['func'])?($params['func']):('2');
		$setting['ul_class'] = ($params['ul_class'])?($params['ul_class']):('image_ul');
		$setting['li_class'] = ($params['li_class'])?($params['li_class']):('image_li');
		$setting['li_class_last'] = ($params['li_class_last'])?($params['li_class_last']):('image_last');
		$setting['rel'] = ($params['rel'])?($params['rel']):('lightbox');
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_IMAGELIST_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// smarty出力用IDを設定
		$output_name = $name.'_imagelist_';
		$output_name .= $smarty->smartyanytime['info']['real_path'];

		// 値をアサイン
		$this->assign('default_imagelist_setting',$setting);

		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  詳細画面-添付ファイル表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_files($params, &$smarty) {

		$dummy=array();
		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		// 各値の基本値を設定
		$setting['name'] = ($params['name'])?($params['name']):('default_filelist');
		$setting['width'] = ($params['width'])?($params['width']):('40');
		$setting['height'] = ($params['height'])?($params['height']):('47');
		$setting['dl_class'] = ($params['dl_class'])?($params['dl_class']):('file_dl');
		$setting['dt_class'] = ($params['dt_class'])?($params['dt_class']):('file_dt');
		$setting['dd_class'] = ($params['dd_class'])?($params['dd_class']):('file_dd');
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_FILELIST_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// smarty出力用IDを設定
		$output_name = $name.'_filelist_';
		$output_name .= $smarty->smartyanytime['info']['real_path'];

		// 値をアサイン
		$this->assign('default_filelist_setting',$setting);

		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  アーカイブ年月表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_archives($params, &$smarty) {

		$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
		$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$var_name = ($params['name'])?($params['name']):('default_archives');
		$setting['link'] = ($params['link'])?($params['link']):($wwwroot.'/archives/index.html');
		$setting['ul_class'] = ($params['ul_class'])?($params['ul_class']):('archives_ul');
		$setting['li_class'] = ($params['li_class'])?($params['li_class']):('archives_li');
		$setting['li_class_last'] = ($params['li_class_last'])?($params['li_class_last']):('archives_li');
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_ARCHIVES_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// smarty出力用IDを設定
		$output_name = $var_name.'_archives_';

		// 値をアサイン
		$this->assign('default_archives_setting',$setting);

		// リストを設定
		$cms->setArchives( $c_id , $var_name );

		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  アーカイブ別リスト表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_archives_list($params, &$smarty) {

		$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
		$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		$yearmonth = isset($_GET['a'])?($_GET['a']):('');

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$max = ($params['max'])?($params['max']):(10);
		$page_list = ($params['page_list'])?($params['page_list']):(5);
		$var_name = ($params['name'])?($params['name']):('default_archives_list');
		$sort_order = ($params['sort_order'])?($params['sort_order']):(1);
		$sort_column = ($params['sort_column'])?($params['sort_column']):(4);
		$yearmonth = ($params['date'])?($params['date']):($yearmonth);
		$notdata = (isset($params['notdata'])===true)?($params['notdata']):(false); // trueで件数無しを許可
		$setting['link'] = ($params['link'])?($params['link']):($wwwroot.'/info/more.html');
		$setting['dl_class'] = ($params['dl_class'])?($params['dl_class']):('list');
		$setting['dt_class'] = ($params['dt_class'])?($params['dt_class']):('listday');
		$setting['dd_class'] = ($params['dd_class'])?($params['dd_class']):('listtext');
		$move = (isset($params['move'])!==false)?($params['move']):(true);
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_LIST_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// ページ遷移をしない場合はpageを1へ
		if(!$move) $_GET['p'] = 1;

		// 年月が正しくなかったら404へ
		if(!preg_match('/^(2[0-9]{3})([0-9]{2})$/',$yearmonth) ) {
			$cms->output404Error();
		}

		// 件数を取得して１件もなかったら404へ
		if(!$notdata && $cms->getDocumentArchivesNam ( $c_id ,$yearmonth )==0) {
			$cms->output404Error();
		}

		// smarty出力用IDを設定
		$output_name = $var_name.'_list_';
		$output_name .= $smarty->smartyanytime['info']['real_path'];

		// 値をアサイン
		$this->assign('default_list_setting',$setting);

		// リストを設定
		$cms->setListArchives( $c_id , $max , $var_name ,$page_list , $sort_order , $sort_column , $yearmonth );

		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  アーカイブ別リストデータのセット
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_setarchives_list($params, &$smarty) {

		$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
		$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];

		$yearmonth = isset($_GET['a'])?($_GET['a']):('');

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$max = ($params['max'])?($params['max']):(10);
		$page_list = ($params['page_list'])?($params['page_list']):(5);
		$var_name = ($params['name'])?($params['name']):('default_archives_list');
		$sort_order = ($params['sort_order'])?($params['sort_order']):(1);
		$sort_column = ($params['sort_column'])?($params['sort_column']):(4);
		$yearmonth = ($params['date'])?($params['date']):($yearmonth);
		$notdata = (isset($params['notdata'])===true)?($params['notdata']):(false); // trueで件数無しを許可
		$move = (isset($params['move'])!==false)?($params['move']):(true);

		// ページ遷移をしない場合はpageを1へ
		if(!$move) $_GET['p'] = 1;

		// 年月が正しくなかったら404へ
		if(!preg_match('/^(2[0-9]{3})([0-9]{2})$/',$yearmonth) ) {
			$cms->output404Error();
		}

		// 件数を取得して１件もなかったら404へ
		if(!$notdata && $cms->getDocumentArchivesNam ( $c_id ,$yearmonth )==0) {
			$cms->output404Error();
		}

		// リストを設定
		$cms->setListArchives( $c_id , $max , $var_name ,$page_list , $sort_order , $sort_column , $yearmonth );

	}

	/**
	 *  アーカイブ選択年月
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_archives_date($params, &$smarty) {

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];

		$yearmonth = isset($_GET['a'])?($_GET['a']):('');
		if( !preg_match('@^2[0-9]{5}$@',$yearmonth) ) {
			$cms->output404Error();
		}

		$year = substr($yearmonth,0,4);
		$month = substr($yearmonth,4);

		$date = $year .'/'.$month.'/01';

		$format = ($params['format'])?($params['format']):('Y年m月');

		print date($format,strtotime($date));
	}

	/**
	 *  ドキュメントカテゴリー表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_categories($params, &$smarty) {

		$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
		$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$var_name = ($params['name'])?($params['name']):('default_categories');
		$setting['link'] = ($params['link'])?($params['link']):($wwwroot.'/categories/index.html');
		$setting['ul_class'] = ($params['ul_class'])?($params['ul_class']):('categories_ul');
		$setting['li_class'] = ($params['li_class'])?($params['li_class']):('categories_li');
		$setting['li_class_last'] = ($params['li_class_last'])?($params['li_class_last']):('categories_li');
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_CATEGORIES_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// smarty出力用IDを設定
		$output_name = $var_name.'_categories_';

		// 値をアサイン
		$this->assign('default_categories_setting',$setting);

		// リストを設定
		$cms->setCategories( $c_id , $var_name );

		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  ドキュメントカテゴリー別リスト表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_categories_list($params, &$smarty) {

		$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
		$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		$id = isset($_GET['c'])?($_GET['c']):('');
		if($id && (!is_numeric($id) || !is_int($id*1))) $cms->redirectTop();
		if( (string)$id !== (string)(int)$id ) $cms->redirectTop();

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$max = ($params['max'])?($params['max']):(10);
		$page_list = ($params['page_list'])?($params['page_list']):(5);
		$var_name = ($params['name'])?($params['name']):('default_categories_list');
		$sort_order = ($params['sort_order'])?($params['sort_order']):(1);
		$sort_column = ($params['sort_column'])?($params['sort_column']):(4);
		$id = ($params['category'])?($params['category']):($id);
		$notdata = (isset($params['notdata'])===true)?($params['notdata']):(false); // trueで件数無しを許可
		$setting['link'] = ($params['link'])?($params['link']):($wwwroot.'/info/more.html');
		$setting['dl_class'] = ($params['dl_class'])?($params['dl_class']):('list');
		$setting['dt_class'] = ($params['dt_class'])?($params['dt_class']):('listday');
		$setting['dd_class'] = ($params['dd_class'])?($params['dd_class']):('listtext');
		$move = (isset($params['move'])!==false)?($params['move']):(true);
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_LIST_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// IDが無かったら４０４へ
		if(!$id) $cms->output404Error();

		// ドキュメントカテゴリー名を取得出来なかったら４０４へ
		$name = $cms->getCategoryName( $c_id , $id );
		if(!$name) $cms->output404Error();

		// ページ遷移をしない場合はpageを1へ
		if(!$move) $_GET['p'] = 1;

		// 件数がないことを許可してなく、件数を取得して１件もなかったら404へ
		if(!$notdata && !$cms->getDocumentCategoriesNam($c_id,$id)) {
			$cms->output404Error();
		}

		// smarty出力用IDを設定
		$output_name = $var_name.'_list_';
		$output_name .= $smarty->smartyanytime['info']['real_path'];

		// 値をアサイン
		$this->assign('default_list_setting',$setting);
		$this->assign('id',$id);

		// リストを設定
		$cms->setListCategories( $c_id , $max , $var_name ,$page_list , $sort_order , $sort_column , $id );

		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  ドキュメントカテゴリー別リストのデータをセット
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_setcategories_list($params, &$smarty) {

		$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
		$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];

		$id = isset($_GET['c'])?($_GET['c']):('');
		if($id && (!is_numeric($id) || !is_int($id*1))) $cms->redirectTop();
		if( (string)$id !== (string)(int)$id ) $cms->redirectTop();

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$max = ($params['max'])?($params['max']):(10);
		$page_list = ($params['page_list'])?($params['page_list']):(5);
		$var_name = ($params['name'])?($params['name']):('default_categories_list');
		$sort_order = ($params['sort_order'])?($params['sort_order']):(1);
		$sort_column = ($params['sort_column'])?($params['sort_column']):(4);
		$id = ($params['category'])?($params['category']):($id);
		$notdata = (isset($params['notdata'])===true)?($params['notdata']):(false); // trueで件数無しを許可
		$move = (isset($params['move'])!==false)?($params['move']):(true);

		// IDが無かったら４０４へ
		if(!$id) $cms->output404Error();

		// ドキュメントカテゴリー名を取得出来なかったら４０４へ
		$name = $cms->getCategoryName( $c_id , $id );
		if(!$name) $cms->output404Error();

		// ページ遷移をしない場合はpageを1へ
		if(!$move) $_GET['p'] = 1;

		// 件数がないことを許可してなく、件数を取得して１件もなかったら404へ
		if(!$notdata && !$cms->getDocumentCategoriesNam($c_id,$id)) {
			$cms->output404Error();
		}

		// 値をアサイン
		$this->assign('id',$id);

		// リストを設定
		$cms->setListCategories( $c_id , $max , $var_name ,$page_list , $sort_order , $sort_column , $id );

	}

	/**
	 *  ドキュメントカテゴリー名
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_categories_name($params, &$smarty) {

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];

		$id = isset($_GET['c'])?($_GET['c']):('');
		if($id && (!is_numeric($id) || !is_int($id*1))) $cms->redirectTop();
		if( (string)$id !== (string)(int)$id ) $cms->redirectTop();

		// 各値の基本値を設定
		$id = ($params['category'])?($params['category']):($id);
		$c_id = ($params['id'])?($params['id']):(1);
		$output = ($params['output']===false)?(false):(true);

		// IDが無かったら404へ
		if(isset($id)===false) $cms->output404Error();

		if($id==0) {
			print'';
			$this->assign('cms_categories_name','');
		}
		else {
			$name = $cms->getCategoryName( $c_id , $id );
			if($output) {
				print $name;
			}
			else {
				$this->assign('cms_categories_name',$name);
			}
		}
	}

	/**
	 *  ページ番号アーカイブ用表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_archives_pagelist($params, &$smarty) {

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		$ym = isset($_GET['a'])?($_GET['a']):('');

		// 各値の基本値を設定
		$link = ($params['link'])?($params['link']):('index.html');
		$name = ($params['name'])?($params['name']):('default_archives_list');
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_ARCHIVES_PAGELIST_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// 年月が正しくなかったら404へ
		if( !preg_match('/^(2[0-9]{3})([0-9]{2})$/',$ym) ) {
			$cms->output404Error();
		}

		// テンプレート変数から値を取得
		$list = $smarty->get_template_vars($name);

		// smarty出力用IDを設定
		$output_name = $name.'_pagelist_';
		$output_name .= $smarty->smartyanytime['info']['real_path'];

		// 値をアサイン
		$this->assign('ym',$ym);
		$smarty->assign('output_pagelist',$list['page_list']);
		$smarty->assign('output_pagelist_page',$list['page']);
		$this->assign('default_pagelist_setting',array('link'=>$link));


		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  ページ番号ドキュメントカテゴリー用表示
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_categories_pagelist($params, &$smarty) {

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];
		$pages_obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

		$id = isset($_GET['c'])?($_GET['c']):('');
		if($id && (!is_numeric($id) || !is_int($id*1))) $cms->redirectTop();
		if( (string)$id !== (string)(int)$id ) $cms->redirectTop();

		// 各値の基本値を設定
		$id = ($params['category'])?($params['category']):($id);
		$link = ($params['link'])?($params['link']):('index.html');
		$name = ($params['name'])?($params['name']):('default_categories_list');
		$file = ($params['file'])?($params['file']):($cms->setTemplate(DEFAULT_CATEGORIES_PAGELIST_TEMPLATE));
		$parts_id = ($params['parts'])?($params['parts']):('');

		// IDが無かったら４０４へ
		if(!$id) $cms->output404Error();

		// テンプレート変数から値を取得
		$list = $smarty->get_template_vars($name);

		// smarty出力用IDを設定
		$output_name = $name.'_pagelist_';
		$output_name .= $smarty->smartyanytime['info']['real_path'];

		// 値をアサイン
		$this->assign('id',$id);
		$smarty->assign('output_pagelist',$list['page_list']);
		$smarty->assign('output_pagelist_page',$list['page']);
		$this->assign('default_pagelist_setting',array('link'=>$link));

		// 出力
		if($parts_id) {
			$parts = $pages_obj->_getPartsByID ( $parts_id );
			$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
		}
		else {
			$smarty->display('file:' . $file ,htmlentities($output_name),htmlentities($output_name));
		}
	}

	/**
	 *  前後のドキュメントIDを取得
	 *
	 *  @author H.Kobayashi
	 *  @param mix $params パラメータ
	 *  @param obj $smarty smartyオブジェクト
	 */
	function cms_prevnext($params, &$smarty) {

		$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplecms'];

		// 各値の基本値を設定
		$c_id = ($params['id'])?($params['id']):(1);
		$sort_order = ($params['sort_order'])?($params['sort_order']):(1);
		$sort_column = ($params['sort_column'])?($params['sort_column']):(4);
		$category = ($params['category'])?($params['category']):(0);

		// ドキュメントID取得
		$d_id = isset( $_GET['d'] ) ? ( $_GET['d'] ) : ( 0 );
		if(!is_numeric($d_id) || !is_int($d_id*1)) $cms->redirectTop();
		if( (string)$d_id !== (string)(int)$d_id ) $cms->redirectTop();
		if( $d_id <= 0 ) $cms->redirectTop();

		// 一つ前のドキュメントIDを取得
		$prev_id = $cms->_getPrev( $c_id , $d_id , $category , $sort_order , $sort_column );
		$prev_id = (!$prev_id)?(''):($prev_id);

		// 次のドキュメントIDを取得
		$next_id = $cms->_getNext( $c_id , $d_id , $category , $sort_order , $sort_column );
		$next_id = (!$next_id)?(''):($next_id);


		$this->assign('prev_id',$prev_id);
		$this->assign('next_id',$next_id);
	}

	// -----------------------------------------------------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------------------------------------------------

	/**
	 *  Smartyへアサイン
	 *
	 *  @author H.Kobayashi
	 *  @param string $name アサイン名
	 *  @param mix $value アサイン値
	 *  @param bool $flag エンティティ処理フラグ
	 *  @return bool 処理結果
	 */
	function assign($name,$value,$flag=true ) {
		if( $flag==true ) {
			$value = smartyanytime_util::htmlentitiesExtend( $value , 'utf-8' );
			$value = smartyanytime_util::replaceExtend( "\\\\" , "￥" ,$value );
		}

		// 携帯だったらSJIS変換
		if($this->smartyanytime['info']['mobile'] && !$this->smartyanytime['info']['smartphone']) mb_convert_variables( 'SJIS-win' , 'utf-8' , $value );

		$this->smarty->assign($name,$value);
	}

	/**
	 *  サイトのトップへリダイレクト
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 */
	function redirectTop() {

		$wwwroot = $this->smartyanytime['info']['wwwroot'];
		$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

		header('Location: '.$wwwroot.'/');
		exit();
	}

	/**
	 *  404エラーページ表示
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 */
	function output404Error() {

		$smartyanytime = $this->smartyanytime;

		// 404リダイレクトが許可されていない場合はトップへ
		if(!USE_CMS_REDIRECT404) {
			$this->redirect($smartyanytime['site']['site_url']);
		}

		if($smartyanytime['info']['template_resource']=='file') {
			if(!$smartyanytime['site']['page_404error'] || !file_exists($smartyanytime['info']['template_404']) ) {
				die('Not Found. 404');
			}
		}

		header('Location: '.rtrim($smartyanytime['site']['site_url'],'/').$smartyanytime['site']['page_404error']);
		exit();

	}

	/**
	 *  リダイレクト処理
	 *
	 *  @author H.Kobayashi
	 *  @param $url
	 *  @access public
	 */
	function redirect($url) {

		// ルートセット
		$wwwroot = ($this->smartyanytime['info']['wwwroot']=='/')?(''):($this->smartyanytime['info']['wwwroot']);

		// プロトコル除去
		$urlTmp = preg_replace('@^https?://@','',$url);
		if(preg_match('@(.*[^/])$@', $urlTmp) == 1 ) $urlTmp = $urlTmp.'/';

		// スラッシュ付与
		$checkUrl1 = $this->smartyanytime['info']['host'].$wwwroot.$this->smartyanytime['info']['url'];
		$path1 = pathinfo($checkUrl1);
		if(preg_match('@(.*[^/])$@', $path1['dirname']) == 1 ) $path1['dirname'] = $path1['dirname'].'/';

		// ルートと同じURLなら中止
		if($checkUrl1 == $urlTmp || $path1['dirname'] == $urlTmp) exit();

		$checkUrl2 = $wwwroot.$this->smartyanytime['info']['url'];
		$path2 = pathinfo($checkUrl2);
		if(preg_match('@(.*[^/])$@', $path2['dirname']) == 1 ) $path2['dirname'] = $path2['dirname'].'/';

		// ルートと同じパスなら中止
		if($checkUrl2 == $urlTmp || $path2['dirname'] == $urlTmp) exit();

		header("Location: ".$url);
		exit();
	}

	/**
	 *  テンプレート名の設定（携帯対応）
	 *
	 *  @author H.Kobayashi
	 *  @param string $file テンプレートファイルパス
	 *  @return string テンプレートファイルパス
	 */
	function setTemplate($file) {

		// 携帯だったらSJIS変換
		if(!$this->smartyanytime['info']['mobile']) return $file;

		$path = pathinfo($file);

		$tpl_path = $path['dirname'].'/'.$this->smartyanytime['data']['mobile']['prefix'].$path['basename'];

		if( file_exists($tpl_path) ) {
			$tpl_path = $path['dirname'].'/'.$this->smartyanytime['data']['mobile']['prefix'].$path['basename'];
		}
		else {
			$tpl_path = $path['dirname'].'/mb_'.$path['basename'];
		}

		return $tpl_path;
	}

	/**
	 *  ドキュメントリスト情報を設定
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $listmax リストの最大数
	 *  @param string $var_name リストの名称
	 *  @param int $pagelist_max ページリストの最大数
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートするカラム
	 *  @param bool $preview プレビュー許可フラグ
	 */
	function setList( $c_id=1 , $listmax=10 , $var_name='default_list' ,$pagelist_max=5 , $sort_order=1 , $sort_column=4, $preview=true ) {
		// リスト表示
		$this->_setcmslist( $c_id , $listmax , $var_name ,$pagelist_max , $sort_order , $sort_column, $preview );
	}

	/**
	 *  ドキュメントリスト情報を設定コア
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $c_id カテゴリーID
	 *  @param int $listmax リストの最大数
	 *  @param string $var_name リストの名称
	 *  @param int $pagelist_max ページリストの最大数
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートするカラム
	 *  @return array ドキュメント情報
	 *  @param bool $preview プレビュー許可フラグ
	 */
	function _setcmslist( $c_id , $listmax , $var_name ,$pagelist_max , $sort_order , $sort_column, $preview ) {

		$output = array();
		$pagelist = array();

		////////////////////////////////////////////////
		// リスト表示処理
		///////////////////////////////////////////////

		// ページを受け取る
		$page = ( isset( $_GET['p'] ) !== true ) ? ( 1 ) : ( $_GET['p'] );

		// チェック
		if( is_numeric( $page ) === false ) $this->redirectTop();
		if( is_int( $page * 1 ) === false ) $this->redirectTop();
		if( (string)$page !== (string)(int)$page ) $this->redirectTop();
		$page = ( $page <= 0 ) ? ( 1 ) : ( $page );

		$page = $page * 1;

		// プレビューか実表示か
		if($_GET['pre']==1 && $_COOKIE['CakeCookie']['alc'] && $preview && LOGIN_FLAG) { // プレビュー

			// プレビュー用に値設定
			$page = 1;
			$end_page = 1;
			$start_page = 1;
			$pagelist[] = 1;
			$start = 1;
			$end = 1;
			$maxcount = 1;

			$d_data[0]['c_id'] = $c_id;
			$d_data[0]['d_id'] = '';
			$d_data[0]['title'] = $_POST['data']['Cmsdocument']['title'];
			$d_data[0]['explanation'] = $_POST['data']['Cmsdocument']['explanation'];
			$d_data[0]['start_date'] = ($_POST['data']['Cmsdocument']['period'] && $_POST['data']['Cmsdocument']['start_date'])?($_POST['data']['Cmsdocument']['start_date']):('0000-00-00 00:00:00');
			$d_data[0]['end_date'] = ($_POST['data']['Cmsdocument']['period'] && $_POST['data']['Cmsdocument']['end_date'])?($_POST['data']['Cmsdocument']['end_date']):('0000-00-00 00:00:00');
			$d_data[0]['release_date'] = ($_POST['data']['Cmsdocument']['createdate'])?($_POST['data']['Cmsdocument']['createdate']):(date('Y-m-d H:i:s'));
			$d_data[0]['create_date'] = ($_POST['data']['Cmsdocument']['createdate'])?($_POST['data']['Cmsdocument']['createdate']):(date('Y-m-d H:i:s'));
			$d_data[0]['edit_date'] = date('Y-m-d H:i:s');
			$d_data[0]['category'] = ($_POST['data']['Cmsdocument']['category'])?($_POST['data']['Cmsdocument']['category']):(0);

			if($_POST['data']['Cmsdocument']['directlink']) {
				$d_data[0]['directlink'] = $_POST['data']['Cmsdocument']['directlink'];
				$d_data[0]['directlink_type'] = 'url';
			}
			elseif($_POST['data']['Cmsdocument']['directlink2']) {
				$d_data[0]['directlink'] = $_POST['data']['Cmsdocument']['directlink2'];
				$d_data[0]['directlink_type'] = 'file';
			}
		}
		else { // 実表示

			// ドキュメント数を取得
			$max = $this->getDocumentNam ( $c_id );
			if ( $max === false ) $this->redirectTop();

			// 最大ページ数取得
			$page_max = ceil($max / $listmax);
			if( $page_max == 0 ) $page_max = 1;

			// 現在ページの調整
			$page = ( $page > $page_max ) ? ( $page_max ) : ( $page );

			// 前後ページ
			$prev_page = ( ( $page - 1 ) < 1 ) ? ( 1 ) : ( $page - 1 );
			$next_page = ( ( $page + 1 ) > $page_max ) ? ( $page_max ) : ( $page + 1 );

			///////////////////////////
			// リストでも作ってみる
			//////////////////////////

			if( $max != 0 ) {
				$page_max = ceil($max/$listmax);

				$page = ( $page > $page_max ) ? ( $page_max ) : ( $page );

				$end_page = $page_max;
				if( $page_max > $pagelist_max ) {
					if( ($page+2) > $pagelist_max ) {
						$end_page = $page + 2;
					}
					else {
						$end_page = $pagelist_max;
					}
				}
			}
			else {
				$page_max = 0;
				$end_page =0;
			}

			$end_page = ( $end_page > $page_max ) ? ( $page_max ) : ( $end_page );
			$start_page = $end_page - ($pagelist_max -1 );
			$start_page = ( $start_page < 1 ) ? ( 1 ) : ( $start_page );

			// リスト制作
			for( $i = $start_page ; $i <= $end_page ; $i++ ) {
				$pagelist[] = $i;
			}

			// オフセット設定
			$start = ( ( $page * $listmax ) - $listmax );
			$end = $listmax;

			// ドキュメントデータを取得
			$result = $this->getDocumentData ( $c_id , $start , $end , $d_data , $sort_order , $sort_column );
			if ( $result == false ) $this->redirectTop();

			// 件数取得
			$maxcount = count( $d_data );
		}

		// リスト部分生成
		for( $i=0 ; $i<$maxcount ; $i++ ) {

			$output[$i][ 'ID' ]          = $d_data[$i]['d_id'];
			$output[$i][ 'TITLE' ]       = $d_data[$i]['title'];
			$output[$i][ 'EXPLANATION' ] = $d_data[$i]['explanation'];
			$output[$i][ 'START_DATE' ] = ( $d_data[$i]['start_date'] == '0000-00-00 00:00:00' || $d_data[$i]['start_date'] == '1970-01-01 00:00:00' ) ? ( '' ):( date( 'Y/m/d' , strtotime($d_data[$i]['start_date'] ) ) );
			$output[$i][ 'END_DATE' ]   = ( $d_data[$i]['end_date'] == '0000-00-00 00:00:00' || $d_data[$i]['end_date'] == '2037-12-31 23:59:59' ) ? ( '' ):( date( 'Y/m/d' , strtotime($d_data[$i]['end_date'] ) ) );
			$output[$i][ 'RELEASE_DATE' ] = date( 'Y/m/d H:i:s' , strtotime($d_data[$i]['release_date']));
			$output[$i][ 'CREATE_DATE' ] = date( 'Y/m/d H:i:s' , strtotime($d_data[$i]['create_date']));
			$output[$i][ 'EDIT_DATE' ]   = date( 'Y/m/d H:i:s' , strtotime($d_data[$i]['edit_date']));
			$output[$i][ 'CATEGORY' ]    = $d_data[$i]['category'];
			$output[$i][ 'DIRECTLINK' ]= $d_data[$i]['directlink'];
			$output[$i][ 'DIRECTLINK_TYPE' ]= $d_data[$i]['directlink_type'];

			// アイテム取得
			$result = $this->getItem( $d_data[$i]['c_id'] , $i_data);
			if ( $result == false ) $this->redirectTop();

			// アイテムデータ取得
			if($_GET['pre']==1 && $_COOKIE['CakeCookie']['alc'] && $preview && LOGIN_FLAG)  { // プレビュー対応
				foreach( $_POST['data']['Cmsdocument'] as $key=>$value) {
					if($key!= 'mode' && $key!= 'explanation' && $key!= 'use_category' && $key!= 'start_date' && $key!= 'end_date' &&
						$key!= 'title' && $key!= 'disable' && $key!= 'period' && $key!= 'directlink' && $key!= 'directlink2' &&
						$key!= 'createdate' && $key!= 'create_h' && $key!= 'create_m' && $key!= 'create_s' ) {
						$contents_data[strtoupper($key)] = $value;
					}
				}
			}
			else {
				$result = $this->getItemData( $d_data[$i]['d_id'] , $contents_data);
				if ( $result == false ) $this->redirectTop();
			}

			if($_GET['pre']==1 && $_COOKIE['CakeCookie']['alc'] && $preview && LOGIN_FLAG)  { // プレビュー対応
				foreach( $i_data as $key=>$value) {
					if($contents_data[$value['variable_name']]) {
						if(is_array($contents_data[$value['variable_name']])) $contents_data[$value['variable_name']] = implode(',', $contents_data[$value['variable_name']]);
						if($value['type']!=2) {
							$output[$i][ $value['variable_name'] ] = htmlentities($contents_data[$value['variable_name']],ENT_QUOTES,'UTF-8');
						}
						else {
							$output[$i][ $value['variable_name'] ] = $contents_data[$value['variable_name']];
						}
					}
				}
			}
			else {
				// アイテムデータ分繰り返す
				for( $d=0 ; $d<count( $contents_data ) ; $d++ ) {
					// テキストエリア以外には実態参照へ
					if( $i_data[$contents_data[$d]['i_id']]['type'] !=ITEM_TYPE_TEXTAREA ) {
						$output[$i][ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = htmlentities($contents_data[$d]['value'],ENT_QUOTES,'UTF-8');
					}
					else {
						if(USE_TINYMCE) {
							$contents_data[$d]['value'] = preg_replace( '@(<div>)(.+?)(</div>)@is' , '<br/>$2' , $contents_data[$d]['value'] );
							$contents_data[$d]['value'] = preg_replace( '@<div>@is' , '<br/>' , $contents_data[$d]['value'] );
							$contents_data[$d]['value'] = preg_replace( '@</div>@is' , '' , $contents_data[$d]['value'] );
							$contents_data[$d]['value'] = str_replace('<p>' , '' , $contents_data[$d]['value'] );
							$contents_data[$d]['value'] = str_replace('</p>' , '' , $contents_data[$d]['value']);
							$output[$i][ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = $contents_data[$d]['value'];
						}
						else {
							$output[$i][ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = $contents_data[$d]['value'];
						}
					}
				}
			}
		}

		$outlist['page_list'] = $pagelist;
		$outlist['page'] = $page;
		$outlist['maxpage'] = $end_page;
		$outlist['list'] = $output;

		// 携帯だったらSJIS変換
		if($this->smartyanytime['info']['mobile'] && !$this->smartyanytime['info']['smartphone']) mb_convert_variables( 'SJIS-win' , 'utf-8' , $outlist , $output );

		$this->smarty->assign($var_name , $outlist);
		$this->smarty->assign('output_list' , $output);

		return $output;
	}

	/**
	 *  ドキュメント数取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @return mix ドキュメント数,false
	 */
	function getDocumentNam ( $c_id ) {

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );

		// カテゴリID複数対応
		$a_cid = explode( ',' , $c_id );
		if( count( $a_cid ) != 1 ) {
			$cid_sql = ' c_id = "' . implode ( '" OR c_id = "' , $a_cid ) . '"';
		}
		else {
			$cid_sql = ' c_id = "' . $a_cid[0] . '"';
		}

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT * FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND " .
				" ( " .
				"period_flag = 0 OR " .
				" ( " .
				"period_flag = 1 AND " .
				"start_date <= '" . $now_datetime . "' AND ".
				"end_date   >= '" . $now_datetime . "' ".
				" ) " .
				" ) AND " .
				"disable = 0 AND " .
				"delete_flag = 0 ";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;

		return mysql_num_rows ( $query );
	}

	/**
	 *  ドキュメントリスト取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $start 取得開始位置
	 *  @param int $end 取得数
	 *  @param int $data ドキュメントデータ(参照渡)
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートするカラム
	 *  @return bool 処理結果
	 */
	function getDocumentData ( $c_id , $start , $end , &$data , $sort_order=1,$sort_column=4 ) {

		$data = array();

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );
		$start = mysql_real_escape_string( $start );
		$end = mysql_real_escape_string( $end );

		// カテゴリID複数対応
		$a_cid = explode( ',' , $c_id );
		if( count( $a_cid ) != 1 ) {
			$cid_sql = ' c_id = "' . implode ( '" OR c_id = "' , $a_cid ) . '"';
		}
		else {
			$cid_sql = ' c_id = "' . $a_cid[0] . '"';
		}

		// ソートを指定する
		$order = ( $sort_order == 1 ) ? ( $order = " DESC " ) : ( $order = " ASC " ); // 昇順降順
		$sort = "";
		switch ( $sort_column ) {
			case 0: // ドキュメントID
				$sort ="ORDER BY d_id " . $order;
				break;
			case 1: // 作成日
				$sort ="ORDER BY create_date " . $order . " , d_id " . $order;
				break;
			case 2: // 更新日
				$sort ="ORDER BY edit_date " . $order . " , d_id " . $order;
				break;
			case 3: // 公開日時
				$sort ="ORDER BY release_date " . $order . " , d_id " . $order;
				break;
			case 4: // ソート
				$sort ="ORDER BY sort " . $order . " , release_date " . $order;
				break;
			case 5: // 公開開始日
				$sort ="ORDER BY start_date " . $order . " , d_id " . $order;
				break;
			case 6: // 公開終了日
				$sort ="ORDER BY end_date " . $order . " , d_id " . $order;
				break;
			default:
				$sort ="ORDER BY d_id " . $order;
				break;
		}

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT * FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND " .
				" ( " .
				"period_flag = 0 OR " .
				" ( " .
				"period_flag = 1 AND " .
				"start_date <= '" . $now_datetime . "' AND ".
				"end_date   >= '" . $now_datetime . "' ".
				" ) " .
				" ) AND " .
				"disable = 0 AND " .
				"delete_flag = 0 " .
				$sort .
				"LIMIT " . $start . " , " . $end;

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return true;

		while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[] = $fetch;

		return true;
	}

	/**
	 *  ドキュメントカテゴリーリスト情報を設定
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $listmax リストの最大数
	 *  @param string $var_name リストの名称
	 *  @param int $pagelist_max ページリストの最大数
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートするカラム
	 *  @param int $id ドキュメントカテゴリーID
	 */
	function setListCategories( $c_id=1 , $listmax=10 , $var_name='default_list' ,$pagelist_max=5 , $sort_order=1 , $sort_column=4 , $id='' ) {
		// リスト表示
		$this->_setListCategories( $c_id , $listmax , $var_name ,$pagelist_max , $sort_order , $sort_column , $id );
	}

	/**
	 *  ドキュメントカテゴリーリスト情報を設定(コア)
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $c_id カテゴリーID
	 *  @param int $listmax リストの最大数
	 *  @param string $var_name リストの名称
	 *  @param int $pagelist_max ページリストの最大数
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートするカラム
	 *  @param int $id ドキュメントカテゴリーID
	 *  @return array ドキュメント情報 
	 */
	function _setListCategories( $c_id , $listmax , $var_name ,$pagelist_max , $sort_order , $sort_column , $id ) {

		$output = array();
		$pagelist = array();

		////////////////////////////////////////////////
		// リスト表示処理
		///////////////////////////////////////////////

		// ページを受け取る
		$page = ( isset( $_GET['p'] ) !== true ) ? ( 1 ) : ( $_GET['p'] );

		// チェック
		if( is_numeric( $page ) === false ) $this->redirectTop();
		if( is_int( $page * 1 ) === false ) $this->redirectTop();
		if( (string)$page !== (string)(int)$page ) $this->redirectTop();
		$page = ( $page <= 0 ) ? ( 1 ) : ( $page );

		// ドキュメント数を取得
		$max = $this->getDocumentCategoriesNam ( $c_id , $id );
		if ( $max === false ) $this->redirectTop();

		// 最大ページ数取得
		$page_max = ceil($max / $listmax);
		if( $page_max == 0 ) $page_max = 1;

		// 現在ページの調整
		$page = ( $page > $page_max ) ? ( $page_max ) : ( $page );

		// 前後ページ
		$prev_page = ( ( $page - 1 ) < 1 ) ? ( 1 ) : ( $page - 1 );
		$next_page = ( ( $page + 1 ) > $page_max ) ? ( $page_max ) : ( $page + 1 );

		///////////////////////////
		// リストでも作ってみる
		//////////////////////////

		if( $max != 0 ) {
			$page_max = ceil($max/$listmax);

			$page = ( $page > $page_max ) ? ( $page_max ) : ( $page );

			$end_page = $page_max;
			if( $page_max > $pagelist_max ) {
				if( ($page+2) > $pagelist_max ) {
					$end_page = $page + 2;
				}
				else {
					$end_page = $pagelist_max;
				}
			}
		}
		else {
			$page_max = 0;
			$end_page =0;
		}

		$end_page = ( $end_page > $page_max ) ? ( $page_max ) : ( $end_page );
		$start_page = $end_page - ($pagelist_max -1 );
		$start_page = ( $start_page < 1 ) ? ( 1 ) : ( $start_page );

		// リスト制作
		for( $i = $start_page ; $i <= $end_page ; $i++ ) {
			$pagelist[] = $i;
		}

		// オフセット設定
		$start = ( ( $page * $listmax ) - $listmax );
		$end = $listmax;

		// ドキュメントデータを取得
		$result = $this->getDocumentDataCategories ( $c_id , $start , $end , $d_data , $sort_order , $sort_column , $id );
		if ( $result == false ) $this->redirectTop();

		// 件数取得
		$maxcount = count( $d_data );

		// リスト部分生成
		for( $i=0 ; $i<$maxcount ; $i++ ) {
			$output[$i][ 'ID' ]          = $d_data[$i]['d_id'];
			$output[$i][ 'TITLE' ]       = $d_data[$i]['title'];
			$output[$i][ 'EXPLANATION' ] = $d_data[$i]['explanation'];
			$output[$i][ 'START_DATE' ] = ( $d_data[$i]['start_date'] == '0000-00-00 00:00:00' || $d_data[$i]['start_date'] == '1970-01-01 00:00:00' ) ? ( '' ):( date( 'Y/m/d' , strtotime($d_data[$i]['start_date'] ) ) );
			$output[$i][ 'END_DATE' ]   = ( $d_data[$i]['end_date'] == '0000-00-00 00:00:00' || $d_data[$i]['end_date'] == '2037-12-31 23:59:59' ) ? ( '' ):( date( 'Y/m/d' , strtotime($d_data[$i]['end_date'] ) ) );
			$output[$i][ 'RELEASE_DATE' ] = date( 'Y/m/d H:i:s' , strtotime($d_data[$i]['release_date']));
			$output[$i][ 'CREATE_DATE' ] = date( 'Y/m/d H:i:s' , strtotime($d_data[$i]['create_date']));
			$output[$i][ 'EDIT_DATE' ]   = date( 'Y/m/d H:i:s' , strtotime($d_data[$i]['edit_date']));
			$output[$i][ 'CATEGORY' ]    = $d_data[$i]['category'];
			$output[$i][ 'DIRECTLINK' ]= $d_data[$i]['directlink'];
			$output[$i][ 'DIRECTLINK_TYPE' ]= $d_data[$i]['directlink_type'];

			// アイテム取得
			$result = $this->getItem( $d_data[$i]['c_id'] , $i_data);
			if ( $result == false ) $this->redirectTop();

			// アイテムデータ取得
			$result = $this->getItemData( $d_data[$i]['d_id'] , $contents_data);
			if ( $result == false ) $this->redirectTop();

			// アイテムデータ分繰り返す
			for( $d=0 ; $d<count( $contents_data ) ; $d++ ) {
				// テキストエリア以外には実態参照へ
				if( $i_data[$contents_data[$d]['i_id']]['type'] !=ITEM_TYPE_TEXTAREA ) {
					$output[$i][ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = htmlentities($contents_data[$d]['value'],ENT_QUOTES,'UTF-8');
				}
				else {
					if(USE_TINYMCE) {
						$contents_data[$d]['value'] = preg_replace( '@(<div>)(.+?)(</div>)@is' , '<br/>$2' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = preg_replace( '@<div>@is' , '<br/>' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = preg_replace( '@</div>@is' , '' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = str_replace('<p>' , '' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = str_replace('</p>' , '' , $contents_data[$d]['value']);
						$output[$i][ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = $contents_data[$d]['value'];
					}
					else {
						$output[$i][ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = $contents_data[$d]['value'];
					}
				}
			}
		}

		$outlist['page_list'] = $pagelist;
		$outlist['page'] = $page;
		$outlist['maxpage'] = $end_page;
		$outlist['list'] = $output;

		// 携帯だったらSJIS変換
		if($this->smartyanytime['info']['mobile'] && !$this->smartyanytime['info']['smartphone']) mb_convert_variables( 'SJIS-win' , 'utf-8' , $outlist , $output );

		$this->smarty->assign($var_name , $outlist);
		$this->smarty->assign('output_list' , $output);

		return $output;
	}

	/**
	 *  ドキュメントカテゴリー名を取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $id ドキュメントカテゴリーID
	 *  @return string ドキュメントカテゴリー名
	 */
	// カテゴリー名を取得
	function getCategoryName ( $c_id , $id ) {

		$data = "";

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );
		$id   = mysql_real_escape_string( $id );

		$cid_sql = ' c_id = "' . $c_id . '"';

		$sql = "SELECT name FROM ".DB_PREFIX."cmsdoccategories WHERE c_id = '" . $c_id . "' AND id='" . $id ."' AND delete_flag='0';";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return "";
		if ( mysql_num_rows ( $query ) == 0 ) return "";

		$data = mysql_fetch_assoc ( $query );

		return $data['name'];
	}

	/**
	 *  カテゴリー用ドキュメント数取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $id ドキュメントカテゴリーID
	 *  @return mix ドキュメント数,false
	 */
	function getDocumentCategoriesNam ( $c_id ,$id='' ) {

		if(!$id) return false;

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );
		$id = mysql_real_escape_string( $id );

		// カテゴリID
		$cid_sql = ' c_id = "' . $c_id . '"';

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT d_id FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND ".
				" ( " .
				"period_flag = 0 OR " .
				" ( " .
				"period_flag = 1 AND " .
				"start_date <= '" . $now_datetime . "' AND ".
				"end_date   >= '" . $now_datetime . "' ".
				" ) " .
				" ) AND " .
				"disable = 0 AND " .
				"category = '".$id."' AND " .
				"delete_flag = 0 ";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;

		return mysql_num_rows ( $query );
	}

	/**
	 *  カテゴリー用ドキュメントリスト取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $start 取得開始位置
	 *  @param int $end 取得数
	 *  @param int $data ドキュメントデータ(参照渡)
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートするカラム
	 *  @param int $id ドキュメントカテゴリーID
	 *  @return bool 処理結果
	 */
	function getDocumentDataCategories ( $c_id , $start , $end , &$data , $sort_order=1,$sort_column=4,$id='' ) {

		$data = array();

		if(!$id) return false;

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );
		$start = mysql_real_escape_string( $start );
		$end = mysql_real_escape_string( $end );
		$id = mysql_real_escape_string( $id );

		// カテゴリID複数対応
			$cid_sql = ' c_id = "' . $c_id . '"';

		// ソートを指定する
		$order = ( $sort_order == 1 ) ? ( $order = " DESC " ) : ( $order = " ASC " ); // 昇順降順
		$sort = "";
		switch ( $sort_column ) {
			case 0: // ドキュメントID
				$sort ="ORDER BY d_id " . $order;
				break;
			case 1: // 作成日
				$sort ="ORDER BY create_date " . $order . " , d_id " . $order;
				break;
			case 2: // 更新日
				$sort ="ORDER BY edit_date " . $order . " , d_id " . $order;
				break;
			case 3: // 公開日時
				$sort ="ORDER BY release_date " . $order . " , d_id " . $order;
				break;
			case 4: // ソート
				$sort ="ORDER BY sort " . $order . " , release_date " . $order;
				break;
			case 5: // 公開開始日
				$sort ="ORDER BY start_date " . $order . " , d_id " . $order;
				break;
			case 6: // 公開終了日
				$sort ="ORDER BY end_date " . $order . " , d_id " . $order;
				break;
			default:
				$sort ="ORDER BY d_id " . $order;
				break;
		}

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT * FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND ".
				" ( " .
				"period_flag = 0 OR " .
				" ( " .
				"period_flag = 1 AND " .
				"start_date <= '" . $now_datetime . "' AND ".
				"end_date   >= '" . $now_datetime . "' ".
				" ) " .
				" ) AND " .
				"disable = 0 AND " .
				"category = '" . $id . "' AND " .
				"delete_flag = 0 " .
				$sort .
				"LIMIT " . $start . " , " . $end;

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return true;

		while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[] = $fetch;

		return true;
	}

	/**
	 *  詳細ページを設定
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $category ドキュメントカテゴリーID
	 */
	function setDetail( $c_id=1, $category=0 ) {
		// 詳細
		$this->_setDetail( $c_id, $category );
	}

	/**
	 *  詳細ページを設定
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $c_id カテゴリーID
	 *  @param int $category ドキュメントカテゴリーID
	 *  @return array ドキュメント情報 
	 */
	function _setDetail( $c_id, $category=0 ) {

		// ドキュメントID取得
		$d_id = isset( $_GET['d'] ) ? ( $_GET['d'] ) : ( 0 );
		if(!is_numeric($d_id) || !is_int($d_id*1)) $this->redirectTop();
		if( (string)$d_id !== (string)(int)$d_id ) $this->redirectTop();
		$d_id = $d_id * 1;
		if($_GET['pre']!=1) { // プレビュー対応
			if( $d_id <= 0 ) $this->redirectTop();
		}

		// ドキュメントを取得する
		if($_GET['pre']!=1) {
//			$result = $this->getDocumentDataByCD_ID( $c_id , $d_id , $d_data);
			$result = $this->getDocumentDataByCD_ID( $c_id, $category , $d_id , $d_data);
			if ( $result == false )  $this->redirectTop();
			if ( count( $d_data )==0 )  $this->redirectTop();
		}
		elseif($_GET['pre']==1 && $_COOKIE['CakeCookie']['alc'] && LOGIN_FLAG)  { // プレビュー対応
			$d_data['c_id'] = $c_id;
			$d_data['d_id'] = '';
			$d_data['title'] = $_POST['data']['Cmsdocument']['title'];
			$d_data['explanation'] = $_POST['data']['Cmsdocument']['explanation'];
			$d_data['start_date'] = ($_POST['data']['Cmsdocument']['period'] && $_POST['data']['Cmsdocument']['start_date'])?($_POST['data']['Cmsdocument']['start_date']):('0000-00-00 00:00:00');
			$d_data['end_date'] = ($_POST['data']['Cmsdocument']['period'] && $_POST['data']['Cmsdocument']['end_date'])?($_POST['data']['Cmsdocument']['end_date']):('0000-00-00 00:00:00');
			$d_data['release_date'] = ($_POST['data']['Cmsdocument']['createdate'])?($_POST['data']['Cmsdocument']['createdate']):(date('Y-m-d H:i:s'));
			$d_data['create_date'] = ($_POST['data']['Cmsdocument']['createdate'])?($_POST['data']['Cmsdocument']['createdate']):(date('Y-m-d H:i:s'));
			$d_data['edit_date'] = date('Y-m-d H:i:s');
			$d_data['category'] = ($_POST['data']['Cmsdocument']['category'])?($_POST['data']['Cmsdocument']['category']):(0);

			if($_POST['data']['Cmsdocument']['directlink']) {
				$d_data['directlink_type'] = 'url';
				$d_data['directlink'] = $_POST['data']['Cmsdocument']['directlink'];
			}
			elseif($_POST['data']['Cmsdocument']['directlink2']) {
				$d_data['directlink_type'] = 'file';
				$d_data['directlink'] = $_POST['data']['Cmsdocument']['directlink2'];
			}
		}
		else {
			$this->redirectTop();
		}

		// カテゴリー情報を取得
		$category_info = $this->_getCategoryInfo($d_data['c_id']);
		if(!$category_info) $this->redirectTop();

		// ダイレクトリンク処理
		if($d_data['directlink']) {
			if($d_data['directlink_type']=='url') {

				$wwwroot = ($this->smartyanytime['info']['wwwroot']=='/')?(''):($this->smartyanytime['info']['wwwroot']);
				$path = parse_url($this->smartyanytime['site']['site_url']);
				$site = $path['scheme'].'://'. $path['host'];

				if(preg_match('@^https?://@', $d_data['directlink'])==1) {
					header("Location: ".$d_data['directlink']);
				}
				else {
					header("Location: ".$site.$d_data['directlink']);
				}
			}
			else {
				if(!$category_info['use_filemanager']) {
					header("Location: ".$this->smartyanytime['site']['site_url'].FILE_DIR.'/'.$d_data['directlink']);
				}
				else {
					$url = 'http://'.$this->smartyanytime['info']['host'].$d_data['directlink'];
					header("Location: ".$url);
				}
			}
			exit();
		}

		$output = array();
		$output[ 'ID' ]          = $d_data['d_id'];
		$output[ 'TITLE' ]       = $d_data['title'];
		$output[ 'EXPLANATION' ] = $d_data['explanation'];
		$output[ 'START_DATE' ] = ( $d_data['start_date'] == '0000-00-00 00:00:00' || $d_data['start_date'] == '1970-01-01 00:00:00' ) ? ( '' ):( date( 'Y/m/d' , strtotime($d_data['start_date'] ) ) );
		$output[ 'END_DATE' ]   = ( $d_data['end_date'] == '0000-00-00 00:00:00' || $d_data['end_date'] == '2037-12-31 23:59:59' ) ? ( '' ):( date( 'Y/m/d' , strtotime($d_data['end_date'] ) ) );
		$output[ 'RELEASE_DATE' ] = date( 'Y/m/d H:i:s' , strtotime($d_data['release_date']));
		$output[ 'CREATE_DATE' ] = date( 'Y/m/d H:i:s' , strtotime($d_data['create_date']));
		$output[ 'EDIT_DATE' ]   = date( 'Y/m/d H:i:s' , strtotime($d_data['edit_date']));
		$output[ 'CATEGORY' ]    = $d_data['category'];

		// アイテム取得
		$result = $this->getItem( $d_data['c_id'] , $i_data);
		if ( $result == false )  $this->redirectTop();

		// アイテムデータを取得する
		if($_GET['pre']!=1) {
			$result = $this->getItemData($d_id , $contents_data);
			if ( $result == false )  $this->redirectTop();
		}
		elseif($_GET['pre']==1 && $_COOKIE['CakeCookie']['alc'] && LOGIN_FLAG)  { // プレビュー対応
			foreach( $_POST['data']['Cmsdocument'] as $key=>$value) {
				if($key!= 'mode' && $key!= 'explanation' && $key!= 'use_category' && $key!= 'start_date' && $key!= 'end_date' &&
					 $key!= 'title' && $key!= 'disable' && $key!= 'period' && $key!= 'directlink' && $key!= 'directlink2' &&
					 $key!= 'createdate' && $key!= 'create_h' && $key!= 'create_m' && $key!= 'create_s' ) {
					$contents_data[strtoupper($key)] = $value;
				}
			}
		}
		else {
			$this->redirectTop();
		}

		// アイテムの設定
		if($_GET['pre']!=1) {
			// アイテムデータ分繰り返す
			for( $d=0 ; $d<count( $contents_data ) ; $d++ ) {
				// テキストエリア以外には実態参照へ
				if( $i_data[$contents_data[$d]['i_id']]['type'] !=2 ) {
					$output[ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = htmlentities($contents_data[$d]['value'],ENT_QUOTES,'UTF-8');
				}
				else {
					if(USE_TINYMCE) {
						$contents_data[$d]['value'] = preg_replace( '@(<div>)(.+?)(</div>)@is' , '<br/>$2' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = preg_replace( '@<div>@is' , '<br/>' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = preg_replace( '@</div>@is' , '' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = str_replace('<p>' , '' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = str_replace('</p>' , '' , $contents_data[$d]['value']);
						$output[ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = $contents_data[$d]['value'];
					}
					else {
						$output[ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = $contents_data[$d]['value'];
					}
				}
			}
		}
		elseif($_GET['pre']==1 && $_COOKIE['CakeCookie']['alc'] && LOGIN_FLAG)  { // プレビュー対応
			foreach( $i_data as $key=>$value) {
				if($contents_data[$value['variable_name']]) {
					if(is_array($contents_data[$value['variable_name']])) $contents_data[$value['variable_name']] = implode(',', $contents_data[$value['variable_name']]);
					if($value['type']!=2) {
						$output[ $value['variable_name'] ] = htmlentities($contents_data[$value['variable_name']],ENT_QUOTES,'UTF-8');
					}
					else {
						$output[ $value['variable_name'] ] = $contents_data[$value['variable_name']];
					}
				}
			}
		}
		else {
			$this->redirectTop();
		}

		// 画像の数を数える
		$pic_num = 0;
		if( $output[ 'PIC1' ] != "" ) $pic_num++;
		if( $output[ 'PIC2' ] != "" ) $pic_num++;
		if( $output[ 'PIC3' ] != "" ) $pic_num++;
		$output[ 'PICNUM' ] = $pic_num;

		// 画像を詰める
		$temp_count = 0;
		for($i=1;$i<=3;$i++) {
			if($output[ 'PIC'.$i ] ) {
				$tmp_pic[$temp_count]['PIC'] = $output[ 'PIC'.$i ];
				$tmp_pic[$temp_count]['TITLE'] = $output[ 'PIC'.$i.'_TITLE' ];
				$temp_count++;
			}
		}

		$output[ 'PIC1' ] = "";
		$output[ 'PIC2' ] = "";
		$output[ 'PIC3' ] = "";

		for($i=1;$i<=count($tmp_pic);$i++) {
			$output[ 'PIC'.$i ] = $tmp_pic[$i-1]['PIC'];
			$output[ 'PIC'.$i.'_TITLE' ] = $tmp_pic[$i-1]['TITLE'];
		}

		// 添付ファイルを数える
		$file_num = 0;
		if( $output[ 'ATTACHFILE1' ] != "" ) $file_num++;
		if( $output[ 'ATTACHFILE2' ] != "" ) $file_num++;
		if( $output[ 'ATTACHFILE3' ] != "" ) $file_num++;
		$output[ 'FILENUM' ] = $file_num;

		// 添付ファイルを詰める
		$temp_count = 0;
		for($i=1;$i<=3;$i++) {
			if($output[ 'ATTACHFILE'.$i ] ) {
				$tmp_file[$temp_count]['ATTACHFILE'] = $output[ 'ATTACHFILE'.$i ];
				$tmp_file[$temp_count]['TITLE'] = $output[ 'ATTACHFILE'.$i.'_TITLE' ];
				$temp_count++;
			}
		}

		$output[ 'ATTACHFILE1' ] = "";
		$output[ 'ATTACHFILE2' ] = "";
		$output[ 'ATTACHFILE3' ] = "";

		for($i=1;$i<=count($tmp_file);$i++) {
			$output[ 'ATTACHFILE'.$i ] = $tmp_file[$i-1]['ATTACHFILE'];
			$output[ 'ATTACHFILE'.$i.'_TITLE' ] = $tmp_file[$i-1]['TITLE'];

			$file_name = $tmp_file[$i-1]['ATTACHFILE'];

			// 添付ファイルの拡張子等
			if( preg_match( '/\.doc$/i' , $file_name ) == 1 || preg_match( '/\.docx$/i' , $file_name ) == 1 || preg_match( '/\.docm$/i' , $file_name ) == 1 ) {
				$output[ 'EXTENSION'.$i ] = "doc";
				$output[ 'FILE_TYPE'.$i ] = "Word";
			}
			else if( preg_match( '/\.xls$/i' , $file_name ) == 1 || preg_match( '/\.xlsb$/i' , $file_name ) == 1 || preg_match( '/\.xlsx$/i' , $file_name ) == 1 || preg_match( '/\.xlsm$/i' , $file_name ) == 1 ) {
				$output[ 'EXTENSION'.$i ] = "xls";
				$output[ 'FILE_TYPE'.$i ] = "Excel";
			}
			else if( preg_match( '/\.ppt$/i' , $file_name ) == 1 || preg_match( '/\.pptx$/i' , $file_name ) == 1 || preg_match( '/\.pptm$/i' , $file_name ) == 1  ) {
				$output[ 'EXTENSION'.$i ] = "ppt";
				$output[ 'FILE_TYPE'.$i ] = "PowerPoint";
			}
			else if ( preg_match( '/\.pdf$/i' , $file_name ) == 1 ) {
				$output[ 'EXTENSION'.$i ] = "pdf";
				$output[ 'FILE_TYPE'.$i ] = "PDF";
			}
			else {
				$output[ 'EXTENSION'.$i ] = "";
			}

			if($category_info['use_filemanager']) {
				$file_path = $this->smartyanytime['info']['wwwroot_path'].$file_name;
			}
			else {
				$file_path = $this->smartyanytime['info']['wwwroot_path'].FILE_DIR.'/'.$file_name;
			}

			if($file_name && file_exists($file_path)) {
				$size = filesize( $file_path );
				$size = ceil($size / 1024);
				$output[ 'SIZE'.$i ] = $size;
			}

		}

		// 携帯だったらSJIS変換
		if($this->smartyanytime['info']['mobile'] && !$this->smartyanytime['info']['smartphone']) mb_convert_variables( 'SJIS-win' , 'utf-8' , $output );

		$this->smarty->assign( 'data' , $output);

		return $output;
	}

	/**
	 *  アーカイブの年月リストを設定
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param string $var_name リストの名称
	 */
	function setArchives( $c_id=1 , $var_name='default_archives' ) {
		// リスト表示
		$this->_setArchives( $c_id , $var_name );
	}

	/**
	 *  アーカイブの年月リストを設定(コア)
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $c_id カテゴリーID
	 *  @param string $var_name リストの名称
	 *  @return array アーカイブ年月情報 
	 */
	function _setArchives( $c_id , $var_name ) {

		// データを取得
		$data = $this->_getArchives ( $c_id );
		if ( $data === false ) return array();

		for($i=0;$i<count($data);$i++) {
			$yearmonth = date('Ym',strtotime($data[$i]['yearmonth'].'/01'));
			$max = $this->getDocumentArchivesNam ( $c_id , $yearmonth );
			if( $max===false ) return array();
			$data[$i]['count'] = $max;
		}

		$this->assign($var_name , $data , $this->smarty);
		$this->assign('output_archives' , $data , $this->smarty);

		return $data;
	}

	/**
	 *  アーカイブ年月を取得
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $c_id カテゴリーID
	 *  @return mix アーカイブ年月情報,false
	 */
	function _getArchives ( $c_id ) {

		$data = array();

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );

		$cid_sql = ' c_id = "' . $c_id . '"';

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT DATE_FORMAT( release_date , '%Y/%m') as yearmonth FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND " .
				" ( " .
				"period_flag = 0 OR " .
				" ( " .
				"period_flag = 1 AND " .
				"start_date <= '" . $now_datetime . "' AND ".
				"end_date   >= '" . $now_datetime . "' ".
				" ) " .
				" ) AND " .
				"disable = 0 AND " .
				"delete_flag = 0 " .
				"GROUP BY yearmonth " .
				"ORDER BY yearmonth DESC;";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return $data;

		while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[] = $fetch;

		return $data;
	}

	/**
	 *  アーカイブリスト情報を設定
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $listmax リストの最大数
	 *  @param string $var_name リストの名称
	 *  @param int $pagelist_max ページリストの最大数
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートするカラム
	 *  @param string $yearmonth 年月(年4桁月2桁の数字)
	 */
	function setListArchives( $c_id=1 , $listmax=10 , $var_name='default_list' ,$pagelist_max=5 , $sort_order=1 , $sort_column=4 , $yearmonth='' ) {
		// リスト表示
		$this->_setcmslistArchives( $c_id , $listmax , $var_name ,$pagelist_max , $sort_order , $sort_column , $yearmonth );
	}

	/**
	 *  アーカイブリスト情報を設定(コア)
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $c_id カテゴリーID
	 *  @param int $listmax リストの最大数
	 *  @param string $var_name リストの名称
	 *  @param int $pagelist_max ページリストの最大数
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートするカラム
	 *  @param string $yearmonth 年月(年4桁月2桁の数字)
	 *  @return array ドキュメント情報 
	 */
	function _setcmslistArchives( $c_id , $listmax , $var_name ,$pagelist_max , $sort_order , $sort_column , $yearmonth ) {

		$output = array();
		$pagelist = array();

		////////////////////////////////////////////////
		// リスト表示処理
		///////////////////////////////////////////////

		// ページを受け取る
		$page = ( isset( $_GET['p'] ) !== true ) ? ( 1 ) : ( $_GET['p'] );

		// チェック
		if( is_numeric( $page ) === false ) $this->redirectTop();
		if( is_int( $page * 1 ) === false ) $this->redirectTop();
		if( (string)$page !== (string)(int)$page ) $this->redirectTop();
		$page = ( $page <= 0 ) ? ( 1 ) : ( $page );

		// ドキュメント数を取得
		$max = $this->getDocumentArchivesNam ( $c_id , $yearmonth );
		if ( $max === false ) $this->redirectTop();

		// 最大ページ数取得
		$page_max = ceil($max / $listmax);
		if( $page_max == 0 ) $page_max = 1;

		// 現在ページの調整
		$page = ( $page > $page_max ) ? ( $page_max ) : ( $page );

		// 前後ページ
		$prev_page = ( ( $page - 1 ) < 1 ) ? ( 1 ) : ( $page - 1 );
		$next_page = ( ( $page + 1 ) > $page_max ) ? ( $page_max ) : ( $page + 1 );

		///////////////////////////
		// リストでも作ってみる
		//////////////////////////

		if( $max != 0 ) {
			$page_max = ceil($max/$listmax);

			$page = ( $page > $page_max ) ? ( $page_max ) : ( $page );

			$end_page = $page_max;
			if( $page_max > $pagelist_max ) {
				if( ($page+2) > $pagelist_max ) {
					$end_page = $page + 2;
				}
				else {
					$end_page = $pagelist_max;
				}
			}
		}
		else {
			$page_max = 0;
			$end_page =0;
		}

		$end_page = ( $end_page > $page_max ) ? ( $page_max ) : ( $end_page );
		$start_page = $end_page - ($pagelist_max -1 );
		$start_page = ( $start_page < 1 ) ? ( 1 ) : ( $start_page );

		// リスト制作
		for( $i = $start_page ; $i <= $end_page ; $i++ ) {
			$pagelist[] = $i;
		}

		// オフセット設定
		$start = ( ( $page * $listmax ) - $listmax );
		$end = $listmax;

		// ドキュメントデータを取得
		$result = $this->getDocumentDataArchives ( $c_id , $start , $end , $d_data , $sort_order , $sort_column , $yearmonth );
		if ( $result == false ) $this->redirectTop();

		// 件数取得
		$maxcount = count( $d_data );

		// リスト部分生成
		for( $i=0 ; $i<$maxcount ; $i++ ) {
			$output[$i][ 'ID' ]          = $d_data[$i]['d_id'];
			$output[$i][ 'TITLE' ]       = $d_data[$i]['title'];
			$output[$i][ 'EXPLANATION' ] = $d_data[$i]['explanation'];
			$output[$i][ 'START_DATE' ] = ( $d_data[$i]['start_date'] == '0000-00-00 00:00:00' || $d_data[$i]['start_date'] == '1970-01-01 00:00:00' ) ? ( '' ):( date( 'Y/m/d' , strtotime($d_data[$i]['start_date'] ) ) );
			$output[$i][ 'END_DATE' ]   = ( $d_data[$i]['end_date'] == '0000-00-00 00:00:00' || $d_data[$i]['end_date'] == '2037-12-31 23:59:59' ) ? ( '' ):( date( 'Y/m/d' , strtotime($d_data[$i]['end_date'] ) ) );
			$output[$i][ 'RELEASE_DATE' ] = date( 'Y/m/d H:i:s' , strtotime($d_data[$i]['release_date']));
			$output[$i][ 'CREATE_DATE' ] = date( 'Y/m/d H:i:s' , strtotime($d_data[$i]['create_date']));
			$output[$i][ 'EDIT_DATE' ]   = date( 'Y/m/d H:i:s' , strtotime($d_data[$i]['edit_date']));
			$output[$i][ 'CATEGORY' ]   = $d_data[$i]['category'];
			$output[$i][ 'DIRECTLINK' ]= $d_data[$i]['directlink'];
			$output[$i][ 'DIRECTLINK_TYPE' ]= $d_data[$i]['directlink_type'];

			// アイテム取得
			$result = $this->getItem( $d_data[$i]['c_id'] , $i_data);
			if ( $result == false ) $this->redirectTop();

			// アイテムデータ取得
			$result = $this->getItemData( $d_data[$i]['d_id'] , $contents_data);
			if ( $result == false ) $this->redirectTop();

			// アイテムデータ分繰り返す
			for( $d=0 ; $d<count( $contents_data ) ; $d++ ) {
				// テキストエリア以外には実態参照へ
				if( $i_data[$contents_data[$d]['i_id']]['type'] !=ITEM_TYPE_TEXTAREA ) {
					$output[$i][ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = htmlentities($contents_data[$d]['value'],ENT_QUOTES,'UTF-8');
				}
				else {
					if(USE_TINYMCE) {
						$contents_data[$d]['value'] = preg_replace( '@(<div>)(.+?)(</div>)@is' , '<br/>$2' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = preg_replace( '@<div>@is' , '<br/>' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = preg_replace( '@</div>@is' , '' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = str_replace('<p>' , '' , $contents_data[$d]['value'] );
						$contents_data[$d]['value'] = str_replace('</p>' , '' , $contents_data[$d]['value']);
						$output[$i][ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = $contents_data[$d]['value'];
					}
					else {
						$output[$i][ $i_data[$contents_data[$d]['i_id']]['variable_name'] ] = $contents_data[$d]['value'];
					}
				}
			}
		}

		$outlist['page_list'] = $pagelist;
		$outlist['page'] = $page;
		$outlist['maxpage'] = $end_page;
		$outlist['list'] = $output;
		$outlist['yearmonth'] = $yearmonth;

		// 携帯だったらSJIS変換
		if($this->smartyanytime['info']['mobile'] && !$this->smartyanytime['info']['smartphone']) mb_convert_variables( 'SJIS-win' , 'utf-8' , $outlist , $output );

		$this->smarty->assign($var_name , $outlist);
		$this->smarty->assign('output_list' , $output);

		return $output;
	}

	/**
	 *  アーカイブ用ドキュメント数取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $yearmonth 年月(年4桁月2桁の数字)
	 *  @return mix ドキュメント数,false
	 */
	// ドキュメント数取得
	function getDocumentArchivesNam ( $c_id ,$yearmonth='' ) {

		if(!$yearmonth) return false;

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );
		$yearmonth = mysql_real_escape_string( $yearmonth );

		// カテゴリID複数対応
		$a_cid = explode( ',' , $c_id );
		if( count( $a_cid ) != 1 ) {
			$cid_sql = ' c_id = "' . implode ( '" OR c_id = "' , $a_cid ) . '"';
		}
		else {
			$cid_sql = ' c_id = "' . $a_cid[0] . '"';
		}

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT *,DATE_FORMAT( release_date , '%Y/%m') as yearmonth FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND DATE_FORMAT( release_date , '%Y%m') = '" . $yearmonth . "' AND ".
				" ( " .
				"period_flag = 0 OR " .
				" ( " .
				"period_flag = 1 AND " .
				"start_date <= '" . $now_datetime . "' AND ".
				"end_date   >= '" . $now_datetime . "' ".
				" ) " .
				" ) AND " .
				"disable = 0 AND " .
				"delete_flag = 0 ";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;

		return mysql_num_rows ( $query );
	}

	/**
	 *  アーカイブ用ドキュメントリスト取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $start 取得開始位置
	 *  @param int $end 取得数
	 *  @param int $data ドキュメントデータ(参照渡)
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートするカラム
	 *  @param int $yearmonth 年月(年4桁月2桁の数字)
	 *  @return bool 処理結果
	 */
	// アーカイブ用ドキュメント取得
	function getDocumentDataArchives ( $c_id , $start , $end , &$data , $sort_order=1,$sort_column=4,$yearmonth='' ) {

		$data = array();

		if(!$yearmonth) return false;

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );
		$start = mysql_real_escape_string( $start );
		$end = mysql_real_escape_string( $end );
		$yearmonth = mysql_real_escape_string( $yearmonth );

		// カテゴリID複数対応
		$a_cid = explode( ',' , $c_id );
		if( count( $a_cid ) != 1 ) {
			$cid_sql = ' c_id = "' . implode ( '" OR c_id = "' , $a_cid ) . '"';
		}
		else {
			$cid_sql = ' c_id = "' . $a_cid[0] . '"';
		}

		// ソートを指定する
		$order = ( $sort_order == 1 ) ? ( $order = " DESC " ) : ( $order = " ASC " ); // 昇順降順
		$sort = "";
		switch ( $sort_column ) {
			case 0: // ドキュメントID
				$sort ="ORDER BY d_id " . $order;
				break;
			case 1: // 作成日
				$sort ="ORDER BY create_date " . $order . " , d_id " . $order;
				break;
			case 2: // 更新日
				$sort ="ORDER BY edit_date " . $order . " , d_id " . $order;
				break;
			case 3: // 公開日時
				$sort ="ORDER BY release_date " . $order . " , d_id " . $order;
				break;
			case 4: // ソート
				$sort ="ORDER BY sort " . $order . " , release_date " . $order;
				break;
			case 5: // 公開開始日
				$sort ="ORDER BY start_date " . $order . " , d_id " . $order;
				break;
			case 6: // 公開終了日
				$sort ="ORDER BY end_date " . $order . " , d_id " . $order;
				break;
			default:
				$sort ="ORDER BY d_id " . $order;
				break;
		}

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT *,DATE_FORMAT( release_date , '%Y%m') as yearmonth FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND DATE_FORMAT( release_date , '%Y%m') = '" . $yearmonth . "' AND ".
				" ( " .
				"period_flag = 0 OR " .
				" ( " .
				"period_flag = 1 AND " .
				"start_date <= '" . $now_datetime . "' AND ".
				"end_date   >= '" . $now_datetime . "' ".
				" ) " .
				" ) AND " .
				"disable = 0 AND " .
				"delete_flag = 0 " .
				$sort .
				"LIMIT " . $start . " , " . $end;

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return true;

		while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[] = $fetch;

		return true;
	}

	/**
	 *  ドキュメントカテゴリーの名称リストを設定
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param string $var_name リストの名称
	 */
	function setCategories( $c_id=1 , $var_name='default_categories' ) {
		// リスト表示
		$this->_setCategories( $c_id , $var_name );
	}

	/**
	 *  ドキュメントカテゴリーの名称リストを設定(コア)
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $c_id カテゴリーID
	 *  @param string $var_name リストの名称
	 *  @return array ドキュメントカテゴリー情報
	 */
	function _setCategories( $c_id , $var_name ) {

		// データを取得
		$data = $this->_getCategories ( $c_id );
		if ( $data === false ) return array();

		for($i=0;$i<count($data);$i++) {
			$max = $this->getDocumentCategoriesNam ( $c_id , $data[$i]['id'] );
			if( $max===false ) return array();
			$data[$i]['count'] = $max;
		}

		$this->assign($var_name , $data , $this->smarty);
		$this->assign('output_categories' , $data , $this->smarty);

		return $data;
	}

	/**
	 *  使用されているドキュメントカテゴリーを取得
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $c_id カテゴリーID
	 *  @return mix ドキュメントカテゴリー情報,false
	 */
	function _getCategories ( $c_id ) {

		$data = array();

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );

		$cid_sql = ' a.c_id = "' . $c_id . '"';

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT b.id , b.name FROM ".DB_PREFIX."cmsdocuments as a LEFT JOIN ".DB_PREFIX."cmsdoccategories as b ON (a.c_id = b.c_id AND a.category = b.id)  WHERE ( " . $cid_sql . " ) AND " .
				" ( " .
				"period_flag = 0 OR " .
				" ( " .
				"period_flag = 1 AND " .
				"start_date <= '" . $now_datetime . "' AND ".
				"end_date   >= '" . $now_datetime . "' ".
				" ) " .
				" ) AND " .
				"disable = 0 AND " .
				"a.delete_flag = 0 AND " .
				"a.category != 0 " .
				"GROUP BY id,name " .
				"ORDER BY b.sort ASC;";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return $data;

		while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[] = $fetch;

		return $data;
	}

	/**
	 *  ドキュメントIDとカテゴリーIDからドキュメント取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $category ドキュメントカテゴリーID
	 *  @param int $d_id ドキュメントID
	 *  @param int $data ドキュメントデータ(参照渡)
	 *  @return bool 処理結果
	 */
	// ドキュメントIDとカテゴリーIDからドキュメント取得
	function getDocumentDataByCD_ID ( $c_id, $category=0 , $d_id , &$data ) {

		$data = array();

		$c_id = mysql_real_escape_string( $c_id );
		$d_id = mysql_real_escape_string( $d_id );
		$category = mysql_real_escape_string( $category );

		// カテゴリID複数対応
		$a_cid = explode( ',' , $c_id );
		if( count( $a_cid ) != 1 ) {
			$cid_sql = ' c_id = "' . implode ( '" OR c_id = "' , $a_cid ) . '"';
		}
		else {
			$cid_sql = ' c_id = "' . $a_cid[0] . '"';
		}

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT * FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND d_id = \"" . $d_id . "\" AND ";
		$sql .= " ( ";
		$sql .= "period_flag = 0 OR ";
		$sql .= " ( ";
		$sql .= "period_flag = 1 AND ";
		$sql .= "start_date <= '" . $now_datetime . "' AND ";
		$sql .= "end_date   >= '" . $now_datetime . "' ";
		$sql .= " ) ";
		$sql .= " ) AND ";
		if($category) $sql .= "category = '".$category."' AND ";
		$sql .= "disable = 0 AND ";
		$sql .= "delete_flag = 0 ";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return true;

		while ( $fetch = mysql_fetch_assoc ( $query ) ) $data = $fetch;

		return true;
	}

	/**
	 *  アイテムデータ取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $data アイテムデータ(参照渡)
	 *  @return bool 処理結果
	 */
	function getItemData ( $d_id , &$data ) {

		$data = array();

		$d_id = mysql_real_escape_string( $d_id );

		$sql = "SELECT * FROM ".DB_PREFIX."cmsitemdatas WHERE d_id = \"" . $d_id . "\" AND delete_flag = 0 ";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return true;

		while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[] = $fetch;

		return true;
	}

	/**
	 *  アイテム情報取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $data アイテム情報(参照渡)
	 *  @return bool 処理結果
	 */
	// アイテム取得
	function getItem ( $c_id , &$data ) {

		$data = array();

		$c_id = mysql_real_escape_string( $c_id );

		$sql = "SELECT * FROM ".DB_PREFIX."cmsitems WHERE c_id = \"" . $c_id . "\" AND delete_flag = 0 ORDER BY i_id";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return true;

		while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[$fetch['i_id']] = $fetch;

		return true;
	}

	/**
	 *  指定のIDの一つ前のIDを取得する
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $d_id ドキュメントID
	 *  @param int $category ドキュメントカテゴリーID
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートカラム
	 *  @return mix 処理結果
	 */
	function _getPrev($c_id , $d_id , $category=0 , $sort_order , $sort_column ) {

		// ドキュメントからソート順を取得する
		$result = $this->getDocumentDataByCD_ID( $c_id, $category , $d_id , $d_data);
		if ( $result == false ) return'';
		if ( count( $d_data )==0 ) return'';

		$sort_num = $d_data['sort'];

		// 前のドキュメントのソート順を取得
		$prev_sort = $this->_getPrevID ( $c_id , $category , $sort_num , $sort_order,$sort_column );
		if(!$prev_sort && $prev_sort!==0 && $prev_sort!=='0') return'';

		// ソート番号から情報取得
		if(!$this->getDocumentDataBySort($c_id , $prev_sort , $data)) return'';
		if ( count( $data )==0 ) return'';

		return $data['d_id'];
	}

	/**
	 *  指定のIDの次のIDを取得する
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $d_id ドキュメントID
	 *  @param int $category ドキュメントカテゴリーID
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートカラム
	 *  @return mix 処理結果
	 */
	function _getNext($c_id , $d_id , $category=0 , $sort_order , $sort_column ) {

		// ドキュメントからソート順を取得する
		$result = $this->getDocumentDataByCD_ID( $c_id , $category , $d_id , $d_data);
		if ( $result == false ) return'';
		if ( count( $d_data )==0 ) return'';

		$sort_num = $d_data['sort'];

		// 次のドキュメントのソート順を取得
		$next_sort = $this->_getNextID ( $c_id , $category , $sort_num , $sort_order,$sort_column );
		if(!$next_sort && $next_sort!==0 && $next_sort!=='0') return'';

		// ソート番号から情報取得
		if(!$this->getDocumentDataBySort($c_id , $next_sort , $data)) return'';
		if ( count( $data )==0 ) return'';

		return $data['d_id'];
	}

	/**
	 *  IDから一つ前のIDを取得する
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $category ドキュメントカテゴリーID
	 *  @param int $sort_num ソート番号
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートカラム
	 *  @return mix 処理結果
	 */
	function _getPrevID ( $c_id , $category=0 , $sort_num , $sort_order=1,$sort_column=4 ) {

		$data = array();

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );
		$sort_num = mysql_real_escape_string( $sort_num );
		$category = mysql_real_escape_string( $category );

		// カテゴリID複数対応
		$a_cid = explode( ',' , $c_id );
		if( count( $a_cid ) != 1 ) {
			$cid_sql = ' c_id = "' . implode ( '" OR c_id = "' , $a_cid ) . '"';
		}
		else {
			$cid_sql = ' c_id = "' . $a_cid[0] . '"';
		}

		// ソートを指定する
		if ($sort_order == 1) {
			$order = " DESC ";
			$sql_comp = " < ";
			$sql_field = "max(sort)";
		}
		else {
			$order = " ASC ";
			$sql_comp = " > ";
			$sql_field = "min(sort)";
		}

		$sort = "";
		switch ( $sort_column ) {
			case 0: // ドキュメントID
				$sort ="ORDER BY d_id " . $order;
				break;
			case 1: // 作成日
				$sort ="ORDER BY create_date " . $order . " , d_id " . $order;
				break;
			case 2: // 更新日
				$sort ="ORDER BY edit_date " . $order . " , d_id " . $order;
				break;
			case 3: // 公開日時
				$sort ="ORDER BY release_date " . $order . " , d_id " . $order;
				break;
			case 4: // ソート
				$sort ="ORDER BY sort " . $order . " , release_date " . $order;
				break;
			case 5: // 公開開始日
				$sort ="ORDER BY start_date " . $order . " , d_id " . $order;
				break;
			case 6: // 公開終了日
				$sort ="ORDER BY end_date " . $order . " , d_id " . $order;
				break;
			default:
				$sort ="ORDER BY d_id " . $order;
				break;
		}

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT ".$sql_field." as prev FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND ";
		$sql .= " ( ";
		$sql .= "period_flag = 0 OR ";
		$sql .= " ( ";
		$sql .= "period_flag = 1 AND ";
		$sql .= "start_date <= '" . $now_datetime . "' AND ";
		$sql .= "end_date   >= '" . $now_datetime . "' ";
		$sql .= " ) ";
		$sql .= " ) AND ";
		$sql .= "sort ".$sql_comp." '" . $sort_num . "' AND ";
		if($category) $sql .= "category = '".$category."' AND ";
		$sql .= "disable = 0 AND ";
		$sql .= "delete_flag = 0 ";
		$sql .= $sort;

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return false;

		$fetch = mysql_fetch_assoc ( $query );

		return $fetch['prev'];
	}

	/**
	 *  IDから次のIDを取得する
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $category ドキュメントカテゴリーID
	 *  @param int $sort_num ソート番号
	 *  @param int $sort_order ソート順
	 *  @param int $sort_column ソートカラム
	 *  @return mix 処理結果
	 */
	function _getNextID ( $c_id , $category=0 , $sort_num , $sort_order=1,$sort_column=4 ) {

		$data = array();

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );
		$sort_num = mysql_real_escape_string( $sort_num );
		$category = mysql_real_escape_string( $category );

		// カテゴリID複数対応
		$a_cid = explode( ',' , $c_id );
		if( count( $a_cid ) != 1 ) {
			$cid_sql = ' c_id = "' . implode ( '" OR c_id = "' , $a_cid ) . '"';
		}
		else {
			$cid_sql = ' c_id = "' . $a_cid[0] . '"';
		}

		// ソートを指定する
		if ($sort_order == 1) {
			$order = " DESC ";
			$sql_comp = " > ";
			$sql_field = "min(sort)";
		}
		else {
			$order = " ASC ";
			$sql_comp = " < ";
			$sql_field = "max(sort)";
		}

		$sort = "";
		switch ( $sort_column ) {
			case 0: // ドキュメントID
				$sort ="ORDER BY d_id " . $order;
				break;
			case 1: // 作成日
				$sort ="ORDER BY create_date " . $order . " , d_id " . $order;
				break;
			case 2: // 更新日
				$sort ="ORDER BY edit_date " . $order . " , d_id " . $order;
				break;
			case 3: // 公開日時
				$sort ="ORDER BY release_date " . $order . " , d_id " . $order;
				break;
			case 4: // ソート
				$sort ="ORDER BY sort " . $order . " , release_date " . $order;
				break;
			case 5: // 公開開始日
				$sort ="ORDER BY start_date " . $order . " , d_id " . $order;
				break;
			case 6: // 公開終了日
				$sort ="ORDER BY end_date " . $order . " , d_id " . $order;
				break;
			default:
				$sort ="ORDER BY d_id " . $order;
				break;
		}

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT ".$sql_field." as next FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND ";
		$sql .= " ( ";
		$sql .= "period_flag = 0 OR ";
		$sql .= " ( ";
		$sql .= "period_flag = 1 AND ";
		$sql .= "start_date <= '" . $now_datetime . "' AND ";
		$sql .= "end_date   >= '" . $now_datetime . "' ";
		$sql .= " ) ";
		$sql .= " ) AND ";
		$sql .= "sort ".$sql_comp." '" . $sort_num . "' AND ";
		if($category) $sql .= "category = '".$category."' AND ";
		$sql .= "disable = 0 AND ";
		$sql .= "delete_flag = 0 ";
		$sql .= $sort;

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return false;

		$fetch = mysql_fetch_assoc ( $query );

		return $fetch['next'];
	}

	/**
	 *  ソート番号とカテゴリーIDからドキュメント取得
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param int $c_id カテゴリーID
	 *  @param int $sort_num ドキュメントID
	 *  @param int $data ドキュメントデータ(参照渡)
	 *  @return bool 処理結果
	 */
	// ドキュメントIDとカテゴリーIDからドキュメント取得
	function getDocumentDataBySort ( $c_id , $sort_num , &$data ) {

		$data = array();

		$c_id = mysql_real_escape_string( $c_id );
		$sort_num = mysql_real_escape_string( $sort_num );

		// カテゴリID複数対応
		$a_cid = explode( ',' , $c_id );
		if( count( $a_cid ) != 1 ) {
			$cid_sql = ' c_id = "' . implode ( '" OR c_id = "' , $a_cid ) . '"';
		}
		else {
			$cid_sql = ' c_id = "' . $a_cid[0] . '"';
		}

		// 今を取得
		$now_datetime = date('Y-m-d H:i:s');

		$sql = "SELECT * FROM ".DB_PREFIX."cmsdocuments WHERE ( " . $cid_sql . " ) AND sort = \"" . $sort_num . "\" AND " .
				" ( " .
				"period_flag = 0 OR " .
				" ( " .
				"period_flag = 1 AND " .
				"start_date <= '" . $now_datetime . "' AND ".
				"end_date   >= '" . $now_datetime . "' ".
				" ) " .
				" ) AND " .
				"disable = 0 AND " .
				"delete_flag = 0 ";

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return true;

		$fetch = mysql_fetch_assoc ( $query );
		$data = $fetch;

		return true;
	}

	/**
	 *  カテゴリー情報を取得
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $c_id カテゴリーID
	 *  @return mix カテゴリー情報,false
	 */
	function _getCategoryInfo ( $c_id ) {

		$data = array();

		// エスケープ
		$c_id = mysql_real_escape_string( $c_id );

		$sql = 'SELECT * FROM '.DB_PREFIX.'cmscategories WHERE c_id="'.$c_id.'" AND delete_flag=0;';

		$query = @mysql_query ( $sql );
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return false;

		$fetch = mysql_fetch_assoc ( $query );
		$data = $fetch;

		return $data;
	}
}

?>