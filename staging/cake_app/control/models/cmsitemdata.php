<?php
	class Cmsitemdata extends AppModel {
		var $name = 'Cmsitemdata';
		var $primaryKey = 'id';
		var $validate = array();
		var $belongsTo = array('Cmsitem' => array(
				'className' => 'Cmsitem',
				'order' => 'Cmsitem.i_id asc',
				'foreignKey' => 'i_id',
			)
		);
		var $sqlerror=true;

		function onError(){
			$this->sqlerror = false;
		}

	}
?>