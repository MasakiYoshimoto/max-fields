<?php
class ValidateCore {

	/**
	 * メッセージのセット
	 * @static
	 * @param $target
	 * @param null $params
	 * @return mixed|string
	 */
	public static function getMessage($target, $params=null) {

		$message = 'validation error';

		if($target['message']) {
			$message = str_replace(':label', $target['name'], $target['message']);
		}

		if($params) {
			foreach ($params as $key=> $value) {
				$message = str_replace(':'.$key, $value, $message);
			}
		}

		return $message;
	}

	/**
	 * 必須
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_require($target, $params) {

		if(!$target['value'] && $target['params'] !== false) return self::getMessage($target);

		return true;
	}

	/**
	 * 最大文字数
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_maxLength($target, $params) {

		if($target['allowEmpty'] && !$target['value']) return true;

		if(mb_strlen($target['value']) > $target['params']) {
			$data['val1'] = $target['params'];
			return self::getMessage($target, $data);
		}

		return true;
	}

	/**
	 * 郵便番号
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_zip($target, $params) {

		if($target['allowEmpty'] && !$target['value']) return true;

		if(preg_match( '@^[0-9]{3}-?[0-9]{4}$@', $target['value']) != 1) {
			return self::getMessage($target);
		}

		return true;
	}

	/**
	 * 電話番号
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_tel($target, $params) {

		if($target['allowEmpty'] && !$target['value']) return true;

		if(preg_match( '@^[0-9\-]+$@', $target['value']) != 1) {
			return self::getMessage($target);
		}

		return true;
	}

	/**
	 * メールアドレス
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_email($target, $params) {

		if($target['allowEmpty'] && !$target['value']) return true;

		if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $target['value']) == 0) {
			return self::getMessage($target);
		}

		return true;
	}

	/**
	 * メールアドレス確認
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_confirmEmail($target, $params) {

		if($target['allowEmpty'] && !$target['value']) return true;

		if($params[$target['params']] != $target['value']) return self::getMessage($target);

		return true;
	}

	/**
	 * パラメータ内の値との一致
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_inValue($target, $params) {

		if($target['allowEmpty'] && !$target['value']) return true;

		if(array_search($target['value'], $target['params'])===false) return self::getMessage($target);

		return true;
	}

	/**
	 * テキスト(テキスト・テキストエリア)
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_text($target, $params) {

		if(is_array($target['value'])) return self::getMessage($target);

		return true;
	}

	/**
	 * プルダウン・ラジオボタン
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_select($target, $params) {

		if($target['allowEmpty'] && !$target['value']) return true;

		if(is_array($target['value']) || array_search($target['value'], $target['list'])===false) return self::getMessage($target);

		return true;
	}

	/**
	 * チェックボックス
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_checkbox($target, $params) {

		if($target['allowEmpty'] && !$target['value']) return true;
		if(!is_array($target['value'])) return self::getMessage($target);

		foreach ($target['value'] as $value) {
			if(array_search($value, $target['list'])===false) return self::getMessage($target);
		}

		return true;
	}

	/**
	 * 数字かどうか(INT)
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_int($target, $params) {

		if($target['allowEmpty'] && (is_null($target['value']) === true || $target['value'] === '')) return true;

		if(!is_numeric($target['value']) || !is_int((int)$target['value'])) return self::getMessage($target);

		return true;
	}

	/**
	 * 範囲内の数字かどうか
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_between($target, $params) {

		if($target['allowEmpty'] && (is_null($target['value']) === true || $target['value'] === '')) return true;

		if(isset($target['params']['min']) === false || isset($target['params']['max']) === false || !is_numeric($target['params']['min']) || !is_numeric($target['params']['min'])) {
			$target['message'] = 'エラー';
			return self::getMessage($target);
		}

		if($target['value'] < $target['params']['min'] || $target['value'] > $target['params']['max']) {
			$data['min'] = $target['params']['min'];
			$data['max'] = $target['params']['max'];

			return self::getMessage($target, $data);
		}

		return true;
	}

	/**
	 * 正規表現
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_regex($target, $params) {

		if($target['allowEmpty'] && (is_null($target['value']) === true || $target['value'] === '')) return true;

		if(preg_match($target['params'], $target['value']) !== 1) return self::getMessage($target);

		return true;
	}

	/**
	 * ---------------------------------------------------------------------------------------------
	 */
}