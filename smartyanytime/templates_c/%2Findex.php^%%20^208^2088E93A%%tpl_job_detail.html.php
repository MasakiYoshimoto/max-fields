<?php /* Smarty version 2.6.27, created on 2015-05-26 11:27:08
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job_detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'job_detail', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job_detail.html', 3, false),array('modifier', 'nl2br', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job_detail.html', 88, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%20^208^2088E93A%%tpl_job_detail.html.inc'] = '257126c85c426a0decea98b33fb225d8'; ?><!DOCTYPE html>
<html lang="ja">
<?php if ($this->caching && !$this->_cache_including): echo '{nocache:257126c85c426a0decea98b33fb225d8#0}'; endif;echo smartyanytime_plugins_job::job_detail(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:257126c85c426a0decea98b33fb225d8#0}'; endif;?>

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
		<h1><img src="img/job_h1.jpg" alt="Job/求人詳細" title="Job/求人詳細" width="1000" height="132" /></h1>
		<ol id="topicpath">
			<li>HOME</li>
			<li><a href="./job.html">求人一覧</a></li>
			<li class="end"><a href="./job_detail.html?d=<?php echo $this->_tpl_vars['data']['id']; ?>
"><?php echo $this->_tpl_vars['data']['catchcopy']; ?>
</a></li>
		</ol>
	</div>
</div><!-- #eyecatchWrapper -->


<div id="container" class="clearfix">
	<div id="main" class="tableRow"><div class="spcellwrap"><!-- Start-Page_Content -->
            <?php if ($this->_tpl_vars['data']['location'] == 100): ?>
                <?php $this->assign('area_no', '1'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 101): ?>
                <?php $this->assign('area_no', '2'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 102): ?>
                <?php $this->assign('area_no', '3'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 103): ?>
                <?php $this->assign('area_no', '4'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 104): ?>
                <?php $this->assign('area_no', '5'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 105): ?>
                <?php $this->assign('area_no', '6'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 106): ?>
                <?php $this->assign('area_no', '7'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 107): ?>
                <?php $this->assign('area_no', '8'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 108): ?>
                <?php $this->assign('area_no', '9'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 109): ?>
                <?php $this->assign('area_no', '10'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 110): ?>
                <?php $this->assign('area_no', '11'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 111): ?>
                <?php $this->assign('area_no', '12'); ?>
            <?php elseif ($this->_tpl_vars['data']['location'] == 112): ?>
                <?php $this->assign('area_no', '13'); ?>
            <?php endif; ?>
	        <h2><img src="img/job_detail_h2_02.gif" width="149" height="21" alt="求人詳細" /></h2>
		    <div id="job_detail" class="clearfix">
			    <h3 class="clearfix"><?php echo $this->_tpl_vars['data']['catchcopy']; ?>
<img class="area" src="img/job_area<?php echo $this->_tpl_vars['area_no']; ?>
.gif" width="140" height="20" alt="<?php echo $this->_tpl_vars['data']['location_string']; ?>
"></h3>
		        <p>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['work'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

                </p>
			    <dl class="mainlist">
                    <?php if ($this->_tpl_vars['data']['location']): ?>
                    <dt>予定勤務地</dt>
                    <dd><?php echo $this->_tpl_vars['data']['location_string']; ?>
</dd>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['data']['wages_type']): ?>
                    <dt>賃金形態</dt>
                    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['wages_type'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['data']['work_type']): ?>
                    <dt>就業形態</dt>
                    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['work_type'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['data']['holiday']): ?>
                    <dt>休日</dt>
                    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['holiday'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['data']['require_ability']): ?>
                    <dt>必要な経験能力</dt>
                    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['require_ability'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['data']['educational_background']): ?>
                    <dt>学歴資格</dt>
                    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['educational_background'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['data']['project_contents']): ?>
                    <dt>事業内容</dt>
                    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['project_contents'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['data']['treatment']): ?>
                    <dt>待遇</dt>
                    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['treatment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['data']['selection']): ?>
                    <dt>選考内容</dt>
                    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['selection'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['data']['etc']): ?>
                    <dt>備考</dt>
                    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['etc'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
                    <?php endif; ?>
				</dl>
			<a class="entrybtn" href="./entry/?d=<?php echo $this->_tpl_vars['data']['id']; ?>
" ><img class="allow" src="img/common_arrow_whi.png" width="11" height="11" alt="この案件に応募・登録申込みする">この案件に応募・登録申込みする</a>
			</div>

	</div></div><!-- #main End-Page_Content -->
	
	<div id="side" class="tableTop">
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
    </div><!-- #side -->
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