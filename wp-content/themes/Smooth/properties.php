<?php
/*
Template Name: Properties

*/
?>

<?php get_header(); ?>



<div id="main_content" class="grid_8">                	
			<h2>Property Listings</h2>
			
	
			<?php	$post = $wp_query->post;
  					$show = get_settings($shortname."_homePostCategory");   
					$limit = get_settings('posts_per_page');
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					query_posts('cat=-' .$show .'&showposts='.$limit.'&paged=' . $paged);
					$wp_query->is_archive = true; $wp_query->is_home = false;
			?>
          
            <?php if (have_posts()) : ?>              
              <?php while (have_posts()) : the_post(); ?>
			
		<?php
    					$price = get_post_meta($post->ID, 'price', true);
    					$listing = get_post_meta($post->ID, 'listing', true);
    					$property = get_post_meta($post->ID, 'property', true);
    					$address = get_post_meta($post->ID, 'address', true);
    					$city = get_post_meta($post->ID, 'city', true);
    					$state = get_post_meta($post->ID, 'state', true);
    					$zip = get_post_meta($post->ID, 'zip', true);
    					$bed = get_post_meta($post->ID, 'bedrooms', true); 
    					$bath = get_post_meta($post->ID, 'bathrooms', true);
    					$sqft = get_post_meta($post->ID, 'sqft', true);       
    					$school = get_post_meta($post->ID, 'school', true);
    					$mlsurl = get_post_meta($post->ID, 'mlsurl', true);
    					$mlsinfo = get_post_meta($post->ID, 'mlsinfo', true);
    					$features = get_post_meta($post->ID, 'features', true);
    					$water = get_post_meta($post->ID, 'water', true);
    					$image1 = get_post_meta($post->ID, 'red_image1', true);
    					$image2 = get_post_meta($post->ID, 'red_image2', true);
    					$image3 = get_post_meta($post->ID, 'red_image3', true);
    					$image4 = get_post_meta($post->ID, 'red_image4', true);
    					$image5 = get_post_meta($post->ID, 'red_image5', true);
						$image = get_post_meta($post->ID, "red_image".$i, true);
						$blogurl = get_bloginfo('template_url');
						?>

					<h3><a title="Permanent Link to         <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><strong><?php echo $price;?></strong> | <?php the_title(); ?></a>	</h3>



<a href="<?php the_permalink() ?>" rel="bookmark"><?php
	
 if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
				
								echo '<a href="'.get_permalink().'"><div class="left_float_image" style="width:120px;height:100px;overflow:hidden;">'.get_the_post_thumbnail($id,array('120,70')).'</div></a>';
					
						
						
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