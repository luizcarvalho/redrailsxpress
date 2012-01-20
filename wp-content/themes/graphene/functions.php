<?php
/**
 * Graphene functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, graphene_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists() ) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *  
 *     remove_filter( 'filter_hook', 'callback_function' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.0
 */
 
 
/**
 * Before we do anything, let's get the mobile extension's init file if it exists
*/
$mobile_path = dirname( dirname( __FILE__ ) ) . '/graphene-mobile/includes/theme-plugin.php';
if ( file_exists( $mobile_path) ) { include( $mobile_path ); }

 /**
 * Retrieve the theme's user settings and default settings. Individual files can access
 * these setting via a global variable call, so database query is only
 * done once.
*/
require_once( 'admin/options-defaults.php' );
$graphene_defaults = apply_filters( 'graphene_defaults', $graphene_defaults );
function graphene_get_settings(){
	global $graphene_defaults;
	$graphene_settings = array_merge( $graphene_defaults, (array) get_option( 'graphene_settings', array() ) );
	return apply_filters( 'graphene_settings', $graphene_settings );
}
global $graphene_settings;
$graphene_settings = graphene_get_settings();


/**
 * If there is no theme settings in the database yet (e.g. first install), add the database entry.
*/
if (!function_exists( 'graphene_db_init' ) ) :
	function graphene_db_init(){
		global $graphene_settings, $graphene_defaults;
		
		/* Run DB updater if $graphene_settings does not exist in db */
		if (get_option( 'graphene_ga_code' ) === '' ){
			
			// Updates the database for much older version, when Settings API was not yet implemented
			include( 'admin/db-updater.php' );
			graphene_update_db();
			$graphene_settings = array_merge( $graphene_defaults, get_option( 'graphene_settings', array() ));
		
		} 
		
		/* Delete DB Version from the database. This value is now included in the $graphene_defaults array */
		delete_option( 'graphene_dbversion' );
	}
endif;
add_action( 'init', 'graphene_db_init' );


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if (!isset( $content_width) ){
	$column_mode = graphene_column_mode();
	if (strpos( $graphene_settings['post_date_display'], 'icon' ) === 0){
		if (strpos( $column_mode, 'two-col' ) === 0){
			$content_width = apply_filters( 'graphene_content_width_two_columns', 590);
		} else if (strpos( $column_mode, 'three-col-center' ) === 0) {
			$content_width = apply_filters( 'graphene_content_width_three_columns_center', 360);
		} else if (strpos( $column_mode, 'three-col' ) === 0){
			$content_width = apply_filters( 'graphene_content_width_three_columns', 375);
		} else {
			$content_width = apply_filters( 'graphene_content_width_one_columns', 875);	
		}
	} else {
		if (strpos( $column_mode, 'two-col' ) === 0){
			$content_width = apply_filters( 'graphene_content_width_two_columns_nodate', 645);
		} else if (strpos( $column_mode, 'three-col-center' ) === 0) {
			$content_width = apply_filters( 'graphene_content_width_three_columns_center_nodate', 415);
		} else if (strpos( $column_mode, 'three-col' ) === 0){
			$content_width = apply_filters( 'graphene_content_width_three_columns_nodate', 430);
		} else {
			$content_width = apply_filters( 'graphene_content_width_one_columns_nodate', 930);	
		}
	}
}


/** Tell WordPress to run graphene_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'graphene_setup' );

if (!function_exists( 'graphene_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override graphene_setup() in a child theme, add your own graphene_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Graphene 1.0
 */
function graphene_setup() {
	global $graphene_settings;
		
	// Add custom image sizes selectively
	if ( $graphene_settings['slider_display_style'] == 'bgimage-excerpt' ) {
		$height = ( $graphene_settings['slider_height']) ? $graphene_settings['slider_height'] : 240;
		add_image_size( 'graphene_slider', apply_filters( 'graphene_slider_image_width', 660), $height, true);
		add_image_size( 'graphene_slider_full', apply_filters( 'graphene_slider_full_image_width', 930), $height, true);
		add_image_size( 'graphene_slider_small', apply_filters( 'graphene_slider_small_image_width', 445), $height, true);
	}
	if (get_option( 'show_on_front' ) == 'page' && !$graphene_settings['disable_homepage_panes']) {
		add_image_size( 'graphene-homepage-pane', apply_filters( 'graphene_homepage_pane_image_width', 451), apply_filters( 'graphene_homepage_pane_image_height', 250), true);
	}
	
	// Add support for editor syling
	add_editor_style();
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// Add supported post formats
	add_theme_support( 'post-formats', array( 'status', 'audio', 'image', 'video' ) );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'graphene', get_template_directory().'/languages' );
	
	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array( 
		'Header Menu' => __( 'Header Menu', 'graphene' ),
		'secondary-menu' => __( 'Secondary Menu', 'graphene' ),
		'footer-menu' => __( 'Footer Menu', 'graphene' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', apply_filters( 'graphene_header_textcolor', '000000' ) );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', apply_filters( 'graphene_header_image', '%s/images/headers/flow.jpg' ) );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to graphene_header_image_width and graphene_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'graphene_header_image_width', 960) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'graphene_header_image_height', 198) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 960 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size(HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true);

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', apply_filters( 'graphene_header_text', false) );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See graphene_admin_header_style(), below.
	add_custom_image_header( '', 'graphene_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( graphene_get_default_headers() );
        
    do_action( 'graphene_setup' );
}
endif;

if (!function_exists( 'graphene_get_default_headers' ) ) {
	function graphene_get_default_headers() {
		return array( 'Schematic' => array( 'url' => '%s/images/headers/schematic.jpg',
				'thumbnail_url' => '%s/images/headers/schematic-thumb.jpg',
				/* translators: header image description */
				'description' => __( 'Header image by Syahir Hakim', 'graphene' ) ),
			'Flow' => array( 'url' => '%s/images/headers/flow.jpg',
				'thumbnail_url' => '%s/images/headers/flow-thumb.jpg',
				/* translators: header image description */
				'description' => __( 'This is the default Graphene theme header image, cropped from image by Quantin Houyoux at sxc.hu', 'graphene' ) ),
			'Fluid' => array( 'url' => '%s/images/headers/fluid.jpg',
				'thumbnail_url' => '%s/images/headers/fluid-thumb.jpg',
				/* translators: header image description */
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
			'Techno' => array( 'url' => '%s/images/headers/techno.jpg',
				'thumbnail_url' => '%s/images/headers/techno-thumb.jpg',
				/* translators: header image description */
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
			'Fireworks' => array( 'url' => '%s/images/headers/fireworks.jpg',
				'thumbnail_url' => '%s/images/headers/fireworks-thumb.jpg',
				/* translators: header image description */
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
			'Nebula' => array( 'url' => '%s/images/headers/nebula.jpg',
				'thumbnail_url' => '%s/images/headers/nebula-thumb.jpg',
				/* translators: header image description */
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
			'Sparkle' => array( 'url' => '%s/images/headers/sparkle.jpg',
				'thumbnail_url' => '%s/images/headers/sparkle-thumb.jpg',
				/* translators: header image description */
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
		);
	}
}


/**
 * Register and print the main theme stylesheet
*/
function graphene_main_stylesheet(){
	if ( ! is_admin() ) {
		wp_register_style( 'graphene-stylesheet', get_stylesheet_uri(), array(), false, 'screen' );
		wp_register_style( 'graphene-stylesheet-rtl', get_template_directory_uri() . '/rtl.css', array(), false, 'screen' );
		
		wp_enqueue_style( 'graphene-stylesheet' );	
		if ( is_rtl() ) wp_enqueue_style( 'graphene-stylesheet-rtl' );
	}
}
add_action( 'wp_print_styles', 'graphene_main_stylesheet' );


if (!function_exists( 'graphene_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in graphene_setup().
 *
 * @since graphene 1.0
 */
function graphene_admin_header_style(){ ?>
	<style type="text/css">
    #headimg #name{
    position:relative;
    top:65px;
    left:38px;
    width:852px;
    font:bold 28px "Trebuchet MS";
    text-decoration:none;
    }
    #headimg #desc{
        color:#000;
        border-bottom:none;
        position:relative;
        top:50px;
        width:852px;
        left:38px;
        font:18px arial;
        }
    </style>
    
	<?php
	do_action( 'graphene_admin_header_style' );
}
endif;


/**
 * Registers custom scripts that the theme uses
*/
function graphene_register_scripts(){
	wp_register_script( 'graphene-jquery-tools', 'http://cdn.jquerytools.org/1.2.5/all/jquery.tools.min.js', array( 'jquery' ), '', true);	
}
add_action( 'init', 'graphene_register_scripts' );

/**
 * Enqueues the custom scripts that the theme uses
*/
function graphene_enqueue_scripts(){
	if ( ! is_admin() ) { // Front-end only
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'graphene-jquery-tools' ); // jQuery Tools, required for slider
	}	
}
add_action( 'init', 'graphene_enqueue_scripts' );
 

/**
 * Get the custom style attributes, these are defined by theme options.
 * 
 * @global type $graphene_settings
 * @global type $graphene_defaults
 * @global type $content_width
 * @return string 
 */
function graphene_get_custom_style(){ 
	global $graphene_settings, $graphene_defaults, $content_width;
	
	$background = get_theme_mod( 'background_image', false);
	$bgcolor = get_theme_mod( 'background_color', false);
	$widgetcolumn = (is_front_page() && $graphene_settings['alt_home_footerwidget']) ? $graphene_settings['alt_footerwidget_column'] : $graphene_settings['footerwidget_column'];
        
$style = '';
	
	/* Disable default background if a custom background colour is defined */
	if (!$background && $bgcolor) {
		$style .= 'body{background-image:none;}';
	}
		
	/* Set the width of the bottom widget items if number of columns is specified */
	if ( $widgetcolumn ) {
		$widget_width = floor( (apply_filters( 'graphene_container_width', 960) - (15+25+2)*$widgetcolumn)/$widgetcolumn);
		$style .= '#sidebar_bottom .sidebar-wrap{width:'.$widget_width.'px}';
	}
        
	/* Set the width of the nav menu dropdown menu item width if specified */
	if ( $graphene_settings['navmenu_child_width'] ) {
		$nav_width = $graphene_settings['navmenu_child_width'];
		$style .= '#nav li ul{width:'.$nav_width.'px;}';
		
		if ( ! is_rtl() ){
			$background_left = -652-(200-$nav_width);
			$tmp_width = $nav_width-35;
            
			$style .= '	#nav li ul ul{margin-left:'.$nav_width.'px}
                       	#header-menu ul li.menu-item-ancestor > a {
						background-position:'.$background_left.'px -194px;
						width:'.$tmp_width.'px;
                        }
                        #header-menu ul li.menu-item-ancestor:hover > a,
                        #header-menu ul li.current-menu-item > a,
                        #header-menu ul li.current-menu-ancestor > a {
						background-position:'.$background_left.'px -238px;
                        }
						#secondary-menu ul li.menu-item-ancestor > a {
						background-position:'.$background_left.'px -286px;
						width:'.$tmp_width.'px;
						}
						#secondary-menu ul li.menu-item-ancestor:hover > a,
						#secondary-menu ul li.current-menu-item > a,
						#secondary-menu ul li.current-menu-ancestor > a {
						background-position:'.$background_left.'px -319px;
						}';
		} else {
            $style .= '	#nav li ul ul{margin-right:'.$nav_width.'px; margin-left: 0;}
						#header-menu ul li.menu-item-ancestor > a,
						#secondary-menu ul li.menu-item-ancestor > a {
						width:'.($nav_width-35).'px;
						}';
        }
		
		$style .= '#header-menu ul li a{width:'.($nav_width-20).'px;}';
		$style .= '#secondary-menu ul li a{width:'.($nav_width-30).'px;}';
	}
	
	/* Header title text style */ 
	$font_style = '';
	$font_style .= ( $graphene_settings['header_title_font_type']) ? 'font-family:'.$graphene_settings['header_title_font_type'].';' : '';
	$font_style .= ( $graphene_settings['header_title_font_lineheight']) ? 'line-height:'.$graphene_settings['header_title_font_lineheight'].';' : '';
	$font_style .= ( $graphene_settings['header_title_font_size']) ? 'font-size:'.$graphene_settings['header_title_font_size'].';' : '';
	$font_style .= ( $graphene_settings['header_title_font_weight']) ? 'font-weight:'.$graphene_settings['header_title_font_weight'].';' : '';
	$font_style .= ( $graphene_settings['header_title_font_style']) ? 'font-style:'.$graphene_settings['header_title_font_style'].';' : '';
	if ( $font_style ) { $style .= '.header_title { '.$font_style.' }'; }

	/* Header description text style */ 
	$font_style = '';
	$font_style .= ( $graphene_settings['header_desc_font_type']) ? 'font-family:'.$graphene_settings['header_desc_font_type'].';' : '';
	$font_style .= ( $graphene_settings['header_desc_font_size']) ? 'font-size:'.$graphene_settings['header_desc_font_size'].';' : '';
	$font_style .= ( $graphene_settings['header_desc_font_lineheight']) ? 'line-height:'.$graphene_settings['header_desc_font_lineheight'].';' : '';
	$font_style .= ( $graphene_settings['header_desc_font_weight']) ? 'font-weight:'.$graphene_settings['header_desc_font_weight'].';' : '';
	$font_style .= ( $graphene_settings['header_desc_font_style']) ? 'font-style:'.$graphene_settings['header_desc_font_style'].';' : '';
	if ( $font_style ) { $style .= '.header_desc { '.$font_style.' }'; }
	
	/* Content text style */ 
	$font_style = '';
	$font_style .= ( $graphene_settings['content_font_type']) ? 'font-family:'.$graphene_settings['content_font_type'].';' : '';
	$font_style .= ( $graphene_settings['content_font_size']) ? 'font-size:'.$graphene_settings['content_font_size'].';' : '';
	$font_style .= ( $graphene_settings['content_font_lineheight']) ? 'line-height:'.$graphene_settings['content_font_lineheight'].';' : '';
	$font_style .= ( $graphene_settings['content_font_colour'] != $graphene_defaults['content_font_colour']) ? 'color:'.$graphene_settings['content_font_colour'].';' : '';
	if ( $font_style ) { $style .= '.entry-content, .sidebar, .comment-entry { '.$font_style.' }'; }
	
    /* Adjust post title if author's avatar is shown */
	if ( $graphene_settings['show_post_avatar']) {
		$tmp_margin = !is_rtl() ? 'margin-right' : 'margin-left';
		$style .= '.post-title a, .post-title a:visited{display:block;'.$tmp_margin.':45px;padding-bottom:0;}';
	}
	
	/* Slider height */
	if ( $graphene_settings['slider_height']) {
		$style .= '.featured_slider #slider_root{height:'.$graphene_settings['slider_height'].'px;}';
	}
	
	/* Link header image */
	if ( $graphene_settings['link_header_img'] && (HEADER_IMAGE_WIDTH != 900 || HEADER_IMAGE_HEIGHT != 198) ) {
		$style .= '#header_img_link{width:'. HEADER_IMAGE_WIDTH .'px; height:'. HEADER_IMAGE_HEIGHT .'px;}';
	}
		
	// Link style
	if ( $graphene_settings['link_colour_normal'] != $graphene_defaults['link_colour_normal']) { $style.='a{color:'.$graphene_settings['link_colour_normal'].';}';}
	if ( $graphene_settings['link_colour_visited'] != $graphene_defaults['link_colour_visited']) { $style.='a:visited{color:'.$graphene_settings['link_colour_visited'].';}';}
	if ( $graphene_settings['link_colour_hover'] != $graphene_defaults['link_colour_hover']) { $style.='a:hover{color:'.$graphene_settings['link_colour_hover'].';}';}
	if ( $graphene_settings['link_decoration_normal']) { $style.='a{text-decoration:'.$graphene_settings['link_decoration_normal'].';}';}
	if ( $graphene_settings['link_decoration_hover']) { $style.='a:hover{text-decoration:'.$graphene_settings['link_decoration_hover'].';}';}
				
	return $style;
}

