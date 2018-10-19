<?php /* Smarty version 2.6.27, created on 2015-05-26 10:32:09
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdoccategories//lists.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'yen', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdoccategories//lists.html', 66, false),array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdoccategories//lists.html', 66, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css; charset=UTF-8" />
<meta http-equiv="content-script-type" content="text/javascript" />
<title>管理画面</title>
<link href="<?php echo $this->_tpl_vars['html']->webroot('css/common.css'); ?>
" rel="stylesheet" type="text/css">
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
google.load("jquery","1.3.1");
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/lightbox/jquery.lightbox-0.5.js'); ?>
"></script>
<link href="<?php echo $this->_tpl_vars['html']->webroot('js/lightbox/jquery.lightbox-0.5.css'); ?>
" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/jquery.page-scroller-307.js'); ?>
"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/common.js'); ?>
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
<h2>カテゴリー管理【<?php echo $this->_tpl_vars['category_name']; ?>
】</h2>
<div id="content-inner">

<div class="cont">
<p>設定ボタンを押して編集を行って下さい。</p>
</div>

<div class="cont"> <img src="<?php echo $this->_tpl_vars['html']->webroot('images/new_btn.jpg'); ?>
" width="93" height="27" alt="新規作成" id="newBtn" style="cursor: pointer" onclick="doccategories_add( );" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="head">
    <td>テゴリー名</td>
    <td width="10%">表示順</td>
    <td width="16%">編集削除</td>
  </tr>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['list']['iteration']++;
?>
	<tr>
	<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsdoccategory']['name'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
	<td align="center"><?php if (($this->_foreach['list']['iteration'] <= 1) == true): ?><?php else: ?><img src="<?php echo $this->_tpl_vars['html']->webroot('images/up_icon.jpg'); ?>
" alt="アップ" width="13" height="13" style="cursor: pointer" onclick="go_doccategorysort(<?php echo $this->_tpl_vars['value']['Cmsdoccategory']['id']; ?>
,1);" />&nbsp;<?php endif; ?><?php if (($this->_foreach['list']['iteration'] == $this->_foreach['list']['total']) == true): ?><?php else: ?><img src="<?php echo $this->_tpl_vars['html']->webroot('images/down_icon.jpg'); ?>
" width="13" height="13" alt="ダウン" style="cursor: pointer" onclick="go_doccategorysort(<?php echo $this->_tpl_vars['value']['Cmsdoccategory']['id']; ?>
,2);"/><?php endif; ?></td>
	<td><img src="<?php echo $this->_tpl_vars['html']->webroot('images/edit_icon.jpg'); ?>
" width="40" height="19" alt="編集"  style="cursor: pointer" onclick="doccategories_edit( <?php echo $this->_tpl_vars['value']['Cmsdoccategory']['id']; ?>
 );" />&nbsp;<img src="<?php echo $this->_tpl_vars['html']->webroot('images/delete_icon.jpg'); ?>
" width="40" height="19" alt="削除"  style="cursor: pointer" onclick="doccategories_del( <?php echo $this->_tpl_vars['value']['Cmsdoccategory']['id']; ?>
 );" /></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>

</div>
</div>
<?php echo $this->_tpl_vars['form']->create('Cmsdoccategory',$this->_tpl_vars['this']->aa('action','/add','name','add')); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Cmsdoccategory',$this->_tpl_vars['this']->aa('action','/edit','name','edit')); ?>

<?php echo $this->_tpl_vars['form']->hidden('id',$this->_tpl_vars['this']->aa('value','')); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Cmsdoccategory',$this->_tpl_vars['this']->aa('action','/del','name','del')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('del_id',$this->_tpl_vars['this']->aa('value',"")); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Cmsdoccategory',$this->_tpl_vars['this']->aa('action','/sort','name','sort')); ?>

<?php echo $this->_tpl_vars['form']->hidden('id',$this->_tpl_vars['this']->aa('value','')); ?>

<?php echo $this->_tpl_vars['form']->hidden('sort_flag',$this->_tpl_vars['this']->aa('value','')); ?>

</form>
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