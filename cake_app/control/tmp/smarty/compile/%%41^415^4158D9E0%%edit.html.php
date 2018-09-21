<?php /* Smarty version 2.6.27, created on 2015-09-02 10:50:28
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'preg_replace', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit.html', 40, false),array('modifier', 'yen', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit.html', 182, false),array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit.html', 314, false),array('modifier', 'nl2br', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/cmsdocuments//edit.html', 355, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css; charset=UTF-8" />
<meta http-equiv="content-script-type" content="text/javascript" />
<title>管理画面</title>
<link href="<?php echo $this->_tpl_vars['html']->webroot('css/common2.css'); ?>
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

<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('jquery-ui-1.8.7.custom/js/jquery-ui-1.8.7.custom.min.js'); ?>
"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('jquery-ui-1.8.7.custom/development-bundle/ui/i18n/jquery.ui.datepicker-ja.js'); ?>
"></script>
<link href="<?php echo $this->_tpl_vars['html']->webroot('jquery-ui-1.8.7.custom/css/custom-theme/jquery-ui-1.8.7.custom.css'); ?>
" rel="stylesheet" type="text/css" />
<?php if (! $this->_tpl_vars['use_tinymce'] || $this->_tpl_vars['use_fulledit']): ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/ckeditor/ckeditor.js'); ?>
"></script>
<?php else: ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/tiny_mce/tiny_mce.js'); ?>
"></script>
<?php endif; ?>
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
<script language=javascript>
	<!--

	jQuery(document).ready(function(){
		SexyLightbox.initialize({color:'black', dir: '<?php echo $this->_tpl_vars['html']->webroot("js/sexylightbox/images"); ?>
'});

		$('#preview_btn').click(function() {
			$('#doc').attr('action','<?php echo $this->_tpl_vars['view_site']; ?>
<?php echo ((is_array($_tmp="@^/@")) ? $this->_run_mod_handler('preg_replace', true, $_tmp, "", $this->_tpl_vars['preview_page']) : preg_replace($_tmp, "", $this->_tpl_vars['preview_page'])); ?>
?pre=1');
			$('#doc').attr('target','_blank');
			$('#doc').submit();

			$('#doc').attr('action','<?php echo $this->_tpl_vars['html']->webroot("cmsdocuments/editdo"); ?>
');
			$('#doc').attr('enctype','multipart/form-data');
			$('#doc').removeAttr('target','_blank');

			return false;
		});
	});

<?php if ($this->_tpl_vars['use_period'] == 1): ?>
	jQuery(document).ready(function($){
		// datepicker
		if($.fn.datepicker){
			$('.datepicker').datepicker($.datepicker.regional['ja']);
		}
		$('#CmsdocumentPeriod').click(function () {
			$('.date_box').toggle();
		});
	});
<?php endif; ?>
<?php if ($this->_tpl_vars['use_fulledit'] == 1): ?>

		CKEDITOR.config.extraPlugins = 'youtube,MediaEmbed';

		CKEDITOR.config.toolbar = [
			['Cut','Copy','Paste','PasteText']
			,['Undo','Redo','-','SelectAll','RemoveFormat']
			,['Bold','Italic','Underline','Strike','-','Subscript','Superscript']
			,'/'
			,['Format','FontSize']
			,['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']
			,['TextColor','BGColor']
			,['Link','Unlink']
			,'/'
			,['Image','Table','HorizontalRule','SpecialChar']
			,['Youtube','MediaEmbed']
			,['ShowBlocks']
			,['Source']
			,['Maximize']
		];

		CKEDITOR.config.filebrowserBrowseUrl = '<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/browse.php?type=files';
		CKEDITOR.config.filebrowserImageBrowseUrl = '<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/browse.php?type=images';
		CKEDITOR.config.filebrowserFlashBrowseUrl = '<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/browse.php?type=flash';
		CKEDITOR.config.filebrowserUploadUrl = '<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/upload.php?type=files';
		CKEDITOR.config.filebrowserImageUploadUrl = '<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/upload.php?type=images';
		CKEDITOR.config.filebrowserFlashUploadUrl = '<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/upload.php?type=flash';

		CKEDITOR.config.resize_enabled = false;

		CKEDITOR.config.image_previewText = ' ';

		// テキストエリアの幅
		CKEDITOR.config.width  = '460px';
		// テキストエリアの高さ
		CKEDITOR.config.height = '400px';

		function openKCFinder_singleFile(id) {
			window.KCFinder = {};
			window.KCFinder.callBack = function(url) {
				window.KCFinder = null;
				$(id).val(url);
				};
			window.open('<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/browse.php?type=files&langCode=ja', 'kcfinder_single','menubar=no,location=no,toolbar=no');
		}

		function openKCFinder_singleImage(id) {
			window.KCFinder = {};
			window.KCFinder.callBack = function(url) {
				window.KCFinder = null;
				$(id).val(url);
				};
			window.open('<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/browse.php?type=images&langCode=ja', 'kcfinder_single','menubar=no,location=no,toolbar=no');
		}
<?php else: ?>
	<?php if ($this->_tpl_vars['use_tinymce']): ?>
		tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
			editor_selector : "mceEditor",
			plugins:"paste",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_buttons1 : "undo,redo,pastetext,separator,bold,italic,underline,separator,fontsizeselect,forecolor,backcolor,separator,link,unlink,removeformat",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			force_br_newlines : true,
			forced_root_block : false,
			force_p_newlines : false,
			nowrap : false,
			apply_source_formatting : false,
			language : "ja"
		});
	<?php else: ?>
		CKEDITOR.config.toolbar = [
		['Cut','Copy','Paste','PasteText']
		,['Undo','Redo','-','SelectAll','RemoveFormat']
		,['Bold','Italic','Underline']
		,['FontSize']
		,['TextColor','BGColor']
		,'/'
		,['Link','Unlink']
		,['Maximize']
		];

		CKEDITOR.config.resize_enabled = false;

		CKEDITOR.config.image_previewText = ' ';

		// テキストエリアの幅
		CKEDITOR.config.width  = '460px';
		// テキストエリアの高さ
		CKEDITOR.config.height = '400px';

		function openKCFinder_singleFile(id) {
			window.KCFinder = {};
			window.KCFinder.callBack = function(url) {
				window.KCFinder = null;
				$(id).val(url);
				};
			window.open('<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/browse.php?type=files&langCode=ja', 'kcfinder_single','menubar=no,location=no,toolbar=no');
		}

		function openKCFinder_singleImage(id) {
			window.KCFinder = {};
			window.KCFinder.callBack = function(url) {
				window.KCFinder = null;
				$(id).val(url);
				};
			window.open('<?php echo $this->_tpl_vars['html']->webroot(''); ?>
jscripts/kcfinder/browse.php?type=images&langCode=ja', 'kcfinder_single','menubar=no,location=no,toolbar=no');
		}
	<?php endif; ?>
<?php endif; ?>
	// -->
</script>
</head>


<body>
<?php $this->assign('title', ((is_array($_tmp=$this->_tpl_vars['input']['title'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp))); ?>
<?php $this->assign('explanation', ((is_array($_tmp=$this->_tpl_vars['input']['explanation'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp))); ?>
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
<h3>編集画面</h3>
<p>入力後、確認ボタンを押して下さい。</p>
</div>

<div class="cont"><p><a href="<?php echo $this->_tpl_vars['html']->webroot('cmsdocuments'); ?>
" id="viewAll">一覧へ戻る</a></p>
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
<?php echo $this->_tpl_vars['form']->create('Cmsdocument',$this->_tpl_vars['this']->aa('action','/editdo','name','doc','id','doc','enctype','multipart/form-data')); ?>

<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $this->_tpl_vars['max_file_size']; ?>
">
<?php echo $this->_tpl_vars['form']->hidden('mode',$this->_tpl_vars['this']->aa('value','confirm')); ?>

<?php if ($this->_tpl_vars['use_rss'] != 1): ?>
<?php echo $this->_tpl_vars['form']->hidden('explanation',$this->_tpl_vars['this']->aa('value','')); ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['use_period'] != 1): ?>
<?php echo $this->_tpl_vars['form']->hidden('period',$this->_tpl_vars['this']->aa('value','0')); ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['use_category'] != 1): ?>
<?php echo $this->_tpl_vars['form']->hidden('use_category',$this->_tpl_vars['this']->aa('value','0')); ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['use_link'] != 1): ?>
<?php echo $this->_tpl_vars['form']->hidden('directlink',$this->_tpl_vars['this']->aa('value','')); ?>

<?php echo $this->_tpl_vars['form']->hidden('directlink2',$this->_tpl_vars['this']->aa('value','')); ?>

<?php endif; ?>
<?php echo $this->_tpl_vars['form']->hidden('start_date',$this->_tpl_vars['this']->aa('id','hidden_start_date','value','')); ?>

<?php echo $this->_tpl_vars['form']->hidden('end_date',$this->_tpl_vars['this']->aa('id','hidden_end_date','value','')); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cont_table">
	<tr>
		<td width="28%" class="clr cont_td">ID</td>
		<td width="72%" class="cont_td"><?php echo $this->_tpl_vars['d_id']; ?>
&nbsp;</td>
	</tr>
	<tr>
		<td class="clr cont_td">タイトル　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/hissu_icon.jpg'); ?>
" width="40" height="19" alt="必須" /></td>
		<td class="cont_td">
			<?php echo $this->_tpl_vars['form']->input('title',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['title'])); ?>
<br />
			<span class="redTxt"><?php echo $this->_tpl_vars['title_max']; ?>
文字以下でご入力下さい。</span>
		</td>
	</tr>
	<?php if ($this->_tpl_vars['use_rss'] == 1): ?>
	<tr>
		<td class="clr cont_td">内容の説明</td>
		<td class="cont_td"><?php echo $this->_tpl_vars['form']->textarea('Cmsdocument.explanation',$this->_tpl_vars['this']->aa('rows','3','cols','50','class','normaltextarea','value',$this->_tpl_vars['explanation'])); ?>
<br />
			<span class="redTxt">RSS配信では更新記事に対して「簡単な説明文」が表示されますので<br/>そのPR文が必要となります。上記にPR文をご入力下さい。<br/>未入力の場合はタイトルと同じ表示になります。</span></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td class="clr cont_td">非公開</td>
		<td class="cont_td"><?php echo $this->_tpl_vars['form']->checkbox('Cmsdocument.disable',$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['input']['disable'])); ?>
</td>
	</tr>
	<?php if ($this->_tpl_vars['use_period'] == 1): ?>
	<tr>
		<td class="clr cont_td">公開期間設定</td>
		<td class="cont_td"><?php echo $this->_tpl_vars['form']->checkbox('Cmsdocument.period',$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['input']['period'])); ?>
</td>
	</tr>
	<tr class="date_box" <?php if (! $this->_tpl_vars['input']['period'] || $this->_tpl_vars['input']['period'] == 'false'): ?>style="display:none"<?php endif; ?>>
		<td class="clr cont_td">公開開始日</td>
		<td class="cont_td"><?php echo $this->_tpl_vars['form']->input('start_date',$this->_tpl_vars['this']->aa('type','text','size','25','label','false','div','false','error','false','class','datepicker','value',$this->_tpl_vars['input']['start_date'])); ?>
</td>
	</tr>
	<tr class="date_box" <?php if (! $this->_tpl_vars['input']['period'] || $this->_tpl_vars['input']['period'] == 'false'): ?>style="display:none"<?php endif; ?>>
		<td class="clr cont_td">公開終了日</td>
		<td class="cont_td"><?php echo $this->_tpl_vars['form']->input('end_date',$this->_tpl_vars['this']->aa('type','text','size','25','label','false','div','false','error','false','class','datepicker','value',$this->_tpl_vars['input']['end_date'])); ?>
</td>
	</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['use_category'] == 1): ?>
	<tr>
		<td class="clr cont_td">カテゴリー</td>
		<td class="cont_td"><?php echo $this->_tpl_vars['form']->select('Cmsdocument.category',$this->_tpl_vars['doccategory_list'],$this->_tpl_vars['input']['category'],null,false); ?>
</td>
	</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['use_link'] == 1): ?>
	<tr>
		<td class="clr cont_td">ダイレクトリンク</td>
		<td class="cont_td">
			<p>URL：</p><?php echo $this->_tpl_vars['form']->input('directlink',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','id','title','value',$this->_tpl_vars['input']['directlink'])); ?>
<br/>
			<?php if ($this->_tpl_vars['use_filemanager'] == 1): ?>
				<p>ファイル：</p><?php echo $this->_tpl_vars['form']->input('directlink2',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','id','directlink2','value',$this->_tpl_vars['input']['directlink2'])); ?>
&nbsp;<input type="button" value="ファイル選択" onclick="openKCFinder_singleFile('#directlink2');"><?php if ($this->_tpl_vars['input']['directlink_type'] == 'file'): ?><br/><?php endif; ?>
				<?php if ($this->_tpl_vars['input']['directlink_type'] != 'file'): ?><br/><?php endif; ?>
				<span class="redTxt">リンクさせるURLもしくはファイルを選択して下さい。(URLの方が優先されます)</span>
			<?php else: ?>
				<p>ファイル：</p>
				<?php if ($this->_tpl_vars['input']['directlink_type'] == 'file'): ?><?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('del_directlink'),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['input']['del_directlink'])); ?>
　削除<br/><?php endif; ?>
				<?php echo $this->_tpl_vars['form']->input('directlink2',$this->_tpl_vars['this']->aa('type','file','size','40','label','false','div','false','error','false')); ?>
<br/>
				<?php if ($this->_tpl_vars['input']['directlink_type'] == 'file'): ?><div class="link_box"><a href="<?php echo $this->_tpl_vars['append_url']; ?>
<?php echo $this->_tpl_vars['input']['directlink2']; ?>
" target="_blank">ファイルを確認する</a></div><?php echo $this->_tpl_vars['form']->hidden($this->_tpl_vars['this']->cat('directlink_file'),$this->_tpl_vars['this']->aa('value','1')); ?>
<?php endif; ?>
				<span class="redTxt">リンクさせるURLもしくはファイルを添付して下さい。(URLの方が優先されます)<br/>Word,Excel,PowerPoint,PDFファイルをアップロード可能です。</span>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>
	<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<?php $this->assign('output', ((is_array($_tmp=$this->_tpl_vars['value']['value'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp))); ?>
	<?php $this->assign('output2', ((is_array($_tmp=$this->_tpl_vars['value']['value'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp))); ?>
	<tr>
		<td class="clr cont_td"><?php echo $this->_tpl_vars['value']['Cmsitem']['name']; ?>
<?php if ($this->_tpl_vars['value']['Cmsitem']['required'] == 1): ?>　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/hissu_icon.jpg'); ?>
" width="40" height="19" alt="必須" /><?php endif; ?></td>
		<td class="cont_td" <?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 2 && ( ! $this->_tpl_vars['use_tinymce'] || $this->_tpl_vars['use_fulledit'] )): ?>height="550"<?php endif; ?>>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 1): ?><?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','value',$this->_tpl_vars['output'])); ?>
&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['unit'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 2): ?>
		<?php if (! $this->_tpl_vars['use_tinymce'] || $this->_tpl_vars['use_fulledit']): ?>
		<?php echo $this->_tpl_vars['form']->textarea($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('class','ckeditor','rows','20','cols','50','value',$this->_tpl_vars['output2'])); ?>

		<?php else: ?>
		<?php echo $this->_tpl_vars['form']->textarea($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('class','mceEditor','rows','20','cols','50','value',$this->_tpl_vars['output2'])); ?>

		<?php endif; ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 3): ?>
		<?php if (! $this->_tpl_vars['use_filemanager']): ?>
		<?php if ($this->_tpl_vars['value']['value'] != ""): ?><div class="link_box"><a href="<?php echo $this->_tpl_vars['image_url']; ?>
<?php echo $this->_tpl_vars['value']['value']; ?>
" rel="sexylightbox" target="_blank">アップロードしたファイルを確認する</a></div><?php echo $this->_tpl_vars['form']->hidden($this->_tpl_vars['this']->cat('file_',$this->_tpl_vars['value']['Cmsitem']['variable_name']),$this->_tpl_vars['this']->aa('value','1')); ?>
<br/><?php endif; ?>
		<?php if ($this->_tpl_vars['value']['value'] != "" && $this->_tpl_vars['value']['Cmsitem']['required'] != 1): ?><?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('del_',$this->_tpl_vars['value']['Cmsitem']['variable_name']),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['value']['del'])); ?>
アップロードしたファイルを削除する<br/><br/><?php endif; ?>
		<?php if ($this->_tpl_vars['value']['value'] != ""): ?><small>別のファイルをアップロード</small><?php endif; ?>
		<?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('type','file','size','40','label','false','div','false','error','false')); ?>

		<?php else: ?>
		<?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','id',$this->_tpl_vars['value']['Cmsitem']['variable_name'],'value',$this->_tpl_vars['output'])); ?>
&nbsp;<input type="button" value="ファイル選択" onclick="openKCFinder_singleImage('#<?php echo $this->_tpl_vars['value']['Cmsitem']['variable_name']; ?>
');"><br/>
		<?php endif; ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 4): ?>
		<?php if (! $this->_tpl_vars['use_filemanager']): ?>
		<?php if ($this->_tpl_vars['value']['value'] != ""): ?><div class="link_box"><a href="<?php echo $this->_tpl_vars['append_url']; ?>
<?php echo $this->_tpl_vars['value']['value']; ?>
" target="_blank">アップロードしたファイルを確認する</a></div><?php echo $this->_tpl_vars['form']->hidden($this->_tpl_vars['this']->cat('file_',$this->_tpl_vars['value']['Cmsitem']['variable_name']),$this->_tpl_vars['this']->aa('value','1')); ?>
<br/><?php endif; ?>
		<?php if ($this->_tpl_vars['value']['value'] != "" && $this->_tpl_vars['value']['Cmsitem']['required'] != 1): ?><?php echo $this->_tpl_vars['form']->checkbox($this->_tpl_vars['this']->cat('del_',$this->_tpl_vars['value']['Cmsitem']['variable_name']),$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['value']['del'])); ?>
アップロードしたファイルを削除する<br/><br/><small>別のファイルをアップロード</small><?php endif; ?>
		<?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('type','file','size','40','label','false','div','false','error','false')); ?>

		<?php else: ?>
		<?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','id',$this->_tpl_vars['value']['Cmsitem']['variable_name'],'value',$this->_tpl_vars['output'])); ?>
&nbsp;<input type="button" value="ファイル選択" onclick="openKCFinder_singleFile('#<?php echo $this->_tpl_vars['value']['Cmsitem']['variable_name']; ?>
');"><br/>
		<?php endif; ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 5): ?>
		<?php $this->assign('array', $this->_tpl_vars['this']->ss($this->_tpl_vars['value']['Cmsitem']['values_string'])); ?>
		<?php echo $this->_tpl_vars['form']->radio($this->_tpl_vars['this']->cat('Cmsdocument.',$this->_tpl_vars['value']['Cmsitem']['variable_name']),$this->_tpl_vars['array'],$this->_tpl_vars['this']->aa('legend','false','separator','　','id','false','value',$this->_tpl_vars['value']['value'])); ?>

		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 6): ?><?php echo $this->_tpl_vars['form']->select($this->_tpl_vars['this']->cat('Cmsdocument.',$this->_tpl_vars['value']['Cmsitem']['variable_name']),$this->_tpl_vars['this']->ss($this->_tpl_vars['value']['Cmsitem']['values_string']),$this->_tpl_vars['value']['value'],null,false); ?>
<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 7): ?>
		<?php $this->assign('array', $this->_tpl_vars['this']->ss($this->_tpl_vars['value']['Cmsitem']['values_string'])); ?>
		<?php $this->assign('selecton', $this->_tpl_vars['this']->ss($this->_tpl_vars['value']['value'])); ?>
		<?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('multiple','checkbox','type','select','style','checkbox','label','false','div','false','error','false','options',$this->_tpl_vars['array'],'selected',$this->_tpl_vars['selecton'])); ?>


		<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 8): ?><?php echo $this->_tpl_vars['form']->input($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','class','datepicker','value',$this->_tpl_vars['output'])); ?>
<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 9): ?>&nbsp;<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['type'] == 10): ?><?php echo $this->_tpl_vars['form']->textarea($this->_tpl_vars['value']['Cmsitem']['variable_name'],$this->_tpl_vars['this']->aa('rows','10','cols','50','value',$this->_tpl_vars['output'])); ?>
<?php endif; ?>
		<?php if ($this->_tpl_vars['value']['Cmsitem']['explanation'] != ""): ?><?php if ($this->_tpl_vars['value']['Cmsitem']['type'] != 7): ?><br/><?php endif; ?><span class="redTxt"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Cmsitem']['explanation'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span><?php endif; ?>
		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td class="clr cont_td">作成日時</td>
		<td class="cont_td">
			<?php echo $this->_tpl_vars['form']->input('createdate',$this->_tpl_vars['this']->aa('type','text','size','25','label','false','div','false','error','false','class','datepicker','value',$this->_tpl_vars['input']['create_date'])); ?>

			<div style="margin-top: 7px;">
			<?php echo $this->_tpl_vars['form']->input('create_h',$this->_tpl_vars['this']->aa('type','text','size','2','label','false','div','false','error','false','value',$this->_tpl_vars['input']['create_h'])); ?>
&nbsp;時&nbsp;
			<?php echo $this->_tpl_vars['form']->input('create_m',$this->_tpl_vars['this']->aa('type','text','size','2','label','false','div','false','error','false','value',$this->_tpl_vars['input']['create_m'])); ?>
&nbsp;分&nbsp;
			<?php echo $this->_tpl_vars['form']->input('create_s',$this->_tpl_vars['this']->aa('type','text','size','2','label','false','div','false','error','false','value',$this->_tpl_vars['input']['create_s'])); ?>
&nbsp;秒
			</div>
		</td>
	</tr>
</table>
</form>
</div>

<p id="formBtn"> <?php if (! $this->_tpl_vars['use_filemanager']): ?><img src="<?php echo $this->_tpl_vars['html']->webroot('images/check_btn.jpg'); ?>
" width="93" height="27" alt="確認" style="cursor: pointer" onclick="document.doc.submit();" /><?php else: ?><img src="<?php echo $this->_tpl_vars['html']->webroot('images/next_btn.jpg'); ?>
" width="93" height="27" alt="次へ" style="cursor: pointer" onclick="document.doc.submit();" />　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/preview_btn.jpg'); ?>
" width="93" height="27" alt="プレビュー" style="cursor: pointer" id="preview_btn" /><?php endif; ?>
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