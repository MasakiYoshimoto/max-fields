<?php /* Smarty version 2.6.27, created on 2018-11-11 22:15:12
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/elements/side_menu.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'yen', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/elements/side_menu.html', 10, false),array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/elements/side_menu.html', 10, false),)), $this); ?>
<div id="sideBar">

	<div class="sideMenu">
		<h2>メニュー</h2>
		<ul>
			<li><a href="<?php echo $this->_tpl_vars['html']->webroot('tops'); ?>
">トップ</a></li>
			<?php if ($this->_tpl_vars['use_default_function']): ?>
			<?php if ($this->_tpl_vars['category_list']): ?>
			<?php $_from = $this->_tpl_vars['category_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['category_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['category_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['category_list']['iteration']++;
?>
			<li><a href="<?php echo $this->_tpl_vars['html']->webroot('cmsdocuments/index/'); ?>
cc:<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmscategory']['c_id'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmscategory']['name'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
管理</a></li>
			<?php endforeach; endif; unset($_from); ?>
			<?php if ($this->_tpl_vars['category_num'] && $this->_tpl_vars['categoryuse_num'] && $this->_tpl_vars['group_id'] >= $this->_tpl_vars['cms_category_allow_level']): ?>
			<?php if ($this->_tpl_vars['categoryuse_num'] == 1): ?>
			<li class="noBdr"><a href="<?php echo $this->_tpl_vars['html']->webroot('cmsdoccategories/lists/'); ?>
cc:<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['use_category_list'][0]['Cmscategory']['c_id'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
">カテゴリー管理</a></li>
			<?php else: ?>
			<li class="noBdr"><a href="<?php echo $this->_tpl_vars['html']->webroot('cmsdoccategories/'); ?>
">カテゴリー管理</a></li>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
		</ul>
	</div>

	<?php $_from = $this->_tpl_vars['side_menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['menu_list']['iteration']++;
?>
	<?php if ($this->_tpl_vars['value']['level'] <= $this->_tpl_vars['group_id']): ?>
	<div class="sideMenu">
		<h2><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['title'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</h2>
		<?php $_from = $this->_tpl_vars['value']['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu_list2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu_list2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['value2']):
        $this->_foreach['menu_list2']['iteration']++;
?>
		<?php if ($this->_tpl_vars['value2']['level'] <= $this->_tpl_vars['group_id']): ?>
		<ul>
			<li><a href="<?php if (preg_match ( '@https?://@' , $this->_tpl_vars['value2']['url'] )): ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value2']['url'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
<?php else: ?><?php echo $this->_tpl_vars['html']->webroot($this->_tpl_vars['value2']['url']); ?>
<?php endif; ?>" <?php if ($this->_tpl_vars['value2']['target']): ?> target="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value2']['target'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
"<?php endif; ?>><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value2']['title'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</a></li>
		</ul>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>

	<?php if ($this->_tpl_vars['group_id'] == 2 || $this->_tpl_vars['group_id'] == 99): ?>
	<div class="sideMenu">
		<h2>設定</h2>
		<ul>
			<?php if ($this->_tpl_vars['group_id'] == 99): ?>
			<li><a href="<?php echo $this->_tpl_vars['html']->webroot('cmscategories'); ?>
">設定</a></li>
			<li><a href="<?php echo $this->_tpl_vars['html']->webroot('plugins'); ?>
">プラグイン設定</a></li>
			<?php endif; ?>
			<li><a href="<?php echo $this->_tpl_vars['html']->webroot('sites'); ?>
">サイト設定</a></li>
			<li><a href="<?php echo $this->_tpl_vars['html']->webroot('analytics'); ?>
">Analytics設定</a></li>
			<li class="noBdr"><a href="<?php echo $this->_tpl_vars['html']->webroot('sitemaps'); ?>
">SITEMAP XML作成</a></li>
		</ul>
	</div>
	<?php endif; ?>
	<?php $_from = $this->_tpl_vars['side_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['links_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['links_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['links_list']['iteration']++;
?>
	<?php if ($this->_tpl_vars['value']['link']['level'] <= $this->_tpl_vars['group_id']): ?><a href="<?php if (preg_match ( '@https?://@' , $this->_tpl_vars['value']['link']['url'] )): ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['link']['url'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
<?php else: ?><?php echo $this->_tpl_vars['html']->webroot($this->_tpl_vars['value']['link']['url']); ?>
<?php endif; ?>" <?php if (preg_match ( '@https?://@' , $this->_tpl_vars['value']['link']['url'] )): ?> target="_blank"<?php endif; ?>><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['link']['title'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</a><br/><?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</div>