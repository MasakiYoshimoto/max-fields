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

class AppController extends Controller {

	var $view = 'SmartyEx';
	var $components = array();
	var $uses = array("User","Editmanage","Cmscategory","Plugin","Site","Title");
	var $group_id;
	var $use_plugins = array();
	var $site;
	var $categoryuse_num = 0;

	function beforeFilter(){

		$this->disableCache();
		mb_substitute_character(0x25A0);
		$this->set('group_id', $this->obAuth->getGroupId());
		$this->group_id = $this->obAuth->getGroupId();
//		$this->MyEditmanage->startup($this);
//		$this->MyEditmanage->clear();
		$this->_setCategorylist();

		$this->use_plugins = $this->_getUsePlugin();
		$this->_getPluginsInfo();
		$this->_setMenus();
		$this->_setLinks();
		$this->_setSiteInfo();
		$this->_setTitle();
		$this->_runHook('startup');

		$this->set('use_default_function', USE_DEFAULT_FUNCTION);
		$this->set('cms_category_allow_level', CMS_CATEGORY_ALLOW_LEVEL);
	}

	function _getPrefix($model = null) {
		$config = $this->{$model}->useDbConfig;    // 'default'
		$db =& ConnectionManager::getDataSource($config); // 'default'
		$prefix = $db->config['prefix'];     // 'prefix_'
		return $prefix;
	}

	function _setTitle() {
		$options['conditions'] = array('Title.id = '=>'1');
		$title = $this->Title->find('first',$options);
		if( $this->Title->sqlerror == false ) {
			exit();
		}

		$this->set('manage_title', $title['Title']['title']);
	}

	function _setCategorylist() {

		// カテゴリ情報取得
		$options = array();
		$options['conditions'] = array('Cmscategory.delete_flag = '=>'0');
		$options['order'] = array('Cmscategory.c_id ASC');
		$ca_data = $this->Cmscategory->find('all',$options);
		if( $this->Cmscategory->sqlerror == false ) {
			exit();
		}

		// ドキュメントカテゴリーを使用しているデータを取得
		$options = array();
		$options['conditions'] = array('Cmscategory.use_category = '=>'1','Cmscategory.delete_flag = '=>'0');
		$options['order'] = array('Cmscategory.c_id ASC');
		$useDocCategory = $this->Cmscategory->find('all',$options);
		if( $this->Cmscategory->sqlerror == false ) {
			exit();
		}

		// ドキュメントカテゴリーを使用しているデ件数を取得
		$ca_count = count($useDocCategory);

		$this->set('category_list', $ca_data);
		$this->set('use_category_list', $useDocCategory);
		$this->set('category_num', count($ca_data));
		$this->set('categoryuse_num', $ca_count);
		$this->categoryuse_num = $ca_count;
	}

	function _setSiteInfo() {

		$options = array('conditions' => array( 'id ='=>'1' ));
		$site = $this->Site->find('first' ,$options);
		if($this->Site->sqlerror == false) {
			exit();
		}

		$this->set('view_site', $site['Site']['site_url'].'/');
		$this->site = $site['Site'];
	}

	function _setMenus() {

		$allow_menus = array();

		$menus = Configure::read('plugins.menus');

		if($menus) {
			foreach ($menus as $key => $row) {
				if($this->use_plugins[$row['name']]) {
					$order[$key] = $row['order'];
					$allow_menus[] = $row;
				}
			}

			if($allow_menus) array_multisort($order, SORT_ASC, $allow_menus);
			$this->set('side_menus', $allow_menus);
		}

	}

	function _setLinks() {

		$allow_links = array();

		$links = Configure::read('plugins.links');

		if($links) {
			foreach ($links as $key => $row) {
				if($this->use_plugins[$row['name']]) {
					$order[$key] = $row['order'];
					$allow_links[] = $row;
				}
			}

			if($allow_links) array_multisort($order, SORT_ASC, $allow_links);

			$this->set('side_links', $allow_links);
		}
	}

	// フック処理
	function _runHook($hook_name, $params=array()) {

		// startup
		// doc_add_after
		// doc_edit_after
		// doc_del_before
		// doc_del_after
		// doc_sort_after

		$hook = Configure::read('plugins.hook');
		if($hook) {
			foreach ($hook as $key => $row) {
				if($this->use_plugins[$key]) {
					foreach ($row as $name => $value) {
						if($name != $hook_name) continue;
						foreach ($value as $runvalue) {
							$controller = ucwords($runvalue['name']).'.'.ucwords($runvalue['name']).'AppController';
							App::import('Controller',$controller);
							$classname = ucwords($runvalue['name']).'AppController';
							$runclass= new $classname;
							if(method_exists($runclass,$runvalue['method']) ) {
								call_user_func(array($runclass,$runvalue['method']), $params);
							}
						}
					}
				}
			}
		}
	}

	function _getPluginsInfo() {

		$plugins=array();

		$plugins_dir = ROOT.DS.APP_DIR.DS.'plugins'.DS;

		// ディレクトリを開く
		$dir = opendir($plugins_dir);
		if ($dir!==false) {
			$dir = dir($plugins_dir);

			while ( $file = $dir->read() ){
				if ( is_dir ( $plugins_dir . $file ) == false || $file=='.' || $file=='..' ) continue;
				$dir_obj = dir($plugins_dir . $file);
				while ( $file2 = $dir_obj->read() ){
				if ( is_dir ( $plugins_dir . $file . DS . $file2 ) || $file2!='info.php' ) continue;
					require_once($plugins_dir . $file . DS . $file2);
				}
				$dir_obj->close();

				if(file_exists($plugins_dir . $file . DS . 'config' . DS . 'const.php')) {
					require_once($plugins_dir . $file . DS . 'config' . DS . 'const.php');
				}
			}
			$dir->close();
		}
		else {
			$dir->close();
			return false;
		}

		return $plugins;

	}

	function _getUsePlugin() {

		$plugins = array();

		// 使用しているプラグイン情報取得
		$options['conditions'] = array('Plugin.status = '=>'1','Plugin.delete_flag = '=>'0');
		$options['order'] = array('Plugin.id ASC');
		$data = $this->Plugin->find('all',$options);
		if( $this->Plugin->sqlerror == false ) {
			exit();
		}

		for($i=0;$i<count($data);$i++) {
			$plugins[$data[$i]['Plugin']['name']] = $data[$i]['Plugin'];
		}

		return $plugins;
	}

	/**
	 *  画像の指定されたサイズ内になるように計算して返却
	 *  
	 *  @author H.Kobayashi
	 *  @access public
	 *  @filename string ファイル名
	 *  @w int 横サイズ
	 *  @h int 縦サイズ
	 *  @return bool 処理結果
	 */
	function _getWH($filename,$w=100,$h=100) {
		if ( file_exists($filename) == false ) return false;
		$img_status = getimagesize($filename);

		$width_old = $img_status[0];
		$height_old = $img_status[1];

		if( $width_old <= $w && $height_old <= $h ) {
			$width_new = $width_old;
			$height_new = $height_old;
		}
		else {
			$wper = $w / $width_old;
			$hper = $h / $height_old;

			$per = ( $wper <= $hper ) ? ($wper) : ( $hper );
			$width_new = round($width_old * $per);
			$height_new = round($height_old * $per);
		}

		return array('w'=>$width_new,'h'=>$height_new);
	}
}
?>