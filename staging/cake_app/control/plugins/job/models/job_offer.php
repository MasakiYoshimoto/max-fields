<?php
	define('JOB_MAX_FILE_SIZE', 1048576);
	class JobOffer extends JobAppModel {
		var $name = 'JobOffer';
		var $actsAs = array('Multivalidatable', 'ImgUp.ImgUp');

		var $imgFields = array(
			'pic1',
		);

		var $sqlerror=true;
		var $validate = array();
		var $validationSets = array(
									'addconf' => array(
										'catchcopy'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>VALID_NOT_EMPTY,
														'last' => true,
														'message'=>'職場・企業キャッチコピーを入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',50),
														'on'=>null,
														'last' => true,
														'message'=>'職場・企業キャッチコピーは50文字以下でご入力下さい',
														),
													),
										"disable"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													"message"=>"エラーが発生しました",
														),
												),
										'location'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array('checkcheckbox'),
												'last' => true,
												'message'=>'予定勤務地を選択して下さい',
											),
										),
										'work'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>VALID_NOT_EMPTY,
												'last' => true,
												'message'=>'仕事内容・職場紹介を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'仕事内容・職場紹介は200文字以下でご入力下さい',
											),
										),
										'require_ability'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'必要な経験能力を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'必要な経験能力は200文字以下でご入力下さい',
											),
										),
										'educational_background'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'学歴資格を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'学歴資格は200文字以下でご入力下さい',
											),
										),
										'wages_type'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'賃金形態を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'賃金形態は200文字以下でご入力下さい',
											),
										),
										'work_type'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'就業形態を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'就業形態は200文字以下でご入力下さい',
											),
										),
										'holiday'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'休日を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'休日は200文字以下でご入力下さい',
											),
										),
										'project_contents'=>array(
											"required"=>array(
												"required"=>true,
												"rule"=>array("allowEmpty",true),
												'last' => true,
												"message"=>"事業内容を入力して下さい",
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'事業内容は200文字以下でご入力下さい',
											),
										),
										'treatment'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'待遇を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'待遇は200文字以下でご入力下さい',
											),
										),
										'selection'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'選考内容を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'選考内容は200文字以下でご入力下さい',
											),
										),
										'etc'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'備考を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'備考は200文字以下でご入力下さい',
											),
										),
										'reg_date'=>array(
											"required"=>array(
												"required"=>true,
												"rule"=>VALID_NOT_EMPTY,
												'last' => true,
												"message"=>"登録日を入力して下さい",
											),
											'rule1'=>array(
												'rule'=>array('date', 'ymd'),
												'on'=>null,
												'last' => true,
												'message'=>'正しい登録日を入力して下さい',
											),
										),
										'open_date'=>array(
											"required"=>array(
												"required"=>true,
												"rule"=>array("allowEmpty",true),
												'last' => true,
												"message"=>"公開開始日を入力して下さい",
											),
											'rule1'=>array(
												'rule'=>array('date', 'ymd'),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'正しい公開開始日を入力して下さい',
											),
										),
										'end_date'=>array(
											"required"=>array(
												"required"=>true,
												"rule"=>array("allowEmpty",true),
												'last' => true,
												"message"=>"公開終了日を入力して下さい",
											),
											'rule1'=>array(
												'rule'=>array('date', 'ymd'),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'正しい公開終了日を入力して下さい',
											),
										),
										'category'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array('checkcheckbox'),
												'last' => true,
												'message'=>'募集職種を入力して下さい',
											),
										),
									),
									'editconf' => array(
										'catchcopy'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>VALID_NOT_EMPTY,
												'last' => true,
												'message'=>'職場・企業キャッチコピーを入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',50),
												'on'=>null,
												'last' => true,
												'message'=>'職場・企業キャッチコピーは50文字以下でご入力下さい',
											),
										),
										"disable"=>array(
											"required"=>array(
												"required"=>true,
												"rule"=>VALID_NOT_EMPTY,
												'last' => true,
												"message"=>"エラーが発生しました",
											),
											"rule1"=>array(
												"rule"=>array("checkintbetween",0,1),
												"on"=>null,
												"message"=>"エラーが発生しました",
											),
										),
										'location'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array('checkcheckbox'),
												'last' => true,
												'message'=>'予定勤務地を選択して下さい',
											),
										),
										'work'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>VALID_NOT_EMPTY,
												'last' => true,
												'message'=>'仕事内容・職場紹介を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'仕事内容・職場紹介は200文字以下でご入力下さい',
											),
										),
										'require_ability'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'必要な経験能力を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'必要な経験能力は200文字以下でご入力下さい',
											),
										),
										'educational_background'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'学歴資格を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'学歴資格は200文字以下でご入力下さい',
											),
										),
										'wages_type'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'賃金形態を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'賃金形態は200文字以下でご入力下さい',
											),
										),
										'work_type'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'就業形態を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'就業形態は200文字以下でご入力下さい',
											),
										),
										'holiday'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'休日を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'休日は200文字以下でご入力下さい',
											),
										),
										'project_contents'=>array(
											"required"=>array(
												"required"=>true,
												"rule"=>array("allowEmpty",true),
												'last' => true,
												"message"=>"事業内容を入力して下さい",
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'事業内容は200文字以下でご入力下さい',
											),
										),
										'treatment'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'待遇を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'待遇は200文字以下でご入力下さい',
											),
										),
										'selection'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'選考内容を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'選考内容は200文字以下でご入力下さい',
											),
										),
										'etc'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array("allowEmpty",true),
												'last' => true,
												'message'=>'備考を入力して下さい',
											),
											'rule1'=>array(
												'rule'=>array('checkmaxLength',200),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'備考は200文字以下でご入力下さい',
											),
										),
										'reg_date'=>array(
											"required"=>array(
												"required"=>true,
												"rule"=>VALID_NOT_EMPTY,
												'last' => true,
												"message"=>"登録日を入力して下さい",
											),
											'rule1'=>array(
												'rule'=>array('date', 'ymd'),
												'on'=>null,
												'last' => true,
												'message'=>'正しい登録日を入力して下さい',
											),
										),
										'open_date'=>array(
											"required"=>array(
												"required"=>true,
												"rule"=>array("allowEmpty",true),
												'last' => true,
												"message"=>"公開開始日を入力して下さい",
											),
											'rule1'=>array(
												'rule'=>array('date', 'ymd'),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'正しい公開開始日を入力して下さい',
											),
										),
										'end_date'=>array(
											"required"=>array(
												"required"=>true,
												"rule"=>array("allowEmpty",true),
												'last' => true,
												"message"=>"公開終了日を入力して下さい",
											),
											'rule1'=>array(
												'rule'=>array('date', 'ymd'),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'正しい公開終了日を入力して下さい',
											),
										),
										'category'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array('checkcheckbox'),
												'last' => true,
												'message'=>'募集職種を入力して下さい',
											),
										),
									),
									'id' => array(
										'id'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>VALID_NOT_EMPTY,
														'last' => true,
														'message'=>'エラーが発生しました',
														),
												'rule1'=>array(
														'rule'=>array('custom','/^[0-9]*$/'),
														'on'=>null,
														'last' => true,
														'message'=>'エラーが発生しました',
														),
													),
									),
									'index' => array(
										'page'=>array(
												'rule1'=>array(
														'rule'=>array('numeric',true),
														'allowEmpty' => true,
														'on'=>null,
														'message'=>'エラーが発生しました',
														),
													),
									),
									'sort' => array(
										"id"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"エラーが発生しました",
														),
													),
										"sort_flag"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("checkintbetween",1,2),
														"on"=>null,
														"message"=>"エラーが発生しました",
														),
													),
									),
									'map'=> array(
										'lat'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array('allowEmpty',true),
												'last' => true,
												'message'=>'緯度をご入力下さい',
											),
											'rule1'=>array(
												'rule'=>array('numeric'),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'緯度は半角数字でご入力下さい',
											),
										),
										'lng'=>array(
											'required'=>array(
												'required'=>true,
												'rule'=>array('allowEmpty',true),
												'last' => true,
												'message'=>'経度をご入力下さい',
											),
											'rule1'=>array(
												'rule'=>array('numeric'),
												'on'=>null,
												'last' => true,
												'allowEmpty' => true,
												'message'=>'経度は半角数字でご入力下さい',
											),
										),
									),
		);

		function checkintbetween($check,$min,$max) {

			$key = array_keys($check);
			$name = $key[0];

			if(!is_numeric($check[$name])) return false;
			if(!is_int($check[$name]*1)) return false;
			if( $min > $check[$name] || $max < $check[$name] ) return false;

			return true;
		}

		function checkmaxLength($check,$max) {

			$key = array_keys($check);
			$name = $key[0];

			if( mb_strlen($check[$name]) > $max ) return false;

			return true;
		}

		function checkcheckbox($check) {

			$key = array_keys($check);
			$name = $key[0];

			if( empty($check[$name]) ) return false;

			return true;
		}

		function checkimgfile($check,$size,$max_width,$max_height) {

			$key = array_keys($check);
			$name = $key[0];

			if( $check[$name]['error'] == UPLOAD_ERR_NO_FILE ) return true;

			if( $check[$name]['error'] == UPLOAD_ERR_INI_SIZE || $check[$name]['error'] == UPLOAD_ERR_PARTIAL ) return false;

			if( $check[$name]['error'] == UPLOAD_ERR_FORM_SIZE || $size < $check[$name]['size'] ) return false;

			// 画像で
			$img_info = getimagesize($check[$name]['tmp_name']);
			if( $img_info[2] == IMAGETYPE_GIF || $img_info[2] == IMAGETYPE_JPEG || $img_info[2] == IMAGETYPE_PNG ) { // GIF JPEGのみ

				$width = $img_info[0];
				$height = $img_info[1];
				if( $width > $max_width || $height > $max_height ) return false;

				// 拡張子取得
				$extension = strtolower(pathinfo($check[$name]['name'], PATHINFO_EXTENSION));

				switch( $img_info[2] ) {
					case IMAGETYPE_GIF:
						if( $extension != 'gif' ) return false;
						break;
					case IMAGETYPE_JPEG:
						if( $extension != 'jpg' && $extension != 'jpeg' ) return false;
						break;
					case IMAGETYPE_PNG:
						if( $extension != 'png' ) return false;
						break;
					default:
						return false;
						break;
				}
			}
			else {
				return false;
			}

			return true;
		}

		function requiredupfile($check) {
			$key = array_keys($check);
			$name = $key[0];
			if($check[$name]['name'] == "") {
				return false;
			}
			return true;
		}

		function onError(){
			$this->sqlerror = false;
		}

	}
?>