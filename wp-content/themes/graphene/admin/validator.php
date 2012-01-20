<?php
/**
 * Settings Validator
 * 
 * This file defines the function that validates the theme's options
 * upon submission.
*/
function graphene_settings_validator( $input ){
	
	if (!isset($_POST['graphene_uninstall'])) {
		global $graphene_defaults, $allowedposttags;
		
		// Add <script> tag to the allowed tags in code
		$allowedposttags = array_merge( $allowedposttags, array( 'script' => array( 'type' => array(), 'src' => array() ) ) );
		
		if (isset($_POST['graphene_general'])) {
		
			/* =Slider Options 
			--------------------------------------------------------------------------------------*/
			
			// Slider category
			if ( isset($input['slider_type']) && !in_array($input['slider_type'], array('latest_posts', 'random', 'posts_pages', 'categories' ) ) ){
				unset($input['slider_type']);
				add_settings_error('graphene_options', 2, __('ERROR: Invalid category to show in slider.', 'graphene'));
			} elseif ( $input['slider_type'] == 'posts_pages' && empty ( $input['slider_specific_posts'] ) ) {
				unset($input['slider_type']);
				add_settings_error('graphene_options', 2, __('ERROR: You must specify the posts/pages to be displayed when you have "Show specific posts/pages" selected for the slider.', 'graphene'));
                        } elseif ( $input['slider_type'] == 'categories' && empty ( $input['slider_specific_categories'] ) ) {
				unset($input['slider_type']);
				add_settings_error('graphene_options', 2, __('ERROR: You must have selected at least one category when you have "Show posts from categories" selected for the slider.', 'graphene'));
			}                        
			// Posts and/or pages to display
			if (isset($input['slider_type']) && $input['slider_type'] == 'posts_pages' && isset($input['slider_specific_posts'])) {
				$input['slider_specific_posts'] = str_replace(' ', '', $input['slider_specific_posts']);
			}
                        // Categories to display posts from
                        if (isset($input['slider_type']) && $input['slider_type'] == 'categories' && isset($input['slider_specific_categories']) && is_array($input['slider_specific_categories'])){
                            if ( in_array ( false, array_map( 'ctype_digit', (array) $input['slider_specific_categories'] ) ) ) {
                                unset($input['slider_specific_categories']);
                                add_settings_error('graphene_options', 2, __('ERROR: Invalid category selected for the slider categories.', 'graphene'));
                            }
                        }
			// Number of posts to display
			if (!empty($input['slider_postcount']) && !ctype_digit($input['slider_postcount'])){
				unset($input['slider_postcount']);
				add_settings_error('graphene_options', 2, __('ERROR: The number of posts to displayed in the slider must be a an integer value.', 'graphene'));
			}
			// Slider image
			$input = graphene_validate_dropdown( $input, 'slider_img', array('disabled', 'featured_image', 'post_image', 'custom_url'), __('ERROR: Invalid option for the slider image is specified.', 'graphene') );
			// Custom slider image URL
			$input = graphene_validate_url( $input, 'slider_imgurl', __('ERROR: Bad URL entered for the custom slider image URL.', 'graphene') );
			// Slider display style
			$input = graphene_validate_dropdown( $input, 'slider_display_style', array('thumbnail-excerpt', 'bgimage-excerpt', 'full-post'), __('ERROR: Invalid option for the slider display style is specified.', 'graphene') );
			// Slider height
			$input = graphene_validate_digits( $input, 'slider_height', __('ERROR: The value for slider height must be an integer.', 'graphene'));
			// Slider speed
			$input = graphene_validate_digits( $input, 'slider_speed', __('ERROR: The value for slider speed must be an integer.', 'graphene'));
			// Slider transition speed
			$input = graphene_validate_digits( $input, 'slider_trans_speed', __('ERROR: The value for slider transition speed must be an integer.', 'graphene'));
			// Slider animation
			$input = graphene_validate_dropdown( $input, 'slider_animation', array( 'horizontal-slide', 'vertical-slide', 'fade', 'none' ), __( 'ERROR: Invalid slider animation.', 'graphene' ) );
                        // Slider position
			$input['slider_position'] = (isset($input['slider_position'])) ? true : false;
			// Slider disable switch
			$input['slider_disable'] = (isset($input['slider_disable'])) ? true : false;
			
			
			/* =Front Page Options 
			--------------------------------------------------------------------------------------*/
			
			// Front page posts categories
			if ( ! in_array ( '', (array) $input['frontpage_posts_cats'] ) ) {
				if ( in_array ( false, array_map( 'ctype_digit', (array) $input['frontpage_posts_cats'] ) ) ) {
					unset($input['frontpage_posts_cats']);
					add_settings_error('graphene_options', 2, __('ERROR: Invalid category selected for the front page posts categories.', 'graphene'));
				}
			} else {
				$input['frontpage_posts_cats'] = $graphene_defaults['frontpage_posts_cats'];
			}
			
			
			/* =Homepage Panes
			--------------------------------------------------------------------------------------*/
			
			// Type of content to show
			$input = graphene_validate_dropdown( $input, 'show_post_type', array('latest-posts', 'cat-latest-posts', 'posts'), __('ERROR: Invalid option for the type of content to show in homepage panes.', 'graphene') );
			// Number of latest posts to display
			$input = graphene_validate_digits( $input, 'homepage_panes_count', __('ERROR: The value for the number of latest posts to display in homepage panes must be an integer.', 'graphene') );
			// Categories to show latest posts from
                        if ($input['show_post_type'] == 'cat-latest-posts' && isset($input['homepage_panes_cat']) && is_array($input['homepage_panes_cat'])) {
                            if ( in_array ( false, array_map( 'ctype_digit', (array) $input['homepage_panes_cat'] ) ) ) {
                                unset($input['slider_specific_categories']);
                                add_settings_error('graphene_options', 2, __('ERROR: Invalid category selected for the latest posts to show from in the homepage panes.', 'graphene'));
                            }
                        }			
			// Posts and/or pages to display
			if ($input['show_post_type'] == 'posts' && isset($input['homepage_panes_posts'])) {
				$input['homepage_panes_posts'] = str_replace(' ', '', $input['homepage_panes_posts']);
			}
			// Disable switch
			$input['disable_homepage_panes'] = (isset($input['disable_homepage_panes'])) ? true : false;
			
            
			/* =Comments Options
			--------------------------------------------------------------------------------------*/
			
			$input = graphene_validate_dropdown( $input, 'comments_setting', array('wordpress', 'disabled_pages', 'disabled_completely'), __('ERROR: Invalid option for the comments option.', 'graphene') );
			
			            
			/* =Child Page Options
			--------------------------------------------------------------------------------------*/
			
			// Hide parent box if content is empty
			$input['hide_parent_content_if_empty'] = (isset($input['hide_parent_content_if_empty'])) ? true : false;                        
			// Child page listing
			$input = graphene_validate_dropdown( $input, 'child_page_listing', array('hide', 'show_always', 'show_if_parent_empty'), __('ERROR: Invalid option for the child page listings.', 'graphene') );
			
                        
			/* =Widget Area Options
			--------------------------------------------------------------------------------------*/
			
			$input['enable_header_widget'] = (isset($input['enable_header_widget'])) ? true : false;
			$input['alt_home_sidebar'] = (isset($input['alt_home_sidebar'])) ? true : false;
			$input['alt_home_footerwidget'] = (isset($input['alt_home_footerwidget'])) ? true : false;
                        
                        
			/* =Top Bar Options
			--------------------------------------------------------------------------------------*/
			// Hide top bar
                        $input['hide_top_bar'] = (isset($input['hide_top_bar'])) ? true : false;
			// Hide feed icon switch
			$input['hide_feed_icon'] = (isset($input['hide_feed_icon'])) ? true : false;
			// Custom feed URL
			$input = graphene_validate_url( $input, 'custom_feed_url', __('ERROR: Bad URL entered for the custom feed URL.', 'graphene') );
			// Open in new window
			$input['social_media_new_window'] = (isset($input['social_media_new_window'])) ? true : false;
			// Twitter URL
			$input = graphene_validate_url( $input, 'twitter_url', __('ERROR: Bad URL entered for the Twitter URL.', 'graphene') );
			// Facebook URL
			$input = graphene_validate_url( $input, 'facebook_url', __('ERROR: Bad URL entered for the Facebook URL.', 'graphene') );
            /* Social media */
			$social_media_new = (!empty($input['social_media_new'])) ? $input['social_media_new'] : array();
			if (!empty($social_media_new)){
				$i = 0;
				foreach ($social_media_new as $social_medium){
					if (!empty($social_medium['name'])){
						$slug = sanitize_title($social_medium['name'], $i);
						$input['social_media'][$slug]['name'] = $social_medium['name'];
						$input['social_media'][$slug]['icon'] = $social_medium['icon'];
						$input['social_media'][$slug]['url'] = $social_medium['url'];
                                                $input['social_media'][$slug]['title'] = $social_medium['title'];
						$input['social_media'][$slug] = graphene_validate_url( $input['social_media'][$slug], 'icon', __('ERROR: Bad URL entered for the social media icon URL.', 'graphene') );
						$input['social_media'][$slug] = graphene_validate_url( $input['social_media'][$slug], 'url', __('ERROR: Bad URL entered for the social media URL.', 'graphene') );
						$i++;
					}
				}
			}
			            
                        
			/* =Social Sharing Options
			--------------------------------------------------------------------------------------*/
			
			// Show social sharing button switch
			$input['show_addthis'] = (isset($input['show_addthis'])) ? true : false;
			// Show buttons in pages switch
			$input['show_addthis_page'] = (isset($input['show_addthis_page'])) ? true : false;
			// Social sharing buttons location
			$input = graphene_validate_dropdown( $input, 'addthis_location', array('post-bottom', 'post-top', 'top-bottom'), __('ERROR: Invalid option for the social sharing buttons location.', 'graphene') );
			// Social sharing buttons code
			$input['addthis_code'] = trim( stripslashes( $input['addthis_code'] ) );
			
                        
			/* =Adsense Options
			--------------------------------------------------------------------------------------*/
			
			// Show Adsense ads switch
			$input['show_adsense'] = (isset($input['show_adsense'])) ? true : false;
			// Show ads on front page switch
			$input['adsense_show_frontpage'] = (isset($input['adsense_show_frontpage'])) ? true : false;
			// Adsense code
			$input['adsense_code'] = wp_kses_post( $input['adsense_code'] );
			
						
			/* =Google Analytics Options
			--------------------------------------------------------------------------------------*/
			
			// Enable tracking switch
			$input['show_ga'] = (isset($input['show_ga'])) ? true : false;
			// Tracking code
			$input['ga_code'] = wp_kses_post($input['ga_code']);
			
                        
			/* =Footer Options
			--------------------------------------------------------------------------------------*/
			
			// Show creative common logo switch
			$input['show_cc'] = (isset($input['show_cc'])) ? true : false;
			// Copyright HTML
			$input['copy_text'] = wp_kses_post($input['copy_text']);
			// Hide copyright switch
			$input['hide_copyright'] = (isset($input['hide_copyright'])) ? true : false;
			// Hide "Return to top" link switch
			$input['hide_return_top'] = (isset($input['hide_return_top'])) ? true : false;
                        
                        
			/* =Print Options
			--------------------------------------------------------------------------------------*/  
			
			// Enable print CSS switch
			$input['print_css'] = (isset($input['print_css'])) ? true : false;
			// Show print button switch
			$input['print_button'] = (isset($input['print_button'])) ? true : false;
	
			
			
		} // Ends the General options
		
		
		if (isset($_POST['graphene_display'])) {
			
			/* =Header Display Options
			--------------------------------------------------------------------------------------*/  
			
			$input['light_header'] = (isset($input['light_header'])) ? true : false;
			$input['link_header_img'] = (isset($input['link_header_img'])) ? true : false;
			$input['featured_img_header'] = (isset($input['featured_img_header'])) ? true : false;
			$input['use_random_header_img'] = (isset($input['use_random_header_img'])) ? true : false;			
			$input = graphene_validate_dropdown( $input, 'search_box_location', array('top_bar', 'nav_bar', 'disabled'), __('ERROR: Invalid option for the Search box location.', 'graphene') );
			
			
			/* =Column Options
			--------------------------------------------------------------------------------------*/
			$input = graphene_validate_dropdown( $input, 'column_mode', array('one-column', 'two-col-left', 'two-col-right', 'three-col-left', 'three-col-right', 'three-col-center'), __('ERROR: Invalid option for the column mode.', 'graphene') ); 
                        
                        
			/* =Post Display Options
			--------------------------------------------------------------------------------------*/                        
			$input['hide_post_author'] = (isset($input['hide_post_author'])) ? true : false;
			$input = graphene_validate_dropdown( $input, 'post_date_display', array('hidden', 'icon_no_year', 'icon_plus_year', 'text'), __('ERROR: Invalid option for the post date display.', 'graphene') ); 
			$input['hide_post_cat'] = (isset($input['hide_post_cat'])) ? true : false;
			$input['hide_post_tags'] = (isset($input['hide_post_tags'])) ? true : false;
			$input['hide_post_commentcount'] = (isset($input['hide_post_commentcount'])) ? true : false;
			$input['show_post_avatar'] = (isset($input['show_post_avatar'])) ? true : false;
			$input['show_post_author'] = (isset($input['show_post_author'])) ? true : false;
                        
                        
			/* =Excerpts Display Options
			--------------------------------------------------------------------------------------*/     
			$input['posts_show_excerpt'] = (isset($input['posts_show_excerpt'])) ? true : false;                        
			$input['archive_full_content'] = (isset($input['archive_full_content'])) ? true : false;					
			$input['show_excerpt_more'] = (isset($input['show_excerpt_more'])) ? true : false;
                        
                        
			/* =Comments Display Options
			--------------------------------------------------------------------------------------*/
			$input['hide_allowedtags'] = (isset($input['hide_allowedtags'])) ? true : false;
                        

			/* =Background Colour Options
			--------------------------------------------------------------------------------------*/
			// Content area
			if ( empty($input['bg_content_wrapper']) ) $input['bg_content_wrapper'] = $graphene_defaults['bg_content_wrapper'];
			if ( empty($input['bg_content']) ) $input['bg_content'] = $graphene_defaults['bg_content'];
			if ( empty($input['bg_meta_border']) ) $input['bg_meta_border'] = $graphene_defaults['bg_meta_border'];
			if ( empty($input['bg_post_top_border']) ) $input['bg_post_top_border'] = $graphene_defaults['bg_post_top_border'];
			if ( empty($input['bg_post_bottom_border']) ) $input['bg_post_bottom_border'] = $graphene_defaults['bg_post_bottom_border'];
			
			// Widgets
			if ( empty($input['bg_widget_item']) ) $input['bg_widget_item'] = $graphene_defaults['bg_widget_item'];
			if ( empty($input['bg_widget_list']) ) $input['bg_widget_list'] = $graphene_defaults['bg_widget_list'];
			if ( empty($input['bg_widget_header_border']) ) $input['bg_widget_header_border'] = $graphene_defaults['bg_widget_header_border'];
			if ( empty($input['bg_widget_title']) ) $input['bg_widget_title'] = $graphene_defaults['bg_widget_title'];
			if ( empty($input['bg_widget_title_textshadow']) ) $input['bg_widget_title_textshadow'] = $graphene_defaults['bg_widget_title_textshadow'];
			if ( empty($input['bg_widget_header_bottom']) ) $input['bg_widget_header_bottom'] = $graphene_defaults['bg_widget_header_bottom'];
			if ( empty($input['bg_widget_header_top']) ) $input['bg_widget_header_top'] = $graphene_defaults['bg_widget_header_top'];
			
			// Slider
			if ( empty($input['bg_slider_top']) ) $input['bg_slider_top'] = $graphene_defaults['bg_slider_top'];
			if ( empty($input['bg_slider_bottom']) ) $input['bg_slider_bottom'] = $graphene_defaults['bg_slider_bottom'];
			
			// Block button
			if ( empty($input['bg_button']) ) $input['bg_button'] = $graphene_defaults['bg_button'];
			if ( empty($input['bg_button_label']) ) $input['bg_button_label'] = $graphene_defaults['bg_button_label'];
			if ( empty($input['bg_button_label_textshadow']) ) $input['bg_button_label_textshadow'] = $graphene_defaults['bg_button_label_textshadow'];
                        
            // Archive
			if ( empty($input['bg_archive_left']) ) $input['bg_archive_left'] = $graphene_defaults['bg_archive_left'];
            if ( empty($input['bg_archive_right']) ) $input['bg_archive_right'] = $graphene_defaults['bg_archive_right'];
			if ( empty($input['bg_archive_label']) ) $input['bg_archive_label'] = $graphene_defaults['bg_archive_label'];
			if ( empty($input['bg_archive_text']) ) $input['bg_archive_text'] = $graphene_defaults['bg_archive_text'];
            if ( empty($input['bg_archive_textshadow']) ) $input['bg_archive_textshadow'] = $graphene_defaults['bg_archive_textshadow'];

			
			/* =Text Style Options
			--------------------------------------------------------------------------------------*/
			if ( empty($input['content_font_colour']) ) $input['content_font_colour'] = $graphene_defaults['content_font_colour'];
			if ( empty($input['link_colour_normal']) ) $input['link_colour_normal'] = $graphene_defaults['link_colour_normal'];
			if ( empty($input['link_colour_visited']) ) $input['link_colour_visited'] = $graphene_defaults['link_colour_visited'];
			if ( empty($input['link_colour_hover']) ) $input['link_colour_hover'] = $graphene_defaults['link_colour_hover'];
			
                        
			/* =Footer Widget Display Options
			--------------------------------------------------------------------------------------*/
			// Number of columns to display
			$input = graphene_validate_digits( $input, 'footerwidget_column', __('ERROR: The number of columns to be displayed in the footer widget must be a an integer value.', 'graphene' ) );
			
			
			/* =Navigation Menu Display Options
			--------------------------------------------------------------------------------------*/
			$input = graphene_validate_digits( $input, 'navmenu_child_width', __('ERROR: The width of the submenu must be a an integer value.', 'graphene' ) );
			$input['navmenu_home_desc'] = wp_kses_post( $input['navmenu_home_desc'] );
			$input['disable_menu_desc'] = (isset($input['disable_menu_desc'])) ? true : false;
			
			/* =Miscellaneous Display Options
			--------------------------------------------------------------------------------------*/
			$input['custom_site_title_frontpage'] = strip_tags( $input['custom_site_title_frontpage'] );
			$input['custom_site_title_content'] = strip_tags( $input['custom_site_title_content'] );
			$input = graphene_validate_url( $input, 'favicon_url', __( 'ERROR: Bad URL entered for the favicon URL.', 'graphene' ) );
			
			/* =Custom CSS Options 
			--------------------------------------------------------------------------------------*/
			$input['custom_css'] = strip_tags( $input['custom_css'] );
		
		} // Ends the Display options
                
		if ( isset($_POST['graphene_advanced'] ) ) {
			$input['enable_preview'] = ( isset( $input['enable_preview'] ) ) ? true : false; 
			
			if ( isset( $input['widget_hooks'] ) && is_array( $input['widget_hooks'] ) ) {
				if ( ! ( array_intersect( $input['widget_hooks'], graphene_get_action_hooks( true ) ) === $input['widget_hooks'] ) ) {
					unset( $input['widget_hooks'] );
					add_settings_error( 'graphene_options', 2, __( 'ERROR: Invalid action hook selected widget action hooks.', 'graphene' ) );
				}
			} else {
				$input['widget_hooks'] = $graphene_defaults['widget_hooks'];
			}
		} // Ends the Advanced options
		
		
		// Merge the new settings with the previous one (if exists) before saving
		$input = array_merge( get_option('graphene_settings', array() ), $input );
		
		/* Only save options that have different values than the default values */
		foreach ( $input as $key => $value ){
			if ( $graphene_defaults[$key] === $value || $value === '' ) {
				unset( $input[$key] );
			}
		}
		
		/* Delete the settings from database if all settings have their default values */
		if (empty($input)){
			delete_option('graphene_settings');
			return false;
		}
		
	} // Closes the uninstall conditional
	
	return $input;
}


/**
 * Define the data validation functions
*/
function graphene_validate_digits( $input, $option_name, $error_message ){
	global $graphene_defaults;
	if ( '0' === $input[$option_name] || ! empty($input[$option_name] ) ){
		if (!ctype_digit($input[$option_name])) {
			$input[$option_name] = $graphene_defaults[$option_name];
			add_settings_error('graphene_options', 2, $error_message);
		}
	} else {
		$input[$option_name] = $graphene_defaults[$option_name];
	}
	
	return $input;
}

function graphene_validate_dropdown( $input, $option_name, $possible_values, $error_message ){
	
	if (isset($input[$option_name]) && !in_array($input[$option_name], $possible_values)){
		unset($input[$option_name]);
		add_settings_error('graphene_options', 2, $error_message);
	}
	return $input;
	
}

function graphene_validate_url( $input, $option_name, $error_message ) {
	global $graphene_defaults;
	if (!empty($input[$option_name])){
		$input[$option_name] = esc_url_raw($input[$option_name]);
		if ($input[$option_name] == '') {
			$input[$option_name] = $graphene_defaults[$option_name];
			add_settings_error('graphene_options', 2, $error_message);
		}	
	}	
	return $input;
	
}
?>