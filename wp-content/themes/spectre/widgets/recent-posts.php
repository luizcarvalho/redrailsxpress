<?php $mb_blog = stripslashes(get_option('mb_blog')); ?>
<?php if(is_home()) echo ''; else { ?><!-- widget -->
<div class="widget">
	<h3>Recently, from the Blog...</h3>
	<ul>
		<?php $mb_recent = new WP_Query('cat=' . $mb_blog . '&showposts=5'); ?>
		<?php while ($mb_recent->have_posts()) : $mb_recent->the_post(); $more = 0; ?>
		<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		<span><?php the_time('l, F jS, Y') ?></span></li>
		<?php endwhile; rewind_posts(); ?>
	</ul>
</div>
<!-- /widget --><?php } ?>