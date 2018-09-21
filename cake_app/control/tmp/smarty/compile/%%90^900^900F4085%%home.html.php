<?php /* Smarty version 2.6.27, created on 2018-09-05 17:27:34
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/cake_app/control/views/pages//home.html */ ?>
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

<script type="text/javascript">
	$(document).ready(function(){
		$("#login").bind("click", function(){document.loginform.submit();});
	});
</script>
</head>


<body>


<div id="mainArea">
<?php echo $this->_tpl_vars['form']->create('User',$this->_tpl_vars['this']->aa('action','/login','name','loginform')); ?>

<?php echo $this->_tpl_vars['form']->hidden('_token',$this->_tpl_vars['this']->aa('value',$this->_tpl_vars['token'])); ?>

<p id="mainTitle">サイト管理画面 / ログイン</p>

<dl class="nyuroku">
<dt>ユーザID：</dt>
<dd><?php echo $this->_tpl_vars['form']->input('username',$this->_tpl_vars['this']->aa('type','text','label','false','div','false','id','textfield','value',$this->_tpl_vars['username'])); ?>
</dd>
<br />
<dt>パスワード：</dt>
<dd><?php echo $this->_tpl_vars['form']->input('password',$this->_tpl_vars['this']->aa('type','password','label','false','div','false','id','textfield','value',$this->_tpl_vars['password'])); ?>
</dd>
</dl>
<?php echo $this->_tpl_vars['form']->checkbox('User.save',$this->_tpl_vars['this']->aa('value','1','checked',$this->_tpl_vars['save'])); ?>

<span class="smallTxt">ログイン情報を保存</span>
<br />
<br />
<img src="images/login_btn.jpg" id="login" width="93" height="27" alt="ログイン" style="cursor: pointer" /></form></div>

</body>
</html>