/**
 * Get the custom colour style attributes defined by the theme colour settings
 * 
 * @global type $graphene_settings
 * @global type $graphene_defaults
 * @return string 
 */
function graphene_get_custom_colours(){
	global $graphene_settings, $graphene_defaults;
    $style = '';
    
	if ( ! is_admin() || strstr( $_SERVER["REQUEST_URI"], 'page=graphene_options&tab=display' ) ) {

    	/* Customised colours */
		
		// Content area
		if ( $graphene_settings['bg_content_wrapper'] != $graphene_defaults['bg_content_wrapper']) {$style .= '#content, .menu-bottom-shadow{background-color:'.$graphene_settings['bg_content_wrapper'].';}';}
		if ( $graphene_settings['bg_content'] != $graphene_defaults['bg_content']) {$style .= '.post{background-color:'.$graphene_settings['bg_content'].';}';}
		if ( $graphene_settings['bg_meta_border'] != $graphene_defaults['bg_meta_border']) {$style .= '.post-title, .post-title a, .post-title a:visited, .entry-footer{border-color:'.$graphene_settings['bg_meta_border'].';}';}
		if ( $graphene_settings['bg_post_top_border'] != $graphene_defaults['bg_post_top_border']) {$style .= '.post{border-top-color:'.$graphene_settings['bg_post_top_border'].';}';}
		if ( $graphene_settings['bg_post_bottom_border'] != $graphene_defaults['bg_post_bottom_border']) {$style .= '.post{border-bottom-color:'.$graphene_settings['bg_post_bottom_border'].';}';}
		if ( $graphene_settings['bg_post_bottom_border'] != $graphene_defaults['bg_post_bottom_border']) {$style .= '.post{border-bottom-color:'.$graphene_settings['bg_post_bottom_border'].';}';}
		
		// Widgets
		if ( $graphene_settings['bg_widget_item'] != $graphene_defaults['bg_widget_item']) {$style .= '.sidebar div.sidebar-wrap{background-color:'.$graphene_settings['bg_widget_item'].';}';}
		if ( $graphene_settings['bg_widget_list'] != $graphene_defaults['bg_widget_list']) {$style .= '.sidebar ul li{border-color:'.$graphene_settings['bg_widget_list'].';}';}
		if ( $graphene_settings['bg_widget_header_border'] != $graphene_defaults['bg_widget_header_border']) {$style .= '.sidebar h3{border-color:'.$graphene_settings['bg_widget_header_border'].';}';}
		if ( $graphene_settings['bg_widget_title'] != $graphene_defaults['bg_widget_title']) {$style .= '.sidebar h3, .sidebar h3 a, .sidebar h3 a:visited{color:'.$graphene_settings['bg_widget_title'].';}';}
		if ( $graphene_settings['bg_widget_title_textshadow'] != $graphene_defaults['bg_widget_title_textshadow']) {$style .= '.sidebar h3{text-shadow: 0 -1px '.$graphene_settings['bg_widget_title_textshadow'].';}';}
		$grad_top = $graphene_settings['bg_widget_header_top'];
		$grad_bottom = $graphene_settings['bg_widget_header_bottom'];
		if ( $grad_bottom != $graphene_defaults['bg_widget_header_bottom'] || $grad_top != $graphene_defaults['bg_widget_header_top']) {$style .= '.sidebar h3{
				background: ' . $grad_top . ';
				background: -moz-linear-gradient( ' . $grad_top . ', ' . $grad_bottom . ' );
				background: -webkit-linear-gradient(top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: linear-gradient( ' . $grad_top . ', ' . $grad_bottom . ' );
		}';}
		
		// Slider
		$grad_top = $graphene_settings['bg_slider_top'];
		$grad_bottom = $graphene_settings['bg_slider_bottom'];
		if ( $grad_bottom != $graphene_defaults['bg_slider_bottom'] || $grad_top != $graphene_defaults['bg_slider_top']) {$style .= '.featured_slider {
				-pie-background: linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: ' . $grad_top . ';
				background: -moz-linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: -webkit-linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
		}';}
		
		// Block button
		$grad_top = $graphene_settings['bg_button'];
		$grad_bottom = graphene_hex_addition( $grad_top, -26);
		$grad_bottom_hover = graphene_hex_addition( $grad_top, -52);
		$font_color = $graphene_settings['bg_button_label'];
		$font_shadow = $graphene_settings['bg_button_label_textshadow'];
		if ( $grad_top != $graphene_defaults['bg_button']) {
			$style .= '.block-button, .block-button:visited, .Button {
							background: ' . $grad_top . ';
							background: -moz-linear-gradient( ' . $grad_top . ', ' . $grad_bottom . ' );
							background: -webkit-linear-gradient(top, ' . $grad_top . ', ' . $grad_bottom . ' );
							background: linear-gradient( ' . $grad_top . ', ' . $grad_bottom . ' );
							border-color: ' . $grad_bottom . ';
							text-shadow: 0 -1px 1px ' . $font_shadow . ';
							color: ' . $font_color . ';
						}';
			$style .= '.block-button:hover {
							background: ' . $grad_top . ';
							background: -moz-linear-gradient( ' . $grad_top . ', ' . $grad_bottom_hover . ' );
							background: -webkit-linear-gradient(top, ' . $grad_top . ', ' . $grad_bottom_hover . ' );
							background: linear-gradient( ' . $grad_top . ', ' . $grad_bottom_hover . ' );
							color: ' . $font_color . ';
						}';
		}
                
                // Archive
		$grad_top = $graphene_settings['bg_archive_left'];
		$grad_bottom = $graphene_settings['bg_archive_right'];
		if ( $grad_bottom != $graphene_defaults['bg_archive_left'] || $grad_top != $graphene_defaults['bg_archive_right']) {$style .= '.page-title {
				-pie-background: linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: ' . $grad_top . ';
				background: -moz-linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: -webkit-linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
		}';}
                if ( $graphene_settings['bg_archive_label'] != $graphene_defaults['bg_archive_label']) {$style .= '.page-title{color:'.$graphene_settings['bg_archive_label'].';}';}
                if ( $graphene_settings['bg_archive_label'] != $graphene_defaults['bg_archive_text']) {$style .= '.page-title span{color:'.$graphene_settings['bg_archive_text'].';}';}
		if ( $graphene_settings['bg_archive_textshadow'] != $graphene_defaults['bg_archive_textshadow']) {$style .= '.page-title{text-shadow: 0 -1px 0 '.$graphene_settings['bg_archive_textshadow'].';}';}
	}
	
	// Admin only
	if ( is_admin() && strstr( $_SERVER["REQUEST_URI"], 'page=graphene_options&tab=display' ) ) {
		
		// Widgets
		if ( $graphene_settings['content_font_colour'] != $graphene_defaults['content_font_colour']) {$style .= '.graphene, .graphene li, .graphene p{color:'.$graphene_settings['content_font_colour'].';}';}
		if ( $graphene_settings['link_colour_normal'] != $graphene_defaults['link_colour_normal']) {$style .= '.graphene a{color:'.$graphene_settings['link_colour_normal'].';}';}
		if ( $graphene_settings['link_colour_visited'] != $graphene_defaults['link_colour_visited']) {$style .= '.graphene a:visited{color:'.$graphene_settings['link_colour_visited'].';}';}
		if ( $graphene_settings['link_colour_hover'] != $graphene_defaults['link_colour_hover']) {$style .= '.graphene a:hover{color:'.$graphene_settings['link_colour_hover'].';}';}
		
		// Slider
		$grad_bottom = $graphene_settings['bg_slider_bottom'];
		$grad_top = $graphene_settings['bg_slider_top'];
		if ( $grad_bottom != $graphene_defaults['bg_slider_bottom'] || $grad_top != $graphene_defaults['bg_slider_top']) {$style .= '#grad-box {
				-pie-background: linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: ' . $grad_top . ';
				background: linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: -moz-linear-gradient(left top, ' . $grad_top . ', ' . $grad_bottom . ' );
				background: -webkit-gradient(linear, left top, right bottom, from( ' . $grad_top . ' ), to( ' . $grad_bottom . ' ) );
                            }';
                }
	}
        
    return $style;
}

