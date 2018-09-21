<?php /* Smarty version 2.6.27, created on 2015-09-30 15:35:52
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/plugins//index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css; charset=UTF-8" />
<meta http-equiv="content-script-type" content="text/javascript" />
<title>管理画面</title>
<link href="<?php echo $this->_tpl_vars['html']->webroot('css/common.css'); ?>
" rel="stylesheet" type="text/css">
<script type="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/common.js'); ?>
"></script>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
google.load("jquery","1.3.1");
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function plugin_install( name ) {
	document.install.elements['data[Plugins][name]'].value = name;
	document.install.submit();
}
</script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/lightbox/jquery.lightbox-0.5.js'); ?>
"></script>
<link href="<?php echo $this->_tpl_vars['html']->webroot('js/lightbox/jquery.lightbox-0.5.css'); ?>
" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/jquery.page-scroller-307.js'); ?>
"></script>
</head>


<body>
<div class="wordBreak" style="word-break:break-all;">

<!--header-->
<div id="header">
<div id="header-inner">

<!--logo-->
<?php echo $this->_tpl_vars['this']->renderElement('logo'); ?>

<!--logoここまで-->

</div>
</div>
<!--headerここまで-->

<!--pagebody-->
<div id="pagebody">
<div id="pagebody-inner">

<!--sidebar-->
<?php echo $this->_tpl_vars['this']->renderElement('side_menu'); ?>

<!--sidebarここまで-->



<!--content-->
<div id="content">
<h2>プラグイン設定</h2>
<div id="content-inner">

<div class="cont">

<h3>インストールプラグイン</h3>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="head">
    <td>プラグイン名</td>
  </tr>
<?php if ($this->_tpl_vars['plugin_list']): ?>
<?php $_from = $this->_tpl_vars['plugin_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['plugin_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['plugin_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['plugin_list']['iteration']++;
?>
	<tr>
		<td><?php echo $this->_tpl_vars['value']['Plugin']['jname']; ?>
<br/><br/>説明：<?php echo $this->_tpl_vars['value']['Plugin']['dec']; ?>
</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
</table>

<br/>
<h3>未インストールプラグイン</h3>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="head">
    <td>プラグイン名</td>
    <td width="10%">&nbsp;</td>
  </tr>
<?php if ($this->_tpl_vars['setup_list']): ?>
<?php $_from = $this->_tpl_vars['setup_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['setup_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['setup_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['setup_list']['iteration']++;
?>
	<tr>
		<td>●<?php echo $this->_tpl_vars['value']['jname']; ?>
<br/><br/><?php echo $this->_tpl_vars['value']['dec']; ?>
</td>
		<td><input type="button" value="インストール" onclick="plugin_install( '<?php echo $this->_tpl_vars['value']['name']; ?>
' )"></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
</table>

<?php echo $this->_tpl_vars['form']->create('Plugins',$this->_tpl_vars['this']->aa('action','/install','name','install')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('name',$this->_tpl_vars['this']->aa('value','')); ?>

</form>
</div>

</div>
</div>
<!--contentここまで-->

</div>
</div>
<!--pagebodyここまで-->

<!--scroll-->
<div id="scroll">
<div id="scroll-inner">
<a href="#header">ページの先頭へ</a>
</div>
</div>
<!--scrollここまで-->

<!--footer-->
<div id="footer">
</div>
<!--footerここまで-->

<?php echo $this->_tpl_vars['this']->renderElement('copyright'); ?>


</div>
</body>
</html>