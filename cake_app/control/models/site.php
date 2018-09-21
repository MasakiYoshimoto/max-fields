<?php
	class Site extends AppModel {
		var $name = 'Site';
		var $primaryKey = 'id';
		var $actsAs = array('Multivalidatable');
		var $validate = array();
		var $validationSets = array(
									'edit' => array(
										'site_url'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>VALID_NOT_EMPTY,
														'last' => true,
														'message'=>'サイトのURLを入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',200),
														'on'=>null,
														'last' => true,
														'message'=>'サイトのURLは200文字以下で入力して下さい',
														),
												'rule2'=>array(
														'rule'=>array('url',true),
														'allowEmpty' => true,
														'on'=>null,
														'message'=>'正しいサイトのURLを入力して下さい',
														),
												'rule3'=>array(
														'rule'=>array('checkurl'),
														'allowEmpty' => true,
														'on'=>null,
														'message'=>'サイトのURLにファイル名は含めないで下さい。',
														),
													),
										'site_name'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>array('allowEmpty',true),
														'last' => true,
														'message'=>'サイトの名称を入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',50),
														'on'=>null,
														'message'=>'サイトの名称は50文字以下で入力して下さい',
														),
													),
										'title'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>array('allowEmpty',true),
														'last' => true,
														'message'=>'共通タイトルを入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',50),
														'on'=>null,
														'message'=>'共通タイトルは50文字以下で入力して下さい',
														),
													),
										'keywords'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>array('allowEmpty',true),
														'last' => true,
														'message'=>'共通keywordsを入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',1000),
														'on'=>null,
														'message'=>'共通keywordsは1000文字以下で入力して下さい',
														),
													),
										'description'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>array('allowEmpty',true),
														'last' => true,
														'message'=>'共通descriptionを入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',1000),
														'on'=>null,
														'message'=>'共通descriptionは1000文字以下で入力して下さい',
														),
													),
										'page_404error'=>array(
												'required'=>array(
														'required'=>true,
														'rule'=>array('allowEmpty',true),
														'last' => true,
														'message'=>'404エラーのパスを入力して下さい',
														),
												'rule1'=>array(
														'rule'=>array('checkmaxLength',200),
														'on'=>null,
														'last' => true,
														'message'=>'404エラーのパスは200文字以下で入力して下さい',
														),
												'rule2'=>array(
														'rule'=>array('checkpath'),
														'allowEmpty' => true,
														'on'=>null,
														'last' => true,
														'message'=>'404エラーのパスにドメインは含めないで下さい',
														),
												'rule3'=>array(
														'rule'=>array('checkpath2'),
														'allowEmpty' => true,
														'on'=>null,
														'message'=>'404エラーのパスは/(スラッシュ)から記述して下さい',
														)
													),
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

		function checkurl($check) {

			$key = array_keys($check);
			$name = $key[0];

			if(preg_match('@^https?://.*/([^/]+\.[^/]+)$@',$check[$name])) return false;

			return true;
		}

		function checkpath($check) {

			$key = array_keys($check);
			$name = $key[0];

			if(preg_match('@^https?://@',$check[$name])) return false;

			return true;
		}

		function checkpath2($check) {

			$key = array_keys($check);
			$name = $key[0];

			if(preg_match('@^/@',$check[$name])) return true;

			return false;
		}

	}
?>