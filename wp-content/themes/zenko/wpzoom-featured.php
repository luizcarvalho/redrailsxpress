<div id="popular" class="widget">
 
	<?php if ( ! dynamic_sidebar( 'Top Left' ) ) : ?>
		<?php  recent_news(); ?>
	<?php endif; ?>
 
</div>
			
		
<div id="featured-wrap">
	<h3><?php _e('Featured News', 'wpzoom');?></h3>
	   
	<div id="featured">
		<div id="tabs">
			<ul>
				<?php
					$catid1 = $wpzoom_featured_category_1;
					$catid2 = $wpzoom_featured_category_2;
					$catid3 = $wpzoom_featured_category_3;
					
					$cat1 = get_category($catid1,false);
					$cat2 = get_category($catid2,false);
					$cat3 = get_category($catid3,false);
					
					$catlink1 = get_category_link($catid1);
					$catlink2 = get_category_link($catid2);
					$catlink3 = get_category_link($catid3);
					
					$breaking_cat1 = "cat=$catid1";
					$breaking_cat2 = "cat=$catid2";
					$breaking_cat3 = "cat=$catid3";
				?>
				<li><a href="<?php echo $catlink1; ?>" onmouseover="easytabs('1', '1');" onfocus="easytabs('1', '1');" onclick="return true;"  title="" id="tablink1"><?php echo"$cat1->name";?></a></li>
				<li><a href="<?php echo $catlink2; ?>" onmouseover="easytabs('1', '2');" onfocus="easytabs('1', '2');" onclick="return true;"  title="" id="tablink2"><?php echo"$cat2->name";?></a></li>
				<li><a href="<?php echo $catlink3; ?>" onmouseover="easytabs('1', '3');" onfocus="easytabs('1', '3');" onclick="return true;"  title="" id="tablink3"><?php echo"$cat3->name";?></a></li>
			</ul>
		</div>
		
		
		<?php if ($catid1){?>

		<?php $my_query = new WP_Query("showposts=1&$breaking_cat1");
 
		while ($my_query->have_posts()) : $my_query->the_post();
		$do_not_duplicate[] = $post->ID; 
								?>    
		<div id="fcontent1">
		
			<div class="fimage">
 
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
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=200&amp;h=240&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } else { echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />"; } ?>	
			</div>
		   
			<div class="fcont">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<?php if ($wpzoom_homepost_author == 'Show') { ?><small><?php _e('by', 'wpzoom');?> <?php the_author_posts_link(); ?></small><?php } ?>
			
				<?php the_content_limit(200, ''); ?>
			 
			</div> 
			
			<?php endwhile;	?>
		</div>
		<?php }?>
			
			
			
			
		<?php if ($catid2){?>

		<?php $my_query = new WP_Query("showposts=1&$breaking_cat2");
 
		while ($my_query->have_posts()) : $my_query->the_post();
		$do_not_duplicate[] = $post->ID; 
								?>    
		<div id="fcontent2">
		
			<div class="fimage">
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
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=200&amp;h=240&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } else { echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />"; } ?>	
			</div>
		   
			<div class="fcont">
				
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<?php if ($wpzoom_homepost_author == 'Show') { ?><small><?php _e('by', 'wpzoom');?> <?php the_author_posts_link(); ?></small><?php } ?>
				
				<?php the_content_limit(200, ''); ?>
			 
			</div> 
			<?php endwhile;	?>
							 
		</div>
		<?php }?>

		
		
		<?php if ($catid3){?>

		<?php $my_query = new WP_Query("showposts=1&$breaking_cat3");
 
		while ($my_query->have_posts()) : $my_query->the_post();
		$do_not_duplicate = $post->ID; 
								?>    
		<div id="fcontent3">
		
			<div class="fimage">
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
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=200&amp;h=240&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } else { echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />"; } ?>	
			</div>
		  
			<div class="fcont">
				
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<?php if ($wpzoom_homepost_author == 'Show') { ?><small><?php _e('by', 'wpzoom');?> <?php the_author_posts_link(); ?></small><?php } ?>
				
				<?php the_content_limit(200, ''); ?>
			 
			</div> 
			<?php endwhile;	?>
							 
		</div>
		<?php }?>
		 
	 </div> <!-- end featured -->
 </div> <!-- end featured-wrap -->

 
<div id="recent" class="widget">
 
	<?php if (! dynamic_sidebar( 'Top Right' ) ) : ?>
		<?php  $pop[] = 'empty'; zenko_popular($pop); ?>
	<?php endif; ?>
			 
 </div>