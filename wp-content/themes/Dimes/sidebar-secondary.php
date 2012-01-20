<?php global $theme; ?>

<div class="sidebar-secondary">

    <?php
        if(!dynamic_sidebar('sidebar_secondary')) {
            /**
            * The secondary sidebar widget area. Manage the widgets from: administracao -> Appearance -> Widgets 
            */
            $theme->hook('sidebar_secondary');
        }
    ?>
    
</div><!-- .sidebar-secondary -->