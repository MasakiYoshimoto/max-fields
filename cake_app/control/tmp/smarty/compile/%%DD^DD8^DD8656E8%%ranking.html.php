<?php /* Smarty version 2.6.27, created on 2013-12-05 11:17:53
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/myreports//ranking.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/myreports//ranking.html', 9, false),)), $this); ?>
﻿<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr class="head">
		<td width="8%">&nbsp;</td>
		<td width="70%">ページ</td>
		<td width="22%">ページビュー</td>
	</tr>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['list']['iteration']++;
?>
	<tr>
		<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['rank'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
		<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['pageviews'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>