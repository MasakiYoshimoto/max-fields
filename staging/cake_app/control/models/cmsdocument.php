<?php
	class Cmsdocument extends AppModel {
		var $name = 'Cmsdocument';
		var $primaryKey = 'd_id';
		var $actsAs = array('Multivalidatable','Setvalidatebyitems');
		var $hasMany = array('Cmsitemdata' => array(
				'className' => 'Cmsitemdata',
				'conditions' => 'Cmsitemdata.delete_flag=0',
				'order' => 'Cmsitemdata.id asc',
				'foreignKey' => 'd_id',
			)
		);

		var $sqlerror=true;

		var $validate = array();
		var $validationSets = array(
									'default' => array(
										"title"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"タイトルを入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",30),
														"on"=>null,
														"message"=>"タイトルは30文字以下で入力して下さい",
														),
												),
										"explanation"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"内容の説明を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",200),
														"on"=>null,
														"message"=>"内容の説明は200文字以下で入力して下さい",
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
										"period"=>array(
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
												"rule2"=>array(
														"rule"=>array("checkinputdate"),
														"on"=>null,
														"message"=>"開始日もしくは終了日を入力して下さい",
														),
												),
										"category"=>array(
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
										"start_date"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"開始日を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array('date', 'ymd'),
														"on"=>null,
														'allowEmpty' => true,
														"message"=>"正しい開始日を入力して下さい",
														),
													),
										"c_end_date"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"終了日を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array('date', 'ymd'),
														"on"=>null,
														'allowEmpty' => true,
														"message"=>"正しい終了日を入力して下さい",
														),
												"rule2"=>array(
														"rule"=>array("checkinputdate2"),
														"on"=>null,
														"message"=>"開始日が終了日の後になっています",
														),
													),
										"directlink"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"ダイレクトリンクを入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkmaxLength",100),
														"on"=>null,
														'last' => true,
														"message"=>"ダイレクトリンクは100文字以下で入力して下さい",
														),
												"rule2"=>array(
														"rule"=>array("custom",'/^[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+$/'),
														"on"=>null,
														'allowEmpty' => true,
														'last' => true,
														"message"=>"ダイレクトリンクに正しいURL・パスを入力して下さい",
														),
												"rule3"=>array(
														"rule"=>array("checkdirectlink"),
														"on"=>null,
														'allowEmpty' => true,
														"message"=>"ダイレクトリンクはhttp://、https://もしくはスラッシュで始まるURL・パスを入力して下さい",
														),
												),
										"directlink2"=>array(
												"required"=>array(
														"required"=>true,
														"rule"=>array("allowEmpty",true),
														'last' => true,
														"message"=>"ダイレクトリンク（ファイル）を入力して下さい",
														),
												"rule1"=>array(
														"rule"=>array("checkattachfile",MAX_FILE_SIZE,'xls,xlsx,doc,docx,ppt,pptx,pdf'),
														"on"=>null,
														'allowEmpty' => true,
														"message"=>"ダイレクトリンク（ファイル）に正しいファイルを選択して下さい",
														)
												),
										"del_directlink"=>array(
												"rule1"=>array(
														"rule"=>array("checkintbetween",0,1),
														"on"=>null,
														'allowEmpty' => true,
														'last' => true,
														"message"=>"ダイレクトリンクが不正です",
														),
												"rule2"=>array(
														"rule"=>array("checkdelup",'directlink2'),
														"on"=>null,
														'allowEmpty' => true,
														"message"=>"ダイレクトリンク（ファイル）は削除とアップを同時に出来ません",
														),
												),
									),
									'edit' => array(
										"d_id"=>array(
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
									),
									'del' => array(
										"del_d_id"=>array(
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
									),
									'sort' => array(
										"d_id"=>array(
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
									'index' => array(
										"c_id"=>array(
												"rule1"=>array(
														"rule"=>array("numeric",true),
														'allowEmpty' => true,
														"on"=>null,
														"message"=>"エラーが発生しました",
														),
													),
										"page"=>array(
												"rule1"=>array(
														"rule"=>array("numeric",true),
														'allowEmpty' => true,
														"on"=>null,
														"message"=>"エラーが発生しました",
														),
													),
										"category"=>array(
												"rule1"=>array(
														"rule"=>array("numeric",true),
														'allowEmpty' => true,
														"on"=>null,
														"message"=>"エラーが発生しました",
														),
													),
									),
									'id' => array(
										"id"=>array(
												"required"=>array(
														"required"=>false,
														"rule"=>VALID_NOT_EMPTY,
														'last' => true,
														"message"=>"エラーが発生しました",
														),
												"rule1"=>array(
														"rule"=>array("numeric",true),
														"on"=>null,
														"message"=>"エラーが発生しました",
														)
													)
									),
								);

		function checkinputdate($check) {
			if( $check['period'] != 1 ) return true;
			if( $this->data['Cmsdocument']['start_date'] == "" && $this->data['Cmsdocument']['end_date'] == "" ) return false;
			return true;
		}

		function checkinputdate2($check) {
			if( $this->data['Cmsdocument']['period'] != 1 ) return true;
			if( $this->data['Cmsdocument']['start_date'] == "" || $this->data['Cmsdocument']['end_date'] == "" ) return true;
			if( strtotime($this->data['Cmsdocument']['start_date']) > strtotime($this->data['Cmsdocument']['end_date']) ) return false;
			return true;
		}

		function requiredupfile($check) {
			$key = array_keys($check);
			$name = $key[0];
			if($check[$name]['name'] == "") {
				if( isset($this->data['Cmsdocument']['file_'.$name]) && $this->data['Cmsdocument']['file_'.$name]==1 ) return true;
				return false;
			}
			return true;
		}

		function checkimagefile($check,$size,$max_width,$max_height) {

			$key = array_keys($check);
			$name = $key[0];

			if( $check[$name]['error'] == UPLOAD_ERR_NO_FILE ) return true;

			if( $check[$name]['error'] == UPLOAD_ERR_INI_SIZE || $check[$name]['error'] == UPLOAD_ERR_PARTIAL ) return false;

			if( $check[$name]['error'] == UPLOAD_ERR_FORM_SIZE || $size < $check[$name]['size'] ) return false;

			$img_info = getimagesize($check[$name]['tmp_name']);
			if( $img_info[2] == 1 || $img_info[2] == 2 || $img_info[2] == 3 ) {
				$width = $img_info[0];
				$height = $img_info[1];
				if( $width > $max_width || $height > $max_height ) return false;
			}
			else {
				return false;
			}

			return true;
		}

		function checkimgsize($check,$max_width,$max_height) {

			$key = array_keys($check);
			$name = $key[0];

			$img_info = @getimagesize(DOCUMENT_ROOT.$check[$name]);

			if(!$img_info) return false;
			if( $img_info[2] == 1 || $img_info[2] == 2 || $img_info[2] == 3 ) {
				$width = $img_info[0];
				$height = $img_info[1];
				if( $width > $max_width || $height > $max_height ) return false;
			}
			else {
				return false;
			}

			return true;
		}

		function checkattachfile($check,$size,$extension_list) {

			$key = array_keys($check);
			$name = $key[0];

			if( $check[$name]['error'] == UPLOAD_ERR_NO_FILE ) return true;

			if( $check[$name]['error'] == UPLOAD_ERR_INI_SIZE || $check[$name]['error'] == UPLOAD_ERR_PARTIAL ) return false;

			if( $check[$name]['error'] == UPLOAD_ERR_FORM_SIZE || $size < $check[$name]['size'] ) return false;

			// 拡張子を取得
			$data = pathinfo($check[$name]['name']);
			$extension = strtolower($data['extension']);

			// 許可拡張子設定
			$while_list = explode(',',$extension_list);

			// チェック
			if( array_search($extension,$while_list)=== null || array_search($extension,$while_list) === false ) return false;

			return true;
		}

		function checkfiletype($check,$extension_list) {

			$key = array_keys($check);
			$name = $key[0];

			// 拡張子を取得
			$data = pathinfo($check[$name]);
			$extension = strtolower($data['extension']);

			// 許可拡張子設定
			$while_list = explode(',',$extension_list);

			// チェック
			if( array_search($extension,$while_list)=== null || array_search($extension,$while_list) === false ) return false;

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

		function checkdelup($check,$file_name) {

			$key = array_keys($check);
			$name = $key[0];

			if( $check[$name] == 1 && $this->data['Cmsdocument'][$file_name]['name'] != "" ) return false;

			return true;
		}

		function checkcheckbox($check) {

			$key = array_keys($check);
			$name = $key[0];

			if( empty($check[$name]) ) return false;

			return true;
		}

		function checkmaxLength($check,$max) {

			$key = array_keys($check);
			$name = $key[0];

			if( mb_strlen($check[$name]) > $max ) return false;

			return true;
		}

		function checkmaxLength2($check,$max) {

			$key = array_keys($check);
			$name = $key[0];

			$str = str_replace(array("\r\n","\n","\r"), '', $check[$name]);

			if( mb_strlen($str) > $max ) return false;

			return true;
		}

		function checkdatetime_req($check) {

			$key = array_keys($check);
			$name = $key[0];

			if( !is_array($check[$name]) || count($check[$name]) !=3 ) return false;

			if( $check[$name]['date']=="" ) return false;
			if( $check[$name]['hour']=="" ) return false;
			if( $check[$name]['minute']=="" ) return false;

			return true;
		}

		function checkdatetime($check) {

			$key = array_keys($check);
			$name = $key[0];

			$flag=0;

			if( !is_array($check[$name]) || count($check[$name]) !=3 ) return false;

			if( $check[$name]['date']!="" ) {
				$a_date = explode("/",$check[$name]['date']);
				if( count( $a_date ) !=3 ) return false;
				if(!is_numeric($a_date[0]) || !is_numeric($a_date[1]) || !is_numeric($a_date[2]) ) return false;
				if(!checkdate ( $a_date[1] , $a_date[2] , $a_date[0] ) ) return false;
				$flag++;
			}

			if( $check[$name]['hour']!="" ) {
				$hour = $check[$name]['hour'];
				if( !is_numeric($hour) ) return false;
				$hour = $hour * 1;
				if( $hour < 0 || $hour > 23 ) return false;
				$flag++;
			}

			if( $check[$name]['minute']!="" ) {
				$minute = $check[$name]['minute'];
				if( !is_numeric($minute) ) return false;
				$minute = $minute * 1;
				if( $minute < 0 || $minute > 59 ) return false;
				$flag++;
			}

			if( $flag!=0 && $flag!=3 ) return false;

			return true;
		}

		function checkdirectlink($check) {

			$key = array_keys($check);
			$name = $key[0];

			if(preg_match('/^https?:\/\//', $check[$name])) return true;
			if(preg_match('/^\//', $check[$name])) return true;

			return false;
		}

		function checkexists($check) {

			$key = array_keys($check);
			$name = $key[0];

			if(!file_exists(DOCUMENT_ROOT.$check[$name])) return false;

			return true;
		}

		function onError(){
			$this->sqlerror = false;
		}

	}
?>