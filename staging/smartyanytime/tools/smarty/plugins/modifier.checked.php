<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty d_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     d_format<br>
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_checked($instring, $inarray) {

	if(!$inarray) return '';
	if( array_search($instring,$inarray)!==false && array_search($instring,$inarray)!==null ) return 'checked';
	return '';
}

/* vim: set expandtab: */

?>
