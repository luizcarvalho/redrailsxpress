<?php get_header(); ?>
	
	<?php
	    $post = $wp_query->post;
	    $show = get_settings($shortname."_homePostCategory");
	    if ( in_category($show)) {
	    include(TEMPLATEPATH . '/singleblog.php');
		} else {
	    include(TEMPLATEPATH . '/singleproperty.php');
	    }
	?>