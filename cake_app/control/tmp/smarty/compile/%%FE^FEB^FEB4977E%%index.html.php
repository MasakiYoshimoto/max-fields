<?php /* Smarty version 2.6.27, created on 2018-11-11 22:15:12
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'yen', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//index.html', 73, false),array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//index.html', 73, false),)), $this); ?>
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
<h2><?php echo $this->_tpl_vars['category_name']; ?>
管理</h2>
<div id="content-inner">

<div class="cont">
<p>新規作成、編集ボタンを押して作業を行って下さい。</p>
</div>

<div class="cont">
<img src="<?php echo $this->_tpl_vars['html']->webroot('images/new_btn.jpg'); ?>
" width="93" height="27" alt="新規作成" id="newBtn" style="cursor: pointer" onclick="documents_add( );" />
<?php if ($this->_tpl_vars['use_category']): ?>
<div style="float: right;"><?php echo $this->_tpl_vars['form']->create('Cmsdocument',$this->_tpl_vars['this']->aa('action','/index','id','searchs','name','searchs')); ?>
<span style="font-size: 10px;"/>右のプルダウンから表示するカテゴリを選択できます：</span><?php echo $this->_tpl_vars['form']->select('Cmsdocument.category',$this->_tpl_vars['doccategory_list'],$this->_tpl_vars['search_category'],$this->_tpl_vars['this']->aa('onchange','$("#searchs").submit();'),false); ?>
</form></div><p style="clear:right;" />
<?php endif; ?>
<?php if ($this->_tpl_vars['group_id'] == 2 || $this->_tpl_vars['group_id'] == 99): ?><p><a href="<?php echo $this->_tpl_vars['html']->webroot('cmsdocuments/valueslist/id:'); ?>
<?php echo $this->_tpl_vars['c_id']; ?>
" target="_blank">変数一覧</a></p><?php endif; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="head">
    <td width="8%">ID</td>
    <td width="45%">タイトル</td>
    <td width="21%">更新日時</td>
    <td width="10%">表示順</td>
    <td width="16%">編集・削除</td>
  </tr>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['dlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['dlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['dlist']['iteration']++;
?>
  <tr>
    <td align="center" <?php if ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 1): ?> bgcolor="#ccffcc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 2): ?> bgcolor="#ffcccc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 3): ?> bgcolor="#d3d3d3"<?php endif; ?>><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsdocument']['d_id'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
    <td <?php if ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 1): ?> bgcolor="#ccffcc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 2): ?> bgcolor="#ffcccc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 3): ?> bgcolor="#d3d3d3"<?php endif; ?>><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsdocument']['title'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
    <td <?php if ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 1): ?> bgcolor="#ccffcc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 2): ?> bgcolor="#ffcccc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 3): ?> bgcolor="#d3d3d3"<?php endif; ?>><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsdocument']['edit_date'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
    <td align="center" <?php if ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 1): ?> bgcolor="#ccffcc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 2): ?> bgcolor="#ffcccc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 3): ?> bgcolor="#d3d3d3"<?php endif; ?>><?php if ($this->_tpl_vars['paginator']->counter("%page%") == 1 && ($this->_foreach['dlist']['iteration'] <= 1) == true): ?><?php else: ?><img src="<?php echo $this->_tpl_vars['html']->webroot('images/up_icon.jpg'); ?>
" alt="アップ" width="13" height="13" style="cursor: pointer" onclick="go_sort(<?php echo $this->_tpl_vars['value']['Cmsdocument']['d_id']; ?>
,1);" />&nbsp;<?php endif; ?><?php if ($this->_tpl_vars['paginator']->counter("%page%") == $this->_tpl_vars['paginator']->counter("%pages%") && ($this->_foreach['dlist']['iteration'] == $this->_foreach['dlist']['total']) == true): ?><?php else: ?><img src="<?php echo $this->_tpl_vars['html']->webroot('images/down_icon.jpg'); ?>
" width="13" height="13" alt="ダウン" style="cursor: pointer" onclick="go_sort(<?php echo $this->_tpl_vars['value']['Cmsdocument']['d_id']; ?>
,2);"/><?php endif; ?></td>
    <td align="center" <?php if ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 1): ?> bgcolor="#ccffcc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 2): ?> bgcolor="#ffcccc"<?php elseif ($this->_tpl_vars['value']['Cmsdocument']['color_mode'] == 3): ?> bgcolor="#d3d3d3"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['html']->webroot('images/edit_icon.jpg'); ?>
" width="40" height="19" alt="編集"  style="cursor: pointer" onclick="documents_edit( <?php echo $this->_tpl_vars['value']['Cmsdocument']['d_id']; ?>
 )" />&nbsp;<img src="<?php echo $this->_tpl_vars['html']->webroot('images/delete_icon.jpg'); ?>
" width="40" height="19" alt="削除"  style="cursor: pointer" onclick="documents_del( <?php echo $this->_tpl_vars['value']['Cmsdocument']['d_id']; ?>
 )" /></td>
  </tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php if ($this->_tpl_vars['paginator']->counter("%pages%") > 1): ?>
<ul id="pageNavi">
<?php $_from = $this->_tpl_vars['pagelist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
<li><?php if ($this->_tpl_vars['paginator']->counter("%page%") != $this->_tpl_vars['value']['page']): ?><a href="<?php echo $this->_tpl_vars['html']->webroot('cmsdocuments/index/page:'); ?>
<?php echo $this->_tpl_vars['value']['page']; ?>
"><?php echo $this->_tpl_vars['value']['page']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['value']['page']; ?>
<?php endif; ?></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>
</div>
</div>
<?php echo $this->_tpl_vars['form']->create('Cmsdocument',$this->_tpl_vars['this']->aa('action','/add','name','add')); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Cmsdocument',$this->_tpl_vars['this']->aa('action','/edit','name','edit')); ?>

<?php echo $this->_tpl_vars['form']->hidden('d_id',$this->_tpl_vars['this']->aa('value','')); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Cmsdocument',$this->_tpl_vars['this']->aa('action','/del','name','del')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('del_d_id',$this->_tpl_vars['this']->aa('value',"")); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Cmscategory',$this->_tpl_vars['this']->aa('url','/cmsdocuments/','name','searchword')); ?>

<?php echo $this->_tpl_vars['form']->hidden('word',$this->_tpl_vars['this']->aa('value',"")); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Cmsdocument',$this->_tpl_vars['this']->aa('action','/sort','name','sort')); ?>

<?php echo $this->_tpl_vars['form']->hidden('d_id',$this->_tpl_vars['this']->aa('value','')); ?>

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