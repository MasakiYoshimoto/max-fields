<?php /* Smarty version 2.6.27, created on 2017-10-11 17:00:00
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/sophia/contact/modules/tpl/thanks.html */ ?>
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

			<p class="contactLead">お問い合わせ頂きありがとうございます。</p>

			<p class="contactStep"><img src="img/step3.gif" alt="STEP3 完了画面" height="38" width="600"></p>

			<p class="contactThanks">
				尚、ご本人様の確認のため自動にて返信メールを送信致しますので、<br>
				ご確認下さいますようお願い致します。<br>
				<a href="../" class="formBtn">&lt;&emsp;ホームへ戻る</a>
			</p>

<div style="height:190px;">
</div>
		</div><!--/.contentBox-->

	</div><!--/#contentMain-->

	<!-- サイドバーエリア -->
	<?php include('../include/sidebar.php'); ?>

</div><!--/#contentWrap-->

<?php include('../include/footer.php'); ?>