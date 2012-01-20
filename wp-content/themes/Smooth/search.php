<?php get_header(); ?>
<?php multicategories_search(); ?>
<div id="main_content" class="grid_8">

<!-- Search Page -->
			<?php if (have_posts()) : ?>
			<?php $post = $posts[0];?>
			<?php  if (is_month())  ?>
			<?php if (isset($_POST['multisearch_0'])): ?>
				<h2><?php dropdown_manager_search_criteria(); ?></h2>
				<?php else: ?>
				<h2>Search Results for: <?php the_search_query(); ?></h2>
			<?php endif; ?>		
			<?php while (have_posts()) : the_post(); ?><h3><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

<a href="<?php the_permalink() ?>" rel="bookmark"><?php
	
 if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
				
						echo '<a href="'.get_permalink().'"><div class="left_float_image" style="width:120px;height:70px;overflow:hidden;">'.get_the_post_thumbnail($id,array('120,70')).'</div></a>';
						
						
				 } elseif  ( get_post_meta($post->ID, "red_image1", true)) {
				
$image = get_post_meta($post->ID, "red_image1", true);
$title = get_the_title();
echo '<div class="left_float_image"><img alt="'.$title.'"  src="'.$image.'" height="70" width="120" /></div>';



			
				} else  {
				
				 echo'<a href="'.get_permalink().'"><div class="left_float_image">'.latest_listings($post->ID,'thumbnail').'</div></a>'; 
				
					
	
}
	
?>
</a>


 <?php echo search_description($text); 
echo "...<br /><a class='more' href='";
the_permalink();
echo "'>Read More</a>";
?>
	 
			
<?php endwhile; ?>
<?php else : ?>
	
<div class="search_not_found">	<!-- Not Found Starts -->
		
<h2 class="notfound">Keyword not found, please try a new search.</h2><br/>
		
</div><!-- Single Blog Page Ends -->	
				
<?php endif; ?>





</div><!-- end main_content grid_8 -->


<div id="sidebar" class="grid_4 omega">
<?php get_sidebar();?>
</div><!-- end sidebar-->
<?php get_footer();?>