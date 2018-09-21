<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="INDEX,FOLLOW">
	<meta name="viewport" content="width=1250">
	<!-- <meta name="viewport" content="width=device-width,initial-scale=1.0"> -->
	<meta name="format-detection" content="telephone=no">
	<?php global $aioseop_options;//All In One SEO Packのホーム設定取得 ?>
	<?php if(!get_post_meta($post->ID,_aioseop_description,true))://ページディスクリプションがない場合はホームディスクリプション出力 ?>
		<meta name="description" itemprop="description" content="<?php echo $aioseop_options['aiosp_home_description']; ?>">
	<?php endif; ?>
	<?php if(!get_post_meta($post->ID,_aioseop_keywords,true))://ページキーワードがない場合はホームキーワード出力 ?>
		<meta name="keywords" itemprop="keywords" content="<?php echo $aioseop_options['aiosp_home_keywords']; ?>">
	<?php endif; ?>
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
	<link rel="index contents" href="/" title="ホーム">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo T_URL; ?>style.css?v=<?php echo filemtime(T_PATH . 'style.css'); ?>" />
	<link rel="shortcut icon" href="<?php echo T_URL; ?>img/favicon.ico">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo T_URL; ?>img/apple-touch-icon.png">
	<?php wp_head(); ?>
	<meta name="theme-color" content="#4f9107">
</head>

<body>
	<header id="header" class="l-header">
		<div class="top-txt">
			<div class="wrap in">
				<p class="noto l-txt">人材不足を解決。シニア人材派遣サービス「スマートエイジ」</p>
			</div>
		</div>
		<div class="btm-txt">
			<div class="wrap in">
				<a class="title" href="<?php echo H_URL; ?>">
					<h1 class="">
						<img class="" src="<?php echo T_URL; ?>img/header_logo.png" width="145" height="38" alt="Smart Age">
					</h1>
				</a>
				<nav class="l-btn-nav">
					<ul class="menu">
						<li>
							<a href="<?php echo H_URL; ?>entry">
								<p>求職者のご登録</p>
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo H_URL; ?>contact">
								<img class="" src="<?php echo T_URL; ?>img/header_icon_02.png" width="20" height="14" alt="">
								<p>法人のご担当者様　お問い合わせ</p>
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	
	<header class="l-header dummy">
		<div class="top-txt">
			<div class="wrap in">
				<p class="noto l-txt">新しい人材派遣サービス  スマートエイジ</p>
				<div class="r-txt">
					<a href="#">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
						新着情報
					</a>
					<a href="<?php echo H_URL; ?>company">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
						会社概要
					</a>
				</div>
			</div>
		</div>
		<div class="btm-txt">
			<div class="wrap in">
				<a class="title" href="<?php echo H_URL; ?>">
					<h1 class="">
						<img class="" src="<?php echo T_URL; ?>img/header_logo.png" width="145" height="38" alt="Smart Age">
					</h1>
				</a>
				<nav class="l-btn-nav">
					<ul class="menu">
						<li>
							<a href="<?php echo H_URL; ?>contact">
								<img class="" src="<?php echo T_URL; ?>img/header_icon_01.png" width="21" height="17" alt="">
								<p>質問を行う</p>
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo H_URL; ?>contact">
								<img class="" src="<?php echo T_URL; ?>img/header_icon_02.png" width="20" height="14" alt="">
								<p>法人のご担当者様　お問い合わせ</p>
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<!-- /.l-header.dummy -->
	
<?php include(A_PATH . 'part-site-menu.php');//サイトメニュー ?>
