<?php get_header(); ?>
<div class="l-contents l-page l-topics-s">

	<div class="ef-frame mv">
		<img class="bg" src="<?php echo T_URL; ?>img/middle-age_mv.jpg" alt="">
		<div class="text">
			<div class="in">トピックス</div>
		</div>
	</div>
	<div class="l-breadcrumbs">
		<div class="wrap sp-wrap">
			<?php echo do_shortcode('[bread]') ?>
		</div>
	</div>
	<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<div class="page-body"><div class="wrap in pad">
			<div class="sec">
				<div class="box">
					<h1 class="title"><?php the_title(); ?></h1>
					<time class="date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
					<div class="wp-post">
						<?php the_content();//本文出力 ?>
					</div>
				</div>
				<div class="flex-pager single">
					<?php previous_post_link('%link','<i class="icon-fa fa fa-fw fa-chevron-left" aria-hidden="true"></i> %title'); ?>
					<a href="../" class="center-link">一覧へ戻る</a>
					<?php next_post_link('%link','%title <i class="icon-fa fa fa-fw fa-chevron-right" aria-hidden="true"></i>'); ?>
				</div>
			</div>
		</div></div>
		
		
		
	<?php endwhile; endif; wp_reset_postdata(); ?>
</div>
<!-- /.l-contents -->
<?php get_footer();
