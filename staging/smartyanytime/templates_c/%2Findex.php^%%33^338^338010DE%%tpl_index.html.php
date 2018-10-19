<?php /* Smarty version 2.6.27, created on 2016-05-27 10:17:36
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/gmi3/tpl_index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cms_setlist', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi3/tpl_index.html', 56, false),array('modifier', 'd_format', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi3/tpl_index.html', 61, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%33^338^338010DE%%tpl_index.html.inc'] = '54120f2468290ad808f4c4b1488acbc1'; ?><?php 
define('PAGE_TITLE', '株式会社グローバルマックスインブルーメンツ');
define('PAGE_DESCRIPTION', '神奈川・都内の派遣アウトソーシングはグローバルマックス。人財の違いで御社のビジネスをサポートいたします。');
define('BODY_CLASS', 'home');

include('./gmi3/include/header.php'); ?>

<!-- コンテント -->
<div id="contentWrap">

	<div id="homeVisual">
		<img src="img/home_visual.jpg" alt="企業を元気にすることで雇用を増やし、人々の笑顔と幸せの輪を広げる" width="930" height="360">
	</div>

	<div id="boxNav">
		<dl>
			<dt><a href="about/"><img src="img/nav_about.gif" alt="GMIとは？" width="160" height="120"></a></dt>
			<dd class="catch">私達のミッション：<br>「企業経営者」と「働く人」のサポート</dd>
			<dd class="description">私たちは、「企業経営者」と「働く人」のサポートをすることをミッションとしています。企業で働く人が元気になれば、この国は元気になる。インプルーブメンツに込められた「改善」「改良」「新たな一歩」は、誰もがもう一度立ち上がれる機会と力を増やしていく事です。新たな試みを成功させ、様々な困難から抜け出す一助になれるようお手伝いする事が私たちのミッションであり、インプルーブメンツはその決意を社名に込めました。</dd>
			<dd class="link"><a href="about/">GMIについて</a></dd>
			<dd class="link"><a href="about/#anchor-outline">会社概要</a></dd>
			<dd class="link"><a href="about/#anchor-access">アクセスマップ</a></dd>
		</dl>
		<dl>
			<dt><a href="employer/"><img src="img/nav_employer.gif" alt="企業ご担当者の皆様" width="170" height="120"></a></dt>
			<dd class="catch">企業経営の<br>明るい未来の一助に</dd>
			<dd class="description">我が国の企業経営者へのサポートはまだまだ未熟です。事業を行っていると、良い時・悪い時の波が訪れます。悪くなると途端に人が離れ、累積する赤字や経営課題に対する打ち手が減っていきます。その際一人で悩む経営者の方も多くいらっしゃいます。私たちは、「蓄積してきた事業運営の手段」と、「実際に経営を行ってきた心」、この両面から企業経営の改善と経営者様の新たな一歩の一助になれればと思っております。</dd>
			<dd class="link"><a href="employer/#anchor-support01">企業・経営の改善・改良</a></dd>
			<dd class="link"><a href="employer/#anchor-support02">起業・開店・サポート</a></dd>
			<dd class="link"><a href="employer/">スマートエイジについて</a></dd>
		</dl>
		<dl>
			<dt><a href="employee/"><img src="img/nav_employee.gif" alt="働く皆様" width="160" height="120"></a></dt>
			<dd class="catch">新しいキャリアへの<br>チャンジを応援します</dd>
			<dd class="description">異業種・キャリアチェンジの困難さは転職活動を志した方皆が感じることだと思います。新しい一歩目の挑戦は何度も履歴書が戻ってきてまうことも多いかと思います。また、一方で出産後や高齢者の方々など、本当に働きたい方々の活躍の場が少ないのが現状です。私たちは新しいキャリアへのチャレンジを応援するとともに、働くうえで重要なスキルと考え方・想いをサポートしています。</dd>
			<dd class="link"><a href="employee/#anchor-requirements">募集要項</a></dd>
			<dd class="link"><a href="employee/2.html">保険制度・基礎研修・フォロー制度</a></dd>
			<dd class="link"><a href="jinzai/">人材派遣事業</a></dd>
			<dd class="link"><a href="">まずはご登録を！スマートエイジ</a></dd>
		</dl>
	</div><!--/#bottomNav-->


<ul style="overflow:hidden;margin-bottom:30px;">
<li style="float:left;border:#ccc 1px solid;"><a href="employer/smartage/"><img src="img/bnrSmartAge0001.jpg" alt="スマートエイジ" width="450"></a></li>
<li style="float:right;border:#ccc 1px solid;"><a href="employee/smartage/"><img src="img/bnrSmartAge0002.jpg" alt="スマートエイジ" width="450"></a></li>
</ul>

<!--お知らせ-->
<section style="overflow:hidden; margin-top:30px;">
	<div id="homeInfo">
		<h2>
			<img src="img/home_info_title.gif" width="252" height="46">
			<a href="info/">一覧はこちら</a>
		</h2>
		<?php if ($this->caching && !$this->_cache_including): echo '{nocache:54120f2468290ad808f4c4b1488acbc1#0}'; endif;echo smartyanytime_plugins_simplecmsEX::cms_setlist(array('id' => 2,'max' => 5,'name' => 'info','move' => false,'notdata' => true), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:54120f2468290ad808f4c4b1488acbc1#0}'; endif;?>

		<ul>
			<?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['info_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['info_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['info_list']['iteration']++;
?>
				<li>
					<a href="info/article.html?d=<?php echo $this->_tpl_vars['value']['ID']; ?>
">
						<span class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['RELEASE_DATE'])) ? $this->_run_mod_handler('d_format', true, $_tmp, "Y.m.d") : smarty_modifier_d_format($_tmp, "Y.m.d")); ?>
</span>
						<span class="title"><?php echo $this->_tpl_vars['value']['TITLE']; ?>
</span>
					</a>
				</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
</section>


<div id="homeContact_box">
	<div class="homeContact">
		<a href="search/"><img src="img/bnrSerch.gif" alt="求人検索" width="390" height="100"></a>
	</div>
	
		<div class="homeContact02">
		<a href="regist"><img src="img/bnrRegist.gif" alt="求人登録" width="390" height="100"></a>
	</div>
</div><!--#homeContact_box-->




<div id="homeContact_box">
	<div class="homeContact">
		<a href="contact/"><img src="img/home_contact.gif" alt="お問い合わせはこちら 045-290-9606 9:00～18:00（土日祝日除く）" width="390" height="130"></a>
	</div>
	
		<div class="homeContact02">
		<a href="../maxfields/about/"><img src="img/change_banner.jpg" alt="Change your business" width="390" height="130"></a>
	</div>
</div><!--#homeContact_box-->

</div><!--/#contentWrap-->


<?php  include('./gmi/include/footer.php'); ?>