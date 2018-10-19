<?php /* Smarty version 2.6.27, created on 2018-10-07 10:54:01
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/staging/sophia/regist/modules/tpl/index.html */ ?>
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
					<p class="title">個人情報保護方針</p>
					<p>
			マックスフィールズグループは、お客様及び当社社員の個人情報を保護し、プライバシー
			を尊重する為に、個人情報保護の重要性を認識した上、個人情報を適切に取得、利用及び
			提供する取扱要領を次に定め、実施・維持する。尚、特定個人情報は国や自治体に於ける
			社会保障と税、災害対策の３分野に限定して利用致します。
					</p>
					<br>
					<br>

					<p>
					＜個人情報保護目的＞<br>
					個人情報保護マネジメントシステムを確立し、実施し、維持し、かつ改善することにより、当社の個人情報保護における管理能力を高め、社会の信用・信頼を維持する。
					</p>
					<br>
					<br>

					<p>
						<strong>第一条　個人情報の取得、利用及び提供</strong><br>
			当社は、事業活動を効果的に実施するために必要な限度に於いて、適法、且つ、公正な手段で
			個人情報を取得する。個人情報の利用及び提供については、個人情報内部規程に明示する。又、
			目的外利用の禁止をすべての社員に周知する。
					</p>
					<br>
					<br>

					<p>
						<strong>第二条　個人情報の利用目的</strong><br>
			（お客様に関する主な利用目的）
			一．お客様との契約業務等を適正に実施するために利用致します。
			一．商談及びこれに伴う連絡のために利用致します。
			一．委託元から受託した業務を実施するために利用致します。
			一．お客様からのお問い合わせに適正に対応するために利用致します。
			一．業務提供に掛かる代金等の支払を受ける手続きのために利用致します。
			一．お客様の急病時に医療機関へ通報するために利用致します。
			（社員・退職者等に関する主な利用目的）
			一．採用活動に関連するご連絡、資料の送付、本人確認等のために利用致します。
			一．人事労務管理、福利厚生、労働関連法令への対応のために利用致します。
			一．事務連絡、その他緊急時のご連絡を実施するために利用致します。
					</p>
					<br>
					<br>

					<p>
						<strong>第三条　個人情報に関する法令、国が定める指針その他の規範の遵守</strong><br>
		当社は、保有する個人情報に関する法令、国が定める指針その他の規範を遵守する。
					</p>
					<br>
					<br>

					<p>
						<strong>第四条　個人情報の漏洩、滅失又は毀損の防止及び是正</strong><br>
		当社は、個人情報の漏洩、滅失又は毀損については、防止及び是正する。なお、発生した場合の
		対応については、個人情報内部規程に明示する。
					</p>
					<br>
					<br>

					<p>
						<strong>第五条　苦情及び相談への対応</strong><br>
		当社は、個人情報保護マネジメントシステムに関する苦情及び相談の対応については、個人情報
		内部規程に明示する。
		[相談窓口※]　マックスフィールズグループ  個人情報事務局　電話：054-251-3545
		(※)個人情報保護方針や個人情報の取扱い、情報開示等はこちらへお問合わせください。
					</p>
					<br><br>
					<p>
						<strong>第六条　個人情報保護マネジメントシステムの継続的改善</strong><br>
		当社は、個人情報保護マネジメントシステムについては、運用の確認、監査、及びトップマネジ
		メントによるマネジメントレビューを適切に実施し、継続的改善を図る。
					</p>
					<br><br>
					<p>
						<strong>第七条　個人情報保護方針の周知</strong><br>
		当社は、個人情報保護方針をすべての社員に社内掲示により周知すると共に利害関係者及び
		一般の人が知り得るためにホームページ等により公開する。
					</p>
					<br><br>
					<p>
			制定日：２０１８年４月１日<br>
			改訂日：　　　　年　月　日<br>

			マックスグループ<br>
			代表取締役　 落合 直樹<br>
					</p>
					<br><br>

		<p class="title">個人情報の取扱について</p>
		<p>
		<strong>１．個人情報の取得</strong><br>
		皆様に個人情報の提供をお願いする際は、予めその利用目的を明示致します。皆様に提供して頂いた個人情報は、利用目的の範囲内で利用し、本人の同意なく利用目的以外に利用致しません。本人が個人情報の提供を希望されないときは、本人自身のご判断で提供を
		拒否することができます。この際、ウェブサイトに於けるｻｰﾋﾞｽをご利用できない場合が
		ありますので、予めご了承下さい。
		</p>
		<br><br>
		<p>
			<strong>２．個人情報の利用目的</strong><br>
			（１）お客様に関する主な利用目的<br>
			一．お客様との契約業務等を適正に実施するために利用致します。<br>
			一．商談及びこれに伴う連絡のために利用致します。<br>
			一．委託元から受託した業務を実施するために利用致します。<br>
			一．お客様からのお問い合わせに適正に対応するために利用致します。<br>
			一．業務提供に掛かる代金等の支払を受ける手続きのために利用致します。<br>
			一．お客様の急病時に医療機関へ通報するために利用致します。<br>
			（２）社員・退職者等に関する主な利用目的<br>
			一．採用活動に関連するご連絡、資料の送付、本人確認等のために利用致します。<br>
			一．人事労務管理、福利厚生、労働関連法令への対応のために利用致します。<br>
			一．事務連絡、その他緊急時のご連絡を実施するために利用致します。<br>
		</p>
		<br><br>
		<p>
		<strong>３．個人情報の第三者委託</strong><br>
		皆様の個人情報を当社以外の第三者に上記取得目的の範囲内で委託する場合があります。
		</p>
		<br><br>
		<p>
		<strong>４．個人情報の第三者提供</strong><br>
		皆様の個人情報を当社以外の第三者に提供する場合は、次の要領で利用致します。<br>
		・利用目的　：法令に基づく場合に提供する。<br>
		・提供項目　：氏名・郵便番号・住所・電話番号・ﾒｰﾙｱﾄﾞﾚｽ・お問合せ内容。<br>
		・提供方法　：電話・FAX・webｻｲﾄ・ﾒｰﾙ・紙等の方法で提供する。<br>
		・提供先　　：法令に基づく第三者（警察等）に提供する。<br>
		</p>
		<br><br>
		<p>
		<strong>５．個人情報の第三者開示</strong><br>
		皆様の個人情報は、次の場合を除き第三者に開示致しません。<br>
		<li>・お客様の同意がある場合</li>
		<li>・お客様に明示した利用目的の達成に必要な範囲で個人情報の取扱いを委託する場合</li>
		<li>・法令などに基づき、提供に応じなければならない場合</li>
		</p>
		<br><br>
		<p>
		<strong>６．個人情報の安全対策</strong><br>
		皆様から個人情報を頂く際は、個人情報を頂く特定のウェブページに、その管理元を予め明示致します。管理元は、頂いた個人情報を厳重に保管・管理し、第三者の不正アクセスによる漏洩・流用・改ざんなどを防止するため、ファイアウォール設置・コンピューターウィルス対策、その他合理的なセキュリティ対策を講じます。又、個人情報を頂く際には、通信途上における第三者の不正アクセスに備え、SSL（secure sockets layer）による個人情報の暗号化又は、これに準ずるセキュリティ技術を施し、安全性の確保に努めます。
		</p>
		<br><br>
		<p>
		<strong>７．個人情報に関する権利</strong><br>
		皆様はご自分の個人情報の内容について、開示等（利用目的通知／開示／訂正／追加／削除／利用停止／消去／提供停止）を請求することが出来ます。請求された方がご本人又は代理人であると確認された後、しかるべき期間内に皆様の個人情報を開示等致します。
		</p>
		<br><br>
		<p>
		<strong>８．リンク先における個人情報の保護</strong>
		当社は、ウェブサイトからリンクする別のウェブサイトにおける個人情報の安全確保に
		ついては、責任を負うことはできません。リンク先の個人情報保護には、当該リンク先
		に於けるプライバシーポリシーなどを皆様ご自身で確認されるようお願い致します。
		</p>
		<br><br>
		<p>
		<strong>９．個人情報保護管理者の氏名又は職名及び所属・連絡先</strong><br>
		氏名又は職名：地主　正孝<br>
		所属・連絡先：個人情報事務局　<br>・電話：054-251-3545<br>
		</p>
		<br><br>
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