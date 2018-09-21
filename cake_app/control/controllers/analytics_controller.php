<?php
class AnalyticsController extends AppController
{
	var $name = "Analytics";
	var $uses = array("Analytics");
	var $components = array("obAuth","MySecurity","Arms");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array())) $this->redirect('/');
		parent::beforeFilter();
	}

	function index() {

		$options = array('conditions' => array( 'id ='=>'1' ));
		$analytics = $this->Analytics->find('first' ,$options);
		if($this->Analytics->sqlerror == false) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->MySecurity->settoken();

		$this->set('Analytics', $analytics['Analytics']);
	}

	function editdo() {

		if(!$this->MySecurity->checktoken('Analytics')) {
			$this->MySecurity->settoken();
			return $this->redirect('/analytics');
		}

		// バリデート
		$this->Analytics->setValidation('edit');
		$this->Analytics->create($this->data['Analytics']);

		if(!$this->Analytics->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Analytics->invalidFields());
			$this->render('index');
			return false;
		}

		// データの整理
		$add_data['id'] = 1;
		$add_data['login_id'] = $this->data['Analytics']['login_id'];
		$add_data['login_pass'] = $this->data['Analytics']['login_pass'];
		$add_data['web_property_id'] = $this->data['Analytics']['web_property_id'];
		$add_data['profile_id'] = $this->data['Analytics']['profile_id'];

		$up_list = array('login_id','login_pass','web_property_id','profile_id');
		$this->Analytics->create();
		$this->Analytics->save($add_data,false,$up_list);
		if($this->Analytics->sqlerror == false) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->render('complete');
	}
}
?>
