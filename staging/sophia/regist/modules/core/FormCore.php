<?php
include(MODULES_DIR.'/config/config.inc.php');
include(MODULES_DIR.'/core/ValidateCore.php');
include(MODULES_DIR.'/Validate.php');
include(MODULES_DIR.'/vendor/qdmail/qdmail.php');
include(MODULES_DIR.'/vendor/qdmail/qdmailEx.php');
class FormCore {

	protected $mode = 1;
	protected $fieldSet = array();
	protected $parser = null;
	protected $validationType;

	public $form_name;

	public function __construct() {

		mb_language('Japanese');
		ini_set('default_charset', 'UTF-8');
		ini_set('mbstring.detect_order', 'auto');
		ini_set('mbstring.http_input'  , 'auto');
		ini_set('mbstring.http_output' , 'pass');
		ini_set('mbstring.internal_encoding', 'UTF-8');
		ini_set('mbstring.script_encoding'  , 'UTF-8');
		ini_set('mbstring.substitute_character', 'none');
		mb_regex_encoding("UTF-8");
		setlocale(LC_ALL,'ja_JP.UTF-8');

		ini_set('session.use_cookies', 1);
		ini_set('session.use_only_cookies', 1);
		ini_set('session.use_trans_sid', 0);

		date_default_timezone_set('Asia/Tokyo');

		session_cache_limiter('none');
		session_name('ARFORM');
		session_set_cookie_params(0);
		session_start();

		// セッションが保持されないのに対応
		if(isset($_POST['m'])===false || $this->probability(30)) {
			$tmp = $_SESSION;
			session_regenerate_id(true);
			$_SESSION = $tmp;
		}

		// セキュリティ処理
		$this->security();

		// parserの設定
		$this->initParser();

		// フィールド設定のロード
		$this->fieldSet = $this->load('fieldset');

		// フォーム名設定
		$this->form_name = strtoupper(str_replace('/', '_', APP_DIR));
	}

	/**
	 * parserの起動
	 */
	protected function initParser() {
		$parserName = ucfirst(strtolower(PARSER));
		if(!file_exists(MODULES_DIR.'/parser/'.$parserName.'.php')) die('parser not found !');
		include(MODULES_DIR.'/parser/'.$parserName.'.php');

		$parser = 'Parser_'.$parserName;
		if(!class_exists($parser)) die('parser not found !');

		$this->parser = new $parser;
	}

	/**
	 * セキュリティ関連の処理
	 */
	protected  function security() {
		self::check_encoding($_REQUEST);
		//self::check_control($_REQUEST);

		$_GET    = self::clean($_GET);
		$_POST   = self::clean($_POST);
		$_COOKIE = self::clean($_COOKIE);
	}

	/**
	 * フォーム処理の実行
	 */
	public function run() {

		// モードの設置
		if(isset($_POST['m'])===false || !$_POST['m']) $_POST['m'] = 1;
		$this->mode = $_POST['m'];

		switch ($_POST['m']) {
			case 1:
				unset($_SESSION['ARSFORM_DATA'.$this->form_name]);
				$this->step1();
				break;
			case 3:
				$this->step1();
				break;
			case 2:
				$this->step2();
				break;
			case 4:
				$this->step3();
				break;
			default:
				$this->mode = 1;
				$this->step1();
				break;
		}
	}

	/**
	 * 入力画面表示
	 */
	protected function step1() {
		if($this->mode==1) {
			$params = $this->setDefault();
		}
		else {
			$params = $_SESSION['ARSFORM_DATA'.$this->form_name]['params'];
			$params = $this->setDefault($params);
		}
		unset($_SESSION['ARSFORM_DATA'.$this->form_name]['_token']);
		$this->set('error', array());
		$this->set('input', $params);
		$this->display('index.html');
	}

	/**
	 * 確認画面表示
	 */
	protected function step2() {

		$params = $_POST;
		$error = $this->validate($params);
		if($error!==true) {
			$this->mode=3;
			$params = $this->setDefault($params);
			$this->set('error', $error);
			$this->set('input', $params);
			$this->display('index.html');
		}

		// 個別の整形処理
		$data = $this->formatData($params);

		// 整形処理
		$data = $this->formatConfirmData($data);

		$this->set('conf', $data);
		$this->setToken();

		// セッションに登録
		$_SESSION['ARSFORM_DATA'.$this->form_name]['data']   = $data;
		$_SESSION['ARSFORM_DATA'.$this->form_name]['params'] = $params;

		$this->display('conf.html');
	}

