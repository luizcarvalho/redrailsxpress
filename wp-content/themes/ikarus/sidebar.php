			</div>
		</div></div></div>
		<!-- END: CONTENT -->
		
            <?php include (TEMPLATEPATH . '/options/options.php'); ?>
            	<!-- BEGIN: COLUMNS -->
		<div id="colwrap">
				<?php include (TEMPLATEPATH . '/advertisment.php'); ?>
						<div id="col1"><div class="innerpad">
                        
                        
						<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar(1) ) : ?>

<div class="module">
			<div>
				<div>
					<div>

<h3><?php _e('Recent Comments'); ?></h3>
<ul><?php
$comments = $wpdb->get_results("SELECT comment_author, comment_author_url, comment_ID, comment_post_ID FROM $wpdb->comments WHERE comment_approved = '1' ORDER BY comment_date_gmt DESC LIMIT 5");
if ( $comments ) : foreach ($comments as $comment) :
echo  '<li>' . sprintf(__('%1$s on %2$s'), get_comment_author_link(), '<a href="'. get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
endforeach; endif;?>
</ul>
</div>
				</div>
			</div>
		</div>
<div class="module">
			<div>
				<div>
					<div>
<h3><?php _e('Categories'); ?></h3>
<ul class="clearfix">
<?php wp_list_categories('orderby=id&show_count=0&use_desc_for_title=0&title_li='); ?>
</ul>
</div>
				</div>
			</div>
		</div>

<?php endif; ?>

					</div></div>
			
						<div id="col2"><div class="innerpad">
										<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar(2) ) : ?>

<div class="module-hilite">
			<div>
				<div>
					<div>
<h3><?php _e('Pages'); ?></h3>
	
	<ul class="clearfix">
<?php wp_list_pages('title_li=&depth=0'); ?>
</ul>
</div>
				</div>
			</div>
		</div>


<!--[if !IE]>
sample no list sidebar list
<div class="module-hilite">
			<div>
				<div>
					<div>
<h3><?php _e('Archives'); ?></h3>
<ul class="nolist">
<?php wp_get_archives('type=monthly&limit=12&show_post_count=0'); ?>
</ul>
</div>
				</div>
			</div>
		</div>
<![endif]-->

        
<div class="module-hilite">
			<div>
				<div>
					<div>
<h3><?php _e('Archives'); ?></h3>
<ul class="list">
<?php wp_get_archives('type=monthly&limit=12&show_post_count=0'); ?>
</ul>
</div>
				</div>
			</div>
		</div>



<?php endif; ?>
				
					</div></div>

					<?php include (TEMPLATEPATH . '/domtab.php'); ?>	
                        
<?php if($tn_mz_aside_post_status==yes): ?>
		
<div class="module">
			<div>
				<div>
					<div>
<h3>Latest In: <?php echo stripslashes($tn_mz_aside_post_cat); ?></h3>

<?php $my_query = new WP_Query('category_name='. $tn_mz_aside_post_cat . '&' . 'showposts='. $tn_mz_aside_post_sum);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID; ?>
<div class="side-feat">
<?php $values = get_post_custom_values("featured-images");
if ( is_array($values)) : ?>
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo "$values[0]"; ?>" alt="<?php the_title(); ?>" align="left" style="border: 1px solid #ffffff; padding 2px" /></a>
<?php endif; ?>
<h1><?php the_title(); ?></h1>
<p><?php the_excerpt_aside(); ?></p></div><?php endwhile;?>
</div>
				</div></div>
			</div>
		
<?php endif; ?>                        

		</div><br />
		<!-- END: COLUMNS -->