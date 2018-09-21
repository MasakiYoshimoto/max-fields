<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty mb_truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     mb_truncate<br>
 * @param string
 * @param integer
 * @param string
 * @return string
 */
function smarty_modifier_mb_truncate($string, $length = 80, $etc = '...') {
    if ($length == 0) {return '';}

    if (mb_strlen($string) > $length) {
        return mb_substr($string, 0, $length).$etc;
    } else {
        return $string;
    }
}

/* vim: set expandtab: */

?>