	/**
	 * 完了画面表示
	 */
	protected function step3() {

		// キャッシュさせない
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('pragma: no-cache');
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

		// 二重投稿防止
		if(!$this->checkToken($_POST['_token'])) $this->redirect();

		// セッションから値取り出し
		if(isset($_SESSION['ARSFORM_DATA'.$this->form_name]['data']) === false) $this->redirect();
		$data = $_SESSION['ARSFORM_DATA'.$this->form_name]['data'];
		unset($_SESSION['ARSFORM_DATA'.$this->form_name]);

		// メール送信
		if($this->sendFormMail($data) == false) $this->redirect();

		$this->set('data', $data);
		$this->display('thanks.html');
	}

	/**
	 * フィールドの基本値を設定
	 *
	 * @param null $params
	 * @return array
	 */
	protected function setDefault($params=null) {

		$default = array();

		if($this->mode==1) {
			foreach ($this->fieldSet as $key=>$value) {
				if(isset($value['list'])===true) {
					for($i=1;$i<=count($value['list']);$i++) {
						$default[$key.'_'.$i] = $value['default'];
					}
				}
				else {
					$default[$key] = $value['default'];
				}
			}
		}
		elseif($this->mode==3) {
			foreach ($this->fieldSet as $key=>$value) {
				if(isset($params[$key])===true) {
					if(isset($value['list'])===true) {
						$input = (array)$params[$key];
						for($i=0;$i<count($value['list']);$i++) {
							if(array_search($value['list'][$i], $input)!==false) {
								$default[$key.'_'.($i+1)] = true;
							}
							else {
								$default[$key.'_'.($i+1)] = $value['default'];
							}
						}
					}
					else {
						$default[$key] = $params[$key];
					}
				}
				else {
					if(isset($value['list'])===true) {
						for($i=1;$i<=count($value['list']);$i++) {
							$default[$key.'_'.$i] = $value['default'];
						}
					}
					else {
						$default[$key] = $value['default'];
					}
				}
			}
		}

		return $default;
	}

	/**
	 * 確認画面でのデータを整形
	 * @param $data
	 * @return array
	 */
	protected function formatConfirmData($data) {

		$formatData = array();

		foreach($this->fieldSet as $key=>$value) {
			if(isset($data[$key])===true) {
				if(is_array($data[$key]) && $data[$key]) { // 配列だったら
					if(isset($value['separator'])) { // 指定された区切り文字で連結
						$formatData[$key] = implode($value['separator'], $data[$key]);
					}
					else { // 指定されていなかったらデフォルトで
						$formatData[$key] = implode('/', $data[$key]);
					}
				}
				else {
					$formatData[$key] = $data[$key];
				}
			}
			else {
				$data[$key] = $value['default'];
			}
		}

		return $formatData;
	}

	/**
	 * 確認画面でのデータの整形
	 * 個別用 overrideして使用
	 * @param $data
	 * @return array
	 */
	public function formatData($data) {

		return $data;
	}

	/**
	 * バリデーションの実行
	 * @param $params
	 * @return array|bool
	 */
	protected function validate($params) {

		$error = array();

		// バリデーションタイプをセット
		$this->validationType = $this->setValidationType($params);

		foreach($this->fieldSet as $key=>$value) {

			// タイプが指定されていたら現在のタイプかどうかチェック
			$vtype = isset($value['vtype']) === true ? $value['vtype'] : null;
			if($this->validationType && $vtype && is_array($vtype) && array_search($this->validationType, $vtype) === false) continue;

			foreach ($value['validate'] as $key2=> $value2) {

				$target = array();
				$target['name']       = $value['name'];
				$target['list']        = isset($value['list'])===true ? $value['list'] : '';
				$target['allowEmpty'] = isset($value2['allowEmpty'])===true ? $value2['allowEmpty'] : false;
				$target['message']    = isset($value2['message'])===true ? $value2['message'] : '';
				$target['params']     = isset($value2['params'])===true ? $value2['params'] : '';
				$target['value']      = isset($params[$key]) === true ? $params[$key] : $value['default'];
				$target['vtype']      = isset($value2['vtype']) === true ? $value2['vtype'] : null;

				// タイプが指定されていたら現在のタイプかどうかチェック
				if($this->validationType && $target['vtype'] && is_array($target['vtype']) && array_search($this->validationType, $target['vtype']) === false) continue;

				$method = 'validate_'.$key2;
				$result = Validate::$method($target, $params);
				if($result!==true) {
					$error[$key] = $result;
					break;
				}
			}
		}

		if($error) {
			return $error;
		}
		else {
			return true;
		}
	}

