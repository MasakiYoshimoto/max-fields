<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty ym_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     d_format<br>
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_ym_format($out_string, $format = "") {

	// 日付かどうか
	if( $out_string == "" ) return "";

	$tmp_string = $out_string.'/01';
	$tmp_string = str_replace('.','/',$tmp_string);
	$tmp_string = str_replace('-','/',$tmp_string);
	$datetime = strtotime( $tmp_string );
	if( $datetime == -1 || $datetime === false ) return $out_string;

	// フォーマットが無かったら規定
	if ( $format =="" ) $format = "Y/m/d H:i:s";

	// フォーマット
	$out_string = date( $format , $datetime );

	return $out_string;
}

/* vim: set expandtab: */

?>
