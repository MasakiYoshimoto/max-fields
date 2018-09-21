<?php get_header(); ?>
<div class="l-contents l-page l-<?php echo get_post(get_the_ID())->post_name;//ページスラッグ ?>">
	<?php remove_filter('the_content', 'wpautop');//記事自動整形無効化 ?>
	<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<?php the_content();//本文出力 ?>
	<?php endwhile; endif; wp_reset_postdata(); ?>
</div>
<!-- /.l-contents -->
<?php get_footer();
