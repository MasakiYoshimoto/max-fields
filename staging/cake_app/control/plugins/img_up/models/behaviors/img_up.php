<?php
/**
 *
 * product name : ImgUp
 * Copyright 2012, Arms Inc
 *
 * img_up.php
 *
 * @copyright        Copyright 2012, Arms Inc
 * @Revision        $Revision: 17 $
 * @modifiedby        $LastChangedBy: arms $
 * @lastmodified    $Date: 2012-06-21 15:11:54 +0900 (木, 21 6 2012) $
 */

class ImgUpBehavior extends ModelBehavior {

	var $_model;
	var $_fields;

	function setUp(&$model, $config = array()) {
	}

	function imgupRequire(&$model, $check, $options=array()) {

		// フィールドKEY・値を取得
		$val = reset($check);
		$key = key($check);

		if($val['error'] == UPLOAD_ERR_NO_FILE) return false;
		if($val['error'] == UPLOAD_ERR_INI_SIZE || $val['error'] == UPLOAD_ERR_PARTIAL) return false;

		return true;
	}

	function imgupCheck(&$model, $check, $options=array()) {

		// フィールドKEY・値を取得
		$val = reset($check);
		$key = key($check);

		// 初期設定
		$default = array(
			'model' => $this->name,
			'fileSize' => MAX_FILE_SIZE,
			'width' => 2000,
			'height' => 2000,
			'type' => 'jpg,gif,png'
		);
		$setting = Set::merge($default, $options);

		// 正しくアップされているか
		if($val['error'] != UPLOAD_ERR_OK && $val['error'] != UPLOAD_ERR_NO_FILE) return false;

		// アップロードが無かったらtrue
		if($val['error'] == UPLOAD_ERR_NO_FILE) return true;

		// ファイルサイズ
		if(!$this->imgupCheckFileSize($model, $check, $options)) return false;

		// 画像サイズ
		if(!$this->imgupCheckImageSize($model, $check, $options)) return false;

		// ファイルタイプ
		if(!$this->imgupCheckFileType($model, $check, $options)) return false;

		return true;
	}

	function imgupCheckFileSize(&$model, $check, $options=array()) {

		// フィールドKEY・値を取得
		$val = reset($check);
		$key = key($check);

		// 初期設定
		$default = array(
			'model' =>  $model->name,
			'fileSize' => MAX_FILE_SIZE
		);
		$setting = Set::merge($default, $options);

		// 正しくアップされているか
		if($val['error'] != UPLOAD_ERR_OK && $val['error'] != UPLOAD_ERR_NO_FILE) return false;

		// アップロードが無かったらtrue
		if($val['error'] == UPLOAD_ERR_NO_FILE) return true;

		// 最大サイズのバイト変換
		if(preg_match('/MB$/i', $setting['fileSize']) == 1) $setting['fileSize'] = $setting['fileSize'] * 1024 * 1024;

		// 判定
		if($val['error'] == UPLOAD_ERR_FORM_SIZE) return false;
		if($setting['fileSize'] < $val['size']) return false;

		return true;
	}

	function imgupCheckFileType(&$model, $check, $options=array()) {

		// フィールドKEY・値を取得
		$val = reset($check);
		$key = key($check);

		// 初期設定
		$default = array(
			'model' =>  $model->name,
			'type' => 'jpg,gif,png'
		);
		$setting = Set::merge($default, $options);

		// 正しくアップされているか
		if($val['error'] != UPLOAD_ERR_OK && $val['error'] != UPLOAD_ERR_NO_FILE) return false;

		// アップロードが無かったらtrue
		if($val['error'] == UPLOAD_ERR_NO_FILE) return true;

		// 拡張子を取得
		$f_data = pathinfo($val['name']);
		$extension = strtolower($f_data['extension']);

		// ファイル情報取得
		$imgInfo = @getimagesize($val['tmp_name']);
		if(!$imgInfo) return false;

		// 許可ファイルタイプ
		$allow = explode(',', $setting['type']);

		// 判定
		switch ($imgInfo[2]) {
			case IMAGETYPE_GIF:
				if($extension != 'gif') return false;
				if(array_search('gif', $allow) === false) return false;
				break;
			case IMAGETYPE_JPEG:
				if($extension != 'jpg' && $extension != 'jpeg') return false;
				if(array_search('jpg', $allow) === false) return false;
				break;
			case IMAGETYPE_PNG:
				if($extension != 'png') return false;
				if(array_search('png', $allow) === false) return false;
				break;
			default:
				return false;
				break;
		}

		return true;
	}

	function imgupCheckImageSize(&$model, $check, $options=array()) {

		// フィールドKEY・値を取得
		$val = reset($check);
		$key = key($check);

		// 初期設定
		$default = array(
			'model' =>  $model->name,
			'width' => 2000,
			'height' => 2000
		);
		$setting = Set::merge($default, $options);

		// 正しくアップされているか
		if($val['error'] != UPLOAD_ERR_OK && $val['error'] != UPLOAD_ERR_NO_FILE) return false;

		// アップロードが無かったらtrue
		if($val['error'] == UPLOAD_ERR_NO_FILE) return true;

		// ファイル情報取得
		$imgInfo = @getimagesize($val['tmp_name']);
		if(!$imgInfo) return false;

		// 判定
		if($imgInfo[0] > $setting['width'] || $imgInfo[1] > $setting['height']) return false;

		return true;
	}

	function imgupCheckDelUp(&$model, $check) {

		// フィールドKEY・値を取得
		$val = reset($check);
		$key = key($check);

		// モデル名
		$model = $model->name;

		// フィールド名取得
		$name = str_replace('del_', '', $key);

		// 判定
		if( $val == 1 && $this->data[$model][$name]['name'] != "" ) return false;

		return true;
	}
}