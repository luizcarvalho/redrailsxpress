<?php
/*
Template Name: Portfolio
*/
$mb_portfolio = stripslashes(get_option('mb_portfolio')); $mb_resize = stripslashes(get_option('mb_resize'));
?>

<?php get_header(); ?>
				
				<!-- content -->
				<div id="portfolio-archive">

					<!-- archive-title -->
					<div id="archive-title">				
						<?php while (have_posts()) : the_post(); ?>
						<h1><?php the_title(); ?></h1>
						<ul id="portfolio-categories">
							<?php wp_list_categories('child_of=' . $mb_portfolio . '&title_li='); ?>
						</ul>
						<?php endwhile; ?>
					</div>
					<!-- /archive-title -->
						
					<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("cat=' . $mb_portfolio . '&showposts=10&paged=$paged"); ?>
					<?php while (have_posts()) : the_post(); ?>

					<!-- post -->
					<div class="item">
						<?php if (get_post_meta($post->ID, 'feature_image_value', true) && $mb_resize == 0) { ?><div class="portfolio-tnail"><a href="<?php the_permalink() ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "feature_image_value", $single = true); ?>&amp;w=440&amp;h=175&amp;zc=1&amp;q=95" alt="<?php the_title(); ?>" /></a></div><?php } else if (get_post_meta($post->ID, 'feature_image_value', true) && $mb_resize == 1) { ?><div class="portfolio-tnail"><a href="<?php the_permalink() ?>"><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "feature_image_value", $single = true); ?>" alt="<?php the_title(); ?>" /></a></div><?php } ?>
						<div class="portfolio-summary">
							<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
							<?php if (get_post_meta($post->ID, 'portfolio_client_value', true)) { ?><p><?php echo get_post_meta($post->ID, "portfolio_client_value", $single = true); ?></p><?php } ?>
						</div>
					</div>
					<!-- /post -->

					<?php endwhile; ?>

					<div class="navigation">
						<div class="alignleft"><?php next_posts_link('&laquo; Older Posts') ?></div>
						<div class="alignright"><?php previous_posts_link('Newer Posts &raquo;') ?></div>
					</div>
					
				</div>
				<!-- /content -->			
				
<?php get_footer(); ?>
