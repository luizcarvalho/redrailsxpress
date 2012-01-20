<?php

// BREADCRUMB FUNCTION /////////////////////////////////////////////////////////////////////////////////////////////////////////////

function the_breadcrumb() {
	if (!is_home()) {	echo '<a href="';	echo get_option('home'); echo '">Home</a>';
		if (is_category() || is_single()) {	the_category(' '); 
		if (is_single()) { echo "<div>"; the_title(); echo "</div>"; } } 
		elseif (is_page()) { echo "<div>"; echo the_title(); echo "</div>";	}
		elseif (is_tag()) { echo "<div>"; single_tag_title(); echo "</div>"; }
		elseif (is_day()) { echo "<div>Archive for "; the_time('F jS, Y'); echo "</div>"; }
		elseif (is_month()) { echo "<div>Archive for "; the_time('F, Y'); echo "</div>"; }
		elseif (is_year()) { echo "<div>Archive for "; the_time('Y'); echo "</div>"; }
		elseif (is_author()) { echo "<div>Author Archive"; echo "</div>"; }
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<div>Blog Archives</div>"; }
		elseif (is_search()) { echo "<div>Search Results</div>"; }
	}
}

// REGISTER SIDEBARS & WIDGETS /////////////////////////////////////////////////////////////////////////////////////////////////////

if ( function_exists('register_sidebar') )
    register_sidebar(array(
				'name' => 'Sidebar',
        'before_widget' => '<div id="%1$s" class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="heading">',
        'after_title' => '</h2>',
    ));

if( function_exists( 'register_sidebar_widget' ) ) {
	register_sidebar_widget('Ad: BigBox','mb_bigbox');
	register_sidebar_widget('Ad: Buttons','mb_buttons');
	register_sidebar_widget('Blog Categories','mb_blog_categories');
	register_sidebar_widget('Recent Posts','mb_recent_posts');
	register_sidebar_widget('Twitter','mb_twitter');
}

function mb_bigbox() { include(TEMPLATEPATH . '/widgets/ad-bigbox.php'); }
function mb_buttons() {	include(TEMPLATEPATH . '/widgets/ad-buttons.php'); }
function mb_blog_categories() {	include(TEMPLATEPATH . '/widgets/blog-categories.php'); }
function mb_recent_posts() {include(TEMPLATEPATH . '/widgets/recent-posts.php'); }
function mb_twitter() {include(TEMPLATEPATH . '/widgets/twitter.php'); }

// POST CUSTOM FIELDS UI ///////////////////////////////////////////////////////////////////////////////////////////////////////////

$post_custom_fields =
array(
	"post_image" => array(
		"name" => "post_image",
		"std" => "",
		"title" => "Post Image Path (eg. /wp-content/uploads/thundercats.jpg):",
		"description" => ""
	),
	"feature_title" => array(
		"name" => "feature_title",
		"std" => "",
		"title" => "Feature Title:",
		"description" => ""
	),
	"feature_description" => array(
		"name" => "feature_description",
		"std" => "",
		"title" => "Feature Description:",
		"description" => ""
	),
	"feature_image" => array(
		"name" => "feature_image",
		"std" => "",
		"title" => "Feature Image 630x250 (eg. /wp-content/uploads/feature.jpg):",
		"description" => ""
	),
	"portfolio_client" => array(
		"name" => "portfolio_client",
		"std" => "",
		"title" => "Client:",
		"description" => ""
	),
	"portfolio_services" => array(
		"name" => "portfolio_services",
		"std" => "",
		"title" => "Services Provided:",
		"description" => ""
	),
	"portfolio_url" => array(
		"name" => "portfolio_url",
		"std" => "",
		"title" => "Website URL:",
		"description" => ""
	),
	"portfolio_screenshot_1" => array(
		"name" => "portfolio_screenshot_1",
		"std" => "",
		"title" => "Screenshot 1 (eg. /wp-content/uploads/screenshot-1.jpg):",
		"description" => ""
	),
	"portfolio_screenshot_2" => array(
		"name" => "portfolio_screenshot_2",
		"std" => "",
		"title" => "Screenshot 2 (eg. /wp-content/uploads/screenshot-2.jpg):",
		"description" => ""
	),
	"portfolio_screenshot_3" => array(
		"name" => "portfolio_screenshot_3",
		"std" => "",
		"title" => "Screenshot 3 (eg. /wp-content/uploads/screenshot-3.jpg):",
		"description" => ""
	),
	"portfolio_screenshot_4" => array(
		"name" => "portfolio_screenshot_4",
		"std" => "",
		"title" => "Screenshot 4 (eg. /wp-content/uploads/screenshot-4.jpg):",
		"description" => ""
	),
	"portfolio_screenshot_5" => array(
		"name" => "portfolio_screenshot_5",
		"std" => "",
		"title" => "Screenshot 5 (eg. /wp-content/uploads/screenshot-5.jpg):",
		"description" => ""
	)
);

