<?php /* Smarty version 2.6.27, created on 2017-08-04 15:46:56
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields2017/sophiamax/search/tpl_index.html */

$this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%FB^FBB^FBB5B002%%tpl_index.html.inc'] = 'b70a69f96170da7e1c8692e14e433dc9';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'job2_list', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields2017/sophiamax/search/tpl_index.html', 42, false),array('modifier', 'strip', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields2017/sophiamax/search/tpl_index.html', 67, false),array('modifier', 'mb_truncate', 'file:/var/www/vhosts/evolve-max.com/httpdocs/maxfields2017/sophiamax/search/tpl_index.html', 67, false),)), $this); ?>
<?php
function _smarty_tplfunc_b70a69f96170da7e1c8692e14e433dc9_0(&$_smarty)
{
echo smartyanytime_plugins_job2::job2_list(array('job' => $_GET['job'],'area' => $_GET['area'],'search_null' => true,'max' => 9), $_smarty);
}



?>
