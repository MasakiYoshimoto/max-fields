<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty wd_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     d_format<br>
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_wd_format($out_string) {

	// 日付かどうか
	if( $out_string == "" || $out_string == "0000-00-00 00:00:00" || $out_string == "0000-00-00" ) return "";
	$datetime = strtotime( $out_string );
	if( $datetime == -1 || $datetime === FALSE ) return $out_string;

	// フォーマット
	$out_string = _to_wareki(date( "Y" , $datetime ), date( "m" , $datetime ), date( "d" , $datetime ));

	return $out_string;
}

function _to_wareki($y, $m, $d){
	//年月日を文字列として結合
	$ymd = sprintf("%02d%02d%02d", $y, $m, $d);
	if ($ymd <= "19120729") {
		$gg = "明治";
		$yy = $y - 1867;
	} elseif ($ymd >= "19120730" && $ymd <= "19261224") {
		$gg = "大正";
		$yy = $y - 1911;
	} elseif ($ymd >= "19261225" && $ymd <= "19890107") {
		$gg = "昭和";
		$yy = $y - 1925;
	} elseif ($ymd >= "19890108") {
		$gg = "平成";
		$yy = $y - 1988;
	}
	$wareki = "{$gg}{$yy}年{$m}月{$d}日";
	return $wareki;
}

/* vim: set expandtab: */

?>
