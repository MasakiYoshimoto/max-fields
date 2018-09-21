<?php /* Smarty version 2.6.27, created on 2016-05-02 18:51:18
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields2/tpl_index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cms_setlist', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields2/tpl_index.html', 101, false),array('modifier', 'd_format', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields2/tpl_index.html', 106, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%BD^BDC^BDC5B187%%tpl_index.html.inc'] = '0179c3f13ed0760fa310cc264f9774c9'; ?><?php 
define('PAGE_TITLE', '静岡・都内｜請負・派遣・コンサルティング｜マックスフィールズ');
define('PAGE_DESCRIPTION', '静岡・都内の派遣アウトソーシング、コンサルティングはマックスフィールズ。貴社の競争優位を、再生、成長、新事業進出でサポート。');
define('BODY_CLASS', 'home');

include('./maxfields2/include/header.php'); ?>

<script>
$(function(){
	// スライド
	$("#homeSlide .item").slideShow({
		duration: 800, // フェード切り替えの時間（ms）
		interval: 8000, // インターバル（ms）
		autoplay: true, // 自動再生するかいなか
		prevBtn: $("#homeSlideLeft"), // 前のボタン
		nextBtn: $("#homeSlideRight") // 次のボタン
	});
})
</script>

<div id="homeSlideWrap">
	<div id="homeSlide">
		<div id="homeSlideInner">
			<div class="item">
				<a href="about/"><img src="img/mainimage02.jpg" alt="マックスの３つの使命" width="930" height="360"></a>
			</div>
			<div class="item">
				<a href="about/"><img src="img/mainimage03.jpg" alt="" width="930" height="360"></a>
			</div>
		</div>
		<span id="homeSlideLeft" style="display:none"></span>
		<span id="homeSlideRight" style="display:none"></span>
	</div>
</div><!--/#homeSlideWrap-->

<div id="homeNav">
	<ul>
		<li>
			<dl>
				<dt>
					<a href="consult/service.html">
						<img src="img/content_image01.jpg" width="205" height="130">
						<span>サービスコンサルティング事業</span>
					</a>
				</dt>
				<dd><a href="consult/service.html">SP DECOについて</a></dd>
				<dd><a href="consult/planning.html">プランニングシステム</a></dd>
			</dl>
		</li>
		<li>
			<dl>
				<dt>
					<a href="consult/staff.html">
						<img src="img/content_image02.jpg" width="205" height="130">
						<span>労務コンサルティング事業</span>
					</a>
				</dt>
				<dd><a href="consult/staff.html#anchor-menu">コンサルティングメニュー</a></dd>
				<dd><a href="consult/staff.html#anchor-backup">バックアップ体制</a></dd>
				<dd><a href="consult/staff.html#anchor-case">導入事例</a></dd>
			</dl>
		</li>
		<li>
			<dl>
				<dt>
					<a href="outsource/">
						<img src="img/content_image03.jpg" width="205" height="130">
						<span>アウトソーシング事業</span>
					</a>
				</dt>
				<dd><a href="outsource/">サービス概要</a></dd>
				<dd><a href="outsource/">メリット</a></dd>
				<dd><a href="outsource/case.html">導入事例</a></dd>
			</dl>
		</li>
		<li>
			<dl>
				<dt>
					<a href="careerpro/">
						<img src="img/content_image04.jpg" width="205" height="130">
						<span>職業紹介</span>
					</a>
				</dt>
				<dd><a href="careerpro/">キャリプロとは</a></dd>
				<dd><a href="careerpro/syokai.html">紹介予定派遣について</a></dd>
			</dl>
		</li>
	</ul>
</div><!--/#homeNav-->

<div id="homeGrayBg">

	<div id="homeContentWrap">

	<div id="homecontentMain">
		<div id="homeInfo">
			<h2>
				<img src="img/home_info_title.gif" alt="information" width="83" height="20">お知らせ・最近のコンサル活動実績
				<a href="info/">一覧はこちら</a>
			</h2>
			<?php if ($this->caching && !$this->_cache_including): echo '{nocache:0179c3f13ed0760fa310cc264f9774c9#0}'; endif;echo smartyanytime_plugins_simplecmsEX::cms_setlist(array('id' => 1,'max' => 9,'name' => 'info','move' => false,'notdata' => true), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0179c3f13ed0760fa310cc264f9774c9#0}'; endif;?>

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
		</div><!--/#homeInfo-->
		
	</div><!--/#homecontentMain-->

		<div id="homeSidebar">
			<div class="bannar"><a href="contact/"><img src="img/bnr/bnr_contact.gif" alt="お問い合わせ お気軽にお問い合わせください" width="314" height="139"></a></div>
			<div class="bannar"><a href="about/"><img src="img/bnr/bnr_change_ur_biz.jpg" alt="Change your business 停滞した今をブッコワス" width="314" height="139"></a></div>
		</div><!--/#homeSidebar-->


	<ul class="indexServiceBnrBox">
	<li><a href="consult/service.html"><img src="img/bnr/bnr_spdeco.jpg" alt="sp deco Food and Commercial Consul Division"></a></li>
	<li class="serviceBnrCenter"><a href="http://career-pro.jp/"><img src="img/bnr/bnr_careerpro.gif" alt="Career Produce キャリプロ"></a></li>
	<li><a href=""><img src="img/bnr/bnr_kyujin00.jpg" alt="求人情報はこちら"></a></li>
	</ul>

	</div><!--/#homeContentWrap-->



	<div id="groupBannar">
		<h2>マックスフィールズグループ紹介</h2>
		<ul>
			<li><a href="http://www.dd-max.com/"><img src="
<?php  echo ROOT_PATH ?>global/img/group_dd.gif" alt="株式会社ディーアンドディーマックス" width="180" height="60"></a></li>
			<li><a href="http://www.evolve-max.com/gmi/"><img src="
<?php  echo ROOT_PATH ?>global/img/group_gmi.gif" alt="株式会社グローバルマックスインブルーメンツ" width="200" height="60"></a></li>
			<li><a href="http://www.jobmax.jp/"><img src="
<?php  echo ROOT_PATH ?>global/img/group_job.gif" alt="株式会社ジョブマックスソリューションズ" width="180" height="60"></a></li>
		</ul>
	</div><!--/#ourCompanies-->

</div><!--/#homeGrayBg-->


<?php  include('./maxfields/include/footer.php'); ?>