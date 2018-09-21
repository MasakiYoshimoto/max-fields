
		<footer id="footer" class="l-footer">
			<a href="#" class="pagetop" id="to-top">
				<img class="" src="<?php echo T_URL; ?>img/footer_top_btn.png" width="20" height="10" alt="TOP">
			</a>

			<section class="footer-middle">
				<div class="wrap in">
					<h3>スマートエイジは人材不足の現場を強力にサポート！</h3>
					<img class="" src="<?php echo T_URL; ?>img/footer_decoration_01.png" width="783" height="27" alt="">
					<p class="noto">
						人材に関するお悩みご相談も受け付けております。<br>
						お気軽にお問い合わせください。
					</p>
					<a href="<?php echo H_URL; ?>contact">法人のご担当者様　お問い合わせはこちら</a>
				</div>
			</section>
			
			<?php include(A_PATH . 'part-site-menu.php');//サイトメニュー ?>

			<div class="footer-btm">
				<div class="wrap">
					<ul class="flex bet vcenter">
						<li>
							<div class="top-txt noto">
								<h1 class="">
									<img class="" src="<?php echo T_URL; ?>img/footer_logo.png" width="175" height="47" alt="Smart Age">
								</h1>
							</div>
							<div class="btm-txt noto">
								<p class="l-txt">
									株式会社 ソフィアマックス<br>
									〒105-0004　東京都港区新橋3-3-14 田村町ビル7F<br>
									TEL:03-5510-5271　FAX:03-5510-5272
								</p>
							</div>
						</li>
						<li><a href="http://www.evolve-max.com/" target="_blank">
							<img src="<?php echo T_URL; ?>img/max_logo.png" alt="マックスフィールズグループ">
						</a></li>
					</ul>
				</div>
			</div>
			<p class="copy">&copy; Sophia max Inc.</p>
		</footer>
		<!-- /.l-footer -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.min.js"></script>
		<script src="<?php echo T_URL; ?>js/trunk8.min.js"></script>
		<script src="<?php echo T_URL; ?>js/common.min.js?v=<?php echo filemtime(get_template_directory().'/js/common.min.js'); ?>"></script>
		<?php wp_footer(); ?>
</body>
</html>
