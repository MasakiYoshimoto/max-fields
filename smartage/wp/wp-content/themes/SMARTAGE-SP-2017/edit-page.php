<?php
/*
Template Name:構築用テンプレート
*/
?>
<?php get_header(); ?>
<div class="l-contents l-page l-<?php echo get_post(get_the_ID())->post_name;//ページスラッグ ?>">
	<?php remove_filter('the_content', 'wpautop');//記事自動整形無効化 ?>
	<?php
	echo do_shortcode(file_get_contents(A_PATH . 'edit-page-text.php', get_template_directory_uri(), NULL));//
	?>
</div>
<!-- /.l-contents -->
<?php get_footer();
