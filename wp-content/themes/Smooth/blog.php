<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>

<div id="main_content" class="grid_8">


<?php
  $post = $wp_query->post;
  $show = get_settings($shortname."_homePostCategory");   
  $limit = get_settings('posts_per_page');
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  query_posts('cat=' .$show .'&showposts='.$limit.'&paged=' . $paged);
  $wp_query->is_archive = true; $wp_query->is_home = false;
?>
          
            <?php if (have_posts()) : ?>              
              <?php while (have_posts()) : the_post(); ?>

<!-- Page Content -->
		
				<h3><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
	
		
<!-- Metadata -->
				
				<p><small><img src="<?php bloginfo(template_url) ?>/images/calendar.png" />	<?php the_time('M') ?> - <?php the_time('d') ?> | 	<img src="<?php bloginfo(template_url) ?>/images/user_gray.png" /> <?php the_author_posts_link(); ?> | <img src="<?php bloginfo(template_url) ?>/images/comment.gif" /> <a href="<?php comments_link(); ?>" /><?php comments_number('no comments','one comment','% comments'); ?>.</a> | <img src="<?php bloginfo(template_url) ?>/images/page_go.png" /> <?php the_category(', ') ?></small></p>
					
					
					
						<div id="blog_single">						
					        <?php global $more; $more = false; ?>
							<?php the_content('<span class="readmore"><strong>&nbsp;Read More &raquo;</strong></span>'); ?>
							<?php $more = true; ?>	
					   </div>		
											
			
			
	
			<?php endwhile; ?>
			<?php else : ?>
			<h2 class="center">Not Found</h2>
			<?php endif; ?>


	
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>


</div><!-- end main_content grid_8 -->
<div id="sidebar" class="grid_4 omega">
<?php include(TEMPLATEPATH . '/sidebarblog.php'); ?>
</div><!-- end sidebar-->

<?php get_footer();?>
