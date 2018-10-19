<?php
/**
 *
 * product name : ImgUp
 * Copyright 2012, Arms Inc
 *
 * img_up.php
 *
 * @copyright        Copyright 2012, Arms Inc
 * @Revision        $Revision: 76 $
 * @modifiedby        $LastChangedBy: arms $
 * @lastmodified    $Date: 2012-08-02 14:39:14 +0900 (木, 02 8 2012) $
 */
class ImgUPComponent {

	/**
	 * @var controller
	 */
	var $_controller;

	/**
	 * スタートアップ
	 *
	 * @param $controller
	 */
	function startup(&$controller) {
		$this->_controller =& $controller;
	}

	/**
	 * 確認画面の画像処理
	 *
	 * @param array $options
	 * @param array $original
	 * @return bool
	 */
	function  confirmImageAll($options=array(), $original=null) {
		// デフォルト値の設定
		$default = array(
			'model' => inflector::singularize($this->_controller->name),
			'tmpPath' =>FILE_TEMP_DIR
		);

		$setting = Set::merge($default, $options);

		// 画像フィールドの取得
		$fields = $this->_controller->{$setting['model']}->imgFields;

		// 画像処理の実行
		foreach ($fields as $key => $value) {
			$setOptions = $setting;
			$setOptions['name'] = $value;
			if(!$this->confirmImage($setOptions, $original)) return false;
		}

		return true;
	}

	/**
	 * 確認画面の画像処理（単体）
	 *
	 * @param array $options
	 * @param array $original
	 * @return bool
	 */
	function confirmImage($options=array(), $original=null) {

		// デフォルト値の設定
		$default = array(
			'model' => inflector::singularize($this->_controller->name),
			'name' => '',
			'previewWidth' => 200,
			'previewHeight' => 200,
			'tmpPath' =>FILE_TEMP_DIR,
			'contentsPath' =>IMAGE_DIR
		);

		$setting = Set::merge($default, $options);
		$model = $setting['model'];
		$name = $setting['name'];

		// 名称が無かったらfalse
		if(!$name) return false;

		// 入力値を取得
		$input = $this->_controller->data[$model];

		if(!$input['del_'.$name]) { // 削除フラグがなかったら
			if($input[$name]['error'] == UPLOAD_ERR_OK) { // 画像がアップされたら

				// 拡張子を取得
				$f_data = pathinfo($input[$name]['name']);
				$extension = strtolower($f_data['extension']);

				// テンポラリファイル名の設定
				$temp_pic = String::uuid().'.'.$extension;

				// 念のため同一ファイルが存在するかチェック
				$checkOK = false;
				for($i=0;$i<3;$i++) {
					if(file_exists($setting['tmpPath'].$temp_pic)) {
						$temp_pic = String::uuid().'.'.$extension;
					}
					else {
						$checkOK = true;
						break;
					}
				}
				// ユニークなファイル名を生成できなかったらfalse
				if(!$checkOK) return false;

				// ファイルの移動
				if (move_uploaded_file($input[$name]['tmp_name'] , $setting['tmpPath'] . $temp_pic) == false ) {
						return false;
				}

				// 各値をセット
				$this->_controller->data[$model][$name.'_up'] = 1;
				$this->_controller->data[$model][$name.'_extension'] = $extension;

				// 表示用に画像サイズ取得
				$size = $this->_getWH($setting['tmpPath'] . $temp_pic, $setting['previewWidth'], $setting['previewHeight']);
				$this->_controller->data[$model][$name.'_w'] = $size['w'];
				$this->_controller->data[$model][$name.'_h'] = $size['h'];
			}
			else {
				if($input['id']) { // IDがあったら更新処理なので登録済み画像を取得する
					// オリジナル画像のデータが渡されていなかったら取得
					if(!$original) {
						$options =array();
						$options['conditions'] = array($model.'.id = '=>$input['id'], $model.'.delete_flag = '=>'0');
						$original = $this->_controller->{$model}->find('first',$options);
						if( $this->_controller->{$model}->sqlerror == false || empty($original) ) return false;
					}
					// 拡張子を取得
					$f_data = pathinfo($original[$model][$name]);
					$extension = strtolower($f_data['extension']);

					// 各値をセット
					$this->_controller->data[$model][$name.'_up'] = 0;
					$this->_controller->data[$model][$name.'_extension'] = $extension;

					// 表示用に画像サイズ取得
					$size = $this->_getWH($setting['contentsPath'] . $original[$model][$name], $setting['previewWidth'], $setting['previewHeight']);
					$this->_controller->data[$model][$name.'_w'] = $size['w'];
					$this->_controller->data[$model][$name.'_h'] = $size['h'];

					$temp_pic = $original[$model][$name];
				}
				else {
					$temp_pic = '';
				}
			}
		}
		else {
			$temp_pic = '';
		}

		// テンポラリファイル名をセット
		$this->_controller->data[$model][$name] = $temp_pic;

		return true;
	}

