<?php /* Smarty version 2.6.27, created on 2016-03-07 15:59:09
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/search/tpl_index.html */

$this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%DE^DE2^DE2ED791%%tpl_index.html.inc'] = '18f485069579b727c228757a784ccfc7';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'job2_list', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/search/tpl_index.html', 42, false),array('modifier', 'strip', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/search/tpl_index.html', 67, false),array('modifier', 'mb_truncate', 'file:/var/www/vhosts/evolve-max.com/httpdocs/gmi2/search/tpl_index.html', 67, false),)), $this); ?>
<?php
function _smarty_tplfunc_18f485069579b727c228757a784ccfc7_0(&$_smarty)
{
echo smartyanytime_plugins_job2::job2_list(array('job' => $_GET['job'],'area' => $_GET['area'],'search_null' => true,'max' => 9), $_smarty);
}



?>
