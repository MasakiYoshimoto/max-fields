<?php

// ライブラリの読込
require_once(SMARTYANYTIME_DIR.'/tools/smarty/Smarty.class.php');
require_once(SMARTYANYTIME_DIR.'/tools/simple_html_dom.php');
require_once(SMARTYANYTIME_DIR.'/tools/qdmail.php');
require_once(SMARTYANYTIME_DIR.'/tools/qdmailEx.php');
require_once(SMARTYANYTIME_DIR.'/lib/smartyanytime.util.php');
require_once(SMARTYANYTIME_DIR.'/lib/smartyanytime.plugins.php');
require_once(SMARTYANYTIME_DIR.'/lib/smartyanytime.smarty.php');

class smartyanytime {

	var $smarty;
	var $res;
	var $smartyanytime;
	var $events;
	var $programs=array();
	var $output;

	function __construct($wwwroot='') {

		// エラー表示抑制
		if (error_reporting() > 6143) {
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
		}

		// DB接続
		$this->_connectDB();

		// パラメータの洗浄
		$_POST = smartyanytime_util::clean($_POST);
		$_GET = smartyanytime_util::clean($_GET);

		// smartyの設定
		$this->_setSmarty();

		// 設定を取得
		$this->smartyanytime['site'] = $this->_getSiteSetting();

		// 設置ルートを取得
		$this->_getWWWROOT($wwwroot);

		// プラグイン取得
		$this->_readPlugins();

		// イベントのソート
		$this->_sortPluginsEvent();

		// イニシャライズイベント
		$this->_eventTrigger('initialize');

		// パスの整理
		$this->_setPath();

		// テンプレートファイルのパス
		$this->_setTemplatePath();

		// SSL判定
		$this->_checkSSL();

		// 実ファイルがあるかチェック
		$this->_checkRealFiles();

		// 設定をアサイン
		$tmp = $this->smartyanytime;
		unset($tmp['plugins']);
		$this->smarty->assign('smartyanytime' , $tmp);
		$this->smarty->assign('wwwroot' , $this->smartyanytime['info']['wwwroot']);

	}

	/**
	 *  ページの出力
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 */
	function displayPage() {

		$this->_eventTrigger('start');

		// ページタイプの取得
		$type = $this->_getContentsType($this->smartyanytime['info']['url']);

		// ステータスの設定
		if($this->smartyanytime['info']['template_resource']=='file') {
			$this->_getStatus($this->smartyanytime['info']['template_path'],$type);
		}
		else {
			$this->smartyanytime['info']['status']='404';
		}

		// 開始前イベント
		$this->_eventTrigger('before');

		// ページ毎のプログラム実行
		$run = $this->_runIndividualProcess();

		// 処理後イベント
		$this->_eventTrigger('after');

		// Smartyへ値の引き渡し
		$this->smarty->smartyanytime=$this->smartyanytime;

		// 文字コード用ヘッダ出力
		header('Content-Type: text/html; charset='.$this->smartyanytime['info']['charset']);

		if($type!='php' && $this->smartyanytime['info']['status']=='200') {
			$this->output = $this->smarty->fetch($this->smartyanytime['info']['template_resource'].':' . $this->smartyanytime['info']['template_path'] ,htmlentities($_SERVER["PHP_SELF"]),htmlentities($_SERVER["PHP_SELF"]));

			// 出力前イベント
			$this->_eventTrigger('output');

			print $this->output;
			exit();
		}
		elseif($run && $type=='php') {
			exit();
		}
		elseif($type!='404error') {

			// 実際に表示される404ページのパスに切替
			$this->smarty->smartyanytime['info']['real_path'] = $this->smartyanytime['site']['page_404error'];

			if( REDIRECT404 != true ) {
				// ヘッダの出力
				smartyanytime_util::outputHeader('404');

				if( $this->smartyanytime['info']['template_resource']=='file' ) {
					if(!$this->smartyanytime['site']['page_404error'] || !file_exists($this->smartyanytime['info']['template_404'])) die('Not Found. 404');
				}
				$this->smarty->display($this->smartyanytime['info']['template_resource'] . ':' . $this->smartyanytime['info']['template_404'] ,htmlentities($this->smartyanytime['site']['page_404error']),htmlentities($this->smartyanytime['site']['page_404error']));
				exit();
			}
			else {
				if( $this->smartyanytime['info']['template_resource']=='file' ) {
					if(!$this->smartyanytime['site']['page_404error'] || !file_exists($this->smartyanytime['info']['template_404'])) {
						smartyanytime_util::outputHeader('404');
						die('Not Found. 404');
					}
				}
				else {
					if(!$this->smartyanytime['site']['page_404error']) {
						smartyanytime_util::outputHeader('404');
						die('Not Found. 404');
					}
				}
				header('Location: '.rtrim($this->smartyanytime['site']['site_url'],'/').$this->smartyanytime['site']['page_404error']);
				exit();
			}
		}
		else {
			exit();
		}

	}

