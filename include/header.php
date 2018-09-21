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
<link rel="stylesheet" href="<?php echo ROOT_PATH?>maxfields/css/maxfields.css">
<link rel="stylesheet" href="<?php echo ROOT_PATH?>maxfields/css/group_content.css">
<script src="<?php echo ROOT_PATH?>global/js/jquery-1.9.1.min.js"></script>

<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="/img/favicon.ico">

<script src="<?php echo ROOT_PATH?>global/js/jquery.cookie.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.tinyscroller.min.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.colorbox-min.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/jquery.zip2addr.js"></script>
<script src="<?php echo ROOT_PATH?>global/js/global.js"></script>
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
<script src="/globalheader/include.js"></script>


