<?php /* Smarty version 2.6.27, created on 2015-05-26 11:15:11
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'new_job_list', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job.html', 54, false),array('modifier', 'strip', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job.html', 94, false),array('modifier', 'mb_truncate', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job.html', 94, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%5C^5C4^5C4C7E0E%%tpl_job.html.inc'] = '82fb8993f706e70b1fe6cf3759732d4d'; ?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="あなたのライフスタイルに合わせた短時間求人のマイジョブイズです。お問合せはお気軽に。" />
<meta name="keywords" content="求人,求職,アルバイト,パート,短期,短時間,ライフスタイル,女性,リクルート,採用,スキル,キャリア" />
<title>短期・短時間の求人｜マイジョブイズ My job is｜求人一覧</title>
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/agent.js"></script>
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
		<h1><img src="img/job_h1.jpg" alt="Job/求人一覧" title="Job/求人一覧" width="1000" height="132" /></h1>
		<ol id="topicpath">
			<li>HOME</li>
			<li class="end"><a href="./job.html">求人一覧</a></li>
		</ol>
	</div>
</div><!-- #eyecatchWrapper -->


<div id="container" class="clearfix">
    <?php if ($this->caching && !$this->_cache_including): echo '{nocache:82fb8993f706e70b1fe6cf3759732d4d#0}'; endif;echo smartyanytime_plugins_job::new_job_list(array('max' => 6), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:82fb8993f706e70b1fe6cf3759732d4d#0}'; endif;?>

	<div id="main" class="tableRow"><div class="spcellwrap"><!-- Start-Page_Content -->
        <h2><img src="img/job_h2_01.gif" width="180" height="21" alt="新着求人一覧" /></h2>
        <?php if ($this->_tpl_vars['job']['count'] != 0): ?>
        <div class="pagenation clearfix">
	        <div class="left"><p>最新<?php echo $this->_tpl_vars['job']['count']; ?>
件を表示</p></div>
	    </div><!-- .pagenation -->

        <div id="job_result">
            <?php $_from = $this->_tpl_vars['job']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['job_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['job_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['job_list']['iteration']++;
?>
        	<div class="box">
                <?php if ($this->_tpl_vars['value']['location'] == 100): ?>
                <?php $this->assign('area_no', '1'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 101): ?>
                <?php $this->assign('area_no', '2'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 102): ?>
                <?php $this->assign('area_no', '3'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 103): ?>
                <?php $this->assign('area_no', '4'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 104): ?>
                <?php $this->assign('area_no', '5'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 105): ?>
                <?php $this->assign('area_no', '6'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 106): ?>
                <?php $this->assign('area_no', '7'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 107): ?>
                <?php $this->assign('area_no', '8'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 108): ?>
                <?php $this->assign('area_no', '9'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 109): ?>
                <?php $this->assign('area_no', '10'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 110): ?>
                <?php $this->assign('area_no', '11'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 111): ?>
                <?php $this->assign('area_no', '12'); ?>
                <?php elseif ($this->_tpl_vars['value']['location'] == 112): ?>
                <?php $this->assign('area_no', '13'); ?>
                <?php endif; ?>
        		<img class="area" src="img/job_area<?php echo $this->_tpl_vars['area_no']; ?>
.gif" width="" height="20" alt="<?php echo $this->_tpl_vars['area_list'][$this->_tpl_vars['value']['location']]; ?>
" />
        		<h4><?php echo $this->_tpl_vars['value']['catchcopy']; ?>
</h4>
        		<p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['work'])) ? $this->_run_mod_handler('strip', true, $_tmp, '') : smarty_modifier_strip($_tmp, '')))) ? $this->_run_mod_handler('mb_truncate', true, $_tmp, 70) : smarty_modifier_mb_truncate($_tmp, 70)); ?>
</p>
        		<a href="./job_detail.html?d=<?php echo $this->_tpl_vars['value']['id']; ?>
" class="btn" title="詳しく見る"><img class="allow" src="img/common_arrow_whi.png" width="11" height="11" alt="詳しく見る" />詳しく見る</a>
        	</div>
            <?php endforeach; endif; unset($_from); ?>
        </div>
        <?php else: ?>
        <div id="job_result">
            求人案件がありません
        </div>
        <?php endif; ?>
	</div></div><!-- #main End-Page_Content -->
	
	<div id="side" class="tableTop"><div class="spcellwrap">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['wwwroot_path'])."/myjobis/include/search_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="pc">
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
		</div>
    </div></div><!-- #side -->
</div><!-- #container -->

<div id="foot_btncontainer" class="spcellwrap">
	<div class="banabox pc">
		<ul class="clearfix">
			<li><a href="./about.html"><img src="./img/common_footbn1-1.gif" alt="MyJobIsとは" title="MyJobIsとは" width="304" height="103" /></a></li>
			<li><a href="./client.html"><img src="./img/common_footbn1-2.gif" alt="企業のみなさまへ" title="企業のみなさまへ" width="304" height="103" /></a></li>
			<li class="end"><a href="./worker.html" class="end"><img src="./img/common_footbn1-3.gif" alt="働く皆様へ" title="働く皆様へ" width="304" height="103"  /></a></li>
		</ul>
	</div>
    <div class="sp">
    	<ul>
            <li class="nav01"><a href="./entry/" title="登録申込"><img src="./img/sp_common_sidebn1.gif" alt="登録申込" title="登録申込" width="297" height="67"  /></a></li>
            <li class="nav02"><a href="./contact/" title="お問合せ"><img src="./img/sp_common_sidebn2.gif" alt="お問合せ" title="お問合せ" width="297" height="67"  /></a></li>
        </ul>
    </div><!-- .sp -->
</div><!-- #foot_btncontainer -->

<div id="pagetop"><a href="#HEADER"><img src="./img/common_btn_top.png" alt="TOP" width="49" height="49" /></a></div>
<div id="footerWrapper">
	<div id="footer" class="cleafix">
		<div class="tool01 tableRow"><div class="spcellwrap"><a href="./index.html"><img src="./img/common_img_footlogo.gif" alt="MyJobIs" title="MyJobIsホーム" width="202" height="45" /></a></div></div>
	    <div class="tableTop"><ul class="tool02 clearfix">
	        <li><a href="./about.html">My Job Isとは</a></li>
	        <li><a href="./client.html">企業の皆様へ</a></li>
	        <li><a href="./worker.html">働く皆様へ</a></li>
	        <li><a href="./job.html">求人一覧</a></li>
	        <li><a href="./entry/">登録申込</a></li>
	        <li><a href="./contact/">お問合せ</a></li>
	        <li class="end"><a href="./sitepolicy.html">サイトポリシー</a></li>
	    </ul></div>
	</div><!-- #footer -->
</div><!-- #footerWrapper -->
<div id="copyright">Copyright © 2015 My Job is Co,Ltd. All rights Reserved.</div><!-- #Copyright -->
</body>
</html>