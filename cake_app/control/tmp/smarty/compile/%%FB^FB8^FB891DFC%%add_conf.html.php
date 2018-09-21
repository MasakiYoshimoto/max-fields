<?php /* Smarty version 2.6.27, created on 2015-10-05 18:28:41
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job/views/job_offers//add_conf.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'yen', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job/views/job_offers//add_conf.html', 76, false),array('modifier', 'escape', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job/views/job_offers//add_conf.html', 76, false),array('modifier', 'nl2br', '/var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job/views/job_offers//add_conf.html', 76, false),)), $this); ?>
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
<link href="<?php echo $this->_tpl_vars['html']->webroot('js/sexylightbox/sexylightbox.css'); ?>
" rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/curvycorner/jquery.curvycorners.packed.js'); ?>
"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/jquery.page-scroller-307.js'); ?>
"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('js/sexylightbox/jquery.easing.1.3.js'); ?>
"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('js/sexylightbox/sexylightbox.v2.3.jquery.min.js'); ?>
"></script>
<script type="text/javascript">
	$(document).ready(function(){
		SexyLightbox.initialize({color:'black', dir: '<?php echo $this->_tpl_vars['html']->webroot("js/sexylightbox/images"); ?>
'});
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
<h2>My job is 求人案件</h2>
<div id="content-inner">

<div class="cont">
<h3>確認画面</h3>
<p>内容を確認して登録ボタンを押して下さい。
</p>
</div>

<div class="cont">
<?php echo $this->_tpl_vars['form']->create('JobOffer',$this->_tpl_vars['this']->aa('action','/adddo','name','job_offers','Autocomplete','off')); ?>

<?php echo $this->_tpl_vars['form']->hidden('mode',$this->_tpl_vars['this']->aa('value','add')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="28%" class="clr">職場・企業キャッチコピー</td>
        <td width="72%"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['catchcopy'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</td>
    </tr>
    <tr>
        <td width="28%" class="clr">非公開</td>
        <td width="72%"><?php if ($this->_tpl_vars['input']['disable']): ?>非公開<?php else: ?>公開<?php endif; ?></td>
    </tr>
    <tr>
        <td width="28%" class="clr">予定勤務地</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['location'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">仕事内容・職場紹介</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['work'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">必要な経験能力</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['require_ability'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">学歴資格</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['educational_background'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">賃金形態</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['wages_type'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">就業形態</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['work_type'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">休日</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['holiday'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">事業内容</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['project_contents'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">待遇</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['treatment'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">選考内容</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['selection'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">備考</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['etc'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">登録日</td>
        <td width="72%"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['reg_date'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
&nbsp;</td>
    </tr>
    <tr>
        <td width="28%" class="clr">公開開始日</td>
        <td width="72%"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['open_date'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
&nbsp;</td>
    </tr>
    <tr>
        <td width="28%" class="clr">公開終了日</td>
        <td width="72%"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['end_date'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')); ?>
&nbsp;</td>
    </tr>
    <tr>
        <td class="clr" colspan="2" align="center">募集職種</td>
    </tr>
    <tr>
        <td width="28%" class="clr">飲食/フード系</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['category1'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">販売/ショップ系</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['category2'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">宅配デリバリー系</td>
        <td width="72%">
            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['input']['category3'])) ? $this->_run_mod_handler('yen', true, $_tmp) : smarty_modifier_yen($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'utf-8') : smarty_modifier_escape($_tmp, 'html', 'utf-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
        </td>
    </tr>
</table>
</form>
<?php echo $this->_tpl_vars['form']->create('JobOffer',$this->_tpl_vars['this']->aa('action','/adddo','name','doc_return')); ?>

<?php echo $this->_tpl_vars['form']->hidden('mode',$this->_tpl_vars['this']->aa('value','edit')); ?>

</form>
</div>

<p id="formBtn"> <img src="<?php echo $this->_tpl_vars['html']->webroot('images/touroku_btn.jpg'); ?>
" width="93" height="27" alt="登　録" style="cursor: pointer" onclick="document.job_offers.submit();" /> 　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/modoru_btn.jpg'); ?>
" width="93" height="27" alt="戻る" style="cursor: pointer" onclick="document_return();" />
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