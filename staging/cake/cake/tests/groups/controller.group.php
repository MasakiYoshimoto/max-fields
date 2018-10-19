<?php
/* SVN FILE: $Id: controller.group.php 25 2012-12-04 02:11:44Z arms $ */
/**
 * ControllerGroupTest file
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package       cake
 * @subpackage    cake.tests.groups
 * @since         CakePHP(tm) v 1.2.0.4206
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
/**
 * ControllerGroupTest
 *
 * @package       cake
 * @subpackage    cake.tests.groups
 */
class ControllerGroupTest extends GroupTest {
/**
 * label property
 *
 * @var string 'All cake/libs/controller/* (Not yet implemented)'
 * @access public
 */
	var $label = 'Component, Controllers, Scaffold test cases.';
/**
 * LibControllerGroupTest method
 *
 * @access public
 * @return void
 */
	function ControllerGroupTest() {
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'controller' . DS . 'controller');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'controller' . DS . 'scaffold');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'controller' . DS . 'pages_controller');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'controller' . DS . 'component');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'controller' . DS . 'controller_merge_vars');
	}
}
?>