	/**
	 * バリデーションパターンをセット
	 * @param $params
	 * @return mixed
	 */
	public function setValidationType($params) {
		return null;
	}

	/**
	 * 値のセット
	 * @param $name
	 * @param $value
	 * @param bool $encode
	 */
	protected function set($name, $value, $encode=true) {
		$this->parser->set($name, $value, $encode);
	}

	/**
	 * 表示処理
	 * @param $file
	 */
	protected function display($file) {
		$this->parser->display($file);
		exit();
	}

	/**
	 * 設定ファイルのロード
	 * @param $file
	 * @return array
	 */
	protected function load($file) {
		$file .='.php';
		if(strpos($file,'/')===true || !file_exists(APP_DIR.'/modules/config/'.$file)) return array();
		return include(MODULES_DIR.'/config/'.$file);
	}

	/**
	 *  フォームメールの送信
	 *
	 */
	protected function sendFormMail($data) {
		// メール情報取得
		$mailConfig = $this->getIni();

		$to = $data['email'];

		$to_manager = '';
		if ($mailConfig['mail']['to_manager']) {
			$to_manager = explode(',', $mailConfig['mail']['to_manager']);
		}

//echo "to->".$to."<br/>";
//echo "fmail_to_manager->";
//print_r($to_manager);
//echo "<br/>";
//echo "fmail_from->".$mailConfig['mail']['from'] ."<br/>";
//echo "fmail_from_name->".$mailConfig['mail']['from_name'] ."<br/>";
//echo "fmail_subject->".$mailConfig['mail']['subject'] ."<br/>";
//echo "to_manager_subject->".$mailConfig['mail']['to_manager_subject'] ."<br/>";
//exit();

		// 本文読み込み
		if(!file_exists(MODULES_DIR.'/config/mail.txt')) return false;
		$text = file_get_contents(MODULES_DIR.'/config/mail.txt');

		if(!file_exists(MODULES_DIR.'/config/mail2.txt')) return false;
		$text2 = file_get_contents(MODULES_DIR.'/config/mail2.txt');

		// メール文章の置換
		$text  = $this->replaceText($data, $text);
		$text2 = $this->replaceText($data, $text2);

		// 置換されなかったものを削除
		$text  = $this->replaceEx("{{.+?}}", '', $text);
		$text2 = $this->replaceEx("{{.+?}}", '', $text2);

		// メール送信
		if ($this->sendMail($to, $mailConfig['mail']['from'], $mailConfig['mail']['from_name'], $mailConfig['mail']['subject'], $text) == false) return false;

		// 管理者宛送信
		if ($mailConfig['mail']['to_manager']) {
			for($i=0;$i<count($to_manager);$i++) {
				if ($this->sendMail($to_manager[$i], $to, '', $mailConfig['mail']['to_manager_subject'], $text2) == false) return false;
			}
		}

		return true;
	}

	/**
	 * メール送信
	 * @param $to
	 * @param $from
	 * @param $from_name
	 * @param $subject
	 * @param $text
	 * @return bool
	 */
	protected function sendMail($to, $from, $from_name, $subject, $text) {

		$mail = new QdmailEx();
		if(MAIL_CHARSET == 0) $mail->charset('utf-8', 'base64');
		$mail->errorDisplay(false);
		if(MAIL_CHARSET == 0) $mail->unitedCharset('utf-8');
		$mail->lineFeed(LINE_FEED);

		$mail->mtaOption("-f " . $from);
		$mail->to($to);
		$mail->subject($subject);
		$mail->text($text);
		$mail->from($from, $from_name);

		if($mail->send() == false) return false;

		return true;
	}

	/**
	 * iniファイル読込
	 * @return array
	 */
	protected function getIni() {
		// 設定ファイルを読み込む
		if(!file_exists(MODULES_DIR . '/config/mail.ini')) return array();
		return parse_ini_file(MODULES_DIR . '/config/mail.ini', true);
	}

	/**
	 * 変数もしくは配列の値に対してhtmlentitiesを行う
	 * @param $in_value
	 * @return array|string
	 */
	public static function htmlentitiesEx($in_value) {

		if(is_object($in_value)) return $in_value;

		if(is_array($in_value) === false) {
			return htmlentities($in_value, ENT_QUOTES, 'UTF-8');
		}
		else{
			foreach ($in_value as $key => $value) {
				if(is_object($value)) continue;
				if(is_array($value) === true) {
					$in_value[$key] = FORM::htmlentitiesEx($value);
				}
				else{
					$in_value[$key] = htmlentities($value, ENT_QUOTES, 'UTF-8');
				}
			}
			return $in_value;
		}
	}

