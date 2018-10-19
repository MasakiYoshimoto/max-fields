<?php
	class Cmsdoccategory extends AppModel {
		var $name = 'Cmsdoccategory';
		var $actsAs = array('Multivalidatable');

		var $sqlerror=true;
		var $validate = array();
		var $validationSets = array(
									'list' => array(
										"c_id"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"IDを入力して下さい"
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"IDを入力して下さい"
														)
													)
									),
									'id' => array(
										"id"=>array(
												"required"=>array(
														'required'=>true,
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"IDを入力して下さい"
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"IDを入力して下さい"
														)
													)
									),
									'add' => array(
										'name'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>VALID_NOT_EMPTY,
														'last' => true,
														'message'=>'カテゴリー名を入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',50),
														'on'=>null,
														'last' => true,
														'message'=>'カテゴリー名は50文字以下で入力して下さい',
														)
													)
									),
									'edit' => array(
										"id"=>array(
												"required"=>array(
														'required'=>true,
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"IDを入力して下さい"
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"IDを入力して下さい"
														)
													),
										'name'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>VALID_NOT_EMPTY,
														'last' => true,
														'message'=>'カテゴリー名を入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',50),
														'on'=>null,
														'last' => true,
														'message'=>'カテゴリー名は50文字以下で入力して下さい',
														)
													)
									),
									'del' => array(
										"del_id"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>VALID_NOT_EMPTY,
														'last' => true
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"required"=>true,
														"on"=>null,
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