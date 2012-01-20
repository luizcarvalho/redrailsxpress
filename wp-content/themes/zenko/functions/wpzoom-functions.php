<?php

/* 
Function Name: getCategories 
Version: 1.0 
Description: Gets the list of categories. Represents a workaround for the get_categories bug in WP 2.8 
Author: Dumitru Brinzan
Author URI: http://www.brinzan.net 
*/ 

function getCategories($parent) {
    global $wpdb, $table_prefix;

    $tb1 = "$table_prefix"."terms";
    $tb2 = "$table_prefix"."term_taxonomy";

    if ($parent == '1') {
        $qqq = "AND $tb2".".parent = 0";
    } else {
        $qqq = "";
    }

    $q = "SELECT $tb1.term_id,$tb1.name,$tb1.slug FROM $tb1,$tb2 WHERE $tb1.term_id = $tb2.term_id AND $tb2.taxonomy = 'category' $qqq AND $tb2.count > 0 ORDER BY $tb1.name ASC";
    $q = $wpdb->get_results($q);

    foreach ($q as $cat) {
        $categories[$cat->term_id] = $cat->name;
    } // foreach

    return($categories);
} // end func

/* 
Function Name: getPages 
Version: 1.0 
Description: Gets the list of pages. Represents a workaround for the get_categories bug in WP 2.8 
Author: Dumitru Brinzan
Author URI: http://www.brinzan.net 
*/ 

function getPages() {
    global $wpdb, $table_prefix;

    $tb1 = "$table_prefix"."posts";

    $q = "SELECT $tb1.ID,$tb1.post_title FROM $tb1 WHERE $tb1.post_type = 'page' AND $tb1.post_status = 'publish' ORDER BY $tb1.post_title ASC";
    $q = $wpdb->get_results($q);

    foreach ($q as $pag) {
        $pages[$pag->ID] = $pag->post_title;
    } // foreach
    return($pages);
} // end func

 
 
