<!-- サイドバー -->
<div id="sidebar">

	<div class="sidebarBannar">
		<a href="<?php echo ROOT_PATH?>staging/maxfields/contact/"><img src="<?php echo ROOT_PATH?>maxfields/img/sidebar/bnr_contact.gif" alt="お問い合わせ" width="230" height="140"></a>
	</div><!--/.sidebarBannar-->

	<?php switch(BODY_CLASS):
		case 'hoge':?>
		<?php break;?>
		<?php case 'info':?>
		<?php break;?>
		<?php case 'about':?>
			<div class="sidebarLocalNav">
				<h2>
					<a href="<?php echo ROOT_PATH?>staging/maxfields/about/">
						<img src="<?php echo ROOT_PATH?>staging/maxfields/img/sidenav_about.gif" alt="about us">
						<span>マックスフィールズとは</span>
					</a>
				</h2>
				<ul>
					<li>
						<a href="<?php echo ROOT_PATH?>staging/maxfields/about/">Change your business</a>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>staging/maxfields/about/outline
.html">会社概要</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/about/outline.html#anchor-business">事業内容</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/about/outline.html#anchor-profile">会社情報</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/about/outline.html#anchor-group">グループ企業</a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>staging/maxfields/about/access
.html">アクセスマップ</a>
					</li>
				</ul>
			</div>
		<?php break;?>
		<?php case 'consult':?>
			<div class="sidebarLocalNav">
				<h2>
					<a href="<?php echo ROOT_PATH?>staging/maxfields/consult/">
						<img src="<?php echo ROOT_PATH?>staging/maxfields/img/sidenav_consult.gif" alt="consulting">
						<span>コンサルティング事業</span>
					</a>
				</h2>
				<ul>
					<li>
						<a href="<?php echo ROOT_PATH?>staging/maxfields/consult/">サービス概要</a>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>staging/maxfields/consult/service
.html">サービスコンサルティング</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/consult/service
.html">sp deco</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/consult/planning
.html">プランニングシステム</a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>staging/maxfields/consult/staff
.html">労務コンサルティング</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/consult/staff.html#anchor-concept">コンセプト</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/consult/staff.html#anchor-menu">コンサルティングメニュー</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/consult/staff.html#anchor-backup">バックアップ体制</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/consult/staff.html#anchor-case">導入事例</a></li>
						</ul>
					</li>
				</ul>
			</div>
		<?php break;?>
		<?php case 'outsource':?>
			<div class="sidebarLocalNav">
				<h2>
					<a href="<?php echo ROOT_PATH?>staging/maxfields/outsource/">
						<img src="<?php echo ROOT_PATH?>staging/maxfields/img/sidenav_outsource.gif" alt="outsource">
						<span>アウトソーシング事業</span>
					</a>
				</h2>
				<ul>
					<li>
						<a href="<?php echo ROOT_PATH?>staging/maxfields/outsource/">サービス概要</a>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>staging/maxfields/outsource/case
.html">導入事例</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/outsource/case.html#anchor-product">製造部門</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/outsource/case.html#anchor-transport">物流部門</a></li>
							<li><a href="<?php echo ROOT_PATH?>staging/maxfields/outsource/case.html#anchor-sale">店舗・販売</a></li>
						</ul>
					</li>
				</ul>
			</div>
		<?php break;?>

		<?php case 'careerpro':?>
			<div class="sidebarLocalNav">
				<h2>
					<a href="<?php echo ROOT_PATH?>staging/maxfields/careerpro/">
						<img src="<?php echo ROOT_PATH?>staging/maxfields/img/sidenav_careerpro.gif" alt="career produce">
						<span>職業紹介</span>
					</a>
				</h2>
				<ul>
					<li>
						<a href="<?php echo ROOT_PATH?>staging/maxfields/careerpro/index
.html">紹介予定派遣</a>
						<ul>
							<!--<li><a href="<?php echo ROOT_PATH?>maxfields/careerpro/index.html#anchor-flow">紹介予定派遣までの流れ</a></li>-->
						</ul>
					</li>

				</ul>
			</div>
		<?php break;?>
		<?php default:?>
		<?php break;?>
	<?php endswitch;?>

	<div class="sidebarBannar">
		<a href="<?php echo ROOT_PATH?>staging/maxfields/about/"><img src="<?php echo ROOT_PATH?>maxfields/img/sidebar/bnr_change_ur_biz.jpg" alt="change your business" width="230" height="140"></a>
	</div><!--/.sidebarBannar-->

	<div class="sidebarBannar">
		<a href="<?php echo ROOT_PATH?>staging/maxfields/consult/service
.html"><img src="<?php echo ROOT_PATH?>staging/maxfields/img/sidebar/bnr_spdeco.jpg" alt="spdeco" width="230" height="140"></a>
	</div><!--/.sidebarBannar-->


	<div class="sidebarBannar">
		<a href="http://www.evolve-max.com/staging/sophia/search/"><img src="<?php echo ROOT_PATH?>maxfields/img/sidebar/bnr_kyujin.gif" alt="マックスフィールズグループ求人一覧" width="230" height="120"></a>
	</div><!--/.sidebarBannar-->

	<div class="sidebarBannar">
	<a href="https://crosslearning.jp/max/"><img src="<?php echo ROOT_PATH?>staging/maxfields/img/sidebar/cross-learning-logo1.png" style="width:230px; height:auto"></a>
	</div><!--/.sidebarBannar-->
	<div class="sidebarBannar">
	<a href="https://reserve.resort.co.jp/reservation/cmc/co_top.html"><img src="<?php echo ROOT_PATH?>staging/maxfields/img/sidebar/resorttrust-logo2.png" style="width:230px; height:auto"></a>
	</div><!--/.sidebarBannar-->

</div><!--/#sidebar-->
