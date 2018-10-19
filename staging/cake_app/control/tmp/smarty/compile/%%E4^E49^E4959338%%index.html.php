<?php /* Smarty version 2.6.27, created on 2015-05-26 10:30:57
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsitems//index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsitems//index.html', 69, false),)), $this); ?>
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
<h2>カテゴリー詳細設定</h2>
<div id="content-inner">

<div class="cont">

<h3>【<?php echo $this->_tpl_vars['c_id']; ?>
：<?php echo $this->_tpl_vars['name']; ?>
】</h3>

<form name="list" method="POST" action="">
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['list']['iteration']++;
?>
<table width="100%">
	<tr class="head">
		<td colspan="2"><?php echo $this->_tpl_vars['value']['no']; ?>
　<?php if (($this->_foreach['list']['iteration'] <= 1) == true): ?><?php else: ?><a href="#" onclick="go_itemssort(<?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
,1);return false;"><img src="<?php echo $this->_tpl_vars['html']->webroot('images/up_icon.jpg'); ?>
" border="0" style="margin-bottom: 5px;"></a><?php endif; ?><?php if (($this->_foreach['list']['iteration'] == $this->_foreach['list']['total']) == true): ?><?php else: ?><a href="#" onclick="go_itemssort(<?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
,2);return false;"><img src="<?php echo $this->_tpl_vars['html']->webroot('images/down_icon.jpg'); ?>
" border="0"></a><?php endif; ?></td>
	</tr>
	<tr>
		<td>必須</td>
		<td><input type="checkbox" name="required<?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
" value="1" <?php if ($this->_tpl_vars['value']['Cmsitem']['required'] == 1): ?>CHECKED<?php endif; ?>></td>
	</tr>
	<tr>
		<td>名　称</td>
		<td><input type="text" name="item_name<?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
" size="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
"></td>
	</tr>
	<tr>
		<td>値</td>
		<td><input type="text" name="values<?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
" size="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['values_string'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
"></td>
	</tr>
	<tr>
		<td>文字数</td>
		<td><input type="text" name="max<?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
" size="50" value="<?php if ($this->_tpl_vars['value']['Cmsitem']['max']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['max'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
<?php endif; ?>"></td>
	</tr>
	<tr>
		<td>単　位</td>
		<td><input type="text" name="unit<?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
" size="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['unit'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
"></td>
	</tr>
	<tr>
		<td>変数名</td>
		<td><input type="text" name="variable_name<?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
" size="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['variable_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
"></td>
	</tr>
	<tr>
		<td>説　明</td>
		<td><textarea name="explanation<?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
" cols="45" rows="10"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['explanation'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</textarea></td>
	</tr>
	<tr>
		<td>種　類</td>
		<td>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 1): ?>
		１行テキスト
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 2): ?>
		テキストエリア
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 3): ?>
		画像
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 4): ?>
		添付ファイル
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 5): ?>
		ラジオボタン
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 6): ?>
		セレクト
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 7): ?>
		チェックボックス
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 8): ?>
		日付
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 9): ?>
		日時
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 10): ?>
		テキストエリア（ノーマル）
		<?php endif; ?>
		</td>
	</tr>
	<tr class="head">
		<td colspan="2"><div class="center_box"><div class="koushin_del"><input type="button" value="更　新" onclick="items_update( <?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
 )">　　<input type="button" value="削　除" onclick="items_del( <?php echo $this->_tpl_vars['value']['Cmsitem']['i_id']; ?>
 )"></div></div></td>
	</tr>
</table>
<br/>
<?php endforeach; endif; unset($_from); ?>
</form>
</div>

<br>
<h3>アイテムの新規追加</h3>
<?php echo $this->_tpl_vars['form']->create('Cmsitem',$this->_tpl_vars['this']->aa('action','/add')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('c_id',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['c_id'])); ?>

<table>
<tr><td align="center">種　類</td><td>：<?php echo $this->_tpl_vars['form']->select('Cmsitem.type',$this->_tpl_vars['lists'],null,null,false); ?>

</td></tr>
<tr><td align="center">名　称</td><td>：<?php echo $this->_tpl_vars['form']->input('item_name',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false')); ?>
</td></tr>
<tr><td align="center">値</td><td>：<?php echo $this->_tpl_vars['form']->input('values',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false')); ?>
</td></tr>
<tr><td align="center">文字数</td><td>：<?php echo $this->_tpl_vars['form']->input('max',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false')); ?>
</td></tr>
<tr><td align="center">単　位</td><td>：<?php echo $this->_tpl_vars['form']->input('unit',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false')); ?>
</td></tr>
<tr><td align="center">変　数</td><td>：<?php echo $this->_tpl_vars['form']->input('variable_name',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false')); ?>
</td></tr>
<tr><td align="center">説　明</td><td>：<?php echo $this->_tpl_vars['form']->input('explanation',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false')); ?>
</td></tr>
<tr><td align="center">必　須</td><td>：<?php echo $this->_tpl_vars['form']->checkbox('Cmsitem.required'); ?>
</td></tr>
</table>
<?php echo $this->_tpl_vars['form']->end($this->_tpl_vars['this']->aa('label','追　加','div','false')); ?>


<?php echo $this->_tpl_vars['form']->create('Cmsitem',$this->_tpl_vars['this']->aa('action','/up','name','update')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_c_id',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['c_id'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_i_id',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_item_name',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_values',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_max',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_unit',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_variable_name',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_explanation',$this->_tpl_vars['this']->aa('value',"")); ?>

<?php echo $this->_tpl_vars['form']->hidden('up_required',$this->_tpl_vars['this']->aa('value',"")); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Cmsitem',$this->_tpl_vars['this']->aa('action','/del','name','del')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('del_i_id',$this->_tpl_vars['this']->aa('value',"")); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Cmsitem',$this->_tpl_vars['this']->aa('action','/sort','name','sort')); ?>

<?php echo $this->_tpl_vars['form']->hidden('c_id',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['c_id'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('i_id',$this->_tpl_vars['this']->aa('value','')); ?>

<?php echo $this->_tpl_vars['form']->hidden('sort_flag',$this->_tpl_vars['this']->aa('value','')); ?>

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