<?php /* Posts navigation for single post pages, but not for Page post */ global $graphene_settings; ?>
<?php if (is_single() && !is_page()) : ?>
<div class="post-nav clearfix">
	<p id="previous"><?php previous_post_link(); ?></p>
	<p id="next-post"><?php next_post_link(); ?></p>
	<?php do_action('graphene_post_nav'); ?>
</div>
<?php endif; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix post-format'); ?>>
	<div class="entry-header">
    	<?php 
		global $post_format;
		switch ($post_format){
			case 'status': $format_title = __('Status update', 'graphene');	break;
			case 'audio': $format_title = __('Audio', 'graphene'); break;
			case 'image': $format_title = __('Image', 'graphene'); break;
			case 'video': $format_title = __('Video', 'graphene'); break;
			default: $format_title = __('Post format', 'graphene');
		}
		?>
        <p class="format-title"><a href="<?php the_permalink(); ?>"><?php echo $format_title; ?></a></p>
        
        <?php /* The post title */ ?>
        <div class="entry-title">
			<?php if ($post_format == 'status') : ?>
            <?php /* translators: This is the PHP date formatting string for the status post format. See http://php.net/manual/en/function.date.php for more details. */ ?>
            <p class="entry-date updated"><?php printf('%1$s &mdash; %2$s', get_the_time(__('l F j, Y', 'graphene')), get_the_time(__('g:i A', 'graphene'))); ?></p>
            <?php endif; ?>
            
            <?php if (in_array($post_format, array('audio', 'image', 'video'))) : ?>
			<p class="entry-permalink"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(esc_attr__('Permalink to %s', 'graphene'), the_title_attribute('echo=0')); ?>"><?php if (get_the_title() == '') {_e('(No title)','graphene');} else {the_title();} ?></a></p>
            <?php endif; ?>
            
            <?php /* Edit post link, if user is logged in */ ?>
			<?php if (is_user_logged_in()) : ?>
            <p class="edit-post">
                <?php edit_post_link(__('Edit post','graphene'), ' (', ')'); ?>
            </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="entry-content clearfix">
    	<div class="post-format-thumbnail">
    	<?php if ($post_format == 'status') : /* Author's avatar, displayed only for the 'status' format */ ?>
    		<?php echo get_avatar(get_the_author_meta('user_email'), 110); ?>
        <?php endif; ?>
        
        <?php if ($post_format == 'audio') : /* Featured image, displayed only for the 'audio' format */ 
			if (has_post_thumbnail(get_the_ID())) {the_post_thumbnail(array(110,110));}
        endif; ?>
        </div>
        
        <?php /* Modify the content_width var for video post format */ 
			if ($post_format == 'video'){
				global $content_width; 
				if (strpos($graphene_settings['post_date_display'], 'icon') === 0)
					$content_width -= 25;
				else
					$content_width -= 80;
			}
		?>
        
        <?php /* Output the post content */ ?>
        <?php the_content(); ?>
        
        <?php /* Revert the content_width var for video post format */ 
			if ($post_format == 'video'){
				if (strpos($graphene_settings['post_date_display'], 'icon') === 0)
					$content_width += 25;
				else
					$content_width += 80;	
			}
		?>
        
        <?php if (in_array($post_format, array('image', 'video'))) : ?>
		<?php /* translators: This is the PHP date formatting string for the image post format. See http://php.net/manual/en/function.date.php for more details. */ ?>
        <p class="entry-date updated"><?php printf( __( 'Posted on: %s', 'graphene' ), '<br /><span>' . get_the_time( __( 'F j, Y', 'graphene') ) . '</span>' ); ?></p>
        <?php endif; ?>
        
        <?php if ($post_format == 'status') : /* Post author, displayed only for the 'status' format */ ?>
        <p class="post-author vcard">&mdash; <span class="fn nickname"><?php the_author_posts_link(); ?></span></p>
        <?php endif; ?>
    </div>
</div>