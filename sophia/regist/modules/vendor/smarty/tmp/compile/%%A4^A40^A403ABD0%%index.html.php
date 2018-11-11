<?php /* Smarty version 2.6.27, created on 2018-11-09 22:06:25
         compiled from /home/maxfields/evolve-max.com/public_html/sophia/regist/modules/tpl/index.html */ ?>
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

			<p class="contactLead">下記フォームにてご登録ください。<br />内容を確認後、弊社担当よりご連絡いたします。</p>

			<p class="contactStep"><img src="img/step1.gif" alt="STEP1 入力画面" height="38" width="620"></p>

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
                <?php if ($this->_tpl_vars['job_data']): ?>
                <input type="hidden" name="d" value="<?php echo $this->_tpl_vars['job_data']['id']; ?>
" />
                <?php endif; ?>

				<div class="formreg">
					<dl>
						<dt>氏名（漢字）<span class="formRequired2">必須</span></dt>
						<dd>
							<input type="text" class="formInput" name="name" value="<?php echo $this->_tpl_vars['input']['name']; ?>
">
							<div class="formEx">例）マックス太郎</div>
						</dd>
						<dt>氏名（フリガナ）<span class="formRequired2">必須</span></dt>
						<dd>
							<input type="text" class="formInput" name="kana" value="<?php echo $this->_tpl_vars['input']['kana']; ?>
">
							<div class="formEx">例）マックスタロウ</div>
						</dd>
						<dt>年齢<span class="formRequired2">必須</span></dt>
						<dd>
							<input type="text" class="formInput" name="age" value="<?php echo $this->_tpl_vars['input']['age']; ?>
">
							<div class="formEx">例）28歳</div>
						</dd>
						<dt>性別<span class="formRequired2">必須</span></dt>
						<dd>
							<select name="sex" id="genter">
							<option value="">性別を選択</option>
							<option value="男性" <?php if ($this->_tpl_vars['input']['sex_1']): ?>selected<?php endif; ?>>男性</option>
							<option value="女性" <?php if ($this->_tpl_vars['input']['sex_2']): ?>selected<?php endif; ?>>女性</option>
							</select>
						</dd>
						<dt>連絡先<span class="formRequired2">必須</span></dt>
						<dd>
							<input type="tel" class="formInputTel" name="tel" value="<?php echo $this->_tpl_vars['input']['tel']; ?>
">
							<div class="formEx">例）054-251-3545</div>
						</dd>
						<dt class="any">お住まい</dt>
						<dd>
							郵便番号　<input type="tel" class="formInputZip" name="zip" id="inputZip" value="<?php echo $this->_tpl_vars['input']['zip']; ?>
">
							<div class="formEx">例）420-0851<br>※郵便番号を入力すると住所が自動で入力されます</div>
							<input type="text" class="formInputAddr" name="address" id="inputAddr" value="<?php echo $this->_tpl_vars['input']['address']; ?>
">
							<div class="formEx">例）静岡県静岡市葵区黒金町11-7</div>
						</dd>
						<dt class="any">就業開始可能日</dt>
						<dd>
							<input type="text" class="formInput" name="start_date" value="<?php echo $this->_tpl_vars['input']['start_date']; ?>
">
							<div class="formEx">例）１ヵ月後</div>
						</dd>
						<dt class="any">通勤手段</dt>
						<dd>
							<input type="text" class="formInput" name="commute" value="<?php echo $this->_tpl_vars['input']['commute']; ?>
">
							<div class="formEx">例）徒歩、バス</div>
						</dd>
						<dt class="any">現況</dt>
						<dd>
							<input type="radio" name="status_work" value="休職中" <?php if ($this->_tpl_vars['input']['status_work_1']): ?>checked<?php endif; ?>>休職中
							<input type="radio" name="status_work" value="就業中" <?php if ($this->_tpl_vars['input']['status_work_2']): ?>checked<?php endif; ?>>就業中
							<input type="radio" name="status_work" value="その他" <?php if ($this->_tpl_vars['input']['status_work_3']): ?>checked<?php endif; ?>>その他
						<dt>メールアドレス<span class="formRequired2">必須</span></dt>
						<dd>
							<input type="email" class="formInput" name="email" value="<?php echo $this->_tpl_vars['input']['email']; ?>
">
							<div class="formEx">例）max@evolve-max.com</div>
						</dd>
						<dt>メールアドレス（確認用）<span class="formRequired2">必須</span></dt>
						<dd>
							<input type="email" class="formInput" name="email2" value="<?php echo $this->_tpl_vars['input']['email2']; ?>
">
							<div class="formEx">例）max@evolve-max.com</div>
						</dd>
					</dl>
				</div><!--/.formTable-->

				<div id="scroll">
					<p class="title">個人情報の取扱について</p>
		<p>
		<strong>■ 組織の名称</strong><br>
		株式会社マックスフィールズ
		</p>
		<br>
		<p>
			<strong>■ 個人情報保護管理者の氏名及び所属・連絡先</strong><br>
			氏　名：地主　正孝<br>
      所　属：個人情報事務局<br>
      連絡先：電話：054-251-3545<br>
		</p>
		<br>
		<p>
		<strong>■ 利用目的</strong><br>
		ご入力いただいた個人情報はお問合せ対応のために利用いたします
		</p>
		<br>
		<p>
		<strong>■ 個人情報の第三者への提供</strong><br>
		ご入力いただいた個人情報を第三者に提供することはありません。
		</p>
		<br>
		<p>
		<strong>■ 個人情報の取扱いの委託</strong><br>
		利用目的達成に必要な範囲で委託する場合があります。
		</p>
		<br>
		<p>
		<strong>■ 開示等について</strong><br>
		皆様はご自身の個人情報の内容について、開示等（利用目的通知／開示／訂正／追加／削除／利用停止／消去／提供停止）を請求することが出来ます。
		請求された方がご本人であると確認された後、遅滞なく皆様の個人情報を開示等致します。詳しくは下記の問合せ先までご連絡ください。<br>
   （問合せ先）　個人情報事務局　　電話：054-251-3545
		</p>
		<br>
		<p>
		<strong>■ 任意性について</strong><br>
		皆様が個人情報の提供を希望されないときは、ご自身のご判断で提供を拒否することができます。
		この際、お問合せフォームにおけるサービスがご利用になれないことを、予めご了承ください。
		</p>
		<br>
		<p>
		<strong>■ クッキーについて</strong><br>
		クッキーなどで個人情報を取得することはありません。
		</p>
		<br>
		<p>
		<strong>■ 安全性について</strong><br>
		皆様の個人情報を頂く際には、通信途上における第三者の不正アクセスに備え、SSLによる個人情報の暗号化を施し、安全性の確保に努めます。
		</p>
		<br>
		<p class="text-right">
		以上
		</p>
	</div>

	<p class="check"><input type="checkbox" name="privacy-policy" value="同意" <?php if ($this->_tpl_vars['input']['privacy']-$this->_tpl_vars['olicy']): ?>checked<?php endif; ?>>個人情報取り扱いに同意する</p>

				<div class="formBtnWrap">
					<input type="submit" class="formBtn2" value="確　認">
				</div><!--/.formBtn-->
			</form>

		</div><!--/.contentBox-->

	</div><!--/#contentMain-->

	<!-- サイドバーエリア -->
	<?php include('../include/sidebar.php'); ?>

</div><!--/#contentWrap-->

<?php include('../include/footer.php'); ?>