	/**
	 * 完了画面の画像処理
	 *
	 * @param array $options
	 * @param array $original
	 * @return mixed
	 */
	function completeImageAll($options=array(), $original=null) {

		// デフォルト値の設定
		$default = array(
			'model' => inflector::singularize($this->_controller->name),
			'name' => '',
			'session_name' => '',
//			'createName' => array('key'=>$id, 'prefix'=>''),
			'createName' => array('key'=>'random', 'prefix'=>'', 'beforePrefix'=>''),
			'tmpPath' =>FILE_TEMP_DIR,
			'contentsPath' =>IMAGE_DIR,
			'save' => false
		);

		if($options['createName']) {
			$default['createName'] = Set::merge($default['createName'], $options['createName']);
			unset($options['createName']);
		}
		$setting = Set::merge($default, $options);
		$model = $setting['model'];
		$name = $setting['name'];

		// 画像フィールドの取得
		$fields = $this->_controller->{$setting['model']}->imgFields;

		// 入力値を取得
		if(!$setting['session_name']) return false;
		if(!$this->_controller->Session->check($setting['session_name'])) return false;
		$input = $this->_controller->Session->read($setting['session_name']);

		// 画像処理の実行
		$cnt=1;
		$data = array();
		foreach ($fields as $key => $value) {
			$setOptions = $setting;
			$setOptions['name'] = $value;
			$setOptions['save'] = false;
			if($setOptions['createName']['key']!='random') $setOptions['createName']['beforePrefix'] = $cnt;
			$img = $this->completeImage($setOptions, $original);
			if($img === false) return false;

			$data[$value] = $img;
			$cnt++;
		}

		/**
		 * ここからDB登録処理
		 */
		if($setting['save']) {
			// 画像関係の更新
			$up_data=array();
			$up_data['id'] = $setting['save'];
			$up_data += $data;

			$this->_controller->{$model}->create();
			$up_list = $fields;
			if(!$this->_controller->{$model}->save($up_data,false,$up_list)){
				return false;
			}
		}

		return $data;
	}

	/**
	 * 完了画面の画像処理（単体）
	 *
	 * @param array $options
	 * @param array $original
	 * @return mixed
	 */
	function completeImage($options=array(), $original=null) {

		// デフォルト値の設定
		$default = array(
			'model' => inflector::singularize($this->_controller->name),
			'name' => '',
			'session_name' => '',
//			'createName' => array('key'=>$id, 'prefix'=>''),
			'createName' => array('key'=>'random', 'prefix'=>'', 'beforePrefix'=>''),
			'tmpPath' =>FILE_TEMP_DIR,
			'contentsPath' =>IMAGE_DIR,
			'save' => false
		);

		if($options['createName']) {
			$default['createName'] = Set::merge($default['createName'], $options['createName']);
			unset($options['createName']);
		}
		$setting = Set::merge($default, $options);
		$model = $setting['model'];
		$name = $setting['name'];

		// 名称が無かったらfalse
		if(!$name) return false;

		// 入力値を取得
		if(!$setting['session_name']) return false;
		if(!$this->_controller->Session->check($setting['session_name'])) return false;
		$input = $this->_controller->Session->read($setting['session_name']);

		// IDがあったら既存データを取得
		if($input['id']) {
			// オリジナル画像データが渡されていなかったら取得
			if(!$original) {
				$options =array();
				$options['conditions'] = array($model.'.id = '=>$input['id'], $model.'.delete_flag = '=>'0');
				$original = $this->_controller->{$model}->find('first',$options);
				if( $this->_controller->{$model}->sqlerror == false || empty($original) ) return false;
			}
		}

		// 画像処理
		if($input[$name.'_up'] == 1) { // アップされたら
			// ファイル名設定
			if($setting['createName']['key'] != 'random') {
				$picName = $setting['createName']['prefix'].sprintf("%08s", dechex($setting['createName']['key'])).$setting['createName']['beforePrefix'].'.'.$input[$name.'_extension'];
			}
			else { // ランダム生成
				$picName = $setting['prefix'].String::uuid().'.'.$input[$name.'_extension'];

				// 念のため同一ファイルが存在するかチェック
				$checkOK = false;
				for($i=0;$i<3;$i++) {
					if(file_exists($setting['contentsPath'].$picName)) {
						$picName = $setting['prefix'].String::uuid().'.'.$input[$name.'_extension'];
					}
					else {
						$checkOK = true;
						break;
					}
				}
				// ユニークなファイル名を生成できなかったらfalse
				if(!$checkOK) return false;
			}

			// 既存データがあった場合は削除
			if($input['id'] && $original[$model][$name] && file_exists($setting['contentsPath'] . $original[$model][$name])) {
				if (@unlink($setting['contentsPath'] . $original[$model][$name]) == false) {
					return false;
				}
			}

			// ファイルがあるか
			if(file_exists($setting['tmpPath'] . $input[$name]) == false ) {
				return false;
			}

			// ファイルコピー
			if (@copy($setting['tmpPath'] . $input[$name] , $setting['contentsPath'] . $picName ) == false) {
				return false;
			}

			// ファイル削除
			if (@unlink($setting['tmpPath'] . $input[$name] ) == false) {
				return false;
			}

			// ファイル名再設定
			$input[$name] = $picName;

			/**
			 * ここからDB登録処理
			 */
			if($setting['save']) { // 登録するなら

				// 画像関係の更新
				$up_data=array();
				$up_data['id'] = $setting['save'];
				$up_data[$name] = $input[$name];

				$this->_controller->{$model}->create();
				$up_list[] = $name;
				if(!$this->_controller->{$model}->save($up_data,false,$up_list)){
					return false;
				}

			}
		}
		elseif($input['id'] && $input['del_'.$name]) {

			// ファイル名は空に設定
			$picName = '';

			// 削除処理
			if ($original[$model][$name] && file_exists($setting['contentsPath'] . $original[$model][$name]) && @unlink($setting['contentsPath'] . $original[$model][$name]) == false ) {
				return false;
			}

			/**
			 * ここからDB登録処理
			 */
			if($setting['save']) { // 登録するなら

				// 画像関係の更新
				$up_data=array();
				$up_data['id'] = $setting['save'];
				$up_data[$name] = $picName;

				$this->_controller->{$model}->create();
				$up_list[] = $name;
				if(!$this->_controller->{$model}->save($up_data,false,$up_list)){
					return false;
				}

			}
		}
		elseif($input['id'] && $original[$model][$name]) {
			$picName = $original[$model][$name];
		}
		else {
			$picName = '';
		}

		return $picName;
	}

