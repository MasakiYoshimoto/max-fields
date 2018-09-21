<?php
class smartyanytime_util {

	/**
	 *  文字列中のキーに対して置換
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @in_value mix 置換値
	 *  @text string 文字列
	 *  @return string 置換処理後の値
	 */
	function replaceText ( $in_value , $txt ) {
		if( is_array( $in_value ) ) {
			foreach ($in_value as $key => $value) {
				$txt = smartyanytime_util::replaceExtend("{{" . $key . "}}" , $value , $txt );
			}
		}
		return ( $txt );
	}

	/**
	 *  変数もしくは配列の値に対してstrip_tagsを行う
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @in_value mix 値
	 *  @return mix strip_tagsの処理後の値
	 */
	function stripTagsExtend($in_value) {

		if( is_object($in_value) ) return $in_value;

		if( is_array($in_value) === false ) {
			return strip_tags ( $in_value );
		}
		else {
			foreach ($in_value as $key => $value) {

				if( is_object($value) ) continue;

				if( is_array($value) === true ) {
					$in_value[$key] = smartyanytime_util::stripTagsExtend( $value );
				}
				else {
					$in_value[$key] = strip_tags ( $value );
				}
			}
			return $in_value;
		}
	}

	/**
	 *  変数もしくは配列の値に指定した文字が含まれるか
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @pattern string 検索するパターン値
	 *  @subject string 検索元の文字列
	 *  @couunt int ヒット数初期値　通常は０
	 *  @return int ヒットした件数
	 */
	function pregmatchExtend($pattern , $subject ,$couunt = 0) {

		if( is_object($in_value) ) return $in_value;

		if( is_array($subject) === false ) {
			return $couunt + preg_match ( $pattern , $subject );
		}
		else {
			foreach ($subject as $key => $value) {

				if( is_object($value) ) continue;

				if( is_array($value) === true ) {
					$couunt= smartyanytime_util::pregmatchExtend( $pattern , $value , $couunt );
				}
				else {
					$couunt = $couunt + preg_match ( $pattern , $value );
				}
			}
			return $couunt;
		}
	}

	/**
	 *  128bitのMD5暗号化
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @key string キー
	 *  @value string 値
	 *  @return string 生成されたMD5暗号
	 */
	function _AuthenticMd5($key, $value) {
		$one = $key;$two = $value;$thr = $one . $two;$fou = $thr . $one;$fiv = $fou . $one;
		$six = $thr . $thr;$sev = $one . $two . $thr . $one;
		$md1 = md5( $sev . $two . md5($one . $fiv . md5($sev . strrev( $sev))));
		$md2 = md5( $md1 . md5( $one . $thr . $fou . md5( $sev . $md1)));
		$md3 = md5( $md2 . md5($md1));
		$md4 = md5( $md3 . $md1 . $md2 . md5($sev));
		return $md2 . $md1. $md4 . md5($md3 . $md2);
	}

	/**
	 *  変数もしくは配列の値に対してhtmlentitiesを行う
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @in_value mix 値
	 *  @encode string 文字エンコード
	 *  @return mix htmlentitiesの処理後の値
	 */
	function htmlentitiesExtend($in_value,$encode='utf-8') {

		if( is_object($in_value) ) return $in_value;

		if( is_array($in_value) === false ) {
			return htmlentities($in_value,ENT_QUOTES,$encode);
		}
		else {
			foreach ($in_value as $key => $value) {

				if( is_object($value) ) continue;

				if( is_array($value) === true ) {
					$in_value[$key] = smartyanytime_util::htmlentitiesExtend($value,$encode);
				}
				else {
					$in_value[$key] = htmlentities($value,ENT_QUOTES,$encode);
				}
			}
			return $in_value;
		}
	}

	/**
	 *  変数もしくは配列の値に対してhtml_entity_decodeを行う
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @in_value mix 値
	 *  @encode string 文字エンコード
	 *  @return mix html_entity_decodeの処理後の値
	 */
	function htmlentitydecodeExtend($in_value,$encode='utf-8') {

		if( is_object($in_value) ) return $in_value;

		if( is_array($in_value) === false ) {
			return html_entity_decode($in_value,ENT_QUOTES,$encode);
		}
		else {
			foreach ($in_value as $key => $value) {

				if( is_object($value) ) continue;

				if( is_array($value) === true ) {
					$in_value[$key] = smartyanytime_util::htmlentitydecodeExtend($value,$encode);
				}
				else {
					$in_value[$key] = html_entity_decode($value,ENT_QUOTES,$encode);
				}
			}
			return $in_value;
		}
	}

	/**
	 *  変数もしくは配列の値に対して置換を行う
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @search_string string 置換する値
	 *  @replace_string string 置換後の値
	 *  @in_value mix 値
	 *  @return mix 置換処理後の値
	 */
	function replaceExtend($search_string , $replace_string ,$in_value) {

		if( is_object($in_value) ) return $in_value;

		if( is_array($in_value) === false ) {
			return mb_ereg_replace ( $search_string , $replace_string , $in_value );
		}
		else {
			foreach ($in_value as $key => $value) {

				if( is_object($value) ) continue;

				if( is_array($value) === true ) {
					$in_value[$key] = smartyanytime_util::replaceExtend( $search_string , $replace_string , $value);
				}
				else {
					$in_value[$key] = mb_ereg_replace ( $search_string , $replace_string , $value );
				}
			}
			return $in_value;
		}
	}

