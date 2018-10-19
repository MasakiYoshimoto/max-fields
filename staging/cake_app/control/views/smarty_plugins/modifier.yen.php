<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_yen($string) {

	$string = str_replace('\\' , '￥' , $string );

    return $string;
}

/* vim: set expandtab: */

?>