function post_custom_fields() {
	global $post, $post_custom_fields;

	foreach($post_custom_fields as $meta_box) {
		$meta_box_value = stripslashes(get_post_meta($post->ID, $meta_box['name'].'_value', true));

		if($meta_box_value == "")
			$meta_box_value = $meta_box['std'];

			echo '<p style="margin-bottom:10px;">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			echo'<strong>'.$meta_box['title'].'</strong>';
			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.attribute_escape($meta_box_value).'" style="width:98%;" /><br />';
			echo '</p>';
	}
}

function create_meta_box() {
	global $theme_name;
		if ( function_exists('add_meta_box') ) {
			add_meta_box( 'new-meta-boxes', 'Additional Information', 'post_custom_fields', 'post', 'normal', 'high' );
	}
}

function save_postdata( $post_id ) {
	global $post, $post_custom_fields;

	foreach($post_custom_fields as $meta_box) {
		// Verify
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
			return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
	}

	$data = $_POST[$meta_box['name'].'_value'];

	if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
		add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
	elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
		update_post_meta($post_id, $meta_box['name'].'_value', $data);
	elseif($data == "")
		delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	}
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

// THEME SETTINGS PANEL ////////////////////////////////////////////////////////////////////////////////////////////////////////////

$themename = "Spectre";
$shortname = "mb";
$path = get_bloginfo('template_directory');
$options = array (

		array(  "name" => "Style Preferences",
            "id" => $shortname."_style_prefs",
            "std" => "",
            "type" => "heading"),

		array(  "name" => "Style",
						"id" => $shortname."_style",
						"std" => "blue",
						"type" => "select",
						"options" => array("blue","brown","grey"),),

		array(  "name" => "Logo Image Path",
	          "id" => $shortname."_logo_image",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Logo Image Width",
	          "id" => $shortname."_logo_width",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Logo Image Height",
	          "id" => $shortname."_logo_height",
	          "std" => "",
	          "type" => "text"),
	
		array(	"name"	=>"Disable Image Resizing",
						"id"	=>	$shortname . "_resize",
						"std"	=>	"",
						"status" => 'checked',
						"type"	=>	"checkbox"),
						
		array(  "name" => "Miscellaneous Settings",
            "id" => $shortname."_misc",
            "std" => "",
            "type" => "heading"),

		array(  "name" => "Currently Booking For",
	          "id" => $shortname."_availability",
	          "std" => "",
	          "type" => "text"),
	
		array(	"name"	=>	"This is a Business Site",
						"id"	=>	$shortname . "_business",
						"std"	=>	"",
						"status" => 'checked',
						"type"	=>	"checkbox"),
	
		array(  "name" => "Portfolio Category ID",
	          "id" => $shortname."_portfolio",
	          "std" => "",
	          "type" => "text"),
	
		array(	"name"	=> "Link to Original Screenshots",
						"id"	=>	$shortname . "_portfolio_original",
						"std"	=>	"",
						"status" => 'checked',
						"type"	=>	"checkbox"),
	
		array(  "name" => "Blog Category ID",
	          "id" => $shortname."_blog",
	          "std" => "",
	          "type" => "text"),
	
		array(  "name" => "Posts Per Column on Homepage",
	          "id" => $shortname."_blog_home",
	          "std" => "2",
	          "type" => "text"),
	
		array(	"name"	=> "Show Author on Blog Posts",
						"id"	=>	$shortname . "_blog_author",
						"std"	=>	"",
						"status" => 'checked',
						"type"	=>	"checkbox"),
	
		array(	"name"	=> "Show Full Posts on Blog Page",
						"id"	=>	$shortname . "_blog_full",
						"std"	=>	"",
						"status" => 'checked',
						"type"	=>	"checkbox"),
	
		array(  "name" => "Featured Category ID",
	          "id" => $shortname."_featured",
	          "std" => "",
	          "type" => "text"),
	
		array(  "name" => "Exclude Page IDs from Nav",
	          "id" => $shortname."_exclude_pages",
	          "std" => "",
	          "type" => "text"),	

		array(  "name" => "About Page Path",
		        "id" => $shortname."_about_path",
		        "std" => "/about",
		        "type" => "text"),			

		array(  "name" => "Contact Page Path",
		        "id" => $shortname."_contact_path",
		        "std" => "/contact",
		        "type" => "text"),
	
		array(  "name" => "Twitter Profile URL",
	          "id" => $shortname."_social_twitter",
	          "std" => "",
	          "type" => "text"),
	
		array(  "name" => "RSS Feed Replacement URL",
	          "id" => $shortname."_subscribe_feed",
	          "std" => "",
	          "type" => "text"),
	
		array(  "name" => "Email Subscription URL",
	          "id" => $shortname."_subscribe_email",
	          "std" => "",
	          "type" => "text"),																							

		array(  "name" => "&lsaquo;head&rsaquo; Include Code",
	          "id" => $shortname."_head_include",
	          "std" => "",
	          "type" => "textarea"),
	
		array(  "name" => "Footer Include Code",
	          "id" => $shortname."_footer_include",
	          "std" => "",
	          "type" => "textarea"),
						
		array(  "name" => "Homepage Points",
            "id" => $shortname."_homepage_points",
            "std" => "",
            "type" => "heading"),
	
		array(  "name" => "Point 1 Title",
	          "id" => $shortname."_point1_title",
	          "std" => "",
	          "type" => "text"),		

		array(  "name" => "Point 1 Description",
		        "id" => $shortname."_point1_desc",
		        "std" => "",
		        "type" => "textarea"),	
	
		array(  "name" => "Point 2 Title",
	          "id" => $shortname."_point2_title",
	          "std" => "",
	          "type" => "text"),		

		array(  "name" => "Point 2 Description",
		        "id" => $shortname."_point2_desc",
		        "std" => "",
		        "type" => "textarea"),
	
		array(  "name" => "Point 3 Title",
	          "id" => $shortname."_point3_title",
	          "std" => "",
	          "type" => "text"),		

		array(  "name" => "Point 3 Description",
		        "id" => $shortname."_point3_desc",
		        "std" => "",
		        "type" => "textarea"),		

		array(  "name" => "Ad Management",
            "id" => $shortname."_ad_management",
            "std" => "",
            "type" => "heading"),

		array(  "name" => "Bigbox (300x250)",
            "id" => $shortname."_bigbox",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Button 1 (125x125)",
            "id" => $shortname."_button_1",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Button 2 (125x125)",
            "id" => $shortname."_button_2",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Button 3 (125x125)",
            "id" => $shortname."_button_3",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Button 4 (125x125)",
            "id" => $shortname."_button_4",
            "std" => "",
            "type" => "textarea")

);

