<!-- サイドバー -->
<div id="sidebar">

	<div class="sidebarBannar">
		<a href="<?php echo ROOT_PATH?>maxfields/contact/"><img src="<?php echo ROOT_PATH?>maxfields/img/sidebar/bnr_contact.gif" alt="お問い合わせ" width="230" height="140"></a>
	</div><!--/.sidebarBannar-->

	<?php switch(BODY_CLASS): 
		case 'hoge':?>
		<?php break;?>
		<?php case 'info':?>
		<?php break;?>
		<?php case 'about':?>
			<div class="sidebarLocalNav">
				<h2>
					<a href="<?php echo ROOT_PATH?>maxfields/about/">
						<img src="<?php echo ROOT_PATH?>maxfields/img/sidenav_about.gif" alt="about us">
						<span>マックスフィールズとは</span>
					</a>
				</h2>
				<ul>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/about/">Change your business</a>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/about/outline
.html">会社概要</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>maxfields/about/outline.html#anchor-business">事業内容</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/about/outline.html#anchor-profile">会社情報</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/about/outline.html#anchor-brunches">支社・支店</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/about/outline.html#anchor-group">グループ企業</a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/about/access
.html">アクセスマップ</a>
					</li>
				</ul>
			</div>
		<?php break;?>
		<?php case 'consult':?>
			<div class="sidebarLocalNav">
				<h2>
					<a href="<?php echo ROOT_PATH?>maxfields/consult/">
						<img src="<?php echo ROOT_PATH?>maxfields/img/sidenav_consult.gif" alt="consulting">
						<span>コンサルティング事業</span>
					</a>
				</h2>
				<ul>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/consult/">サービス概要</a>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/consult/service
.html">サービスコンサルティング</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>maxfields/consult/service
.html">sp deco</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/consult/planning
.html">プランニングシステム</a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/consult/staff
.html">労務コンサルティング</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>maxfields/consult/staff.html#anchor-concept">コンセプト</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/consult/staff.html#anchor-menu">コンサルティングメニュー</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/consult/staff.html#anchor-backup">バックアップ体制</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/consult/staff.html#anchor-case">導入事例</a></li>
						</ul>
					</li>
				</ul>
			</div>
		<?php break;?>
		<?php case 'outsource':?>
			<div class="sidebarLocalNav">
				<h2>
					<a href="<?php echo ROOT_PATH?>maxfields/outsource/">
						<img src="<?php echo ROOT_PATH?>maxfields/img/sidenav_outsource.gif" alt="outsource">
						<span>アウトソーシング事業</span>
					</a>
				</h2>
				<ul>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/outsource/">サービス概要</a>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/outsource/case
.html">導入事例</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>maxfields/outsource/case.html#anchor-product">製造部門</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/outsource/case.html#anchor-transport">物流部門</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/outsource/case.html#anchor-sale">店舗・販売</a></li>
						</ul>
					</li>
				</ul>
			</div>
		<?php break;?>

		<?php case 'careerpro':?>
			<div class="sidebarLocalNav">
				<h2>
					<a href="<?php echo ROOT_PATH?>maxfields/careerpro/">
						<img src="<?php echo ROOT_PATH?>maxfields/img/sidenav_careerpro.gif" alt="career produce">
						<span>職業紹介</span>
					</a>
				</h2>
				<ul>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/careerpro/">キャリプロとは</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>maxfields/careerpro/#anchor-about">職業紹介について</a></li>
							<li><a href="<?php echo ROOT_PATH?>maxfields/careerpro/#anchor-flow">職業紹介の流れ</a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo ROOT_PATH?>maxfields/careerpro/syokai
.html">紹介予定派遣について</a>
						<ul>
							<li><a href="<?php echo ROOT_PATH?>maxfields/careerpro/syokai.html#anchor-flow">紹介予定派遣までの流れ</a></li>
						</ul>
					</li>
					
				</ul>
			</div>
		<?php break;?>
		<?php default:?>
		<?php break;?>
	<?php endswitch;?>

	<div class="sidebarBannar">
		<a href="<?php echo ROOT_PATH?>maxfields/about/"><img src="<?php echo ROOT_PATH?>maxfields/img/sidebar/bnr_change_ur_biz.jpg" alt="change your business" width="230" height="140"></a>
	</div><!--/.sidebarBannar-->

	<div class="sidebarBannar">
		<a href="<?php echo ROOT_PATH?>maxfields/consult/service
.html"><img src="<?php echo ROOT_PATH?>maxfields/img/sidebar/bnr_spdeco.jpg" alt="spdeco" width="230" height="140"></a>
	</div><!--/.sidebarBannar-->


	<div class="sidebarBannar">
		<a href="http://www.evolve-max.com/gmi/search/"><img src="<?php echo ROOT_PATH?>maxfields/img/sidebar/bnr_kyujin.gif" alt="マックスフィールズグループ求人一覧" width="230" height="120"></a>
	</div><!--/.sidebarBannar-->

</div><!--/#sidebar-->