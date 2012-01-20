<?php get_header(); ?>
<?php $mb_portfolio = stripslashes(get_option('mb_portfolio')); $mb_resize = stripslashes(get_option('mb_resize')); ?>				
				
				<!-- content -->
				<div id="content">

					<!-- archive-title -->
					<div id="archive-title">				
						<?php if(is_month()) { ?>
						<h1>Browsing all articles from <strong><?php the_time('F, Y') ?></strong></h1>
						<?php } ?>
						<?php if(is_category()) { ?>
						<h1>Browsing all articles in <strong><?php $current_category = single_cat_title("", true); ?></strong></h1>
						<?php } ?>
						<?php if(is_tag()) { ?>
						<h1>Browsing all articles tagged with <strong><?php wp_title('',true,''); ?></strong></h1>
						<?php } ?>
						<?php if(is_author()) { ?>
						<h1>Browsing all articles by <strong><?php wp_title('',true,''); ?></strong></h1>
						<?php } ?>
						<?php if(is_search()) { ?>				
						<?php $hit_count = $wp_query->found_posts; ?>
						<h1>Your search for "<strong><?php the_search_query(); ?></strong>" returned <?php echo $hit_count . ' results'; ?></h1>
						<?php } ?>
					</div>
					<!-- /archive-title -->

					<?php while (have_posts()) : the_post(); ?>
						
					<?php if(in_category('' . $mb_portfolio . '')) { ?>						
					<div class="portfolio archive">
						<!-- post -->
						<div class="post archive">						
						<?php if (get_post_meta($post->ID, 'post_image_value', true)) { ?><div class="post-tnail"><a href="<?php the_permalink() ?>"><?php if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 0) { ?><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>&amp;w=98&amp;h=98&amp;zc=1&amp;q=95" alt="<?php the_title(); ?>" /><?php } else if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 1) { ?><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>" alt="<?php the_title(); ?>" /><?php } ?></a></div><?php } ?>
							<div class="portfolio-summary">
								<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
								<?php if (get_post_meta($post->ID, 'portfolio_client_value', true)) { ?><p><?php echo get_post_meta($post->ID, "portfolio_client_value", $single = true); ?></p><?php } ?>
								<p><a href="<?php the_permalink() ?>" class="more">More info.</a></p>
							</div>
						</div>
						<!-- /post -->
					</div>
					<?php } else { ?>
						
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
						
					<?php } endwhile; ?>

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
				
				<!-- breadcrumb -->
				<div id="breadcrumb">
					<?php the_breadcrumb(); ?>
				</div>
				<!-- /breadcrumb -->
				
<?php get_footer(); ?>