function mb_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { 
											if( $value['type'] == 'checkbox' ) {
												if( $value['status'] == 'checked' ) {
													update_option( $value['id'], 1 );
												} else { 
													update_option( $value['id'], 0 ); 
												}	
											} elseif( $value['type'] != 'checkbox' ) {
												update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
											} else { 
												update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
											}
										}
									}

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Settings", "Theme Settings", 'edit_themes', basename(__FILE__), 'mb_admin');

}

function mb_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> Settings</h2>

<form method="post">

	<p class="submit" style="margin:-15px 0 -10px;">
		<input name="save" type="submit" value="Save Changes" class="button" />    
		<input type="hidden" name="action" value="save" />
	</p>

	<table class="form-table">

	<?php foreach ($options as $value) {     
	if ($value['type'] == "text") { ?>
        
	<tr valign="top"> 
	    <th scope="row"><?php echo $value['name']; ?>:</th>
	    <td>
	        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes (get_settings( $value['id'] )); } else { echo $value['std']; } ?>" size="40" />
	    </td>
	</tr>

	<?php } elseif ($value['type'] == "textarea") { ?>

	    <tr valign="top"> 
	        <th scope="row"><?php echo $value['name']; ?>:</th>
	        <td>
	            <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" rows="5" cols="70"><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes (get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea>
	        </td>
	    </tr>
	
	<?php } elseif ($value['type'] == "checkbox") { ?>

	    <tr valign="top"> 
	        <th scope="row"><?php echo $value['name']; ?>:</th>
	        <td>
							<?php
								if ( get_option( $value['id'] ) != "" ) { 
									$status= get_option( $value['id'] );
								} else { 
									$status= $value['std']; 
								}
							?>
	            <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" <?php if( $status == 1 ) { echo 'checked'; } ?>/>
	        </td>
	    </tr>

	<?php } elseif ($value['type'] == "select") { ?>

	    <tr valign="top"> 
	        <th scope="row"><?php echo $value['name']; ?>:</th>
	        <td>
	            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	                <?php foreach ($value['options'] as $option) { ?>
	                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
	                <?php } ?>
	            </select>
	        </td>
	    </tr>

		<?php } elseif ($value['type'] == "heading") { ?>

		    <tr valign="top"> 
		        <td colspan="2">
		            <h2 style="font-size:1.8em;"><?php echo $value['name']; ?></h2>
		        </td>
		    </tr>

	<?php 
		} 
	}
	?>

	</table>

	<p class="submit">
		<input name="save" type="submit" value="Save Changes" class="button-primary" />    
		<input type="hidden" name="action" value="save" />
	</p>
</form>

<?php
}

function mb_wp_head() {
	$mb_head_include= get_option( 'mb_head_include' ); 
	echo $mb_head_include;
	global $options;
	foreach ( $options as $value ) {
	    if ( get_settings( $value['id'] ) === FALSE ) { 
			$$value['id'] = $value['std']; 
		} else { 
			$$value['id'] = get_settings( $value['id'] ); 
		} 
	}
}

add_action('wp_head', 'mb_wp_head');
add_action('admin_menu', 'mb_add_admin');	

?>