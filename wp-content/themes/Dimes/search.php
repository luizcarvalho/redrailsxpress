<?php get_template_part('content', 'before'); ?>

    <div class="content">
        <h2 class="generic"><?php _e( 'Search Results for:', 'themater' ); ?> <span><?php echo get_search_query(); ?></span></h2>
        <?php
            if (have_posts()) { 
                    get_template_part('loop', 'search');
            }  else { ?>
                <div class="entry">
                    <p><?php printf( __( 'Sorry, but nothing matched your search criteria: %s. Please try again with some different keywords.', 'themater' ), '<strong>' . get_search_query() . '</strong>' ); ?></p>
                </div>
                
                <div id="search-wrap">
                    <?php get_search_form(); ?>
                </div>
                <?php
            }
        ?> 
    </div><!-- .content -->

<?php get_template_part('content', 'after'); ?>