/**
 * Sets the various customised styling according to the options set for the theme.
 *
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.0.8
*/
function graphene_custom_style(){
    global $graphene_settings;
	$style = '';
    
    // the custom colours are needed in both the display and admin mode
    $style .= graphene_get_custom_colours();
    
	// only get the custom css styles when were not in the admin mode
    if ( ! is_admin() ) {
        $style .= graphene_get_custom_style();
		
		// always the custom css at the end, this is the most important
	    if ( $graphene_settings['custom_css']) { $style .= $graphene_settings['custom_css']; }
    }
	    
    if ( $style ){ echo '<style type="text/css">'."\n".$style."\n".'</style>'."\n"; }
    do_action( 'graphene_custom_style' ); 
}
add_action( 'wp_head', 'graphene_custom_style' );
add_action( 'admin_head', 'graphene_custom_style' );



/**
 * Convert a hex decimal color code to its RGB equivalent and vice versa
 */                                                                                                
function graphene_rgb2hex( $c){
   if(!$c) return false;
   $c = trim( $c);
   $out = false;
  if(preg_match("/^[0-9ABCDEFabcdef\#]+$/i", $c) ){
      $c = str_replace( '#','', $c);
      $l = strlen( $c) == 3 ? 1 : (strlen( $c) == 6 ? 2 : false);

      if( $l){
         unset( $out);
         $out['red'] = hexdec(substr( $c, 0,1*$l) );
         $out['green'] = hexdec(substr( $c, 1*$l,1*$l) );
         $out['blue'] = hexdec(substr( $c, 2*$l,1*$l) );
      }else $out = false;
             
   }elseif (preg_match("/^[0-9]+(,| |.)+[0-9]+(,| |.)+[0-9]+$/i", $c) ){
      $spr = str_replace(array( ',',' ','.' ), ':', $c);
      $e = explode(":", $spr);
      if(count( $e) != 3) return false;
         $out = '#';
         for( $i = 0; $i<3; $i++)
            $e[$i] = dechex( ( $e[$i] <= 0)?0:( ( $e[$i] >= 255)?255:$e[$i]) );
             
         for( $i = 0; $i<3; $i++)
            $out .= ( (strlen( $e[$i]) < 2)?'0':'' ).$e[$i];
                 
         $out = strtoupper( $out);
   }else $out = false;
         
   return $out;
}



/**
 * Perform adding (or subtracting) operation on a hexadecimal colour code
*/
function graphene_hex_addition( $hex, $num){
	$rgb = graphene_rgb2hex( $hex);
	foreach ( $rgb as $key => $val) {
		$rgb[$key] += $num;
		$rgb[$key] = ( $rgb[$key] < 0) ? 0 : $rgb[$key];
	}
	$hex = graphene_rgb2hex(implode( ',', $rgb) );
	
	return $hex;
}


/**
 * Register and print the stylesheet for alternate lighter header, if enabled in the options
 *
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.0.8
*/
if ( $graphene_settings['light_header']) :
	function graphene_lightheader_style(){
		wp_register_style( 'graphene-light-header', get_template_directory_uri().'/style-light.css' );
		wp_enqueue_style( 'graphene-light-header' );
		
		do_action( 'graphene_light_header' );
		}
	add_action( 'wp_print_styles', 'graphene_lightheader_style' );
endif;


/**
 * Check to see if there's a favicon.ico in wordpress root directory and add
 * appropriate head element for the favicon
*/
function graphene_favicon(){
	global $graphene_settings;
	if ( $graphene_settings['favicon_url']) { ?>
		<link rel="icon" href="<?php echo $graphene_settings['favicon_url']; ?>" type="image/x-icon" />
	<?php
    } elseif (is_file(ABSPATH.'favicon.ico' ) ){ ?>
		<link rel="icon" href="<?php echo home_url(); ?>/favicon.ico" type="image/x-icon" />
	<?php }
}
add_action( 'wp_head', 'graphene_favicon' );



/**
 * Defines the custom walker that adds description to the display of our Header Menu
*/
class Graphene_Description_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth, $args)       {
		global $wp_query;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
		
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		$prepend = '<strong>';
		$append = '</strong>';
		
		// Don't show description if it's longer than the length
		$desc_length = apply_filters( 'graphene_menu_desc_length', 50 );
		
		if ( strlen( $item->description ) > $desc_length)
			$description = '';
		else
			$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
		
		if ( $depth != 0 )	{
				 $description = $append = $prepend = "";
		}
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
}


/**
 * Define the callback menu, if there is no custom menu.
 * This menu automatically lists all Pages as menu items, including their direct
 * direct descendant, which will only be displayed for the current parent.
*/
if (!function_exists( 'graphene_default_menu' ) ) :

	function graphene_default_menu(){ global $graphene_settings; ?>
    
		<ul id="header-menu" class="menu clearfix default-menu">
            <?php if (get_option( 'show_on_front' ) == 'posts' ) : ?>
            <li <?php if ( is_single() || is_front_page() ) { echo 'class="current_page_item current-menu-item"'; } ?>>
            	<a href="<?php echo get_home_url(); ?>">
                	<strong><?php _e( 'Home','graphene' ); ?></strong>
                    <?php if ( $graphene_settings['navmenu_home_desc']) {echo '<span>'.$graphene_settings['navmenu_home_desc'].'</span>';} ?>
                </a>
            </li>
            <?php endif; ?>
            <?php 
				$args = array( 
							'echo' => 1,
							'depth' => 5,
							'title_li' => '',
                            'walker' => new Walker_PageDescription() );
			wp_list_pages(apply_filters( 'graphene_default_menu_args', $args) ); 
			?>
        </ul>
<?php
	do_action( 'graphene_default_menu' );
	} 
	
endif;

class Walker_PageDescription extends Walker_Page {
    
    /**
     * Code exact copied from: wp-includes\post-template.pgp >> Walker_Page::start_el() 
     * @since 2.1.0
     */
    function start_el(&$output, $page, $depth, $args, $current_page) {
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';
        extract( $args, EXTR_SKIP);
        $css_class = array( 'page_item', 'page-item-'.$page->ID);
		if ( !empty( $current_page) ) {
			$_current_page = get_page( $current_page );
			_get_post_ancestors( $_current_page);
			if ( isset( $_current_page->ancestors) && in_array( $page->ID, (array) $_current_page->ancestors) ) {
				$css_class[] = 'current_page_ancestor';
				$css_class[] = 'current-menu-ancestor';
			}
			if ( $page->ID == $current_page ) {
				$css_class[] = 'current_page_item';
				$css_class[] = 'current-menu-item';
			}
			elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
				$css_class[] = 'current_page_parent';
				$css_class[] = 'current-menu-ancestor';
				$css_class[] = 'current-menu-parent';
			}
		} elseif ( $page->ID == get_option( 'page_for_posts' ) ) {
			$css_class[] = 'current_page_parent';
			$css_class[] = 'current-menu-ancestor';
			$css_class[] = 'current-menu-parent';
		}
		
		// Check if page has children
		if ( get_pages( array( 'child_of' => $page->ID, 'parent' => $page->ID ) ) ) {
			$css_class[] = 'menu-item-ancestor';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page) );
                
		$title = apply_filters( 'the_title', $page->post_title, $page->ID );
		
		// get the graphene description if it is set otherwise the wordpress default -> title
		$menu_title = apply_filters( 'the_title', $page->post_title, $page->ID );
		if ( ! $depth ){
			$menu_title = '<strong>' . $menu_title . '</strong>';
		}
		$menu_title .= ( get_post_meta( $page->ID, '_graphene_nav_description', true ) && ! $depth ) ? 
						'<span>' . get_post_meta( $page->ID, '_graphene_nav_description', true ) . '</span>' : 
						'';
                
		$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_permalink( $page->ID) . '">' . $link_before . $menu_title . $link_after . '</a>';

		if ( !empty( $show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;

			$output .= " " . mysql2date( $date_format, $time);
		}
    }
}

/**
 * Defines the callback function for use with wp_list_comments(). This function controls
 * how comments are displayed.
*/

if (!function_exists( 'graphene_comment' ) ) :

	function graphene_comment( $comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'clearfix' ); ?>>
				<?php do_action( 'graphene_before_comment' ); ?>
                
                <?php /* Added support for comment numbering using Greg's Threaded Comment Numbering plugin */ ?>
                <?php if (function_exists( 'gtcn_comment_numbering' ) ) {gtcn_comment_numbering( $comment->comment_ID, $args);} ?>
                
				<?php echo get_avatar( $comment, apply_filters( 'graphene_gravatar_size', 40) ); ?>
                <?php do_action( 'graphene_comment_gravatar' ); ?>
                
					<div class="comment-wrap clearfix">
						<h5>
                        	<cite><?php comment_author_link(); ?></cite> <?php _e( 'says:','graphene' ); ?>
                        <?php do_action( 'graphene_comment_author' ); ?>
                        </h5>
						<div class="comment-meta">
							<p class="commentmetadata">
                            	<?php /* translators: %1$s is the comment date, %2$s is the comment time */ ?>
								<?php printf(__( '%1$s at %2$s', 'graphene' ), get_comment_date(), get_comment_time() ); ?>
								<span class="timezone"><?php echo '(UTC '.get_option( 'gmt_offset' ).' )'; ?></span>
								<?php edit_comment_link(__( 'Edit comment','graphene' ),' | ','' ); ?>
                            	<?php do_action( 'graphene_comment_metadata' ); ?>    
                            </p>
							<p class="comment-reply-link">
								<?php comment_reply_link(array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __( 'Reply', 'graphene' ) )); ?>
                            
                            	<?php do_action( 'graphene_comment_replylink' ); ?>
                            </p>
                            
							<?php do_action( 'graphene_comment_meta' ); ?>
						</div>
						<div class="comment-entry">
                        	<?php do_action( 'graphene_before_commententry' ); ?>
                            
							<?php if ( $comment->comment_approved == '0' ) : ?>
							   <p><em><?php _e( 'Your comment is awaiting moderation.', 'graphene' ) ?></em></p>
                               <?php do_action( 'graphene_comment_moderation' ); ?>
							<?php else : ?>
								<?php comment_text(); ?>
                            <?php endif; ?>
                            
                            <?php do_action( 'graphene_after_commententry' ); ?>
						</div>
					</div>
                
                <?php do_action( 'graphene_after_comment' ); ?>
	<?php

	}

endif;


		
/**
 * Function to display ads from adsense
*/
$adsense_adcount = 1;
$ad_limit = apply_filters( 'graphene_adsense_ads_limit', 3);
if (!function_exists( 'graphene_adsense' ) ) :
	function graphene_adsense(){
		global $adsense_adcount, $ad_limit, $graphene_settings;
		
		if ( $graphene_settings['show_adsense'] && $adsense_adcount <= $ad_limit) : ?>
            <div class="post adsense_single" id="adsense-ad-<?php echo $adsense_adcount; ?>">
                <?php echo stripslashes( $graphene_settings['adsense_code']); ?>
            </div>
            <?php do_action( 'graphene_show_adsense' ); ?>
		<?php endif;
		
		$adsense_adcount++;
		
		do_action( 'graphene_adsense' );
	}
endif;


/**
 * Function to display the AddThis social sharing button
*/

if (!function_exists( 'graphene_addthis' ) ) :
	function graphene_addthis( $post_id){
		global $graphene_settings;
		
		// Get the local setting
		$show_addthis_local = (get_post_meta( $post_id, '_graphene_show_addthis', true) ) ? get_post_meta( $post_id, '_graphene_show_addthis', true) : 'global';
		$show_addthis_global = $graphene_settings['show_addthis'];
		$show_addthis_page = $graphene_settings['show_addthis_page'];
		
		// Determine whether we should show AddThis or not
		if ( $show_addthis_local == 'show' )
			$show_addthis = true;
		elseif ( $show_addthis_local == 'hide' )
			$show_addthis = false;
		elseif ( $show_addthis_local == 'global' ){
			if ( ( $show_addthis_global && !is_page() ) || ( $show_addthis_global && $show_addthis_page) )
				$show_addthis = true;
			else
				$show_addthis = false;
		}
		
		// Show the AddThis button
		if ( $show_addthis) {
			echo '<div class="add-this-right">';
			$html = stripslashes( $graphene_settings['addthis_code']);
			$html = str_replace( '[#post-url]', get_permalink( $post_id), $html);
			$html = str_replace( '[#post-title]', get_the_title( $post_id), $html);
			echo $html;
			echo '</div>';
			
			do_action( 'graphene_show_addthis' );
		}
		do_action( 'graphene_addthis' );
	}
