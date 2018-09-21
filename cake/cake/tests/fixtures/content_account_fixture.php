<?php
/* SVN FILE: $Id: content_account_fixture.php 25 2012-12-04 02:11:44Z arms $ */
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
class ContentAccountFixture extends CakeTestFixture {
/**
 * name property
 *
 * @var string 'Aco'
 * @access public
 */
	var $name = 'ContentAccount';
	var $table = 'ContentAccounts';
/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'iContentAccountsId' => array('type' => 'integer', 'key' => 'primary'),
		'iContentId'		=> array('type' => 'integer'),
		'iAccountId'		=> array('type' => 'integer')
	);
/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array('iContentId' => 1, 'iAccountId' => 1),
		array('iContentId' => 2, 'iAccountId' => 2),
		array('iContentId' => 3, 'iAccountId' => 3),
		array('iContentId' => 4, 'iAccountId' => 4),
		array('iContentId' => 1, 'iAccountId' => 2),
		array('iContentId' => 2, 'iAccountId' => 3),
	);
}

?>