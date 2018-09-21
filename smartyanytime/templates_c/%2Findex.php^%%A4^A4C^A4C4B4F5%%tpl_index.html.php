<?php /* Smarty version 2.6.27, created on 2017-06-07 20:07:45
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/gmi/info/tpl_index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cms_setlist', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi/info/tpl_index.html', 32, false),array('modifier', 'd_format', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi/info/tpl_index.html', 37, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%A4^A4C^A4C4B4F5%%tpl_index.html.inc'] = 'af08211b650a9f42ca34dc6b68f20f9d'; ?><?php 
define('PAGE_TITLE', 'お知らせ | 株式会社グローバルマックスインプルーブメンツ');
define('PAGE_DESCRIPTION', '神奈川・都内の派遣アウトソーシングはグローバルマックス。人財の違いで御社のビジネスをサポートいたします。');
define('BODY_CLASS', 'info');

include('./gmi/include/header.php'); ?>

<!-- コンテント -->
<div id="topicpath">
	<ol>
		<li><a href="../">ホーム</a></li>
		<li>お知らせ</li>
	</ol>
</div>


<!-- コンテント -->
<div id="contentWrap">

	<div id="contentMain">

		<div class="contentBox">

			<div class="mainHeader">
				<h2>
					<img src="img/title_icon.gif" alt="information" width="152" height="124">
					<span>お知らせ</span>
				</h2>
			</div>

			<div class="infoList">
				<?php if ($this->caching && !$this->_cache_including): echo '{nocache:af08211b650a9f42ca34dc6b68f20f9d#0}'; endif;echo smartyanytime_plugins_simplecmsEX::cms_setlist(array('id' => 2,'max' => 10,'name' => 'info','move' => true,'notdata' => true), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:af08211b650a9f42ca34dc6b68f20f9d#0}'; endif;?>

				<ul>
					<?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['info_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['info_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['info_list']['iteration']++;
?>
						<li>
							<a href="article.html?d=<?php echo $this->_tpl_vars['value']['ID']; ?>
">
								<span class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['RELEASE_DATE'])) ? $this->_run_mod_handler('d_format', true, $_tmp, "Y.m.d") : smarty_modifier_d_format($_tmp, "Y.m.d")); ?>
</span>
								<span class="title"><?php echo $this->_tpl_vars['value']['TITLE']; ?>
</span>
							</a>
						</li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			</div><!--/.infoList-->

			<?php if ($this->_tpl_vars['info'] && $this->_tpl_vars['info']['maxpage'] != 1): ?>
				<div class="infoPaging">
					<?php if ($this->_tpl_vars['info']['page'] != 1): ?><a class="prev" href="./index.html?p=<?php echo $this->_tpl_vars['info']['page']-1; ?>
">&lt;</a><?php endif; ?>
						<?php $_from = $this->_tpl_vars['info']['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['info_pagelist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['info_pagelist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['info_pagelist']['iteration']++;
?>
							<a class="number<?php if ($this->_tpl_vars['info']['page'] == $this->_tpl_vars['value']): ?> current<?php endif; ?>" href="./index.html?p=<?php echo $this->_tpl_vars['value']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</a>
						<?php endforeach; endif; unset($_from); ?>
					<?php if ($this->_tpl_vars['info']['list'] && $this->_tpl_vars['info']['maxpage'] != $this->_tpl_vars['info']['page']): ?><a class="next" href="./index.html?p=<?php echo $this->_tpl_vars['info']['page']+1; ?>
">&gt;</a><?php endif; ?>
				</div><!--/.infoPaging-->
			<?php endif; ?>

		</div><!--/.contentBox-->

	</div><!--/#contentMain-->

	<!-- サイドバーエリア -->
	
<?php  include('./gmi/include/sidebar.php'); ?>

</div><!--/#contentWrap-->


<?php  include('./gmi/include/footer.php'); ?>