endif;


/**
 * Register widgetized areas
 *
 * To override graphene_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Graphene 1.0
 * @uses register_sidebar
 */
function graphene_widgets_init() {
	if (function_exists( 'register_sidebar' ) ) {
		global $graphene_settings;
		
		register_sidebar(array( 'name' => __( 'Sidebar Widget Area', 'graphene' ),
			'id' => 'sidebar-widget-area',
			'description' => __( 'The first sidebar widget area (available in two and three column layouts).', 'graphene' ),
			'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => "<h3>",
			'after_title' => "</h3>",
		) );
                
		register_sidebar(array( 'name' => __( 'Sidebar Two Widget Area', 'graphene' ),
			'id' => 'sidebar-two-widget-area',
			'description' => __( 'The second sidebar widget area (only available in three column layouts).', 'graphene' ),
			'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => "<h3>",
			'after_title' => "</h3>",
		) );
		
		register_sidebar(array( 'name' => __( 'Footer Widget Area', 'graphene' ),
			'id' => 'footer-widget-area',
			'description' => __( "The footer widget area. Leave empty to disable. Set the number of columns to display at the theme's Display Options page.", 'graphene' ),
			'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => "<h3>",
			'after_title' => "</h3>",
		) );
		
		/**
		 * Register alternate widget areas to be displayed on the front page, if enabled
		 *
		 * @package WordPress
		 * @subpackage Graphene
		 * @since Graphene 1.0.8
		*/
		if ( $graphene_settings['alt_home_sidebar']) {
			register_sidebar(array( 'name' => __( 'Front Page Sidebar Widget Area', 'graphene' ),
				'id' => 'home-sidebar-widget-area',
				'description' => __( 'The first sidebar widget area that will only be displayed on the front page.', 'graphene' ),
				'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => "<h3>",
				'after_title' => "</h3>",
			) );
			
			register_sidebar(array( 'name' => __( 'Front Page Sidebar Two Widget Area', 'graphene' ),
				'id' => 'home-sidebar-two-widget-area',
				'description' => __( 'The second sidebar widget area that will only be displayed on the front page.', 'graphene' ),
				'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => "<h3>",
				'after_title' => "</h3>",
			) );
		}
		
		if ( $graphene_settings['alt_home_footerwidget']) {
			register_sidebar(array( 'name' => __( 'Front Page Footer Widget Area', 'graphene' ),
				'id' => 'home-footer-widget-area',
				'description' => __( "The footer widget area that will only be displayed on the front page. Leave empty to disable. Set the number of columns to display at the theme's Display Options page.", 'graphene' ),
				'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => "<h3>",
				'after_title' => "</h3>",
			) );
		}
		
		/* Header widget area */
		if ( $graphene_settings['enable_header_widget']) :
			register_sidebar(array( 'name' => __( 'Header Widget Area', 'graphene' ),
				'id' => 'header-widget-area',
				'description' => __("The header widget area.", 'graphene' ),
				'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => "<h3>",
				'after_title' => "</h3>",
			) );
		endif;
                
		/* Action hooks widget areas */
		if ( count( $graphene_settings['widget_hooks'] ) > 0 ) {
			$available_hooks = graphene_get_action_hooks( true );
			
			foreach ($graphene_settings['widget_hooks'] as $hook) {
				if (in_array($hook, $available_hooks)) {
					register_sidebar(array(
						'name' => ucwords( str_replace('_', ' ', $hook) ),
						'id' => $hook,
						'description' => sprintf( __("Dynamically added widget area. This widget area is attached to the %s action hook.", 'graphene'), "'$hook'" ),
						'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
						'after_widget' => '</div>',
						'before_title' => "<h3>",
						'after_title' => "</h3>",
					));
					// to display the widget dynamically attach the dynamic method
					add_action( $hook, 'graphene_display_dynamic_widget_hooks' );
				}
				
			}                    
		}
	}
	
	do_action( 'graphene_widgets_init' );
	do_action( 'graphene_widgets_init' );
}
/** Register sidebars by running graphene_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'graphene_widgets_init' );

/**
 * Gets all action hooks available in the Graphene theme.
 * @param boolean $hooksonly
 * @return array 
 */
function graphene_get_action_hooks( $hooksonly = false ) {    

	/* Delete transients. For dev purposes only, to force action hooks scan everytime. */
	// delete_transient( 'graphene-action-hooks-list' );
	// delete_transient( 'graphene-action-hooks' );
	
	// Get the cached action hooks list, if available
	if ( $hooksonly )
		$hooks = get_transient( 'graphene-action-hooks-list' );
	else
		$hooks = get_transient( 'graphene-action-hooks' );
		
	if ( $hooks ) 
		return $hooks;
	else
		$hooks = array();
	
    // as all the hooks are defined in php files get a list of the themes php files
    $files = @glob(get_template_directory() . "/*.php");

    if ($files !== false) {
        foreach ($files as $file) {

            // read the file and scan it's contents for do_action();
            $content = file( $file );
			$content = implode( '', $content );
			
            if ($content !== false) {
                if (preg_match_all("/do_action\([ ]*'(graphene_[^']*)'[ ]*\)/", $content, $matches) > 0) {
					$matches = array_unique( $matches[1] );
                    if ( $hooksonly ){ $hooks = array_merge( $hooks, $matches ); }
                    else { $hooks[] = array( 'file' => basename( $file ), 'hooks' => $matches ); }                    
                }                                
            }
        }
    }
	
	// Cache the found action hooks as WordPress transients
	if ( $hooksonly )
		set_transient( 'graphene-action-hooks-list', $hooks, 60*60*24 );
	else
		set_transient( 'graphene-action-hooks', $hooks, 60*60*24 );
		
    return $hooks;
} // Closes the graphene_get_action_hooks() function definition


/**
 * Display a dynamic widget area, this is hooked to the user selected do_action() hooks available in Graphene.
 * @global array $graphene_settings 
 */
function graphene_display_dynamic_widget_hooks(){
    global $graphene_settings;
    // to find the current action
    $actionhook_id = current_filter();
    if ( in_array($actionhook_id, $graphene_settings['widget_hooks']) && is_active_sidebar($actionhook_id) ) : ?>
    <div class="graphene-dynamic-widget" id="graphene-dynamic-widget-<?php echo $actionhook_id; ?>">
        <?php dynamic_sidebar( $actionhook_id ); ?>
    </div>
    <?php endif;
}

/**
 * Register custom Twitter widgets.
*/
global $twitter_username;
global $twitter_tweetcount;
$twitter_username = '';
$twitter_tweetcount = 1;

class Graphene_Widget_Twitter extends WP_Widget{
	
	function Graphene_Widget_Twitter(){
		// Widget settings
		$widget_ops = array( 'classname' => 'graphene-twitter', 'description' => __( 'Display the latest Twitter status updates.', 'graphene' ) );
		
		// Widget control settings
		$control_ops = array( 'id_base' => 'graphene-twitter' );
		
		// Create the widget
		$this->WP_Widget( 'graphene-twitter', 'Graphene Twitter', $widget_ops, $control_ops);
		
		/* Enqueue the twitter script if widget is active */
		if ( is_active_widget( false, false, $this->id_base, true ) )
			wp_enqueue_script( 'graphene-twitter', get_template_directory_uri() . '/js/twitter.js', array(), '', false );
	}
	
	function widget( $args, $instance){		// This function displays the widget
		extract( $args);
		
		// User selected settings
		global $twitter_username;
		global $twitter_tweetcount;
		global $twitter_followercount;
		global $graphene_twitter_newwindow;
		$twitter_title = $instance['twitter_title'];
		$twitter_username = $instance['twitter_username'];
		$twitter_tweetcount = $instance['twitter_tweetcount'];
		$twitter_followercount = $instance['twitter_followercount'];
		$new_window = $instance['new_window'];
		$graphene_twitter_newwindow = $new_window;
		$wrapper_id = 'tweet-wrap-' . $args['widget_id'];
		
		echo $args['before_widget'].$args['before_title'].$twitter_title.$args['after_title'];
		?>
        	<ul id="<?php echo $wrapper_id; ?>">
            	<li><img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" width="16" height="16" alt="" /> <?php _e( 'Loading tweets...', 'graphene' ); ?></li>
            </ul>
            <p id="tweetfollow">
                <?php if ( $twitter_followercount ) : ?><span id="#follower-count-<?php echo $wrapper_id; ?>"></span><?php endif; ?>
                <a <?php if ( $new_window ) { echo 'target="_blank"'; } ?> href="http://twitter.com/#!/<?php echo $twitter_username; ?>"><?php _e( 'Follow me on Twitter', 'graphene' ) ?></a>
            </p>
            
            <script src="http://api.twitter.com/1/statuses/user_timeline.json?screen_name=<?php echo $twitter_username; ?>&count=<?php echo $twitter_tweetcount; ?>&page=1&include_rts=true&include_entities=true&callback=grapheneGetTweet" type="text/javascript"></script>
            <script type="text/javascript">				
				grapheneTwitter( '<?php echo $wrapper_id; ?>', 
									{
										id: '<?php echo $twitter_username; ?>',
										count: <?php echo $twitter_tweetcount; ?>,
										<?php if ( $new_window ) echo 'newwindow: true,' ?>
										<?php if ( $twitter_followercount ) : ?>
										followercount: true,
										followersingle: '<?php _e( 'follower', 'graphene' ); ?>',
										followerplural: '<?php _e( 'followers', 'graphene' ); ?>',
										<?php endif; ?>
										
									});
			</script>
            
            <?php do_action( 'graphene_twitter_widget' ); ?>
        <?php echo $args['after_widget']; ?>
        
        <?php
		// add_action( 'wp_footer', 'graphene_add_twitter_script' );
	}
	
	function update( $new_instance, $old_instance){	// This function processes and updates the settings
		$instance = $old_instance;
		
		// Strip tags (if needed) and update the widget settings
		$instance['twitter_username'] = strip_tags( $new_instance['twitter_username']);
		$instance['twitter_tweetcount'] = strip_tags( $new_instance['twitter_tweetcount']);
		$instance['twitter_title'] = strip_tags( $new_instance['twitter_title']);
		$instance['twitter_followercount'] = ( isset( $new_instance['twitter_followercount'] ) ) ? true : false ;
		$instance['new_window'] = ( isset( $new_instance['new_window'] ) ) ? true : false ;
		
		return $instance;
	}
	
	function form( $instance ){		// This function sets up the settings form
		
		// Set up default widget settings
		$defaults = array( 
						'twitter_username' => 'username',
						'twitter_tweetcount' => 5,
						'twitter_title' => __( 'Latest tweets', 'graphene' ),
						'twitter_followercount' => false,
						'new_window' => false,
						);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
        <p>
        	<label for="<?php echo $this->get_field_id( 'twitter_title' ); ?>"><?php _e( 'Title:', 'graphene' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'twitter_title' ); ?>" value="<?php echo $instance['twitter_title']; ?>" class="widefat" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php _e( 'Twitter Username:', 'graphene' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" type="text" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php echo $instance['twitter_username']; ?>" class="widefat" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id( 'twitter_tweetcount' ); ?>"><?php _e( 'Number of tweets to display:', 'graphene' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_tweetcount' ); ?>" type="text" name="<?php echo $this->get_field_name( 'twitter_tweetcount' ); ?>" value="<?php echo $instance['twitter_tweetcount']; ?>" size="1" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id( 'twitter_followercount' ); ?>"><?php _e( 'Show followers count', 'graphene' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_followercount' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'twitter_followercount' ); ?>" value="true" <?php checked( $instance['twitter_followercount'] ); ?> />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in new window', 'graphene' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php checked( $instance['new_window'] ); ?> />
        </p>
        <?php
	}
}

/* The function that prints the Twitter script to the footer */
if (!function_exists( 'graphene_add_twitter_script' ) ) :
	function graphene_add_twitter_script(){
		global $twitter_username;
		global $twitter_tweetcount;
		echo '<!-- BEGIN Twitter Updates script -->';
		// include_once( 'js/twitter.js' );
		?>
        <script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline.json?screen_name=<?php echo $twitter_username; ?>&count=<?php echo $twitter_tweetcount; ?>&page=1&include_rts=true&include_entities=true&callback=twitterCallback2"></script>
		<?php
		echo '<!-- END Twitter Updates script -->';
	}
