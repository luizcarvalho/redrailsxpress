<?php get_template_part('content', 'before'); ?>

    <div class="content">
    
        <div class="entry">
            <?php _e('The page you requested could not be found.','themater'); ?>
        </div>
        
        <div id="search-wrap">
            <?php get_search_form(); ?>
        </div>
        
    </div><!-- .content -->

<?php get_template_part('content', 'after'); ?>