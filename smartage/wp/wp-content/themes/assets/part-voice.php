<?php
$query = array(	//クエリー初期設定
	'post_type'      => 'voice',					//投稿タイプ
	'post_status'    => 'publish',				//公開済みの記事
	'posts_per_page' => -1,						//出力数　-1で全件
	'order'          => 'ASC',					//昇順ソート
);
$query = new WP_Query($query);
?>
<?php if($query -> have_posts())://冒頭の処理 ?>
<?php while($query -> have_posts()): $query -> the_post(); ?>
<li id="post-<?php the_ID(); ?>">
	<div class="head flex vtop">
		<p class="title">お客様の声</p>
		<h2 class="name"><?php the_title(); ?> 様</h2>
	</div>
	<div class="box">
		<?php the_content(); ?>
	</div>
</li>
<?php endwhile;//最後の処理 ?>
<?php else://検索結果がなかった時の処理 ?>
<?php endif; wp_reset_postdata();//処理終了 ?>
