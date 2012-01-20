<?php include (TEMPLATEPATH . '/options/options.php'); ?>
<div class="post-list">

	<?php
		
		$the_query = new WP_Query('category_name='. $tn_mz_featured_articles_cat . '&' . 'showposts='. $tn_mz_featured_articles_sum);
		
		$counter = 0; $counter2 = 0;
				
		while ($the_query->have_posts()) : $the_query->the_post(); $do_not_duplicate = $post->ID;
	?>
	
		<?php $counter++; $counter2++; ?>
				
		<div class="post fl">
		
			<?php if ( get_post_meta($post->ID, 'featured-image', true) ) { ?> <!-- DISPLAYS THE IMAGE URL SPECIFIED IN THE CUSTOM FIELD -->
				
				<img src="<?php echo get_post_meta($post->ID, "featured-image", $single = true); ?>" alt="" />			
				
			<?php } else { ?> <!-- DISPLAY THE DEFAULT IMAGE, IF CUSTOM FIELD HAS NOT BEEN COMPLETED -->
				
				<img src="<?php bloginfo('template_directory'); ?>/images/no-featured-image.jpg" alt="" />
				
			<?php } ?> 
		
			<h1><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <p><em><?php the_time('d F Y'); ?></em></p>
            
			<p><?php echo strip_tags(the_excerpt_featured(), '<a><strong>'); ?></p>
			<p><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" class="more-link">Read full</a></span></p>
		
        <h3 class="posted"><?php comments_popup_link('Comments (0)', 'Comments (1)', 'Comments (%)'); ?><br /> Posted in: <?php the_category(', ') ?></h3>
		</div><!--/post-->
        
        
		
		<?php if ( !($counter2 == $tn_mz_featured_articles_sum) && ($counter == 0) ) { echo '<div class="hl-full"></div>'; ?> <div style="clear:both;"></div> <?php } ?>
	
	<?php endwhile; ?>
	
	
	

	
</div><!--/box-->