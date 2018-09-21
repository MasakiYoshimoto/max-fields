<?php
/*
Template Name:総合ランキング/all
*/
?>
<?php get_header(); ?>
<div class="l-top">
	<div class="mv">
		<div class="wrap in">
			<div class="img">
				<img src="<?php echo T_URL; ?>img/top_mv_logo.png" alt="スマートエイジ">
			</div>
			<div class="anime-box">
				<div class="swiper-anime">
					<div class="swiper-wrapper">
						<div class="swiper-slide before">
							<h2 class="main anime bottom-in wave1">御社の求人足りていますか？</h2>
							<p class="sub anime bottom-in wave2">
								人手が足りずシフトがまわらない…<br>
								求人広告を出しても応募がない…
							</p>
						</div>
						<div class="swiper-slide after">
							<h2 class="main anime bottom-in wave1">少子高齢化社会の人材不足を<br>スマートに解決</h2>
							<p class="sub anime bottom-in wave2">
								３人まとめてご紹介プラン実施中<br>
								時間あたり980円×3時間 3人から
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="wrap">
		<section class="topics"><div class="topics-in">
			<ul class="flex vcenter">
				<li class="head"><h2>トピックス</h2></li>
				<li class="post">
					<?php
					$query = array(	//クエリー初期設定
						'post_type'      => 'post',					//投稿タイプ
						'post_status'    => 'publish',				//公開済みの記事
						'posts_per_page' => 10,						//出力数　-1で全件
						'order'          => 'DESC',					//降順ソート
						'orderby'        => 'date',					//投稿日でソート
					);
					$query = new WP_Query($query);
					?>
					<div class="swiper-topics"><div class="swiper-wrapper">
					<?php if($query -> have_posts())://冒頭の処理 ?>
					<?php while($query -> have_posts()): $query -> the_post(); ?>
					<div class="swiper-slide"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<div class="flex vcenter">
							<time class="date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
							<div class="name"><?php the_title(); ?></div>
						</div>
					</a></div>
					<?php endwhile;//最後の処理 ?>
					<?php else://検索結果がなかった時の処理 ?>
					<?php endif; wp_reset_postdata();//処理終了 ?>
					
					</div></div>
					<div class="swiper-controller">
						<div class="swiper-button-prev">
							<i class="icon-fa fa fa-fw fa-chevron-up" aria-hidden="true"></i>
						</div>
						<div class="swiper-button-next">
							<i class="icon-fa fa fa-fw fa-chevron-down" aria-hidden="true"></i>
						</div>
					</div>
				</li>
				<li class="more">
					
					<a href="<?php echo H_URL; ?>topics/">一覧はこちら</a>
				</li>
			</ul>
		</div></section>
	</div>



	<section>
		<div class="trouble">
			<div class="wrap in">
				<h3><span class="brackets">「</span> 人材に<span>悩んで</span>いませんか？ <span class="brackets">」</span></h3>
				<ul>
					<li><span>求人広告を出しても</span>人が集まらない</li>
					<li><span>短時間・短期間</span>スタッフが欲しい</li>
					<li><span>採用にかかるコスト</span>を削減したい</li>
					<li><span>繁忙期・ピーク</span>だけ人がほしい</li>
					<li><span>経験・キャリア</span>のある即戦力が欲しい</li>
					<li><span>アルバイト、パート</span>の急な欠員の対応</li>
				</ul>
			</div>
		</div>

		<div class="solution">
			<div class="wrap in">
				<h3>そのような悩み、<span class="green">スマートエイジ</span>で<span class="big">解決</span>できます！</h3>
				<div class="reason">
					<h4>スマートエイジで解決できる<span>３</span>つの理由!!</h4>
					<ul>
						<li>
							<img class="" src="<?php echo T_URL; ?>img/top_solution_img_01.png" width="121" height="157" alt="">
							<h5>
								<span class="no">1</span>
								<span class="brackets">“</span>
								<span class="orange">スマートエイジ</span>
								は人手不足を解消する新しい人材サービスです
								<span class="brackets">”</span>
							</h5>
							<div class="flex-box">
								<p class="noto">
									ソフィアマックスが提供する人手不足を解消する新しい人材派遣サービスです。多くの人材を必要とする繁忙期を始め、短期間、短時間など貴社の業務状況に応じいろいろなご活用がいただける、まさに時代のニーズにマッチしたシステムです。
								</p>
								<ul>
									<li>
										<img class="" src="<?php echo T_URL; ?>img/top_solution_icon_01.png" width="74" height="72" alt="">
									</li>
									<li>
										<img class="" src="<?php echo T_URL; ?>img/top_solution_icon_02.png" width="74" height="72" alt="">
									</li>
									<li>
										<img class="" src="<?php echo T_URL; ?>img/top_solution_icon_03.png" width="74" height="72" alt="">
									</li>
								</ul>
							</div>
						</li>
						<li>
							<h5>
								<span class="no">2</span>
								<span class="brackets">“</span>
								派遣の概念を変える「<span class="orange">スマートエイジ</span>」
								<span class="brackets">”</span>
							</h5>
							<div class="flex-box">
								<p class="noto">
									少子高齢者社会が急速に進み、労働者不足は深刻な社会問題であり企業の大きな課題です。あらゆる職種で問題が生じ速やかな対応が求められています。
