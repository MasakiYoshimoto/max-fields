<?php
	class Cmsitem extends AppModel {
		var $name = 'Cmsitem';
		var $primaryKey = 'i_id';
		var $actsAs = array('Multivalidatable');
		var $sqlerror=true;

		var $validate = array();
		var $validationSets = array(
									'index' => array(
										"edit_c_id"=>array(
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
									'add' => array(
										"c_id"=>array(
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
										"type"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"種類を選択して下さい",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule2"=>array(
														"rule"=>array("checkintbetween",1,10),
														"on"=>null,
														"message"=>"エラーが発生しました",
														),
													),
										"item_name"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"名称を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",100),
														"on"=>null,
														"message"=>"名称は100文字以下で入力して下さい",
														),
													),
										"values"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",1000),
														"on"=>null,
														"message"=>"値は1000文字以下で入力して下さい",
														),
													),
										"max"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														'last' => true,
														'allowEmpty' => true,
														"message"=>"文字数は半角数字で入力して下さい",
														),
													),
										"unit"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",100),
														"on"=>null,
														"message"=>"単位は100文字以下で入力して下さい",
														),
													),
										"variable_name"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"変数を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",100),
														'last' => true,
														"on"=>null,
														"message"=>"変数は100文字以下で入力して下さい",
														),
												"rule2"=>array(
														"rule"=>array('custom','/^[0-9a-zA-Z_\-].*$/'),
														'last' => true,
														"on"=>null,
														"message"=>"半角英数字及び-_で入力して下さい",
														),
												"rule3"=>array(
														"rule"=>array("checkduplication"),
														"on"=>null,
														"message"=>"同じ変数名が登録済みです",
														),
													),
										"explanation"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",3000),
														"on"=>null,
														"message"=>"説明は3000文字以下で入力して下さい",
														),
													),
										"required"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("checkintbetween",0,1),
														"on"=>null,
														"message"=>"エラーが発生しました",
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
										"up_i_id"=>array(
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
										"up_item_name"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"名称を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",100),
														"on"=>null,
														"message"=>"名称は100文字以下で入力して下さい",
														),
													),
										"up_values"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",1000),
														"on"=>null,
														"message"=>"値は1000文字以下で入力して下さい",
														),
													),
										"up_max"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														'allowEmpty' => true,
														"message"=>"文字数は半角数字で入力して下さい",
														),
													),
										"up_unit"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",100),
														"on"=>null,
														"message"=>"単位は100文字以下で入力して下さい",
														),
													),
										"up_variable_name"=>array(
												"required"=>array(
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"変数を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",100),
														'last' => true,
														"on"=>null,
														"message"=>"変数は100文字以下で入力して下さい",
														),
												"rule2"=>array(
														"rule"=>array('custom','/^[0-9a-zA-Z_\-].*$/'),
														'last' => true,
														"on"=>null,
														"message"=>"半角英数字及び-_で入力して下さい",
														),
												"rule3"=>array(
														"rule"=>array("checkduplication2"),
														"on"=>null,
														"message"=>"同じ変数名が登録済みです",
														),
													),
										"up_explanation"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",3000),
														"on"=>null,
														"message"=>"説明は3000文字以下で入力して下さい",
														),
													),
										"up_required"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("checkintbetween",0,1),
														"on"=>null,
														"message"=>"エラーが発生しました",
														),
													),
									),
									'sort' => array(
										"c_id"=>array(
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
										"i_id"=>array(
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
									'del' => array(
										"del_i_id"=>array(
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
		);

		function checkduplication($check) {
			$target = array('Cmsitem.c_id'=>$this->data['Cmsitem']['c_id'],'Cmsitem.variable_name'=>strtoupper($check['variable_name']),'Cmsitem.delete_flag'=>'0');
			if(!$this->isUnique($target,false)) {
				return false;
			}
			else {
				return true;
			}
		}
		function checkduplication2($check) {

			// 同一の変数名があるかチェック
			$options['conditions'] = array('Cmsitem.c_id = '=>$this->data['Cmsitem']['up_c_id'],'Cmsitem.i_id != '=>$this->data['Cmsitem']['up_i_id'],'Cmsitem.variable_name = '=>strtoupper($check['up_variable_name']),'Cmsitem.delete_flag'=>'0');
			$result = $this->findcount($options['conditions']);
			if( $this->sqlerror == false ) return false;
			if($result>0) return false;

			return true;

		}
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