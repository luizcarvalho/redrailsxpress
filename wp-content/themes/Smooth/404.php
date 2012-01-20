<?php get_header(); ?>

<div id="main_content" class="grid_8">
			<br/>
			<h1>Sorry, Page not found...here are some other listings:</h1>
			<br/>
	
			<?php	$post = $wp_query->post;
  					$show = get_settings($shortname."_homePostCategory");   
					$limit = get_settings('posts_per_page');
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					query_posts('cat=-' .$show .'&showposts='.$limit.'&paged=' . $paged);
					$wp_query->is_archive = true; $wp_query->is_home = false;
			?>
          
            <?php if (have_posts()) : ?>              
              <?php while (have_posts()) : the_post(); ?>
			
		
					<h3><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>



<a href="<?php the_permalink() ?>" rel="bookmark"><?php
	
 if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
				
						echo '<a href="'.get_permalink().'"><div class="left_float_image">'.get_the_post_thumbnail($id,array('120,100')).'</div></a>';
						
						
				 } elseif  ( get_post_meta($post->ID, "red_image1", true)) {
				
$image = get_post_meta($post->ID, "red_image1", true);
$title = get_the_title();
echo '<div class="left_float_image"><img alt="'.$title.'"  src="'.$image.'" height="100" width="120" /></div>';
			
				} else  {
				
				 echo'<a href="'.get_permalink().'"><div class="left_float_image">'.latest_listings($post->ID,'thumbnail').'</div></a>'; 
				
			}
	
?>
</a>
													
   								<?php echo search_description($text); 
    								echo "...<br><a class='more' href='";
        							the_permalink();
        							echo "'>View Property</a>";
									 ?>
								<div style="clear:both"></div>
				   


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
<?php get_sidebar();?>
</div><!-- end sidebar-->
<div class="clear"></div>
<?php get_footer();?>