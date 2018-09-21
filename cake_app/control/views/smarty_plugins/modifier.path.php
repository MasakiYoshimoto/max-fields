<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty path modifier plugin
 *
 * Type:     modifier<br>
 * Name:     path<br>
 */
function smarty_modifier_path($url) {
	$a_info = parse_url($url);
	return $a_info['path'];
}

/* vim: set expandtab: */

?>
