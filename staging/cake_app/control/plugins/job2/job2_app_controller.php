<?php
/* SVN FILE: $Id: app_controller.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class Job2AppController extends AppController {

	function beforeFilter(){
		parent::beforeFilter();
	}

	/**
	 *  対象の画像のキャッシュを削除
	 *  
	 *  @author H.Kobayashi
	 *  @access public
	 *  @return bool 処理結果
	 */
	function _delCache($target) {
		if(!$target) return false;
		$target = explode('.',basename($target));
		if(count($target) < 2 ) return false;// 拡張子がないので終了
		$extension = end($target);
		array_pop($target); // 拡張子部分を除去
		$target = implode('',$target);

		return rm(CLEAR_CACHE_PATH . $target.'_*');

	}
}
?>