	/**
	 * 文字列中のキーに対して置換
	 * @param $in_value
	 * @param $txt
	 * @return mixed
	 */
	protected function replaceText($in_value, $txt) {
		if(is_array($in_value)) {
			foreach ($in_value as $key => $value) {
				$txt = $this->replaceEx("{{" . $key . "}}", $value, $txt);
			}
		}
		return ($txt);
	}

	/**
	 * 変数もしくは配列の値に対して置換を行う
	 * @param $search_string
	 * @param $replace_string
	 * @param $in_value
	 * @return array|string
	 */
	protected function replaceEx($search_string, $replace_string, $in_value) {

		if(is_object($in_value)) return $in_value;

		if(is_array($in_value) === false) {
			return mb_ereg_replace($search_string, $replace_string, $in_value);
		}
		else{
			foreach ($in_value as $key => $value) {

				if(is_object($value)) continue;

				if(is_array($value) === true) {
					$in_value[$key] = $this->replaceEx($search_string, $replace_string, $value);
				}
				else{
					$in_value[$key] = mb_ereg_replace($search_string, $replace_string, $value);
				}
			}
			return $in_value;
		}
	}

	/**
	 * セキュリティトークンのセット
	 */
	protected function setToken() {
		$token = $this->uuidV4();
		$this->set('_token', $token);
		$_SESSION['ARSFORM_DATA'.$this->form_name]['_token'] = $token;
	}

	/**
	 * セキュリティトークンのチェック
	 * @param null $token
	 * @return bool
	 */
	protected function  checkToken($token=null) {
		if(!$token) return false;
		if(isset($_SESSION['ARSFORM_DATA'.$this->form_name]['_token']) === false) return false;
		$sessionToken = $_SESSION['ARSFORM_DATA'.$this->form_name]['_token'];
		unset($_SESSION['ARSFORM_DATA'.$this->form_name]['_token']);

		if($token !== $sessionToken) return false;

		return true;
	}

	/**
	 * トップへリダイレクト
	 */
	protected function redirect() {
		if(isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == 'on') {
			$protocol = 'https://';
		}
		else {
			$protocol = 'http://';
		}
		$dir = dirname($_SERVER["SCRIPT_NAME"]) == '/' ? '' : dirname($_SERVER["SCRIPT_NAME"]);
		$url = $protocol . $_SERVER['HTTP_HOST'] . $dir . '/';

		header("Location: " . $url);
		exit();
	}

	/**
	 * UUID V4を生成
	 * @return string
	 */
	protected function uuidV4() {
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}

	/**
	 * 確率の判定
	 * @param int $prob
	 * @return bool
	 */
	protected function probability($prob=100) {
		return mt_rand(1,100) <= $prob;
	}

	/**
	 * 入力値のサニタイズ
	 * @static
	 * @param $data
	 * @return mixed
	 */
	protected static function clean($data) {

		// 配列の場合は再帰的に処理
		if (is_array($data)) {
			array_map(array('Form', 'clean'), $data);
			return $data;
		}

		$data = str_replace(chr(0xCA), '', $data);
		$data = str_replace("\\\$", "$", $data);
		$data = str_replace("\r", "", $data);
		$data = preg_replace("/&amp;#([0-9]+);/s", "&#\\1;", $data);
		$data = preg_replace("/\\\(?!&amp;#|\?#)/", "\\", $data);
		return $data;
	}

	// 文字エンコーディングの検証フィルタ
	protected static function check_encoding($value) {
		// 配列の場合は再帰的に処理
		if (is_array($value)) {
			array_map(array('Form', 'check_encoding'), $value);
			return $value;
		}

		// 文字エンコーディングを検証
		if (mb_check_encoding($value, 'UTF-8')) {
			return $value;
		}
		else {
			// エラーを表示して終了
			die('Invalid input data');
		}
	}

	// 改行コードとタブを除く制御文字が含まれないかの検証フィルタ
	protected static function check_control($value) {

		if (is_array($value)) {
			array_map(array('Form', 'check_control'), $value);
			return $value;
		}

		// なぜかuオプションを付けるとダメなので外した。。。
		if (preg_match('/\A[\r\n\t[:^cntrl:]]*\z/', $value) === 1) {
			return $value;
		}
		else {
			// エラーを表示して終了
			die('Invalid input data');
		}
	}
}