<?php /* Smarty version 2.6.27, created on 2018-08-09 12:51:38
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/plugins/job/views/job_offers//add.html */ ?>
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
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
google.load("jquery","1.3.1");
</script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/common.js'); ?>
"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/lightbox/jquery.lightbox-0.5.js'); ?>
"></script>
<link href="<?php echo $this->_tpl_vars['html']->webroot('js/lightbox/jquery.lightbox-0.5.css'); ?>
" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/curvycorner/jquery.curvycorners.packed.js'); ?>
"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('js/jquery.page-scroller-307.js'); ?>
"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('jquery-ui-1.8.7.custom/js/jquery-ui-1.8.7.custom.min.js'); ?>
"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('jquery-ui-1.8.7.custom/development-bundle/ui/i18n/jquery.ui.datepicker-ja.js'); ?>
"></script>
<link href="<?php echo $this->_tpl_vars['html']->webroot('jquery-ui-1.8.7.custom/css/custom-theme/jquery-ui-1.8.7.custom.css'); ?>
" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['html']->webroot('jscripts/tiny_mce/tiny_mce.js'); ?>
"></script>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

	jQuery(document).ready(function($){
		// datepicker
		if($.fn.datepicker){
			$('.datepicker').datepicker($.datepicker.regional['ja']);
		}
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
<h3>登録画面</h3>
<p>入力後、確認ボタンを押して下さい。</p>
</div>

<div class="cont"><p><a href="<?php echo $this->_tpl_vars['html']->webroot('/job/job_offers/index/'); ?>
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
<?php echo $this->_tpl_vars['form']->create('JobOffer',$this->_tpl_vars['this']->aa('action','/adddo','name','job_offers','Autocomplete','off','enctype','multipart/form-data')); ?>

<?php echo $this->_tpl_vars['form']->hidden('mode',$this->_tpl_vars['this']->aa('value','confirm')); ?>

<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $this->_tpl_vars['max_file_size']; ?>
">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="28%" class="clr">職場・企業キャッチコピー　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/hissu_icon.jpg'); ?>
" width="40" height="19" alt="必須" /></td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->input('catchcopy',$this->_tpl_vars['this']->aa('type','text','size','50','label','false','div','false','error','false','id','catchcopy','value',$this->_tpl_vars['input']['catchcopy'])); ?>

            <div><span class="redTxt">50文字まで入力出来ます。</span></div>
        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">非公開</td>
        <td width="72%"><?php echo $this->_tpl_vars['form']->checkbox('JobOffer.disable',$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['input']['disable'])); ?>
</td>
    </tr>
    <tr>
        <td width="28%" class="clr">予定勤務地　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/hissu_icon.jpg'); ?>
" width="40" height="19" alt="必須" /></td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->select('JobOffer.location',$this->_tpl_vars['job_area_list'],$this->_tpl_vars['input']['location'],null,false); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">仕事内容・職場紹介　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/hissu_icon.jpg'); ?>
" width="40" height="19" alt="必須" /></td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('work',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['work'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">必要な経験能力</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('require_ability',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['require_ability'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">学歴資格</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('educational_background',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['educational_background'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">賃金形態</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('wages_type',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['wages_type'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">就業形態</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('work_type',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['work_type'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">休日</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('holiday',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['holiday'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">事業内容</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('project_contents',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['project_contents'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">待遇</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('treatment',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['treatment'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">選考内容</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('selection',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['selection'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">備考</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->textarea('etc',$this->_tpl_vars['this']->aa('rows','5','cols','50','value',$this->_tpl_vars['input']['etc'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">登録日　<img src="<?php echo $this->_tpl_vars['html']->webroot('images/hissu_icon.jpg'); ?>
" width="40" height="19" alt="必須" /></td>
        <td width="72%"><?php echo $this->_tpl_vars['form']->input('reg_date',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','class','datepicker','id','reg_date','value',$this->_tpl_vars['input']['reg_date'])); ?>
</td>
    </tr>
    <tr>
        <td width="28%" class="clr">公開開始日</td>
        <td width="72%"><?php echo $this->_tpl_vars['form']->input('open_date',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','class','datepicker','id','open_date','value',$this->_tpl_vars['input']['open_date'])); ?>
</td>
    </tr>
    <tr>
        <td width="28%" class="clr">公開終了日</td>
        <td width="72%"><?php echo $this->_tpl_vars['form']->input('end_date',$this->_tpl_vars['this']->aa('type','text','size','40','label','false','div','false','error','false','class','datepicker','id','end_date','value',$this->_tpl_vars['input']['end_date'])); ?>
</td>
    </tr>
    <tr>
        <td class="clr" colspan="2" align="center">募集職種<img src="<?php echo $this->_tpl_vars['html']->webroot('images/hissu_icon.jpg'); ?>
" width="40" height="19" alt="必須" /></td>
    </tr>
    <tr>
        <td width="28%" class="clr">飲食/フード系</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->input('JobOffer.category1',$this->_tpl_vars['this']->aa('multiple','checkbox','type','select','style','checkbox','label','false','div','false','error','false','options',$this->_tpl_vars['job_category_list'][10000],'selected',$this->_tpl_vars['input']['category1'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">販売/ショップ系</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->input('JobOffer.category2',$this->_tpl_vars['this']->aa('multiple','checkbox','type','select','style','checkbox','label','false','div','false','error','false','options',$this->_tpl_vars['job_category_list'][11000],'selected',$this->_tpl_vars['input']['category2'])); ?>

        </td>
    </tr>
    <tr>
        <td width="28%" class="clr">宅配デリバリー系</td>
        <td width="72%">
            <?php echo $this->_tpl_vars['form']->input('JobOffer.category3',$this->_tpl_vars['this']->aa('multiple','checkbox','type','select','style','checkbox','label','false','div','false','error','false','options',$this->_tpl_vars['job_category_list'][12000],'selected',$this->_tpl_vars['input']['category3'])); ?>

        </td>
    </tr>
</table>
</form>
</div>

<p id="formBtn"> <img src="<?php echo $this->_tpl_vars['html']->webroot('images/check_btn.jpg'); ?>
" width="93" height="27" alt="登　録" style="cursor: pointer" onclick="document.job_offers.submit();" />
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