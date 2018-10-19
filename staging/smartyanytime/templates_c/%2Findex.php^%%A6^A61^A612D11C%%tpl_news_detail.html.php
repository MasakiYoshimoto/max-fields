<?php /* Smarty version 2.6.27, created on 2015-05-26 11:12:49
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_news_detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cms_detail', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_news_detail.html', 3, false),array('modifier', 'd_format', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_news_detail.html', 75, false),array('modifier', 'replace', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_news_detail.html', 75, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%A6^A61^A612D11C%%tpl_news_detail.html.inc'] = 'b26354d4dec199bc935e89671d87e9fa'; ?><!DOCTYPE html>
<html lang="ja">
<?php if ($this->caching && !$this->_cache_including): echo '{nocache:b26354d4dec199bc935e89671d87e9fa#0}'; endif;echo smartyanytime_plugins_simplecmsEX::cms_detail(array('id' => 3), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:b26354d4dec199bc935e89671d87e9fa#0}'; endif;?>

<?php if ($this->_tpl_vars['data']['CATEGORY'] == 1): ?>
<?php $this->assign('category', 'news'); ?>
<?php $this->assign('category_name', "ニュース"); ?>
<?php elseif ($this->_tpl_vars['data']['CATEGORY'] == 2): ?>
<?php $this->assign('category', 'event'); ?>
<?php $this->assign('category_name', "イベント"); ?>
<?php elseif ($this->_tpl_vars['data']['CATEGORY'] == 3): ?>
<?php $this->assign('category', 'info'); ?>
<?php $this->assign('category_name', "インフォメーション"); ?>
<?php else: ?>
<?php $this->assign('category', ""); ?>
<?php $this->assign('category_name', ""); ?>
<?php endif; ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="あなたのライフスタイルに合わせた短時間求人のマイジョブイズです。お問合せはお気軽に。" />
<meta name="keywords" content="求人,求職,アルバイト,パート,短期,短時間,ライフスタイル,女性,リクルート,採用,スキル,キャリア" />
<title>短期・短時間の求人｜マイジョブイズ My job is｜お知らせ｜<?php echo $this->_tpl_vars['data']['TITLE']; ?>
</title>
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/topscroll.js"></script>
<script type="text/javascript" src="./js/maptip.js"></script>
<link type="text/css" href="./css/style.css" rel="stylesheet" media="all" />
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

   ga('create', 'UA-41326631-2', 'auto');
   ga('send', 'pageview');

</script>
</head>
<body>
<div id="header">
	<div id="headerTop" class="clearfix">
		<div id="headerLeft">
			<p>あなたのライフスタイルにあわせた短時間求人</p>
			<div id="logo"><a href="./index.html"><img src="./img/common_img_logo.gif" alt="MyJobIs" title="MyJobIsホーム" width="234" height="52" /></a></div>
		</div>
	    <div id="globalNav">
	    	<ul>
	        	<li class="gnav01"><a href="./about.html" title="About">About</a></li>
	            <li class="gnav02"><a href="./client.html" title="Client">Client</a></li>
	            <li class="gnav03"><a href="./worker.html" title="Worker">Worker</a></li>
	            <li class="gnav04"><a href="./job.html" title="Job">Job</a></li>
	            <li class="gnav05"><a href="./entry/" title="Entry">Entry</a></li>
	            <li class="gnav06"><a href="./contact/" title="Contact">Contact</a></li>
	        </ul>
	    </div><!-- #globalNav -->
	</div><!-- #headerTop -->
</div><!-- #header（ヘッダーここまで） -->

<div id="eyecatchWrapper">
	<div id="eyecatch">
		<h1><img src="img/news_h1.jpg" alt="News/お知らせ" title="News/お知らせ" width="1000" height="132" /></h1>
		<ol id="topicpath">
			<li>HOME</li>
			<li><a href="./news.html">お知らせ</a></li>
			<li class="end"><a href="./news_detail.html"><?php echo $this->_tpl_vars['data']['TITLE']; ?>
</a></li>
		</ol>
	</div>
</div><!-- #eyecatchWrapper -->


<div id="container" class="clearfix">
	<div id="main"><!-- Start-Page_Content -->
	        <h2><img src="img/news_detail_h2_01.gif" width="160" height="21" alt="お知らせ" /></h2>
	        <h3 class="newstitle">
		        <dl>
		           	<dt><img src="img/common_cat_<?php echo $this->_tpl_vars['category']; ?>
.gif" width="54" height="18" alt="<?php echo $this->_tpl_vars['category_name']; ?>
" /><span class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['RELEASE_DATE'])) ? $this->_run_mod_handler('d_format', true, $_tmp, "Y年m月d日") : smarty_modifier_d_format($_tmp, "Y年m月d日")); ?>
(<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['RELEASE_DATE'])) ? $this->_run_mod_handler('d_format', true, $_tmp, 'w') : smarty_modifier_d_format($_tmp, 'w')))) ? $this->_run_mod_handler('replace', true, $_tmp, '0', '日') : smarty_modifier_replace($_tmp, '0', '日')))) ? $this->_run_mod_handler('replace', true, $_tmp, '1', '月') : smarty_modifier_replace($_tmp, '1', '月')))) ? $this->_run_mod_handler('replace', true, $_tmp, '2', '火') : smarty_modifier_replace($_tmp, '2', '火')))) ? $this->_run_mod_handler('replace', true, $_tmp, '3', '水') : smarty_modifier_replace($_tmp, '3', '水')))) ? $this->_run_mod_handler('replace', true, $_tmp, '4', '木') : smarty_modifier_replace($_tmp, '4', '木')))) ? $this->_run_mod_handler('replace', true, $_tmp, '5', '金') : smarty_modifier_replace($_tmp, '5', '金')))) ? $this->_run_mod_handler('replace', true, $_tmp, '6', '土') : smarty_modifier_replace($_tmp, '6', '土')); ?>
)</span></dt>
		            <dd><?php echo $this->_tpl_vars['data']['TITLE']; ?>
</dd>
	            </dl>
            </h3>
	        <p>
                <?php echo $this->_tpl_vars['data']['HONBUN']; ?>

	        </p>
	</div><!-- #main End-Page_Content -->
	
	<div id="side">
	   	<h2><img src="./img/common_sidebn0.gif" alt="無料" width="304" height="33" /></h2>
	    <div id="sideNav01">
	    	<ul>
	        	<li class="nav01"><a href="./entry/" title="登録申込">登録申込</a></li>
	            <li class="nav02"><a href="./contact/" title="お問合せ">お問合せ</a></li>
	        </ul>
	    </div><!-- #sideNav01 -->
	    <div id="sideNav02">
	    	<ul>
	        	<li class="nav01"><a href="./about.html" title="MyJobIsとは">MyJobIsとは</a></li>
	            <li class="nav02"><a href="./client.html" title="企業の皆様へ">企業の皆様へ</a></li>
	            <li class="nav03"><a href="./worker.html" title="働く皆様へ">働く皆様へ</a></li>
	            <li class="nav04"><a href="./job.html" title="求人一覧">求人一覧</a></li>
	        </ul>
	    </div><!-- #globalNav02 -->
    </div><!-- #side -->
</div><!-- #container -->

<div id="foot_btncontainer">
	<div class="banabox">
		<ul class="clearfix">
			<li><a href="./about.html"><img src="./img/common_footbn1-1.gif" alt="MyJobIsとは" title="MyJobIsとは" width="304" height="103" /></a></li>
			<li><a href="./client.html"><img src="./img/common_footbn1-2.gif" alt="企業のみなさまへ" title="企業のみなさまへ" width="304" height="103" /></a></li>
			<li class="end"><a href="./worker.html" class="end"><img src="./img/common_footbn1-3.gif" alt="働く皆様へ" title="働く皆様へ" width="304" height="103" /></a></li>
		</ul>
	</div>
</div><!-- #foot_btncontainer -->
<div id="pagetop"><a href="#HEADER"><img src="./img/common_btn_top.png" alt="TOP" width="49" height="49" /></a></div>
<div id="footerWrapper">
	<div id="footer" class="cleafix">
		<div class="tool01"><a href="./index.html"><img src="./img/common_img_footlogo.gif" alt="MyJobIs" title="MyJobIsホーム" width="202" height="45" /></a></div>
	    <ul class="tool02 clearfix">
	        <li><a href="./about.html">My Job Isとは</a></li>
	        <li><a href="./client.html">企業の皆様へ</a></li>
	        <li><a href="./worker.html">働く皆様へ</a></li>
	        <li><a href="./job.html">求人一覧</a></li>
	        <li><a href="./entry/">登録申込</a></li>
	        <li><a href="./contact/">お問合せ</a></li>
	        <li class="end"><a href="./sitepolicy.html">サイトポリシー</a></li>
	    </ul>
	</div><!-- #footer -->
</div><!-- #footerWrapper -->
<div id="copyright">Copyright © 2015 My Job is Co,Ltd. All rights Reserved.</div><!-- #Copyright -->
</body>
</html>