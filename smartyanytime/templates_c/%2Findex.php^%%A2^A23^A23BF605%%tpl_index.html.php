<?php /* Smarty version 2.6.27, created on 2017-10-02 10:28:07
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/sophia/tpl_index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cms_setlist', 'file:/var/www/vhosts/evolve-max.com/httpdocs/sophia/tpl_index.html', 56, false),array('modifier', 'd_format', 'file:/var/www/vhosts/evolve-max.com/httpdocs/sophia/tpl_index.html', 61, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%A2^A23^A23BF605%%tpl_index.html.inc'] = '4651374fe72cfed6a39e6bc12a2e8cdd'; ?><?php 
define('PAGE_TITLE', '株式会社ソフィアマックス');
define('PAGE_DESCRIPTION', '神奈川・都内の派遣アウトソーシングはソフィアマックス。人財の違いで御社のビジネスをサポートいたします。');
define('BODY_CLASS', 'home');

include('./sophia/include/header.php'); ?>

<!-- コンテント -->
<div id="contentWrap">

	<div id="homeVisual">
		<img src="img/home_visual.jpg" alt="企業を元気にすることで雇用を増やし、人々の笑顔と幸せの輪を広げる" width="930" height="360">
	</div>

	<div id="boxNav">
		<dl>
			<dt><a href="about/"><img src="img/nav_about.gif" alt="Sophiamaxとは？" height="120"></a></dt>
			<dd class="catch">ワークイノベーション企業…</dd>
			<dd class="description">変わるゆく時代の中、働く人の自由性、多様性、雇用側の柔軟性が人の資源を最大に活かす事であり、同時に、働きながら専門性を身につけるシステムと、人間ならではの情緒や創造性をベースとしたグローバルなマーケットに活躍する雇用、人材を生み出して参ります。
</dd>
			<dd class="link"><a href="about/">ソフィアマックスについて</a></dd>
			<dd class="link"><a href="about/#anchor-outline">会社概要</a></dd>
			<dd class="link"><a href="about/#anchor-access">アクセスマップ</a></dd>
		</dl>
		<dl>
			<dt><a href="employer/"><img src="img/nav_employer.gif" alt="企業ご担当者の皆様" width="170" height="120"></a></dt>
			<dd class="catch">企業経営の<br>明るい未来の一助に</dd>
			<dd class="description">私たちは、「蓄積してきた事業運営の手段」と、「実際に経営を行ってきた心」、この両面から企業経営の改善と経営者様の新たな一歩の一助になる様に務めています。</dd>
			<dd class="link"><a href="employer/#anchor-support01">企業・経営の改善・改良</a></dd>
			<dd class="link"><a href="employer/#anchor-support02">起業・開店・サポート</a></dd>
			<dd class="link"><a href="employer/">スマートエイジについて</a></dd>
		</dl>
		<dl>
			<dt><a href="employee/"><img src="img/nav_employee.gif" alt="働く皆様" width="160" height="120"></a></dt>
			<dd class="catch">自分のコンパス…</dd>
			<dd class="description">これからの時代に向けては「自分のコンパス」を持つ事が重要で、自分だけの技術や方向性を持ち時代を切り拓く。その自分のコンパスづくりをソフィアマックスはサポートしていきます。 </dd>
			<dd class="link"><a href="employee/#anchor-requirements">募集要項</a></dd>
			<dd class="link"><a href="employee/2.html">保険制度・基礎研修・フォロー制度</a></dd>
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
		<?php if ($this->caching && !$this->_cache_including): echo '{nocache:4651374fe72cfed6a39e6bc12a2e8cdd#0}'; endif;echo smartyanytime_plugins_simplecmsEX::cms_setlist(array('id' => 2,'max' => 5,'name' => 'info','move' => false,'notdata' => true), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:4651374fe72cfed6a39e6bc12a2e8cdd#0}'; endif;?>

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


<?php  include('./sophia/include/footer.php'); ?>