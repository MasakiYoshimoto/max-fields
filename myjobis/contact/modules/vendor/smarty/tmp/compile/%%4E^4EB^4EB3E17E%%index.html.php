<?php /* Smarty version 2.6.27, created on 2015-05-26 10:56:33
         compiled from /var/www/vhosts/evolve-max.com/httpdocs/myjobis/contact/modules/tpl/index.html */ ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="あなたのライフスタイルに合わせた短時間求人のマイジョブイズです。お問合せはお気軽に。" />
<meta name="keywords" content="求人,求職,アルバイト,パート,短期,短時間,ライフスタイル,女性,リクルート,採用,スキル,キャリア" />
<title>短期・短時間の求人｜マイジョブイズ My job is｜お問合せ</title>
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
		<h1 class="contact"><img src="../img/contact_h1.jpg" alt="Contact/お問合せ" title="Contact/お問合せ" width="1000" height="132" /></h1>
		<ol id="topicpath">
			<li>HOME</li>
			<li class="end"><a href="../contact/">お問合せ</a></li>
		</ol>
	</div>
</div><!-- #eyecatchWrapper -->

<div id="container" class="clearfix">
	<div id="main" class="tableRow"><div class="spcellwrap"><!-- Start-Page_Content -->
	    <h2><img src="../img/contact_h2_01.gif" width="269" height="21" alt="お問合せフォーム" /></h2>
	    <script type="text/javascript" src="https://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3-https.js" charset="UTF-8"></script>
		<form name="contact" class="mailform" action="./" method="post">
            <input type="hidden" name="m" value="2" />
			<p>この度は弊社サイトへアクセスいただきありがとうございます。下記項目へ入力してください。<br />
			<em>*</em>は必須項目です。</p>
			<?php if ($this->_tpl_vars['error']): ?><p class="error">入力内容に誤りがあります。下記内容を確認し、再度入力してください。</p><?php endif; ?>
			<dl class="mainlist">
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
                    <span class="note">市区郡以降</span>
                    <input name="address" type="text" id="address02" value="<?php echo $this->_tpl_vars['input']['address']; ?>
" class="sizeL" />
                    <?php if ($this->_tpl_vars['error']['address']): ?><div class="error"><?php echo $this->_tpl_vars['error']['address']; ?>
</div><?php endif; ?>
                </dd>
				<dt>お問い合わせ内容<em>*</em></dt>
				<dd>
                    <textarea name="contents"><?php echo $this->_tpl_vars['input']['contents']; ?>
</textarea>
                    <?php if ($this->_tpl_vars['error']['contents']): ?><div class="error"><?php echo $this->_tpl_vars['error']['contents']; ?>
</div><?php endif; ?>
                </dd>
			</dl>
			<div class="btnwrap"><input type="image" src="../img/share_contact_entry_confirmbtn.gif" alt="確認画面へ" title="確認画面へ" width="200" height="44" /></div>
		</form>
	</div></div><!-- #main End-Page_Content -->
	
	<div id="side" class="pc"><div class="spcellwrap">
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