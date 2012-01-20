<?php
    global $theme;
    if (have_posts()) : while (have_posts()) : the_post();
?>

    <div class="post-wrap">
    
        <div <?php post_class('post clearfix'); ?> id="post-<?php the_ID(); ?>">
        
            <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themater' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            
            <div class="postmeta-primary">
    
                <span class="meta_date"><?php the_time($theme->get_option('dateformat')); ?></span>
               &nbsp; <span class="meta_author"><?php the_author(); ?></span>
    
                    <?php if(comments_open( get_the_ID() ))  {
                        ?> &nbsp; <span class="meta_comments"><?php comments_popup_link( __( 'No comments', 'themater' ), __( '1 Comment', 'themater' ), __( '% Comments', 'themater' ) ); ?></span><?php
                    }
                    
                    if(is_user_logged_in())  {
                        ?> &nbsp; <span class="meta_edit"><?php edit_post_link(); ?></span><?php
                    } ?> 
            </div>
            
            <div class="entry clearfix">
                
                <?php
                    if(has_post_thumbnail())  {
                        the_post_thumbnail(
                            array($theme->get_option('featured_image_width'), $theme->get_option('featured_image_height')),
                            array("class" => $theme->get_option('featured_image_position') . " featured_image")
                        );
                    }
                ?>
                
                <?php
                    the_content('');
                ?>
    
            </div>
            
            <div class="readmore-wrap">
                <a class="readmore" href="<?php the_permalink(); ?>#more-<?php the_ID(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themater' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $theme->option('read_more'); ?></a>
            </div>
            
        </div>
    </div><!-- Post ID <?php the_ID(); ?> -->
                
    <?php endwhile; ?>
    <?php else : ?>

    <div class="post-wrap">
    
        <div class="post">
        
            <div class="entry">

                <p><?php _e('No results were found for the requested archive.','themater'); ?></p>
            
            </div>

            <div id="search-wrap">
                
                <?php get_search_form(); ?>
            
            </div>
            
        </div>
        
    </div>
<?php endif; ?>
    
<?php if (  $wp_query->max_num_pages > 1 ) { ?>

    <div class="navigation clearfix">
        
        <?php
            if(function_exists('wp_pagenavi')) {
                wp_pagenavi();
            } else {
        ?><div class="alignleft"><?php next_posts_link( __( '<span>&laquo;</span> Older posts', 'themater' ) );?></div>
        <div class="alignright"><?php previous_posts_link( __( 'Newer posts <span>&raquo;</span>', 'themater' ) );?></div><?php
        } ?> 
        
    </div><!-- .navigation -->
    
<?php } ?>