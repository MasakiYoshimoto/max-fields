<?php
/* SVN FILE: $Id: tests_apps_posts_controller.php 25 2012-12-04 02:11:44Z arms $ */
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
 * @subpackage    cake.tests.test_app.plugins.test_plugin.views.helpers
 * @since         CakePHP(tm) v 1.2.0.4206
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
class TestsAppsPostsController extends AppController {
	var $name = 'TestsAppsPosts';
	var $uses = array('Post');
	var $viewPath = 'tests_apps';

	function add() {
		$data = array(
			'Post' => array(
				'title' => 'Test article',
				'body' => 'Body of article.',
				'author_id' => 1
			)
		);
		$this->Post->save($data);

		$this->set('posts', $this->Post->find('all'));
		$this->render('index');
	}
/**
 * check url params
 *
 */
	function url_var() {
		$this->set('params', $this->params);
		$this->render('index');
	}
/**
 * post var testing
 *
 */
	function post_var() {
		$this->set('data', $this->data);
		$this->render('index');
	}
/**
 * Fixturized action for testAction()
 *
 */
	function fixtured() {
		$this->set('posts', $this->Post->find('all'));
		$this->render('index');
	}

}
?>