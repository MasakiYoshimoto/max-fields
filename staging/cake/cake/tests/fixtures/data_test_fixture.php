<?php
/* SVN FILE: $Id: data_test_fixture.php 25 2012-12-04 02:11:44Z arms $ */
/**
 * Short description for file.
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
 * @subpackage    cake.tests.fixtures
 * @since         CakePHP(tm) v 1.2.0.6700
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
/**
 * Short description for class.
 *
 * @package       cake
 * @subpackage    cake.tests.fixtures
 */
class DataTestFixture extends CakeTestFixture {
/**
 * name property
 *
 * @var string 'DataTest'
 * @access public
 */
	var $name = 'DataTest';
/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'count' => array('type' => 'integer', 'default' => 0),
		'float' => array('type' => 'float', 'default' => 0),
		//'timestamp' => array('type' => 'timestamp', 'default' => null, 'null' => true),
		'created' => array('type' => 'datetime', 'default' => null),
		'updated' => array('type' => 'datetime', 'default' => null)
	);
/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array();
}

?>