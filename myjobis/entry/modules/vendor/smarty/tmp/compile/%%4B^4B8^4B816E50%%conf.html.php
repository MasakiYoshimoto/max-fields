<?php /* Smarty version 2.6.27, created on 2015-05-26 11:03:39
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/myjobis/entry/modules/tpl/conf.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', '/var/www/vhosts/evolve-max.com/httpdocs/myjobis/entry/modules/tpl/conf.html', 83, false),)), $this); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="あなたのライフスタイルに合わせた短時間求人のマイジョブイズです。お問合せはお気軽に。" />
<meta name="keywords" content="求人,求職,アルバイト,パート,短期,短時間,ライフスタイル,女性,リクルート,採用,スキル,キャリア" />
<title>短期・短時間の求人｜マイジョブイズ My job is｜登録申込み</title>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/agent2.js"></script>
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
			<div id="logo"><a href="../index.html"><img src="../img/common_img_logo.gif" alt="MyJobIs" title="MyJobIsホーム" width="234" height="52" /></a></div>
		</div>
	    <div id="globalNav">
	    	<ul>
	        	<li class="gnav01"><a href="../about.html" title="About">About</a></li>
	            <li class="gnav02"><a href="../client.html" title="Client">Client</a></li>
	            <li class="gnav03"><a href="../worker.html" title="Worker">Worker</a></li>
	            <li class="gnav04"><a href="../job.html" title="Job">Job</a></li>
	            <li class="gnav05"><a href="../entry/" title="Entry">Entry</a></li>
	            <li class="gnav06"><a href="../contact/" title="Contact">Contact</a></li>
	        </ul>
	    </div><!-- #globalNav -->
	</div><!-- #headerTop -->
</div><!-- #header（ヘッダーここまで） -->

<div id="eyecatchWrapper">
	<div id="eyecatch">
		<h1 class="entry"><img src="../img/entry_h1.jpg" alt="Entry/登録申込" title="Entry/登録申込" width="1000" height="132" /></h1>
		<ol id="topicpath">
			<li>HOME</li>
			<li class="end"><a href="../entry/">登録申込</a></li>
		</ol>
	</div>
</div><!-- #eyecatchWrapper -->


<div id="container" class="clearfix">
	<div id="main" class="tableRow"><div class="spcellwrap"><!-- Start-Page_Content -->
	    <h2><img src="../img/entry_h2_01.gif" width="248" height="21" alt="登録申込フォーム" /></h2>
			<input type="hidden" name="act" value="">
			<p>下記内容でよろしければ「送信する」を、修正や変更がある場合は「前のページへ戻る」をクリックしてください。</p>
			<dl id="entryform" class="mainlist">
				<dt scope="row">氏名（漢字）</dt>
				<dd><?php echo $this->_tpl_vars['conf']['name']; ?>
&nbsp;</dd>
				<dt scope="row">氏名（フリガナ）</dt>
				<dd><?php echo $this->_tpl_vars['conf']['kana']; ?>
&nbsp;</dd>
				<dt scope="row">生年月日（西暦）</dt>
				<dd><?php echo $this->_tpl_vars['conf']['birthday']; ?>
&nbsp;</dd>
				<dt scope="row">性別</dt>
				<dd><?php echo $this->_tpl_vars['conf']['sex']; ?>
&nbsp;</dd>
				<dt scope="row">メールアドレス</dt>
				<dd><?php echo $this->_tpl_vars['conf']['email']; ?>
&nbsp;</dd>
				<dt scope="row">電話番号</dt>
				<dd><?php echo $this->_tpl_vars['conf']['tel']; ?>
&nbsp;</dd>
				<dt scope="row">ご住所</dt>
				<dd>【郵便番号】　<?php echo $this->_tpl_vars['conf']['zip']; ?>
&nbsp;<br />
					【都道府県】　<?php echo $this->_tpl_vars['conf']['pref']; ?>
&nbsp;<br />
					【市区郡以降】　<?php echo $this->_tpl_vars['conf']['address']; ?>
&nbsp;
				</dd>
				<dt scope="row">最終学歴</dt>
	            <dd><?php echo $this->_tpl_vars['conf']['latest_academic_background']; ?>
&nbsp;</dd>
	            <dt scope="row">英語</dt>
	            <dd>【会話レベル】　<?php echo $this->_tpl_vars['conf']['english_conversation']; ?>
<br />
	            	【実務経験】　<?php echo $this->_tpl_vars['conf']['english_experience']; ?>

	            </dd>
	            <dt scope="row">英語以外の言語</dt>
	            <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['conf']['language_etc'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
	            <dt scope="row">普通自動車免許</dt>
	            <dd><?php echo $this->_tpl_vars['conf']['drivers_license']; ?>
&nbsp;</dd>
	            <dt scope="row">その他資格</dt>
	            <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['conf']['license'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>

		        <dt scope="row">経験職種</dt>
		        <dd><?php echo $this->_tpl_vars['conf']['experience_job']; ?>
&nbsp;
    	        </dd>
    	        
    	        <dt scope="row">その他特記事項</dt>
    	        <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['conf']['etc_experience'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</dd>
			</dl>
			<div class="btnwrap">
                <form action="./" method="post" name="form1" id="form4">
                    <input type="hidden" name="m" value="4" />
                    <input type="hidden" name="_token" value="<?php echo $this->_tpl_vars['_token']; ?>
" />
				    <input type="image" src="../img/share_contact_entry_sendbtn.gif" alt="送信する" title="送信する" width="200" height="44" />
                </form>
                <form action="./" method="post" name="form1" id="form3">
                    <input type="hidden" name="m" value="3" />
                    <?php if ($this->_tpl_vars['job_data']): ?>
                    <input type="hidden" name="d" value="<?php echo $this->_tpl_vars['job_data']['id']; ?>
" />
                    <?php endif; ?>
				    <input type="image" src="../img/share_contact_entry_backbtn.gif" alt="前のページへ戻る" title="前のページへ戻る" width="200" height="44" />
                </form>
			</div>
	</div></div><!-- #main End-Page_Content -->
	
	<div id="side" class="pc"><div class="spcellwrap">
	   	<h2><img src="../img/common_sidebn0.gif" alt="無料" width="304" height="33" /></h2>
	    <div id="sideNav01">
	    	<ul>
	        	<li class="nav01"><a href="../entry/" title="登録申込">登録申込</a></li>
	            <li class="nav02"><a href="../contact/" title="お問合せ">お問合せ</a></li>
	        </ul>
	    </div><!-- #sideNav01 -->
	    <div id="sideNav02">
	    	<ul>
	        	<li class="nav01"><a href="../about.html" title="MyJobIsとは">MyJobIsとは</a></li>
	            <li class="nav02"><a href="../client.html" title="企業の皆様へ">企業の皆様へ</a></li>
	            <li class="nav03"><a href="../worker.html" title="働く皆様へ">働く皆様へ</a></li>
	            <li class="nav04"><a href="../job.html" title="求人一覧">求人一覧</a></li>
	        </ul>
	    </div><!-- #globalNav02 -->
    </div></div><!-- #side -->
</div><!-- #container -->

<div id="foot_btncontainer" class="spcellwrap">
	<div class="banabox pc">
		<ul class="clearfix">
			<li><a href="../about.html"><img src="../img/common_footbn1-1.gif" alt="MyJobIsとは" title="MyJobIsとは" width="304" height="103" /></a></li>
			<li><a href="../client.html"><img src="../img/common_footbn1-2.gif" alt="企業のみなさまへ" title="企業のみなさまへ" width="304" height="103" /></a></li>
			<li class="end"><a href="../worker.html" class="end"><img src="../img/common_footbn1-3.gif" alt="働く皆様へ" title="働く皆様へ" width="304" height="103"  /></a></li>
		</ul>
	</div>
    <div class="sp">
    	<ul>
            <li class="nav01"><a href="../entry/" title="登録申込"><img src="../img/sp_common_sidebn1.gif" alt="登録申込" title="登録申込" width="297" height="67"  /></a></li>
            <li class="nav02"><a href="../contact/" title="お問合せ"><img src="../img/sp_common_sidebn2.gif" alt="お問合せ" title="お問合せ" width="297" height="67"  /></a></li>
        </ul>
    </div><!-- .sp -->
</div><!-- #foot_btncontainer -->

<div id="pagetop"><a href="#HEADER"><img src="../img/common_btn_top.png" alt="TOP" width="49" height="49" /></a></div>
<div id="footerWrapper">
	<div id="footer" class="cleafix">
		<div class="tool01 tableRow"><div class="spcellwrap"><a href="../"><img src="../img/common_img_footlogo.gif" alt="MyJobIs" title="MyJobIsホーム" width="202" height="45" /></a></div></div>
	    <div class="tableTop"><ul class="tool02 clearfix">
	        <li><a href="../about.html">My Job Isとは</a></li>
	        <li><a href="../client.html">企業の皆様へ</a></li>
	        <li><a href="../worker.html">働く皆様へ</a></li>
	        <li><a href="../job.html">求人一覧</a></li>
	        <li><a href="../entry/">登録申込</a></li>
	        <li><a href="../contact/">お問合せ</a></li>
	        <li class="end"><a href="../sitepolicy.html">サイトポリシー</a></li>
	    </ul></div>
	</div><!-- #footer -->
</div><!-- #footerWrapper -->
<div id="copyright">Copyright © 2015 My Job is Co,Ltd. All rights Reserved.</div><!-- #Copyright -->
</body>
</html>