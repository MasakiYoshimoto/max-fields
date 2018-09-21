<?php
/* SVN FILE: $Id$ */
/**
 * Smarty用のView。SmartyViewの拡張クラス(1.0.2)
 *
 * Smartyの主要初期設定を[app/config/smarty.php]で行う。
 * Controller::smartyCacheLifetime プロパティでキャッシュの有効期限を設定する。
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright (c) 2007-2008, Catchup
 * @link			http://www.e-catchup.jp
 * @package		cake
 * @subpackage		cake.app.views
 * @since			CakePHP(tm) v 1.1.19.6305
 * @version		$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Include files
 */
	App::import('View','smarty');
	config('smarty');
/**
 * Smarty用のView。SmartyViewの拡張クラス
 *
 * Smartyの主要初期設定を[app/config/smarty.php]で行う。
 *
 * @package		cake
 * @subpackage		cake.app.views
 */
class SmartyExView extends SmartyView {

	var $webservices = '';

	/**
	 * 出力エンコーディング
	 */
	var $outputEncoding = 'UTF-8';
	/**
	 * Constructor.
	 * return	void
	 */
	function __construct(&$controller) {

		parent::__construct($controller);
		
		$this->Smarty = new Smarty();

		$template = ($controller->plugin) ? (APP.'plugins'.DS.$controller->plugin.DS.'views'.DS):(VIEWS.DS);
		
		/*** Smartyの初期設定を行う ***/
		$this->Smarty->left_delimiter = SMARTY_LEFT_DELIMITER;
		$this->Smarty->right_delimiter = SMARTY_RIGHT_DELIMITER;
		$this->Smarty->plugins_dir[] = SMARTY_PLUGINS_DIR;
		$this->Smarty->compile_dir = SMARTY_COMPILE_DIR;
		$this->Smarty->cache_dir = SMARTY_CACHE_DIR;
		$this->Smarty->template_dir = $template;
		$this->Smarty->config_dir = SMARTY_CONFIG_DIR;	
		
		if(isset($controller->smartyCacheLifetime)){
			$this->Smarty->cache_lifetime = $controller->smartyCacheLifetime;	
		}
		
		/*** SmartyView設定 ***/
		$this->ext= SMARTY_EXT;
		$this->subDir = SMARTY_SUB_DIR;
		$this->outputEncoding = SMARTY_OUTPUT_ENCODING;
		
		/*** フィルター設定 ***/
		$this->Smarty->register_prefilter('convertToInternal');
		$this->Smarty->register_outputfilter('convertToOutput');
		
		$this->Smarty->clear_cache($controller->layout.'.tpl');
		
		
		/*** キャッシュ・コンパイル ***/
//		if(Configure::read('debug') == 0){
//			$this->Smarty->force_compile = false;
//			$this->Smarty->caching = true;
//		}else{
//			$this->Smarty->force_compile = true;
//			$this->Smarty->caching = false;
//		}


		$this->Smarty->force_compile = true;
		$this->Smarty->caching = false;
		
		// Smarty設定ファイルの読み込み
		$this->_loadSmartyConfig();
		
	}
	/**
	 * テンプレートに値を設定する際に文字コードの変換を行う
	 *
	 * @param variant $tpl_var
	 * @param variant 値
	 */
	function assignByEncoding($tpl_var, $value = null) {
		
		$toEncoding = mb_internal_encoding();
		if (is_array($tpl_var)){
			foreach ($tpl_var as $key => $val) {
				if ($key != '') {
					array_walk($val,'arrayWalkConvertEncoding',$toEncoding);
					$this->Smarty->_tpl_vars[$key] = $val;
				}
			}
			
		} else {
		
			if ($tpl_var != ''){
				if(is_array($value)){
					array_walk($value,'arrayWalkConvertEncoding',$toEncoding);
					$this->Smarty->_tpl_vars[$tpl_var] = $value;
				}else{
					$this->Smarty->_tpl_vars[$tpl_var] = autoConvertEncoding($value,$toEncoding);
				}
			}
			
		}
		
	}
	/**
	 * 連想配列を生成する
	 *
	 * @return array
	 */
	function aa() {
	    $args = func_get_args();
		$args = array_map(array($this,"changefalse"), $args);
		return call_user_func_array('aa', $args);
	}

	function changefalse( $val ) {
		if( $val == "false" ) $val = false;
		return $val;
	}

	/**
	 * セレクト用の配列を生成する
	 *
	 * @return array
	 */
	function ss() {
		$option = array();
		$args = func_get_args();
		$lists = explode(',',$args[0]);
		while(list ($key, $val) = each($lists)) {
			$option = $option + array($val=>$val);
		}
		return $option;
	}

	/**
	 * 文字列を結合する
	 *
	 * @return array
	 */
	function cat() {
		$option = array();
		$args = func_get_args();
		$args = implode('',$args);

		return $args;
	}

