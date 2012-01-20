 <?php get_header(); ?>
<?php include(TEMPLATEPATH."/maps/maps.php");?>
<div id="main_content" class="grid_8">

<!-- Real Estate Plugin Variables --> 
<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<?php	$price = get_post_meta($post->ID, 'price', true);
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
					$image6 = get_post_meta($post->ID, 'red_image6', true);
					$image7 = get_post_meta($post->ID, 'red_image7', true);
					$image8 = get_post_meta($post->ID, 'red_image8', true);
					$image9 = get_post_meta($post->ID, 'red_image9', true);
					$image10 = get_post_meta($post->ID, 'red_image10', true);
					$image11 = get_post_meta($post->ID, 'red_image11', true);
					$image12 = get_post_meta($post->ID, 'red_image12', true);
					$image13 = get_post_meta($post->ID, 'red_image13', true);
					$image14 = get_post_meta($post->ID, 'red_image14', true);
					$image = get_post_meta($post->ID, "red_image".$i, true);
					$blogurl = get_bloginfo('template_url');
					?>
<!-- End Estate Plugin Variables --> 
<!-- Property Being Viewed --> 
<!-- Property Details --> 
<h2><?php the_title(); ?></h2>
	 <div class="current_property"><span class="highlight"><?php echo $price;?></span> | <?php echo $address . ', ';?><?php echo $city. ', ';?><?php echo $state. ' ';?><?php echo $zip;?></div>

<!-- End Property Being Viewed --> 




<!-- Features Start--> 
<h2>Features</h2>  
<p class="features_left"><?php $gv1 = get_post_meta($post->ID, 'price', true); if ( $gv1 ) { echo '<span class="metalisting">'. get_custom_label('Price').':' .' '. $gv1. '</span><br/>';} else { echo '';} ?>
<?php $gv2 = get_post_meta($post->ID, 'listing', true);
if ( $gv2 ) { echo '<strong>'.get_custom_label('Listing Type').':</strong><span class="metalisting"> '. $gv2. '</span><br/>'; } else { echo ''; } ?>
<?php $gv3 = get_post_meta($post->ID, 'property', true);
if ( $gv3 ) { echo '<strong>'.get_custom_label('Property Type').':</strong><span class="metalisting"> '. $gv3. '</span><br/>'; } else {  echo ''; } ?>
<?php $gv4 = get_post_meta($post->ID, 'bedrooms', true);
if ( $gv4 ) { echo '<strong>'.get_custom_label('Bedrooms').':</strong><span class="metalisting"> '. $gv4. '</span><br/>'; } else {  echo ''; } ?>
<?php $gv5 = get_post_meta($post->ID, 'bathrooms', true);
if ( $gv5 ) { echo '<strong>'.get_custom_label('Bathrooms').':</strong><span class="metalisting"> '. $gv5. '</span><br/>'; } else {  echo ''; } ?>
<?php $gv6 = get_post_meta($post->ID, 'school', true);
if ( $gv6 ) { echo '<strong>'.get_custom_label('School District').':</strong><span class="metalisting"> '. $gv6. '</span><br/>'; } else {  echo ''; } ?>
<?php $gv7 = get_post_meta($post->ID, 'water', true);
if ( $gv7 ) { echo '<strong>'.get_custom_label('Waterfront Property').':</strong><span class="metalisting"> '. $gv7. '</span><br/>'; } else {  echo ''; } ?>
</p>
<p class="features_right"><?php $gv8 = get_post_meta($post->ID, 'features', true);
if ( $gv8 ) { echo '<strong>'.get_custom_label('Features').':</strong><span class="metalisting"> '. $gv8. '</span><br/>'; } else {  echo ''; } ?>
<?php $gv9 = get_post_meta($post->ID, 'mlsurl', true);
if ( $gv9 ) { echo '<strong>'.get_custom_label('MLS link').':</strong><span class="metalisting"> '. $gv9. '</span><br/>'; } else {  echo ''; } ?>
<?php $gv10 = get_post_meta($post->ID, 'mlsinfo', true);
if ( $gv10 ) { echo '<strong>'.get_custom_label('MLS Info').':</strong><span class="metalisting"> '. $gv10. '</span><br/>'; } else {  echo ''; } ?>
<?php $gv11 = get_post_meta($post->ID, 'sqft', true);
if ( $gv11 ) { echo '<strong>'.get_custom_label('Sqft').':</strong><span class="metalisting"> '. $gv11. '</span><br/>'; } else {  echo ''; } ?>
<?php foreach (get_more_fields($post->ID) as $field) {
    echo '<strong>'.$field->label.'</strong>: ' . ' <span class="metalisting">' . $field->value. '</span><br/>';
}?>			  
</p>

 <!-- End Features --> 
 <div style="clear:both;"></div>						
						<div id="gallery">
   		
			<h2>Gallery</h2>  
						<?php
								
								
		$thumb = get_post_meta($post->ID, 'red_image1', true);						
						
	
 if ($thumb) {
				
					for($i = 1; $i <= 14; $i++){
							$image = get_post_meta($post->ID, "red_image".$i, true);
							$blogurl = get_bloginfo('template_url');

					if($image){

							$output = '<a href="'.$image.'" rel="lightbox[image_gallery]" class="thumbs"><img src="'.$image.'" height=70 width=70 alt="Photo Gallery" /></a>';
							
							echo $output;}
							

								}
								
								
			}					

