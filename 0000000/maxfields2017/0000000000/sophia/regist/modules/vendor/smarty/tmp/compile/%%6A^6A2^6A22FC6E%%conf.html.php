<?php /* Smarty version 2.6.27, created on 2016-06-09 18:01:49
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/sophia/regist/modules/tpl/conf.html */ ?>
<?php 
define('PAGE_TITLE', '登録申込 | 株式会社マックスフィールズ');
define('PAGE_DESCRIPTION', '派遣アウトソーシング、コンサルティングはマックスフィールズグループ。貴社の競争優位を、再生、成長、新事業進出でグループ一貫でサポート。');
define('BODY_CLASS', 'regist');

include('../include/header.php');
 ?>

<script>
$(function(){
	$("#inputZip").zip2addr("#inputAddr");
});
</script>

<!-- コンテント -->
<div id="topicpath">
	<ol>
		<li><a href="../">ホーム</a></li>
		<li>登録申込</li>
	</ol>
</div>
<!-- コンテント(SP用) -->
<div id="topicpath_sp">
	<ol>
		<li><a href="../">ホーム</a></li>
		<li>登録申込</li>
	</ol>
</div>

<!-- コンテント -->
<div id="contentWrap">

	<div id="contentMain">

		<div class="contentBox">

			<div class="mainHeader">
				<h2>
					<img src="img/title.gif" alt="Registration">
					<span>登録申込</span>
				</h2>
			</div>

			<p class="contactStep"><img src="img/step2.gif" alt="STEP2 確認画面" height="38" width="620"></p>

			<p class="contactNotes">以下の内容でよろしければ、［送信する］をクリックしてください</p>

			<div class="formreg">
				<dl>
					<dt>氏名（漢字）</dt>
					<dd><?php echo $this->_tpl_vars['conf']['name']; ?>
&nbsp;</dd>
					<dt>氏名（フリガナ）</dt>
					<dd><?php echo $this->_tpl_vars['conf']['kana']; ?>
&nbsp;</dd>
					<dt>年齢</dt>
					<dd><?php echo $this->_tpl_vars['conf']['age']; ?>
&nbsp;</dd>
					<dt>性別</dt>
					<dd><?php echo $this->_tpl_vars['conf']['sex']; ?>
&nbsp;</dd>
					<dt>連絡先</dt>
					<dd><?php echo $this->_tpl_vars['conf']['tel']; ?>
&nbsp;</dd>
					<dt>お住まい</dt>
					<dd>郵便番号<?php echo $this->_tpl_vars['conf']['zip']; ?>
&nbsp;<br />
					<?php echo $this->_tpl_vars['conf']['address']; ?>
&nbsp;</dd>
					<dt>就業開始可能日</dt>
					<dd><?php echo $this->_tpl_vars['conf']['start_date']; ?>
&nbsp;</dd>
					<dt>通勤手段</dt>
					<dd><?php echo $this->_tpl_vars['conf']['commute']; ?>
&nbsp;</dd>
					<dt>現状</dt>
					<dd><?php echo $this->_tpl_vars['conf']['status_work']; ?>
&nbsp;</dd>
					<dt>メールアドレス</dt>
					<dd><?php echo $this->_tpl_vars['conf']['email']; ?>
&nbsp;</dd>
				</dl>
			</diV><!--/.formTable-->
			<div class="formBtnWrap">
                <form name="form2" method="post" action="./">
                    <input type="hidden" name="m" value="3" />
                    <?php if ($this->_tpl_vars['job_data']): ?>
                    <input type="hidden" name="d" value="<?php echo $this->_tpl_vars['job_data']['id']; ?>
" />
                    <?php endif; ?>
					<input type="submit" class="formBtn" value="戻る">
				</form>
                <form name="form1" method="post" action="./">
                    <input type="hidden" name="m" value="4" />
                    <input type="hidden" name="_token" value="<?php echo $this->_tpl_vars['_token']; ?>
" />
					<input type="submit" class="formBtn" value="送信する">
				</form>
			</div><!--/.formBtn-->

		</div><!--/.contentBox-->

	</div><!--/#contentMain-->

	<!-- サイドバーエリア -->
	<?php include('../include/sidebar.php'); ?>

</div><!--/#contentWrap-->

<?php include('../include/footer.php'); ?>