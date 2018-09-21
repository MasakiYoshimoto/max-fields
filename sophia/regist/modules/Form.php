<?php
include(MODULES_DIR.'/core/FormCore.php');
class Form extends FormCore {

	var $db_config;
	var $job_data;

	/**
	 * @var $pdo PDO
	 */
	var $pdo;

	public function __construct() {
		parent::__construct();

		$this->db_config = $this->load('db_config');
		$this->init_db();
	}

	public function init_db() {

		// 5.3.6以下対応。。。。
		$options = array();
		if(version_compare(PHP_VERSION, '5.3.6') < 0) {
			$options =     array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET `'.$this->db_config['encoding'].'`'
			);
		}

		try {
			$pdo = new PDO(
				'mysql:host='.$this->db_config['host'].';dbname='.$this->db_config['database'].';port='.$this->db_config['port'].';charset='.$this->db_config['encoding'],
				$this->db_config['id'], $this->db_config['password'],
				$options
			);
		}
		catch (PDOException $e){
			die('error');
		}

		if(!$pdo) {
			die('error');
		}

		$this->pdo = $pdo;
	}

	/**
	 * フォーム処理の実行
	 */
	public function run() {

		// モードの設置
		if(isset($_POST['m'])===false || !$_POST['m']) $_POST['m'] = 1;
		$this->mode = $_POST['m'];

		if($_POST['m'] != 4) {
			$id = 'id';
			if(isset($_GET['d'])) {
				$id = $_GET['d'];
			}
			elseif(isset($_POST['d'])) {
				$id = $_POST['d'];
			}
			else {
				// 案件IDが無かったら
				$id = null;
			}
			if($id)
			{
				if(!$this->setDetail($id)) {
					$this->redirect();
				}
			}
			else
			{
				$this->set('job_data', array());
				$this->job_data = array();
			}
		}

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
	 * 確認画面表示
	 */
	protected function step2() {

		$params = $this->formatPostData($_POST);
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

		$data = $this->afterFormatData($data, $params);

		$this->set('conf', $data);
		$this->setToken();

		// セッションに登録
		$_SESSION['ARSFORM_DATA'.$this->form_name]['data']   = $data;
		$_SESSION['ARSFORM_DATA'.$this->form_name]['params'] = $params;

		$this->display('conf.html');
	}

	/**
	 * POST値の整形
	 * @param $data
	 * @return mixed
	 */
	public function formatPostData($data) {
		return $data;
	}

	function afterFormatData($data, $params) {
		if($this->job_data && $this->job_data['catchcopy']) {
			$data['catchcopy'] = $this->job_data['catchcopy'];
		}
		else {
			$data['catchcopy'] = '-';
		}

		return $data;
	}

	function setDetail($id) {

		// IDチェック
		if(!is_numeric($id) || !is_int($id * 1)) return false;
		if((string)$id !== (string)(int)$id) return false;

		// 情報の取得
		$data = $this->getJobDetailData($id);
		if ($data === false)  return false;

		// カテゴリーのセット
		$category = array();
		require(realpath($_SERVER['DOCUMENT_ROOT'].'/cake_app/category3.php'));

		// エリアのセット
		$area = array();
		require(realpath($_SERVER['DOCUMENT_ROOT'].'/cake_app/area2.php'));

		$this->set('job_data', $data);
		$this->job_data = $data;

		return true;
	}

	function getJobDetailData ($id) {

		$data = array();

		// 今を取得
		$now_date = date('Y-m-d');

		$sql = 'SELECT * FROM '.$this->db_config['prefix'].'job2_offers WHERE id=? AND ';
		$sql .= '(open_date <= ? OR !DAYOFMONTH(open_date)) AND ';
		$sql .= '(end_date >= ? OR !DAYOFMONTH(end_date)) AND ';
		$sql .= "disable = 0 AND ";
		$sql .= "deleted = 0;";
		$where_data = array(
			$id,
			$now_date,
			$now_date
		);

		$stmt = $this->pdo->prepare($sql);
		$result= $stmt->execute($where_data);

		if (!$result){
			return false;
		}

		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$data = $row;


		return $data;
	}

	/**
	 * トップへリダイレクト
	 */
	protected function redirect() {

		$protocol = 'http://';
		$url = $protocol . $_SERVER['HTTP_HOST'].'/';

		header("Location: " . $url);
		exit();
	}
}