<?php get_header(); ?>

	<div id="content" class="archive">
	
	<?php if (have_posts()) : ?>
	
    <?php 
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name); // NOTE: 2.0 bug requires get_userdatabylogin(get_the_author_login());
else :
$curauth = get_userdata(intval($author));
endif;
?>

 	 	<span id="map"><a href="<?php echo get_option('home'); ?>/"><?php _e('Home','arthemia');?></a> &raquo; <?php _e('Archive by Author','arthemia');?></span>
		<h2 class="title"><?php _e('Articles by','arthemia');?> <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></h2>
 	 
	<div class="clearfloat">

    

    <div id="bio" class="clearfloat"><?php $email = $curauth->user_email; ?><?php echo get_avatar( $email, $size = '80'); ?>
    <p><?php echo $curauth->description; ?></p></div>
	

    <?php while (have_posts()) : the_post(); ?>
	
	<div class="tanbox left">
		<span class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></span>
		<div class="meta"><?php the_time(get_option('date_format')); ?> &#150; <?php the_time(); ?> | <?php comments_popup_link('No Comment', 'One Comment', '% Comments');?></div>
	
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
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=/<?php
$values = get_post_custom_values("Image"); echo $values[0]; ?>&amp;w=<?php echo $width; ?>&amp;h=<?php echo $height; ?>&amp;zc=1&amp;q=100"
alt="<?php the_title(); ?>" class="left" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px"  /></a>
		<?php } ?>

	<?php } else { ?>

	<?php $id =$post->ID;
$the_content =$wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE ID = $id");
$pattern = '!<img.*?src="(.*?)"!';
preg_match_all($pattern, $the_content, $matches);
$image_src = $matches['1'][0]; ?>
				
	<?php if($image_src != '') { ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
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
