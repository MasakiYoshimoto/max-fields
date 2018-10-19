<?php
	class Plugin extends AppModel {
		var $name = 'Plugin';
		var $primaryKey = 'id';
		var $actsAs = array('Multivalidatable');
		var $validate = array();
		var $validationSets = array(
									'install' => array(
										'name'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>VALID_NOT_EMPTY,
														'last' => true,
														'message'=>'プラグイン名を指定して下さい。',
														)
													)
									)
		);

		var $sqlerror=true;

		function onError(){
			$this->sqlerror = false;
		}
	}
?>