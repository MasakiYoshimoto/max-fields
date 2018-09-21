<?php
class MyreportsController extends AppController
{
	var $name = "Myreports";
	var $uses = array("Analytics");
	var $components = array("obAuth");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array())) exit();
		parent::beforeFilter();
	}

	function index() {

		$this->autoRender = false;
		Configure::write('debug', 0); // debugコードを出さないように

		App::import('Vendor', 'GapiClass', array('file' => 'gapi'.DS.'gapi.class.php'));

		// アナリティクスの設定を取得する
		$options = array('conditions' => array( 'id ='=>'1' ));
		$analytics = $this->Analytics->find('first' ,$options);
		if($this->Analytics->sqlerror == false) exit();

		$start_date = date('Y-m-d',strtotime('-10 day'));
		$end_date = date('Y-m-d',strtotime('-1 day'));

		if( !$analytics['Analytics']['login_id'] || !$analytics['Analytics']['login_pass'] ) {
			print '';
			exit();
		}

		$ga = new gapi($analytics['Analytics']['login_id'],$analytics['Analytics']['login_pass']);

		$ga->requestReportData(
			$analytics['Analytics']['profile_id'],
			array('date'), // 日付ごとにデータを取得します
			array('pageviews','visits'), // pageviewとvistisを取得します
			array('date'), // ソート条件
			null, // filter条件
			$start_date, //開始日
			$end_date // 終了日

		);

		$pageviews=array();
		$visits=array();

		if(!$ga->getResults()) {
			print '';
			exit();
		}

		foreach($ga->getResults() as $result) {
			$dimesions = $result->getDimesions();
			$pageviews[] = $result->getPageviews();
			$visits[] = $result->getVisits();
		}

		$out_pageviews = (!$pageviews)?(''):(implode(',',$pageviews));
		$out_visits = (!$visits)?(''):(implode(',',$visits));

		$out = "";
		$out .= "	{\"chartDatas\" : [";
		$out .= "		{ \"name\": \"ページビュー\",";
		$out .= "			\"data\": [".$out_pageviews."]";
		$out .= "		},";
		$out .= "		{ \"name\": \"セッション\",";
		$out .= "			\"data\": [".$out_visits."]";
		$out .= "		}";
		$out .= "	]}";

		print $out;
		exit();

	}

	function ranking() {

		Configure::write('debug', 0); // debugコードを出さないように

		App::import('Vendor', 'GapiClass', array('file' => 'gapi'.DS.'gapi.class.php'));

		// アナリティクスの設定を取得する
		$options = array('conditions' => array( 'id ='=>'1' ));
		$analytics = $this->Analytics->find('first' ,$options);
		if($this->Analytics->sqlerror == false) exit();

		$start_date = date('Y-m-d',strtotime('-1 month',strtotime('-1day')));
		$end_date = date('Y-m-d',strtotime('-1 day'));

		if( !$analytics['Analytics']['login_id'] || !$analytics['Analytics']['login_pass'] ) {
			print '情報の取得に失敗しました。';
			exit();
		}

		$ga = new gapi($analytics['Analytics']['login_id'],$analytics['Analytics']['login_pass']);

		$ga->requestReportData(
			$analytics['Analytics']['profile_id'],
			array('pagePath'),
			array('pageviews'), // pageviewとvistisを取得します
			array('-pageviews'), // ソート条件
			null, // filter条件
			$start_date, //開始日
			$end_date, // 終了日
			1, // 開始位置
			10 // 最大件数

		);


		$rank=array();
		$i=0;
		foreach($ga->getResults() as $result) {
			$dimesions = $result->getDimesions();
			$rank[$i]['rank'] = $i + 1;
			$rank[$i]['path'] = $dimesions['pagePath'];
			$rank[$i]['pageviews']  = $result->getPageviews();
			$i++;
		}

		$this->set('list', $rank);

	}
}
?>
