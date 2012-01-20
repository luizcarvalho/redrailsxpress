<?php get_header(); ?>
<?php $mb_blog_author = stripslashes(get_option('mb_blog_author')); $mb_portfolio = stripslashes(get_option('mb_portfolio')); $mb_portfolio_original = stripslashes(get_option('mb_portfolio_original')); $mb_resize = stripslashes(get_option('mb_resize')); ?>
				
				<?php if(in_category('' . $mb_portfolio . '')) { while (have_posts()) : the_post(); ?>
					
				<!-- content -->
				<div id="content">

					<!-- post -->
					<div id="portfolio" class="jcarousel-screenshots">

						<div id="screenshots">
							<h3>Screenshots</h3>
							<ul>
								<li><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "portfolio_screenshot_1_value", $single = true); ?>" alt="<?php the_title(); ?>" /></li>
								<?php if (get_post_meta($post->ID, 'portfolio_screenshot_2_value', true)) { ?><li><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "portfolio_screenshot_2_value", $single = true); ?>" alt="<?php the_title(); ?>" /></li><?php } ?>
								<?php if (get_post_meta($post->ID, 'portfolio_screenshot_3_value', true)) { ?><li><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "portfolio_screenshot_3_value", $single = true); ?>" alt="<?php the_title(); ?>" /></li><?php } ?>
								<?php if (get_post_meta($post->ID, 'portfolio_screenshot_4_value', true)) { ?><li><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "portfolio_screenshot_4_value", $single = true); ?>" alt="<?php the_title(); ?>" /></li><?php } ?>
								<?php if (get_post_meta($post->ID, 'portfolio_screenshot_5_value', true)) { ?><li><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "portfolio_screenshot_5_value", $single = true); ?>" alt="<?php the_title(); ?>" /></li><?php } ?>
							</ul>
						</div>

					</div>
					<!-- /post -->

				</div>
				<!-- /content -->

				<!-- sidebar -->
				<div id="sidebar" class="portfolio">
					
					<h1><?php the_title(); ?></h1>
					
					<?php if (get_post_meta($post->ID, 'portfolio_client_value', true)) { ?><h6 style="margin-bottom:2px;">Client</h6>
					<p><?php echo get_post_meta($post->ID, "portfolio_client_value", $single = true); ?></p><?php } ?>
					
					<h6>Project Summary</h6>					
					<?php the_content() ?>
					
					<?php if (get_post_meta($post->ID, 'portfolio_services_value', true)) { ?><h6>Services Provided</h6>
					<ul id="portfolio-services">
						<li><?php echo get_post_meta($post->ID, "portfolio_services_value", $single = true); ?></li>
					</ul><?php } ?>
					
					<?php if (get_post_meta($post->ID, 'portfolio_url_value', true)) { ?><p><strong><a href="<?php echo get_post_meta($post->ID, "portfolio_url_value", $single = true); ?>">Visit &raquo;</a></strong></p><?php } ?>

				</div>
				<!-- /sidebar -->					
				
				<?php endwhile; } else { ?>
				
				<!-- content -->
				<div id="content">

					<?php while (have_posts()) : the_post(); ?>
						
					<!-- post -->
					<div class="post single">
						
						<?php edit_post_link('Edit','<div class="edit">','</div>'); ?>
									
						<h1><?php the_title(); ?></h1>
						<div class="post-date"><?php the_time('l, F jS, Y') ?></div>
					
						<?php the_content() ?>
										
						<?php if($mb_blog_author == 1) { ?><div id="post-author">
							<div class="post-author-avatar"><?php echo get_avatar(get_the_author_email(), $size = '60', $default = ''.get_settings('templateurl') .'/images/avatar-author.jpg'); ?></div>
							<div class="post-author-description">
								<h3>About the Author</h3>
								<p><strong><?php the_author_posts_link(); ?></strong> <?php the_author_description(); ?> </p>
							</div>
							<div class="clear"></div>
						</div><?php } ?>

						<div class="post-meta">
							<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
							<p class="post-category">Posted in <?php the_category(', ') ?></p>
						</div>
					
					</div>
					<!-- /post -->
					
					<?php endwhile; ?>
					
					<!-- comments -->
					<div id="comments">

						<?php comments_template(); ?>

					</div>
					<!-- /comments -->

				</div>
				<!-- /content -->

				<!-- sidebar -->
				<div id="sidebar">

					<?php get_sidebar(); ?>

				</div>
				<!-- /sidebar -->
				
				<?php } ?>
				
				<!-- breadcrumb -->
				<div id="breadcrumb">
					<?php the_breadcrumb(); ?>
				</div>
				<!-- /breadcrumb -->
				
<?php get_footer(); ?>
