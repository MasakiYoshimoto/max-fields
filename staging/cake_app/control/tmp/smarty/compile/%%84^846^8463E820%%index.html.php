<?php /* Smarty version 2.6.27, created on 2015-05-26 10:26:02
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/sites//index.html */ ?>
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

<script language="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/common.js'); ?>
"></script>
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
<h2>サイト設定</h2>
<div id="content-inner">

<div class="cont">
<h3>設定画面</h3>
<p>入力後、登録ボタンを押して下さい。</p>
</div>

<?php if ($this->_tpl_vars['error']): ?>
<div class="error">
<?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['error'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['error']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['error']['iteration']++;
?>
<span class="redTxt">・<?php echo $this->_tpl_vars['value']; ?>
</span><?php if (! ($this->_foreach['error']['iteration'] == $this->_foreach['error']['total'])): ?><br/><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>
<div class="cont">
<?php echo $this->_tpl_vars['form']->create('Site',$this->_tpl_vars['this']->aa('action','/editdo','name','Site','Autocomplete','off')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td width="28%" class="clr">サイトのURL　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/hissu_icon.jpg'); ?>
" width="40" height="19" alt="必須" /></td>
	<td width="72%"><?php echo $this->_tpl_vars['form']->input('site_url',$this->_tpl_vars['this']->aa('type','text','size','60','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['Site']['site_url'])); ?>
</td>
	</tr>
	<tr>
	<td class="clr">サイトの名称</td>
	<td><?php echo $this->_tpl_vars['form']->input('site_name',$this->_tpl_vars['this']->aa('type','text','size','60','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['Site']['site_name'])); ?>
</td>
	</tr>
	<tr>
	<td class="clr">共通タイトル</td>
	<td><?php echo $this->_tpl_vars['form']->input('title',$this->_tpl_vars['this']->aa('type','text','size','60','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['Site']['title'])); ?>
</td>
	</tr>
	<tr>
	<td class="clr">共通keywords</td>
	<td><?php echo $this->_tpl_vars['form']->input('keywords',$this->_tpl_vars['this']->aa('type','text','size','60','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['Site']['keywords'])); ?>
</td>
	</tr>
	<tr>
	<td class="clr">共通description</td>
	<td><?php echo $this->_tpl_vars['form']->input('description',$this->_tpl_vars['this']->aa('type','text','size','60','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['Site']['description'])); ?>
</td>
	</tr>
	<tr>
	<td class="clr">404エラーのパス　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/hissu_icon.jpg'); ?>
" width="40" height="19" alt="必須" /></td>
	<td><?php echo $this->_tpl_vars['form']->input('page_404error',$this->_tpl_vars['this']->aa('type','text','size','60','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['Site']['page_404error'])); ?>
</td>
	</tr>
	<tr>
	<td class="clr">準備中</td>
	<td><?php echo $this->_tpl_vars['form']->checkbox('Site.standby',$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['Site']['standby'])); ?>
</td>
	</tr>
</table>
</form>
</div>

<p id="formBtn"> <img src="<?php echo $this->_tpl_vars['html']->webroot('images/touroku_btn.jpg'); ?>
" width="93" height="27" alt="更　新" style="cursor: pointer" onclick="document.Site.submit();" />
</p>

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