当社ではこの緊急事態の解決策としてミドルシニア世代に着目し、「スマートエイジ」を生み出しました。６０代を中心としたミドルシニア世代は勤勉で労働意欲が高く、豊富な経験をもち、臨機応変に対応できる高い能力を有しているのも魅力です。今、人材不足の現場をミドルシニア世代が強力にサポートする時です。生き生き働くミドルシニアを生み出し、会社も社会も活性化し、好循環を生み出す「スマートエイジ」なしに未来は語れません。今すぐご検討ください。

								</p>
								<ul>
									<li>
										<img class="" src="<?php echo T_URL; ?>img/top_solution_icon_04.png" width="74" height="72" alt="">
									</li>
									<li>
										<img class="" src="<?php echo T_URL; ?>img/top_solution_icon_05.png" width="74" height="72" alt="">
									</li>
									<li>
										<img class="" src="<?php echo T_URL; ?>img/top_solution_icon_06.png" width="74" height="72" alt="">
									</li>
								</ul>
							</div>
						</li>
						<li>
							<h5>
								<span class="no">3</span>
								<span class="brackets">“</span>
								<span class="orange">現場が求めるキャリア・経験</span>
								を持ち合わせる即戦力人材の派遣
								<span class="brackets">”</span>
							</h5>
							<div class="flex-box">
								<p class="noto">
									登録スタッフは、まだまだ体力・気力充実、就業意欲も併せもつ、元気いっぱいの人材。「豊富な経験」「高い能力」を有する即戦力として、質の高い労働力を提供可能です。シニア層ならではの、職務経験の豊かさと、ヒューマンスキルの高さで、様々なクライアント先に臨機応変に対応でき、且つ即戦力として期待できる人材提供が可能なサービスが「スマートエイジ」なのです。
								</p>
								<ul>
									<li>
										<img class="" src="<?php echo T_URL; ?>img/top_solution_icon_07.png" width="74" height="72" alt="">
									</li>
									<li>
										<img class="" src="<?php echo T_URL; ?>img/top_solution_icon_08.png" width="74" height="72" alt="">
									</li>
									<li>
										<img class="" src="<?php echo T_URL; ?>img/top_solution_icon_09.png" width="74" height="72" alt="">
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
				<img class="person-02" src="<?php echo T_URL; ?>img/top_solution_img_02.png" width="273" height="268" alt="">
				<img class="person-03" src="<?php echo T_URL; ?>img/top_solution_img_03.png" width="198" height="199" alt="">
			</div>
		</div>

		<section class="str sec-box"><div class="wrap">
			<h3 class="sec-head bar">スマートエイジの強み</h3>
			<ul class="flex str-list hcenter vtop break">
				<li>
					<div class="img">
						<img src="<?php echo T_URL; ?>img/top_str_01.png" alt="人材不足問題をスピーディーに解決できます">
					</div>
					<h4 class="head">
						人材不足問題を<br>
