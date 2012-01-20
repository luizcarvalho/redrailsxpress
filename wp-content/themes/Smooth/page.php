<?php get_header(); ?>

<div id="main_content" class="grid_8">

<?php if (have_posts()) : ?>
		<?php $post = $posts[0];?>
		<?php while (have_posts()) : the_post(); ?>
	
			<div class="page"> <!-- Page Content -->
				<h2><?php the_title(); ?></h2>
				<br/>
					<div class="entry">
						<?php the_content('<span class="readmore"><strong>&nbsp;Read More &raquo;</strong></span>'); ?> 
					</div>
		 	</div><!-- Page Content Ends -->
		 				
	<?php endwhile; ?>
	<?php else : ?>
	<h2 class="center">Not Found</h2>
	<?php endif; ?>


</div><!-- end main_content grid_8 -->


<div id="sidebar" class="grid_4 omega">
<?php get_sidebar();?>
</div><!-- end sidebar-->

<?php get_footer();?>
