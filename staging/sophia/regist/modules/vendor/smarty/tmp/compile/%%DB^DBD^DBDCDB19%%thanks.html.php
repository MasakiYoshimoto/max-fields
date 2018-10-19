<?php /* Smarty version 2.6.27, created on 2016-06-09 18:02:06
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/sophia/regist/modules/tpl/thanks.html */ ?>
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
					<img src="img/title.gif" alt="recruit">
					<span>お問い合わせ</span>
				</h2>
			</div>

			<p class="contactLead">お問い合わせ頂きありがとうございます。</p>

			<p class="contactStep"><img src="img/step3.gif" alt="STEP3 完了画面" height="38" width="620"></p>

			<p class="contactThanks">
				尚、ご本人様の確認のため自動にて返信メールを送信致しますので、<br>
				ご確認下さいますようお願い致します。<br>
				<a href="../" class="formBtn">&lt;&emsp;ホームへ戻る</a>
			</p>
<div style="height:280px;">
</div>

		</div><!--/.contentBox-->

	</div><!--/#contentMain-->

	<!-- サイドバーエリア -->
	<?php include('../include/sidebar.php'); ?>

</div><!--/#contentWrap-->

<?php include('../include/footer.php'); ?>