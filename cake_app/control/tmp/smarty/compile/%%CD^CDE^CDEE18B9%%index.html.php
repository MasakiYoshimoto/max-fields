<?php /* Smarty version 2.6.27, created on 2018-09-07 17:24:22
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job2/views/job2_offers//index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job2/views/job2_offers//index.html', 80, false),array('modifier', 'mb_truncate', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job2/views/job2_offers//index.html', 80, false),array('modifier', 'yen', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job2/views/job2_offers//index.html', 80, false),array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job2/views/job2_offers//index.html', 80, false),array('modifier', 'd_format', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job2/views/job2_offers//index.html', 81, false),)), $this); ?>
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
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/curvycorner/jquery.curvycorners.packed.js'); ?>
"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/jquery.page-scroller-307.js'); ?>
"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/common.js'); ?>
"></script>
<script type="text/javascript">
	function offer_edit(id) {
		document.edit.elements['data[Job2Offer][id]'].value = id;
		document.edit.submit();
	}

	function offer_del(id) {
		if(confirm('このデータを削除してもよろしいですか？')) {
			document.del.elements['data[Job2Offer][id]'].value = id;
			document.del.submit();
		}
	}
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
<h2>求人案件</h2>
<div id="content-inner">

<div class="cont">
<p>新規作成・編集ボタンを押して作業を行って下さい。</p>
</div>

<div class="cont"> <img src="<?php echo $this->_tpl_vars['html']->webroot('images/new_btn.jpg'); ?>
" width="93" height="27" alt="新規作成" id="newBtn" style="cursor: pointer" onclick="document.add.submit( );" />
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="head">
            <td width="69%">職場・企業キャッチコピー　</td>
            <td width="15%">登録日</td>
            <td width="16%">編集・削除</td>
        </tr>
        <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['list']['iteration']++;
?>
        <tr>
            <td <?php if ($this->_tpl_vars['value']['Job2Offer']['disable']): ?>bgcolor="#d3d3d3"<?php elseif ($this->_tpl_vars['value']['Job2Offer']['status'] == 1): ?>bgcolor="#ccffcc"<?php elseif ($this->_tpl_vars['value']['Job2Offer']['status'] == 2): ?>bgcolor="#ffcccc"<?php endif; ?>><?php if ($this->_tpl_vars['value']['Job2Offer']['company']): ?>&lt;<?php echo $this->_tpl_vars['value']['Job2Offer']['company']; ?>
&gt;<?php endif; ?><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Job2Offer']['catchcopy'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)))) ? $this->_run_mod_handler('mb_truncate', true, $_tmp, 40) : smarty_modifier_mb_truncate($_tmp, 40)))) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
            <td <?php if ($this->_tpl_vars['value']['Job2Offer']['disable']): ?>bgcolor="#d3d3d3"<?php elseif ($this->_tpl_vars['value']['Job2Offer']['status'] == 1): ?>bgcolor="#ccffcc"<?php elseif ($this->_tpl_vars['value']['Job2Offer']['status'] == 2): ?>bgcolor="#ffcccc"<?php endif; ?>><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value']['Job2Offer']['reg_date'])) ? $this->_run_mod_handler('d_format', true, $_tmp, 'Y/m/d') : smarty_modifier_d_format($_tmp, 'Y/m/d')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
</td>
            <td <?php if ($this->_tpl_vars['value']['Job2Offer']['disable']): ?>bgcolor="#d3d3d3"<?php elseif ($this->_tpl_vars['value']['Job2Offer']['status'] == 1): ?>bgcolor="#ccffcc"<?php elseif ($this->_tpl_vars['value']['Job2Offer']['status'] == 2): ?>bgcolor="#ffcccc"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['html']->webroot('images/edit_icon.jpg'); ?>
" width="40" height="19" alt="編集"  style="cursor: pointer" onclick="offer_edit( <?php echo $this->_tpl_vars['value']['Job2Offer']['id']; ?>
 );" />&nbsp;<img src="<?php echo $this->_tpl_vars['html']->webroot('images/delete_icon.jpg'); ?>
" width="40" height="19" alt="削除"  style="cursor: pointer" onclick="offer_del( <?php echo $this->_tpl_vars['value']['Job2Offer']['id']; ?>
 );" /></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
</table>
</div>

<?php if ($this->_tpl_vars['paginator']->counter("%pages%") > 1): ?>
<ul id="pageNavi">
<?php $_from = $this->_tpl_vars['pagelist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
<li><?php if ($this->_tpl_vars['paginator']->counter("%page%") != $this->_tpl_vars['value']['page']): ?><a href="<?php echo $this->_tpl_vars['html']->webroot(''); ?>
job2/job2_offers/index/page:<?php echo $this->_tpl_vars['value']['page']; ?>
"><?php echo $this->_tpl_vars['value']['page']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['value']['page']; ?>
<?php endif; ?></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>

</div>
</div>
<?php echo $this->_tpl_vars['form']->create('Job2Offer',$this->_tpl_vars['this']->aa('action','/add','name','add')); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Job2Offer',$this->_tpl_vars['this']->aa('action','/edit','name','edit')); ?>

<?php echo $this->_tpl_vars['form']->hidden('id',$this->_tpl_vars['this']->aa('value','')); ?>

</form>
<?php echo $this->_tpl_vars['form']->create('Job2Offer',$this->_tpl_vars['this']->aa('action','/del','name','del')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<?php echo $this->_tpl_vars['form']->hidden('id',$this->_tpl_vars['this']->aa('value',"")); ?>

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