<?php
class SitesController extends AppController
{
	var $name = "Sites";
	var $uses = array("Site");
	var $components = array("obAuth","MySecurity","Arms");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array())) $this->redirect('/');
		parent::beforeFilter();
	}

	function index() {

		$options = array('conditions' => array( 'id ='=>'1' ));
		$site = $this->Site->find('first' ,$options);
		if($this->Site->sqlerror == false) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		if( $site['Site']['standby'] == 1 ) $site['Site']['standby'] = 'checked';

		$this->MySecurity->settoken();

		$this->set('Site', $site['Site']);
	}

	function editdo() {

		if(!$this->MySecurity->checktoken('Site')) {
			$this->MySecurity->settoken();
			return $this->redirect('/sites');
		}

		// バリデート
		$this->Site->setValidation('edit');
		$this->Site->create($this->data['Site']);

		if(!$this->Site->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Site->invalidFields());
			$this->render('index');
			return false;
		}

		// データの整理
		$add_data['id'] = 1;
		$add_data['standby'] = $this->data['Site']['standby'];
		$add_data['site_url'] = rtrim($this->data['Site']['site_url'],'/');
		$add_data['site_name'] = $this->data['Site']['site_name'];
		$add_data['title'] = $this->data['Site']['title'];
		$add_data['keywords'] = $this->data['Site']['keywords'];
		$add_data['description'] = $this->data['Site']['description'];
		$add_data['page_404error'] = $this->data['Site']['page_404error'];

		$up_list = array('site_url','site_name','title','keywords','description','page_404error','standby');
		$this->Site->create();
		$this->Site->save($add_data,false,$up_list);
		if($this->Site->sqlerror == false) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->render('complete');
	}
}
?>
