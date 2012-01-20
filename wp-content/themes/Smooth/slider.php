<div id="horizontal_carousel">
    <div class="next_button"></div>  
      <div class="container">
        <ul>       
         <?php 
            $recent_posts = new WP_Query(); $recent_posts->Query('category_name=Featured');
while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>	
          <li>        
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php
	
 if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
				
						echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($id,array('120,60')).'</a>';
						
						
				 } elseif  ( get_post_meta($post->ID, "red_image1", true)) {
				
$image = get_post_meta($post->ID, "red_image1", true);
$title = get_the_title();
echo '<img alt="'.$title.'"  src="'.$image.'" height="60" width="120" />';
	
				} else  {
				
				 echo'<a href="'.get_permalink().'">'.slider($post->ID,'thumbnail').'</a>'; 					
}
	
?>
</a>
<a href="<?php the_permalink() ?>" rel="bookmark"><span style="font-weight:bold;"><?php the_title(); ?></span></a>					
				<br/>	<?php $s1 = get_post_meta($post->ID, 'listing', true);if ( $s1 ) { echo '<span class="metalistingtype">' .$s1 . '</span><br/>';} else {}?>
				<?php $s2 = get_post_meta($post->ID, 'price', true);if ( $s2 ) { echo '<span class="metalistingprice">' .$s2 . '</span>';} else {}?>
					
            </li>
          <?php endwhile; ?>
          </ul>
    	</div>
    <div class="previous_button"></div>
</div>
<p style="clear:both;"></p>