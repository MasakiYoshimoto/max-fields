<?php
class TopsController extends AppController
{
	var $name = "Tops";
	var $uses = array("Analytics","Plugin");
	var $components = array("obAuth");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array())) $this->redirect('/');
		$this->_deletefile();
		parent::beforeFilter();
	}

	function index() {

		// フリースペース用情報の取得
		$allow_freespace = array();
		$free_space_html = '';

		$freespace = Configure::read('plugins.freespace');

		if($freespace) {
			foreach ($freespace as $key => $row) {
				if($this->use_plugins[$row['name']]) {
					$order[$key] = $row['order'];
					$allow_freespace[] = $row;
				}
			}

			if($allow_freespace) array_multisort($order, SORT_ASC, $allow_freespace);
		}

		for($i=0;$i<count($allow_freespace);$i++) {
			$free_space_html .= @file_get_contents($allow_freespace[$i]['url']);
		}

		// フリースペースを設定
		$this->set('free_space', $free_space_html);

		// アナリティクス設定を取得する
		$options = array('conditions' => array( 'id ='=>'1' ));
		$analytics = $this->Analytics->find('first' ,$options);
		if($this->Analytics->sqlerror == false) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// アナリティクスグラフ設定
		$start_date = date('Y-m-d',strtotime('-11 day'));

		for($i=1;$i<=10;$i++) {
			$date_list[] = date('m/d',strtotime($start_date .' +'.$i.' day'));
		}

		$period1 = date('Y/m/d',strtotime('-10 day')).'～'.date('Y/m/d',strtotime('-1 day'));
		$period2 = date('Y/m/d',strtotime('-1 month',strtotime('-1day'))).'～'.date('Y/m/d',strtotime('-1 day'));

		// セッションを削除する
		$this->Session->del('documents_word');
		$this->Session->del('edit_conf_data');
		$this->Session->del('documents_c_id');
		$this->Session->del('documents_data');
		$this->Session->del('documents_d_id');
		$this->Session->del('items_c_id');
		$this->Session->del('documents_pages');
		$this->Session->del('doccategories_c_id');
		$this->Session->del('plugins');

		$this->set('period1', $period1);
		$this->set('period2', $period2);
		$this->set('date_list', "'".implode("','",$date_list)."'");
		$this->set('analytics', $analytics['Analytics']);

	}

	/**
	 *  古いファイルを削除する
	 *  
	 *  @author H.Kobayashi
	 *  @access public
	 *  @return bool 処理結果
	 */
	function _deletefile() {
		// ディレクトリを開く
		$dir = opendir(FILE_TEMP_DIR);
		if ($dir!==false) {
			$dir = dir(FILE_TEMP_DIR);

			while ( $file = $dir->read() ){
				if ( is_dir ( FILE_TEMP_DIR . $file ) == false ) {
					if(filemtime(FILE_TEMP_DIR . $file) <= mktime(23,59,59,date('m'),date('d')-DELETE_DAYS,date('Y'))) {
						// 経過していたら削除
						if(unlink( FILE_TEMP_DIR . $file) === false) {
							return false;
						}
					}
				}
			}
			$dir->close();
		}
		else {
			$dir->close();
			return false;
		}
		return true;
	}

//	function _getPluginsInfo() {
//
//		$plugins=array();
//
//		$plugins_dir = ROOT.DS.APP_DIR.DS.'plugins'.DS;
//
//		// ディレクトリを開く
//		$dir = opendir($plugins_dir);
//		if ($dir!==false) {
//			$dir = dir($plugins_dir);
//
//			while ( $file = $dir->read() ){
//				if ( is_dir ( $plugins_dir . $file ) == false || $file=='.' || $file=='..' ) continue;
//				$dir_obj = dir($plugins_dir . $file);
//				while ( $file2 = $dir_obj->read() ){
//				if ( is_dir ( $plugins_dir . $file . DS . $file2 ) || $file2!='info.php' ) continue;
//					$info = array();
//					require_once($plugins_dir . $file . DS . $file2);
//					if(!$info) continue;
//					$info['plugin_path'] = $plugins_dir . $file . DS;
//					$info['sql_path'] = ($info['install'])?($plugins_dir . $file . DS . $info['install']):('');
//					$plugins[] = $info;
//				}
//				$dir_obj->close();
//			}
//			$dir->close();
//		}
//		else {
//			$dir->close();
//			return false;
//		}
//
//		return $plugins;
//
//	}

}
?>