	/**
	 *  データベースに接続する
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return bool DB接続リソース
	 */
	function _connectDB(){

		$res = null;

		if( USE_DB == true ) {

			// 接続処理
			$res = @mysql_connect ( DB_HOST_ADDRESS . ":" . DB_PORT , DB_ID , DB_PASS );
			if($res==false) die('db connect false.');

			if( function_exists('mysql_set_charset') ) {
				mysql_set_charset(DB_ENCODING);
			}
			else {
				mysql_query( "SET NAMES " . DB_ENCODING , $res);
			}

			// DBの選択
			if(mysql_select_db(DB_NAME,$res)==false)  die('db connect false.');

		}

		$this->res = $res;

		// DB接続リソースを返却
		return $res;
	}

	/**
	 *  テンプレートファイルのパスを返却
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param string $path ファイルパス
	 *  @return bool 処理結果
	 */
	function _getTemplatePath($path) {
		if( !$path ) return '';
		$temp_path = pathinfo($path);
		$tpl = $this->smartyanytime['info']['wwwroot_path'];
		$tpl .= $temp_path['dirname'].'/tpl_'.$temp_path['basename'];

		return $tpl;
	}

	/**
	 *  WWWROOTを取得・設定
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param $wwwroot
	 *  @return bool 処理結果
	 */
	function _getWWWROOT($wwwroot) {


		if($wwwroot) {
			$this->smartyanytime['info']['wwwroot'] = $wwwroot;
		}
		else{

			if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO']){
				$access_url = $_SERVER['PATH_INFO'];
			}
			elseif (isset($_SERVER['ORIG_PATH_INFO']) && $_SERVER['ORIG_PATH_INFO']){
				$access_url = $_SERVER['ORIG_PATH_INFO'];
			}
			elseif (isset($_SERVER['PHP_SELF']) && $_SERVER['PHP_SELF']){
				$access_url = $_SERVER['PHP_SELF'];
			}

			$path = pathinfo($access_url);
			$dirname = (!$path['dirname'] || $path['dirname']=='.' || $path['dirname']=='/')?(''):($path['dirname']);
			$this->smartyanytime['info']['wwwroot'] = $dirname;
		}

