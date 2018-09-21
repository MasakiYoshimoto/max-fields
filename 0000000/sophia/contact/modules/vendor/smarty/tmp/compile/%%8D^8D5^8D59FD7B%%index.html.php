<?php /* Smarty version 2.6.27, created on 2017-06-08 21:34:29
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/sophiamax/contact/modules/tpl/index.html */ ?>
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

			<p class="contactLead">下記お問い合わせフォームより、お気軽にお問い合わせ下さい。</p>

			<p class="contactStep"><img src="img/step1.gif" alt="STEP1 入力画面" height="38" width="600"></p>

			<p class="contactNotes">お客様情報をご入力ください。</p>

            <?php if ($this->_tpl_vars['error']): ?>
            <ul class="contactErrors">
                <?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['error'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['error']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value']):
        $this->_foreach['error']['iteration']++;
?>
                <li><?php echo $this->_tpl_vars['value']; ?>
</li>
                <?php endforeach; endif; unset($_from); ?>
            </ul>
            <?php endif; ?>

            <form name="form1" method="post" action="./">
                <input type="hidden" name="m" value="2" />
				<div class="formTable">
					<table>
						<tbody>
							<tr>
								<th><div>会社名</div></th>
								<td>
									<input type="text" class="formInput" name="company" value="<?php echo $this->_tpl_vars['input']['company']; ?>
">
									<div class="formEx">例）株式会社マックスフィールズ</div>
								</td>
							</tr>
							<tr>
								<th><div>お名前<span class="formRequired">必須</span></div></th>
								<td>
									<input type="text" class="formInput" name="name" value="<?php echo $this->_tpl_vars['input']['name']; ?>
">
									<div class="formEx">例）マックス太郎</div>
								</td>
							</tr>
							<tr>
								<th><div>ふりがな<span class="formRequired">必須</span></div></th>
								<td>
									<input type="text" class="formInput" name="kana" value="<?php echo $this->_tpl_vars['input']['kana']; ?>
">
									<div class="formEx">例）まっくすたろう</div>
								</td>
							</tr>
							<tr>
								<th><div>電話番号<span class="formRequired">必須</span></div></th>
								<td>
									<input type="tel" class="formInputTel" name="tel" value="<?php echo $this->_tpl_vars['input']['tel']; ?>
">
									<div class="formEx">例）054-251-3545</div>
								</td>
							</tr>
							<tr>
								<th><div>FAX番号</div></th>
								<td>
									<input type="tel" class="formInputTel" name="fax" value="<?php echo $this->_tpl_vars['input']['fax']; ?>
">
									<div class="formEx">例）054-251-3538</div>
								</td>
							</tr>
							<tr>
								<th><div>郵便番号<span class="formRequired">必須</span></div></th>
								<td>
									<input type="tel" class="formInputZip" name="zip" id="inputZip" value="<?php echo $this->_tpl_vars['input']['zip']; ?>
">
									<div class="formEx">例）420-0851<br>※郵便番号を入力すると住所が自動で入力されます</div>
								</td>
							</tr>
							<tr>
								<th><div>住所<span class="formRequired">必須</span></div></th>
								<td>
									<input type="text" class="formInputAddr" name="address" id="inputAddr" value="<?php echo $this->_tpl_vars['input']['address']; ?>
">
									<div class="formEx">例）静岡県静岡市葵区黒金町11-7</div>
								</td>
							</tr>
							<tr>
								<th><div>建物名</div></th>
								<td>
									<input type="text" class="formInput" name="address2" value="<?php echo $this->_tpl_vars['input']['address2']; ?>
">
									<div class="formEx">例）三井生命静岡駅前ビル9F</div>
								</td>
							</tr>
							<tr>
								<th><div>メールアドレス<span class="formRequired">必須</span></div></th>
								<td>
									<input type="email" class="formInput" name="email" value="<?php echo $this->_tpl_vars['input']['email']; ?>
">
									<div class="formEx">例）max@evolve-max.com</div>
								</td>
							</tr>
							<tr>
								<th><div>メールアドレス（確認用）<span class="formRequired">必須</span></div></th>
								<td>
									<input type="email" class="formInput" name="email2" value="<?php echo $this->_tpl_vars['input']['email2']; ?>
">
									<div class="formEx">例）max@evolve-max.com</div>
								</td>
							</tr>
							<tr>
								<th><div>お問い合わせ内容<span class="formRequired">必須</span></div></th>
								<td>
									<textarea name="contents" class="formTextarea"><?php echo $this->_tpl_vars['input']['contents']; ?>
</textarea>
								</td>
							</tr>
						</tbody>
					</table>
				</diV><!--/.formTable-->
				<div class="formBtnWrap">
					<input type="submit" class="formBtn" value="確認画面へ">
				</div><!--/.formBtn-->
			</form>

		</div><!--/.contentBox-->

	</div><!--/#contentMain-->

	<!-- サイドバーエリア -->
	<?php include('../include/sidebar.php'); ?>

</div><!--/#contentWrap-->

<?php include('../include/footer.php'); ?>