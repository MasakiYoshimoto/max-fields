<?php
// testディレクトリ対策
// uriの一番上のディレクトリ名が rapt_test なら、rapt_test を ROOT_PATHにする
function is_top_dir($dir_name){
	$uri = $_SERVER['REQUEST_URI'];
	if ( strpos($uri, 'http') === 0 ) {
		$uri = parse_url($uri);
		$uri = $uri['path'];
	}
	return strpos($uri, '/'.$dir_name.'/') === 0;
}
define('ROOT_PATH', is_top_dir('rapt_test')? '/rapt_test/' : '/');

?><!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<title><?php echo PAGE_TITLE?></title>
<meta name="description" content="<?php echo PAGE_DESCRIPTION?>">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo ROOT_PATH?>staging/global/css/global.css">
<link rel="stylesheet" href="<?php echo ROOT_PATH?>staging/global/css/global_sp.css">
<link rel="stylesheet" href="<?php echo ROOT_PATH?>staging/maxfields/css/maxfields.css">
<link rel="stylesheet" href="<?php echo ROOT_PATH?>staging/maxfields/css/maxfields_sp.css">
<link rel="stylesheet" href="<?php echo ROOT_PATH?>staging/maxfields/css/menu.css">
<link rel="stylesheet" href="<?php echo ROOT_PATH?>staging/maxfields/css/group_content_sp.css">
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo ROOT_PATH?>img/favicon.ico">

<script src="<?php echo ROOT_PATH?>staging/global/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo ROOT_PATH?>staging/global/js/jquery.cookie.js"></script>
<script src="<?php echo ROOT_PATH?>staging/global/js/jquery.tinyscroller.min.js"></script>
<script src="<?php echo ROOT_PATH?>staging/global/js/jquery.colorbox-min.js"></script>
<script src="<?php echo ROOT_PATH?>staging/global/js/jquery.zip2addr.js"></script>
<script src="<?php echo ROOT_PATH?>staging/global/js/global.js"></script>
<script src="<?php echo ROOT_PATH?>staging/global/js/jquery.switchHat.js"></script>
<script>
(function($){
})(jQuery);
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-41326631-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body class="<?php echo BODY_CLASS?>">

<!--ページトップのアンカー-->
<a id="pageTop"></a>

<!--マックスフィールズグループ グローバルヘッダー-->
<script src="http://www.evolve-max.com/staging/globalheader/include.js"></script>

<!-- ヘッダー -->
<div id="siteHeader">
	<div id="siteHeaderInner">
		<div id="siteHeaderTop">
			<h1 id="siteHeaderLogo"><a href="<?php echo ROOT_PATH?>staging/maxfields/"><img src="<?php echo ROOT_PATH?>staging/maxfields/img/header_logo.png" alt="株式会社マックスフィールズ" width="240" height="60"></a></h1>
			<div id="siteHeaderContact">
				<!--<a class="faq" href="<?php echo ROOT_PATH?>staging/maxfields/faq/">よくある質問</a>-->
				<a class="contact" href="<?php echo ROOT_PATH?>staging/maxfields/contact/">お問い合わせ</a>
			</div>
		</div>
		<div id="siteHeaderNav">
			<ul>
				<li><a href="<?php echo ROOT_PATH?>staging/maxfields/">ホーム</a></li>
				<li><a href="<?php echo ROOT_PATH?>staging/maxfields/info/">インフォメーション</a></li>
			</ul>
		</div>

		<header>
		  <div id="nav-drawer">
		      <input id="nav-input" type="checkbox" class="nav-unshown">
		      <label id="nav-open" for="nav-input"><span></span></label>
		      <label class="nav-unshown" id="nav-close" for="nav-input"></label>
		      <div id="nav-content">
						<ul class="nav-ul">
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/">HOME</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/about">マックスフィールズとは</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/about/outline.html">会社概要</a></li>
					 	 <li><a href="<?php echo ROOT_PATH?>staging/maxfields/consult">コンサルティング事業</a></li>
					 	 <li><a href="<?php echo ROOT_PATH?>staging/maxfields/outsource">アウトソーシング事業</a></li>
					 	 <!--<li><a href="<?php echo ROOT_PATH?>staging/maxfields/careerpro">職業紹介・人材派遣業</a></li>-->
					 	 <li><a href="<?php echo ROOT_PATH?>staging/maxfields/recruit">自社リクルート</a></li>
					 	 <li><a href="<?php echo ROOT_PATH?>staging/maxfields/info">インフォメーション</a></li>
					 	 <!--<li><a href="<?php echo ROOT_PATH?>staging/maxfields/faq">よくあるご質問</a></li>-->
					 	 <li><a href="<?php echo ROOT_PATH?>staging/maxfields/contact">お問い合わせ</a></li>
					 	 <li><a href="<?php echo ROOT_PATH?>staging/privacy.html">個人情報保護方針</a></li>
					 	 <li><a href="<?php echo ROOT_PATH?>staging/sitepolicy.html">サイトポリシー</a></li>
  </ul>
	<ul class="nav-ul2">
		<li><a href="<?php echo ROOT_PATH?>staging/maxfields/">▶︎ Maxfields</a></li>
		<li><a href="<?php echo ROOT_PATH?>staging/sophia/">▶︎ Sofia-max</a></li>
		<li><a href="http://www.dd-max.com/">▶︎ D&D max</a></li>
		<li><a href="http://www.jobmax.jp/">▶︎ Job max solutions</a></li>
	</ul>
					</div>
		  </div>
		</header>

	</div><!--/#siteHeaderInner-->
</div><!--/#siteHeader-->


<!-- ナビ -->
<div id="siteNav" class="maxfields">
	<ul>
		<li><a href="<?php echo ROOT_PATH?>staging/maxfields/about/">マックスフィールズとは</a></li>
		<li><a href="<?php echo ROOT_PATH?>staging/maxfields/about/outline.html">会社概要</a></li>
		<li><a href="<?php echo ROOT_PATH?>staging/maxfields/consult/">コンサルティング事業</a></li>
		<li><a href="<?php echo ROOT_PATH?>staging/maxfields/outsource/">アウトソーシング事業</a></li>
		<!--<li><a href="<?php echo ROOT_PATH?>staging/maxfields/careerpro/">職業紹介</a></li>-->
		<li><a href="<?php echo ROOT_PATH?>staging/maxfields/recruit/">自社リクルート</a></li>
	</ul>
</div><!--/#siteNav-->
