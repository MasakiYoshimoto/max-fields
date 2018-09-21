<?php
	// メニュー設定
	Configure::write('plugins.menus.job',
		array(
			'name'=>'job',
			'menus'=>array(
					array(
						'title'=>'求人案件一覧',
						'url'=>'/job/job_offers/index/n:1/page:1',
						'level'=>0
					),
				),
			'title'=>'My job is',
			'level'=>0,
			'order'=>2
		)
	);

	// 権限設定
	Configure::write('plugins.auth.job',
		array(
			'name'=>'job',
			'auth'=>'1,2,99'
		)
	);

	// セットアップ設定
	Configure::write('plugins.setup.job',
		array(
			'name'=>'job',
			'jname'=>'求人',
			'dec'=>'求人です',
			'install'=>'',
			'db'=>''
		)
	);
?>