endif;


/**
 * Register the custom widget by passing the graphene_load_widgets() function to widgets_init
 * action hook.
 * To override in a child theme, remove the action hook and add your own
*/ 
function graphene_load_widgets(){
	register_widget( 'Graphene_Widget_Twitter' );
}
add_action( 'widgets_init', 'graphene_load_widgets' );


/**
 * Enqueue style for admin page
*/
if (!function_exists( 'graphene_admin_options_style' ) ) :
	function graphene_admin_options_style() {
		wp_enqueue_style( 'graphene-admin-style' );
		if (is_rtl() ) {wp_enqueue_style( 'graphene-admin-style-rtl' );}
	}
endif;


/** 
 * Adds the theme options page
*/
function graphene_options_init() {
	$graphene_options = add_theme_page(__( 'Graphene Options', 'graphene' ), __( 'Graphene Options', 'graphene' ), 'edit_theme_options', 'graphene_options', 'graphene_options' );
	$graphene_faq = add_theme_page(__( 'Graphene FAQs', 'graphene' ), __( 'Graphene FAQs', 'graphene' ), 'edit_theme_options', 'graphene_faq', 'graphene_faq' );
	
	wp_register_style( 'graphene-admin-style', get_template_directory_uri().'/admin/admin.css' );
	if (is_rtl() ) {wp_register_style( 'graphene-admin-style-rtl', get_template_directory_uri().'/admin/admin-rtl.css' );}
	
	add_action( 'admin_print_styles-'.$graphene_options, 'graphene_admin_options_style' );
	
	do_action( 'graphene_options_init' );
}
add_action( 'admin_menu', 'graphene_options_init', 8);

// Includes the files where our theme options are defined
include( 'admin/options.php' );
include( 'admin/faq.php' );


/**
 * Function that generate the tabs in the theme's options page
*/
if (!function_exists( 'graphene_options_tabs' ) ) :
	function graphene_options_tabs( $current = 'general', $tabs = array( 'general' => 'General' ) ){
		$links = array();
		foreach( $tabs as $tab => $name) :
			if ( $tab == $current ) :
				$links[] = "<a class='nav-tab nav-tab-active' href='?page=graphene_options&amp;tab=$tab'>$name</a>";
			else :
				$links[] = "<a class='nav-tab' href='?page=graphene_options&amp;tab=$tab'>$name</a>";
			endif;
		endforeach;
		
		echo '<h3 class="options-tab">';
		foreach ( $links as $link)
			echo $link;
		echo '<a class="toggle-all" href="#">'.__( 'Toggle all tabs', 'graphene' ).'</a>';
		echo '</h3>';
	}
endif;


/**
 * Include the file for additional user fields
 * 
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.1
*/
include( 'admin/user.php' );

/**
 * Include the file for additional custom fields in posts and pages editing screens
 * 
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.1
*/
include( 'admin/custom-fields.php' );



/**
 * Customise the comment form
*/

// Starting with the default fields
function graphene_comment_form_fields(){
	$fields =  array( 'author' => '<p class="comment-form-author clearfix"><label for="author" class="graphene_form_label">'.__( 'Name:','graphene' ).'</label><input id="author" name="author" type="text" class="graphene-form-field" /></p>',
		'email'  => '<p class="comment-form-email clearfix"><label for="email" class="graphene_form_label">' . __( 'Email:','graphene' ).'</label><input id="email" name="email" type="text" class="graphene-form-field" /></p>',
		'url'    => '<p class="comment-form-url clearfix"><label for="url" class="graphene_form_label">'.__( 'Website:','graphene' ).'</label><input id="url" name="url" type="text" class="graphene-form-field" /></p>',
	);
	
	$fields = apply_filters( 'graphene_comment_form_fields', $fields );
	
	return $fields;
}

// The comment field textarea
function graphene_comment_textarea(){
	echo '<p class="clearfix"><label class="graphene_form_label">'.__( 'Message:','graphene' ).'</label><textarea name="comment" id="comment" cols="40" rows="10" class="graphene-form-field"></textarea></p><div class="graphene_wrap">';
	
	do_action( 'graphene_comment_textarea' );
}

// The submit button
function graphene_comment_submit_button(){
	echo '<p class="graphene-form-submit"><button type="submit" id="graphene_submit" class="block-button" name="graphene_submit">'.__( 'Submit Comment', 'graphene' ).'</button></p></div>';
	
	do_action( 'graphene_comment_submit_button' );
	}

// Add all the filters we defined
add_filter( 'comment_form_default_fields', 'graphene_comment_form_fields' );
add_filter( 'comment_form_field_comment', 'graphene_comment_textarea' );
add_filter( 'comment_form', 'graphene_comment_submit_button' );


/**
 * Returns a "Continue Reading" link for excerpts
 * Based on the function from the Twenty Ten theme
 *
 * @since Graphene 1.0.8
 * @return string "Continue Reading" link
 */
if (!function_exists( 'graphene_continue_reading_link' ) ) :
	function graphene_continue_reading_link() {
		global $in_slider;
		if (!is_page() && !$in_slider) {
			$more_link_text = __( 'Continue reading &raquo;', 'graphene' );
			return '</p><p><a class="more-link block-button" href="'.get_permalink().'">'.$more_link_text.'</a>';
		}
	}
endif;


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and graphene_continue_reading_link().
 * Based on the function from Twenty Ten theme.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Graphene 1.0.8
 * @return string An ellipsis
 */
function graphene_auto_excerpt_more( $more) {
	return apply_filters( 'graphene_auto_excerpt_more', ' &hellip; '.graphene_continue_reading_link() );
}
add_filter( 'excerpt_more', 'graphene_auto_excerpt_more' );


/**
 * Add the Read More link to manual excerpts
 *
 * @since Graphene 1.1.3
*/
function graphene_manual_excerpt_more( $text){
	global $in_slider;
	if (has_excerpt() && !$in_slider){
		$text = explode( '</p>', $text);
		$text[count( $text)-2] .= graphene_continue_reading_link();
		$text = implode( '</p>', $text);
	}
	return $text;
}
if ( $graphene_settings['show_excerpt_more']) {
	add_filter( 'the_excerpt', 'graphene_manual_excerpt_more' );
}


/**
 * Generates the posts navigation links
*/
if (!function_exists( 'graphene_posts_nav' ) ) :
	function graphene_posts_nav(){ 
		$query = $GLOBALS['wp_query'];
		if ( $query->max_num_pages > 1) : ?>
            <div class="post-nav clearfix">
            <?php if (function_exists( 'wp_pagenavi' ) ) : wp_pagenavi(); else : ?>
                <?php if (!is_search() ) : ?>
                    <p id="previous"><?php next_posts_link(__( 'Older posts &laquo;', 'graphene' ) ) ?></p>
                    <p id="next-post"><?php previous_posts_link(__( '&raquo; Newer posts', 'graphene' ) ) ?></p>
                <?php else : ?>
                    <p id="next-post"><?php next_posts_link(__( 'Next page &raquo;', 'graphene' ) ) ?></p>
                    <p id="previous"><?php previous_posts_link(__( '&laquo; Previous page', 'graphene' ) ) ?></p>
                <?php endif; ?>
            <?php endif; do_action( 'graphene_posts_nav' ); ?>
            </div>
	<?php
		endif;
	}
endif;


/**
 * Prints out the scripts required for the featured posts slider
*/

/* jQuery Scrollable */ 
if (!function_exists( 'graphene_scrollable' ) ) :
	function graphene_scrollable() { 
		global $graphene_settings;
		
		$interval = ( $graphene_settings['slider_speed']) ? $graphene_settings['slider_speed'] : 7000;
                $speed = $graphene_settings['slider_trans_speed'];
		?>
            <!-- Scrollable -->
            <script type="text/javascript">
				//<![CDATA[
                jQuery(document).ready(function($){
					
					<?php if ( $graphene_settings['slider_animation'] == 'horizontal-slide' ) : ?>
						$("#slider_root")
										.scrollable({
											circular: true,
											clickable: false,
											speed: <?php echo $speed; ?>
										})
										.navigator({	  
											navi: ".slider_nav",
											naviItem: 'a',
											activeClass: 'active'                                                               
										})
										.autoscroll({
											interval: <?php echo $interval; ?>,
											steps: 1, 
											api: 'true'
										});
						$.graphene_slider = $("#slider_root").data("scrollable");
						
					<?php else : 
							if ( $graphene_settings['slider_animation'] == 'vertical-slide' )
								$effect = 'slide';
							if ( $graphene_settings['slider_animation'] == 'fade' )
								$effect = 'fade';
							if ( $graphene_settings['slider_animation'] == 'none' )
								$effect = 'default';
					?>
					
						$( ".slider_nav" )
											.tabs( ".slider_items > .slider_post", {
												effect: '<?php echo $effect; ?>',
												fadeOutSpeed: <?php echo $speed; ?>,
												fadeInSpeed: <?php echo $speed; ?>,
												rotate: true,
												current: 'active'
											})
											.slideshow({
												autoplay: true,
												clickable: false,
												interval: <?php echo $interval; ?>,
												api: true
											});
						$.graphene_slider = $(".slider_nav").data("tabs");
					<?php endif; ?>
					
					<?php do_action( 'graphene_scrollable_script' ); ?>
                });
				//]]>
            </script>
            <!-- #Scrollable -->
		<?php 
	}
endif;


/**
 * Control the excerpt length
*/
function graphene_excerpt_length( $length) {
	global $graphene_settings;
	$column_mode = graphene_column_mode();
	if ( $graphene_settings['slider_display_style'] == 'bgimage-excerpt' ){
		if (strpos( $column_mode, 'three-col' ) === 0)
			return 24;
		if (strpos( $column_mode, 'two-col' ) === 0)
			return 40;
		if ( $column_mode == 'one-column' )
			return 55;
	}
	
	return 55;
}
add_filter( 'excerpt_length', 'graphene_excerpt_length' );



