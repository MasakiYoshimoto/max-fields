<?php
class Validate extends ValidateCore{
	/**
	 * 日付
	 * @static
	 * @param $target
	 * @param $params
	 * @return bool|mixed|string
	 */
	public static function validate_date($target, $params) {

		if($target['allowEmpty'] && (is_null($target['value']) === true || $target['value'] === '')) return true;

		if(preg_match('@^[0-9]{4}/[0-9]{2}/[0-9]{2}$@', $target['value']) !== 1) return self::getMessage($target);

		$a_date = explode('/', $target['value']);

		if(!checkdate($a_date[1], $a_date[2], $a_date[0])) return self::getMessage($target);

		return true;
	}
}