else{
									photo_gallery($post->ID,'thumbnail');
				

											}


	
?>

</div>

<div style="clear:both"></div><br/>
<h2>Description</h2>                    
<?php
ob_start();
 the_content(''.__('Read More').'');
$old_content = ob_get_clean();
$new_content = strip_tags($old_content, '<p><a><b><br /><li><ol><ul>');
echo $new_content;
?>
<div class="clear"></div>
<!-- Google Map Start--> 

<h2>Property Location | <?php echo $address . ', ';?><?php echo $city. ', ';?><?php echo $state. ' ';?><?php echo $zip;?></h2>
<br> 
<div id="map" style="width: 596px; height: 300px;background:#ebebeb;margin:10px 10px 10px 0px;padding:4px;border:3px solid #ccc;"></div>
<!-- House Details Ends-->

<div style="clear:both;"></div>

				<?php endwhile; ?>

				<?php else : ?>

				<?php endif; ?>

<!-- Related Properties -->

<br>
<h2>Other properties you may be interested in</h2>
<br>
<?php
					if(isset($_GET['author_name'])) :
					$curauth = get_userdatabylogin($author_name);
					else :
					$curauth = get_userdata(intval($author));
					endif;
				?>

  			<?php the_post(); ?>

			
				<?php rewind_posts(); ?>

		<!-- The Loop -->
			<?php
			$authid =get_the_author_ID();
	   	    $show = get_settings($shortname."_homePostCategory");			
			$moreprop = new WP_query();
			$moreprop->Query('showposts=3&cat=-' . $show . '&author='.$authid .'');


?>

<?php while ($moreprop->have_posts()) : $moreprop->the_post(); ?>		
		
<?php	$price = get_post_meta($post->ID, 'price', true);
					$bed = get_post_meta($post->ID, 'bedrooms', true); 
					$bath = get_post_meta($post->ID, 'bathrooms', true);
					?>
		

<div class="latest_listings">
<div class="price">
	   <?php echo $price ;?>
	  </div>
	<div><a href="<?php the_permalink() ?>" rel="bookmark"><?php
	
 if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
				
						echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($id,array('150,100')).'</a>';
						
						
				 } elseif  ( get_post_meta($post->ID, "red_image1", true)) {
				
$image = get_post_meta($post->ID, "red_image1", true);
$title = get_the_title();
echo '<img alt="'.$title.'"  src="'.$image.'" height="100" width="150" />';

			
				} else  {
				
				 echo'<a href="'.get_permalink().'">'.slider($post->ID,'thumbnail').'</a>'; 
					
}
	
?>
</a>
</div>	
			
	  <div class="grid-left">
	  	  <a class="view" title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php bloginfo('template_url') ?>/images/view.png" /></a>
	  
	  	<p style="margin:0px 5px 5px 0px;"><?php echo $bed ;?> <?php echo ' br ' ;?>
								<?php echo $bath ;?><?php echo ' ba ' ;?>
</div> <!-- end entry -->
</div>
<?endwhile; ?>
<!-- End Loop -->


</div><!-- end main_content grid_8 -->
<div id="sidebar" class="grid_4 omega">
<?php get_sidebar();?>
</div><!-- end sidebar-->
<div class="clear"></div>
<?php get_footer();?>