スピーディーに解決できます
					</h4>
					<p class="text">
						定年後も働きたいミドルシニアが増加している中、就業先がまだ少ない事から採用率も高く、良い人材を早く集めることができます。<br>
						人材不足の企業と働きたいミドルシニア層をつなぐ便利なサービスです。
					</p>
				</li>
				<li>
					<div class="img">
						<img src="<?php echo T_URL; ?>img/top_str_02.png" alt="社会経験が豊富で仕事に対しての責任感が強い">
					</div>
					<h4 class="head">
						社会経験が豊富で<br>仕事に対しての責任感が強い
					</h4>
					<p class="text">
						「欠勤が少ない」 「気が回る」といった就業に対する高い責任感をお持ちの方が多いのがミドルシニアの強みです。また、豊富な人生経験や社会経験が企業のプラスになります。
					</p>
				</li>
				<li>
					<div class="img">
						<img src="<?php echo T_URL; ?>img/top_str_03.png" alt="派遣可能職種は軽作業から専門職まで幅広く対応">
					</div>
					<h4 class="head">
						派遣可能職種は軽作業から<br>専門職まで幅広く対応

					</h4>
					<p class="text">
						豊富な職業経験を有しているので、業務経験者、資格所有者等、即戦力の人材を見つけることができます。
					</p>
				</li>
				<li>
					<div class="img">
						<img src="<?php echo T_URL; ?>img/top_str_04.png" alt="人材が必要なタイミングのみご利用可能">
					</div>
					<h4 class="head">
						人材が必要なタイミングのみ<br>ご利用可能
					</h4>
					<p class="text">
						１日３時間～・週１日からフレキシブルにご利用頂けます。パートタイムの短時間、忙しい曜日、時間帯のみのご利用も可能です。
					</p>
				</li>
				<li>
					<div class="img">
						<img src="<?php echo T_URL; ?>img/top_str_05.png" alt="利用した分だけしかかからない料金">
					</div>
					<h4 class="head">
						利用した分だけしか<br>かからない料金
					</h4>
					<p class="text">
						基本契約費、月額基本料、広告費など一切かかりません。 
					</p>
				</li>
			</ul>
			
		</div></section>
		
		<section class="point sec-box"><div class="wrap">
			<h3 class="sec-head white">求人広告で自社採用するよりこんなに便利です！</h3>
			<table>
				<thead>
					<tr>
						<th></th>
						<th>通常の求人広告を使用して自社採用した場合</th>
						<th>スマートエイジを利用した場合</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>採用コスト</th>
						
						<td><i class="icon ionicons ion-close"></i><span class="text">人材が集まるまで求人広告費がかかります</span></td>
						<td><i class="icon icon-fa fa fa-circle-o" aria-hidden="true"></i><span class="text">スタッフ稼働分のみご請求なのでコストを削減できます</span></td>
					</tr>
					<tr>
						<th>採用スピード</th>
						<td><i class="icon ionicons ion-close"></i><span class="text">広告製作→掲載→応募→面接→採用まで<br>時間がかかります</span></td>
						<td><i class="icon icon-fa fa fa-circle-o" aria-hidden="true"></i><span class="text">豊富な登録スタッフの中から貴社のニーズに<br>マッチした人材をピックアップしご紹介いたします</span></td>
					</tr>
					<tr>
						<th>シフト調整</th>
						<td><i class="icon ionicons ion-close"></i><span class="text">自社で調整が必要</span></td>
						<td><i class="icon icon-fa fa fa-circle-o" aria-hidden="true"></i><span class="text">弊社にて調整を行うので手間がかかりません</span></td>
					</tr>
					<tr>
						<th>安定就業のサポート、<br>運用管理</th>
						<td><i class="icon ionicons ion-close"></i><span class="text">自社にて対応</span></td>
						<td><i class="icon icon-fa fa fa-circle-o" aria-hidden="true"></i><span class="text">スタッフとコミュニケーションを図り<br>様々なサポートを行っております</span></td>
					</tr>
				</tbody>
			</table>
		</div></section>


		<div id="type" class="dispatch">
			<div class="wrap in">
				<h3>対応業種について</h3>
				<p class="text">
					どんなお仕事にも対応します
				</p>
				<ul>
					<li>
						<img class="" src="<?php echo T_URL; ?>img/top_dispatch_img_02.png" width="250" height="251" alt="軽作業　・商品管理 ・運送 ・土木">
					</li>
					<li>
						<img class="" src="<?php echo T_URL; ?>img/top_dispatch_img_03.png" width="251" height="251" alt="サービス　点検業務 ・娯楽施設">
					</li>
					<li>
						<img class="" src="<?php echo T_URL; ?>img/top_dispatch_img_04.png" width="251" height="250" alt="販売　・スーパー ・食品 ・コンビニ">
					</li>
					<li>
						<img class="" src="<?php echo T_URL; ?>img/top_dispatch_img_05.png" width="250" height="250" alt="製造　・工場 ・フォークリフト">
					</li>
					<li>
						<img class="" src="<?php echo T_URL; ?>img/top_dispatch_img_06.png" width="251" height="250" alt="フード 食品　・レストラン ・居酒屋">
					</li>
					<li>
						<img class="" src="<?php echo T_URL; ?>img/top_dispatch_img_07.png" width="251" height="251" alt="オフィス　・事務 ・電話オペレーター">
					</li>
				</ul>
			</div>
		</div>

		<section id="flow" class="guide">
			<div class="wrap in">
				<h3>ご利用までの流れ</h3>
				<ul>
					<li>
						<h4>“<span>お問い合わせください</span>”</h4>
						<p class="noto">
							まずはお気軽にお問合わせください。<br>
							お客様専任のコーディネーターが、職種、期間、就業条件、職場環境などをヒアリング<br>させていただきます。
						</p>
					</li>
					<li>
						<h4>“<span>ヒアリング</span>”</h4>
						<p class="noto">
							営業スタッフがお伺いし、貴社のニーズを詳しくお聞きします。<br>
							貴社のご要望に合わせた人材を選出する為、ヒアリングに時間をかけております。
						</p>
					</li>
					<li>
						<h4>“<span>人材のマッチング</span>”</h4>
						<p class="noto">
							貴社のニーズに合った資格・経験・能力等を有する適材スタッフを人材データベースの<br>
							中から選出いたします。派遣する人材には事前に面談を行っておりますので、貴社の条<br>
							件やご要望もしっかり共有いたします。
						</p>
					</li>
					<li>
						<h4>“<span>派遣開始</span>”</h4>
						<p class="noto">
							ご契約締結後、マッチングしたスタッフを貴社に派遣いたします。
						</p>
					</li>
					<li>
						<h4>“<span>派遣後もサポート</span>”</h4>
						<p class="noto">
							就業開始後も円滑に仕事ができるようスタッフとコミュニケーションを図り、ご契約期<br>間満了までサポートいたします。
						</p>
					</li>
				</ul>
			</div>
		</section>
		
		<section class="area"><div class="wrap">
			<h3 class="sec-head bar">対応可能エリア</h3>
			<div class="area-box">
				<ul class="flex vcenter">
					<li class="icon"><i class="ionicons ion-ios-location"></i></li>
					<li class="head">静岡県</li>
					<li class="text">静岡市・焼津市・藤枝市・島田市・浜松市・磐田市・沼津市・三島市・富士市・富士宮市</li>
				</ul>
			</div>
		</div></section>
	</section>
</div>

<!-- /.l-contents -->
<?php get_footer();
