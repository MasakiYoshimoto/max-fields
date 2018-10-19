<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty unescape modifier plugin
 *
 * Type:     modifier<br>
 * Name:     unescape<br>
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_unescape($value, $encode = "UTF-8") {

	$out_string = mb_ereg_replace( "&yen;" , "￥" , $value );
	if((int)PHP_VERSION < 5){
		$out_string = unhtmlentities($out_string);
	}
	else {
		$out_string = html_entity_decode($value,ENT_COMPAT,$encode);
	}
	$out_string = mb_ereg_replace( "\\\\" , "￥" , $out_string );

	return $out_string;
}

function unhtmlentities($string) 
{
	// 数値エンティティの置換
	$string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
	$string = preg_replace('~&#([0-9]+);~e', 'chr(\\1)', $string);
	// 文字エンティティの置換
	$trans_tbl = get_html_translation_table(HTML_ENTITIES);
	$trans_tbl = array_flip($trans_tbl);
	return strtr($string, $trans_tbl);
}

/* vim: set expandtab: */

?>
