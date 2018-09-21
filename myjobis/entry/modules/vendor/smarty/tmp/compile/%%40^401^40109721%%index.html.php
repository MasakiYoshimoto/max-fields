<?php /* Smarty version 2.6.27, created on 2015-05-26 10:21:05
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/myjobis/entry/modules/tpl/index.html */ ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="あなたのライフスタイルに合わせた短時間求人のマイジョブイズです。お問合せはお気軽に。" />
<meta name="keywords" content="求人,求職,アルバイト,パート,短期,短時間,ライフスタイル,女性,リクルート,採用,スキル,キャリア" />
<title>短期・短時間の求人｜マイジョブイズ My job is｜登録申込み</title>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.switchHat.js"></script>
<script type="text/javascript" src="../js/agent2.js"></script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

   ga('create', 'UA-41326631-2', 'auto');
   ga('send', 'pageview');

</script>
</head>
<body>
<div id="header">
	<div id="headerTop" class="clearfix">
		<div id="headerLeft">
			<p>あなたのライフスタイルにあわせた短時間求人</p>
			<div id="logo"><a href="../"><img src="../img/common_img_logo.gif" alt="MyJobIs" title="MyJobIsホーム" width="234" height="52" /></a></div>
		</div>
	    <div id="globalNav">
	    	<ul>
	        	<li class="gnav01"><a href="../about.html" title="About">About</a></li>
	            <li class="gnav02"><a href="../client.html" title="Client">Client</a></li>
	            <li class="gnav03"><a href="../worker.html" title="Worker">Worker</a></li>
	            <li class="gnav04"><a href="../job.html" title="Job">Job</a></li>
	            <li class="gnav05"><a href="../entry/" title="Entry">Entry</a></li>
	            <li class="gnav06"><a href="../contact/" title="Contact">Contact</a></li>
	        </ul>
	    </div><!-- #globalNav -->
	</div><!-- #headerTop -->
</div><!-- #header（ヘッダーここまで） -->

<div id="eyecatchWrapper">
	<div id="eyecatch">
		<h1 class="entry"><img src="../img/entry_h1.jpg" alt="Entry/登録申込" title="Entry/登録申込" width="1000" height="132" /></h1>
		<ol id="topicpath">
			<li>HOME</li>
			<li class="end"><a href="../entry/">登録申込</a></li>
		</ol>
	</div>
</div><!-- #eyecatchWrapper -->


<div id="container" class="clearfix">
	<div id="main" class="tableRow"><div class="spcellwrap"><!-- Start-Page_Content -->
	    <h2><img src="../img/entry_h2_01.gif" width="248" height="21" alt="登録申込フォーム" /></h2>
	    <script type="text/javascript" src="https://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3-https.js" charset="UTF-8"></script>
        <form name="form1" class="mailform" id="form1" method="post" action="./">
            <input type="hidden" name="m" value="2" />
            <?php if ($this->_tpl_vars['job_data']): ?>
            <input type="hidden" name="d" value="<?php echo $this->_tpl_vars['job_data']['id']; ?>
" />
            <?php endif; ?>
			<p>この度は弊社サイトへアクセスいただきありがとうございます。下記項目へ入力してください。<br />
			<em>*</em>は必須項目です。</p>
            <?php if ($this->_tpl_vars['error']): ?>
			<p class="error">入力内容に誤りがあります。下記内容を確認し、再度入力してください。</p>
            <?php endif; ?>
			<dl id="entryform" class="mainlist">
				<dt scope="row">氏名（漢字）<em>*</em></dt>
				<dd>
					<input class="sizeM" type="text" name="name" value="<?php echo $this->_tpl_vars['input']['name']; ?>
" />
                    <?php if ($this->_tpl_vars['error']['name']): ?><div class="error"><?php echo $this->_tpl_vars['error']['name']; ?>
</div><?php endif; ?>
				</dd>
				<dt scope="row">氏名（フリガナ）<em>*</em></dt>
				<dd>
					<input class="sizeM" type="text" name="kana" value="<?php echo $this->_tpl_vars['input']['kana']; ?>
" />
                    <?php if ($this->_tpl_vars['error']['kana']): ?><div class="error"><?php echo $this->_tpl_vars['error']['kana']; ?>
</div><?php endif; ?>
				</dd>
				<dt scope="row">生年月日（西暦）<em>*</em></dt>
				<dd>
					<input class="sizeM" type="text" name="birthday" value="<?php echo $this->_tpl_vars['input']['birthday']; ?>
" placeholder="YYYY/MM/DD" />
                    <?php if ($this->_tpl_vars['error']['birthday']): ?><div class="error"><?php echo $this->_tpl_vars['error']['birthday']; ?>
</div><?php endif; ?>
				</dd>
				<dt scope="row">性別<em>*</em></dt>
				<dd>
					<select name="sex" id="genter">
		                <option value="">性別を選択</option>
		                <option value="男性" <?php if ($this->_tpl_vars['input']['sex_1']): ?>selected<?php endif; ?>>男性</option>
		                <option value="女性" <?php if ($this->_tpl_vars['input']['sex_2']): ?>selected<?php endif; ?>>女性</option>
	            	</select>
                    <?php if ($this->_tpl_vars['error']['sex']): ?><div class="error"><?php echo $this->_tpl_vars['error']['sex']; ?>
