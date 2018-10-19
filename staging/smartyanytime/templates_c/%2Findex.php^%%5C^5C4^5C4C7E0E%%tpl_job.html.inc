<?php /* Smarty version 2.6.27, created on 2015-05-26 11:15:11
         compiled from file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job.html */

$this->_cache_serials['/var/www/vhosts/evolve-max.com/httpdocs/smartyanytime/templates_c//%2Findex.php^%%5C^5C4^5C4C7E0E%%tpl_job.html.inc'] = '82fb8993f706e70b1fe6cf3759732d4d';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'new_job_list', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job.html', 54, false),array('modifier', 'strip', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job.html', 94, false),array('modifier', 'mb_truncate', 'file:/var/www/vhosts/evolve-max.com/httpdocs/myjobis/tpl_job.html', 94, false),)), $this); ?>
<?php
function _smarty_tplfunc_82fb8993f706e70b1fe6cf3759732d4d_0(&$_smarty)
{
echo smartyanytime_plugins_job::new_job_list(array('max' => 6), $_smarty);
}



?>
