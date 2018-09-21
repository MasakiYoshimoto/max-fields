<?php /* Smarty version 2.6.27, created on 2016-03-30 11:06:32
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/tpl_index.html */

$this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%9D^9DE^9DE8814F%%tpl_index.html.inc'] = '3e04c153ded8096bc683a7474781e782';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'new_job2_list', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/tpl_index.html', 44, false),array('function', 'cms_setlist', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/tpl_index.html', 89, false),array('modifier', 'strip', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/tpl_index.html', 71, false),array('modifier', 'mb_truncate', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/tpl_index.html', 71, false),array('modifier', 'd_format', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/tpl_index.html', 94, false),)), $this); ?>
<?php
function _smarty_tplfunc_3e04c153ded8096bc683a7474781e782_0(&$_smarty)
{
echo smartyanytime_plugins_job2::new_job2_list(array('max' => 3), $_smarty);
}


function _smarty_tplfunc_3e04c153ded8096bc683a7474781e782_1(&$_smarty)
{
echo smartyanytime_plugins_simplecmsEX::cms_setlist(array('id' => 2,'max' => 5,'name' => 'info','move' => false,'notdata' => true), $_smarty);
}



?>
