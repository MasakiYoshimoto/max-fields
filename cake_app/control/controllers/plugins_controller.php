<?php
class PluginsController extends AppController
{
	var $name = "Plugins";
	var $uses = array("Plugin");
	var $components = array("obAuth","MySecurity","Arms");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array(99))) $this->redirect('/');
		parent::beforeFilter();
	}

	function index() {

		// 使用しているプラグイン情報取得
		$options['conditions'] = array('Plugin.status = '=>'1','Plugin.delete_flag = '=>'0');
		$options['order'] = array('Plugin.id ASC');
		$data = $this->Plugin->find('all',$options);
		if( $this->Plugin->sqlerror == false ) {
			exit();
		}

		$setup = Configure::read('plugins.setup');

		if($setup) {
			foreach ($setup as $key => $row) {
				if(!$this->use_plugins[$row['name']]) {
					$setup_list[] = $row;
				}
			}
		}
		$this->MySecurity->settoken();

		$this->set('plugin_list', $data);
		$this->set('setup_list', $setup_list);
	}

	function install() {

		// 二重インストール禁止
		if(!$this->MySecurity->checktoken('Plugins')) {
			$this->MySecurity->settoken();
			$this->redirect('/plugins');
			exit();
		}

		// バリデート
		$this->Plugin->setValidation('install');
		$this->Plugin->create($this->data['Plugins']);

		if(!$this->Plugin->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Plugin->invalidFields());
			$this->redirect('/plugins/');
			exit();
		}

		// インストール済みか
		$options=array();
		$options['conditions'] = array('name = '=>$this->data['Plugins']['name'],'delete_flag ='=>0);
		$plugin_count = $this->Plugin->find('count',$options);
		if($plugin_count!=0) {
			$this->redirect('/plugins/');
		}

		$setup = Configure::read('plugins.setup.'.$this->data['Plugins']['name']);
		if(!$setup) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// データの整理
		$add_data['name'] = $setup['name'];
		$add_data['jname'] = $setup['jname'];
		$add_data['dec'] = $setup['dec'];
		$add_data['db'] = $setup['db'];

		$up_list = array('name','jname','dec','db');
		$this->Plugin->create();
		$this->Plugin->save($add_data,false,$up_list);
		if($this->Plugin->sqlerror == false) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		if( $setup['install'] && file_exists(ROOT.DS.APP_DIR.DS.'plugins'.DS.$setup['name'].DS.$setup['install']) ) {
			$sql = file_get_contents(ROOT.DS.APP_DIR.DS.'plugins'.DS.$setup['name'].DS.$setup['install']);
			$prefix = $this->_getPrefix('Plugin');
			$sql = str_replace('{{$prefix}}',$prefix,$sql);

			if( !$this->_import($sql) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

		}

	}

	function _import($insql) {
		$sql="";
		$a_sql = explode("\n",$insql);

		for($i=0;$i<count($a_sql);$i++) {
			$temp = "";
			$temp =  $a_sql[$i];
			
			if(mb_substr($temp , 0 , 1) == "#") continue;

			$check  = mb_substr($temp , mb_strlen($temp)-1 , 1);

			$sql .=$temp;
			if( $check == ";") {
				$sql = mb_substr($sql , 0 , mb_strlen($sql)-1);
				$this->Plugin->query($sql);
				if ( mysql_errno () != 0 ) return false;
				$sql = "";
			}
		}

		return true;
	}
}
?>