	/**
	 * Overrides the parent::_render()
	 * Sets variables used in CakePHP to Smarty variables
	 *
	 * @param string $___viewFn
	 * @param string $___data_for_view
	 * @param string $___play_safe
	 * @param string $loadHelpers
	 * @return rendered views
	 */
	function _render($___viewFn, $___data_for_view, $___play_safe = true, $loadHelpers = true)
	{

		if ($this->helpers != false && $loadHelpers === true)
		{
			$loadedHelpers =  array();
			$loadedHelpers = $this->_loadHelpers($loadedHelpers, $this->helpers);

			foreach(array_keys($loadedHelpers) as $helper)
			{
				$replace = strtolower(substr($helper, 0, 1));
				$camelBackedHelper = preg_replace('/\\w/', $replace, $helper, 1);

				${$camelBackedHelper} =& $loadedHelpers[$helper];
				if(isset(${$camelBackedHelper}->helpers) && is_array(${$camelBackedHelper}->helpers))
				{
					foreach(${$camelBackedHelper}->helpers as $subHelper)
					{
						${$camelBackedHelper}->{$subHelper} =& $loadedHelpers[$subHelper];
					}
				}
				$this->loaded[$camelBackedHelper] = (${$camelBackedHelper});
				$this->Smarty->assign_by_ref($camelBackedHelper, ${$camelBackedHelper});
			}
		}

		
		$this->register_functions();

		foreach($___data_for_view as $data => $value)
		{
			if(!is_object($data))
			{
				$this->assignByEncoding($data, $value);
			}
		}
		$this->Smarty->assign_by_ref('this', $this);
		
		$out = $this->Smarty->fetch($___viewFn,md5(serialize($_GET)));	
		
		// helperのafterRenderを呼び出す
		if ($this->helpers != false && $loadHelpers === true) {
			foreach ($loadedHelpers as $helper) {
				if (is_object($helper)) {
					if (is_subclass_of($helper, 'Helper') || is_subclass_of($helper, 'helper')) {
						$helper->afterRender();
					}
				}
			}
		}
		
		return $out;
		
	}	
	/**
	 * Smarty設定ファイルを読み込む
	 * 
	 * Smarty設定ファイルを「site.conf」、「pages.conf」というファイル名で読み込む。
	 * ぺージごとに読み込むセクション名については、ルート以下のパスとする。
	 * 但し、pagesコントローラー以外の場合は、[コントローラー名/アクション名]とする
	 * （例）http://test.com/test/index.html　⇒　[test/index]
	 *
	 * return void
	 */
	function _loadSmartyConfig(){
		
		if(SMARTY_SITE_CONF){
			$this->Smarty->config_load("site.conf");
		}
		if(SMARTY_PAGES_CONF){
			if(@$this->params['controller'] == 'pages'){
				$this->Smarty->config_load("pages.conf",implode('/',$this->params['pass']));
			}else{
				$this->Smarty->config_load("pages.conf",@$this->params['controller'] . "/" . @$this->params['action']);
			}
		}
		
	}
	
}

/**
 * テンプレートデータを出力用の文字コードに変換する
 * 
 * 
 * 内部エンコーディングに変換したテンプレートデータを出力用の
 * データに変換する。
 *  
 * この関数は一回の表示処理で、３回実行される。※ 何故３回なのかは不明
 * １．ページデータをレイアウトの「content_for_layout」に出力
 * ２．レイアウトをアウトプット
 * ３．レイアウトをアウトプット
 * その為、２回目のみ変換処理を行う仕様とした。
 * 
 * content_for_layoutが設定されている時だけ実行という強引な処理の為、
 * $smart->_tpl_varsが参照できなくなった場合には、実装を見直す必要あり。
 * 
 * @param 	string 	テンプレートソース
 * @param	Smarty	smartyクラス
 * @return	string 	テンプレートソース
 */
function convertToOutput($template_source, &$smart) {

	if (!function_exists("mb_convert_encoding") || empty($smart->_tpl_vars['content_for_layout']))
		return $template_source;

	return autoConvertEncoding($template_source,$smart->_tpl_vars['this']->outputEncoding);

}
/**
 * テンプレートデータを内部エンコーディングに変換する。
 *
 * @param 	string 	テンプレートソース
 * @param	Smarty	smartyクラス
 * @return	string 	テンプレートソース
 */
function convertToInternal($template_source, &$smart) {

	if (!function_exists("mb_convert_encoding"))
		return $template_source;
	
	return autoConvertEncoding($template_source,mb_internal_encoding());

}
/**
 * エンコードを変換する（array_walk用）
 *
 * @param 	string 	value
 * @param	string	key
 * @param	string 	変換先のエンコード
 * @return void
 */
function arrayWalkConvertEncoding(&$value, $key, $toEncoding){
	
	$value = autoConvertEncoding($value,$toEncoding);
	
}
/**
 * データを判断してエンコードを変換する
 * 
 * 変換先と同じエンコードと判断した場合には処理を行わない
 * オブジェクトの場合は処理を行わない
 * 
 * MODIFIED 2008/5/5/29 egashira
 * 配列が処理されなかった問題を修正
 * 
 * @param 	string 	元データ
 * @param	Smarty	変換先のエンコード
 * @return	string 	変換後データ
 */
function autoConvertEncoding($value, $toEncoding){
	
	// オブジェクトは処理しない
	if(is_object($value))
		return $value;

	// 配列の場合は再帰処理とする
	if(is_array($value)){
		foreach($value as $key => $data){
			$value[$key] = autoConvertEncoding($data,$toEncoding);
		}
		return $value;
	}
	
	$enc = mb_detect_encoding($value, "auto");
	if (strtoupper($enc) != $toEncoding) {
		$value = mb_convert_encoding($value,$toEncoding,$enc );
	}
	
	return $value;
	
}
?>