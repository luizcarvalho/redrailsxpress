                <div class="primary-sidebar">
                    <?php
                        if(!dynamic_sidebar('sidebar_primary')) {
                            printf( __( 'The primary sidebar widget area. <a href="%s">Click here</a> to add some widgets now.', 'themater' ), get_bloginfo('url') . '/administracao/widgets.php' );
                        }
                    ?>
                </div><!-- .primary-sidebar -->