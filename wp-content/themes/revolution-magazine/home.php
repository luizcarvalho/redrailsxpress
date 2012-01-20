<?php get_header(); ?>

<div id="content">

	<div id="homepage">
				
		<div id="homepageleft">		
		
			<div class="featured">
				<?php $recent = new WP_Query("cat=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php the_content(__('Read the story &raquo;'));?><div style="clear:both;"></div>
				<?php endwhile; ?>
			</div>
			
			<div class="featured">
				<?php $recent = new WP_Query("cat=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php the_content(__('Read the story &raquo;'));?><div style="clear:both;"></div>
				<?php endwhile; ?>
			</div>
			
			<div class="featured">
				<?php $recent = new WP_Query("cat=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php the_content(__('Read the story &raquo;'));?><div style="clear:both;"></div>
				<?php endwhile; ?>
			</div>
				
		</div>
		
		<div id="homepageright">
		
			<div class="section">
			<h2>Magazine Section #1</h2>
		
				<?php $recent = new WP_Query("cat=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
				<b><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></b>
				<?php the_content_limit(130, ""); ?>
				
				<div class="hppostmeta">
					<p><?php the_time('F j, Y'); ?> | <a href="<?php the_permalink() ?>" rel="bookmark">Read the story &raquo;</a></p>
				</div>
				
				<?php endwhile; ?>
			</div>
			
			<div class="section">
			<h2>Magazine Section #2</h2>
		
				<?php $recent = new WP_Query("cat=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
				<b><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></b>
				<?php the_content_limit(130, ""); ?>
				
				<div class="hppostmeta">
					<p><?php the_time('F j, Y'); ?> | <a href="<?php the_permalink() ?>" rel="bookmark">Read the story &raquo;</a></p>
				</div>
				
				<?php endwhile; ?>
			</div>
			
			<div class="section">
			<h2>Magazine Section #3</h2>
		
				<?php $recent = new WP_Query("cat=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
				<b><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></b>
				<?php the_content_limit(130, ""); ?>
				
				<div class="hppostmeta">
					<p><?php the_time('F j, Y'); ?> | <a href="<?php the_permalink() ?>" rel="bookmark">Read the story &raquo;</a></p>
				</div>
				
				<?php endwhile; ?>
			</div>
						
			<div class="section">
			<h2>Magazine Section #4</h2>
		
				<?php $recent = new WP_Query("cat=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
				<b><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></b>
				<?php the_content_limit(130, ""); ?>
				
				<div class="hppostmeta">
					<p><?php the_time('F j, Y'); ?> | <a href="<?php the_permalink() ?>" rel="bookmark">Read the story &raquo;</a></p>
				</div>
				
				<?php endwhile; ?>
			</div>

			<div class="section">
			<h2>Magazine Section #5</h2>
		
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