	/**
	 * 画像の削除
	 *
	 * @param array $data
	 * @param array $options
	 * @return bool
	 */
	function deleteImage($data=null, $options=array()) {
		// デフォルト値の設定
		$default = array(
			'model' => inflector::singularize($this->_controller->name),
			'contentsPath' =>IMAGE_DIR
		);

		$setting = Set::merge($default, $options);
		$model = $setting['model'];

		// 値がなかったらfalse
		if(!$data) return false;

		// 画像フィールドの取得
		$fields = $this->_controller->{$setting['model']}->imgFields;

		foreach ($fields as $key => $value) {
			if($data[$model][$value]) {
				if (file_exists($setting['contentsPath'] . $data[$model][$value]) && @unlink( $setting['contentsPath'] . $data[$model][$value]) == false ) {
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * キャッシュの削除
	 * @param null $data
	 * @param array $options
	 */
	function clearCache($data=null, $options=array()) {
		// デフォルト値の設定
		$default = array(
			'model' => inflector::singularize($this->_controller->name)
		);

		$setting = Set::merge($default, $options);
		$model = $setting['model'];

		// 画像フィールドの取得
		$fields = $this->_controller->{$setting['model']}->imgFields;

		foreach ($fields as $key => $value) {
			if($data[$model][$value]) {
				$this->_delCache($data[$model][$value]);
			}
		}
	}

	/**
	 * 値の整形（削除チェックボックス表示用にboolを文字列に変更）
	 *
	 * @param string $model
	 * @param array $data
	 * @return array
	 */
	function format($model=null, $data=array()) {
		$model = (!$model)?(inflector::singularize($this->_controller->name)):($model);
		$fields = $this->_controller->{$model}->imgFields;

		if(!$data) {
			foreach ($fields as $key => $value) {
				if(isset($this->_controller->data[$model]['del_'.$value]) === true) {
					$this->_controller->data[$model]['del_'.$value] = ($this->_controller->data[$model]['del_'.$value])?('true'):('false');
				}
			}

			return $this->_controller->data[$model];
		}
		else {
			foreach ($fields as $key => $value) {
				if(isset($data['del_'.$value]) === true) {
					$data['del_'.$value] = ($data['del_'.$value])?('true'):('false');
				}
			}

			return $data;
		}
	}

	/**
	 * 画像サイズを指定したサイズ内にして値を返却（アスペクト比維持）
	 *
	 * @param $filename
	 * @param int $w
	 * @param int $h
	 * @return array
	 */
	function _getWH($filename, $w=100, $h=100) {
		if(file_exists($filename) == false ) array('w'=>$w,'h'=>$h);
		$img_status = @getimagesize($filename);
		if(!$img_status)  array('w'=>$w,'h'=>$h);

		$width_old = $img_status[0];
		$height_old = $img_status[1];

		if($width_old <= $w && $height_old <= $h) {
			$width_new = $width_old;
			$height_new = $height_old;
		}
		else {
			$wper = $w / $width_old;
			$hper = $h / $height_old;

			$per = ( $wper <= $hper ) ? ($wper) : ( $hper );
			$width_new = round($width_old * $per);
			$height_new = round($height_old * $per);
		}

		return array('w'=>$width_new,'h'=>$height_new);
	}

	/**
	 *  対象の画像のキャッシュを削除
	 *
	 *  @author H.Kobayashi
	 *  @access public
	 *  @return bool 処理結果
	 */
	function _delCache($target) {
		if(!$target || !defined('CLEAR_CACHE_PATH')) return false;
		$target = explode('.',basename($target));
		if(count($target) < 2 ) return false;// 拡張子がないので終了
		$extension = end($target);
		array_pop($target); // 拡張子部分を除去
		$target = implode('',$target);

		return rm(CLEAR_CACHE_PATH . $target.'_*');

	}
}