<?php
class SitemapsController extends AppController
{
	var $name = "Sitemaps";
	var $uses = array("Site");
	var $components = array("obAuth","MySecurity","Arms");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array())) $this->redirect('/');
		parent::beforeFilter();
	}

	function index() {

	}

	function lists() {

		if(!get_cfg_var('safe_mode')) set_time_limit(1500); // 最大で25分にしておく

		App::import('Vendor', 'sitemap/urlcollector');

		// サイト情報取得
		$options = array('conditions' => array( 'id ='=>'1' ));
		$site = $this->Site->find('first' ,$options);
		if($this->Site->sqlerror == false) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// サイトクロールしてリンクを抽出
		$c = new UrlCollector();
		$c->echoFlg = false;
		$c->static = true;
		$arr = $c->getUrls(rtrim($site['Site']['site_url'],'/').'/');

		//取得したデータの先頭にトップを追加する
		array_unshift( $arr,rtrim($site['Site']['site_url'],'/').'/');
		$arr = array_unique($arr);// 同じURLがあったら除去
		$arr = array_values (array_filter( $arr , create_function('$val', 'return ($val=="error") ? false : $val;'))); // errorを除去

		// トークン設定
		$this->MySecurity->settoken();

		$this->set('list', $arr);
	}

	function write() {


		// 二重投稿禁止
		if(!$this->MySecurity->checktoken('Sitemap')) {
			$this->MySecurity->settoken();
			return $this->redirect('/sitemaps');
		}

		// サイト情報取得
		$options = array('conditions' => array( 'id ='=>'1' ));
		$site = $this->Site->find('first' ,$options);
		if($this->Site->sqlerror == false) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$site = parse_url($site['Site']['site_url']);
		$path = $_SERVER['DOCUMENT_ROOT'].$site['path'];

//		$this->autoRender = false;
		Configure::write('debug', 0); // debugコードを出さないように

		$xml = $this->_makeXML();
		if(!$xml) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$fp = fopen(rtrim($path,'/').'/sitemap.xml','w');
		if(!$fp) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error2');
			return false;
		}
		if(!fwrite($fp, $xml)) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		if(!fclose($fp)) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

	}

	function download() {

//		$this->autoRender = false;
		Configure::write('debug', 0); // debugコードを出さないように

		header ("Content-disposition: attachment; filename=sitemap.xml");
		header ("Content-type: application/octet-stream; name=sitemap.xml");

		print $this->_makeXML();
	}

	function _makeXML() {

		App::import('Vendor', 'sitemap/sitemapper');

		$data = $this->data['Sitemap']['data'];

		// データチェック
		if( !$data || count($data) == 0 ) return false;
		for($i=0;$i<count();$i++) {
			if( !$data[$i]['link'] || !$data[$i]['changefreq'] || !$data[$i]['priority'] ) return false;
			if( $data[$i]['changefreq'] != 'hourly' || $data[$i]['changefreq'] != 'daily' || $data[$i]['changefreq'] != 'weekly' || $data[$i]['changefreq'] != 'monthly' ) return false;
			if( (string)$data[$i]['priority'] != '1.0' || (string)$data[$i]['priority'] != '0.5' || (string)$data[$i]['priority'] != '0.0' ) return false;
		}

		return SiteMapper::map($data);
	}

}
?>