</div><?php endif; ?>
            	</dd>
				<dt scope="row">メールアドレス<em>*</em></dt>
				<dd>
					<input name="email" type="text" id="_email" class="sizeL" value="<?php echo $this->_tpl_vars['input']['email']; ?>
" />
                    <?php if ($this->_tpl_vars['error']['email']): ?><div class="error"><?php echo $this->_tpl_vars['error']['email']; ?>
</div><?php endif; ?>
				</dd>
				<dt scope="row">メールアドレス(確認用)<em>*</em></dt>
				<dd>
					<input name="email2" type="text" id="_email2" value="<?php echo $this->_tpl_vars['input']['email2']; ?>
" class="sizeL" />
                    <?php if ($this->_tpl_vars['error']['email2']): ?><div class="error"><?php echo $this->_tpl_vars['error']['email2']; ?>
</div><?php endif; ?>
				</dd>
				<dt scope="row">電話番号<em>*</em></dt>
				<dd>
					<input name="tel" type="text" id="phone" value="<?php echo $this->_tpl_vars['input']['tel']; ?>
" class="sizeM" />
                    <?php if ($this->_tpl_vars['error']['tel']): ?><div class="error"><?php echo $this->_tpl_vars['error']['tel']; ?>
</div><?php endif; ?>
				</dd>
				<dt scope="row">ご住所<em>*</em></dt>
				<dd>
					<span class="note">郵便番号</span><input name="zip" type="text" id="address01" value="<?php echo $this->_tpl_vars['input']['zip']; ?>
"  class="sizeM" onkeyup="AjaxZip3.zip2addr(this,'','pref','address');">
                    <?php if ($this->_tpl_vars['error']['zip']): ?><div class="error"><?php echo $this->_tpl_vars['error']['zip']; ?>
