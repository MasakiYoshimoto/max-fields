<?php
/* SVN FILE: $Id: datatype_fixture.php 25 2012-12-04 02:11:44Z arms $ */
/**
 * Short description for file.
 *
 * Long description for file
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
 * @subpackage    cake.tests.fixtures
 * @since         CakePHP(tm) v 1.2.0.7026
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * @package       cake
 * @subpackage    cake.tests.fixtures
 */
class DatatypeFixture extends CakeTestFixture {
/**
 * name property
 *
 * @var string 'Datatype'
 * @access public
 */
	var $name = 'Datatype';
/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'null'=> false, 'default'=> 0, 'key' => 'primary'),
		'float_field' => array('type' => 'float', 'length' => '5,2', 'null' => false, 'default' => null),
	);
/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array('id' => 1, 'float_field' => 42.23),
	);
}

?>