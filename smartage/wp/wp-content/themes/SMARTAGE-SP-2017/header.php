<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="INDEX,FOLLOW">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
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
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo T_URL; ?>style.css?v=<?php echo filemtime(get_template_directory().'/style.css'); ?>" />
	<link rel="shortcut icon" href="<?php echo T_URL; ?>img/favicon.ico">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo T_URL; ?>img/apple-touch-icon.png">
	<?php wp_head(); ?>
	<meta name="theme-color" content="#4f9107">
</head>

<body>
	<header id="header" class="l-header">
		<div class="top-txt pad">
			<p class="noto in">人材不足を解決。シニア人材派遣サービス「スマートエイジ」</p>
		</div>
		<div class="pad in">
			<a class="title" href="<?php echo H_URL; ?>">
				<h1 class="logo">
					<img class="" src="<?php echo T_URL; ?>img/header_logo.png" width="55%" alt="Smart Age">
				</h1>
			</a>
			<div class="btn">
				<div id="spmenu-open" class="l-animebtn">
					<div class="bar">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
		</div>
		<div id="spmenu" class="ac-body sp-hide l-nav">
			<?php include(A_PATH . 'part-site-menu.php');//サイトメニュー ?>
			<nav class="l-btn-nav sp-wrap">
				<ul class="menu in">
					<li>
						<a href="<?php echo H_URL; ?>entry">
							<div class="l-txt">
								<img class="vis-hidden" src="<?php echo T_URL; ?>img/header_icon_01.png" width="16%" alt="">
								<p>求職者のご登録</p>
							</div>
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="<?php echo H_URL; ?>contact">
							<div class="l-txt">
								<img class="" src="<?php echo T_URL; ?>img/header_icon_02.png" width="13%" alt="">
								<p>法人のご担当者様<br>お問い合わせ </p>
							</div>
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>
	<div id="spmenu-over" class="overlay"></div>
	<header class="l-header dummy">
		<div class="top-txt pad">
			<p class="noto in">新しい人材派遣サービス  スマートエイジ</p>
		</div>
		<div class="pad in">
			<a class="title" href="<?php echo H_URL; ?>">
				<h1 class="logo">
					<img class="" src="<?php echo T_URL; ?>img/header_logo.png" width="55%" alt="Smart Age">
				</h1>
			</a>
			<div class="btn">
				<div id="spmenu-open" class="l-animebtn">
					<div class="bar">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
		</div>
	</header>
