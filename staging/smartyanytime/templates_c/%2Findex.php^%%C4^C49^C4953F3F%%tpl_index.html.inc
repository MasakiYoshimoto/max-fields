<?php /* Smarty version 2.6.27, created on 2015-09-30 16:42:04
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields/search/tpl_index.html */

$this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%C4^C49^C4953F3F%%tpl_index.html.inc'] = 'a3eedbe2bbb4d7db30bc0a697f1110ab';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'job2_list', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields/search/tpl_index.html', 42, false),array('modifier', 'strip', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields/search/tpl_index.html', 67, false),array('modifier', 'mb_truncate', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields/search/tpl_index.html', 67, false),)), $this); ?>
<?php
function _smarty_tplfunc_a3eedbe2bbb4d7db30bc0a697f1110ab_0(&$_smarty)
{
echo smartyanytime_plugins_job2::job2_list(array('job' => $_GET['job'],'area' => $_GET['area'],'search_null' => true,'max' => 9), $_smarty);
}



?>