</div><?php endif; ?>
				</dd>
				<dd>
					<span class="note">都道府県</span>
					<select  name="pref" id="pref">
                        <option value="">都道府県を選択</option>
                        <option value="北海道" <?php if ($this->_tpl_vars['input']['pref_1']): ?>selected<?php endif; ?>>北海道</option>
                        <option value="青森県"  <?php if ($this->_tpl_vars['input']['pref_2']): ?>selected<?php endif; ?>>青森県</option>
                        <option value="秋田県"  <?php if ($this->_tpl_vars['input']['pref_3']): ?>selected<?php endif; ?>>秋田県</option>
                        <option value="岩手県"  <?php if ($this->_tpl_vars['input']['pref_4']): ?>selected<?php endif; ?>>岩手県</option>
                        <option value="山形県"  <?php if ($this->_tpl_vars['input']['pref_5']): ?>selected<?php endif; ?>>山形県</option>
                        <option value="宮城県"  <?php if ($this->_tpl_vars['input']['pref_6']): ?>selected<?php endif; ?>>宮城県</option>
                        <option value="福島県"  <?php if ($this->_tpl_vars['input']['pref_7']): ?>selected<?php endif; ?>>福島県</option>
                        <option value="茨城県"  <?php if ($this->_tpl_vars['input']['pref_8']): ?>selected<?php endif; ?>>茨城県</option>
                        <option value="栃木県"  <?php if ($this->_tpl_vars['input']['pref_9']): ?>selected<?php endif; ?>>栃木県</option>
                        <option value="群馬県"  <?php if ($this->_tpl_vars['input']['pref_10']): ?>selected<?php endif; ?>>群馬県</option>
                        <option value="埼玉県"  <?php if ($this->_tpl_vars['input']['pref_11']): ?>selected<?php endif; ?>>埼玉県</option>
                        <option value="東京都"  <?php if ($this->_tpl_vars['input']['pref_12']): ?>selected<?php endif; ?>>東京都</option>
                        <option value="千葉県"  <?php if ($this->_tpl_vars['input']['pref_13']): ?>selected<?php endif; ?>>千葉県</option>
                        <option value="神奈川県" <?php if ($this->_tpl_vars['input']['pref_14']): ?>selected<?php endif; ?>>神奈川県</option>
                        <option value="新潟県"  <?php if ($this->_tpl_vars['input']['pref_15']): ?>selected<?php endif; ?>>新潟県</option>
                        <option value="長野県"  <?php if ($this->_tpl_vars['input']['pref_16']): ?>selected<?php endif; ?>>長野県</option>
                        <option value="山梨県"  <?php if ($this->_tpl_vars['input']['pref_17']): ?>selected<?php endif; ?>>山梨県</option>
                        <option value="静岡県"  <?php if ($this->_tpl_vars['input']['pref_18']): ?>selected<?php endif; ?>>静岡県</option>
                        <option value="富山県"  <?php if ($this->_tpl_vars['input']['pref_19']): ?>selected<?php endif; ?>>富山県</option>
                        <option value="岐阜県"  <?php if ($this->_tpl_vars['input']['pref_20']): ?>selected<?php endif; ?>>岐阜県</option>
                        <option value="愛知県"  <?php if ($this->_tpl_vars['input']['pref_21']): ?>selected<?php endif; ?>>愛知県</option>
                        <option value="石川県"  <?php if ($this->_tpl_vars['input']['pref_22']): ?>selected<?php endif; ?>>石川県</option>
                        <option value="福井県"  <?php if ($this->_tpl_vars['input']['pref_23']): ?>selected<?php endif; ?>>福井県</option>
                        <option value="滋賀県"  <?php if ($this->_tpl_vars['input']['pref_24']): ?>selected<?php endif; ?>>滋賀県</option>
                        <option value="三重県"  <?php if ($this->_tpl_vars['input']['pref_25']): ?>selected<?php endif; ?>>三重県</option>
                        <option value="奈良県"  <?php if ($this->_tpl_vars['input']['pref_26']): ?>selected<?php endif; ?>>奈良県</option>
                        <option value="京都府"  <?php if ($this->_tpl_vars['input']['pref_27']): ?>selected<?php endif; ?>>京都府</option>
                        <option value="大阪府"  <?php if ($this->_tpl_vars['input']['pref_28']): ?>selected<?php endif; ?>>大阪府</option>
                        <option value="和歌山県"  <?php if ($this->_tpl_vars['input']['pref_29']): ?>selected<?php endif; ?>>和歌山県</option>
                        <option value="兵庫県"  <?php if ($this->_tpl_vars['input']['pref_30']): ?>selected<?php endif; ?>>兵庫県</option>
                        <option value="鳥取県"  <?php if ($this->_tpl_vars['input']['pref_31']): ?>selected<?php endif; ?>>鳥取県</option>
                        <option value="岡山県"  <?php if ($this->_tpl_vars['input']['pref_32']): ?>selected<?php endif; ?>>岡山県</option>
                        <option value="島根県"  <?php if ($this->_tpl_vars['input']['pref_33']): ?>selected<?php endif; ?>>島根県</option>
                        <option value="広島県"  <?php if ($this->_tpl_vars['input']['pref_34']): ?>selected<?php endif; ?>>広島県</option>
                        <option value="山口県"  <?php if ($this->_tpl_vars['input']['pref_35']): ?>selected<?php endif; ?>>山口県</option>
                        <option value="香川県"  <?php if ($this->_tpl_vars['input']['pref_36']): ?>selected<?php endif; ?>>香川県</option>
                        <option value="徳島県"  <?php if ($this->_tpl_vars['input']['pref_37']): ?>selected<?php endif; ?>>徳島県</option>
                        <option value="愛媛県"  <?php if ($this->_tpl_vars['input']['pref_38']): ?>selected<?php endif; ?>>愛媛県</option>
                        <option value="高知県"  <?php if ($this->_tpl_vars['input']['pref_39']): ?>selected<?php endif; ?>>高知県</option>
                        <option value="福岡県"  <?php if ($this->_tpl_vars['input']['pref_40']): ?>selected<?php endif; ?>>福岡県</option>
                        <option value="佐賀県"  <?php if ($this->_tpl_vars['input']['pref_41']): ?>selected<?php endif; ?>>佐賀県</option>
                        <option value="長崎県"  <?php if ($this->_tpl_vars['input']['pref_42']): ?>selected<?php endif; ?>>長崎県</option>
                        <option value="大分県"  <?php if ($this->_tpl_vars['input']['pref_43']): ?>selected<?php endif; ?>>大分県</option>
                        <option value="宮崎県"  <?php if ($this->_tpl_vars['input']['pref_44']): ?>selected<?php endif; ?>>宮崎県</option>
                        <option value="熊本県"  <?php if ($this->_tpl_vars['input']['pref_45']): ?>selected<?php endif; ?>>熊本県</option>
                        <option value="鹿児島県"  <?php if ($this->_tpl_vars['input']['pref_46']): ?>selected<?php endif; ?>>鹿児島県</option>
                        <option value="沖縄県"  <?php if ($this->_tpl_vars['input']['pref_47']): ?>selected<?php endif; ?>>沖縄県</option>
                    </select>
                    <?php if ($this->_tpl_vars['error']['pref']): ?><div class="error"><?php echo $this->_tpl_vars['error']['pref']; ?>
</div><?php endif; ?>
				</dd>
				<dd>
					<span class="note">市区郡以降</span><input name="address" type="text" id="address02" value="<?php echo $this->_tpl_vars['input']['address']; ?>
" class="sizeL" />
                    <?php if ($this->_tpl_vars['error']['address']): ?><div class="error"><?php echo $this->_tpl_vars['error']['address']; ?>
