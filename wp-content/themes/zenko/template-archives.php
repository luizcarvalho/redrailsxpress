<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

	<div id="middle">
		
		<h3 class="recent"><?php _e('Archives', 'wpzoom');?></h3> 
		<div class="post">
			<?php
			 
				global $myOffset;
				$myOffset = 0;
				global $postsperpage;
				$postsperpage = 100; //Number of posts per page
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('caller_get_posts=1&orderby=post_date&order=DESC&offset='.$myOffset.'&showposts='.$postsperpage.'&paged='.$paged);
			?>

			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
 
			<?php
				setup_postdata($post);
				$year = mysql2date('Y', $post->post_date);
				$month = mysql2date('n', $post->post_date);
				$day = mysql2date('j', $post->post_date);
			?>
 
			<?php if($year != $previous_year || $month != $previous_month) : ?>
			<?php if($ul_open == true) : ?>

			</ul>
			
			<?php endif; ?>
 		
		<h3 class="pagetitle"><?php the_time('F Y'); ?></h3>
		<ul class="fullarchive">

			<?php $ul_open = true; ?>
			<?php endif; ?>
				
			<?php $previous_year = $year; $previous_month = $month; ?>
			 
			<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ul>
				

	
		<?php $wp_query = null; $wp_query = $temp;?>
		<?php remove_filter('post_limits', 'my_post_limit'); ?>
					
		</div><!-- end post -->
		
		
		
		<div class="navigation">
		
			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
			
				<div class="floatleft"><?php next_posts_link( __('&laquo; Older Entries', 'wpzoom') ); ?></div>
				<div class="floatright"><?php previous_posts_link( __('Newer Entries &raquo;', 'wpzoom') ); ?></div>
			
			<?php } ?>
			
		</div>
		
		
	</div><!-- end middle -->
	

<?php get_sidebar(); ?>
<?php get_footer(); ?>