		return true;
	}

	/**
	 *  パスを取得・設定
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return bool 処理結果
	 */
	function _setPath() {

		// 不要な文字を削除
		$_GET['u'] = trim($_GET['u']);

		// 他のサイトを指定しようとしたらストップ
		if(preg_match('@^https?://@',$_GET['u'])==1) exit();
		if(preg_match('@^ftp://@',$_GET['u'])==1) exit();

		$path = pathinfo($_GET['u']);

		$dirname = (!$path['dirname'] || $path['dirname']=='.')?(''):('/'.$path['dirname']);
		if($path['basename'] && preg_match('@.*/$@',$_GET['u'])==0 && !$path['extension']) {
			$url = ($dirname)?($dirname.$path['basename']):($path['basename']);
			header('Location: '.$this->smartyanytime['info']['wwwroot'].$dirname . $url.'/');
			exit();
		}

		if($path['basename'] && preg_match('@.*/$@',$_GET['u'])==1) {
			$dirname .= '/'.$path['basename'];
		}

		$url = ( $path['basename'] && preg_match('@.*/$@',$_GET['u'])==0  ) ? ('/'.$path['basename']):('/index.html');
		$url = ($dirname)?($dirname.$url):($url);

		if( !preg_match('@^/@',$url) ) $url = '/'.$url;

		$path2 = pathinfo($url);

		// .htmlを.phpへ変換
		$transfer_html_ext = false;
		if(TRANSFER_HTML_EXT===true) {
			if(preg_match('@\.php$@',$url)==1) {
				$transfer_html_ext = true;
				$url = preg_replace('@\.php$@','.html',$url);
				$path2['basename'] = preg_replace('@\.php$@','.html',$path2['basename']);
				$path2['extension'] = 'html';
			}
		}

		$this->smartyanytime['info']['host'] = $_SERVER['HTTP_HOST'];
		$this->smartyanytime['info']['wwwroot_path'] = WWWROOT;
		$this->smartyanytime['info']['document_root'] = $_SERVER['DOCUMENT_ROOT'];
		$this->smartyanytime['info']['query_string'] = preg_replace('@u=[^&]*&?@','',$_SERVER['QUERY_STRING']);
		$this->smartyanytime['info']['url'] = $url;
		$this->smartyanytime['info']['path'] = WWWROOT.$url;
		$this->smartyanytime['info']['dir'] = $path2['dirname'];
		$this->smartyanytime['info']['filename'] = $path2['basename'];
		$this->smartyanytime['info']['extension'] = $path2['extension'];
		$this->smartyanytime['info']['template_dir'] = WWWROOT.$dirname;
		$this->smartyanytime['info']['template_404'] = $this->_getTemplatePath($this->smartyanytime['site']['page_404error']);
		$this->smartyanytime['info']['template_resource'] = 'file';
		$this->smartyanytime['info']['charset'] = 'UTF-8';
		$this->smartyanytime['info']['real_path'] = $url;
		$this->smartyanytime['info']['transfer_html_ext'] = $transfer_html_ext;

		return true;
	}

	/**
	 *  テンプレートファイルのパスを取得・設定
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return bool 処理結果
	 */
	function _setTemplatePath() {

		switch($this->smartyanytime['info']['extension']) {
			case('html'):
			case('htm'):
				$this->smartyanytime['info']['template_path'] = $this->smartyanytime['info']['template_dir'].'/tpl_'.$this->smartyanytime['info']['filename'];
				break;
			case('php'):
				$this->smartyanytime['info']['template_path'] = '';
				break;
			default:
				$this->smartyanytime['info']['template_path'] = '';
				break;
		}

		return true;
	}

	/**
	 *  SSL接続かどうかチェック
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return bool 処理結果
	 */
	function _checkSSL() {

		if( (empty($_SERVER['HTTPS'])===false) && ($_SERVER['HTTPS'])!='off') {
			$this->smartyanytime['info']['ssl'] = true;
		}
		elseif('https://' . $_SERVER['HTTP_HOST'].$this->smartyanytime['info']['wwwroot']==$this->smartyanytime['site']['site_url']) { // SSLアクセラレータ対応。。
			$this->smartyanytime['info']['ssl'] = true;
		}
		else {
			$this->smartyanytime['info']['ssl'] = false;
		}

		return true;
	}

	/**
	 *  実際にファイルがあるかチェックして存在したら出力
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 */
	function _checkRealFiles() {
		if($this->smartyanytime['info']['extension'] == 'html') {
			if(file_exists($this->smartyanytime['info']['path'])) {
				print file_get_contents($this->smartyanytime['info']['path']);
				exit();
			}
		}
	}

	/**
	 *  ページの種類を設定
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param string $url URL
	 *  @return string ファイルの種類
	 */
	function _getContentsType($url){
		if( $url == $this->smartyanytime['site']['page_404error'] ) return '404error';
		if( $this->smartyanytime['info']['extension'] == 'php' ) return 'php';

		return 'html';
	}

	/**
	 *  ステータスを設定
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param string $path テンプレートのパス
	 *  @param string $type タイプ
	 *  @return bool 処理結果
	 */
	function _getStatus($path,$type){
		if($type=='html'&&(!$path || !file_exists($path))) {
			$this->smartyanytime['info']['status']='404';
		}
		else {
			$this->smartyanytime['info']['status']='200';
		}

		return true;
	}

	/**
	 *  サイトの設定を取得・設定
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return array サイト設定
	 */
	function _getSiteSetting() {

		$setting = array();

		if( USE_DB == true ) {
			$setting = $this->_getSettingDB();
		}
		else {
			if( file_exists(CONF_DIR.'/site_setting.php') ) require_once(CONF_DIR.'/site_setting.php');
		}

		if(!$setting['site_url'] ) die('site setting Not Found');

		return $setting;
	}

	/**
	 *  Smartyの開始と設定
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return bool 処理結果
	 */
	function _setSmarty() {

		$function = array();

		// smarty開始
		$this->smarty = new SmartyATS;

		// smartyの設定
		$this->smarty->template_dir = './tpl/';
		$this->smarty->compile_dir  = SMARTY_COMPILE_DIR;
		$this->smarty->config_dir   = SMARTY_CONFIG_DIR;

		$this->smarty->debugging    = false;

		$this->smarty->left_delimiter="{{";
		$this->smarty->right_delimiter="}}";

		return true;
	}

	/**
	 *  プラグイン読込
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return bool 処理結果
	 */
	function _readPlugins() {

		$plugins = array();

		// ディレクトリを開く
		$dir = opendir( PLUGIN_DIR );
		if ($dir!==false) {
			$dir = dir( PLUGIN_DIR );
			while ( $file = $dir->read() ){
				if( $file=='..' || $file=='.' ) continue;
				if ( is_dir ( PLUGIN_DIR .'/' . $file ) == false ) {
					if(preg_match ( "/^smartyanytime.plugins\..+\.php$/i", $file, $match )==1) {
						// セット
						$plugins[] = PLUGIN_DIR .'/' . $file;
					}
				}
				else {
					$dir2 = opendir( PLUGIN_DIR .'/' . $file );
					if( $dir2!==false) {
						$dir2 = dir(PLUGIN_DIR .'/' . $file);

						while ( $file2 = $dir2->read() ){
							if( $file2=='..' || $file2=='.' ) continue;
							if ( is_dir ( PLUGIN_DIR .'/' . $file .'/' . $file2 ) == false ) {
								if(preg_match ( "/^smartyanytime.plugins\..+\.php$/i", $file2, $match )==1) {
									// セット
									$plugins[] = PLUGIN_DIR .'/' . $file .'/' . $file2;
								}
							}
						}
						$dir2->close();
					}
					else {
						$dir2->close();
						return false;
					}
				}
			}
			$dir->close();
		}
		else {
			$dir->close();
			return false;
		}

		// ソート
		asort($plugins);

		// 読込
		foreach ($plugins as $key => $val) {
			require_once($val);
		}

		return true;
	}

	/**
	 *  プラグインの登録
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param string $event イベント名
	 *  @param string $class クラス名
	 *  @param string $method メソッド名
	 *  @param int $order 処理順
	 *  @return bool 処理結果
	 */
	function registerPlugins($event,$class,$method,$order=100) {

		if( !isset($this->events[$event]) || !$this->events[$event] ) $this->events[$event]=array();
		if($order && !is_numeric($order)) $order = 100;
		while( isset($this->events[$event][$order])===true ) $order++;
		$set = array($order=>array($class,$method) );

		$this->events[$event] += $set;

		return true;
	}

	/**
	 *  プラグインの解除
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param string $event イベント名
	 *  @param string $class クラス名
	 *  @param string $method メソッド名
	 *  @return bool 処理結果
	 */
	function unregisterPlugins($event,$class,$method) {

		foreach($this->events[$event] as $key => $value) {
			if( $value[0] == $class && $value[1] == $method ) {
				unset($this->events[$event][$key]);
				break;
			}
		}

		return true;
	}

	/**
	 *  プログラムの登録
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @param string $path パス
	 *  @param string $class クラス名
	 *  @param string $method メソッド名
	 *  @param int $order 処理順
	 *  @return bool 処理結果
	 */
	function registerPrograms($path,$class,$method,$config="") {

		if( $config ) {
			$this->programs[$path] = array(array($class,$method,$config));
		}
		else {
			$this->programs[$path] = array(array($class,$method));
		}

		return true;
	}

	/**
	 *  登録されたプラグインの処理順にソート
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return bool 処理結果
	 */
	function _sortPluginsEvent() {

		$event = array('initialize','start','before','after','output');

		foreach($event as $value) {
			if(isset($this->events[$value]) && $this->events[$value]) {
				ksort($this->events[$value]);
				$this->events[$value] = array_values($this->events[$value]);
			}
		}

		return true;
	}

	/**
	 *  個別処理の実行
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return bool 処理結果
	 */
	function _runIndividualProcess() {

		$program = array();

		require_once(CONF_DIR.'/proglink.php');

		$program = array_merge($program,$this->programs);
//print_r($program);
		// ディレクトリ単位
		if( array_key_exists($this->smartyanytime['info']['dir'],$program) ) {
			$this->_runIndividualProcessCore($program[$this->smartyanytime['info']['dir']]);
		}

		// .html変換が行われていたら戻してあげる
		$url = $this->smartyanytime['info']['url'];
		if($this->smartyanytime['info']['transfer_html_ext']) $url = preg_replace('@\.html$@','.php',$url);

		// ページ単位
		if( array_key_exists($url,$program) ) {
			$this->_runIndividualProcessCore($program[$url]);
		}
		else {
			return false;
		}

		return true;
	}

	/**
	 *  個別処理の実行コア
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param array $program プラグイン情報
	 *  @return bool 処理結果
	 */
	function _runIndividualProcessCore($program) {

		if( !$program ) return false;
		foreach ($program as $key => $value) {
			if(!isset($value[0])) $value[0] = '';
			if(!isset($value[1])) $value[1] = '';
			if(!isset($value[2])) $value[2] = '';
			$this->_runPlugin(array($value[0],$value[1],$value[2]));
		}

		return true;
	}

	/**
	 *  イベントの実行
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param string $event イベント名
	 *  @return bool 処理結果
	 */
	function _eventTrigger($event) {

		if( !isset($this->events[$event]) || !$this->events[$event] ) return false;
		foreach ($this->events[$event] as $key => $value) {
			$this->_runPlugin($value);
		}

		// 設定をアサイン
		$tmp = $this->smartyanytime;
		unset($tmp['plugins']);
		$this->smarty->assign('smartyanytime' , $tmp);

		return true;
	}

	/**
	 *  プラグインの実行
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param array $plugin プラグイン情報
	 *  @return bool 処理結果
	 */
	function _runPlugin($plugin) {
		$config=array();
		$default_method = 'start';
		if( isset($plugin[2]) && $plugin[2] && file_exists(PLUGIN_DIR.$plugin[2]) ) require_once(PLUGIN_DIR.$plugin[2]);
		$method = ($plugin[1])?($plugin[1]):($default_method);
		if(!class_exists($plugin[0],false)) return false;
		$obj = new $plugin[0]($this->smartyanytime,$this->smartyanytime['data'],$this->smarty,$config);
		if(!method_exists($obj,$method) ) return false;
		call_user_func(array($obj,$method));

		// プラグインの格納
		$this->smartyanytime['plugins'][$plugin[0]] = $obj;

		return true;
	}

	/**
	 *  DBからサイト設定を取得
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @return array サイト設定
	 */
	function _getSettingDB() {

		$sql = "SELECT * FROM ".DB_PREFIX."sites WHERE id='1';";
		$query = @mysql_query ( $sql );

		if ( mysql_errno ( ) != 0 ) die('site setting Not Found(DB)');
		if ( mysql_num_rows ( $query ) == 0 ) die('site setting Not Found(DB)');

		$setting = mysql_fetch_assoc ( $query );

		return $setting;
	}

}
?>