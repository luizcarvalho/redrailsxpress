<?php 
global $options; foreach ($options as $value) { if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>
<?php get_header(); ?>

	<div id="middle">
	
		<div class="post">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   			
 			<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    		
    		<div class="post-meta"><?php if ($wpzoom_singlepost_cat == 'Show') { ?><?php the_category(', ') ?> | <?php } ?><?php if ($wpzoom_singlepost_author == 'Show') { ?><?php the_author_posts_link(); ?> |	<?php } ?><?php if ($wpzoom_singlepost_date == 'Show') { ?><?php the_time("$dateformat $timeformat"); ?><?php } ?> <?php edit_post_link( __('Edit', 'wpzoom'), ' | ', ''); ?></div> <hr />
    		
			<?php the_content(' '); ?>
			
			
			<div class="nextpage"><?php wp_link_pages(); ?></div> 
			<div class="post-meta"><?php the_tags( __( '<span class="tag-links">Tags: ', 'wpzoom' ), ", ", "</span>\n" ) ?></div>
 	
			
			<?php if ($wpzoom_singlepost_share == 'Show') { ?>
			<div id="socialicons">
				<ul>
					<li><a href="http://twitter.com/share?url=<?php echo urlencode(the_permalink()); ?>&amp;text=<?php echo urlencode(the_title()); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" alt="Tweet This!" /><?php _e('Tweet This', 'wpzoom');?></a></li>
					<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" rel="external,nofollow" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" alt="Share on Facebook" /><?php _e('Share on Facebook', 'wpzoom');?></a></li>
 					<li><a href="http://digg.com/submit?phase=2&url=<?php the_permalink();?>&title=<?php the_title();?>"><img src="<?php bloginfo('template_directory'); ?>/images/digg.png" alt="Digg it!" /><?php _e('Digg This', 'wpzoom');?></a></li>
					<li><a href="http://del.icio.us/post?v=4&noui&jump=close&url=<?php the_permalink();?>&title=<?php the_title();?>"><img src="<?php bloginfo('template_directory'); ?>/images/delicious.png" alt="Add to Delicious!" /><?php _e('Save to delicious', 'wpzoom');?></a></li>
					<li><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/stumble.png" alt="Stumble it" /><?php _e('Stumble it', 'wpzoom');?></a></li>
					<li><?php if (strlen($wpzoom_misc_feedburner) > 1) { echo"<a href=\"$wpzoom_misc_feedburner\">"; } else { ?><a href="<?php bloginfo('rss2_url'); ?>"> <?php } ?><img src="<?php bloginfo('template_directory'); ?>/images/feed.png" alt="Subscribe by RSS" /><?php _e('RSS Feed', 'wpzoom');?></a></li>
				</ul> 
			</div> <!-- end social box-->
			<?php } ?>	
 	
 	
			<div id="comments">
				<?php comments_template(); ?>
			</div>  
			
			
			<?php endwhile; else: ?>

			<p><?php _e('Sorry, no posts matched your criteria', 'wpzoom');?></p>
			
			<?php endif; ?>

		</div> <!-- end post -->
	
	</div> <!-- end middle -->
 
  
<?php get_sidebar(); ?>
<?php get_footer(); ?>