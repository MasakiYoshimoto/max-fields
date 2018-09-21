<?php 
class MySecurityComponent extends Object {

	var $components = array('RequestHandler', 'Session');
	var $controller;

	function startup(&$controller) {
		$this->controller =& $controller;
	}

	function gettoken() {

		if( phpversion() > 4.3 ) {
			$token = sha1($this->controller->name).'|'.sha1(uniqid(rand(),1));
		}
		else {
			$token = md5($this->controller->name).'|'.md5(uniqid(rand(),1));
		}

		return $token;
	}

	function settoken() {

		$token = $this->gettoken();

		$this->controller->set('token',$token);
		$this->Session->write('_my_security_token',$token);

		return true;
	}

	function checktoken($model,$postonly=true,$controller_name='') {

		$postvalidate = true;

		if( $controller_name=="") $controller_name= $this->controller->name;

		if( phpversion() > 4.3 ) {
			$token_top = sha1($controller_name);
		}
		else {
			$token_top = md5($controller_name);
		}

		if(!isset( $this->controller->data[$model]['_token'] )) {
			return false;
		}

		if(!$this->Session->check("_my_security_token")) {
			return false;
		}

		if( $postonly == true ) $postvalidate = $this->RequestHandler->isPost();

		$token = $this->Session->read('_my_security_token');

		$result = ($postvalidate && $this->controller->data[$model]['_token'] !='end' && $this->controller->data[$model]['_token'] == $token && preg_match("/^".$token_top."\|/",$this->controller->data[$model]['_token'])==1 ) ? ( true ) :( false );

		$this->Session->write('_my_security_token','end');

		return $result;
	}
}

?>