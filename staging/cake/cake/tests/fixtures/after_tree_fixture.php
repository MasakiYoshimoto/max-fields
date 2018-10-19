<?php
/* SVN FILE: $Id: after_tree_fixture.php 25 2012-12-04 02:11:44Z arms $ */
/**
 * Short description for after_tree_fixture.php
 *
 * Long description for after_tree_fixture.php
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * @link          http://www.cakephp.org
 * @package       cake
 * @subpackage    cake.tests.fixtures
 * @since         1.2
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * AdFixture class
 *
 * @package       cake
 * @subpackage    cake.tests.fixtures
 */
class AfterTreeFixture extends CakeTestFixture {
/**
 * name property
 *
 * @var string 'AfterTree'
 * @access public
 */
	var $name = 'AfterTree';
/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'parent_id' => array('type' => 'integer'),
		'lft' => array('type' => 'integer'),
		'rght' => array('type' => 'integer'),
		'name' => array('type' => 'string', 'length' => 255, 'null' => false)
	);
/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array('parent_id' => null, 'lft' => 1,  'rght' => 2, 'name' => 'One'),
		array('parent_id' => null, 'lft' => 3,  'rght' => 4, 'name' => 'Two'),
		array('parent_id' => null, 'lft' => 5,  'rght' => 6, 'name' => 'Three'),
		array('parent_id' => null, 'lft' => 7, 'rght' => 12, 'name' => 'Four'),
		array('parent_id' => null, 'lft' => 8,  'rght' => 9, 'name' => 'Five'),
		array('parent_id' => null, 'lft' => 10, 'rght' => 11, 'name' => 'Six'),
		array('parent_id' => null, 'lft' => 13, 'rght' => 14, 'name' => 'Seven')
	);
}
?>