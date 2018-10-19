<?php

	function auth () {

		// DB設定
		$cake_db = new DATABASE_CONFIG;
		$db_config = $cake_db->default;

		// セッションID取得
		$sessid = $_COOKIE['CAKEPHP'];
		if(!$sessid) return false;

		// 接続処理
		$res = mysql_connect ( $db_config['host'] . ":" . $db_config['port'] , $db_config['login'] , $db_config['password'] );
		if($res==false) return false;

		if( function_exists('mysql_set_charset') ) {
			mysql_set_charset($db_config['encoding']);
		}
		else {
			mysql_query( "SET NAMES " , $res);
		}

		// DBの選択
		if(mysql_select_db($db_config['database'],$res)==false) return false;

		// CAKEセッションデータの取得
		$query = mysql_query('SELECT data FROM '.$db_config['prefix'].'cake_sessions WHERE id="'.mysql_real_escape_string($sessid).'";');
		if ( mysql_errno ( ) != 0 ) return false;
		if ( mysql_num_rows ( $query ) == 0 ) return false;
		$sessdata = mysql_fetch_assoc ( $query );

		// セッションへ設定
		if(!isset($_SESSION)) {
			session_start();
			$_SESSION = array(); // 初期化
		}

		$tmp = $_SESSION;

		session_decode($sessdata['data']);

		if(!$_SESSION['arms_product_cake']['User']['id'] || $sessdata['expires'] < time() || $_SESSION['loginUserAgent'] != sha1($_SERVER['HTTP_USER_AGENT'])) {
			$_SESSION = $tmp;
			return false;
		}

		$_SESSION = $tmp;
		return true;

	}

?>