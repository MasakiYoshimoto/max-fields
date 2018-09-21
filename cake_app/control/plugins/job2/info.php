<?php
	// メニュー設定
	Configure::write('plugins.menus.job2',
		array(
			'name'=>'job2',
			'menus'=>array(
					array(
						'title'=>'求人案件一覧',
						'url'=>'/job2/job2_offers/index/n:1/page:1',
						'level'=>0
					),
				),
			'title'=>'求人案件',
			'level'=>0,
			'order'=>3
		)
	);

	// 権限設定
	Configure::write('plugins.auth.job2',
		array(
			'name'=>'job2',
			'auth'=>'1,2,99'
		)
	);

	// セットアップ設定
	Configure::write('plugins.setup.job2',
		array(
			'name'=>'job2',
			'jname'=>'求人案件',
			'dec'=>'求人案件です',
			'install'=>'',
			'db'=>''
		)
	);
?>