<?php global $theme; ?>

<div class="sidebar-primary">

    <?php
        if(!dynamic_sidebar('sidebar_primary')) {
            /**
            * The primary sidebar widget area. Manage the widgets from: administracao -> Appearance -> Widgets 
            */
            $theme->hook('sidebar_primary');
        }
    ?>
    
</div><!-- .sidebar-primary -->