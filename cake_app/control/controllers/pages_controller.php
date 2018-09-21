<?php
/* SVN FILE: $Id: pages_controller.php 262 2013-05-17 00:31:05Z arms $ */
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 262 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2013-05-17 09:31:05 +0900 (金, 17 5 2013) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class PagesController extends AppController {
	/**
	 * Controller name
	 *
	 * @var string
	 * @access public
	 */
	var $name = 'Pages';
	/**
	 * Default helper
	 *
	 * @var array
	 * @access public
	 */
	var $helpers = array('Html');
	/**
	 * This controller does not use a model
	 *
	 * @var array
	 * @access public
	 */

	var $layout = "";

	var $components = array("obAuth","MySecurity","Cookie");
	var $uses = array("users");

	function beforeFilter(){
		$this->disableCache();
		$this->obAuth->startup($this);
		if($this->obAuth->lock(array())) $this->redirect('/tops');
	}

	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @access public
	 */
	function display() {

		$value = $this->Cookie->read('mlup');
		if($value) {
			if(USE_CRYPT_BLOWFISH){
				App::import('Vendor', 'Crypt_Blowfish', array('file' => 'Crypt' . DS . 'Blowfish.php'));
				$key = SECRET_KEYWORD;
				$key2 = SECRET_KEYWORD2;
				$blowfish =& new Crypt_Blowfish($key);
				$blowfish2 =& new Crypt_Blowfish($key2);
				$decrypt = $blowfish->decrypt(base64_decode($value));
				$a_value = explode('<|<>|>',$decrypt);
				$user = trim($a_value[0]);
				$id = trim($a_value[1]);
				$save_flag = true;
				//print_r($a_value);
			}
			else {
				if(strlen($value)==64) {
					$user_md5 = substr($value,0,32);
					$pass_md5 = substr($value,32);
					$save_flag = true;
				}
			}
		}

		if($save_flag == true ) {
			if(USE_CRYPT_BLOWFISH){
				$options['conditions'] = array('User.username = '=>$user,'User.id = '=>$id);
			}
			else {
				$options['conditions'] = array('md5(User.username) = '=>$user_md5,'User.password = '=>$pass_md5);
			}

			$user_data = $this->User->find('first',$options);
			if( !empty($user_data) ) {
				if(USE_CRYPT_BLOWFISH){
					$this->set('username', $user);
					$this->set('password', $blowfish2->decrypt(base64_decode($user_data['User']['password2'])));
				}
				else {
					$this->set('username', $user_data['User']['username']);
					$this->set('password', $user_data['User']['password2']);
				}
			}

			$this->set('save', 'true');
		}

		// トークン設定
		$this->MySecurity->settoken();

		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title'));
		$this->render(join('/', $path));
	}
}

?>