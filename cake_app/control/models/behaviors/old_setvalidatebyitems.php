<?php
class SetvalidatebyitemsBehavior extends ModelBehavior {

	function setUp(&$model, $config = array()) {

	}

	function setValidationbyitems(&$model,$item_name,$item) {
		if( count($item)==0 ) return false;
		$model->validate = $this->_makeValidation($model,$item_name,$item);
	}

	function _makeValidation(&$model,$item_name,$itemlist) {

		$rules = $model->validate;

		foreach($itemlist as $value) {

			$add_rules = "";
			$name = $value[$item_name]['variable_name'];

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
					$add_rules[$name]["rule1"]=array(
								"rule"=>array("maxLength",100),
								"on"=>null,
								"message"=>$value[$item_name]['name'] . "は100文字以下で入力して下さい",
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
					$add_rules[$name]["rule1"]=array(
								"rule"=>array("maxLength",3000),
								"on"=>null,
								"message"=>$value[$item_name]['name'] . "は3000文字以下で入力して下さい",
								);
					break;
				case 3:// 画像
					if( $value[$item_name]['required']==1) {
									$add_rules[$name]["required"]=array(
											"rule"=>array("requiredupfile"),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を選択して下さい",
											);
					}
					$add_rules[$name]["rule1"]=array(
								"rule"=>array("checkimagefile",1000000,1000,1000),
								"on"=>null,
								'allowEmpty' => true,
								"message"=>$value[$item_name]['name'] . "に正しいファイルを選択して下さい",
								);
					break;
				case 4:// ファイル
					if( $value[$item_name]['required']==1) {
									$add_rules[$name]["required"]=array(
											"rule"=>array("requiredupfile"),
											'last' => true,
											"message"=>$value[$item_name]['name'] . "を選択して下さい",
											);
					}
					$add_rules[$name]["rule1"]=array(
								"rule"=>array("checkattachfile",1000000,'xls,doc,ppt,pdf'),
								"on"=>null,
								'allowEmpty' => true,
								"message"=>$value[$item_name]['name'] . "に正しいファイルを選択して下さい",
								);
					break;
				case 5:// ラジオボタン
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
					break;
				case 7: // チェックボックス
					break;
				case 8: // 日付
					break;
				case 9: // 日付
					break;
				default:
					break;

			}

			if( is_array($add_rules) ) $rules += $add_rules;

		}


		return $rules;
	}
}

?>