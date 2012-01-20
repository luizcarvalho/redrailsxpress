<?php
/*
Template Name: Blog
*/
$mb_blog = stripslashes(get_option('mb_blog')); $mb_blog_full = stripslashes(get_option('mb_blog_full')); $mb_resize = stripslashes(get_option('mb_resize'));
?>

<?php get_header(); ?>
				
				<!-- content -->
				<div id="content">

					<!-- archive-title -->
					<div id="archive-title">				
						<?php while (have_posts()) : the_post(); ?>
						<h1><?php the_title(); ?></h1>
						<?php the_excerpt() ?>
						<?php endwhile; ?>
					</div>
					<!-- /archive-title -->

					<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("cat=' . $mb_blog . '&showposts=5&paged=$paged"); ?>
					<?php while (have_posts()) : the_post(); ?>
						
					<!-- post -->
					<div class="post archive">
						<div class="post-comments"><?php comments_popup_link('0', '1', '%'); ?></div>
						<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
						<div class="post-date"><?php the_time('l, F j, Y') ?></div>
						<?php if (get_post_meta($post->ID, 'post_image_value', true)) { ?><div class="post-tnail"><a href="<?php the_permalink() ?>"><?php if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 0) { ?><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>&amp;w=98&amp;h=98&amp;zc=1&amp;q=95" alt="<?php the_title(); ?>" /><?php } else if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 1) { ?><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>" alt="<?php the_title(); ?>" /><?php } ?></a></div><?php } ?>
						<?php if($mb_blog_full == 0) { ?>
						<?php the_excerpt() ?>
						<p><a href="<?php the_permalink() ?>" class="more">Continue reading...</a></p>
						<?php } else the_content('Continue reading...') ?>				
					</div>
					<!-- /post -->
						
					<?php endwhile; ?>

					<div class="navigation">
						<div class="alignleft"><?php next_posts_link('&laquo; Older Posts') ?></div>
						<div class="alignright"><?php previous_posts_link('Newer Posts &raquo;') ?></div>
					</div>

				</div>
				<!-- /content -->

				<!-- sidebar -->
				<div id="sidebar">

					<?php get_sidebar(); ?>

				</div>
				<!-- /sidebar -->
				
<?php get_footer(); ?>