</div><?php endif; ?>
				</dd>
				<dt scope="row">最終学歴<em>*</em></dt>
	            <dd>
	                <select name="latest_academic_background" id="education">
                        <option value="">最終学歴を選択</option>
                        <option value="大学院了（博士・修士）" <?php if ($this->_tpl_vars['input']['latest_academic_background_1']): ?>selected<?php endif; ?>>大学院了（博士・修士）</option>
                        <option value="大学卒" <?php if ($this->_tpl_vars['input']['latest_academic_background_2']): ?>selected<?php endif; ?>>大学卒</option>
                        <option value="短大卒" <?php if ($this->_tpl_vars['input']['latest_academic_background_3']): ?>selected<?php endif; ?>>短大卒</option>
                        <option value="高専卒" <?php if ($this->_tpl_vars['input']['latest_academic_background_4']): ?>selected<?php endif; ?>>高専卒</option>
                        <option value="高校卒" <?php if ($this->_tpl_vars['input']['latest_academic_background_5']): ?>selected<?php endif; ?>>高校卒</option>
                        <option value="その他" <?php if ($this->_tpl_vars['input']['latest_academic_background_6']): ?>selected<?php endif; ?>>その他</option>
	                </select>
                    <?php if ($this->_tpl_vars['error']['latest_academic_background']): ?><div class="error"><?php echo $this->_tpl_vars['error']['latest_academic_background']; ?>
</div><?php endif; ?>
	            </dd>
	            <dt scope="row">英語</dt>
	            <dd>
		            <div class="form_item_wrap">
		            	<h4>会話レベル</h4>
                        <input type="radio" name="english_conversation" value="日常会話レベル" <?php if ($this->_tpl_vars['input']['english_conversation_1']): ?>checked<?php endif; ?>>日常会話レベル
                        <input type="radio" name="english_conversation" value="ビジネス会話レベル" <?php if ($this->_tpl_vars['input']['english_conversation_2']): ?>checked<?php endif; ?>>ビジネス会話レベル
                        <input type="radio" name="english_conversation" value="ネイティブレベル" <?php if ($this->_tpl_vars['input']['english_conversation_3']): ?>checked<?php endif; ?>>ネイティブレベル
                        <?php if ($this->_tpl_vars['error']['english_conversation']): ?><div class="error"><?php echo $this->_tpl_vars['error']['english_conversation']; ?>
