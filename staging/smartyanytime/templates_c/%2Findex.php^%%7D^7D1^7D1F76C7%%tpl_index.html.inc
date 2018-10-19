<?php /* Smarty version 2.6.27, created on 2017-08-04 16:07:37
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/sophiamax/search/tpl_index.html */

$this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%7D^7D1^7D1F76C7%%tpl_index.html.inc'] = 'be95db04396bc6abdf3588364558e36b';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'job2_list', 'file:/var/www/vhosts/evolve-max.com/httpdocs/sophiamax/search/tpl_index.html', 42, false),array('modifier', 'strip', 'file:/var/www/vhosts/evolve-max.com/httpdocs/sophiamax/search/tpl_index.html', 67, false),array('modifier', 'mb_truncate', 'file:/var/www/vhosts/evolve-max.com/httpdocs/sophiamax/search/tpl_index.html', 67, false),)), $this); ?>
<?php
function _smarty_tplfunc_be95db04396bc6abdf3588364558e36b_0(&$_smarty)
{
echo smartyanytime_plugins_job2::job2_list(array('job' => $_GET['job'],'area' => $_GET['area'],'search_null' => true,'max' => 9), $_smarty);
}



?>
