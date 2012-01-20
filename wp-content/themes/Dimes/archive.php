<?php get_template_part('content', 'before'); ?>

    <div class="content">
        <h2 class="generic"><?php
            
            /* If this is a category archive */ 
           if (is_category()) { printf( __( 'Category Archives: <span>%s</span>', 'themater' ), single_cat_title( '', false ) ); 
                $the_template_part = 'categories';
           
           /* If this is a tag archive */ 
           } elseif (is_tag()) { printf( __( 'Tag Archives: <span>%s</span>', 'themater' ), single_tag_title( '', false ) ); 
                $the_template_part = 'tags';
                    
           /* If this is a daily archive */ 
           } elseif (is_day()) { printf( __( 'Daily Archives: <span>%s</span>', 'themater' ), get_the_date() ); 
                $the_template_part = 'day';
            
            /* If this is a monthly archive */ 
            } elseif (is_month()) { printf( __( 'Monthly Archives: <span>%s</span>', 'themater' ), get_the_date('F Y') );
                $the_template_part = 'month';
              
            /* If this is a yearly archive */ 
            } elseif (is_year()) { printf( __( 'Yearly Archives: <span>%s</span>', 'themater' ), get_the_date('Y') );
                $the_template_part = 'year';
            
            /* If this is an author archive */ 
            } elseif (is_author()) { printf( __( 'Author Archives: <span>%s</span>', 'themater' ),  get_the_author() );
                $the_template_part = 'author';
            
            /* If this is a general archive */ 
            } else { _e( 'Blog Archives', 'themater' ); $the_template_part = 'archive';} 
        ?></h2>
        
        <?php
            get_template_part('loop', $the_template_part);
        ?> 
    </div><!-- .content -->

<?php get_template_part('content', 'after'); ?>