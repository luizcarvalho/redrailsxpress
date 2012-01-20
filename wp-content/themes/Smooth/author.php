<?php get_header(); ?>
<div id="main_content" class="grid_8">

<?php
					if(isset($_GET['author_name'])) :
					$curauth = get_userdatabylogin($author_name);
					else :
					$curauth = get_userdata(intval($author));
					endif;
				?>

  			<?php the_post(); ?>


<br/>

<!--  Author bio -->
<h2 class="agent"><?php echo $curauth->first_name ; ?> <?php echo $curauth->last_name ; ?></h2>
<div style="float:left;margin-bottom:10px;"><!--  Author Photo --><?php 			
iu_show_only_author_photos( get_the_author_ID() ) 
?>
</div>

<p><?php echo $curauth->user_description; ?></p>

<div style="clear:both;"></div>
<h2 class="agent">Listings by <?php echo $curauth->first_name ; ?>:</h2>

<!-- Query agents properties -->
<?php
$author = get_userdata(get_query_var('author'));
$show = get_settings($shortname."_homePostCategory");
$limit = get_settings('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$mypost = new WP_Query('showposts='.$limit.'&paged=' . $paged.'&cat=-'.$show.'&author=' . $author->ID);
while ($mypost->have_posts()) : $mypost->the_post();

?>
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

<p>
       <?php echo search_description($text);
   echo "...<br/><a class='more' href='";
   the_permalink();
    echo "'>View Property</a>";
?></p>

<div style="clear:both"></div>

	<?php endwhile; ?>

     
<!-- End Loop -->





</div><!-- end main_content grid_8 -->
<div id="sidebar" class="grid_4 omega">
<?php get_sidebar();?>
</div><!-- end sidebar-->
<div class="clear"></div>
<?php get_footer();?>