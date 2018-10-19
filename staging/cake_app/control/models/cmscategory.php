<?php
	class Cmscategory extends AppModel {
		var $name = 'Cmscategory';
		var $primaryKey = 'c_id';
		var $actsAs = array('Multivalidatable');

		var $sqlerror=true;

		var $validate = array();
		var $validationSets = array(
									'index' => array(
										"c_id"=>array(
												"required"=>array(
														"required"=>false,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"allowEmpty"=>true,
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"エラーが発生しました",
														),
													),
										"word"=>array(
												"required"=>array(
														"required"=>false,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
													),
									),
									'add' => array(
										"name"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"カテゴリー名を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",100),
														"on"=>null,
														"message"=>"カテゴリー名は100文字以下で入力して下さい",
														),
													),
									),
									'up' => array(
										"up_c_id"=>array(
												"required"=>array(
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
										"up_name"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"カテゴリー名を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",100),
														"on"=>null,
														"message"=>"カテゴリー名は100文字以下で入力して下さい",
														),
													),
										"up_title_max"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"文字数を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"文字数は数字で入力して下さい",
														),
												"rule2"=>array(
													"rule"=>array("checkintbetween",10,50),
													"on"=>null,
													"message"=>"文字数は10文字以上50文字以下で入力して下さい",
														),
													),
										"up_use_rss"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"RSSを入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"RSSを入力して下さい",
														),
												"rule2"=>array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													"message"=>"RSSを入力して下さい",
														),
													),
										"up_use_period"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"期間を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"期間を入力して下さい",
														),
												"rule2"=>array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													"message"=>"期間を入力して下さい",
														),
													),
										"up_use_mobile"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"携帯を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"携帯を入力して下さい",
														),
												"rule2"=>array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													"message"=>"携帯を入力して下さい",
														),
													),
										"up_use_category"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"カテゴリーを入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"カテゴリーを入力して下さい",
														),
												"rule2"=>array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													"message"=>"カテゴリーを入力して下さい",
														),
													),
										"up_use_link"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"リンクを入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"リンクを入力して下さい",
														),
												"rule2"=>array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													"message"=>"リンクを入力して下さい",
														),
													),
										"up_use_fulledit"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"Full Editを入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"Full Editを入力して下さい",
														),
												"rule2"=>array(
													"rule"=>array("checkintbetween",0,1),
													"on"=>null,
													"message"=>"Full Editを入力して下さい",
														),
													),
									),
									'del' => array(
										"del_c_id"=>array(
												"required"=>array(
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
									),
		);

		function checkmaxLength($check,$max) {

			$key = array_keys($check);
			$name = $key[0];

			if( mb_strlen($check[$name]) > $max ) return false;

			return true;
		}

		function checkintbetween($check,$min,$max) {

			$key = array_keys($check);
			$name = $key[0];

			if(!is_numeric($check[$name])) return false;
			if(!is_int($check[$name]*1)) return false;
			if( $min > $check[$name] || $max < $check[$name] ) return false;

			return true;
		}

		function onError(){
			$this->sqlerror = false;
		}

	}
?>