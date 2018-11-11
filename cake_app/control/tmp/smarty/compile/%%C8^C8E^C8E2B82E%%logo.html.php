<?php /* Smarty version 2.6.27, created on 2018-11-11 22:15:12
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/elements/logo.html */ ?>
<div id="logo">
<p><?php echo $this->_tpl_vars['manage_title']; ?>
</p>
</div>
<p id="headNavi"><?php if ($this->_tpl_vars['view_site']): ?>｜<a href="<?php echo $this->_tpl_vars['view_site']; ?>
" target="_blank">サイトの表示</a><?php endif; ?>｜<a href="<?php echo $this->_tpl_vars['html']->webroot('users/logout'); ?>
">ログアウト</a>｜</p>