<?php 
class MyEditmanageComponent extends Object {

	var $components = array('RequestHandler', 'Session');
	var $controller;
	var $checkcontroller = array(
								"cmsdocuments"=>array("edit","editdo","del")
							);

	function startup(&$controller) {
		$this->controller =& $controller;
	}

	function check($d_id) {

		$prefix = $this->_getPrefix('Editmanage');

		if(isset($this->checkcontroller[strtolower($this->controller->params['controller'])])) { // 該当コントローラーか
			$checkvalue = $this->checkcontroller[strtolower($this->controller->params['controller'])];
			$action = $this->controller->action;
			if( array_search($action,$checkvalue)!==null && array_search($action,$checkvalue)!==false ) { // 該当アクションか

				$options['conditions'] = array('Editmanage.session_id != '=>session_id(),'Editmanage.edit_id = '=>$d_id);
				$result = $this->controller->Editmanage->find($options['conditions'],null,null);
				if(!empty($result)) return false;

				$options['conditions'] = array('Editmanage.session_id = '=>session_id());
				$result = $this->controller->Editmanage->find($options['conditions'],null,null);
				if(empty($result)) {
					$result = $this->controller->Editmanage->query('insert into '.$prefix.'editmanages (session_id,edit_id,edit_date) values ("' . mysql_real_escape_string(session_id()) . '","' . mysql_real_escape_string($d_id) . '",NOW());');
					if( $result=== false ) exit();
				}
				else {
					$result = $this->controller->Editmanage->query('update '.$prefix.'editmanages set edit_id= "' . mysql_real_escape_string($d_id) . '",edit_date=NOW() where session_id = "' . mysql_real_escape_string(session_id()) . '";');
					if( $result=== false ) exit();
				}
			}
		}

		return true;
	}

	function clear() {

		$prefix = $this->_getPrefix('Editmanage');

		$limit_time = date("Y-m-d H:i:d",strtotime("-1 hour")); // １時間余裕をみます
		$result = $this->controller->Editmanage->query('delete from '.$prefix.'editmanages where session_id = "' . mysql_real_escape_string(session_id()) . '" or edit_date<"'. mysql_real_escape_string($limit_time) .'";');
		if( $result=== false ) exit();
	}


	function _getPrefix($model = null) {
		$config = $this->controller->{$model}->useDbConfig;    // 'default'
		$db =& ConnectionManager::getDataSource($config); // 'default'
		$prefix = $db->config['prefix'];     // 'prefix_'
		return $prefix;
	}

}

?>