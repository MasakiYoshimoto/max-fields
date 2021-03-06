<?php
	return array(
		'name'=>
			array(
				'name'=>'氏名（漢字）',
				'default'=>'',
				'validate'=>array(
					'require'=>array(
						'params'=>true,
						'message'=>':labelを入力して下さい',
					),
					'text'=>array(
						'message'=>':labelを入力して下さい',
					),
					'maxLength'=>array(
						'params'=>50,
						'message'=>':labelは:val1文字以下で入力して下さい',
					),
				)
			),
		'kana'=>
			array(
				'name'=>'氏名（フリガナ）',
				'default'=>'',
				'validate'=>array(
					'require'=>array(
						'params'=>true,
						'message'=>':labelを入力して下さい',
					),
					'text'=>array(
						'message'=>':labelを入力して下さい',
					),
					'maxLength'=>array(
						'params'=>50,
						'message'=>':labelは:val1文字以下で入力して下さい',
					),
				)
			),
		'email'=>array(
			'name'=>'メールアドレス',
			'default'=>'',
			'validate'=>array(
				'require'=>array(
					'params'=>true,
					'message'=>':labelを入力して下さい',
				),
				'text'=>array(
					'message'=>':labelを入力して下さい',
				),
				'email'=>array(
					'message'=>'正しい:labelを入力して下さい',
				),
				'confirmEmail'=>array(
					'params'=>'email2',
					'message'=>':labelがE-mail(確認用)と一致しません',
				),
			)
		),
		'email2'=>array(
			'name'=>'メールアドレス(確認用)',
			'default'=>'',
			'validate'=>array(
				'require'=>array(
					'params'=>true,
					'message'=>':labelを入力して下さい',
				),
				'text'=>array(
					'message'=>':labelを入力して下さい',
				),
				'email'=>array(
					'message'=>'正しい:labelを入力して下さい',
				),
			)
		),
		'zip'=>array(
			'name'=>'郵便番号',
			'default'=>'',
			'validate'=>array(
				'require'=>array(
					'params'=>true,
					'message'=>':labelを入力して下さい',
				),
				'text'=>array(
					'message'=>':labelを入力して下さい',
				),
				'zip'=>array(
					'allowEmpty'=>true,
					'message'=>'正しい:labelを入力して下さい',
				),
			)
		),
		'pref'=>
			array(
				'name'=>'都道府県',
				'list'=>array('北海道', '青森県', '秋田県', '岩手県', '山形県', '宮城県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '東京都', '千葉県', '神奈川県', '新潟県', '長野県', '山梨県', '静岡県', '富山県', '岐阜県', '愛知県', '石川県', '福井県', '滋賀県', '三重県', '奈良県', '京都府', '大阪府', '和歌山県', '兵庫県', '鳥取県', '岡山県', '島根県', '広島県', '山口県', '香川県', '徳島県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '大分県', '宮崎県', '熊本県', '鹿児島県', '沖縄県'),
				'default'=>'',
				'validate'=>array(
					'require'=>array(
						'params'=>true,
						'message'=>':label を選択して下さい',
					),
					'select'=>array(
						'message'=>':label を選択して下さい',
					)
				)
			),
		'address'=>array(
			'name'=>'市区郡以降',
			'default'=>'',
			'validate'=>array(
				'require'=>array(
					'params'=>true,
					'message'=>':labelを入力して下さい',
				),
				'text'=>array(
					'message'=>':labelを入力して下さい',
				),
				'maxLength'=>array(
					'params'=>100,
					'message'=>':labelは:val1文字以下で入力して下さい',
				),
			)
		),
		'contents'=>
			array(
				'name'=>'お問合せ内容',
				'default'=>'',
				'validate'=>array(
					'require'=>array(
						'params'=>true,
						'message'=>':labelを入力して下さい',
					),
					'text'=>array(
						'message'=>':labelを入力して下さい',
					),
					'maxLength'=>array(
						'params'=>1000,
						'message'=>':labelは:val1文字以下で入力して下さい',
					),
				)
			),
	);