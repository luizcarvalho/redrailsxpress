<?php get_header(); ?>
<?php include(TEMPLATEPATH."/carousel.php");?>
<div id="slider" class="grid_12">
<?php include(TEMPLATEPATH . '/slider.php');?>
</div>

<?php if (Themehave_random_posts()) : ?>
		<?php while (Themehave_random_posts()) : $theme_queryRandom->the_post();  
		if(!@in_array(get_the_ID(), $showedPosts)){
			$showedPosts[] = get_the_ID();
		?>
            <?php }
			endwhile; ?>
			<?php else : ?>
			<?php endif; ?>	


<div id="main_content" class="grid_8">
<div id="home_agent" class="grid_5 alpha"> 
<div id="home_agent_inner">
<div class="home_agent">
<?php iu_show_only_author_photos( get_the_author_ID()); ?>
<div class="title"><?php echo  'Welcome, from '?><?php echo  the_author_meta('first_name') ?>	<?php the_author_meta('last_name') ?></div>
<?php $agent_description =  get_the_author_description();
    echo ShortenText($agent_description);
    ?>
<a class="more" href='<?php echo get_bloginfo('url') ?>/author/<?php the_author_login();?>'>Read Bio</a>
</div>

</div><!-- end home_agent_inner -->
</div><!-- end home_agent -->


	
<div id="home_calc" class="grid_3 omega">
<div id="home_calc_inner"><a href="<?php bloginfo('url'); ?>/calculator/"><img alt ="Finance Calculator" src="<?php bloginfo('template_url') ?>/images/discover_calc.png" /></a></div><!-- end home_calc_inner -->

</div><!-- end calc ad -->
<div style="clear:both"></div>
<h2>Latest Listings</h2>
<div id="latestlistings">



	
							
		<?php rewind_posts(); ?>
		
<?php 	 $post = $wp_query->post;
$listings = get_settings($shortname."_randomCategoryPosts");
$latestnews = new WP_Query('cat='.$listings.'&showposts=6');?>
<?php while ($latestnews->have_posts()) : $latestnews->the_post(); ?>
<?php
    					$price = get_post_meta($post->ID, 'price', true);
       					$address = get_post_meta($post->ID, 'address', true);
    					$city = get_post_meta($post->ID, 'city', true);
    					$state = get_post_meta($post->ID, 'state', true);
    					$zip = get_post_meta($post->ID, 'zip', true);
						$bed = get_post_meta($post->ID, 'bedrooms', true);
						$bath = get_post_meta($post->ID, 'bathrooms', true);
    					
						?>
<div class="latest_listings">
<div class="price">
	   <?php $gv1 = get_post_meta($post->ID, 'price', true); if ( $gv1 ) { echo $gv1;} else { echo '';} ?>

	  </div>
	<a href="<?php the_permalink() ?>" rel="bookmark"><?php
	
 if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
				
						echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($id,array('120,60')).'</a>';
						
						
				 } elseif  ( get_post_meta($post->ID, "red_image1", true)) {
				
$image = get_post_meta($post->ID, "red_image1", true);
$title = get_the_title();
echo '<img alt="'.$title.'"  src="'.$image.'" height="100" width="60" />';
			
				} else  {
				
				 echo'<a href="'.get_permalink().'">'.latest_listings($post->ID,'thumbnail').'</a>'; 
				
}
	
?>
</a>
	
			
	  <div class="grid-left">
	  	  <a class="view" title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><img style="border:none;" alt="<?php echo $title?>" src="<?php bloginfo('template_url') ?>/images/view.png" /></a>
	  
	  	<p style="margin:0px 5px 5px 0px;font-weight:bold;">
<?php $gv5 = get_post_meta($post->ID, 'bedrooms', true);
if ( $gv5 ) { echo $gv5; echo '<span> ' .get_custom_label(' br'). '</span> - ' ;} else {  echo ''; } ?>
<?php $gv6 = get_post_meta($post->ID, 'bathrooms', true);
if ( $gv6 ) { echo $gv6; echo '<span> ' .get_custom_label(' ba'). '</span>' ;} else {  echo ''; } ?></p>
</div> <!-- end entry -->



		</div>
		
		 <?php endwhile; ?>
			

</div><!-- end latest listings -->

<div style="clear:both"></div>
<div id="news">

<h2>Latest News</h2>


<?php 
$show = get_settings($shortname."_homePostCategory");
$latestnews = new WP_Query('cat='.$show.'&showposts=5');?>
     <?php while ($latestnews->have_posts()) : $latestnews->the_post(); ?>
  <h3><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php echo ShortenText(get_the_title()); ?></a><br/>	
<span class="small"><!-- Metadata --><?php the_time('M') ?> - <?php the_time('d') ?></span></h3>	

	<?php echo news_description($text); ?><a href='<?php the_permalink();?>'><span class="more">Continue Reading &raquo;</span> </a>  


  <?php endwhile; ?>

</div><!-- end news -->
</div><!-- end grid_8 -->


<div id="sidebar" class="grid_4 omega">
<?php get_sidebar();?>
</div><!-- end sidebar-->

<?php get_footer();?>
