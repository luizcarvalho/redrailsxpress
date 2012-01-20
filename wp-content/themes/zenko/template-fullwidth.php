<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>
   
   <div id="middle" class="fullwidth">
		<div class="post">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     	 
			<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    		<div class="post-meta"><?php edit_post_link( __('Edit', 'wpzoom'), '   ', ''); ?></div> <hr />
			<?php the_content(' '); ?>
		 
			<?php endwhile; else: ?>

			<p><?php _e('Sorry, no posts matched your criteria', 'wpzoom');?></p>
			
			<?php endif; ?>

		</div> <!-- end post -->
	
	</div> <!-- end middle -->
 
  
 <?php get_footer(); ?>