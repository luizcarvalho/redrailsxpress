<?php
/**
 * Set the default values for all the settings. If no user-defined values
 * is available for any setting, these defaults will be used.
 */
global $graphene_defaults;
$graphene_defaults = array(
	/* Theme's DB version */
	'db_version' => '1.0',

	/* Slider options */
	'slider_type' => 'latest_posts', // latest_posts | random | posts_pages | categories
	'slider_specific_posts' => '',
    'slider_specific_categories' => '',
	'slider_postcount' => '',
	'slider_img' => 'featured_image', // disabled | featured_image | post_image | custom_url
	'slider_display_style' => 'thumbnail-excerpt', // thumbnail-excerpt | bgimage-excerpt | full-post
	'slider_imgurl' => '',
	'slider_height' => '',
	'slider_speed' => '7000',
	'slider_trans_speed' => '400',
	'slider_position' => false,
	'slider_disable' => false,
    'slider_animation' => 'horizontal-slide', // horizontal-slide | vertical-slide | fade | none
	
	/* Front page options */
	'frontpage_posts_cats' => array(),
	
	/* Homepage panes */
	'show_post_type' => 'latest-posts', // latest-posts | cat-latest-posts | posts
	'homepage_panes_count' => '2',
	'homepage_panes_cat' => array( '1' ),
	'homepage_panes_posts' => '1',
	'disable_homepage_panes' => false,
    
    /* Comment options */
    'comments_setting' => 'wordpress', // wordpress | disabled_pages | disabled_completely
        
    /* Child page options */    
    'hide_parent_content_if_empty' => false,
    'child_page_listing' => 'show_always', // hide | show_always | show_if_parent_empty
	
	/* Top bar options(Syndication) */
    'hide_top_bar' => false,
	'custom_feed_url' => '',
	'hide_feed_icon' => false,
	'social_media_new_window' => false,
	'twitter_url' => '',
	'facebook_url' => '',
	'social_media' => array(),
	
	/* Adsense Options */
	'show_adsense' => false,
	'adsense_code' => '',
	'adsense_show_frontpage' => false,
	
	/* Social Sharing options */
	'show_addthis' => false,
	'show_addthis_page' => false,
	'addthis_location' => 'post-bottom', // post-bottom | post-top | top-bottom
	'addthis_code' => '',
	
	/* Google Analytics options */
	'show_ga' => false,
	'ga_code' => '',
	
	/* Widget Area options */
	'alt_home_sidebar' => false,
	'alt_home_footerwidget' => false,
	'enable_header_widget' => false,
	
	/* Footer options */
	'show_cc' => false,
	'copy_text' => '',
	'hide_copyright' => false,
	'hide_return_top' => false,
    
    /* Print options */
    'print_css' => false,
    'print_button' => false,
    	
	/* Display Options Page */
	
	/* Header options */
	'light_header' => false,
	'link_header_img' => false,
	'featured_img_header' => false,
	'use_random_header_img' => false,
	'hide_feed_icon' => false,
	'search_box_location' => 'top_bar', // top_bar | nav_bar | disabled
	
	/* Column options */
        /* two column with the main-content on the left side */	
	'column_mode' => 'two-col-left',  // one-column | two-col-left | two-col-right | three-col-left | three-col-right | three-col-center
	
	/* Posts Display options */
	'posts_show_excerpt' => false,
	'archive_full_content' => false,
	'hide_post_author' => false,
	'post_date_display' => 'icon_no_year',  // hidden | icon_no_year | icon_plus_year | text   
	'hide_post_commentcount' => false,
	'hide_post_cat' => false,
	'hide_post_tags' => false,
	'show_post_avatar' => false,
	'show_post_author' => false,
	'show_excerpt_more' => false,
	
	/* Excerpt options */
	'excerpt_html_tags' => '',
	
	/* Footer widget options */
	'footerwidget_column' => '',
	'alt_footerwidget_column' => '',
	
	/* Navigation menu options */
	'navmenu_child_width' => '',
	'navmenu_home_desc' => '',
	'disable_menu_desc' => false,
	
	/* Colour options */
	'bg_content_wrapper' => '#e3e3e3',
	'bg_content' => '#fff',
	'bg_meta_border' => '#e3e3e3',
	'bg_post_top_border' => '#d8d8d8',
	'bg_post_bottom_border' => '#ccc',
	'bg_widget_item' => '#fff',
	'bg_widget_list' => '#e3e3e3',
	'bg_widget_header_border' => '#195392',
	'bg_widget_title' => '#fff',
	'bg_widget_title_textshadow' => '#555',
	'bg_widget_header_bottom' => '#1f6eb6',
	'bg_widget_header_top' => '#3c9cd2',
	'bg_slider_top' => '#0F2D4D',
	'bg_slider_bottom' => '#2880C3',
	'bg_button' => '#2982C5',
	'bg_button_label' => '#fff',
	'bg_button_label_textshadow' => '#444',
	'bg_archive_left' => '#0F2D4D',
	'bg_archive_right' => '#2880C3',
	'bg_archive_label' => '#E3E3E3',
	'bg_archive_text' => '#fff',
	'bg_archive_textshadow' => '#333',
       
    
	/* Header Text options */
	'header_title_font_type' => '',
	'header_title_font_size' => '',
	'header_title_font_lineheight' => '',
	'header_title_font_weight' => '',
	'header_title_font_style' => '',
	
	'header_desc_font_type' => '',
	'header_desc_font_size' => '',
	'header_desc_font_lineheight' => '',
	'header_desc_font_weight' => '',
	'header_desc_font_style' => '',
	
	/* Content Text options */
	'content_font_type' => '',
	'content_font_size' => '',
	'content_font_lineheight' => '',
	'content_font_colour' => '#2c2b2b',
	
	'link_colour_normal' => '#1772af',
	'link_colour_visited' => '#1772af',
	'link_colour_hover' => '#074d7c',
	'link_decoration_normal' => '',
	'link_decoration_hover' => '',
	
	/* Miscellaneous options */
	'hide_allowedtags' => false,
	'custom_site_title_frontpage' => '',
	'custom_site_title_content' => '',
	'favicon_url' => '',
	'custom_css' => '',
    
    
	/* Advanced options */
	'enable_preview' => false,
	'widget_hooks' => array(),
);
?>