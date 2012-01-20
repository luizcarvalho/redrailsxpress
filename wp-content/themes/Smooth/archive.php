<?php get_header(); ?>

<div id="main_content" class="grid_8">


<?php if (have_posts()) : ?>
	<?php $post = $posts[0];?>
	<?php  if (is_month())  ?>
	
	 <h2 class="month_metadata">Archive for <?php the_time('F, Y'); ?></h2>

		
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


		<small><?php the_time('F jS, Y') ?> </small><br />
       <?php echo search_description($text);
    echo "...<a class='readmore' href='";
        the_permalink();
        echo "'>Read More</a>";

  ?>			 
	<div style="clear:both"></div>

       	<?php endwhile; ?>		
	    <?php else : ?>

		<h2 class="center">Not Found</h2>

<?php endif; ?>


</div><!-- end main_content grid_8 -->


<div id="sidebar" class="grid_4 omega">
<?php get_sidebar();?>
</div><!-- end sidebar-->

<?php get_footer();?>