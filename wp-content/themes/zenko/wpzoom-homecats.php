<?php 
	$catid4 = $wpzoom_featured_category_4;
	$catid5 = $wpzoom_featured_category_5;
	$catid6 = $wpzoom_featured_category_6;
	$catid7 = $wpzoom_featured_category_7;
	$catid8 = $wpzoom_featured_category_8;
	
	$cat4 = get_category($catid4,false);
	$cat5 = get_category($catid5,false);
	$cat6 = get_category($catid6,false);
	$cat7 = get_category($catid7,false);
	$cat8 = get_category($catid8,false);
	
	$catlink4 = get_category_link($catid4);
	$catlink5 = get_category_link($catid5);
	$catlink6 = get_category_link($catid6);
	$catlink7 = get_category_link($catid7);
	$catlink8 = get_category_link($catid8);
			
	$breaking_cat4 = "cat=$catid4";
	$breaking_cat5 = "cat=$catid5";
	$breaking_cat6 = "cat=$catid6";
	$breaking_cat7 = "cat=$catid7";
	$breaking_cat8 = "cat=$catid8";
	
	$post_per_cat = $wpzoom_featured_posts;
 ?>
 
 	
	<?php if ($catid4 && $catid4 > 0) { ?>
  <!-- Here starts 1st block-->
	<div class="block">
		<?php query_posts('showposts='.$post_per_cat.'&' . $breaking_cat4 );  ?>
		<h3 class="blue"><?php echo"<a href=\"$catlink4\">$cat4->name&raquo;</a>";?></h3>
		
		<!-- Showing latest article with different style -->
		<?php $count = 0; while (have_posts()) { the_post(); if( $count == 0 ) { ?>
			
		<div class="firstn">
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
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=235&amp;h=140&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
		
			
			<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	 
			<small><?php if ($wpzoom_homepost_date == 'Show') { ?><?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
			
			<?php the_content_limit(170, ''); ?>
		
		</div>
				
		<!-- A list with another 3 articles from the same category-->		
		<div class="rightn">
			<ul>
				<?php } else { ?>
				
				<li>
					<div class="righthumb">
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
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=90&amp;h=80&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
					</div> 
					
					<div class="rightcont">
						
						<div class="bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></div>
						
						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a> 
						
						<?php the_content_limit(110, ''); ?>
						
						<small><?php if ($wpzoom_homepost_author == 'Show') { ?><?php _e('by', 'wpzoom');?> <?php the_author_posts_link(); ?><?php } ?> <?php if ($wpzoom_homepost_date == 'Show') { ?><?php _e('on', 'wpzoom');?> <?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
					</div>
					
					<div style="clear:both;"></div>
				
				</li>	
				
				<?php } ?>
				<?php $count ++; }
					if( $count > 0 ) { echo "</ul>"; }
				?>
 
			</ul>
		</div>
		<div class="clear"></div>
	</div> <!-- end 1st block -->
	<?php } ?>
 
  <?php if ($catid5 && $catid5 > 0) { ?>
	<!-- Here starts 2nd block-->
	<div class="block">
		<?php query_posts('showposts='.$post_per_cat.'&' . $breaking_cat5 );  ?>
		<h3 class="green"><?php echo"<a href=\"$catlink5\">$cat5->name&raquo;</a>";?></h3>
		
		<!-- Showing latest article with different style -->
		<?php $count = 0; while (have_posts()) { the_post(); if( $count == 0 ) { ?>
			
		<div class="firstn">
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
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=235&amp;h=140&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
			
			<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	 
			<small><?php if ($wpzoom_homepost_date == 'Show') { ?><?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
			
			<?php the_content_limit(170, ''); ?>
		
		</div>
				
		<!-- A list with another 3 articles from the same category-->		
		<div class="rightn">
			<ul>
				<?php } else { ?>
				
				<li>
					<div class="righthumb">
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
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=90&amp;h=80&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
					</div> 
					
					<div class="rightcont">
						
						<div class="bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></div>
						
						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a> 
						
						<?php the_content_limit(110, ''); ?>
						
						<small><?php if ($wpzoom_homepost_author == 'Show') { ?><?php _e('by', 'wpzoom');?> <?php the_author_posts_link(); ?><?php } ?> <?php if ($wpzoom_homepost_date == 'Show') { ?><?php _e('on', 'wpzoom');?> <?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
					</div>
					
					<div style="clear:both;"></div>
				
				</li>	
				
				<?php } ?>
				<?php $count ++; }
					if( $count > 0 ) { echo "</ul>"; }
				?>
 
			</ul>
		</div>
		<div class="clear"></div>
	</div> <!-- end 2nd block -->

	<?php } ?>
 
  <?php if ($catid6 && $catid6 > 0) { ?>

	<!-- Here starts 3rd block-->
	<div class="block">
		<?php query_posts('showposts='.$post_per_cat.'&' . $breaking_cat6 );  ?>
		<h3 class="pink"><?php echo"<a href=\"$catlink6\">$cat6->name&raquo;</a>";?></h3>
		
		<!-- Showing latest article with different style -->
		<?php $count = 0; while (have_posts()) { the_post(); if( $count == 0 ) { ?>
			
		<div class="firstn">
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
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=235&amp;h=140&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
			
			<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	 
			<small><?php if ($wpzoom_homepost_date == 'Show') { ?><?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
			
			<?php the_content_limit(170, ''); ?>
		
		</div>
				
		<!-- A list with another 3 articles from the same category-->		
		<div class="rightn">
			<ul>
				<?php } else { ?>
				
				<li>
					<div class="righthumb">
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
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=90&amp;h=80&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
					</div> 
					
					<div class="rightcont">
						
						<div class="bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></div>
						
						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a> 
						
						<?php the_content_limit(110, ''); ?>
						
						<small><?php if ($wpzoom_homepost_author == 'Show') { ?><?php _e('by', 'wpzoom');?> <?php the_author_posts_link(); ?><?php } ?> <?php if ($wpzoom_homepost_date == 'Show') { ?><?php _e('on', 'wpzoom');?> <?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
					</div>
					
					<div style="clear:both;"></div>
				
				</li>	
				
				<?php } ?>
				<?php $count ++; }
					if( $count > 0 ) { echo "</ul>"; }
				?>
 
			</ul>
		</div>
		<div class="clear"></div>
	</div> <!-- end 3rd block -->
	
	<?php } ?>
 
  <?php if ($catid7 && $catid7 > 0) { ?>
	<!-- Here starts 4th block-->
	<div class="block">
		<?php query_posts('showposts='.$post_per_cat.'&' . $breaking_cat7 );  ?>
		<h3 class="black"><?php echo"<a href=\"$catlink7\">$cat7->name&raquo;</a>";?></h3>
		
		<!-- Showing latest article with different style -->
		<?php $count = 0; while (have_posts()) { the_post(); if( $count == 0 ) { ?>
			
		<div class="firstn">
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
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=235&amp;h=140&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
			
			<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	 
			<small><?php if ($wpzoom_homepost_date == 'Show') { ?><?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
			
			<?php the_content_limit(170, ''); ?>
		
		</div>
				
		<!-- A list with another 3 articles from the same category-->		
		<div class="rightn">
			<ul>
				<?php } else { ?>
				
				<li>
					<div class="righthumb">
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
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=90&amp;h=80&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
					</div> 
					
					<div class="rightcont">
						
						<div class="bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></div>
						
						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a> 
						
						<?php the_content_limit(110, ''); ?>
						
						<small><?php if ($wpzoom_homepost_author == 'Show') { ?><?php _e('by', 'wpzoom');?> <?php the_author_posts_link(); ?><?php } ?> <?php if ($wpzoom_homepost_date == 'Show') { ?><?php _e('on', 'wpzoom');?> <?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
					</div>
					
					<div style="clear:both;"></div>
				
				</li>	
				
				<?php } ?>
				<?php $count ++; }
					if( $count > 0 ) { echo "</ul>"; }
				?>
 
			</ul>
		</div>
		<div class="clear"></div>
	</div> <!-- end 4th block -->
	
	<?php } ?>
 
  <?php if ($catid8 && $catid8 > 0) { ?>
	<!-- Here starts 5th block-->
	<div class="block">
		<?php query_posts('showposts='.$post_per_cat.'&' . $breaking_cat8 );  ?>
		<h3 class="blue"><?php echo"<a href=\"$catlink8\">$cat8->name&raquo;</a>";?></h3>
		
		<!-- Showing latest article with different style -->
		<?php $count = 0; while (have_posts()) { the_post(); if( $count == 0 ) { ?>
			
		<div class="firstn">
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
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=235&amp;h=140&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
			
			<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	 
			<small><?php if ($wpzoom_homepost_date == 'Show') { ?><?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
			
			<?php the_content_limit(170, ''); ?>
		
		</div>
				
		<!-- A list with another 3 articles from the same category-->		
		<div class="rightn">
			<ul>
				<?php } else { ?>
				
				<li>
					<div class="righthumb">
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
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=90&amp;h=80&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
					</div> 
					
					<div class="rightcont">
						
						<div class="bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></div>
						
						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a> 
						
						<?php the_content_limit(110, ''); ?>
						
						<small><?php if ($wpzoom_homepost_author == 'Show') { ?><?php _e('by', 'wpzoom');?> <?php the_author_posts_link(); ?><?php } ?> <?php if ($wpzoom_homepost_date == 'Show') { ?><?php _e('on', 'wpzoom');?> <?php the_time("$dateformat $timeformat"); ?><?php } ?></small>
					</div>
					
					<div style="clear:both;"></div>
				
				</li>	
				
				<?php } ?>
				<?php $count ++; }
					if( $count > 0 ) { echo "</ul>"; }
				?>
 
			</ul>
		</div>
		<div class="clear"></div>
	</div> <!-- end 5th block -->
	<?php } ?>
  
	<?php wp_reset_query(); ?>	