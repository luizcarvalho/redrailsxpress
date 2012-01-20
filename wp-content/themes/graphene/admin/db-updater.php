<?php 
/**
 * This script updates the theme's settings in the database to use the Settings API,
 * introduced in the theme since version 1.1.5
*/
function graphene_update_db(){
	global $graphene_defaults;
	
	// Get the current options from the database
	$graphene_settings['slider_cat'] = get_option('graphene_slider_cat');
	$graphene_settings['slider_postcount'] = get_option('graphene_slider_postcount');
	$graphene_settings['slider_img'] = (get_option('graphene_slider_img')) ? get_option('graphene_slider_img') : 'featured_image';
	$graphene_settings['slider_imgurl'] = get_option('graphene_slider_imgurl');
	$graphene_settings['slider_height'] = get_option('graphene_slider_height');
	$graphene_settings['slider_speed'] = get_option('graphene_slider_speed');
	$graphene_settings['slider_position'] = get_option('graphene_slider_position');
	$graphene_settings['slider_disable'] = get_option('graphene_slider_disable');
	
	$graphene_settings['frontpage_posts_cats'] = get_option('graphene_frontpage_posts_cats');
	
	$graphene_settings['custom_feed_url'] = get_option('graphene_custom_feed_url');
	$graphene_settings['hide_feed_icon'] = get_option('graphene_hide_feed_icon');
	
	$graphene_settings['show_adsense'] = get_option('graphene_show_adsense');
	$graphene_settings['adsense_code'] = get_option('graphene_adsense_code');
	$graphene_settings['adsense_show_frontpage'] = get_option('graphene_adsense_show_frontpage');
	
	$graphene_settings['show_addthis'] = get_option('graphene_show_addthis');
	$graphene_settings['show_addthis_page'] = get_option('graphene_show_addthis_page');
	$graphene_settings['addthis_code'] = get_option('graphene_addthis_code');
	
	$graphene_settings['show_ga'] = get_option('graphene_show_ga');
	$graphene_settings['ga_code'] = get_option('graphene_ga_code');
	
	$graphene_settings['alt_home_sidebar'] = get_option('graphene_alt_home_sidebar');
	$graphene_settings['alt_home_footerwidget'] = get_option('graphene_alt_home_footerwidget');
	
	$graphene_settings['show_cc'] = get_option('graphene_show_cc');
	$graphene_settings['copy_text'] = get_option('graphene_copy_text');
	$graphene_settings['hide_copyright'] = get_option('graphene_hide_copyright');
	
	$graphene_settings['light_header'] = get_option('graphene_light_header');
	$graphene_settings['link_header_img'] = get_option('graphene_link_header_img');
	$graphene_settings['featured_img_header'] = get_option('graphene_featured_img_header');
	$graphene_settings['use_random_header_img'] = get_option('graphene_use_random_header_img');
	$graphene_settings['hide_top_bar'] = get_option('graphene_hide_top_bar');
	$graphene_settings['hide_feed_icon'] = get_option('graphene_hide_feed_icon');
	$graphene_settings['search_box_location'] = get_option('graphene_search_box_location');
	
        if (get_option('graphene_hide_sidebar')) {
            $graphene_settings['column_mode'] = 'one-col';
        } else {
            $graphene_settings['column_mode'] = get_option('graphene_content_sidebar_position')  == 'left' ? 'two-col-right' : 'two-col-left';
        }
	
	$graphene_settings['posts_show_excerpt'] = get_option('graphene_posts_show_excerpt');
	$graphene_settings['hide_post_author'] = get_option('graphene_hide_post_author');
        
	if (get_option(graphene_hide_post_date)) { // hide the date
		$graphene_settings['post_date_display'] = 'hidden';
	} elseif (get_option('graphene_show_post_year')) { // show the date and the year
		$graphene_settings['post_date_display'] = 'icon_plus_year';
	} else { // show the date but not the year (default)
		$graphene_settings['post_date_display'] = 'icon_no_year';
	}
	
    $graphene_settings['hide_post_commentcount'] = get_option('graphene_hide_post_commentcount');
	$graphene_settings['hide_post_cat'] = get_option('graphene_hide_post_cat');
	$graphene_settings['hide_post_tags'] = get_option('graphene_hide_post_tags');
	$graphene_settings['show_post_avatar'] = get_option('graphene_show_post_avatar');
	$graphene_settings['show_post_author'] = get_option('graphene_show_post_author');
	$graphene_settings['show_excerpt_more'] = get_option('graphene_show_excerpt_more');
	
	$graphene_settings['footerwidget_column'] = get_option('graphene_footerwidget_column');
	$graphene_settings['alt_footerwidget_column'] = get_option('graphene_alt_footerwidget_column');
	
	$graphene_settings['navmenu_child_width'] = get_option('graphene_navmenu_child_width');
	
	$graphene_settings['header_title_font_type'] = get_option('graphene_header_title_font_type');
	$graphene_settings['header_title_font_size'] = get_option('graphene_header_title_font_size');
	$graphene_settings['header_title_font_lineheight'] = get_option('graphene_header_title_font_lineheight');
	$graphene_settings['header_title_font_weight'] = get_option('graphene_header_title_font_weight');
	$graphene_settings['header_title_font_style'] = get_option('graphene_header_title_font_style');
	
	$graphene_settings['header_desc_font_type'] = get_option('graphene_header_desc_font_type');
	$graphene_settings['header_desc_font_size'] = get_option('graphene_header_desc_font_size');
	$graphene_settings['header_desc_font_lineheight'] = get_option('graphene_header_desc_font_lineheight');
	$graphene_settings['header_desc_font_weight'] = get_option('graphene_header_desc_font_weight');
	$graphene_settings['header_desc_font_style'] = get_option('graphene_header_desc_font_style');
	
	$graphene_settings['content_font_type'] = get_option('graphene_content_font_type');
	$graphene_settings['content_font_size'] = get_option('graphene_content_font_size');
	$graphene_settings['content_font_lineheight'] = get_option('graphene_content_font_lineheight');
	$graphene_settings['content_font_colour'] = get_option('graphene_content_font_colour');
	
	$graphene_settings['link_colour_normal'] = get_option('graphene_link_colour_normal');
	$graphene_settings['link_colour_visited'] = get_option('graphene_link_colour_visited');
	$graphene_settings['link_colour_hover'] = get_option('graphene_link_colour_hover');
	$graphene_settings['link_decoration_normal'] = get_option('graphene_link_decoration_normal');
	$graphene_settings['link_decoration_hover'] = get_option('graphene_link_decoration_hover');
	
	$graphene_settings['hide_allowedtags'] = get_option('graphene_hide_allowedtags');
	$graphene_settings['custom_css'] = get_option('graphene_custom_css');
	
	/* Merge current settings with the default settings */
	$graphene_settings = array_merge($graphene_defaults, $graphene_settings);
	
	/* Update the database, and delete the old settings if update successful */
	if (update_option('graphene_settings', $graphene_settings)) {
		
		delete_option('graphene_light_header');	
		delete_option('graphene_link_header_img');	
		delete_option('graphene_featured_img_header');
		delete_option('graphene_use_random_header_img');
		delete_option('graphene_hide_top_bar');
		delete_option('graphene_hide_feed_icon');
		delete_option('graphene_search_box_location');
		delete_option('graphene_content_sidebar_position');
		delete_option('graphene_hide_sidebar');
		delete_option('graphene_posts_show_excerpt');
		delete_option('graphene_hide_post_author');
		delete_option('graphene_hide_post_date');
		delete_option('graphene_show_post_year');
		delete_option('graphene_hide_post_commentcount');
		delete_option('graphene_hide_post_cat');
		delete_option('graphene_hide_post_tags');
		delete_option('graphene_show_post_avatar');
		delete_option('graphene_show_post_author');
		delete_option('graphene_show_excerpt_more');
		delete_option('graphene_header_title_font_type');
		delete_option('graphene_header_title_font_size');
		delete_option('graphene_header_title_font_lineheight');
		delete_option('graphene_header_title_font_weight');
		delete_option('graphene_header_title_font_style');
		delete_option('graphene_header_desc_font_type');
		delete_option('graphene_header_desc_font_size');
		delete_option('graphene_header_desc_font_lineheight');
		delete_option('graphene_header_desc_font_weight');
		delete_option('graphene_header_desc_font_style');
		delete_option('graphene_content_font_type');
		delete_option('graphene_content_font_size');
		delete_option('graphene_content_font_lineheight');
		delete_option('graphene_content_font_colour');
		delete_option('graphene_link_colour_normal');
		delete_option('graphene_link_colour_visited');
		delete_option('graphene_link_colour_hover');
		delete_option('graphene_link_decoration_normal');
		delete_option('graphene_link_decoration_hover');
		delete_option('graphene_footerwidget_column');
		delete_option('graphene_alt_footerwidget_column');
		delete_option('graphene_navmenu_child_width');
		delete_option('graphene_hide_allowedtags');
		delete_option('graphene_swap_title');
		delete_option('graphene_custom_css');
		delete_option('graphene_slider_cat');
		delete_option('graphene_slider_postcount');
		delete_option('graphene_slider_img');
		delete_option('graphene_slider_imgurl');
		delete_option('graphene_slider_height');
		delete_option('graphene_slider_speed');
		delete_option('graphene_slider_position');
		delete_option('graphene_slider_disable');
		delete_option('graphene_frontpage_posts_cats');
		delete_option('graphene_custom_feed_url');
		delete_option('graphene_hide_feed_icon');
		delete_option('graphene_show_adsense');
		delete_option('graphene_adsense_code');
		delete_option('graphene_adsense_show_frontpage');
		delete_option('graphene_show_addthis');
		delete_option('graphene_show_addthis_page');
		delete_option('graphene_addthis_code');
		delete_option('graphene_show_ga');
		delete_option('graphene_ga_code');
		delete_option('graphene_alt_home_sidebar');
		delete_option('graphene_alt_home_footerwidget');
		delete_option('graphene_show_cc');
		delete_option('graphene_copy_text');
		delete_option('graphene_hide_copyright');
		
		return true;
		
	} else {
		return false;
	}
}
?>