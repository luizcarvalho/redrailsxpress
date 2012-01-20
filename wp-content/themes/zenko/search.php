<?php 
global $options; foreach ($options as $value) { if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>
<?php get_header(); ?>
 
	<div id="middle">
       
		<div id="posts">
   
		<?php if (have_posts()) : ?>

			<h3 class="recent"><?php _e('Search Results for:', 'wpzoom');?> <strong><?php the_search_query(); ?></strong></h3>
		
			<?php while (have_posts()) : the_post(); ?>
			<div class="homepost">
			 
			<?php unset($img); 
				if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
				$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
				$img = $thumbURL[0];  }
				else { 
					unset($img);
					if ($wpzoom_cf_use == 'Yes')  { $img = get_post_meta($post->ID, $wpzoom_cf_photo, true); }
				else {  
					if (!$img)  {  $img = catch_that_image($post->ID);  } }
				}
				if ($img) { $img = wpzoom_wpmu($img); ?>
				<div class="thumb"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=130&amp;h=90&amp;zc=1" alt="<?php the_title(); ?>" /></a> </div><?php } ?>
 				
				<div class="rightcontp">
					<div class="bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></div>
					<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a> </h3>
					<?php the_excerpt(); ?>
					<div class="post-meta"><?php _e('Published by', 'wpzoom');?><?php the_author_posts_link(); ?> <?php _e('on', 'wpzoom');?> <strong><?php the_time("$dateformat $timeformat"); ?></strong></div>
				</div>
				
			</div>
			<?php endwhile; ?>
 		   
		   
		</div> <!-- end posts --> 
 
		
		
		<div class="navigation">
		
			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
			
				<div class="floatleft"><?php next_posts_link( __('&laquo; Older Entries', 'wpzoom') ); ?></div>
				<div class="floatright"><?php previous_posts_link( __('Newer Entries &raquo;', 'wpzoom') ); ?></div>
			
			<?php } ?>
			
		</div>
		
	</div><!-- end middle -->	
 	


	<?php else : ?>
	
 		<h3 class="recent"><?php _e('Search Results for:', 'wpzoom');?> <strong><?php the_search_query(); ?></strong></h3>
	
		<h2><?php _e('Nothing Found', 'wpzoom');?></h2>
		
		</div><!-- end posts -->	
		
	</div><!-- end middle -->	
  
	<?php endif; ?>
  	
<?php get_sidebar(); ?>
<?php get_footer(); ?>