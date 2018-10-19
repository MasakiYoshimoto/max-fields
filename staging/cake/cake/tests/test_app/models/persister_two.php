<?php
/* SVN FILE: $Id: persister_two.php 25 2012-12-04 02:11:44Z arms $ */
/**
 * Test App Comment Model
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
 * @subpackage    cake.tests.test_app.models
 * @since         CakePHP v 1.2.0.7726
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class PersisterTwo extends AppModel {
	var $useTable = 'posts';
	var $name = 'PersisterTwo';

	var $actsAs = array('PersisterOneBehavior', 'TestPlugin.TestPluginPersisterOne');

	var $hasMany = array('Comment', 'TestPlugin.TestPluginComment');
}
?>