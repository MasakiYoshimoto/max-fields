<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_imgsize($string,$filepath = "",$width=100,$height=100,$flag='width') {

	// デフォルトサイズ
	$default_size=100;

	// 存在チェック
	$file = '/usr/home/z102212/html'.$filepath.$string;
	if(file_exists($file)==false) return $default_size;

	clearstatcache();

	// 画像情報取得
	$img_info = getimagesize($file);
	if($img_info==false) return $default_size;

	// 画像以外は終了
	if( $img_info[2] != IMAGETYPE_GIF && $img_info[2] != IMAGETYPE_JPEG && $img_info[2] != IMAGETYPE_PNG ) return $default_size;

	$width_old = $img_info[0];
	$height_old = $img_info[1];

	if( $width >= $width_old && $height >= $height_old ) {
		$width_new = $width_old;
		$height_new = $height_old;
	}
	else {
		$wper = $width / $width_old;
		$hper = $height / $height_old;

		$per = ( $wper <= $hper ) ? ($wper) : ( $hper );
		$width_new = round($width_old * $per);
		$height_new = round($height_old * $per);
	}

	if($flag=='width') {
		return $width_new;
	}
	elseif($flag=='height') {
		return $height_new;
	}
	else {
		return $default_size;
	}

}

/* vim: set expandtab: */

?>
