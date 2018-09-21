<?php 
class ArmsComponent {

	var $controller;

	function startup(&$controller) {
		$this->controller =& $controller;
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
	function AuthenticMd5($key, $value) {
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
	 *  @in_enc string 文字エンコード
	 *  @return mix htmlentitiesの処理後の値
	 */
	function htmlentities_extend($in_valu,$in_enc="UTF-8") {
		if( is_array($in_value) === FALSE ) {
			return htmlentities($in_value,ENT_COMPAT,$in_enc);
		}
		else {
			foreach ($in_value as $key => $value) {
				if( is_array($value) === TRUE ) {
					$in_value[$key] = $this->htmlentities_extend($value,$in_enc);
				}
				else {
					$in_value[$key] = htmlentities($value,ENT_COMPAT,$in_enc);
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
	 *  @in_enc string 文字エンコード
	 *  @return mix html_entity_decodeの処理後の値
	 */
	function htmlentitydecode_extend($in_value,$in_enc="UTF-8") {
		if( is_array($in_value) === FALSE ) {
			return html_entity_decode($in_value,ENT_COMPAT,$in_enc);
		}
		else {
			foreach ($in_value as $key => $value) {
				if( is_array($value) === TRUE ) {
					$in_value[$key] = $this->htmlentitydecode_extend($value,$in_enc);
				}
				else {
					$in_value[$key] = html_entity_decode($value,ENT_COMPAT,$in_enc);
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
	function replace_extend($search_string , $replace_string ,$in_value) {
		if( is_array($in_value) === FALSE ) {
			return mb_ereg_replace ( $search_string , $replace_string , $in_value );
		}
		else {
			foreach ($in_value as $key => $value) {
				if( is_array($value) === TRUE ) {
					$in_value[$key] = $this->replace_extend( $search_string , $replace_string , $value);
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
	function mysql_real_escape_string_extend($in_value , $db) {
		if( is_array($in_value) === FALSE ) {
			return mysql_real_escape_string ( $in_value , $db );
		}
		else {
			foreach ($in_value as $key => $value) {
				if( is_array($value) === TRUE ) {
					$in_value[$key] = $this->mysql_real_escape_string_extend( $value , $db );
				}
				else {
					$in_value[$key] = mysql_real_escape_string ( $value , $db );
				}
			}
			return $in_value;
		}
	}

	/**
	 *  変数もしくは配列の値に対して文字コード変換を行う
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @in_value mix 値
	 *  @from_encode 変換前エンコード
	 *  @to_encode 変換後エンコード
	 *  @return mix mb_convert_encoding_extendの処理後の値
	 */
	function mb_convert_encoding_extend($in_value , $from_encode , $to_encode ) {
		if( is_array($in_value) === FALSE ) {
			return mb_convert_encoding ( $in_value , $to_encode , $from_encode );
		}
		else {
			foreach ($in_value as $key => $value) {
				if( is_array($value) === TRUE ) {
					$in_value[$key] = $this->mb_convert_encoding_extend( $value , $from_encode , $to_encode );
				}
				else {
					$in_value[$key] = mb_convert_encoding ( $value , $to_encode , $from_encode );
				}
			}
			return $in_value;
		}
	}

}

?>