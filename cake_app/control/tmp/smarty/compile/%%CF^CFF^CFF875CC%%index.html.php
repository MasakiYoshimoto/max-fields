<?php /* Smarty version 2.6.27, created on 2015-09-30 15:35:40
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmscategories//index.html */ ?>
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
<h2>カテゴリー設定</h2>
<div id="content-inner">

<div class="cont">
<form name="list" method="POST" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="head">
    <td>No.</td>
    <td>タイトル</td>
    <td>&nbsp;</td>
  </tr>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['list']['iteration']++;
?>
	<tr>
		<td rowspan="2"><?php echo $this->_tpl_vars['value']['Cmscategory']['c_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['this']->cat('name',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('type','text','size','50','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['value']['Cmscategory']['name'])); ?>
</td>
		<td><input type="button" value="変　更" onclick="category_update( <?php echo $this->_tpl_vars['value']['Cmscategory']['c_id']; ?>
 )">　<input type="button" value="設　定" onclick="category_setting( <?php echo $this->_tpl_vars['value']['Cmscategory']['c_id']; ?>
 )">　<input type="button" value="削　除" onclick="category_del( <?php echo $this->_tpl_vars['value']['Cmscategory']['c_id']; ?>
 )"></td>
	</tr>
	<tr>
		<td colspan="2" style="font-size:90%;">
<?php if ($this->_tpl_vars['value']['Cmscategory']['use_rss'] == 1): ?><?php $this->assign('use_rss', 'true'); ?><?php else: ?><?php $this->assign('use_rss', 'false'); ?><?php endif; ?>
<?php if ($this->_tpl_vars['value']['Cmscategory']['use_period'] == 1): ?><?php $this->assign('use_period', 'true'); ?><?php else: ?><?php $this->assign('use_period', 'false'); ?><?php endif; ?>
<?php if ($this->_tpl_vars['value']['Cmscategory']['use_mobile'] == 1): ?><?php $this->assign('use_mobile', 'true'); ?><?php else: ?><?php $this->assign('use_mobile', 'false'); ?><?php endif; ?>
<?php if ($this->_tpl_vars['value']['Cmscategory']['use_category'] == 1): ?><?php $this->assign('use_category', 'true'); ?><?php else: ?><?php $this->assign('use_category', 'false'); ?><?php endif; ?>
<?php if ($this->_tpl_vars['value']['Cmscategory']['use_link'] == 1): ?><?php $this->assign('use_link', 'true'); ?><?php else: ?><?php $this->assign('use_link', 'false'); ?><?php endif; ?>
<?php if ($this->_tpl_vars['value']['Cmscategory']['use_fulledit'] == 1): ?><?php $this->assign('use_fulledit', 'true'); ?><?php else: ?><?php $this->assign('use_fulledit', 'false'); ?><?php endif; ?>
<?php if ($this->_tpl_vars['value']['Cmscategory']['use_filemanager'] == 1): ?><?php $this->assign('use_filemanager', 'true'); ?><?php else: ?><?php $this->assign('use_filemanager', 'false'); ?><?php endif; ?>
			文字数：<?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['this']->cat('title_max',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('type','text','size','5','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['value']['Cmscategory']['title_max'])); ?>

			RSS：<?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('use_rss',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['use_rss'])); ?>

			期間：<?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('use_period',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['use_period'])); ?>

			携帯：<?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('use_mobile',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['use_mobile'])); ?>

			カテゴリー：<?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('use_category',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['use_category'])); ?>

			リンク：<?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('use_link',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['use_link'])); ?>

			Full Edit：<?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('use_fulledit',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['use_fulledit'])); ?>

			FileManager：<?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('use_filemanager',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['use_filemanager'])); ?>
<br/>
			プレビューページ：<?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['this']->cat('preview_page',$this->_tpl_vars['value']['Cmscategory']['c_id']),$this->_tpl_vars['this']->aa('type','text','size','50','label','false','div','false','error','false','id','preview_page','value',$this->_tpl_vars['value']['Cmscategory']['preview_page'])); ?>

			</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</form>
</div>

<br>
<h3>カテゴリーの新規追加</h3>
<?php echo $this->_tpl_vars['form']->create('Cmscategory',$this->_tpl_vars['this']->aa('action','/add')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('c_id',$this->_tpl_vars['this']->aa('value',"")); ?>

カテゴリー名：
<?php echo $this->_tpl_vars['form']->input('name',$this->_tpl_vars['this']->aa('type','text','size','50','label','false','div','false','error','false')); ?>
　<?php echo $this->_tpl_vars['form']->end($this->_tpl_vars['this']->aa('label','追加','div','false')); ?>


<?php echo $this->_tpl_vars['form']->create('Cmscategory',$this->_tpl_vars['this']->aa('action','/up','name','update')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_name',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_c_id',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_title_max',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_use_rss',$this->_tpl_vars['this']->aa('value','0')); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_use_period',$this->_tpl_vars['this']->aa('value','0')); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_use_mobile',$this->_tpl_vars['this']->aa('value','0')); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_use_category',$this->_tpl_vars['this']->aa('value','0')); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_use_link',$this->_tpl_vars['this']->aa('value','0')); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_use_fulledit',$this->_tpl_vars['this']->aa('value','0')); ?>

<?php echo $this->_tpl_vars['form']->hidden('use_filemanager',$this->_tpl_vars['this']->aa('value','0')); ?>

<?php echo $this->_tpl_vars['form']->hidden('preview_page',$this->_tpl_vars['this']->aa('value',"")); ?>

</form>

<?php echo $this->_tpl_vars['form']->create('Cmscategory',$this->_tpl_vars['this']->aa('action','/del','name','del')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('del_c_id',$this->_tpl_vars['this']->aa('value',"")); ?>

</form>

<?php echo $this->_tpl_vars['form']->create('Cmscategory',$this->_tpl_vars['this']->aa('url','/cmsitems','name','edit')); ?>

<?php echo $this->_tpl_vars['form']->hidden('edit_c_id',$this->_tpl_vars['this']->aa('value',"")); ?>

</form>

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