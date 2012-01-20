<?php
 
// Register Sidebars
register_sidebar( array(
	'name' => 'Sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><ul>',
	'after_widget' => '</ul></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
) );
register_sidebar( array(
	'name' => 'Side Left',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><ul>',
	'after_widget' => '</ul></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
) );
register_sidebar( array(
	'name' => 'Side Right',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><ul>',
	'after_widget' => '</ul></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
) );
register_sidebar( array(
	'name' => 'Top Right',
	'before_widget' => '<div id="recent %1$s" class="widget"><ul>',
	'after_widget' => '</ul></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'	
) );
register_sidebar( array(
	'name' => 'Top Left',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><ul>',
	'after_widget' => '</ul></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'	
) );
register_sidebar( array(
	'name' => 'Footer',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><ul>',
	'after_widget' => '</ul></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'	
) );

  
/* Custom Menu (WP 3.0+) */
if (function_exists('register_nav_menus')) {
register_nav_menus( array(
		'primary' => __( 'Main Menu', 'wpzoom' ),
 	) );
}

/* Enabling Localization */
load_theme_textdomain( 'wpzoom', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) )
require_once($locale_file);

 

/* Post Thumbnail (WP 2.9+) */
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 9999, 9999, true ); // Normal post thumbnails, set to maximum size, then will be cropped with TimThumb script
}

 
/* Custom Background (WP 3.0+) */   
if (function_exists('add_custom_background')) {
	add_custom_background();
}


/* Reset default WP styling for [gallery] shortcode */   
add_filter('gallery_style', create_function('$a', 'return "
<div class=\'gallery\'>";'));

/* Maximum width for images placed in posts */
$GLOBALS['content_width'] = 610;



/* This allows to display only exact count of comments, without trackbacks */ 
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments = get_comments('post_id=' . $id);
		$comments_by_type = &separate_comments($get_comments);
 		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}
add_filter('get_comments_number', 'comment_count', 0);



/* This will enable to insert [shortcodes] inside Text Widgets*/
add_filter('widget_text', 'do_shortcode');



/* Function that redirects you to WPZOOM Options Panel when theme is activated */    
if (is_admin() && $_GET['activated'] == 'true') {
    header("Location: admin.php?page=wpzoom_options");
}
 

/* WPZOOM Options Panel */
if (is_admin() && $_GET['page'] == 'wpzoom_options') {
    add_action('admin_head', 'wpzoom_admin_css');
    wp_enqueue_script('tabs', get_bloginfo('template_directory').'/wpzoom_admin/simpletabs.js');
}


$functions_path = TEMPLATEPATH . '/wpzoom_admin/';
require_once ($functions_path . 'admin_functions.php');
$homepath = get_bloginfo('template_directory');

add_action('admin_menu', 'wpzoom_add_admin');

function wpzoom_admin_css() {
    echo '
    <link rel="stylesheet" type="text/css" media="screen" href="'.get_bloginfo('template_directory').'/wpzoom_admin/options.css" />
    ';
}

?>