	/**
	 *  変数もしくは配列の値に対してmysql_real_escape_stringを行う
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @in_value mix 値
	 *  @db res DB接続リソース
	 *  @return mix html_entity_decodeの処理後の値
	 */
	function mysqlresExtend($in_value , $db) {

		if( is_object($in_value) ) return $in_value;

		if( is_array($in_value) === false ) {
			return mysql_real_escape_string ( $in_value , $db );
		}
		else {
			foreach ($in_value as $key => $value) {

				if( is_object($value) ) continue;

				if( is_array($value) === true ) {
					$in_value[$key] = smartyanytime_util::mysqlresExtend( $value , $db );
				}
				else {
					$in_value[$key] = mysql_real_escape_string ( $value , $db );
				}
			}
			return $in_value;
		}
	}

	/**
	 *  ヘッダの出力
	 *
	 *  @author H.Kobayashi
	 *  @access private
	 *  @param int $type タイプ(404 403 501)
	 *  @return bool 処理結果
	 */
	function outputHeader($type){

		$protocol = $_SERVER["SERVER_PROTOCOL"];
		if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol ) $protocol = 'HTTP/1.0';
		if(substr(strtolower(php_sapi_name()), 0, 3)=='cgi') $protocol = "Status:";

		switch ($type) {
			case '404':
				header($protocol . " 404 Not Found");
				break;
			case '403':
				header($protocol . " 403 Forbidden");
				break;
			case '501':
				header($protocol . " 501 Not Implemented");
				break;
		}

		return true;
	}

	/**
	 *  Smartyへアサイン
	 *
	 *  @author H.Kobayashi
	 *  @param string $name アサイン名
	 *  @param mix $value アサイン値
	 *  @param obj $smarty smartyオブジェクト
	 *  @param bool $flag エンティティ処理フラグ
	 *  @return bool 処理結果
	 */
	function assign($name,$value,&$smarty,$flag=true ) {
		if( $flag==true ) {
			$value = smartyanytime_util::htmlentitiesExtend( $value , 'utf-8' );
			$value = smartyanytime_util::replaceExtend( "\\\\" , "￥" ,$value );
		}
		$smarty->assign($name,$value);
	}

	// ユニークなIDを生成（CAKEPHP使用のを改変）
	function uuid() {

		$node = $_SERVER['SERVER_ADDR'];
		$pid = null;

		if (strpos($node, ':') !== false) {
			if (substr_count($node, '::')) {
				$node = str_replace('::', str_repeat(':0000', 8 - substr_count($node, ':')) . ':', $node);
			}
			$node = explode(':', $node) ;
			$ipv6 = '' ;

			foreach ($node as $id) {
				$ipv6 .= str_pad(base_convert($id, 16, 2), 16, 0, STR_PAD_LEFT);
			}
			$node =  base_convert($ipv6, 2, 10);

			if (strlen($node) < 38) {
				$node = null;
			} else {
				$node = crc32($node);
			}
		} elseif (empty($node)) {
			$host = php_uname("n");

			if (empty($host)) {
				$host = $_SERVER["SERVER_NAME"];
			}

			if (!empty($host)) {
				$ip = gethostbyname($host);

				if ($ip === $host) {
					$node = crc32($host);
				} else {
					$node = ip2long($ip);
				}
			}
		} elseif ($node !== '127.0.0.1') {
			$node = ip2long($node);
		} else {
			$node = null;
		}

		if (empty($node)) {
			$node = crc32('arms_uuid_seed');
		}

		if (function_exists('zend_thread_id')) {
			$pid = zend_thread_id();
		} else {
			$pid = getmypid();
		}

		list($timeMid, $timeLow) = explode(' ', microtime());
		$uuid = sprintf("%08x-%04x-%04x-%02x%02x-%04x%08x", (int)$timeLow, (int)substr($timeMid, 2) & 0xffff,mt_rand(0, 0xfff) | 0x4000, mt_rand(0, 0x3f) | 0x80, mt_rand(0, 0xff), $pid, $node);

		return $uuid;

	}


	// サニタイズ処理
	// SQL文字のエスケープは実行前、
	// HTMLエンティティは表示時にやるので、ここでは処理しない

	/**
	 * 	サニタイズ処理
	 * SQL文字のエスケープは実行前、
	 * HTMLエンティティは表示時にやるので、ここでは処理しない
	 *
	 * @param $data
	 * @return array|mixed
	 */
	function clean($data) {
		if (empty($data)) {
			return $data;
		}

		if (is_array($data)) {
			foreach ($data as $key => $val) {
				$data[$key] = smartyanytime_util::clean($val);
			}
			return $data;
		} else {
				$data = str_replace(chr(0xCA), '', str_replace(' ', ' ', $data));
				$data = str_replace("\\\$", "$", $data);
				$data = str_replace("\r", "", $data);
				$data = str_replace("'", "'", str_replace("!", "!", $data));
				$data = preg_replace("/&amp;#([0-9]+);/s", "&#\\1;", $data);
				$data = preg_replace("/\\\(?!&amp;#|\?#)/", "\\", $data);

			return $data;
		}
	}
}

/**
 * rm() -- Vigorously erase files and directories.
 * 
 * @param $fileglob mixed If string, must be a file name (foo.txt), glob pattern (*.txt), or directory name.
 *                        If array, must be an array of file names, glob patterns, or directories.
 */
function rm($fileglob) {
	if (is_string($fileglob)) {
		if (is_file($fileglob)) {
			return unlink($fileglob);
		}
		else if (is_dir($fileglob)) { // ディレクトリは削除しない
			return false;
		}
		else {
			$matching = glob($fileglob);
			if ($matching === false) {
				return false;
			}
			$rcs = array_map('rm', $matching);
			if (in_array(false, $rcs)) {
				return false;
			}
		}
	}
	else if (is_array($fileglob)) {
		$rcs = array_map('rm', $fileglob);
		if (in_array(false, $rcs)) {
			return false;
		}
	}
	else {
		return false;
	}

	return true;
}
?>