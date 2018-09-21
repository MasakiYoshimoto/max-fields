<?php /* Smarty version 2.6.27, created on 2016-05-30 11:55:06
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/gmi/search/tpl_detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'job2_detail', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi/search/tpl_detail.html', 41, false),array('modifier', 'nl2br', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi/search/tpl_detail.html', 66, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%1D^1D1^1D18C220%%tpl_detail.html.inc'] = 'fdb2b54f88985ea7f52ee8d94c5a5d2d'; ?><?php 
define('PAGE_TITLE', '求人案件詳細 | 株式会社マックスフィールズ');
define('PAGE_DESCRIPTION', '静岡・都内の派遣アウトソーシング、コンサルティングはマックスフィールズ。あなたの力を発揮する確かなフィールド。');
define('BODY_CLASS', 'jobsearch');

include('./gmi/include/header.php');  ?>


<!-- コンテント -->
<div id="topicpath">
	<ol>
		<li><a href="../">ホーム</a></li>
		<li>求人案件詳細</li>
	</ol>
</div>
<!-- コンテント(SP用) -->
<div id="topicpath_sp">
	<ol>
		<li><a href="../">ホーム</a></li>
		<li>求人案件詳細</li>
	</ol>
</div>

<!-- コンテント -->
<div id="contentWrap">

	<div id="contentMain">

		<div class="contentBox">

			<div class="mainHeader">
				<h2>
					<img src="img/title.gif" alt="Job information">
					<span>求人案件</span>
				</h2>
			</div>
				<p class="outTitle00">◎ 求人検索</p>
						<div id="secondary">
							<?php  include('./gmi/include/search_box.php');  ?>
						</div><!-- end #secondary-->
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:fdb2b54f88985ea7f52ee8d94c5a5d2d#0}'; endif;echo smartyanytime_plugins_job2::job2_detail(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:fdb2b54f88985ea7f52ee8d94c5a5d2d#0}'; endif;?>

            <?php if ($this->_tpl_vars['data']['category'] == 10000): ?>
            <?php $this->assign('cat_no', '1'); ?>
            <?php elseif ($this->_tpl_vars['data']['category'] == 10010): ?>
            <?php $this->assign('cat_no', '2'); ?>
            <?php elseif ($this->_tpl_vars['data']['category'] == 10020): ?>
            <?php $this->assign('cat_no', '3'); ?>
            <?php elseif ($this->_tpl_vars['data']['category'] == 10030): ?>
            <?php $this->assign('cat_no', '3'); ?>
            <?php elseif ($this->_tpl_vars['data']['category'] == 10040): ?>
            <?php $this->assign('cat_no', '4'); ?>
            <?php elseif ($this->_tpl_vars['data']['category'] == 10050): ?>
            <?php $this->assign('cat_no', '5'); ?>
            <?php elseif ($this->_tpl_vars['data']['category'] == 99999): ?>
            <?php $this->assign('cat_no', '6'); ?>
            <?php endif; ?>
				<p class="outTitle00">◎ 求人案件詳細</p>
						<div id="primary">
								<div id="jobdetail">
									<p class="search_cdn0<?php echo $this->_tpl_vars['cat_no']; ?>
_ttl"><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['data']['category']]; ?>
<p>
									<h3 class="jobtitle"><?php echo $this->_tpl_vars['data']['catchcopy']; ?>
</h3>
									<div class="thumbnail">
									<p><img src="<?php echo $this->_tpl_vars['wwwroot']; ?>
/thumbs/img2.php<?php echo $this->_tpl_vars['magic']; ?>
&filename=/cms_contents/images/<?php echo $this->_tpl_vars['data']['pic1']; ?>
&newxsize=370&newysize=247&trim=1" alt="<?php echo $this->_tpl_vars['data']['catchcopy']; ?>
"></p></div>
									<dl>
									<dt>予定勤務地</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['area'][$this->_tpl_vars['data']['location']])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>

									<dt>仕事内容・職場紹介</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['work'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>

									<dt>賃金形態</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['wages_type'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>

									<dt>就業形態</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['work_type'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>

									<dt>休日</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['holiday'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>

									<dt>必要な経験能力</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['require_ability'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>

									<dt>学歴資格</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['educational_background'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>

									<dt>お知らせ</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['project_contents'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>

									<dt>待遇</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['treatment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>

									<dt>選考内容</dt>
									<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['selection'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>
									</dl>
								</div>

								<div class="regist_bnr">
									<p>ご応募ご希望の方はまず登録！！</p>
									<a href="../regist/?d=<?php echo $this->_tpl_vars['data']['id']; ?>
" title="登録申込み"><img src="img/bnr_regist.gif" width="300" height="56" alt="登録申込みフォームへ"/></a>
								</div>
								</div><!-- end #primary-->

			<div class="mainPageTop"><a href="#pageTop">ページトップ</a></div>

		</div><!--/.contentBox-->

	</div><!--/#contentMain-->

	<!-- サイドバーエリア -->
	
<?php  include('./gmi/include/sidebar.php');  ?>

</div><!--/#contentWrap-->


<?php  include('./gmi/include/footer.php');  ?>