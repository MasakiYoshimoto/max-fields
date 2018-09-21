<?php

$type1 = $this->load('type1');
return array(
	'name'=>
		array(
			'name'=>'氏名',
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
	'kana'=>array(
		'name'=>'フリガナ',
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
	'birthday'=>array(
		'name'=>'生年月日',
		'default'=>'',
		'validate'=>array(
			'require'=>array(
				'params'=>true,
				'message'=>':labelを入力して下さい',
			),
			'text'=>array(
				'message'=>':labelを入力して下さい',
			),
			'date'=>array(
				'message'=>':labelは:yyyy/mm/dd形式で入力して下さい',
			),
		)
	),
	'sex'=>array(
		'name'=>'性別',
		'list'=>array('男性', '女性'),
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
	'tel'=>array(
		'name'=>'電話番号',
		'default'=>'',
		'validate'=>array(
			'require'=>array(
				'params'=>true,
				'message'=>':labelを入力して下さい',
			),
			'text'=>array(
				'message'=>':labelを入力して下さい',
			),
			'tel'=>array(
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
	'pref'=>array(
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
//	'start_date'=>array(
//		'name'=>'就業開始可能日',
//		'list'=>array('即日', '１週間後', '１ヵ月後', '翌々月以降'),
//		'default'=>'',
//		'validate'=>array(
//			'require'=>array(
//				'params'=>true,
//				'message'=>':label を選択して下さい',
//			),
//			'select'=>array(
//				'message'=>':label を選択して下さい',
//			)
//		)
//	),
	'latest_academic_background'=>array(
		'name'=>'最終学歴',
		'list'=>array('大学院了（博士・修士）', '大学卒', '短大卒','高専卒', '高校卒', 'その他'),
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
	'english_conversation'=>array(
		'name'=>'英語-会話レベル',
		'list'=>array('日常会話レベル', 'ビジネス会話レベル', 'ネイティブレベル'),
		'default'=>'',
		'validate'=>array(
			'select'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'english_experience'=>array(
		'name'=>'英語-実務経験',
		'list'=>array('文書', '読解', 'メール交換', 'プレゼンテーション', '公的文書作成', '通訳', 	'交渉'),
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'language_etc'=>array(
		'name'=>'英語以外の言語',
		'default'=>'',
		'validate'=>array(
			'text'=>array(
				'allowEmpty'=>true,
				'message'=>':labelを入力して下さい',
			),
			'maxLength'=>array(
				'allowEmpty'=>true,
				'params'=>500,
				'message'=>':labelは:val1文字以下で入力して下さい',
			),
		)
	),
	'drivers_license'=>array(
		'name'=>'普通自動車免許',
		'list'=>array('有り', '無し'),
		'default'=>'',
		'validate'=>array(
			'select'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'license'=>array(
		'name'=>'その他資格',
		'default'=>'',
		'validate'=>array(
			'text'=>array(
				'message'=>':labelを入力して下さい',
			),
			'maxLength'=>array(
				'params'=>1000,
				'message'=>':labelは:val1文字以下で入力して下さい',
			),
		)
	),

	'planning_experience'=>array(
		'name'=>'営業、事務、企画系経験職種',
		'list'=>$type1['100'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'service_experience'=>array(
		'name'=>'サービス、販売、運輸系経験職種',
		'list'=>$type1['101'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'creative_experience'=>array(
		'name'=>'クリエイティブ系経験職種',
		'list'=>$type1['102'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'specialist_experience'=>array(
		'name'=>'専門職系（コンサルタント・金融・不動産）経験職種',
		'list'=>$type1['103'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'it_experience'=>array(
		'name'=>'技術系（ITエンジニア）経験職種',
		'list'=>$type1['104'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'network_experience'=>array(
		'name'=>'通信ネットワーク設計・構築経験職種',
		'list'=>$type1['105'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'electricity_experience'=>array(
		'name'=>'技術系（電気、電子、機械技術者）経験職種',
		'list'=>$type1['106'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'chemistry_experience'=>array(
		'name'=>'化学工業品経験職種',
		'list'=>$type1['107'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'civil_engineering_experience'=>array(
		'name'=>'技術系（建築、土木技術者）経験職種',
		'list'=>$type1['108'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'public_service_experience'=>array(
		'name'=>'公務系（講師、公務員、技能工ほか）経験職種',
		'list'=>$type1['109'],
		'default'=>'',
		'validate'=>array(
			'checkbox'=>array(
				'allowEmpty'=>true,
				'message'=>':label を選択して下さい',
			)
		)
	),
	'etc_experience'=>array(
		'name'=>'その他特記事項',
		'default'=>'',
		'validate'=>array(
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