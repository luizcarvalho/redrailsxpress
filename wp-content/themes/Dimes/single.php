<?php get_template_part('content', 'before'); ?>

    <div class="content">
        <?php if (have_posts()) while (have_posts()) : the_post(); ?> 
            <div class="post-wrap post-wrap-single">
                
                <div <?php post_class('post clearfix'); ?> id="post-<?php the_ID(); ?>">
                
                    <h2 class="title"><?php the_title(); ?></h2>
                    
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
                                    array(300, 225),
                                    array("class" => "alignleft featured_image")
                                );
                            }
                        ?>
                        
                        <?php
                            the_content('');
                            wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages:', 'themater' ) . '</strong>', 'after' => '</p>' ) );
                        ?>
            
                    </div>
            
                    <div class="postmeta-secondary">
                       <span class="meta_categories"><?php _e( 'Posted in:', 'themater' ); ?>  <?php the_category(', '); ?></span>
                       <?php if(get_the_tags()) {
                                ?> &nbsp; <span class="meta_tags"><?php the_tags(__( 'Tags:', 'themater') . ' ', ', ', ''); ?></span><?php
                            }
                        ?> 
                    </div>
                
                </div><!-- Post ID <?php the_ID(); ?> -->
                
            </div><!-- .post-wrap -->
            
            <?php 
                if(comments_open( get_the_ID() ))  {
                    comments_template('', true); 
                }
            ?>
            
        <?php endwhile; ?>
    </div><!-- .content -->

<?php get_template_part('content', 'after'); ?>