<?php
/**
 *  URL Collector
 *  @see       http://0-oo.net/sbox/php-tool-box/url-collector
 *  @version   0.1.0
 *  @copyright 2010 dgbadmin@gmail.com
 *  @license   http://0-oo.net/pryn/MIT_license.txt (The MIT license)
 */
class UrlCollector {
	public $echoFlg;
 
	private $_wsql;
	private $_interval;
	private $_site;
	private $_len;
	private $_domain;
	private $_trim;
	private $_from;
	private $_to;
	private $_arr;

	private $_count;
	public $static;

	/**
	 *    コンストラクタ
	 *    @param    decimal    $interval    （省略可）次のページをクロールするまでの間隔（秒）
	 */
	public function __construct($interval = 1) {
		$this->_count = 0;
		$this->echoFlg = false;
		$this->static = true;
//		$this->_wsql = new htmlsql();
		$this->_interval = $interval * 1000 * 1000;    //マイクロ秒にする
	}
	/**
	 *    URLを蒐集する
	 *    @param    string    $topUrl    トップページのURL（この階層以下が蒐集対象になる）
	 *    @param    string    $titleTrim    （省略可）タイトルから除外する文字列
	 *    @param    string    $encoding    （省略可）サイトの文字コード
	 *    @return    array    URL => ページタイトル
	 */
	public function getUrls($topUrl, $titleTrim = '', $encoding = 'UTF-8') {
		$urlArr = explode('/', $topUrl, -1);
		$siteUrl = implode('/', $urlArr) . '/';
		$siteArr = parse_url($siteUrl);
 
		$this->_site = $siteUrl;
		$this->_len = strlen($siteUrl);
//		$this->_domain = 'http://' . $siteArr['host'];
		$this->_domain = $siteArr['host'];
		$this->_trim = $titleTrim;
		$this->_from = $encoding;
		$this->_to = mb_internal_encoding();
		$this->_arr = array();
 
		$this->_dive($topUrl);    //再帰処理
		sort($this->_arr);
 
		return $this->_arr;
	}
 
	private function _dive($url) {

		if($this->_count >= 100 ) return false; // 100件以上は処理しない
		$this->_count++;

		if ($this->echoFlg) {
			echo "$url\n";
		}

 
//		$wsql = $this->_wsql;
 
		//ページ取得
//		if (!$wsql->connect('url', $url) || $wsql->snoopy->status != 200) {
//			return false;
//		}
//		if ($this->_from != $this->_to) {    //文字コードが違う場合
//			$wsql->page = mb_convert_encoding($wsql->page, $this->_to, $this->_from);
//		}
		$text = @file_get_contents($url);
		if(!$text) {
			return false;
		}
		if(!preg_match_all("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?[^>]*>(.*?)<\/a>/ims",$text,$matchs)) return true;

		// 引数付きのページの処理
		if($this->static && strpos($url,'?')!==false) $url = substr($url,0,strpos($url,'?'));
		if($this->static && strpos($url,'#')!==false) $url = substr($url,0,strpos($url,'#'));

//		//タイトルを取り出す
//		if (!$wsql->query('SELECT text FROM title')){
//			return false;
//		}
//		$titles = $wsql->fetch_array();
//		$title = $titles[0]['text'];
//		if ($this->_trim) {
//			$title = mb_ereg_replace($this->_trim, '', $title);
//		}
//		$this->_arr[$url] = $title;
 
		//リンクを全て取り出す
//		if (!$wsql->query('SELECT href FROM a')){
//			return false;
//		}

		foreach($matchs[1] as $row){
//			$nextUrl = $this->_href2url($url, $row['href']);
			$nextUrl = $this->_href2url($url, $row);

			if ($nextUrl && !array_key_exists(preg_replace('@https?://@','',$nextUrl), $this->_arr)) {
			$this->_arr[preg_replace('@https?://@','',$nextUrl)] = $nextUrl;
//echo $nextUrl."<br/>\n";
//print_r($this->_arr);
//if($this->test==5) exit();
				usleep($this->_interval);    //ちょっと待つ
 
				if (!$this->_dive($nextUrl)) {
					$delUrl = ($this->static && strpos($nextUrl,'?')!==false)?(substr($nextUrl,0,strpos($nextUrl,'?'))):($nextUrl);
					$delUrl = preg_replace('@https?://@','',$delUrl);
					if($this->_arr[$delUrl]) {
						$this->_arr[$delUrl] = 'error';
					}
				}
			}
		}
 
		return true;
	}
 
	private function _href2url($baseUrl, $href) {
		if (strpos($href, '#') !== false) {    //ページ内リンクは無視
			return false;
		}

//if($this->static) {
//	echo 1;
//}
//else {
//	echo 2;
//}
//echo $href."<br/>";

		// 引数付きは動的なので処理しない
		if($this->static && strpos($href,'?')!==false) return false;
//echo $href."<br/>";
		$href = htmlspecialchars_decode($href, ENT_QUOTES);

		// プロトコルを取得
		preg_match('@(^https?://).*$@',$baseUrl,$matches);
		$protocol = $matches[1];

		// html html php cgi 以外は処理しない
		if(strpos($href,'?')!==false) {
			$check_url = substr($href,0,strpos($href,'?'));
		}
		if(strpos($href,'#')!==false) {
			$check_url = substr($href,0,strpos($href,'#'));
		}
		else {
			$check_url = $href;
		}
		if( preg_match('@/$@',$check_url)==0 && preg_match('@\.html$@',$check_url)==0 && preg_match('@\.htm$@',$check_url)==0 && preg_match('@\.php$@',$check_url)==0 && preg_match('@\.cgi$@',$check_url)==0  ) return false;

		switch (substr($href, 0, 1)) {    //先頭の1文字で判断
			case '?':    //同一ページへのクエリー付きURLの場合
				$baseArr = explode('?', $baseUrl);
				return $baseArr[0] . $href;
			case '/':    //ドメイン内の絶対パスの場合
				$url = $protocol.$this->_domain . $href;
				break;
			default;
				if (strpos($href, ':')) {    //スキーム指定有りの場合
					$url = preg_replace('/:80/', '', $href);    //ポート番号を削除
				} else {    //相対パスの場合
					$url = $this->_getAbsoluteUrl($baseUrl, $href);    //絶対パス化
				}
		}

		$a_url = parse_url($url);
		$a_site = parse_url($this->_site);
//		if (substr($url, 0, $this->_len) != $this->_site) {
//			return false;    //他サイトやhttpsのリンクは追わない
//		}
		if ($a_url['host']!=$a_site['host']) {
			return false;    //他サイトは追わない
		}

 
		return $url;
	}
 
	private function _getAbsoluteUrl($baseUrl, $href) {
		$baseArr = explode('/', $baseUrl);
		array_pop($baseArr);    //現在のページを削除
		$hrefArr = explode('/', $href);
		if ($hrefArr[0] == '.') {
			array_shift($hrefArr);
		}
		foreach ($hrefArr as $dir) {
			if ($dir != '..') {
				break;
			}
			array_pop($baseArr);
			array_shift($hrefArr);
		}
		$concatArr = array_merge($baseArr, $hrefArr);
		return implode('/', $concatArr);
	}
}

?>