/**
 * Creates the functions that output the slider
*/
function graphene_slider(){
	global $graphene_settings, $in_slider;
	
	$in_slider = true;
	
	do_action( 'graphene_before_slider' ); ?>
    <?php 
		$class = ( $graphene_settings['slider_display_style'] == 'bgimage-excerpt' ) ? ' full-sized' : '';
		$class .= ' ' . $graphene_settings['slider_animation'];
	?>
    <div class="featured_slider<?php echo $class; ?>">
	    <?php do_action( 'graphene_before_slider_root' ); ?>
        <div id="slider_root">
       		<?php do_action( 'graphene_before_slideritems' ); ?>
	        <div class="slider_items">
    <?php        
        /**
         * Get the category whose posts should be displayed here. If no 
         * category is defined, the 5 latest posts will be displayed
        */
        $slidertype = ($graphene_settings['slider_type'] != '') ? $graphene_settings['slider_type'] : false;
        
		/* Set the post types to be displayed */
		$slider_post_type = ($slidertype == 'posts_pages') ? array('post', 'page') : array('post') ;
		$slider_post_type = apply_filters('graphene_slider_post_type', $slider_post_type);
		
        /* Get the posts to display in the slider */					
			
		// Get the number of posts to show
		$postcount = ( $graphene_settings['slider_postcount']) ? $graphene_settings['slider_postcount'] : 5 ;
			
		$args = array( 
					'posts_per_page'	=> $postcount,
					'orderby' 			=> 'date',
					'order' 			=> 'DESC',
					'suppress_filters' 	=> 0,
					'post_type' 		=> $slider_post_type,
                    'ignore_sticky_posts' => 1, // otherwise the sticky posts show up undesired*/
					 );		
		
		if ($slidertype && $slidertype == 'random') {
			$args = array_merge($args, array('orderby' => 'rand'));
		}		
		if ($slidertype && $slidertype == 'posts_pages') {                    
			$post_ids = $graphene_settings['slider_specific_posts'];
            $post_ids = preg_split("/[\s]*[,][\s]*/", $post_ids, -1, PREG_SPLIT_NO_EMPTY); // post_ids are comma seperated, the query needs a array                        
            $args = array_merge($args, array('post__in' => $post_ids, 'posts_per_page' => -1, 'orderby' => 'post__in' ) );
		}
		if ($slidertype && $slidertype == 'categories' && is_array($graphene_settings['slider_specific_categories'])) {                        
			$args = array_merge($args, array( 'category__in' => $graphene_settings['slider_specific_categories']));
		}
		
		/* Get the posts */
		$sliderposts = new WP_Query( apply_filters( 'graphene_slider_args', $args) );
		$sliderposts = apply_filters( 'graphene_slider_posts', $sliderposts);
		
        /* Display each post in the slider */
        $slidernav_html = '';
        $i = 0;
        while ( $sliderposts->have_posts() ) : $sliderposts->the_post();
			
			$style = '';
			/* Slider background image*/
			if ( $graphene_settings['slider_display_style'] == 'bgimage-excerpt' ) {
				$column_mode = graphene_column_mode();
				if ( $column_mode == 'one-column' ){
					$image_size = 'graphene_slider_full';
				} elseif ( strpos( $column_mode, 'two-col' ) === 0){
					$image_size = 'graphene_slider';
				} else if ( strpos( $column_mode, 'three-col' ) === 0 ){
					$image_size = 'graphene_slider_small';
				}
				$image = graphene_get_slider_image( get_the_ID(), $image_size, true);
				if ( $image ){
					$style .= 'style="background-image:url( ';
					$style .= ( is_array( $image) ) ? $image[0] : $image;
					$style .= ' );"';
				}
			}
			?>
            
            <div class="slider_post clearfix" id="slider-post-<?php the_ID(); ?>" <?php echo $style; ?>>
                <?php do_action( 'graphene_before_sliderpost' ); ?>
                
                <?php if ( $graphene_settings['slider_display_style'] == 'thumbnail-excerpt' ) : ?>
					<?php /* The slider post's featured image */ ?>
                    <?php 
                    if ( get_post_meta( get_the_ID(), '_graphene_slider_img', true) != 'disabled' && ! ( ( get_post_meta( get_the_ID(), '_graphene_slider_img', true ) == 'global' || get_post_meta( get_the_ID(), '_graphene_slider_img', true ) == '' ) && $graphene_settings['slider_img'] == 'disabled' ) ) : 
					$image = graphene_get_slider_image( get_the_ID(), apply_filters( 'graphene_slider_image_size', 'thumbnail' ) );
					if ( $image ) :
					?>
                    <div class="sliderpost_featured_image">
                        <a href="<?php the_permalink(); ?>"><?php echo $image;	?></a>
                    </div>
                    <?php endif; endif; ?>
                <?php endif; ?>
                
                <div class="slider-entry-wrap">
                	<div class="slider-content-wrap">
						<?php /* The slider post's title */ ?>
                        <h2 class="slider_post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        
                        <?php /* The slider post's excerpt */ ?>
                        <div class="slider_post_entry">
                        	<?php 
							if ( $graphene_settings['slider_display_style'] != 'full-post' ){
								the_excerpt(); 
							?>
                            <a class="block-button" href="<?php the_permalink(); ?>"><?php _e( 'View full post', 'graphene' ); ?></a>
                            <?php } else { the_content(); }?>
                            
                            <?php do_action( 'graphene_slider_postentry' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php	
            $slidernav_html .= '<a href="#"'. ( $i == 0 ? ' class="active"' : '' ) .'><span>'. get_the_title(). '</span></a>';
            $i++;
        endwhile;
        wp_reset_postdata();
    ?>
            </div>
        </div>
        
        <?php /* The slider navigation */ ?>
        <div class="slider_nav">
            <?php echo $slidernav_html; ?>            
            <?php do_action( 'graphene_slider_nav' ); ?>
        </div>
        
    </div>
    <?php
	do_action( 'graphene_after_slider' );
	$in_slider = false;
}
/* Create an intermediate function that controls where the slider should be displayed */
if (!function_exists( 'graphene_display_slider' ) ) :
	function graphene_display_slider(){
		if (is_front_page() ){
			graphene_slider();
			add_action( 'wp_footer', 'graphene_scrollable' );
		}
	}
endif;
/* Hook the slider to the appropriate action hook */
if (!$graphene_settings['slider_disable']){
	if (!$graphene_settings['slider_position'])
		add_action( 'graphene_top_content', 'graphene_display_slider' );
	else
		add_action( 'graphene_bottom_content', 'graphene_display_slider' );
}


/**
 * This function determines which image to be used as the slider image based on user
 * settings, and returns the <img> tag of the the slider image.
 *
 * It requires the post's ID to be passed in as argument so that the user settings in
 * individual post / page can be retrieved.
*/
if (!function_exists( 'graphene_get_slider_image' ) ) :
	function graphene_get_slider_image( $post_id = NULL, $size = 'thumbnail', $urlonly = false){
		global $graphene_settings;
		
		// Throw an error message if no post ID supplied
		if ( $post_id == NULL){
			echo '<strong>ERROR:</strong> Post ID must be passed as an input argument to call the function <code>graphene_get_slider_image()</code>.';
			return;
		}
		
		// First get the settings
		$global_setting = ( $graphene_settings['slider_img'] ) ? $graphene_settings['slider_img'] : 'featured_image';
		$local_setting = get_post_meta( $post_id, '_graphene_slider_img', true);
		$local_setting = ( $local_setting ) ? $local_setting : 'global';
		
		// Determine which image should be displayed
		$final_setting = ( $local_setting == 'global' ) ? $global_setting : $local_setting;
		
		// Build the html based on the final setting
		$html = '';
		if ( $final_setting == 'disabled' ){					// image disabled
		
			return false;
			
		} elseif ( $final_setting == 'featured_image' ){		// Featured Image
		
			if ( has_post_thumbnail( $post_id ) ) :
				if ( $urlonly)
					$html = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
				else
					$html .= get_the_post_thumbnail( $post_id, $size );
			endif;
			
		} elseif ( $final_setting == 'post_image' ){			// First image in post
			
				$html = graphene_get_post_image( $post_id, $size, '', $urlonly);
			
		} elseif ( $final_setting == 'custom_url' ){			// Custom URL
			
			if (!$urlonly){
				$html .= '<a href="'.get_permalink( $post_id).'">';
				if ( $local_setting != 'global' ) :
					$html .= '<img src="'.get_post_meta( $post_id, '_graphene_slider_imgurl', true).'" alt="" />';
				else :
					$html .= '<img src="'.$graphene_settings['slider_imgurl'].'" alt="" />';
				endif;
				$html .= '</a>';
			} else {
				if ( $local_setting != 'global' ) :
					$html .= get_post_meta( $post_id, '_graphene_slider_imgurl', true);
				else :
					$html .= $graphene_settings['slider_imgurl'];
				endif;
			}
			
		}
		
		// Returns the html
		return $html;
		
	}
endif;


/**
 * This function gets the first image (as ordered in the post's media gallery) attached to
 * the current post. It outputs the complete <img> tag, with height and width attributes.
 * The function returns the thumbnail of the original image, linked to the post's 
 * permalink. Returns FALSE if the current post has no image.
 *
 * This function requires the post ID to get the image from to be supplied as the
 * argument. If no post ID is supplied, it outputs an error message. An optional argument
 * size can be used to determine the size of the image to be used.
 *
 * Based on code snippets by John Crenshaw 
 * (http://www.rlmseo.com/blog/get-images-attached-to-post/)
 *
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.1
*/
if (!function_exists( 'graphene_get_post_image' ) ) :
	function graphene_get_post_image( $post_id = NULL, $size = 'thumbnail', $context = '', $urlonly = false){
		
		/* Display error message if no post ID is supplied */
		if ( $post_id == NULL ){
			_e( '<strong>ERROR: You must supply the post ID to get the image from as an argument when calling the graphene_get_post_image() function.</strong>', 'graphene' );
			return;
		}
		
		/* Get the images */
		$images = get_children( array( 
								'post_type' 		=> 'attachment',
								'post_mime_type' 	=> 'image',
								'post_parent' 	 	=> $post_id,
								'orderby'			=> 'menu_order',
								'order'				=> 'ASC',
								'numberposts'		=> 1,
									 ), ARRAY_A );
		
		$html = '';
		
		/* Returns generic image if there is no image to show */
		if ( empty( $images ) && $context != 'excerpt' && ! $urlonly ) {
			$html .= apply_filters( 'graphene_generic_slider_img', '<img alt="" src="'.get_template_directory_uri().'/images/img_slider_generic.png" />' );
		}
		
		/* Build the <img> tag if there is an image */
		foreach ( $images as $image ){
			if (!$urlonly) {
				if ( $context == 'excerpt' ) {$html .= '<div class="excerpt-thumb">';};
				$html .= '<a href="'.get_permalink( $post_id).'">';
				$html .= wp_get_attachment_image( $image['ID'], $size);
				$html .= '</a>';
				if ( $context == 'excerpt' ) {$html .= '</div>';};
			} else {
				$html = wp_get_attachment_image_src( $image['ID'], $size);
			}
		}
		
		/* Returns the image HTMl */
		return $html;
}
endif;


/**
 * This function retrieves the header image for the theme
*/
if (!function_exists( 'graphene_get_header_image' ) ) :
	function graphene_get_header_image( $post_id = NULL){
		global $graphene_settings;
		
		if ( is_singular() && has_post_thumbnail( $post_id ) && ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'post-thumbnail' ) ) &&  $image[1] >= HEADER_IMAGE_WIDTH && !$graphene_settings['featured_img_header']) {
			// Houston, we have a new header image!
			// Gets only the image url. It's a pain, I know! Wish WordPress has better options on this one
			$header_img = get_the_post_thumbnail( $post_id, 'post-thumbnail' );
			$header_img = explode( '" class="', $header_img);
			$header_img = $header_img[0];
			$header_img = explode( 'src="', $header_img);
			$header_img = $header_img[1]; // only the url
		}
		else if ( $graphene_settings['use_random_header_img']){
			$default_header_images = graphene_get_default_headers();
			$randomkey = array_rand( $default_header_images);
			$header_img = str_replace( '%s', get_template_directory_uri(), $default_header_images[$randomkey]['url']);
		} else {
			$header_img = get_header_image();
		}
	return $header_img;
}
add_action( 'graphene_get_header_image', 'graphene_get_header_image' );
endif;


