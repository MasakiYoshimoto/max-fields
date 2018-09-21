<?php
	Configure::write('plugins.links.raptrecommended', 
		array(
			'name'=>'raptrecommended',
			'link'=>array(
					'title'=>'動作環境について',
					'url'=>'/raptrecommended/raptrecommended_pages/',
					'level'=>0
				),
			'order'=>11
		)
	);


	Configure::write('plugins.setup.raptrecommended', 
		array(
			'name'=>'raptrecommended',
			'jname'=>'動作環境について(ラプト用)',
			'dec'=>'動作環境についてを表示します(ラプト用)',
			'install'=>'',
			'db'=>''
		)
	);
?>