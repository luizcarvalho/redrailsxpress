<?php get_header(); ?>
<?php $mb_blog = stripslashes(get_option('mb_blog')); $mb_blog_home = stripslashes(get_option('mb_blog_home')); $mb_resize = stripslashes(get_option('mb_resize')); ?>
				
				<!-- content -->
				<div id="content">

					<h2>Recently, from the Blog...</h2>

					<!-- content-left -->
					<div id="content-left">
						
						<?php $mb_recent = new WP_Query('cat=' . $mb_blog . '&showposts=' . $mb_blog_home . ''); ?>
						<?php while ($mb_recent->have_posts()) : $mb_recent->the_post(); $more = 0; ?>

						<!-- post -->
						<div class="post archive">
							<div class="post-comments"><?php comments_popup_link('0', '1', '%'); ?></div>
							<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
							<div class="post-date"><?php the_time('l, F jS, Y') ?></div>
							<?php if (get_post_meta($post->ID, 'post_image_value', true)) { ?><div class="post-tnail"><a href="<?php the_permalink() ?>"><?php if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 0) { ?><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>&amp;w=98&amp;h=98&amp;zc=1&amp;q=95" alt="<?php the_title(); ?>" /><?php } else if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 1) { ?><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>" alt="<?php the_title(); ?>" /><?php } ?></a></div><?php } ?>
							<?php the_excerpt() ?>
							<p><a href="<?php the_permalink() ?>" class="more">Continue reading...</a></p>						
						</div>
						<!-- /post -->
						
						<?php endwhile; ?>

					</div>
					<!-- /content-left -->

					<!-- content-right -->
					<div id="content-right">

						<?php $mb_recent = new WP_Query('cat=' . $mb_blog . '&showposts=' . $mb_blog_home . '&offset=' . $mb_blog_home . ''); ?>
						<?php while ($mb_recent->have_posts()) : $mb_recent->the_post(); $more = 0; ?>

						<!-- post -->
						<div class="post archive">
							<div class="post-comments"><?php comments_popup_link('0', '1', '%'); ?></div>
							<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
							<div class="post-date"><?php the_time('l, F jS, Y') ?></div>
							<?php if (get_post_meta($post->ID, 'post_image_value', true)) { ?><div class="post-tnail"><a href="<?php the_permalink() ?>"><?php if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 0) { ?><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>&amp;w=98&amp;h=98&amp;zc=1&amp;q=95" alt="<?php the_title(); ?>" /><?php } else if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 1) { ?><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>" alt="<?php the_title(); ?>" /><?php } ?></a></div><?php } ?>
							<?php the_excerpt() ?>
							<p><a href="<?php the_permalink() ?>" class="more">Continue reading...</a></p>						
						</div>
						<!-- /post -->
						
						<?php endwhile; ?>

					</div>
					<!-- /content-right -->

				</div>
				<!-- /content -->

				<!-- sidebar -->
				<div id="sidebar">

					<?php get_sidebar(); ?>

				</div>
				<!-- /sidebar -->
				
<?php get_footer(); ?>
