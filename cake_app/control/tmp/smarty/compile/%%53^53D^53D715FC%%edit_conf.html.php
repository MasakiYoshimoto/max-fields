<?php /* Smarty version 2.6.27, created on 2018-11-11 22:15:07
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit_conf.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'yen', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit_conf.html', 74, false),array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit_conf.html', 74, false),array('modifier', 'nl2br', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit_conf.html', 78, false),array('modifier', 'string_format', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit_conf.html', 149, false),)), $this); ?>
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
<link href="<?php echo $this->_tpl_vars['html']->webroot('js/sexylightbox/sexylightbox.css'); ?>
" rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/jquery.page-scroller-307.js'); ?>
"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('js/sexylightbox/jquery.easing.1.3.js'); ?>
"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('js/sexylightbox/sexylightbox.v2.3.jquery.min.js'); ?>
"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/common.js'); ?>
"></script>
<script type="text/javascript">
	$(document).ready(function(){
		SexyLightbox.initialize({color:'black', dir: '<?php echo $this->_tpl_vars['html']->webroot("js/sexylightbox/images"); ?>
'});
		<?php if (! $this->_tpl_vars['use_fulledit']): ?>$('#input_contents a').attr('target','_blank');<?php endif; ?>
	});
</script>
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
<h3>確認画面</h3>
<p>内容を確認して登録ボタンを押して下さい。</p>
</div>

<div class="cont">
<?php echo $this->_tpl_vars['form']->create('Cmsdocument',$this->_tpl_vars['this']->aa('action','/editdo','name','conf')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('mode',$this->_tpl_vars['this']->aa('value','add')); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="28%" class="clr">ID</td>
		<td width="72%"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['d_id'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
	</tr>
	<tr>
		<td class="clr">タイトル</td>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['title'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
　</td>
	</tr>
	<?php if ($this->_tpl_vars['use_rss'] == 1): ?>
	<tr>
		<td class="clr">内容の説明</td>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['explanation'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
　</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td class="clr">公開/非公開</td>
		<td><?php if ($this->_tpl_vars['input']['disable'] != 1): ?>公開<?php else: ?>非公開<?php endif; ?>　</td>
	</tr>
	<?php if ($this->_tpl_vars['use_period'] == 1): ?>
	<tr>
		<td class="clr">公開期間設定</td>
		<td><?php if ($this->_tpl_vars['input']['period'] == 1): ?>設定<?php else: ?>未設定<?php endif; ?>　</td>
	</tr>
	<?php if ($this->_tpl_vars['input']['period'] == 1): ?>
	<tr>
		<td class="clr">公開開始日</td>
		<td><?php echo $this->_tpl_vars['input']['start_date']; ?>
　</td>
	</tr>
	<tr>
		<td class="clr">公開終了日</td>
		<td><?php echo $this->_tpl_vars['input']['end_date']; ?>
　</td>
	</tr>
	<?php endif; ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['use_category'] == 1): ?>
	<tr>
		<td class="clr">カテゴリー</td>
		<td><?php echo $this->_tpl_vars['input']['category_string']; ?>
　</td>
	</tr>
	<?php endif; ?>
<?php if ($this->_tpl_vars['use_link'] == 1): ?>
	<tr>
		<td class="clr">ダイレクトリンク</td>
		<td>
			<?php if ($this->_tpl_vars['input']['directlink_flag'] == 'url'): ?><A href="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['directlink_url'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
" target="_blank"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['directlink'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</a><?php endif; ?>
			<?php if ($this->_tpl_vars['input']['directlink_flag'] == 'file'): ?>
				<?php if ($this->_tpl_vars['use_filemanager']): ?>
					<A href="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['directlink'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
" target="_blank">ファイルを確認する</a>
				<?php else: ?>
					<A href="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['directlink']['input_value2'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
" target="_blank">ファイルを確認する</a>
				<?php endif; ?>
			<?php endif; ?>
		</td>
	</tr>
<?php endif; ?>
	<?php $_from = $this->_tpl_vars['itemdata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<tr>
		<td class="clr"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['name'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
		<td>
			<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 3 && $this->_tpl_vars['value']['Cmsitem']['input_value']): ?>
			<table style="border: none;"><tr><td style="border: none;"><A href="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['input_value'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
" rel="sexylightbox" target="_blank"><img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['input_value'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
" border="0"  width="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['w'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
" height="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['h'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
"></a></td><td width="5%"  style="border: none;"></td><td  style="border: none;"><span class="redTxt">※左のサムネイル画像をクリックされますと、<br/>実際の画像が表示、確認できます。</span></td></tr></table>
			<?php elseif ($this->_tpl_vars['value']['Cmsitem']['type'] == 4 && $this->_tpl_vars['value']['Cmsitem']['input_value']): ?>
			<A href="<?php echo $this->_tpl_vars['value']['Cmsitem']['input_value']; ?>
" target="_blank">ファイルを確認する</a>
			<?php elseif ($this->_tpl_vars['value']['Cmsitem']['type'] == 2): ?>
				<?php if ($this->_tpl_vars['use_fulledit']): ?>
				<iframe src="<?php echo $this->_tpl_vars['html']->webroot('cmsdocuments/preview/'); ?>
n:<?php echo $this->_tpl_vars['value']['Cmsitem']['variable_name']; ?>
" height="100" width="480" border="0" style="border:none;" frameborder="0" id="preview"></iframe>
				<?php else: ?>
				<div id="input_contents"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['outputtext'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)); ?>
</div>
				<?php endif; ?>
			<?php else: ?>
			<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['input_value'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 1): ?>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['unit'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
<?php endif; ?>
			<?php endif; ?>&nbsp;
	</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td class="clr">作成日時</td>
		<td><?php echo $this->_tpl_vars['input']['createdate']; ?>
　<?php echo ((is_array($_tmp=$this->_tpl_vars['input']['create_h'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%02d") : smarty_modifier_string_format($_tmp, "%02d")); ?>
:<?php echo ((is_array($_tmp=$this->_tpl_vars['input']['create_m'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%02d") : smarty_modifier_string_format($_tmp, "%02d")); ?>
:<?php echo ((is_array($_tmp=$this->_tpl_vars['input']['create_s'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%02d") : smarty_modifier_string_format($_tmp, "%02d")); ?>
</td>
	</tr>
</table>
</form>
<?php echo $this->_tpl_vars['form']->create('Cmsdocument',$this->_tpl_vars['this']->aa('action','/editdo','name','doc_return')); ?>

<?php echo $this->_tpl_vars['form']->hidden('mode',$this->_tpl_vars['this']->aa('value','edit')); ?>

</form>
</div>

<p id="formBtn"><img src="<?php echo $this->_tpl_vars['html']->webroot('images/touroku_btn.jpg'); ?>
" width="93" height="27" alt="登録" style="cursor: pointer" onclick="document.conf.submit();" /> 　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/modoru_btn.jpg'); ?>
" width="93" height="27" alt="戻る" style="cursor: pointer" onclick="document_return();" /> </p>

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