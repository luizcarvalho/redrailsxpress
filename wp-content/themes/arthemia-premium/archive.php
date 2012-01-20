<?php get_header(); ?>

	<div id="content" class="archive">
	
	<?php if (have_posts()) : ?>
	
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

 	  <?php /* If this is a category archive */ if (is_category()) { ?><span id="map"><a href="<?php echo get_option('home'); ?>/"><?php _e('Home','arthemia');?></a> &raquo; <?php _e('Archive by Category','arthemia');?></span>
    <h2 class="title"><?php _e('Articles in ','arthemia');?> <strong><?php single_cat_title(); ?></strong></h2>

	<?php /* If this is a tagged archive */ } elseif (is_tag()) { ?><span id="map"><a href="<?php echo get_option('home'); ?>/"><?php _e('Home','arthemia');?></a> &raquo; <?php _e('Archive by Tags','arthemia');?></span><h2 class="title"><?php _e('Articles tagged with: ','arthemia');?> <?php single_tag_title(); ?></h2>

 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?><span id="map"><a href="<?php echo get_option('home'); ?>/"><?php _e('Home','arthemia');?></a> &raquo; <?php _e('Archive by Day','arthemia');?></span><h2 class="title"><?php _e('Article Archive for ','arthemia');?> <?php the_time('j F Y'); ?></h2>

 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?><span id="map"><a href="<?php echo get_option('home'); ?>/"><?php _e('Home','arthemia');?></a> &raquo; <?php _e('Archive by Month','arthemia');?></span><h2 class="title"><?php _e('Article Archive for ','arthemia');?> <?php the_time('F Y'); ?></h2>
 	  
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?><span id="map"><a href="<?php echo get_option('home'); ?>/"><?php _e('Home','arthemia');?></a> &raquo; <?php _e('Archive by Year','arthemia');?></span><h2 class="title"><?php _e('Article Archive for ','arthemia');?> <?php _e('Year','arthemia');?> <?php the_time('Y'); ?></h2>

 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<span id="map"><a href="<?php echo get_option('home'); ?>/"><?php _e('Home','arthemia');?></a> &raquo; <?php _e('Archive','arthemia');?></span>
		<h2 class="title"><?php _e('The Archive','arthemia');?></h2>
 	  <?php } ?>

	<div class="clearfloat">

	<?php while (have_posts()) : the_post(); ?>
	
	<div class="tanbox left">
		<span class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></span>
		<div class="meta"><?php the_time(get_option('date_format')); ?> &#150; <?php the_time(); ?> | <?php comments_popup_link(__('No Comment','arthemia'), __('One Comment','arthemia'), __('% Comments','arthemia'));?></div>
	
	<?php $width = get_settings ( "cp_thumbWidth_Archive" );
		$height = get_settings ( "cp_thumbHeight_Archive" );
		if ( $width == 0 ) { $width = 80; }
		if ( $height == 0 ) { $height = 80; }
	?>	

	<?php $status = get_settings ( "cp_thumbAuto" );
		if ( $status != "first" ) { ?>

	<?php
	//Check if custom field key "Image" has a value
	$values = get_post_custom_values("Image");
	if (isset($values[0])) {
	?>
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=/<?php
$values = get_post_custom_values("Image"); echo $values[0]; ?>&amp;w=<?php echo $width; ?>&amp;h=<?php echo $height; ?>&amp;zc=1&amp;q=100"
alt="<?php the_title(); ?>" class="left" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px"  /></a>
		<?php } ?>

	<?php } else { ?>

	<?php $id =$post->ID;
$the_content =$wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE ID = $id");
$pattern = '!<img.*?src="(.*?)"!';
preg_match_all($pattern, $the_content, $matches);
$image_src = $matches['1'][0]; ?>
				
	<?php if($image_src != '') { ?> <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
<img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image_src; ?>&amp;w=<?php echo $width; ?>&amp;h=<?php echo $height; ?>&amp;zc=1&amp;q=100"
alt="<?php the_title(); ?>" class="left" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px"  /></a><?php } ?>

	<?php } ?>

	
		<?php the_excerpt(); ?>
	</div>
	
	<?php endwhile; ?>
	</div>	

	<div id="navigation">
	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	</div>
	
	<?php else : ?>
		<span id="map"><a href="<?php echo get_option('home'); ?>/"><?php _e('Home','arthemia');?></a> &raquo; <?php _e('Archive','arthemia');?></span>
		<h2 class="title"><?php _e('Not Found','arthemia');?></h2>

		<p><?php _e('No posts found. Try a different search?','arthemia');?></p>

	<?php endif; ?>

	</div>



<?php get_sidebar(); ?>
<?php get_footer(); ?>
