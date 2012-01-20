<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>
<?php get_header(); ?>

<?php if ( $paged < 2) { ?>
 	<div id="featurespace">
	<?php	include(TEMPLATEPATH . '/wpzoom-featured.php'); ?> <!-- calling featured section-->
	</div>
<?php } ?>

<div id="middle">

	<?php if ( $paged < 2) { ?>	
		<?php	include(TEMPLATEPATH . '/wpzoom-homecats.php'); ?> <!-- calling homepage featured categories-->
	<?php  }  ?> 
	
	<?php if (is_home() && $wpzoom_home_art == 'Hide') { } else { ?>
	<!-- displaying Recent Articles-->
	<div id="posts">
   
		<?php $z = count($wpzoom_exclude_cats_home);if ($z > 0) { 
			$x = 0; $que = ""; while ($x < $z) {
			$que .= "-".$wpzoom_exclude_cats_home[$x]; $x++;
			if ($x < $z) {$que .= ",";} } }		 
			query_posts($query_string . "&cat=$que");if (have_posts()) : 
		?>

		<h3 class="recent"><?php _e('Recent Articles', 'wpzoom');?></h3>
 
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>	
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
				<div class="post-meta"><?php if ($wpzoom_homepost_author == 'Show') { ?><?php _e('Published by', 'wpzoom');?> <strong><?php the_author_posts_link(); ?></strong><?php } ?> <?php if ($wpzoom_homepost_date == 'Show') { ?><?php _e('on', 'wpzoom');?> <strong><?php the_time("$dateformat $timeformat"); ?></strong><?php } ?></div>
			</div>
			
		</div>
		<?php endwhile; ?>
	   <?php endif; ?>
	</div> <!-- end posts -->
	
 
	<div class="navigation">
	
		<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		
			<div class="floatleft"><?php next_posts_link( __('&laquo; Older Entries', 'wpzoom') ); ?></div>
			<div class="floatright"><?php previous_posts_link( __('Newer Entries &raquo;', 'wpzoom') ); ?></div>
		
		<?php } ?>
		
	</div>
	
	<?php } ?>
  
</div><!-- end middle -->

 
<?php get_sidebar(); ?>
 
<?php get_footer(); ?>