<?php /* Smarty version 2.6.27, created on 2017-10-11 16:59:56
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/sophia/contact/modules/tpl/conf.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', '/var/www/vhosts/evolve-max.com/httpdocs/sophia/contact/modules/tpl/conf.html', 82, false),)), $this); ?>
<?php 
define('PAGE_TITLE', 'お問い合わせ | 株式会社グローバルマックスインプルーブメンツ');
define('PAGE_DESCRIPTION', 'グローバルマックスインプルーブメンツへのお問い合わせ');
define('BODY_CLASS', 'info');

include('../include/header.php'); ?>

<script>
$(function(){
	$("#inputZip").zip2addr("#inputAddr");
});
</script>

<!-- コンテント -->
<div id="topicpath">
	<ol>
		<li><a href="../">ホーム</a></li>
		<li>お問い合わせ</li>
	</ol>
</div>


<!-- コンテント -->
<div id="contentWrap">

	<div id="contentMain">

		<div class="contentBox">

			<div class="mainHeader">
				<h2>
					<img src="img/title_icon.gif" alt="contact" width="152" height="124">
					<span>お問い合わせ</span>
				</h2>
			</div>

			<p class="contactStep"><img src="img/step2.gif" alt="STEP2 確認画面" height="38" width="600"></p>

			<p class="contactNotes">以下の内容でよろしければ、［送信する］をクリックしてください</p>

			<div class="formTable">
				<table>
					<tbody>
						<tr>
							<th>会社名</th>
							<td><?php echo $this->_tpl_vars['conf']['company']; ?>
&nbsp;</td>
						</tr>
						<tr>
							<th>お名前</th>
							<td><?php echo $this->_tpl_vars['conf']['name']; ?>
&nbsp;</td>
						</tr>
						<tr>
							<th>ふりがな</th>
							<td><?php echo $this->_tpl_vars['conf']['kana']; ?>
&nbsp;</td>
						</tr>
						<tr>
							<th>電話番号</th>
							<td><?php echo $this->_tpl_vars['conf']['tel']; ?>
&nbsp;</td>
						</tr>
						<tr>
							<th>FAX番号</th>
							<td><?php echo $this->_tpl_vars['conf']['fax']; ?>
&nbsp;</td>
						</tr>
						<tr>
							<th>郵便番号</th>
							<td><?php echo $this->_tpl_vars['conf']['zip']; ?>
&nbsp;</td>
						</tr>
						<tr>
							<th>住所</th>
							<td><?php echo $this->_tpl_vars['conf']['address']; ?>
&nbsp;</td>
						</tr>
						<tr>
							<th>建物名</th>
							<td><?php echo $this->_tpl_vars['conf']['address2']; ?>
&nbsp;</td>
						</tr>
						<tr>
							<th>メールアドレス</th>
							<td><?php echo $this->_tpl_vars['conf']['email']; ?>
&nbsp;</td>
						</tr>
						<tr>
							<th>お問い合わせ内容</th>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['conf']['contents'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</diV><!--/.formTable-->
			<div class="formBtnWrap">
                <form name="form2" method="post" action="./">
                    <input type="hidden" name="m" value="3" />
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