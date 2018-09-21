<?php
/* SVN FILE: $Id: fruits_uuid_tag_fixture.php 25 2012-12-04 02:11:44Z arms $ */
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
 * @since         CakePHP(tm) v 1.2.0.7953
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
class FruitsUuidTagFixture extends CakeTestFixture {
/**
 * name property
 *
 * @var string 'FruitsUuidTag'
 * @access public
 */
	var $name = 'FruitsUuidTag';
/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'fruit_id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'uuid_tag_id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'indexes' => array(
			'unique_fruits_tags' => array('unique' => true, 'column' => array('fruit_id', 'uuid_tag_id')),
		),
	);
/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array('fruit_id' => '481fc6d0-b920-43e0-a40d-6d1740cf8569', 'uuid_tag_id' => '481fc6d0-b920-43e0-e50f-6d1740cf8569')
	);
}
?>