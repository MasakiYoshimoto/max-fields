<?php
/* SVN FILE: $Id: bootstrap.php 25 2012-12-04 02:11:44Z arms $ */
/**
 * Basic Cake functionality.
 *
 * Core functions for including other source files, loading models and so forth.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
if (!defined('PHP5')) {
	define('PHP5', (PHP_VERSION >= 5));
}
if (!defined('E_DEPRECATED')) {
	define('E_DEPRECATED', 8192);
}
if (!defined('E_STRICT')) {
	define('E_STRICT', 2048);
}
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
/**
 * Configuration, directory layout and standard libraries
 */
	if (!isset($bootstrap)) {
		require CORE_PATH . 'cake' . DS . 'basics.php';
		$TIME_START = getMicrotime();
		require CORE_PATH . 'cake' . DS . 'config' . DS . 'paths.php';
		require LIBS . 'object.php';
		require LIBS . 'inflector.php';
		require LIBS . 'configure.php';
	}
	require LIBS . 'cache.php';

	Configure::getInstance();

	$url = null;

	require CAKE . 'dispatcher.php';
?>