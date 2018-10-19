<?php
	// セットアップ設定
	Configure::write('plugins.setup.cashclear', 
		array(
			'name'=>'cashclear',
			'jname'=>'キャッシュクリア',
			'dec'=>'テンポラリ内のキャッシュクリアを行います',
			'install'=>'',
			'db'=>''
		)
	);

	// スタートアップ設定
	Configure::write('plugins.startup.cashclear', 
		array(
			'name'=>'cashclear',
			'method'=>'_clear'
		)
	);

	// HOOK設定
	Configure::write('plugins.hook.cashclear', 
		array(
			'doc_edit_after'=>array(
				array(
					'name'=>'cashclear',
					'method'=>'_delImageCache'
				)
			),
			'doc_del_before'=>array(
				array(
					'name'=>'cashclear',
					'method'=>'_delImageCache'
				)
			)
		)
	);
?>