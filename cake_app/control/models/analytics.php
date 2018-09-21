<?php
	class Analytics extends AppModel {
		var $name = 'Analytics';
		var $primaryKey = 'id';
		var $actsAs = array('Multivalidatable');
		var $validate = array();
		var $validationSets = array(
									'edit' => array(
										'login_id'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>array('allowEmpty',true),
														'last' => true,
														'message'=>'ログインIDを入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',30),
														'on'=>null,
														'last' => true,
														'message'=>'正しいログインIDを入力して下さい',
														),
												'rule2'=>array(
														'rule'=>'email',
														'allowEmpty' => true,
														'on'=>null,
														'message'=>'正しいログインIDを入力して下さい',
														),
													),
										'login_pass'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>array('allowEmpty',true),
														'last' => true,
														'message'=>'ログインパスワードを入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',30),
														'on'=>null,
														'message'=>'正しいログインパスワードを入力して下さい',
														),
													),
										'web_property_id'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>array('allowEmpty',true),
														'last' => true,
														'message'=>'ウェブプロパティIDを入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',30),
														'on'=>null,
														'message'=>'正しいウェブプロパティIDを入力して下さい',
														),
													),
										'profile_id'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>array('allowEmpty',true),
														'last' => true,
														'message'=>'エラーが発生しました',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',30),
														'on'=>null,
														'last' => true,
														'message'=>'正しいプロファイルIDを入力して下さい',
														),
												'rule2'=>array(
														'rule'=>array('numeric',true),
														'allowEmpty' => true,
														'on'=>null,
														'message'=>'正しいプロファイルIDを入力して下さい',
														),
													)
									)
		);

		var $sqlerror=true;

		function onError(){
			$this->sqlerror = false;
		}

		function checkmaxLength($check,$max) {

			$key = array_keys($check);
			$name = $key[0];

			if( mb_strlen($check[$name]) > $max ) return false;

			return true;
		}

	}
?>