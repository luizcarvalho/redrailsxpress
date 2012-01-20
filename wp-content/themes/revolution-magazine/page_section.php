<?php
/*
Template Name: Section Page
*/
?>

<?php get_header(); ?>

<div id="content">

	<div id="homepage">
				
	<div id="homepageleft">		
	
		<div class="featured">
			<h2>Featured Section Story</h2>
			<img style="margin-bottom:10px" src="<?php bloginfo('template_url'); ?>/images/section-main.jpg" alt="Featured Story" />
			<?php $recent = new WP_Query("cat=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
			<b><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></b>
			<?php the_content_limit(125, "Read more &raquo;"); ?><div style="clear:both;"></div>
			<?php endwhile; ?>
		</div>
			
	</div>
		
	<div id="homepageright">

		<div class="section">
		<h2>Featured Section Headlines</h2>
		
			<?php $recent = new WP_Query("cat=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
			<b><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></b>
			<?php the_content_limit(130, ""); ?>
				
			<div class="hppostmeta">
				<p><?php the_time('F j, Y'); ?> | <a href="<?php the_permalink() ?>" rel="bookmark">Read the story &raquo;</a></p>
			</div>
				
			<?php endwhile; ?>
		</div>

	</div>
		
	</div>
	
<?php include(TEMPLATEPATH."/sidebar.php");?>
		
</div>

<!-- The main column ends  -->

<?php get_footer(); ?>