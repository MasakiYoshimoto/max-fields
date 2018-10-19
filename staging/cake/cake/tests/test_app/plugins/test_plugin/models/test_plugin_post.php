<?php
/* SVN FILE: $Id: test_plugin_post.php 25 2012-12-04 02:11:44Z arms $ */
/**
 * Test Plugin Post Model
 *
 *
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc.
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc.
 * @link          http://cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package       cake
 * @subpackage    cake.cake.tests.test_app.plugins.test_plugin
 * @since         CakePHP v 1.2.0.4487
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class TestPluginPost extends TestPluginAppModel {
/**
 * Name property
 *
 * @var string
 */
	var $name = 'Post';
/**
 * useTable property
 *
 * @var string
 */
	var $useTable = 'posts';
}