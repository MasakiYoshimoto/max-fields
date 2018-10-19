<?php
class SetvalidatebyitemsBehavior extends ModelBehavior {

	function setUp(&$model, $config = array()) {

	}

	function setValidationbyitems(&$model,$item_name,$item,$flag='add',$use_filemanager=false) {
		if( count($item)==0 ) return false;
		$model->validate = $this->_makeValidation($model,$item_name,$item,$flag,$use_filemanager);
	}

	function _makeValidation(&$model,$item_name,$itemlist,$flag,$use_filemanager) {

		$rules = $model->validate;

		foreach($itemlist as $value) {

			$add_rules = "";
			$name = $value[$item_name]['variable_name'];

			// 画像の場合、許可するサイズを設定
			if($value[$item_name]['type']==3) {
				if($value[$item_name]['values_string'] && strpos(',',$value[$item_name]['values_string'])) {
					$a_size = explode(',',$value[$item_name]['values_string']);
					$max_img_w = $a_size[0];
					$max_img_h = $a_size[1];
					if(!is_numeric($max_img_w)||!is_numeric($max_img_h)) {
						$max_img_w = ALLOW_MAX_IMGSIZE;
						$max_img_h = ALLOW_MAX_IMGSIZE;
					}
				}
				elseif($value[$item_name]['values_string']) {
					if(!is_numeric($value[$item_name]['values_string'])) {
						$max_img_w = ALLOW_MAX_IMGSIZE;
						$max_img_h = ALLOW_MAX_IMGSIZE;
					}
					else {
						$max_img_w = $value[$item_name]['values_string'];
						$max_img_h = $value[$item_name]['values_string'];
					}
				}
				else {
					$max_img_w = ALLOW_MAX_IMGSIZE;
					$max_img_h = ALLOW_MAX_IMGSIZE;
				}
			}

			// ファイルの場合、許可する拡張子を設定
			if($value[$item_name]['type']==4) {
				$allow_ext = ($value[$item_name]['values_string'])?($value[$item_name]['values_string']):(ALLOW_FILES);
			}

			// 1行テキストの文字数を設定
			if($value[$item_name]['type']==1) {
				$line_max = ($value[$item_name]['max'])?($value[$item_name]['max']):(100);
			}

			switch ( $value[$item_name]['type'] ) {
				case 1:// 一行テキスト
					$add_rules= array($name=>array());
					if( $value[$item_name]['required']==1) {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>VALID_NOT_EMPTY,
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を入力して下さい。",
											);
					}
					else {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>array("allowEmpty",true),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を入力して下さい。",
											);
					}
					if($value[$item_name]['values_string']) {
									$add_rules[$name]["rule1"]=array(
												"rule"=>array("custom",$value[$item_name]['values_string']),
												"on"=>null,
												'last' => true,
												'allowEmpty' => true,
												"message"=>$value[$item_name]['name'] . "に正しい値を入力して下さい",
												);
					}
					$add_rules[$name]["rule2"]=array(
								"rule"=>array("checkmaxLength",$line_max),
								"on"=>null,
								"message"=>$value[$item_name]['name'] . "は".$line_max."文字以下で入力して下さい",
								);
					break;
				case 2:// テキストエリア
					$add_rules= array($name=>array());
					if( $value[$item_name]['required']==1) {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>VALID_NOT_EMPTY,
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を入力して下さい。",
											);
					}
					else {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>array("allowEmpty",true),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を入力して下さい。",
											);
					}
					$add_rules[$name]["rule1"]=array(
								"rule"=>array("checkmaxLength",3000),
								"on"=>null,
								"message"=>$value[$item_name]['name'] . "は3000文字以下で入力して下さい",
								);
					break;
				case 3:// 画像
					if(!$use_filemanager) {
						if( $flag == 'edit' ) {
										$add_rules['del_'.$name]["rule1"]=array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													'allowEmpty' => true,
													"message"=>$value[$item_name]['name'] . "が不正です",
													);
										$add_rules['del_'.$name]["rule2"]=array(
													"rule"=>array("checkdelup",$name),
													"on"=>null,
													'allowEmpty' => true,
													"message"=>$value[$item_name]['name'] . "：削除とアップは同時に出来ません",
													);
										$add_rules['file_'.$name]["rule1"]=array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													'allowEmpty' => true,
													"message"=>$value[$item_name]['name'] . "に正しいファイルを選択して下さい",
													);
						}
						if( $value[$item_name]['required']==1) {
										$add_rules[$name]["required"]=array(
												"rule"=>array("requiredupfile"),
												'last' => true,
												"message"=>$value[$item_name]['name'] . "を選択して下さい",
												);
						}
						$add_rules[$name]["rule1"]=array(
									"rule"=>array("checkimagefile",MAX_FILE_SIZE,$max_img_w,$max_img_h),
									"on"=>null,
									'allowEmpty' => true,
									"message"=>$value[$item_name]['name'] . "に正しいファイルを選択して下さい",
									);
					}
					else {
						$add_rules= array($name=>array());
						if( $value[$item_name]['required']==1) {
										$add_rules[$name]["required"]=array(
												"required"=>true,
												"rule"=>VALID_NOT_EMPTY,
												'last' => true,
												"message"=>$value[$item_name]['name'] . "を入力して下さい。",
												);
						}
						else {
										$add_rules[$name]["required"]=array(
												"required"=>true,
												"rule"=>array("allowEmpty",true),
												'last' => true,
												"message"=>$value[$item_name]['name'] . "を入力して下さい。",
												);
						}
						$add_rules[$name]["rule1"]=array(
									"rule"=>array("custom","@^".CONTENTS_URL."fm/(.thumbs/images/|images/).+@"),
									"on"=>null,
									'allowEmpty' => true,
									'last' => true,
									"message"=>$value[$item_name]['name'] . "に正しいファイルを入力・選択して下さい",
									);
						$add_rules[$name]["rule2"]=array(
									"rule"=>array("checkexists"),
									"on"=>null,
									'allowEmpty' => true,
									'last' => true,
									"message"=>$value[$item_name]['name'] . "に正しいファイルを入力・選択して下さい",
									);
						$add_rules[$name]["rule3"]=array(
									"rule"=>array("checkimgsize",$max_img_w,$max_img_h),
									"on"=>null,
									'allowEmpty' => true,
									'last' => true,
									"message"=>$value[$item_name]['name'] . "に正しいファイルを入力・選択して下さい",
									);
						$add_rules[$name]["rule4"]=array(
									"rule"=>array("checkmaxLength",100),
									"on"=>null,
									'allowEmpty' => true,
									'last' => true,
									"message"=>$value[$item_name]['name'] . "は100文字以下で入力して下さい",
									);
						}
					break;
				case 4:// ファイル
					if(!$use_filemanager) {
						if( $flag == 'edit' ) {
										$add_rules['del_'.$name]["rule1"]=array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													'allowEmpty' => true,
													"message"=>$value[$item_name]['name'] . "が不正です",
													);
										$add_rules['del_'.$name]["rule2"]=array(
													"rule"=>array("checkdelup",$name),
													"on"=>null,
													'allowEmpty' => true,
													"message"=>$value[$item_name]['name'] . "：削除とアップは同時に出来ません",
													);
										$add_rules['file_'.$name]["rule1"]=array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													'allowEmpty' => true,
													"message"=>$value[$item_name]['name'] . "に正しいファイルを選択して下さい",
													);
						}
						if( $value[$item_name]['required']==1) {
										$add_rules[$name]["required"]=array(
												"rule"=>array("requiredupfile"),
												'last' => true,
												"message"=>$value[$item_name]['name'] . "を選択して下さい",
												);
						}
						$add_rules[$name]["rule1"]=array(
									"rule"=>array("checkattachfile",MAX_FILE_SIZE,$allow_ext),
									"on"=>null,
									'allowEmpty' => true,
									"message"=>$value[$item_name]['name'] . "に正しいファイルを選択して下さい",
									);
					}
					else {
						$add_rules= array($name=>array());
						if( $value[$item_name]['required']==1) {
										$add_rules[$name]["required"]=array(
												"required"=>true,
												"rule"=>VALID_NOT_EMPTY,
												'last' => true,
												"message"=>$value[$item_name]['name'] . "を入力して下さい。",
												);
						}
						else {
										$add_rules[$name]["required"]=array(
												"required"=>true,
												"rule"=>array("allowEmpty",true),
												'last' => true,
												"message"=>$value[$item_name]['name'] . "を入力して下さい。",
												);
						}
						$add_rules[$name]["rule1"]=array(
									"rule"=>array("custom","@^".CONTENTS_URL."fm/files/.+@"),
									"on"=>null,
									'allowEmpty' => true,
									'last' => true,
									"message"=>$value[$item_name]['name'] . "に正しいファイルを入力・選択して下さい",
									);
						$add_rules[$name]["rule2"]=array(
									"rule"=>array("checkfiletype",$allow_ext),
									"on"=>null,
									'allowEmpty' => true,
									'last' => true,
									"message"=>$value[$item_name]['name'] . "に正しいファイルを入力・選択して下さい",
									);
						$add_rules[$name]["rule3"]=array(
									"rule"=>array("checkexists"),
									"on"=>null,
									'allowEmpty' => true,
									'last' => true,
									"message"=>$value[$item_name]['name'] . "に正しいファイルを入力・選択して下さい",
									);
						$add_rules[$name]["rule4"]=array(
									"rule"=>array("checkmaxLength",100),
									"on"=>null,
									'allowEmpty' => true,
									'last' => true,
									"message"=>$value[$item_name]['name'] . "は100文字以下で入力して下さい",
									);
						}
					break;
				case 5:// ラジオボタン
					$add_rules= array($name=>array());
					if( $value[$item_name]['required']==1) {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>VALID_NOT_EMPTY,
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を選択して下さい。",
											);
					}
					else {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>array("allowEmpty",true),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を選択して下さい。",
											);
					}
					break;
				case 6:// セレクト
					$add_rules= array($name=>array());
					if( $value[$item_name]['required']==1) {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>VALID_NOT_EMPTY,
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を選択して下さい。",
											);
					}
					else {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>array("allowEmpty",true),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を選択して下さい。",
											);
					}
					break;
				case 7: // チェックボックス
					$add_rules= array($name=>array());
					if( $value[$item_name]['required']==1) {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>array("checkcheckbox"),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を選択して下さい。",
											);
					}
					else {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>array("allowEmpty",true),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を選択して下さい。",
											);
					}
					break;
				case 8: // 日付
					$add_rules= array($name=>array());
					if( $value[$item_name]['required']==1) {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>VALID_NOT_EMPTY,
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を入力して下さい。",
											);
					}
					else {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>array("allowEmpty",true),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を入力して下さい。",
											);
					}
					$add_rules[$name]["rule1"]=array(
								"rule"=>array('custom', '@[0-9]{4}/[0-9]{2}/[0-9]{2}@'),
								"allowEmpty"=>true,
								'last' => true,
								"on"=>null,
								"message"=>$value[$item_name]['name'] . "はyyyy/mm//ddの形式で入力して下さい",
								);
					$add_rules[$name]["rule2"]=array(
								"rule"=>array('date', 'ymd'),
								"allowEmpty"=>true,
								'last' => true,
								"on"=>null,
								"message"=>$value[$item_name]['name'] . "はyyyy/mm//ddの形式で入力して下さい",
								);
					break;
				case 9: // 日付
					break;
				case 10: // テキストエリア(ノーマル)
					$add_rules= array($name=>array());
					if( $value[$item_name]['required']==1) {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>VALID_NOT_EMPTY,
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を入力して下さい。",
											);
					}
					else {
									$add_rules[$name]["required"]=array(
											"required"=>true,
											"rule"=>array("allowEmpty",true),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を入力して下さい。",
											);
					}
					$add_rules[$name]["rule1"]=array(
								"rule"=>array("checkmaxLength",3000),
								"on"=>null,
								"message"=>$value[$item_name]['name'] . "は3000文字以下で入力して下さい",
								);
					break;
				default:
					break;

			}

			if( is_array($add_rules) ) $rules += $add_rules;

		}

		// 登録日
		if( $flag == 'edit' ) {
			$date_rules['createdate']["required"]=array(
							"required"=>true,
							"rule"=>VALID_NOT_EMPTY,
							'last' => true,
							"message"=>"作成日を入力して下さい",
					);
			$date_rules['createdate']["rule1"]=array(
							"rule"=>array('date', 'ymd'),
							"on"=>null,
							'allowEmpty' => true,
							"message"=>"正しい作成日を入力して下さい",
						);
			$date_rules['create_h']["required"]=array(
							"required"=>true,
							"rule"=>VALID_NOT_EMPTY,
							'last' => true,
							"message"=>"作成日時(時)を入力して下さい",
					);
			$date_rules['create_h']["rule1"]=array(
							"rule"=>array("checkintbetween",0,23),
							'last' => true,
							"message"=>"正しい作成日時(時)を入力して下さい",
					);
			$date_rules['create_m']["required"]=array(
							"required"=>true,
							"rule"=>VALID_NOT_EMPTY,
							'last' => true,
							"message"=>"作成日時(分)を入力して下さい",
					);
			$date_rules['create_m']["rule1"]=array(
							"rule"=>array("checkintbetween",0,59),
							'last' => true,
							"message"=>"正しい作成日時(分)を入力して下さい",
					);
			$date_rules['create_s']["required"]=array(
							"required"=>true,
							"rule"=>VALID_NOT_EMPTY,
							'last' => true,
							"message"=>"作成日時(秒)を入力して下さい",
					);
			$date_rules['create_s']["rule1"]=array(
							"rule"=>array("checkintbetween",0,59),
							'last' => true,
							"message"=>"正しい作成日時(秒)を入力して下さい",
					);
			$rules += $date_rules;
		}


		return $rules;
	}
}

?>