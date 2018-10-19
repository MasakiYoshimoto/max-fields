<?php
	class Title extends AppModel {
		var $name = 'Title';
		var $primaryKey = 'id';
		var $actsAs = array('Multivalidatable');
		var $validate = array();
		var $validationSets = array();

		var $sqlerror=true;

		function onError(){
			$this->sqlerror = false;
		}
	}
?>