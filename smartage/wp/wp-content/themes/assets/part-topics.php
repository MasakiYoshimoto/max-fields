
<ul class="topics-list">
<?php
$query = array(	//クエリー初期設定
	'post_type'      => 'post',					//投稿タイプ
	'post_status'    => 'publish',				//公開済みの記事
	'posts_per_page' => 20,						//出力数　-1で全件
	'order'          => 'DESC',					//降順ソート
	'orderby'        => 'date',					//投稿日でソート
	'paged'          => get_query_var('paged'),	//ページ番号を考慮
);
$query = new WP_Query($query);
?>
<?php if($query -> have_posts())://冒頭の処理 ?>
<?php while($query -> have_posts()): $query -> the_post(); ?>
<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	<div class="post-frame flex">
		<time class="date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
		<h2 class="title"><span class="in js-t8-2"><?php the_title(); ?></span></h2>
	</div>
</a></li>
<?php endwhile;//最後の処理 ?>
<?php else://検索結果がなかった時の処理 ?>
<?php endif; wp_reset_postdata();//処理終了 ?>
</ul>

<?php flex_pager(array(
	'query'          => $query,             //使用クエリー
	'range'          => 3,                  //カレントからのページボタン数　指定数*2+1が総数
	'current_format' => '<span class="active">%d</span>',  //カレントボタンのレイアウト
	'prev_next'      => true,               //戻る/進むボタン
	'edge_pn'        => false,              //ページ末端側の戻る/進むボタンを表示するか
	'prev_label'     => '<i class="icon-fa fa fa-angle-left"  aria-hidden="true"></i>',  //戻るボタンテキスト
	'next_label'     => '<i class="icon-fa fa fa-angle-right" aria-hidden="true"></i>',  //進むボタンテキスト
	'first_last'     => false,               //最初/最後ボタン
	'first_last_no'  => false,               //最初/最後ナンバー
	'edge_fl'        => false,              //ページ末端側の最初/最後ボタンを表示するか
	'first_label'    => '<i class="icon-fa fa fa-angle-double-left"  aria-hidden="true"></i>',  //最初ボタンテキスト
	'last_label'     => '<i class="icon-fa fa fa-angle-double-right" aria-hidden="true"></i>',  //最後ボタンテキスト
	'op_left'        => '',                 //左側オプション　%d（現ページ）%d（総ページ）
	'op_right'       => '',                 //右側オプション　%d（現ページ）%d（総ページ）
	'navi_class'     => 'flex-pager',       //ナビのクラス スペース区切りで複数指定
	'navi_id'        => '',                 //ナビのID
	'child_class'    => '',                 //子要素のクラス
	'navi_type'      => 'div',              //ナビのタイプ
	'child_wrap'     => '',                 //子要素を括る要素
	'cw_class'       => '',                 //child_wrapのクラス
	'cw_cu_class'    => '',                 //child_wrapのカレントボタンクラス
	'off_class'      => 'off',              //edgeオプションで表示している要素のクラス wrap有効時はそちらに付加
	'echo'           => true,               //出力するか、値で返すか
)); ?>
