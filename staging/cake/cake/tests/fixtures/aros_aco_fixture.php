<?php
/* SVN FILE: $Id: aros_aco_fixture.php 25 2012-12-04 02:11:44Z arms $ */
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
 * @since         CakePHP(tm) v 1.2.0.4667
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
class ArosAcoFixture extends CakeTestFixture {
/**
 * name property
 *
 * @var string 'ArosAco'
 * @access public
 */
	var $name = 'ArosAco';
/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'aro_id' => array('type' => 'integer', 'length' => 10, 'null' => false),
		'aco_id' => array('type' => 'integer', 'length' => 10, 'null' => false),
		'_create' => array('type' => 'string', 'length' => 2, 'default' => 0),
		'_read' => array('type' => 'string', 'length' => 2, 'default' => 0),
		'_update' => array('type' => 'string', 'length' => 2, 'default' => 0),
		'_delete' => array('type' => 'string', 'length' => 2, 'default' => 0)
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