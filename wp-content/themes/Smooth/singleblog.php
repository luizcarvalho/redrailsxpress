<?php get_header(); ?>
<div id="main_content" class="grid_8">

		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

 <!-- Post  -->
	
				<h3><?php the_title(); ?></h3>
	
		
<!-- Metadata -->
				
				<p><small><img src="<?php bloginfo(template_url) ?>/images/calendar.png" />	<?php the_time('M') ?> - <?php the_time('d') ?> | 	<img src="<?php bloginfo(template_url) ?>/images/user_gray.png" /> <?php the_author_posts_link(); ?> | <img src="<?php bloginfo(template_url) ?>/images/comment.gif" /> <a href="<?php comments_link(); ?>" /><?php comments_number('no comments','one comment','% comments'); ?>.</a> | <img src="<?php bloginfo(template_url) ?>/images/page_go.png" /> <?php the_category(', ') ?></small></p>
					
<!-- Metadata Ends -->
<div id="blog_single">						
<?php the_content(); ?>

</div>							
<!-- Post Ends -->	
			
			<?php endwhile; ?>
			<?php else : ?>
			<h2 class="center">Not Found</h2>
			<?php endif; ?>
	
				<div class="comment"><!-- Comments -->
				
					<?php comments_template(); ?>
					
				</div>


				
	<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</div>


</div><!-- end main_content grid_8 -->
<div id="sidebar" class="grid_4 omega">
<?php get_sidebar();?>
</div><!-- end sidebar-->
<?php get_footer();?>