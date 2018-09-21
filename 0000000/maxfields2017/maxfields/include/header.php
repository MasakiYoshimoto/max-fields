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
<link rel="stylesheet" href="<?php echo ROOT_PATH?>global/css/global.css">
<link rel="stylesheet" href="<?php echo ROOT_PATH?>maxfields2017/maxfields/css/maxfields.css">

<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo ROOT_PATH?>img/favicon.ico">

<script src="<?php echo ROOT_PATH?>global/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.cookie.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.tinyscroller.min.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.colorbox-min.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.zip2addr.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/global.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.switchHat.js"></script>
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
<script src="http://www.evolve-max.com/maxfields2017/globalheader/include.js"></script>

<!-- ヘッダー -->
<div id="siteHeader">
	<div id="siteHeaderInner">
		<div id="siteHeaderTop">
			<h1 id="siteHeaderLogo"><a href="<?php echo ROOT_PATH?>maxfields/"><img src="<?php echo ROOT_PATH?>maxfields/img/header_logo.png" alt="株式会社マックスフィールズ" width="240" height="60"></a></h1>
			<div id="siteHeaderContact">
				<a class="faq" href="<?php echo ROOT_PATH?>maxfields/faq/">よくある質問</a>
				<a class="contact" href="<?php echo ROOT_PATH?>maxfields/contact/">お問い合わせ</a>
			</div>
		</div>
		<div id="siteHeaderNav">
			<ul>
				<li><a href="<?php echo ROOT_PATH?>maxfields/">ホーム</a></li>
				<li><a href="<?php echo ROOT_PATH?>maxfields/info/">インフォメーション</a></li>
			</ul>
		</div>
	</div><!--/#siteHeaderInner-->
</div><!--/#siteHeader-->

<!-- ナビ -->
<div id="siteNav" class="maxfields">
	<ul>
		<li><a href="<?php echo ROOT_PATH?>maxfields/about/">マックスフィールズとは</a></li>
		<li><a href="<?php echo ROOT_PATH?>maxfields/consult/">コンサルティング事業</a></li>
		<li><a href="<?php echo ROOT_PATH?>maxfields/outsource/">アウトソーシング事業</a></li>
		<li><a href="<?php echo ROOT_PATH?>maxfields/careerpro/">職業紹介</a></li>
		<li><a href="<?php echo ROOT_PATH?>maxfields/recruit/">自社リクルート</a></li>
	</ul>
</div><!--/#siteNav-->