/**
 * Adds the functionality to count comments by type, eg. comments, pingbacks, tracbacks.
 * Based on the code at WPCanyon (http://wpcanyon.com/tipsandtricks/get-separate-count-for-comments-trackbacks-and-pingbacks-in-wordpress/)
 * 
 * In Graphene version 1.3 the $noneText param has been removed
 *
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.3
*/
function graphene_comment_count( $type = 'comments', $oneText = '', $moreText = '' ){
	if( $type == 'comments' ) :
		$typeSql = 'comment_type = ""';
	elseif( $type == 'pings' ) :
		$typeSql = 'comment_type != ""';
	elseif( $type == 'trackbacks' ) :
		$typeSql = 'comment_type = "trackback"';
	elseif( $type == 'pingbacks' ) :
		$typeSql = 'comment_type = "pingback"';
	endif;
	
	$typeSql = apply_filters( 'graphene_comments_typesql', $typeSql, $type );

	global $wpdb;

    $result = $wpdb->get_var( '
        SELECT
            COUNT(comment_ID)
        FROM
            '.$wpdb->comments.'
        WHERE
            '.$typeSql.' AND
            comment_approved="1" AND
            comment_post_ID= '.get_the_ID() );

	//if( $result == 0):
	//	echo str_replace( '%', $result, $noneText);
    if( $result == 1) : 
		return str_replace( '%', $result, $oneText);
	elseif( $result > 1) : 
		return str_replace( '%', $result, $moreText);
	else :
		return false;
	endif;
}

/**
 * Custom jQuery script for the comments/pings tabs
*/
function graphene_tabs_js(){ 
	global $tabbed;
	if ( $tabbed) :
?>
	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready(function( $){
			$(function(){                                
				// to allow the user to switch tabs
				$("div#comments h4.comments a").click(function(){
					$("div#comments .comments").addClass( 'current' );
					$("div#comments .pings").removeClass( 'current' );
					$("div#comments #pings_list").hide();
					$("div#comments #comments_list").fadeIn(300);
					return false;
				});
				$("div#comments h4.pings a").click(function(){
					$("div#comments .pings").addClass( 'current' );
					$("div#comments .comments").removeClass( 'current' );
					$("div#comments #comments_list").hide();
					$("div#comments #pings_list").fadeIn(300);
					return false;
				});
			});
		});
		//]]>
	</script>
<?php
	endif;
}
add_action( 'wp_footer', 'graphene_tabs_js' );



/**
 * Add JavaScript for the theme's options page
*/
function graphene_options_js(){ 
	if ( strstr( $_SERVER["REQUEST_URI"], 'page=graphene_options' ) ) {
		require( 'admin/js/admin.js.php' );	
	}
}
add_action( 'admin_footer', 'graphene_options_js' );


/**
 * This functions adds additional classes to the <body> element. The additional classes
 * are added by filtering the WordPress body_class() function.
*/
function graphene_body_class( $classes){
    
    $column_mode = graphene_column_mode();
    $classes[] = $column_mode;
    // for easier CSS
    if ( strpos( $column_mode, 'two-col' ) === 0){
        $classes[] = 'two-columns';
    } else if ( strpos( $column_mode, 'three-col' ) === 0 ){
        $classes[] = 'three-columns';
    }
    
    // Prints the body class
    return $classes;
}
add_filter( 'body_class', 'graphene_body_class' );


/**
 * This functions adds additional classes to the post element. The additional classes
 * are added by filtering the WordPress post_class() function.
*/
function graphene_post_class( $classes){
    global $graphene_settings;
    
	if ( in_array( $graphene_settings['post_date_display'], array( 'hidden', 'text' ) ) || ! graphene_should_show_date() ) {
		$classes[] = 'nodate';
	}
	
    // Prints the body class
    return $classes;
}
add_filter( 'post_class', 'graphene_post_class' );

/**
 * Add the .sticky post class to sticky posts in the home page if the "Front page posts 
 * categories" option is being used
*/
function graphene_sticky_post_class( $classes){
	if (is_sticky() && !in_array( 'sticky', $classes) && is_home() ){
		$classes[] = 'sticky';	
	}
	return $classes;
}
add_filter( 'post_class', 'graphene_sticky_post_class' );


function graphene_column_mode(){
    global $graphene_settings;
    
    // first check the template
    if (is_page_template( 'template-onecolumn.php' ) )
        return 'one-column';
    elseif (is_page_template( 'template-twocolumnsleft.php' ) )
        return 'two-col-left';
    elseif (is_page_template( 'template-twocolumnsright.php' ) )
        return 'two-col-right';
    elseif (is_page_template( 'template-threecolumnsleft.php' ) )
        return 'three-col-left';
    elseif (is_page_template( 'template-threecolumnsright.php' ) )
        return 'three-col-right';
    elseif (is_page_template( 'template-threecolumnscenter.php' ) )
        return 'three-col-center';
    else // now get the column mode        
        return $graphene_settings['column_mode']; 
}

/**
 * Add the .htc file for partial CSS3 support in Internet Explorer
*/
function graphene_ie_css3(){ ?>
	<!--[if lte IE 8]>
      <style type="text/css" media="screen">
      	#footer, div.sidebar-wrap, .block-button, .featured_slider, #slider_root, #comments li.bypostauthor, #nav li ul, .pie{behavior: url(<?php echo get_template_directory_uri(); ?>/js/PIE.php);}
        .featured_slider{margin-top:0 !important;}
      </style>
    <![endif]-->
    <?php
}
add_action( 'wp_head', 'graphene_ie_css3' );


/**
 * Fix IE8 image scaling issues when using max-width property on images
*/
function graphene_ie8_img(){ ?>
	<!--[if IE 8]>
    <script type="text/javascript">
        (function( $) {
            var imgs, i, w;
            var imgs = document.getElementsByTagName( 'img' );
            maxwidth = 0.98 * $( '.entry-content' ).width();
            for( i = 0; i < imgs.length; i++ ) {
                w = imgs[i].getAttribute( 'width' );
                if ( w > maxwidth ) {
                    imgs[i].removeAttribute( 'width' );
                    imgs[i].removeAttribute( 'height' );
                }
            }
        })(jQuery);
    </script>
    <![endif]-->
<?php
}
add_action( 'wp_footer', 'graphene_ie8_img' );


/**
 * Add Google Analytics code if tracking is enabled 
 */ 
function graphene_google_analytics(){
	global $graphene_settings;
    if ( $graphene_settings['show_ga']) : ?>
    <!-- BEGIN Google Analytics script -->
    	<?php echo stripslashes( $graphene_settings['ga_code']); ?>
    <!-- END Google Analytics script -->
    <?php endif; 
}
add_action( 'wp_head', 'graphene_google_analytics', 1000);


/**
 * This function prints out the title for the website.
 * If present, the theme will display customised site title structure.
*/
if (!function_exists( 'graphene_title' ) ) :
	function graphene_title(){
		global $graphene_settings;
		
		if (is_front_page() ) { 
			if ( $graphene_settings['custom_site_title_frontpage']) {
				$title = $graphene_settings['custom_site_title_frontpage'];
				$title = str_replace( '#site-name', get_bloginfo( 'name' ), $title);
				$title = str_replace( '#site-desc', get_bloginfo( 'description' ), $title);
			} else {
				$title = get_bloginfo( 'name' ) . " &raquo; " . get_bloginfo( 'description' );
			}
			
		} else {
			if ( $graphene_settings['custom_site_title_content']) {
				$title = $graphene_settings['custom_site_title_content'];
				$title = str_replace( '#site-name', get_bloginfo( 'name' ), $title);
				$title = str_replace( '#site-desc', get_bloginfo( 'description' ), $title);
				$title = str_replace( '#post-title', wp_title( '', false), $title);
			} else {
				$title = wp_title( '', false)." &raquo; ".get_bloginfo( 'name' );
			}
		}
		
		echo $title;
	}
endif;


/*
 * Adds a menu-item-ancestor class to menu items with children for styling.
 * Code taken from the Menu-item-ancestor plugin by Valentinas Bakaitis
*/
function graphene_add_ancestor_class( $classlist, $item){
	global $wp_query, $wpdb;
	//get the ID of the object, to which menu item points
	$id = get_post_meta( $item->ID, '_menu_item_object_id', true);
	//get first menu item that is a child of that object
	$children = $wpdb->get_var( 'SELECT post_id FROM '.$wpdb->postmeta.' WHERE meta_key like "_menu_item_menu_item_parent" AND meta_value='.$item->ID.' LIMIT 1' );
	//if there is at least one item, then $children variable will contain it's ID (which is of course more than 0)
	if( $children > 0)
		//in that case - add the CSS class
		$classlist[] = 'menu-item-ancestor';
	//return class list
	return $classlist;
}

//add filter to nav_menu_css_class list
add_filter( 'nav_menu_css_class', 'graphene_add_ancestor_class', 2, 10);


/**
 * Prints out the content of a variable wrapped in <pre> elements.
 * For development and debugging use
*/
function disect_it( $var = NULL, $exit = true, $comment = false){
	if ( $var !== NULL){
		if ( $comment) {echo '<!--';}
		echo '<pre>';
		print_r( $var);
		echo '</pre>';
		if ( $comment) {echo '-->';}
		if ( $exit) {exit();}
	} else {
		echo '<strong>ERROR:</strong> You must pass a variable as argument to the <code>disect_it()</code> function.';	
	}
}

function graphene_page_template_visualizer() {  
    global $graphene_settings, $post_id;
    $template_not_found = __( 'Template preview not found.', 'graphene' );    
    
	if (!get_post_meta( $post_id, '_wp_page_template', true) ){
		$default_template = __( 'default', 'graphene' );
	} else {
		switch( $graphene_settings['column_mode']){
			case 'one-column':
				$default_template = 'template-onecolumn.php';
				break;
			case 'two-col-right':
				$default_template = 'template-twocolumnsright.php';
				break;
			case 'three-col-left':
				$default_template = 'template-threecolumnsleft.php';
				break;
			case 'three-col-right':
				$default_template = 'template-threecolumnsright.php';
				break;
			case 'three-col-center':
				$default_template = 'template-threecolumnscenter.php';
				break;
			default:
				$default_template = 'template-twocolumnsleft.php';
				break;
		}
	}
    
    
    $preview_img_path = get_template_directory_uri() . '/admin/images/';
    ?>
    <script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready(function( $){
        $( '#page_template' ).change(function(){
           update_page_template();           
        });
        // $( '#page_template' ).after( '<p><span><?php echo $template_not_found;?></span><img id="page_template_img" alt="none" /></p>' );
		$( '#page_template' ).after( '<p><img id="page_template_img" alt="none" /></p>' );
        
        function update_page_template() {
            var preview_img = $( '#page_template' ).val().replace(/.php$/, '.png' );
            //if (preview_img == 'default' ){ preview_img = '<?php echo $default_template;?>'; }            
            $( '#page_template_img' ).attr( 'src', '<?php echo $preview_img_path ?>'+preview_img);
        }
        
        // if the template preview image is not found, hide the image not found and show text
        $( '#page_template_img' ).error(function(){
           $(this).hide();  
           $( 'span', $(this).parent() ).show();
        });
        // if the template preview image is found, show the image
        $( '#page_template_img' ).load(function(){
           $(this).show();     
           $( 'span', $(this).parent() ).hide();
        });
        
        // remove the default option (because the theme overrides the template
        $( '#page_template option[value="default"]' ).remove();
        // add the theme default item
        $( '#page_template option:first' ).before( $( '<option value="default"><?php _e( 'Theme default', 'graphene' ); ?></option>' ) );
        // select the default template if it isn't already selected
        if ( $( '#page_template option[selected="selected"]' ).length == 0){
            // $( '#page_template option[text="<?php echo $default_template; ?>"]' ).attr( 'selected', 'selected' );
            $( '#page_template option:contains("<?php _e( 'Theme default', 'graphene' ); ?>")' ).attr( 'selected', 'selected' );
        }
        
        update_page_template();   
    });
    //]]>
    </script>
    <?php
}
add_action( 'edit_page_form', 'graphene_page_template_visualizer' ); // only works on pages 

function graphene_print_style(){
    wp_register_style( 'graphene-print', get_template_directory_uri().'/print.css', array(), false, 'print' );
    wp_enqueue_style( 'graphene-print' );

    do_action( 'graphene_print' );
}

function graphene_print_only_text( $text){
    return sprintf( '<p class="printonly">%s</p>', $text);
}

function graphene_can_import(){
    // json_encode and json_decode only available from PHP version 5.2.1
    // return version_compare(PHP_VERSION, '5.2.1', '>=' );
	
	// WordPress provides compatibility layer that supports json_encode and json_decode
	if (function_exists( 'json_encode' ) && function_exists( 'json_decode' ) ) {return true;} else {return false;}
}

function graphene_export_options(){
    
    global $graphene_settings;
    
    ob_clean();
	
	/* Check authorisation */
	$authorised = true;
	// Check nonce
	if (!wp_verify_nonce( $_POST['graphene-export'], 'graphene-export' ) ) { 
		$authorised = false;
	}
	// Check permissions
	if (!current_user_can( 'edit_theme_options' ) ){
		$authorised = false;
	}
	if ( $authorised) {
    
		$name = 'graphene_options.txt';
		$data = json_encode( $graphene_settings);
		$size = strlen( $data);
	
		header( 'Content-Type: text/plain' );
		header( 'Content-Disposition: attachment; filename="'.$name.'"' );
		header("Content-Transfer-Encoding: binary");
		header( 'Accept-Ranges: bytes' );
	
		/* The three lines below basically make the download non-cacheable */
		header("Cache-control: private");
		header( 'Pragma: private' );
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	
		header("Content-Length: ".$size);
		print( $data);
	
	} else {
		wp_die(__( 'ERROR: You are not authorised to perform that operation', 'graphene' ) );
	}

    die();   
}

if (isset( $_POST['graphene_export']) ){
	add_action( 'init', 'graphene_export_options' );
}

/**
 * Shortcode handlers
 */
function warning_block_shortcode_handler( $atts, $content=null, $code="" ) {
    return '<div class="warning_block">' . $content . '</div>';
}
add_shortcode( 'warning', 'warning_block_shortcode_handler' );

function error_block_shortcode_handler( $atts, $content=null, $code="" ) {
    return '<div class="error_block">' . $content . '</div>';
}
add_shortcode( 'error', 'error_block_shortcode_handler' );

function notice_block_shortcode_handler( $atts, $content=null, $code="" ) {
    return '<div class="notice_block">' . $content . '</div>';
}
add_shortcode( 'notice', 'notice_block_shortcode_handler' );

function important_block_shortcode_handler( $atts, $content=null, $code="" ) {
    return '<div class="important_block">' . $content . '</div>';
}
add_shortcode( 'important', 'important_block_shortcode_handler' );


/**
 * Hook the shortcode buttons to the TinyMCE editor
*/
class Graphene_Shortcodes_Buttons{
	
	function Graphene_Shortcodes_Buttons(){
		if ( current_user_can( 'edit_posts' ) &&  current_user_can( 'edit_pages' ) ) {	
			// add_filter( 'tiny_mce_version', array(&$this, 'tiny_mce_version' ) );
			add_filter( 'mce_external_plugins', array(&$this, 'graphene_add_plugin' ) );  
			add_filter( 'mce_buttons_2', array(&$this, 'graphene_register_button' ) );  
	   }
	}
	
	function graphene_register_button( $buttons){
		array_push( $buttons, "separator", "warning", "error", "notice", "important");
		return $buttons;
	}
	
	function graphene_add_plugin( $plugin_array){
		$plugin_array['grapheneshortcodes'] = get_template_directory_uri().'/js/mce-shortcodes.js';
		return $plugin_array; 
	}
	
	/*
	function tiny_mce_version( $version) {
		return ++$version;
	}
	*/
}
add_action( 'init', 'Graphene_Shortcodes_Buttons' );

function Graphene_Shortcodes_Buttons(){
	global $Graphene_Shortcodes_Buttons;
	$Graphene_Shortcodes_Buttons = new Graphene_Shortcodes_Buttons();
}


/**
 * Helps to determine if the comments should be shown.
 */
if ( ! function_exists( 'graphene_should_show_comments' ) ) :

function graphene_should_show_comments() {
    global $graphene_settings, $post;
    if ( $graphene_settings['comments_setting'] == 'disabled_completely' ){
        return false;
    }
    if ( $graphene_settings['comments_setting'] == 'disabled_pages' && get_post_type( $post->ID) == 'page' ){
        return false;
    }
    return true;
}

endif;

/**
 * Add a link to the theme's options page in the admin bar
*/
function graphene_wp_admin_bar_theme_options(){
	global $wp_admin_bar;
	$wp_admin_bar->add_menu(array( 'parent' => 'appearance',
								'id' => 'graphene-options',
								'title' => 'Graphene Options',
								'href' => admin_url( 'themes.php?page=graphene_options' ) ));
}
add_action( 'admin_bar_menu', 'graphene_wp_admin_bar_theme_options', 61 );


/**
 * Adds the content panes in the homepage. The homepage panes are only displayed if using a static
 * front page, before the comments. It is also recommended that the comments section is disabled 
 * for the page used as the static front page.
*/
function graphene_homepage_panes(){
	global $graphene_settings, $graphene_defaults;
	
	// Get the number of panes to display
	if ( $graphene_settings['show_post_type'] == 'latest-posts' || $graphene_settings['show_post_type'] == 'cat-latest-posts' ){
		$pane_count = $graphene_settings['homepage_panes_count'];
	} elseif ( $graphene_settings['show_post_type'] == 'posts' ) {
		$pane_count = count(explode( ',', $graphene_settings['homepage_panes_posts']) );
	}
	
	// Build the common WP_Query() parameter first
	$args = array( 
				  'orderby' 			=> 'date',
				  'order' 				=> 'DESC',
				  'post_type' 			=> array( 'post', 'page' ),
				  'posts_per_page'		=> $pane_count,
				  'ignore_sticky_posts' => 1,
				 );
	
	// args specific to latest posts
	if ( $graphene_settings['show_post_type'] == 'latest-posts' ){
		$args_merge = array(
							'post_type' => array( 'post' ),
							);
		$args = array_merge( $args, $args_merge );
	}
	
	// args specific to latest posts by category
	if ($graphene_settings['show_post_type'] == 'cat-latest-posts' ){
		$args_merge = array(
							'category__in' => $graphene_settings['homepage_panes_cat'],
							);
		$args = array_merge( $args, $args_merge );
	}
	
	// args specific to posts/pages
	if ( $graphene_settings['show_post_type'] == 'posts' ){
		
         $post_ids = $graphene_settings['homepage_panes_posts'];
         $post_ids = preg_split("/[\s]*[,][\s]*/", $post_ids, -1, PREG_SPLIT_NO_EMPTY); // post_ids are comma seperated, the query needs a array                        
          
		$args_merge = array(	
							'post__in' => $post_ids,
							);
		$args = array_merge( $args, $args_merge );
	}
	
	// Get the posts to display as homepage panes
	$panes = new WP_Query( apply_filters( 'graphene_homepage_panes_args', $args ) );
	?>
    
    <div class="homepage_panes">
	
	<?php while ( $panes->have_posts() ) : $panes->the_post();	?>
		<div class="homepage_pane clearfix">
        
        	<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'graphene' ), esc_attr( get_the_title() ) ); ?>">
        	<?php /* Get the post's image */ 
			if ( has_post_thumbnail( get_the_ID() ) ) {
				the_post_thumbnail( 'graphene-homepage-pane' );
			} else {
				echo graphene_get_post_image( get_the_ID(), 'graphene-homepage-pane', 'excerpt' );
			}
			?>
            </a>
            
            <?php /* The post title */ ?>
            <h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'graphene' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a></h3>
            
            <?php /* The post excerpt */ ?>
            <div class="post-excerpt">
            	<?php the_excerpt(); ?>
            </div>
            
            <?php /* Read more button */ ?>
            <p class="post-comments">
            	<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'graphene' ), esc_attr( get_the_title() ) ); ?>" class="block-button"><?php _e( 'Read more', 'graphene' ); ?></a>
            </p>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
	</div>
	
	<?php
}

