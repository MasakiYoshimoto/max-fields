<?php
/* SVN FILE: $Id: overloadable.test.php 25 2012-12-04 02:11:44Z arms $ */
/**
 * OverloadableTest file
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
 * @subpackage    cake.tests.cases.libs
 * @since         CakePHP(tm) v 1.2.0.5432
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
App::import('Core', 'Overloadable');
/**
 * OverloadableTest class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs
 */
class OverloadableTest extends CakeTestCase {
/**
 * skip method
 *
 * @access public
 * @return void
 */
	function skip() {
		$this->skipIf(true, ' %s OverloadableTest not implemented');
	}
}
?>