</div><?php endif; ?>
		            </div>

					<h4>実務経験</h4>
                    <input type="checkbox" name="english_experience[]" value="文書" <?php if ($this->_tpl_vars['input']['english_experience_1']): ?>checked<?php endif; ?>>文書
                    <input type="checkbox" name="english_experience[]" value="読解" <?php if ($this->_tpl_vars['input']['english_experience_2']): ?>checked<?php endif; ?>>読解
                    <input type="checkbox" name="english_experience[]" value="メール交換" <?php if ($this->_tpl_vars['input']['english_experience_3']): ?>checked<?php endif; ?>>メール交換
                    <input type="checkbox" name="english_experience[]" value="プレゼンテーション" <?php if ($this->_tpl_vars['input']['english_experience_4']): ?>checked<?php endif; ?>>プレゼンテーション<br />
                    <input type="checkbox" name="english_experience[]" value="公的文書作成" <?php if ($this->_tpl_vars['input']['english_experience_5']): ?>checked<?php endif; ?>>公的文書作成
                    <input type="checkbox" name="english_experience[]" value="通訳" <?php if ($this->_tpl_vars['input']['english_experience_6']): ?>checked<?php endif; ?>>通訳
                    <input type="checkbox" name="english_experience[]" value="交渉" <?php if ($this->_tpl_vars['input']['english_experience_7']): ?>checked<?php endif; ?>>交渉
                    <?php if ($this->_tpl_vars['error']['english_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['english_experience']; ?>
</div><?php endif; ?>
	            </dd>
	            <dt scope="row">英語以外の言語</dt>
	            <dd>
                    <textarea name="language_etc" cols="30" rows="5"><?php echo $this->_tpl_vars['input']['language_etc']; ?>
</textarea>
                    <?php if ($this->_tpl_vars['error']['language_etc']): ?><div class="error"><?php echo $this->_tpl_vars['error']['language_etc']; ?>
</div><?php endif; ?>
                </dd>
	            <dt scope="row">普通自動車免許</dt>
	            <dd>
	                <label><input type="radio" name="drivers_license" value="有り" <?php if ($this->_tpl_vars['input']['drivers_license_1']): ?>checked<?php endif; ?>>有り</label>
	                <label><input type="radio" name="drivers_license" value="無し" <?php if ($this->_tpl_vars['input']['drivers_license_2']): ?>checked<?php endif; ?>>無し</label>
                    <?php if ($this->_tpl_vars['error']['drivers_license']): ?><div class="error"><?php echo $this->_tpl_vars['error']['drivers_license']; ?>
</div><?php endif; ?>
	            </dd>
	            <dt scope="row">その他資格</dt>
	            <dd>
                    <textarea name="license" cols="30" rows="5"><?php echo $this->_tpl_vars['input']['license']; ?>
</textarea>
                    <?php if ($this->_tpl_vars['error']['license']): ?><div class="error"><?php echo $this->_tpl_vars['error']['license']; ?>
</div><?php endif; ?>
                </dd>

		        <dt scope="row">経験職種</dt>
		        <dd class="switchbox">
	            	<p class="switchHat first">営業、事務、企画系</p>
	            	<div class="switchDetail">
                    <label><input type="checkbox" name="planning_experience[]" <?php if ($this->_tpl_vars['input']['planning_experience_1']): ?>checked<?php endif; ?> value="各種営業、人材斡旋">各種営業、人材斡旋</label><br />
                    <label><input type="checkbox" name="planning_experience[]" <?php if ($this->_tpl_vars['input']['planning_experience_2']): ?>checked<?php endif; ?> value="テレマーケティング・カスタマーサポート">テレマーケティング・カスタマーサポート</label><br />
                    <label><input type="checkbox" name="planning_experience[]" <?php if ($this->_tpl_vars['input']['planning_experience_3']): ?>checked<?php endif; ?> value="商品企画、営業企画、マーケティング、宣伝、物流、資材購買、店舗開発関連">商品企画、営業企画、マーケティング、宣伝、物流、資材購買、店舗開発関連</label><br />
                    <label><input type="checkbox" name="planning_experience[]" <?php if ($this->_tpl_vars['input']['planning_experience_4']): ?>checked<?php endif; ?> value="経営企画・秘書・事業統括・新規事業開発">経営企画・秘書・事業統括・新規事業開発</label><br />
                    <label><input type="checkbox" name="planning_experience[]" <?php if ($this->_tpl_vars['input']['planning_experience_5']): ?>checked<?php endif; ?> value="財務・経理">財務・経理</label><br />
                    <label><input type="checkbox" name="planning_experience[]" <?php if ($this->_tpl_vars['input']['planning_experience_6']): ?>checked<?php endif; ?> value="総務・人事・法務・知財・広報・IR">総務・人事・法務・知財・広報・IR</label><br />
                    <label><input type="checkbox" name="planning_experience[]" <?php if ($this->_tpl_vars['input']['planning_experience_7']): ?>checked<?php endif; ?> value="エグゼクティブ・役員">エグゼクティブ・役員</label>
                    <?php if ($this->_tpl_vars['error']['planning_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['planning_experience']; ?>
</div><?php endif; ?>
		            </div>

		            <p class="switchHat">サービス、販売、運輸系</p>
	    	        <div class="switchDetail">
                        <label><input type="checkbox" name="service_experience[]" <?php if ($this->_tpl_vars['input']['service_experience_1']): ?>checked<?php endif; ?> value="百貨店・小売・量販店">百貨店・小売・量販店</label><br />
                        <label><input type="checkbox" name="service_experience[]" <?php if ($this->_tpl_vars['input']['service_experience_2']): ?>checked<?php endif; ?> value="飲食・アミューズメント・スクール関連">飲食・アミューズメント・スクール関連</label><br />
                        <label><input type="checkbox" name="service_experience[]" <?php if ($this->_tpl_vars['input']['service_experience_3']): ?>checked<?php endif; ?> value="医療・福祉関連">医療・福祉関連</label><br />
                        <label><input type="checkbox" name="service_experience[]" <?php if ($this->_tpl_vars['input']['service_experience_4']): ?>checked<?php endif; ?> value="理美容・エステ・マッサージ関連">理美容・エステ・マッサージ関連</label><br />
                        <label><input type="checkbox" name="service_experience[]" <?php if ($this->_tpl_vars['input']['service_experience_5']): ?>checked<?php endif; ?> value="旅行・宿泊・冠婚葬祭式場関連">旅行・宿泊・冠婚葬祭式場関連</label><br />
                        <label><input type="checkbox" name="service_experience[]" <?php if ($this->_tpl_vars['input']['service_experience_6']): ?>checked<?php endif; ?> value="交通・物流・倉庫関連">交通・物流・倉庫関連</label><br />
                        <label><input type="checkbox" name="service_experience[]" <?php if ($this->_tpl_vars['input']['service_experience_7']): ?>checked<?php endif; ?> value="警備・清掃・設備管理関連">警備・清掃・設備管理関連</label>
                        <?php if ($this->_tpl_vars['error']['service_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['service_experience']; ?>
</div><?php endif; ?>
	    	        </div>

	    	        <p class="switchHat">クリエイティブ系</p>
	    	        <div class="switchDetail">
                        <label><input type="checkbox" name="creative_experience[]" <?php if ($this->_tpl_vars['input']['creative_experience_1']): ?>checked<?php endif; ?> value="広告・グラフィック関連">広告・グラフィック関連</label><br />
                        <label><input type="checkbox" name="creative_experience[]" <?php if ($this->_tpl_vars['input']['creative_experience_2']): ?>checked<?php endif; ?> value="出版・印刷関連">出版・印刷関連</label><br />
                        <label><input type="checkbox" name="creative_experience[]" <?php if ($this->_tpl_vars['input']['creative_experience_3']): ?>checked<?php endif; ?> value="映像・音響・イベント・芸能関連">映像・音響・イベント・芸能関連</label><br />
                        <label><input type="checkbox" name="creative_experience[]" <?php if ($this->_tpl_vars['input']['creative_experience_4']): ?>checked<?php endif; ?> value="インターネット関連">インターネット関連</label><br />
                        <label><input type="checkbox" name="creative_experience[]" <?php if ($this->_tpl_vars['input']['creative_experience_5']): ?>checked<?php endif; ?> value="ゲーム・マルチメディア関連">ゲーム・マルチメディア関連</label><br />
                        <label><input type="checkbox" name="creative_experience[]" <?php if ($this->_tpl_vars['input']['creative_experience_6']): ?>checked<?php endif; ?> value="ファッション・インテリア・工業製品関連">ファッション・インテリア・工業製品関連</label>
                        <?php if ($this->_tpl_vars['error']['creative_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['creative_experience']; ?>
</div><?php endif; ?>
	    	        </div>

	    	        <p class="switchHat">専門職系（コンサルタント・金融・不動産）</p>
	    	        <div class="switchDetail">
                        <label><input type="checkbox" name="specialist_experience[]" <?php if ($this->_tpl_vars['input']['specialist_experience_1']): ?>checked<?php endif; ?> value="経営コンサルティング・リサーチ・専門事務所">経営コンサルティング・リサーチ・専門事務所</label><br />
                        <label><input type="checkbox" name="specialist_experience[]" <?php if ($this->_tpl_vars['input']['specialist_experience_2']): ?>checked<?php endif; ?> value="人材・アウトソーシング・通訳・翻訳関連">人材・アウトソーシング・通訳・翻訳関連</label><br />
                        <label><input type="checkbox" name="specialist_experience[]" <?php if ($this->_tpl_vars['input']['specialist_experience_3']): ?>checked<?php endif; ?> value="金融関連">金融関連</label><br />
                        <label><input type="checkbox" name="specialist_experience[]" <?php if ($this->_tpl_vars['input']['specialist_experience_4']): ?>checked<?php endif; ?> value="不動産・プロパティマネジメント関連">不動産・プロパティマネジメント関連</label>
                        <?php if ($this->_tpl_vars['error']['specialist_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['specialist_experience']; ?>
</div><?php endif; ?>
	    	        </div>

	    	        <p class="switchHat">技術系（ITエンジニア）</p>
	    	        <div class="switchDetail">
                        <label><input type="checkbox" name="it_experience[]" <?php if ($this->_tpl_vars['input']['it_experience_1']): ?>checked<?php endif; ?> value="システムコンサルタント、システムアナリスト、プリセールス">システムコンサルタント、システムアナリスト、プリセールス</label><br />
                        <label><input type="checkbox" name="it_experience[]" <?php if ($this->_tpl_vars['input']['it_experience_2']): ?>checked<?php endif; ?> value="システム開発（Web系）">システム開発（Web系）</label><br />
                        <label><input type="checkbox" name="it_experience[]" <?php if ($this->_tpl_vars['input']['it_experience_3']): ?>checked<?php endif; ?> value="システム開発（オープン系）">システム開発（オープン系）</label><br />
                        <label><input type="checkbox" name="it_experience[]" <?php if ($this->_tpl_vars['input']['it_experience_4']): ?>checked<?php endif; ?> value="システム開発（汎用機系）">システム開発（汎用機系）</label><br />
                        <label><input type="checkbox" name="it_experience[]" <?php if ($this->_tpl_vars['input']['it_experience_5']): ?>checked<?php endif; ?> value="組込系ソフトウェア開発">組込系ソフトウェア開発</label><br />
                        <label><input type="checkbox" name="it_experience[]" <?php if ($this->_tpl_vars['input']['it_experience_6']): ?>checked<?php endif; ?> value="パッケージソフト・ミドルウェア開発">パッケージソフト・ミドルウェア開発</label>
                        <?php if ($this->_tpl_vars['error']['it_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['it_experience']; ?>
</div><?php endif; ?>
	    	        </div>

	    	        <p class="switchHat">通信ネットワーク設計・構築</p>
	    	        <div class="switchDetail">
                        <label><input type="checkbox" name="network_experience[]" <?php if ($this->_tpl_vars['input']['network_experience_1']): ?>checked<?php endif; ?> value="運用、監視、テクニカルサポート、保守">運用、監視、テクニカルサポート、保守</label><br />
                        <label><input type="checkbox" name="network_experience[]" <?php if ($this->_tpl_vars['input']['network_experience_2']): ?>checked<?php endif; ?> value="社内SE、情報システム">社内SE、情報システム</label><br />
                        <label><input type="checkbox" name="network_experience[]" <?php if ($this->_tpl_vars['input']['network_experience_3']): ?>checked<?php endif; ?> value="次世代技術研究開発">次世代技術研究開発</label><br />
                        <label><input type="checkbox" name="network_experience[]" <?php if ($this->_tpl_vars['input']['network_experience_4']): ?>checked<?php endif; ?> value="【共通】 言語・OS・ミドルウェア・アプリケーションソフト使用経験">【共通】 言語・OS・ミドルウェア・アプリケーションソフト使用経験</label>
                        <?php if ($this->_tpl_vars['error']['network_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['network_experience']; ?>
</div><?php endif; ?>
	    	        </div>

	    	        <p class="switchHat">技術系（電気、電子、機械技術者）</p>
	    	        <div class="switchDetail">
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_1']): ?>checked<?php endif; ?> value="一般機械・機械部品・金型">一般機械・機械部品・金型</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_2']): ?>checked<?php endif; ?> value="特殊産業用機械">特殊産業用機械</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_3']): ?>checked<?php endif; ?> value="一般産業用機械">一般産業用機械</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_4']): ?>checked<?php endif; ?> value="事務機器・サービス用機器">事務機器・サービス用機器</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_5']): ?>checked<?php endif; ?> value="電気機器・電池・記録媒体">電気機器・電池・記録媒体</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_6']): ?>checked<?php endif; ?> value="情報・通信・AV機器">情報・通信・AV機器</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_7']): ?>checked<?php endif; ?> value="電子部品・デバイス（半導体）">電子部品・デバイス（半導体）</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_8']): ?>checked<?php endif; ?> value="電子部品・デバイス（その他）">電子部品・デバイス（その他）</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_9']): ?>checked<?php endif; ?> value="精密機器・光学機器・レンズ">精密機器・光学機器・レンズ</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_10']): ?>checked<?php endif; ?> value="輸送用機器（自動車）">輸送用機器（自動車）</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_11']): ?>checked<?php endif; ?> value="輸送用機器（その他）">輸送用機器（その他）</label><br />
                        <label><input type="checkbox" name="electricity_experience[]" <?php if ($this->_tpl_vars['input']['electricity_experience_12']): ?>checked<?php endif; ?> value="【共通】設計・解析ソフト、製造マシン使用経験">【共通】設計・解析ソフト、製造マシン使用経験</label>
                        <?php if ($this->_tpl_vars['error']['electricity_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['electricity_experience']; ?>
</div><?php endif; ?>
	    	        </div>

	    	        <p class="switchHat">化学工業品</p>
	    	        <div class="switchDetail">
                        <label><input type="checkbox" name="chemistry_experience[]" <?php if ($this->_tpl_vars['input']['chemistry_experience_1']): ?>checked<?php endif; ?> value="医薬品・化粧品・医療用品">医薬品・化粧品・医療用品</label><br />
                        <label><input type="checkbox" name="chemistry_experience[]" <?php if ($this->_tpl_vars['input']['chemistry_experience_2']): ?>checked<?php endif; ?> value="食品・飲料・たばこ・飼料">食品・飲料・たばこ・飼料</label><br />
                        <label><input type="checkbox" name="chemistry_experience[]" <?php if ($this->_tpl_vars['input']['chemistry_experience_3']): ?>checked<?php endif; ?> value="石油・石炭・プラスチック製品・ゴム・セラミック製品">石油・石炭・プラスチック製品・ゴム・セラミック製品</label><br />
                        <label><input type="checkbox" name="chemistry_experience[]" <?php if ($this->_tpl_vars['input']['chemistry_experience_4']): ?>checked<?php endif; ?> value="鉄鋼・非鉄金属・金属製品・武器">鉄鋼・非鉄金属・金属製品・武器</label><br />
                        <label><input type="checkbox" name="chemistry_experience[]" <?php if ($this->_tpl_vars['input']['chemistry_experience_5']): ?>checked<?php endif; ?> value="木材・家具・パルプ・紙加工品・生活雑貨">木材・家具・パルプ・紙加工品・生活雑貨</label><br />
                        <label><input type="checkbox" name="chemistry_experience[]" <?php if ($this->_tpl_vars['input']['chemistry_experience_6']): ?>checked<?php endif; ?> value="衣服・生地・宝飾品・アクセサリー">衣服・生地・宝飾品・アクセサリー</label><br />
                        <label><input type="checkbox" name="chemistry_experience[]" <?php if ($this->_tpl_vars['input']['chemistry_experience_7']): ?>checked<?php endif; ?> value="文具・玩具・スポーツ用品・楽器">文具・玩具・スポーツ用品・楽器</label>
                        <?php if ($this->_tpl_vars['error']['chemistry_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['chemistry_experience']; ?>
</div><?php endif; ?>
	    	        </div>

	    	        <p class="switchHat">技術系（建築、土木技術者）</p>
	    	        <div class="switchDetail">
                        <label><input type="checkbox" name="civil_engineering_experience[]" <?php if ($this->_tpl_vars['input']['civil_engineering_experience_1']): ?>checked<?php endif; ?> value="プランニング・設計（建築・土木・設備）">プランニング・設計（建築・土木・設備）</label><br />
                        <label><input type="checkbox" name="civil_engineering_experience[]" <?php if ($this->_tpl_vars['input']['civil_engineering_experience_2']): ?>checked<?php endif; ?> value="プランニング・設計（プラント）">プランニング・設計（プラント）</label><br />
                        <label><input type="checkbox" name="civil_engineering_experience[]" <?php if ($this->_tpl_vars['input']['civil_engineering_experience_3']): ?>checked<?php endif; ?> value="施工管理">施工管理</label><br />
                        <label><input type="checkbox" name="civil_engineering_experience[]" <?php if ($this->_tpl_vars['input']['civil_engineering_experience_4']): ?>checked<?php endif; ?> value="技術開発・構造解析・調査">技術開発・構造解析・調査</label><br />
                        <label><input type="checkbox" name="civil_engineering_experience[]" <?php if ($this->_tpl_vars['input']['civil_engineering_experience_5']): ?>checked<?php endif; ?> value="建築土木作業">建築土木作業</label>
                        <?php if ($this->_tpl_vars['error']['civil_engineering_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['civil_engineering_experience']; ?>
</div><?php endif; ?>
	    	        </div>

	    	        <p class="switchHat">公務系（講師、公務員、技能工ほか）</p>
	    	        <div class="switchDetail">
                        <label><input type="checkbox" name="public_service_experience[]" <?php if ($this->_tpl_vars['input']['public_service_experience_1']): ?>checked<?php endif; ?> value="公務員・教諭">公務員・教諭</label><br />
                        <label><input type="checkbox" name="public_service_experience[]" <?php if ($this->_tpl_vars['input']['public_service_experience_2']): ?>checked<?php endif; ?> value="農林水産関連職">農林水産関連職</label>
                        <?php if ($this->_tpl_vars['error']['public_service_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['public_service_experience']; ?>
</div><?php endif; ?>
	    	        </div>
    	        </dd>
    	        <dt scope="row">その他特記事項</dt>
    	        <dd>
                	<textarea name="etc_experience" cols="30" rows="12" class="formItem02"><?php echo $this->_tpl_vars['input']['etc_experience']; ?>
</textarea>
                    <?php if ($this->_tpl_vars['error']['etc_experience']): ?><div class="error"><?php echo $this->_tpl_vars['error']['etc_experience']; ?>
</div><?php endif; ?>
    	        </dd>
			</dl>
			<div class="btnwrap"><input type="image" src="../img/share_contact_entry_confirmbtn.gif" alt="確認画面へ" title="確認画面へ" width="200" height="44" /></div>
		</form>
	</div></div><!-- #main End-Page_Content -->
	
	<div id="side" class="pc"><div class="spcellwrap">
		<div class="pc">
		   	<h2><img src="../img/common_sidebn0.gif" alt="無料" width="304" height="33" /></h2>
		    <div id="sideNav01">
		    	<ul>
		        	<li class="nav01"><a href="../entry/" title="登録申込">登録申込</a></li>
		            <li class="nav02"><a href="../contact/" title="お問合せ">お問合せ</a></li>
		        </ul>
		    </div><!-- #sideNav01 -->
		    <div id="sideNav02">
		    	<ul>
		        	<li class="nav01"><a href="../about.html" title="MyJobIsとは">MyJobIsとは</a></li>
		            <li class="nav02"><a href="../client.html" title="企業の皆様へ">企業の皆様へ</a></li>
		            <li class="nav03"><a href="../worker.html" title="働く皆様へ">働く皆様へ</a></li>
		            <li class="nav04"><a href="../job.html" title="求人一覧">求人一覧</a></li>
		        </ul>
		    </div><!-- #globalNav02 -->
		</div>
	    </div><!-- #globalNav02 -->
    </div></div><!-- #side -->
</div><!-- #container -->

<div id="foot_btncontainer" class="spcellwrap">
	<div class="banabox pc">
		<ul class="clearfix">
			<li><a href="../about.html"><img src="../img/common_footbn1-1.gif" alt="MyJobIsとは" title="MyJobIsとは" width="304" height="103" /></a></li>
			<li><a href="../client.html"><img src="../img/common_footbn1-2.gif" alt="企業のみなさまへ" title="企業のみなさまへ" width="304" height="103" /></a></li>
			<li class="end"><a href="../worker.html" class="end"><img src="../img/common_footbn1-3.gif" alt="働く皆様へ" title="働く皆様へ" width="304" height="103"  /></a></li>
		</ul>
	</div>
    <div class="sp">
    	<ul>
            <li class="nav01"><a href="../entry/" title="登録申込"><img src="../img/sp_common_sidebn1.gif" alt="登録申込" title="登録申込" width="297" height="67"  /></a></li>
            <li class="nav02"><a href="../contact/" title="お問合せ"><img src="../img/sp_common_sidebn2.gif" alt="お問合せ" title="お問合せ" width="297" height="67"  /></a></li>
        </ul>
    </div><!-- .sp -->
</div><!-- #foot_btncontainer -->

<div id="pagetop"><a href="#HEADER"><img src="../img/common_btn_top.png" alt="TOP" width="49" height="49" /></a></div>
<div id="footerWrapper">
	<div id="footer" class="cleafix">
		<div class="tool01 tableRow"><div class="spcellwrap"><a href="../"><img src="../img/common_img_footlogo.gif" alt="MyJobIs" title="MyJobIsホーム" width="202" height="45" /></a></div></div>
	    <div class="tableTop"><ul class="tool02 clearfix">
	        <li><a href="../about.html">My Job Isとは</a></li>
	        <li><a href="../client.html">企業の皆様へ</a></li>
	        <li><a href="../worker.html">働く皆様へ</a></li>
	        <li><a href="../job.html">求人一覧</a></li>
	        <li><a href="../entry/">登録申込</a></li>
	        <li><a href="../contact/">お問合せ</a></li>
	        <li class="end"><a href="../sitepolicy.html">サイトポリシー</a></li>
	    </ul></div>
	</div><!-- #footer -->
</div><!-- #footerWrapper -->
<div id="copyright">Copyright © 2015 My Job is Co,Ltd. All rights Reserved.</div><!-- #Copyright -->
</body>
</html>