/* Helper function to control when the homepage panes should be displayed. */
function graphene_display_homepage_panes(){
	global $graphene_settings;
	if ( get_option( 'show_on_front' ) == 'page' && ! $graphene_settings['disable_homepage_panes'] && is_front_page() ) {
		graphene_homepage_panes();
	}	
}
add_action( 'graphene_bottom_content', 'graphene_display_homepage_panes' );


/**
 * Improves the WordPress default excerpt output. This function will retain HTML tags inside the excerpt.
 * Based on codes by Aaron Russell at http://www.aaronrussell.co.uk/blog/improving-wordpress-the_excerpt/
*/
function graphene_improved_excerpt( $text){
	global $graphene_settings, $post;
	
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content( '' );
		$text = strip_shortcodes( $text );
		$text = apply_filters( 'the_content', $text);
		$text = str_replace( ']]>', ']]&gt;', $text);
		
		/* Remove unwanted JS code */
		$text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text);
		
		/* Strip HTML tags, but allow certain tags */
		$text = strip_tags( $text, $graphene_settings['excerpt_html_tags']);

		$excerpt_length = apply_filters( 'excerpt_length', 55);
		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );
		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count( $words) > $excerpt_length ) {
			array_pop( $words);
			$text = implode( ' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode( ' ', $words);
		}
	}
	return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt);
}

/**
 * Only use the custom excerpt trimming function if user decides to retain html tags.
*/
if ( $graphene_settings['excerpt_html_tags']) {
	remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
	add_filter( 'get_the_excerpt', 'graphene_improved_excerpt' );
}


/**
 * Add Facebook and Twitter icon to top bar
*/
function graphene_top_bar_social(){
	global $graphene_settings;
	
	if ( $graphene_settings['twitter_url']) : ?>
    	<a href="<?php echo $graphene_settings['twitter_url']; ?>" title="<?php printf(esc_attr__( 'Follow %s on Twitter', 'graphene' ), get_bloginfo( 'name' ) ); ?>" class="twitter_link" <?php if ( $graphene_settings['social_media_new_window'] ) { echo 'target="_blank"'; } ?>><span><?php printf(esc_attr__( 'Follow %s on Twitter', 'graphene' ), get_bloginfo( 'name' ) ); ?></span></a>
    <?php endif; 
	if ( $graphene_settings['facebook_url']) : ?>
    	<a href="<?php echo $graphene_settings['facebook_url']; ?>" title="<?php printf(esc_attr__("Visit %s's Facebook page", 'graphene' ), get_bloginfo( 'name' ) ); ?>" class="facebook_link" <?php if ( $graphene_settings['social_media_new_window'] ) { echo 'target="_blank"'; } ?>><span><?php printf(esc_attr__("Visit %s's Facebook page", 'graphene' ), get_bloginfo( 'name' ) ); ?></span></a>
    <?php endif;
	
	/* Loop through the registered custom social modia */
	$social_media = $graphene_settings['social_media'];
	foreach ( $social_media as $slug => $social_medium) : if (!empty( $slug) && !empty( $social_medium['url']) ) : ?>
    	<?php /* translators: %1$s is the website's name, %2$s is the social media name */ ?>                
		<a href="<?php echo $social_medium['url']; ?>" title="<?php echo graphene_determine_social_medium_title($social_medium); ?>" class="<?php echo $slug?>-link" style="background-image:url(<?php echo $social_medium['icon']; ?>)" <?php if ( $graphene_settings['social_media_new_window'] ) { echo 'target="_blank"'; } ?>><span><?php echo graphene_determine_social_medium_title($social_medium); ?></span></a>
    <?php endif; endforeach;
}
add_action( 'graphene_feed_icon', 'graphene_top_bar_social' );

/**
 * Determine the title for the social medium.
 * @param array $social_medium
 * @return string 
 */
function graphene_determine_social_medium_title($social_medium) {
    if (isset($social_medium['title']) && !empty($social_medium['title']) ) {
        return $social_medium['title'];
    }
    else {
        return sprintf(esc_attr__('Visit %1$s\'s %2$s page', 'graphene'), get_bloginfo('name'), $social_medium['name']);
    }
}


/**
 * Add breadcrumbs to the top of the content area. Uses the Breadcrumb NavXT plugin
*/
if (function_exists( 'bcn_display' ) ) :
	function graphene_breadcrumb_navxt(){
		echo '<div class="breadcrumb">';
		bcn_display();
		echo '</div>';
	}
	add_action( 'graphene_top_content', 'graphene_breadcrumb_navxt' );
endif;


/**
 * Truncate a string by specified length
*/
if ( ! function_exists( 'graphene_substr' ) ) :

function graphene_substr( $string, $start = 0, $length = '', $append = '' ){
	
	if ( $length == '' ) return $string;
	
	if ( strlen( $string ) > $length ) {
		return substr( $string, $start, $length ) . $append;	
	} else {
		return $string;	
	}
}

endif;


/**
 * Determine if date should be displayed. Returns true if it should, or false otherwise.
*/
if ( ! function_exists( 'graphene_should_show_date' ) ) :

function graphene_should_show_date(){
	
	// Check post type
	$allowed_posttypes = apply_filters( 'graphene_date_display_posttype', array( 'post' ) );
	if ( ! in_array( get_post_type(), $allowed_posttypes ) )
		return false;
	
	// Check per-post settings
	global $post;
	$post_setting = get_post_meta( $post->ID, '_graphene_post_date_display', true );
	if ( $post_setting == 'hide' )
		return false;
		
	// Check global setting
	global $graphene_settings;
	if ( $graphene_settings['post_date_display'] == 'hidden' )
		return false;
	
	return true;
}

endif;


/**
 * Allows post queries to sort the results by the order specified in the post__in parameter. 
 * Just set the orderby parameter to post__in!
 *
 * Based on the Sort Query by Post In plugin by Jake Goldman (http://www.get10up.com)
*/
add_filter( 'posts_orderby', 'sort_query_by_post_in', 10, 2 );
	
function sort_query_by_post_in( $sortby, $thequery ) {
	if ( ! empty( $thequery->query['post__in'] ) && isset( $thequery->query['orderby'] ) && $thequery->query['orderby'] == 'post__in' )
		$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";
	
	return $sortby;
}
?>