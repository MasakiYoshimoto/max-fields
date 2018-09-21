<?php /* Smarty version 2.6.27, created on 2015-05-26 11:32:43
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job2.html */

$this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%C2^C26^C2668D17%%tpl_job2.html.inc'] = '563745d9ef1b6733e968965ffb489246';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'job_list', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job2.html', 54, false),array('modifier', 'strip', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job2.html', 112, false),array('modifier', 'mb_truncate', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job2.html', 112, false),)), $this); ?>
<?php
function _smarty_tplfunc_563745d9ef1b6733e968965ffb489246_0(&$_smarty)
{
echo smartyanytime_plugins_job::job_list(array('job' => $_GET['job'],'area' => $_GET['area'],'search_null' => true,'max' => 16), $_smarty);
}



?>