/*this function controls the meta titles display*/
function wpzoom_titles() {
	global $shortname;
	
	#if the title is being displayed on the homepage
	if (is_home()) {
 
			if (get_option('wpzoom_seo_home_title') == 'Site Title - Site Description') echo get_bloginfo('name').get_option('wpzoom_title_separator').get_bloginfo('description'); 
			if ( get_option('wpzoom_seo_home_title') == 'Site Description - Site Title') echo get_bloginfo('description').get_option('wpzoom_title_separator').get_bloginfo('name');
			if ( get_option('wpzoom_seo_home_title') == 'Site Title') echo get_bloginfo('name');
 	}
	#if the title is being displayed on single posts/pages
	if (is_single() || is_page()) { 

			if (get_option('wpzoom_seo_posts_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('wpzoom_title_separator').wp_title('',false,''); 
			if ( get_option('wpzoom_seo_posts_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('wpzoom_title_separator').get_bloginfo('name');
			if ( get_option('wpzoom_seo_posts_title') == 'Page Title') echo wp_title('',false,'');
					
	}
	#if the title is being displayed on index pages (categories/archives/search results)
	if (is_category() || is_archive() || is_search()) { 
		if (get_option('wpzoom_seo_pages_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('wpzoom_title_separator').wp_title('',false,''); 
		if ( get_option('wpzoom_seo_pages_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('wpzoom_title_separator').get_bloginfo('name');
		if ( get_option('wpzoom_seo_pages_title') == 'Page Title') echo wp_title('',false,'');
		 }	  
} 

 
function wpzoom_index(){
		global $post;
		global $wpdb;
		if(!empty($post)){
			$post_id = $post->ID;
		}
 
		/* Robots */	
		$index = 'index';
		$follow = 'follow';

		if ( is_tag() && get_option('wpzoom_index_tag') != 'index') { $index = 'noindex'; }
		elseif ( is_search() && get_option('wpzoom_index_search') != 'index' ) { $index = 'noindex'; }  
		elseif ( is_author() && get_option('wpzoom_index_author') != 'index') { $index = 'noindex'; }  
		elseif ( is_date() && get_option('wpzoom_index_date') != 'index') { $index = 'noindex'; }
		elseif ( is_category() && get_option('wpzoom_index_category') != 'index' ) { $index = 'noindex'; }
		echo '<meta name="robots" content="'. $index .', '. $follow .'" />' . "\n";
		
	}
	
function meta_post_keywords() {
	$posttags = get_the_tags();
	foreach((array)$posttags as $tag) {
		$meta_post_keywords .= $tag->name . ',';
	}
	echo '<meta name="keywords" content="'.$meta_post_keywords.'" />';
}


function meta_home_keywords() {
 global $wpzoom_meta_key;
 
 if (strlen($wpzoom_meta_key) > 1 ) {
  
 echo '<meta name="keywords" content="'.get_option('wpzoom_meta_key').'" />';
 
 }
}

function wpzoom_rss()
{	 global $wpzoom_misc_feedburner;
    if (strlen($wpzoom_misc_feedburner) < 1) {
        bloginfo('rss2_url');
    } else {
        echo $wpzoom_misc_feedburner;
    }
}

function wpzoom_js()
{
    $args = func_get_args();
    foreach ($args as $arg) {
        echo '<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/js/' . $arg . '.js"></script>' . "\n";
    }
}
 
/*this function controls canonical urls*/
function wpzoom_canonical() {
 	
 	if(get_option('wpzoom_canonical') == 'Yes' ) {
 	
	#homepage urls
	if (is_home() )echo '<link rel="canonical" href="'.get_bloginfo('url').'" />';
	
	#single page urls
	global $wp_query; 
	$postid = $wp_query->post->ID; 

	if (is_single() || is_page()) echo '<link rel="canonical" href="'.get_permalink().'" />';	
	
	
	#index page urls
	
		if (is_archive() || is_category() || is_search()) echo '<link rel="canonical" href="'.get_permalink().'" />';	
	}
}

 

/*
Plugin Name: Limit Posts
*/

function the_content_limitfy($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "<div>";
      echo $content;
      echo "</div>";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "<div>";
        echo $content;
        echo "...";
        echo "</div>";
   }
   else {
      echo "<div>";
      echo $content;
      echo "</div>";
   }
}

				
function wpzoom_wpmu ($img) {
	global $blog_id;
  $imageParts = explode('/files/', $img);
	if (isset($imageParts[1])) {
		$img = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
	}
	return($img);
}

function catch_that_image ($post_id=0, $width=60, $height=60, $img_script='') {
	global $wpdb;
	if($post_id > 0) {
	
	

		 // select the post content from the db

		 $sql = 'SELECT post_content FROM ' . $wpdb->posts . ' WHERE id = ' . $wpdb->escape($post_id);
		 $row = $wpdb->get_row($sql);
		 $the_content = $row->post_content;
		 if(strlen($the_content)) {

			  // use regex to find the src of the image

			preg_match("/<img src\=('|\")(.*)('|\") .*( |)\/>/", $the_content, $matches);
			if(!$matches) {
				preg_match("/<img class\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
			}
      if(!$matches) {
				preg_match("/<img class\=\".*\" title\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
			}
			
			$the_image = '';
			$the_image_src = $matches[2];
			$frags = preg_split("/(\"|')/", $the_image_src);
			if(count($frags)) {
				$the_image_src = $frags[0];
			}
 			
		  // if src found, then create a new img tag

			  if(strlen($the_image_src)) {
				   if(strlen($img_script)) {

					    // if the src starts with http/https, then strip out server name

					    if(preg_match("/^(http(|s):\/\/)/", $the_image_src)) {
						     $the_image_src = preg_replace("/^(http(|s):\/\/)/", '', $the_image_src);
						     $frags = split("\/", $the_image_src);
						     array_shift($frags);
						     $the_image_src = '/' . join("/", $frags);
					    }
					    $the_image = '<img alt="" src="' . $img_script . $the_image_src . '" />';
				   }
				   else {
					    $the_image = '<img alt="" src="' . $the_image_src . '" width="' . $width . '" height="' . $height . '" />';
				   }
			  }
			  return $the_image_src;
		 }
	}
}

// Register sidebar widgets.
register_sidebar_widget( __('Search'), 'bf_widget_search' );

/**
 * Replaces the default search widget.
 */
function bf_widget_search($args) {
	extract($args, EXTR_SKIP);
?>
<?php echo $before_widget; ?>
<?php echo $before_title . 'Search' . $after_title; ?>
<form method="get" id="widgetsearch" action="<?php bloginfo('url'); ?>/">
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="30" onfocus="this.value=''" class="text" />
	<input type="submit" id="searchsubmit" class="submit" value="<?php _e('Search', 'wpzoom') ?>" />
</form>
<?php echo $after_widget; ?>
<?php
}
/*
Plugin Name: Quick Flickr Widget
Plugin URI: http://kovshenin.com/wordpress/plugins/quick-flickr-widget/
Modified for WPZOOM by Dumitru Brinzan
*/

$flickr_api_key = "d348e6e1216a46f2a4c9e28f93d75a48"; // You can use your own if you like

function widget_quickflickr($args) {
	extract($args);
	
	$options = get_option("widget_quickflickr");
	if( $options == false ) {
		$options["title"] = "Flickr Photos";
		$options["rss"] = "";
		$options["items"] = 3;
		$options["target"] = "";
		$options["username"] = "";
		$options["user_id"] = "";
		$options["error"] = "";
	}
	
	$title = $options["title"];
	$items = $options["items"];
	$view = "_s";
	$before_item = "<li>";
	$after_item = "</li>";
	$before_flickr_widget = "<ul class=\"gallery\">";
	$after_flickr_widget = "</ul>";
	$more_title = $options["more_title"];
	$target = $options["target"];
	$username = $options["username"];
	$user_id = $options["user_id"];
	$error = $options["error"];
	$rss = $options["rss"];
	
	if (empty($error))
	{	
		$target = ($target == "checked") ? "target=\"_blank\"" : "";
		
		$flickrformat = "php";
		
		if (empty($items) || $items < 1 || $items > 20) $items = 3;
		
		// Screen name or RSS in $username?
		if (!ereg("http://api.flickr.com/services/feeds", $username))
			$url = "http://api.flickr.com/services/feeds/photos_public.gne?id=".urlencode($user_id)."&format=".$flickrformat."&lang=en-us".$tags;
		else
			$url = $username."&format=".$flickrformat.$tags;
		
      eval("?>". file_get_contents($url) . "<?");
			$photos = $feed;

			if ($photos)
			{
			 $out .= $before_flickr_widget;
				
        foreach($photos["items"] as $key => $value)
				{
				
					if (--$items < 0) break;
					
					$photo_title = $value["title"];
					$photo_link = $value["url"];
					ereg("<img[^>]* src=\"([^\"]*)\"[^>]*>", $value["description"], $regs);
					$photo_url = $regs[1];
					
					//$photo_url = $value["media"]["m"];
					$photo_medium_url = str_replace("_m.jpg", ".jpg", $photo_url);
					$photo_url = str_replace("_m.jpg", "$view.jpg", $photo_url);
					
//					$photo_title = ($show_titles) ? "<div class=\"qflickr-title\">$photo_title</div>" : "";
					$out .= $before_item . "<a $target href=\"$photo_link\"><img class=\"flickr_photo\" alt=\"$photo_title\" title=\"$photo_title\" src=\"$photo_url\" /></a>" . $after_item;

				}
				$flickr_home = $photos["url"];
				$out .= $after_flickr_widget;
			}
			else
			{
				$out = "Something went wrong with the Flickr feed! Please check your configuration and make sure that the Flickr username or RSS feed exists";
			}

		?>
<!-- Quick Flickr start -->
	<?php echo $before_widget; ?>
		<?php if(!empty($title)) { $title = apply_filters('localization', $title); echo $before_title . $title . $after_title; } ?>
		<?php echo $out ?>
		<?php if (!empty($more_title) && !$javascript) echo "<a href=\"" . strip_tags($flickr_home) . "\">$more_title</a>"; ?>
	<?php echo $after_widget; ?>
<!-- Quick Flickr end -->
	<?php
	}
	else // error
	{
		$out = $error;
	}
}

function widget_quickflickr_control() {
	$options = $newoptions = get_option("widget_quickflickr");
	if( $options == false ) {
		$newoptions["title"] = "Flickr photostream";
		$newoptions["error"] = "Your Quick Flickr Widget needs to be configured";
	}
	if ( $_POST["flickr-submit"] ) {
		$newoptions["title"] = strip_tags(stripslashes($_POST["flickr-title"]));
		$newoptions["items"] = strip_tags(stripslashes($_POST["rss-items"]));
		$newoptions["more_title"] = strip_tags(stripslashes($_POST["flickr-more-title"]));
		$newoptions["target"] = strip_tags(stripslashes($_POST["flickr-target"]));
		$newoptions["username"] = strip_tags(stripslashes($_POST["flickr-username"]));
		
		if (!empty($newoptions["username"]) && $newoptions["username"] != $options["username"])
		{
			if (!ereg("http://api.flickr.com/services/feeds", $newoptions["username"])) // Not a feed
			{
				global $flickr_api_key;
				$str = @file_get_contents("http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=".$flickr_api_key."&username=".urlencode($newoptions["username"])."&format=rest");
				ereg("<rsp stat=\\\"([A-Za-z]+)\\\"", $str, $regs); $findByUsername["stat"] = $regs[1];

				if ($findByUsername["stat"] == "ok")
				{
					ereg("<username>(.+)</username>", $str, $regs);
					$findByUsername["username"] = $regs[1];
					
					ereg("<user id=\\\"(.+)\\\" nsid=\\\"(.+)\\\">", $str, $regs);
					$findByUsername["user"]["id"] = $regs[1];
					$findByUsername["user"]["nsid"] = $regs[2];
					
					$flickr_id = $findByUsername["user"]["nsid"];
					$newoptions["error"] = "";
				}
				else
				{
					$flickr_id = "";
					$newoptions["username"] = ""; // reset
					
					ereg("<err code=\\\"(.+)\\\" msg=\\\"(.+)\\\"", $str, $regs);
					$findByUsername["message"] = $regs[2] . "(" . $regs[1] . ")";
					
					$newoptions["error"] = "Flickr API call failed! (findByUsername returned: ".$findByUsername["message"].")";
				}
				$newoptions["user_id"] = $flickr_id;
			}
			else
			{
				$newoptions["error"] = "";
			}
		}
		elseif (empty($newoptions["username"]))
			$newoptions["error"] = "Flickr RSS or Screen name empty. Please reconfigure.";
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option("widget_quickflickr", $options);
	}
	$title = wp_specialchars($options["title"]);
	$items = wp_specialchars($options["items"]);
	if ( empty($items) || $items < 1 ) $items = 3;
	
	$more_title = wp_specialchars($options["more_title"]);
	
	$target = wp_specialchars($options["target"]);
	$flickr_username = wp_specialchars($options["username"]);
	
	?>
	<p><label for="flickr-title"><?php _e("Title:"); ?> <input class="widefat" id="flickr-title" name="flickr-title" type="text" value="<?php echo $title; ?>" /></label></p>
	<p><label for="flickr-username"><?php _e("Flickr RSS URL or Screen name:"); ?> <input class="widefat" id="flickr-username" name="flickr-username" type="text" value="<?php echo $flickr_username; ?>" /></label></p>
	<p><label for="flickr-items"><?php _e("How many items?"); ?> <select class="widefat" id="rss-items" name="rss-items"><?php for ( $i = 1; $i <= 20; ++$i ) echo "<option value=\"$i\" ".($items==$i ? "selected=\"selected\"" : "").">$i</option>"; ?></select></label></p>
	<p><label for="flickr-more-title"><?php _e("More link anchor text:"); ?> <input class="widefat" id="flickr-more-title" name="flickr-more-title" type="text" value="<?php echo $more_title; ?>" /></label></p>
	<p><label for="flickr-target"><input id="flickr-target" name="flickr-target" type="checkbox" value="checked" <?php echo $target; ?> /> <?php _e("Target: _blank"); ?></label></p>
	<input type="hidden" id="flickr-submit" name="flickr-submit" value="1" />
	<?php
}




/* 
Recent Comments http://mtdewvirus.com/code/wordpress-plugins/ 
*/ 

function dp_recent_comments($no_comments = 10, $comment_len = 90) { 
    global $wpdb; 
	
	$request = "SELECT * FROM $wpdb->comments";
	$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
	$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password ='' AND comment_type = ''"; 
	$request .= " ORDER BY comment_date DESC LIMIT $no_comments"; 
		
	$comments = $wpdb->get_results($request);
		
	if ($comments) { 
		foreach ($comments as $comment) { 
			ob_start();
			?>
				<li>
					<div class="tab-comments-avatar"><?php echo get_avatar($comment,$size='40' ); ?></div>
					<div class="tab-comments-text">
						<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo dp_get_author($comment); ?>:</a>
						<?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?>...
					</div>
				</li>
			<?php
			ob_end_flush();
		} 
	} else { 
		echo "<li>No comments</li>";
	}
}

function dp_get_author($comment) {
	$author = "";

	if ( empty($comment->comment_author) )
		$author = __('Anonymous');
	else
		$author = $comment->comment_author;
		
	return $author;
}

 
	
	
/* Recent Comments Widget
-----------------------------*/	

function recent_comments() {

	 
	$settings = get_option( 'widget_recent_comments' );  
	

 
?>
<div class="widget">
	<?php if ($settings[ 'title_comments' ] != '') echo"<h3>$settings[title_comments]</h3>"; ?>
			<ul id="tab-comments">
			<?php dp_recent_comments($settings['number_comments']); ?>
			</ul>
		</div>
<?php

}

function recent_comments_admin() {
	
	$settings = get_option( 'widget_recent_comments' );
	 
	if( isset( $_POST[ 'update_recent_comments' ] ) ) {
			$settings[ 'title_comments' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_comments_title_comments' ] ) );
			$settings[ 'number_comments' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_comments_number_comments' ] ) );
			update_option( 'widget_recent_comments', $settings );
		}
	
	 
?>	
	<p>
		<label for="widget_recent_comments_title_comments">Title</label><br />
		<input type="text" id="widget_recent_comments_title_comments" name="widget_recent_comments_title_comments" value="<?php echo $settings['title_comments']; ?>" />
	</p>
	
	<p>
		<label for="widget_recent_comments_number_comments">Number of comments</label><br />
		<input type="text" id="widget_recent_comments_number_comments" name="widget_recent_comments_number_comments" value="<?php echo $settings['number_comments']; ?>" />
	</p>
	
<input type="hidden" id="update_recent_comments" name="update_recent_comments" value="1" />
<?php }
 

/* 
Recent News Widget
*/	

function recent_news() {

	$settings = get_option( 'widget_recent_news' );  
	$number = $settings[ 'number' ];
	
	
	if (!$number) {$number = 5;}
	
 
?>

<div id="recent" class="widget">
	<?php if ($settings[ 'title_recent' ] != '') { echo"<h3>$settings[title_recent]</h3>"; } else {echo"<h3>Latest News</h3>";} ?>		<ul>
			
			<?php
				$recent = new WP_Query( 'caller_get_posts=1&showposts=' . $number );
				while( $recent->have_posts() ) : $recent->the_post(); 
					global $post; global $wp_query;
			?>
	<li>
		 <div class="bubble"><?php comments_popup_link('0', '1', '%'); ?></div>
		 
			 <?php unset($img); 
		if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
		$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
		$img = $thumbURL[0];  }
		else { 
			unset($img);
			if ($wpzoom_cf_use == 'Yes')  { $img = get_post_meta($post->ID, $wpzoom_cf_photo, true); }
		else {  
			if (!$img)  {  $img = catch_that_image($post->ID);  } }
		}
		if ($img) { $img = wpzoom_wpmu($img); ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=65&amp;h=50&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
			

			 
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
			<small> <?php _e('in', 'wpzoom');?> <?php the_category(', ') ?><br /> <?php _e('at', 'wpzoom');?> <?php the_time('F jS, Y') ?></small>
			</li>
			 
			<?php
				endwhile;
			?>
			</ul>
		</div>
	  
<?php

}

function recent_news_admin() {
	
	$settings = get_option( 'widget_recent_news' );

	if( isset( $_POST[ 'update_recent_news' ] ) ) {
		$settings[ 'title_recent' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_news_title_recent' ] ) );
		$settings[ 'number' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_news_number' ] ) );
		update_option( 'widget_recent_news', $settings );
	}
?>
	<p>
		<label for="widget_recent_news_title_recent">Title</label><br />
		<input type="text" id="widget_recent_news_title_recent" name="widget_recent_news_title_recent" value="<?php echo $settings['title_recent']; ?>" size="40" /><br />
		
		
		<label for="widget_recent_news_number">How many items would you like to display?</label><br />
		<select id="widget_recent_news_number" name="widget_recent_news_number">
			<?php
				$settings = get_option( 'widget_recent_news' );  
				$number = $settings[ 'number' ];
				
				$numbers = array( "1", "2", "3", "4", "5", "6", "7", "8", "9", "10" );
				foreach ($numbers as $num ) {
					$option = '<option value="' . $num . '" ' . ( $number == $num? " selected=\"selected\"" : "") . '>';
						$option .= $num;
					$option .= '</option>';
					echo $option;
				}
			?>
		</select>
	</p>
		<input type="hidden" id="update_recent_news" name="update_recent_news" value="1" />

<?php  }

/* Popular News
----------------------*/	

function zenko_popular ($args) { 
 
		extract($args);
 
		// Extract widget options
		$options = get_option('zenko_popular');
		$title = $options['title'];
		$maxposts = $options['maxposts'];
		$timeline = $options['sincewhen'];
		 
 
 
		if (!$title) {$title = '<h3>Popular Articles</h3>';}
		if (!$maxposts) {$maxposts = 5;}
		if (!$timeline) {$timeline = 'thisyear';}
		
		
		// Generate output
		echo $before_widget . $before_title . $title . $after_title;
		echo "<ul class='mcplist'>\n";
		
		// Since we're passing a SQL statement, globalise the $wpdb var
		global $wpdb;
		$sql = "SELECT ID, post_title, comment_count FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ";
        
		// What's the chosen timeline?
		switch ($timeline) {
			case "thismonth":
				$sql .= "AND Unix_Timestamp(post_date) >= (Unix_Timestamp(NOW()) - 2419200) AND YEAR(post_date) = YEAR(NOW()) ";
				break;
			case "thisyear":
				$sql .= "AND YEAR(post_date) = YEAR(NOW()) ";
				break;
			default:
				$sql .= "";
		}
		
		// Make sure only integers are entered
		if (!ctype_digit($maxposts)) {
			$maxposts = 10;
		} else {
			// Reformat the submitted text value into an integer
			$maxposts = $maxposts + 0;
			// Only accept sane values
			if ($maxposts <= 0 or $maxposts > 10) {
				$maxposts = 10;
			}
		}
 		// Complete the SQL statement
		$sql .= "AND comment_count > 0 ORDER BY comment_count DESC LIMIT ". $maxposts;
		
		$res = $wpdb->get_results($sql);
		
		if($res) {
			$mcpcounter = 1;
			foreach ($res as $r) {
				echo "<li class='mcpitem mcpitem-$mcpcounter'><a href='".get_permalink($r->ID)."' rel='bookmark'>".htmlspecialchars($r->post_title, ENT_QUOTES)."</a> <span class='mcpctr'>(".htmlspecialchars($r->comment_count, ENT_QUOTES).")</span></li>\n";
				$mcpcounter++;
			}
		} else {
			echo "<li class='mcpitem mcpitem-0'>". __('No commented posts yet') . "</li>\n";
		}
		
		echo "</ul>\n";
		echo $after_widget;
	} 


function zenko_popular_admin() {
	
// Get our options and see if we're handling a form submission.
		$options = get_option('zenko_popular');
		if ( !is_array($options) )
			$options = array(
				'title'=>__('Popular Posts'),
				'sincewhen' => 'forever',
				'maxposts'=> 10
			);
		if ( $_POST['htnetmcp-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['htnetmcp-title']));
			$options['sincewhen'] = strip_tags(stripslashes($_POST['htnetmcp-sincewhen']));
			$options['maxposts'] = strip_tags(stripslashes($_POST['htnetmcp-maxposts']));
			update_option('zenko_popular', $options);
		}

		// Be sure you format your options to be valid HTML attributes.
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$sincewhen = htmlspecialchars($options['sincewhen'], ENT_QUOTES);
		$maxposts = htmlspecialchars($options['maxposts'], ENT_QUOTES);
		
		// Here is our little form segment. Notice that we don't need a
		// complete form. This will be embedded into the existing form.
		echo '<p style="text-align:center;"><label for="htnetmcp-title">' . __('Title:') . ' <input style="width: 200px;" id="htnetmcp-title" name="htnetmcp-title" type="text" value="'.$title.'" /></label></p>';
		
		echo '<p style="text-align:center;"><label for="htnetmcp-sincewhen">' . __('Since:') 
			.'<select style="width: 120px;" id="htnetmcp-sincewhen" name="htnetmcp-sincewhen">';
		if ($sincewhen != 'thismonth' or $sincewhen != 'thisyear') {
			echo "<option value='forever' selected='selected'>".__('Forever')."</option>";
		} else {
			echo "<option value='forever'>".__('Forever')."</option>";
		}
		if ($sincewhen == 'thisyear') {
			echo "<option value='thisyear' selected='selected'>".__('This Year')."</option>";
		} else {
			echo "<option value='thisyear'>".__('This Year')."</option>";
		}
		if ($sincewhen == 'thismonth') {
			echo "<option value='thismonth' selected='selected'>".__('This Month')."</option>";
		} else {
			echo "<option value='thismonth'>".__('This Month')."</option>";
		}
		echo '</select></label></p>';
		
		echo '<p style="text-align:center;"><label for="htnetmcp-maxposts">' . __('Posts To Display:') 
			.'<select style="width: 120px;" id="htnetmcp-maxposts" name="htnetmcp-maxposts">';
		for ($mp = 1; $mp <= 10; $mp++) {
			if ($mp == $maxposts) {
				echo "<option selected='selected'>$mp</option>";
			} else {
				echo "<option>$mp</option>";
			}
		}
		echo '</select></label></p>';	
		echo '<input type="hidden" id="htnetmcp-submit" name="htnetmcp-submit" value="1" />';
	}

/* Subscribe to RSS Widget
-----------------------------*/	

function zenko_subscribe() {

	$settings = get_option( 'zenko_subscribe' );
 
?>
<div class="widget">
	<h3 class="pink"><img style="float:right; vertical-align:center;" src="<?php bloginfo('template_directory'); ?>/images/feed.png" alt="Subscribe to RSS" /><?php echo $settings['zenko_subscribe_title']; ?></h3>
			 <p>Subscribe to <a href="<?php bloginfo('rss2_url'); ?>">RSS</a> or enter you email to receive newsletter for news, articles, and updates about what's new. 

<form style="padding:10px;" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $settings['zenko_subscribe_id']; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
<input type="text"  onblur="if (this.value == '') {this.value = 'enter your email...';}" onfocus="if (this.value == 'enter your email...') {this.value = '';}" value="enter your email..." style="width:140px" name="email"/><input type="hidden" value="<?php echo $settings['zenko_subscribe_id']; ?>" name="uri"/>
<input type="hidden" name="loc" value="en_US"/><input type="submit" value="Subscribe" /></form>
     </p>
		</div>
<?php

}

function zenko_subscribe_admin() {

  	if( isset( $_POST[ 'update_zenko_subscribe' ] ) ) {
		$settings[ 'zenko_subscribe_id' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_id' ] ) );
		$settings[ 'zenko_subscribe_title' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_title' ] ) );
		update_option( 'zenko_subscribe', $settings ); }

	$settings = get_option( 'zenko_subscribe' );

?>
	<p>
		<label for="zenko_subscribe_title">Title</label><br />
		<input type="text" id="zenko_subscribe_title" name="zenko_subscribe_title" value="<?php echo $settings['zenko_subscribe_title']; ?>" />
	</p>
	
	<p>
		<label for="zenko_subscribe_id">FeedBurner Feed ID</label><br />
		<input type="text" id="zenko_subscribe_id" name="zenko_subscribe_id" value="<?php echo $settings['zenko_subscribe_id']; ?>" />
	</p>
 <input type="hidden" id="update_zenko_subscribe" name="update_zenko_subscribe" value="1" />
<?php
}

register_sidebar_widget( 'WPZOOM: Popular Posts', 'zenko_popular' );
register_widget_control( 'WPZOOM: Popular Posts', 'zenko_popular_admin', 300, 200 );
register_sidebar_widget( 'WPZOOM: Recent Comments', 'recent_comments' );
register_widget_control( 'WPZOOM: Recent Comments', 'recent_comments_admin', 300, 200 );
register_sidebar_widget( 'WPZOOM: Recent News', 'recent_news' );
register_widget_control( 'WPZOOM: Recent News', 'recent_news_admin', 300, 200 );
register_sidebar_widget( 'WPZOOM: Subscribe to RSS', 'zenko_subscribe' );
register_widget_control( 'WPZOOM: Subscribe to RSS', 'zenko_subscribe_admin', 300, 200 );
register_widget_control("WPZOOM: Flickr Photos", "widget_quickflickr_control");
register_sidebar_widget("WPZOOM: Flickr Photos", "widget_quickflickr");
   
?>