<?php
include(MODULES_DIR.'/core/FormCore.php');
class Form extends FormCore {

	public function __construct() {
		parent::__construct();
		$this->set('wwwroot_path', realpath(dirname(__FILE__).'/../../'));

		if(strpos($_SERVER['SERVER_NAME'], 'tokista.co.jp') === false) {
			$this->set('to_normal_contents', 'http://'.$_SERVER['SERVER_NAME']);
			$this->set('to_ssl_contents', 'http://'.$_SERVER['SERVER_NAME']);
		}
		else {
			$this->set('to_normal_contents','http://tokista.co.jp');
			$this->set('to_ssl_contents', 'https://tokista.co.jp');
		}
	}

	/**
	 * 確認画面のデータ整形
	 * @param $data
	 * @return array
	 */
//	function formatData($data) {
//		return $data;
//	}

	/**
	 * バリデーションタイプのセット
	 * @param $params
	 * @return mixed
	 */
//	function setValidationType($params) {
//		return 2;
//	}

}