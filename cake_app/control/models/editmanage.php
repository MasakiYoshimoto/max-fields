<?php
	class Editmanage extends AppModel {
		var $name = 'Editmanage';
		var $sqlerror=true;

		function onError(){
			$this->sqlerror = false;
		}

	}
?>