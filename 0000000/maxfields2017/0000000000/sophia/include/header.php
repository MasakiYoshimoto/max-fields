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
<link rel="stylesheet" href="<?php echo ROOT_PATH?>sophia/css/gmi.css">

<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo ROOT_PATH?>img/favicon.ico">

<script src="<?php echo ROOT_PATH?>global/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.cookie.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.tinyscroller.min.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.colorbox-min.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.zip2addr.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/global.js"></script>
<script>
(function($){

	// 高さを揃える
	$.fn.sameHeight = function(){
		var heights = [];
		return this.each(function(){
			heights.push( $(this).height() );
		}).css("minHeight", Math.max.apply(null, heights) + "px");
	};
	$(function(){
		$("#boxNav").children().sameHeight();
	});

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
<script src="http://www.evolve-max.com/globalheader/include.js"></script>

<!-- ヘッダー -->
<div id="siteHeader">
	<div id="siteHeaderInner">
		<div id="siteHeaderTop">
			<h1 id="siteHeaderLogo"><a href="<?php echo ROOT_PATH?>sophia/"><img src="<?php echo ROOT_PATH?>sophia/img/header_logo.png" alt="株式会社ソフィアマックス" height="55"></a></h1>
			<div id="siteHeaderContact">
				<a class="contact" href="<?php echo ROOT_PATH?>sophia/contact/">お問い合わせ</a>
			</div>
		</div>
		<div id="siteHeaderNav">
			<ul>
				<li><a href="<?php echo ROOT_PATH?>sophia/">ホーム</a></li>
				<li><a href="<?php echo ROOT_PATH?>sophia/info/">インフォメーション</a></li>
			</ul>
		</div>
	</div><!--/#siteHeaderInner-->
</div><!--/#siteHeader-->

<!-- ナビ -->
<div id="siteNav" class="gmi02">
	<ul>
		<li><a href="<?php echo ROOT_PATH?>sophia/about/">ソフィアマックスとは</a></li>
		<li><a href="<?php echo ROOT_PATH?>sophia/about/#anchor-outline">会社概要</a></li>
		<li><a href="<?php echo ROOT_PATH?>sophia/employer/">企業ご担当者の皆様</a></li>
		<li><a href="<?php echo ROOT_PATH?>sophia/employee/">働く皆様</a></li>
		<li><a href="<?php echo ROOT_PATH?>sophia/employee/2.html">保険制度・基礎研修・フォロー制度</a></li>
		<li><a href="<?php echo ROOT_PATH?>sophia/jinzai/">人材派遣事業</a></li>
	</ul>
</div><!--/#siteNav-->