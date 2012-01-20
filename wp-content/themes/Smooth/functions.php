<?php
//Theme Name
$themename = "Smooth Real Estate Theme";
//prefix 
$shortname = "theme_";
//Array
$options = array (
  array(
    "name" => "Videos urls",
    "id" => $shortname."_videosArray",
    "std" => "a:5:{s:10:\"url_video1\";a:3:{s:4:\"link\";s:1:\"#\";s:6:\"height\";i:250;s:5:\"width\";i:300;}s:10:\"url_video2\";a:3:{s:4:\"link\";s:1:\"#\";s:6:\"height\";i:250;s:5:\"width\";i:300;}s:10:\"url_video3\";a:3:{s:4:\"link\";s:1:\"#\";s:6:\"height\";i:250;s:5:\"width\";i:300;}s:10:\"url_video4\";a:3:{s:4:\"link\";s:1:\"#\";s:6:\"height\";i:250;s:5:\"width\";i:300;}s:10:\"url_video5\";a:3:{s:4:\"link\";s:1:\"#\";s:6:\"height\";i:250;s:5:\"width\";i:300;}}"),
  array(
    "name" => "Banners",
    "id" => $shortname."_bannersArray",
    "std" => "a:6:{s:13:\"theme_banner1\";a:5:{s:4:\"link\";s:1:\"#\";s:9:\"image_url\";s:0:\"\";s:6:\"height\";i:125;s:5:\"width\";i:125;s:6:\"status\";i:0;}s:13:\"theme_banner2\";a:5:{s:4:\"link\";s:1:\"#\";s:9:\"image_url\";s:0:\"\";s:6:\"height\";i:125;s:5:\"width\";i:125;s:6:\"status\";i:0;}s:13:\"theme_banner3\";a:5:{s:4:\"link\";s:1:\"#\";s:9:\"image_url\";s:0:\"\";s:6:\"height\";i:125;s:5:\"width\";i:125;s:6:\"status\";i:0;}s:13:\"theme_banner4\";a:5:{s:4:\"link\";s:1:\"#\";s:9:\"image_url\";s:0:\"\";s:6:\"height\";i:125;s:5:\"width\";i:125;s:6:\"status\";i:0;}s:13:\"theme_banner5\";a:6:{s:4:\"link\";s:1:\"#\";s:9:\"image_url\";s:0:\"\";s:6:\"height\";i:250;s:5:\"width\";i:300;s:6:\"status\";i:0;s:7:\"adsense\";s:0:\"\";}s:13:\"theme_banner6\";a:6:{s:4:\"link\";s:1:\"#\";s:9:\"image_url\";s:0:\"\";s:6:\"height\";i:60;s:5:\"width\";i:468;s:6:\"status\";i:0;s:7:\"adsense\";s:0:\"\";}}"
  ),
  array(
    "name" => "Styles",
    "id" => $shortname."_css",
    "std" => "style.css"
  ),
  array(
    "name" => "flickr",
    "id" => $shortname."_flickr",
    "std" => "a:4:{s:4:\"nsid\";s:0:\"\";s:7:\"display\";s:0:\"\";s:11:\"displayType\";s:0:\"\";s:4:\"tags\";s:0:\"\";}"
  ),
  array(
    "name" => "googleapi",
    "id" => $shortname."_googleapi",
    "std" => "a:2:{s:2:\"id\";s:0:\"\";s:3:\"num\";s:1:\"5\";}"
  ),
  array(
  	"name" => "googleapiSubmition",
  	"id" => $shortname."_googleapiSubmition",
  	"std" => ""
  ),
  array(
  	"name" => "BannersStatus",
  	"id" => $shortname."_bannerStatus",
  	"std" => "1"
  ),
  array(
  	"name" => "categoriesSubMenu",
  	"id" => $shortname."_categoriesSubmenu",
  	"std" => "a:0:{}"
  ),
  array(
  	"name" => "homePostCategory",
  	"id" => $shortname."_homePostCategory",
  	"std" => ""
  ),
  array(
  	"name" => "homeRandomPosts",
  	"id" => $shortname."_homeRandomPosts",
  	"std" => "1"
  ),
  array(
  	"name" => "randomCategoryPost",
  	"id" => $shortname."_randomCategoryPosts",
  	"std" => ""
  )
);
//Flickr display types
$flickrDisplayType = Array("square", "thumbnail", "small");

//Existing CSS Files
$cssFiles = get_availableCss();

function get_bannersSettings($bannerId, $index = FALSE){
  global $themename, $shortname, $options;
 $theBanners = get_settings($shortname."_bannersArray");
  if(!is_array($theBanners)){
  	$theBanners = unserialize($options[1]["std"]);
  }
  $theActualBanner = $theBanners[$bannerId];
  if($index != FALSE){
  	return $theActualBanner[$index];
  }else{
  	return $theActualBanner;
  }
}

function get_videoSettings($videoId, $index){
  global $themename, $shortname, $options;
  $theVideos = get_settings($shortname."_videosArray"); 
  if(!is_array($theVideos)){
		$theVideos = unserialize($options[0]["std"]);
  }
  $theActualVideo = $theVideos[$videoId];
  return $theActualVideo[$index];
}

function get_flickrSettings($index){
	global $themename, $shortname, $options;
	$theflickrSettings = get_settings($shortname."_flickr");
		if(!is_array($theflickrSettings)){
		$theflickrSettings = unserialize($options[3]["std"]);
  }
  return $theflickrSettings[$index];
}

function get_googleapi($index){
	global $themename, $shortname, $options;
	$thegoogleapiSettings = get_settings($shortname."_googleapi");
	if(!is_array($thegoogleapiSettings)){
		$thegoogleapiSettings = unserialize($options[4]["std"]);
	}
	return $thegoogleapiSettings[$index];
}
/*
Get Available CSS
*/
function get_availableCss(){
  $result = array();
  $dir = dir(TEMPLATEPATH."/");
  while (false !== ($file = $dir->read())) {
    if(ereg("\.css", $file, $r)){
    	$result[] = $file;
    }
  }
  $dir->close();
  return $result;
}
/*
Reset or Update Theme Options
*/
function newThemeOptions_add_admin() {
  global $themename, $shortname, $options, $cssFiles;
  if ( $_GET['page'] == basename(__FILE__) ) {
    if($_REQUEST['saveButton']){


      update_option( $shortname."_css", $_REQUEST[ $shortname."_css" ] );
      while(list($bannerId, $bannerInfo) = each($_REQUEST[$shortname."_banner"])){
        $bannerInfo["width"] = get_bannersSettings($bannerId, "width");
        $bannerInfo["height"] = get_bannersSettings($bannerId, "height");
        $bannerInfo["status"] = $_REQUEST[$shortname."_banner"][$bannerId]["status"];
        if($_REQUEST[$shortname."_banner"][$bannerId]["adsense"])
        	$bannerInfo["adsense"] = ($_REQUEST[$shortname."_banner"][$bannerId]["adsense"]);
        $allBanners[$bannerId] = $bannerInfo;
      }
      update_option( $shortname."_bannersArray", $allBanners);
      update_option( $shortname."_flickr", $_REQUEST[$shortname."_flickr"]);
      update_option( $shortname."_googleapi", $_REQUEST[$shortname."_googleapi"]);
      update_option( $shortname."_googleapiSubmition", $_REQUEST[$shortname."_googleapiSubmition"]);
      update_option( $shortname."_bannerStatus", $_REQUEST[$shortname."_bannerStatus"]);
      update_option( $shortname."_categoriesSubmenu", $_REQUEST[$shortname."_categoriesSubmenu"]);
      update_option( $shortname."_homePostCategory", $_REQUEST[ $shortname."_homePostCategory" ] );
      update_option( $shortname."_homeRandomPosts", $_REQUEST[ $shortname."_homeRandomPosts" ] );
      update_option( $shortname."_randomCategoryPosts", $_REQUEST[ $shortname."_randomCategoryPosts" ] );
      header("Location: themes.php?page=functions.php&saved=true");
      die;
  	}else if($_REQUEST['resetButton']){
      foreach ($options as $value) {
      	delete_option( $value['id'] ); }
      header("Location: themes.php?page=functions.php&reset=true");
      die;
    }
  }
  add_theme_page($themename." Options", "Theme Options", 'edit_themes', basename(__FILE__), 'newThemeOptions_admin');
}
function themeOption_cat_rows( $parent = 0, $level = 0, $categories = 0 , $categoriesMenu) {
	if ( !$categories ) {
		$args = array('hide_empty' => 0);
		if ( !empty($_GET['s']) )
			$args['search'] = $_GET['s'];
		$categories = get_categories( $args );
	}
	$children = _get_term_hierarchy('category');
	if ( $categories ) {
		ob_start();
		foreach ( $categories as $category ) {
			if ( $category->parent == $parent) {
				echo "\t" . themeOption_cat_row( $category, $level , false, $categoriesMenu);
				if ( isset($children[$category->term_id]) )
					themeOption_cat_rows( $category->term_id, $level +1, $categories , $categoriesMenu);
			}
		}
		$output = ob_get_contents();
		ob_end_clean();
		$output = apply_filters('cat_rows', $output);
		echo $output;
	} else {
		return false;
	}
}
function themeOption_cat_row( $category, $level, $name_override = false , $categoriesMenu) {
	global $themename, $shortname, $options;
	global $class;
	$category = get_category( $category );
	$pad = str_repeat( '&#8212; ', $level );
	$name = ( $name_override ? $name_override : $pad . ' ' . $category->name );
	$edit = $name;
	$class = " class='alternate'" == $class ? '' : " class='alternate'";
	$category->count = number_format_i18n( $category->count );
	$posts_count = $category->count;
	$output = "\n\t\t<tr $class>\n\t\t\t<th scope='row' class='check-column'>";
	if ( absint(get_option( 'default_category' ) ) != $category->term_id ) {
		$output .= "<input type='checkbox' name='".$shortname."_categoriesSubmenu[]' value='".$category->term_id."' ".(in_array($category->term_id, $categoriesMenu) ? "checked":"")."/>";
	} else {
		$output .= "&nbsp;";
	}
	$output .= "\n\t\t\t</th>\n\t\t\t<td>$edit</td>\n\t\t\t<td>$category->description</td>\n\t\t</tr>";

	return apply_filters('cat_row', $output);
}
/*
Main admin function
*/
function newThemeOptions_admin() {
  global $themename, $shortname, $options, $cssFiles, $flickrDisplayType;
  if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
  if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
	
	echo "\n<style type='text/css'>";
	echo "\ndiv.wrap dl{margin: 0; padding: 0;}";
	echo "\ndiv.wrap dt{position: relative; left: 0; top: 1.1em; width: 8em; font-weight: bold;}";
	echo "\ndiv.wrap dd{ margin: 0 0 0 10em; padding: 0 0 .5em .5em;}";
	echo "\n input{ padding:30px;}";
	echo "\n</style>";
	echo "\n<script>";
	echo "\n\tfunction markAll(selectStatus){";
	echo "\n\t\tif(selectStatus){";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner1][status]').checked = true;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner2][status]').checked = true;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner3][status]').checked = true;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner4][status]').checked = true;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner5][status]').checked = true;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner6][status]').checked = true;";
	echo "\n\t\t}else{";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner1][status]').checked = false;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner2][status]').checked = false;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner3][status]').checked = false;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner4][status]').checked = false;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner5][status]').checked = false;";
	echo "\n\t\t\tdocument.getElementById('theme__banner[theme_banner6][status]').checked = false;";
	echo "\n\t\t}";
	echo "\n\t}";
	echo "\n</script>";
  	echo "\n<div class=\"wrap\">";
  	echo "\n<p id=\"icon-options-general\" class=\"icon32\"><h2>".$themename." theme settings</h2></p>";
 	echo "\n<form method=\"post\">";
  	echo "\n<p class=\"submit\" style=\"border:0px;padding:0px;\">";
 	echo "\n\t<input  class=\"button-primary\" type=\"submit\" name=\"saveButton\" value=\"Save settings\"/>";
 	echo "\n\t<input class=\"button\" name=\"resetButton\" type=\"submit\" value=\"Reset settings\"/>";
  	echo "\n</p>";  
  	echo "\n<table class=\"widefat\"><thead><tr><th>Theme Style</th></tr></thead>";
  	echo "\n\t\t<tbody><tr><th>Select your style";
  	echo "\n\t\t\t<select name=\"".$shortname."_css\" id=\"".$shortname."_css\">";
 	while(list(, $f) = each($cssFiles)){
  	echo "\n\t\t\t\t<option value=\"".$f."\" ".((get_settings( $shortname."_css" )==$f)?"selected":"").">".$f."</option>";
  }
  	echo "\n\t\t\t</select>";
	echo "\n</td></th></tr></tbody></table>";
   	echo "\n<br/><table class=\"widefat\"><thead><tr><th>Blog Articles Category</th></tr></thead>";
  	echo "\n\t\t<tbody><tr><th>Select a category for your Blog Articles";
  	echo "\n\t\t\t<select name=\"".$shortname."_homePostCategory\" id=\"".$shortname."_homePostCategory\">";
  	echo "\n\t\t\t\t<option value=\"\">All Post By date DESC</option>";
	$args = array('hide_empty' => 0);
	$categories = get_categories( $args );
  	while(list(, $fa) = each($categories)){
  	if($fa->parent == 0)
  		echo "\n\t\t\t\t<option value=\"".$fa->term_id."\" ".((get_settings( $shortname."_homePostCategory" )==$fa->term_id)?"selected":"").">".$fa->name."</option>";
  }
  reset($categories);
  	echo "\n\t\t\t</select>";
  	echo "\n</td></th></tr></tbody></table>";
  	echo "\n<br/><table class=\"widefat\"><thead><tr><th>Property Listing Category</th></tr></thead>";
	echo "\n\t\t<tbody><tr><th>Select a category for your Listings";
  	echo "\n\t\t\t<select name=\"".$shortname."_randomCategoryPosts\" id=\"".$shortname."_randomCategoryPosts\">";
  	echo "\n\t\t\t\t<option value=\"\" ".((get_settings( $shortname."_randomCategoryPosts" )=="")?"selected":"").">Select</option>";
	$args = array('hide_empty' => 0);
	$categories = get_categories( $args );
  while(list(, $fa) = each($categories)){
  	if($fa->parent == 0)
  		echo "\n\t\t\t\t<option value=\"".$fa->term_id."\" ".((get_settings( $shortname."_randomCategoryPosts" )==$fa->term_id)?"selected":"").">".$fa->name."</option>";
  }
  reset($categories);
  	echo "\n\t\t\t</select>";
  	echo "\n</td></th></tr></tbody></table>";
  	echo "\n<br/><table class=\"widefat\"><thead><tr><th>Google Maps Integration</h2>";
	echo "\n\t\t<tbody><tr><th>Enter your Google Maps API key here:";
  	echo "\n\t\t\t<input style=\"width: 450px;padding:3px;\" name=\"".$shortname."_googleapiSubmition\" type=\"text\" id=\"".$shortname."_googleapiSubmition\" value=\"".get_settings($shortname.'_googleapiSubmition')."\" size=\"60\" />";
  	echo "\n</td></th></tr></tbody></table>";
  	 echo "\n<br><table class=\"widefat\"><thead><tr><th>";
  echo "\nAdvertisement Banner Management";
   echo "\n</th></tr></thead>";
       echo "\n<tbody><tr><th>";
  echo "\n<table class=\"form-table\">";
  echo "\n\t<tr valign=\"top\">";
  echo "\n\t\t<th scope=\"row\">Status: </th>";
  $bannersArray = unserialize($options[1]["std"]);
	$c = 0;
  echo "\n\t\t<td><input type=\"checkbox\" name=\"".$shortname."_bannerStatus\" id=\"".$shortname."_bannerStatus\" value=\"1\" ".((get_settings($shortname.'_bannerStatus')==1)?"checked":"")." onClick=\"javascript: markAll(this.checked);\"> Enable All Banners</td>";
 	echo "\n\t</tr>"; 
  echo "\n</table>";   
  echo "\n<div id=\"diFortable\">";
  echo "\n<table class=\"form-table\">";
  $x = 1;
  $bg = '';
  while(list($bannerIndex, $aBanner) = each($bannersArray)){
		$bg = ($bg == 'style="background: #F4F9FD;"') ? '' : 'style="background: #F4F9FD;"';
		$bannerName = ereg_replace("[0-9]{1}", "  #".$x++, str_replace($shortname,"", $bannerIndex));
    echo "\n\t<tr valign=\"top\">";
    echo "\n\t\t<th scope=\"row\" ".(($bg) ? $bg : "style=\"width: 100px;\"").">Advertisement Banner<br/>(size:  ".get_bannersSettings($bannerIndex, "width")."x".get_bannersSettings($bannerIndex, "height")."):</th>";
    echo "\n\t\t<td ".$bg.">";
    echo "\n\t\t<dl>";
    echo "\n\t\t\t<dt>Image:</dt>";
    echo "\n\t\t\t<dd><input style=\"width: 450px;padding:5px;margin:0;\" name=\"".$shortname."_banner[".$bannerIndex."][image_url]\" id=\"".$shortname."_banner[".$bannerIndex."][image_url]\" type=\"text\" value=\"".( (get_bannersSettings($bannerIndex, "image_url")!="")?get_bannersSettings($bannerIndex, "image_url"):$aBanner[$bannerIndex]["image_url"])."\" /><br />Enter the URL Path for this Banner Image.<dd>";
    echo "\n\t\t\t<dt>Url:</dt>";
    echo "\n<dd><input  style=\"width: 450px;padding:5px;margin:0;\" name=\"".$shortname."_banner[".$bannerIndex."][link]\" id=\"".$shortname."_banner[".$bannerIndex."][link]\" type=\"text\" value=\"".( (get_bannersSettings($bannerIndex, "link")!="")?get_bannersSettings($bannerIndex, "link"):$aBanner[$bannerIndex]["link"])."\" /><br />Enter the URL Link where this Banner Links To.<dd>";
    $bannerAux = get_bannersSettings($bannerIndex);
    if(isset($bannerAux["adsense"])){
		  echo "\n\t\t\t<dt>Google Adsense code:</dt>";
		  echo "\n\t\t\t<dd><textarea name=\"".$shortname."_banner[".$bannerIndex."][adsense]\" id=\"".$shortname."_banner[".$bannerIndex."][adsense]\" style=\"width: 550px; height: 120px;\">".stripslashes((get_bannersSettings($bannerIndex, "adsense")!="")?get_bannersSettings($bannerIndex, "adsense"):$aBanner[$bannerIndex]["adsense"])."</textarea><br />If Adsense Publisher Code is Present, it will show as default banner.<dd>";
    }
    echo "\n\t\t\t<dt>Status:</dt>";
    echo "\n\t\t\t<dd><input type=\"checkbox\" name=\"".$shortname."_banner[".$bannerIndex."][status]\" id=\"".$shortname."_banner[".$bannerIndex."][status]\" value=\"1\" ".( (get_bannersSettings($bannerIndex, "status") == 1) ? "checked" : "")."> Enabled<dd>";
    echo "\n\t\t</td>";
    echo "\n\t</tr>";
  }
  echo "\n</table>";
   echo "\n</td></th></tr></tbody></table>";
  if(get_settings($shortname.'_bannerStatus') == 1){
  	echo "\n<script>markAll(1);</script>";
  } 
  echo "\n</div>";
  echo "\n<p class=\"submit\">";
 	echo "\n\t<input  class=\"button-primary\" type=\"submit\" name=\"saveButton\" value=\"Save settings\"/>";
 	echo "\n\t<input class=\"button\" name=\"resetButton\" type=\"submit\" value=\"Reset settings\"/>";
  echo "\n</p>";
  echo "\n</form>";


}
/*
Add CSS Style to Header
*/
function newThemeOptions_wp_head() {
	global $shortname;
	echo "\n<link href=\"".get_template_directory_uri()."/".((get_settings( $shortname."_css" ) != "") ? get_settings( $shortname."_css" ):"style.css")."\" rel=\"stylesheet\" type=\"text/css\" />";
}
/*
Show Header Banner
*/
function newThemeOptions_showHeaderBanner(){
	global $themename, $shortname, $options, $cssFiles;
	if(get_bannersSettings("theme_banner6", "status")==1){
		if(get_bannersSettings("theme_banner6", "adsense")!=""){
			echo stripslashes(get_bannersSettings("theme_banner6", "adsense"))."\n";
		}else if(get_bannersSettings("theme_banner6", "image_url")!=""){
			echo "<a href=\"".get_bannersSettings("theme_banner6", "link")."\" title=\"\"><img src=\"".get_bannersSettings("theme_banner6", "image_url")."\" alt=\"\" /></a>\n";
		}
	}
}
/*
Show 125x125 Banners
*/
function newThemeOptions_showBannersSquare(){
	global $themename, $shortname, $options, $cssFiles;
	if(get_bannersSettings("theme_banner1", "status") OR get_bannersSettings("theme_banner2", "status") OR get_bannersSettings("theme_banner3", "status") OR get_bannersSettings("theme_banner4", "status")){
		echo "\n<div id=\"bannersSquare\">";
		echo "\n\t";
		if((get_bannersSettings("theme_banner1", "image_url")!="") AND (get_bannersSettings("theme_banner1", "status")==1)){
			echo "\n\t\t<a href=\"".get_bannersSettings("theme_banner1", "link")."\" title=\"\"><img src=\"".get_bannersSettings("theme_banner1", "image_url")."\" alt=\"\"/></a>";
		}
		if((get_bannersSettings("theme_banner2", "image_url")!="") AND (get_bannersSettings("theme_banner2", "status")==1)){
			echo "\n\t\t<a href=\"".get_bannersSettings("theme_banner2", "link")."\" title=\"\"><img src=\"".get_bannersSettings("theme_banner2", "image_url")."\" alt=\"\"/></a>";
		}
		if((get_bannersSettings("theme_banner3", "image_url")!="") AND (get_bannersSettings("theme_banner3", "status")==1)){
			echo "\n\t\t<a href=\"".get_bannersSettings("theme_banner3", "link")."\" title=\"\"><img src=\"".get_bannersSettings("theme_banner3", "image_url")."\" alt=\"\"/></a>";
		}
		if((get_bannersSettings("theme_banner4", "image_url")!="") AND (get_bannersSettings("theme_banner4", "status")==1)){
			echo "\n\t\t<a href=\"".get_bannersSettings("theme_banner4", "link")."\" title=\"\"><img src=\"".get_bannersSettings("theme_banner4", "image_url")."\" alt=\"\"/></a>";
		}
		echo "\n\t";
		echo "\n</div>\n";

	}
}

function newThemeOptions_showFooterBanner(){
	global $themename, $shortname, $options, $cssFiles;
	if(get_bannersSettings("theme_banner6", "status")==1){
		if(get_bannersSettings("theme_banner6", "adsense")!=""){
			echo stripslashes(get_bannersSettings("theme_banner6", "adsense"))."\n";
		}else if(get_bannersSettings("theme_banner6", "image_url")!=""){
			echo "<a href=\"".get_bannersSettings("theme_banner6", "link")."\" title=\"\"><img src=\"".get_bannersSettings("theme_banner6", "image_url")."\" alt=\"\" /></a>\n";
		}
	}
}
/*
Show Random Videos
*/
function newThemeOptions_showVideo(){
	global $themename, $shortname, $options, $cssFiles;
	$c = 0;
	$search = TRUE;
	srand((float) microtime() * 10000000);
	$theVideos = get_settings($shortname."_videosArray");
  if(!is_array($theVideos)){
		$theVideos = unserialize($options[0]["std"]);
  }
	srand((float)microtime() * 1000000);
	shuffle($theVideos);
	while(($c <= 4)AND($search)){
		if(preg_match("#param(.+?)movie(.+?)>#is", stripslashes($theVideos[$c]["link"]), $r)){
			if(preg_match("#([a-zA-Z]+[:\/\/]+[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+)#is", $r[0], $r)){
				$theUrl = $r[1];
				$theWidth = 324;
				$theheight = 264;
				$search = FALSE;
			}
		}
		$c++;
	}
if($theUrl!=""){
		echo "<object type=\"application/x-shockwave-flash\" width=\"".$theWidth."\" height=\"".$theheight."\" data=\"".$theUrl."\">";
		echo "<param name=\"movie\" value=\"".$theUrl."\"/>";
		echo "<param name=\"wmode\" value=\"transparent\"/>";
		
		echo "</object>";
	}
}
function multicategories_search()
{
       //Verifying if the plugin it's installed
       if (function_exists('dropdown_manager_paintdropdown'))
       {
               $cats = array();

               //Rendering the drop downs
               $number_of_categories = dropdown_get_dropdowns();
               for($i=0;$i<($number_of_categories);$i++)
               {
                       //Make sure we have a value on it
                       if ($_POST['multisearch_'.$i] != "")
                       {
                               $cats[] = $_POST['multisearch_'.$i];
                       }
               }
               if (count($cats) > 0)
               {
                       query_posts(array('category__and' => $cats));
               }


       }
}

/*
Show 300x250 Banner
*/
function newThemeOptions_showBigBanner(){
	global $themename, $shortname, $options, $cssFiles;
	if(get_bannersSettings("theme_banner5", "status")==1){
		if(get_bannersSettings("theme_banner5", "adsense")!=""){
			echo "\n<div class=\"ad300x250\">";
			echo stripslashes(get_bannersSettings("theme_banner5", "adsense"))."\n";
			echo "\n</div>\n";
		}else if(get_bannersSettings("theme_banner5", "image_url")!=""){
			echo "<a href=\"".get_bannersSettings("theme_banner5", "link")."\" title=\"\"><img src=\"".get_bannersSettings("theme_banner5", "image_url")."\" alt=\"\"/></a>\n";
		}
	}	
}
/*
Get flickr info
get_flickrRSS is adapted from http://eightface.com/wordpress/flickrrss/
*/
function get_flickrFeed() {
	$userid = stripslashes(get_flickrSettings('nsid'));
	if($userid){
		$num_items = get_flickrSettings('display');
		$tags = trim(get_flickrSettings('tags'));;
		$imagesize = get_flickrSettings('displayType');
		if (!function_exists('MagpieRSS')) {
			include_once (ABSPATH . WPINC . '/rss.php');
			error_reporting(E_ERROR);
		}
		$rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . $userid . '&tags=' . $tags . '&format=rss_200';
		$rss = @ fetch_rss($rss_url);
		if ($rss) {
			$imgurl = "";
			$items = array_slice($rss->items, 0, $num_items);
			
			foreach ( $items as $item ) {
				if(preg_match('<img src="([^"]*)" [^/]*/>', $item['description'],$imgUrlMatches)) {
					$imgurl = $imgUrlMatches[1];
					if ($imagesize == "square") {
						$imgurl = str_replace("m.jpg", "s.jpg", $imgurl);
					} elseif ($imagesize == "thumbnail") {
						$imgurl = str_replace("m.jpg", "t.jpg", $imgurl);
					}
					$title = htmlspecialchars(stripslashes($item['title']));
					$url = $item['link'];
					preg_match('<http://farm[0-9]{0,3}\.static.flickr\.com/\d+?\/([^.]*)\.jpg>', $imgurl, $flickrSlugMatches);
					$flickrSlug = $flickrSlugMatches[1];
					echo "\n<a target=\"blank\" href=\"".$url."\" title=\"".$title."\"><img src=\"".$imgurl."\" alt=\"".$title."\" /></a>";
				}
			}
		
		} else {
			echo "Flickr";
		}
	}
}

/*
Get googleapi ID
*/
function get_googleapiSubmitionForm(){
	global $shortname;
	$googleApiid = get_settings($shortname.'_googleapiSubmition');
	if($googleApiid != ""){
		echo $googleApiid;
		
	}
}
$ids = array();
$idsj = array();
$idsR = array();
$idsRest = array();
global $wp_query, $shortname, $theme_query, $wpdb, $cx, $showedPosts, $ids, $show;
$show= get_settings($shortname."_homePostCategory");
function Themehave_posts(){
	global $wp_query, $shortname, $theme_query, $wpdb, $cx, $showedPosts, $ids, $show;
	 $show = get_settings($shortname."_homePostCategory");
	$numberOfPost = (int)get_settings($shortname."_homeRandomPosts");
	if($show == ""){
		if(!$theme_query){
			$theme_query = new WP_Query('showposts='.(($numberOfPost) ? $numberOfPost : get_settings('posts_per_page')));
		}
	}else if($show == "-1"){
		if(!$theme_query){
			$theme_query = new WP_Query('orderby=rand&showposts='.(($numberOfPost) ? $numberOfPost : get_settings('posts_per_page')));
		}
	}else if(is_numeric($show)){
		if(!$theme_query){
			if(!in_array($show, $ids))
				$ids[] = $show;
			$theme_query = new WP_Query('category_name='.get_cat_name($show).'&showposts='.(($numberOfPost) ? $numberOfPost : get_settings('posts_per_page')));
		}
	}else{
		if(!$theme_query){
			$theme_query = new WP_Query('showposts='.(($numberOfPost) ? $numberOfPost : get_settings('posts_per_page')));
		}
	}
	$aux = $theme_query->have_posts();
	if(get_the_ID())
		$showedPosts[] = get_the_ID();
	return $aux;
	
}
function Themehave_random_posts(){
	global $wp_query, $shortname, $theme_queryRandom, $wpdb, $cx, $showedPosts, $ids, $show;
	if(!$theme_queryRandom){
		 $show = (int)get_settings($shortname."_randomCategoryPosts");
		if(!in_array($show, $ids))
			$ids[] = $show;
		$theme_queryRandom = new WP_Query('category_name='.get_cat_name($show).'&showposts=1&orderby=rand');
	}
	$aux = $theme_queryRandom->have_posts();
	if(get_the_ID())
		$showedPosts[] = get_the_ID();
	return $aux;
}
add_action('wp_head', 'newThemeOptions_wp_head');
add_action('admin_menu', 'newThemeOptions_add_admin');
?>
<?php
	function listing_image($post_id, $size)
	{
		global $wpdb;
		$querystr = " SELECT 
								ID AS 'ID',
								post_excerpt AS 'imageTitle',	
								guid AS 'imageGuid' 
					  FROM
								" . $wpdb->prefix . "posts
					  WHERE
									" . $wpdb->prefix . "posts.post_parent = ". $post_id . " 
								AND	" . $wpdb->prefix . "posts.post_type = \"attachment\"
					  ORDER BY 
								" . $wpdb->prefix . "posts.menu_order ASC
					  LIMIT 1";

		$pageposts = $wpdb->get_row($querystr);
		$attachment_size=wp_get_attachment_image_src($pageposts->ID, $size);
		$link= get_permalink();
		$title = get_the_title();
		$blog = get_bloginfo('template_url');
		if ($pageposts)
		{
			return "<a href='".$link."'><img src='".$attachment_size[0]."' width='121' height='99  alt='".$title."'  /></a>";
		}
		else
			return "<img src='".$blog . "/images/noimage.png' width=80 height=80 />";
	}
	






?>
<?php
	function all_properties($post_id, $size)
	{
		global $wpdb;
		$querystr = " SELECT 
								ID AS 'ID',
								post_excerpt AS 'imageTitle',	
								guid AS 'imageGuid' 
					  FROM
								" . $wpdb->prefix . "posts
					  WHERE
									" . $wpdb->prefix . "posts.post_parent = ". $post_id . " 
								AND	" . $wpdb->prefix . "posts.post_type = \"attachment\"
					  ORDER BY 
								" . $wpdb->prefix . "posts.menu_order ASC
					  LIMIT 1";

		$pageposts = $wpdb->get_row($querystr);
		$attachment_size=wp_get_attachment_image_src($pageposts->ID, $size);
		$link= get_permalink();
		$title = get_the_title();
		$blog = get_bloginfo('template_url');
		if ($pageposts)
		{
			return "<a href='".$link."'><img src='".$attachment_size[0]."' width='260' height='160'  alt='".$title."'  /></a>";
		}
		else
			return "<img src='".$blog . "/images/noimage.png' width=80 height=80 />";
	}
?>
<?php
	function search_thumb($post_id, $size)
	{
		global $wpdb;
				$querystr = " SELECT 
								ID AS 'ID',
								post_excerpt AS 'imageTitle',	
								guid AS 'imageGuid' 
					  FROM
								" . $wpdb->prefix . "posts
					  WHERE
									" . $wpdb->prefix . "posts.post_parent = ". $post_id . " 
								AND	" . $wpdb->prefix . "posts.post_type = \"attachment\"
					  ORDER BY 
								" . $wpdb->prefix . "posts.menu_order ASC
					  					  LIMIT 1";
		$pageposts = $wpdb->get_row($querystr);
		$attachment_size=wp_get_attachment_image_src($pageposts->ID, $size);
		$link= get_permalink();
		$blog = get_bloginfo('template_url');
		if ($pageposts)
		{
			return "<a href=".$link."><img src='".$attachment_size[0]."' width=80 height=80 rel=shadowbox  /></a>";
		}
		else
			return "<img src='".$blog . "/images/noimage.png' width=80 height=80 />";
	}
?>
<?php
	function latest_listings($post_id, $size)
	{
		global $wpdb;
				$querystr = " SELECT 
								ID AS 'ID',
								post_excerpt AS 'imageTitle',	
								guid AS 'imageGuid' 
					  FROM
								" . $wpdb->prefix . "posts
					  WHERE
									" . $wpdb->prefix . "posts.post_parent = ". $post_id . " 
								AND	" . $wpdb->prefix . "posts.post_type = \"attachment\"
					  ORDER BY 
								" . $wpdb->prefix . "posts.menu_order ASC
					  					  LIMIT 1";
		$pageposts = $wpdb->get_row($querystr);
		$attachment_size=wp_get_attachment_image_src($pageposts->ID, $size);
		$title = get_the_title();
		$blog = get_bloginfo('template_url');
		if ($pageposts)
		{
			return "<img src='".$attachment_size[0]."' width='120' height='70' alt='".$title."' />";
		}
		else
			return "<img src='".$blog . "/images/noimage.png' width='120' height='70' alt='".$title."' />";
	}
?>
<?php
	function slider($post_id, $size)
	{
		global $wpdb;
				$querystr = " SELECT 
								ID AS 'ID',
								post_excerpt AS 'imageTitle',	
								guid AS 'imageGuid' 
					  FROM
								" . $wpdb->prefix . "posts
					  WHERE
									" . $wpdb->prefix . "posts.post_parent = ". $post_id . " 
								AND	" . $wpdb->prefix . "posts.post_type = \"attachment\"
					  ORDER BY 
								" . $wpdb->prefix . "posts.menu_order ASC
					  					  LIMIT 1";
		$pageposts = $wpdb->get_row($querystr);
		$attachment_size=wp_get_attachment_image_src($pageposts->ID, $size);
		$title = get_the_title();
		$blog = get_bloginfo('template_url');
		if ($pageposts)
		{
			return "<img src='".$attachment_size[0]."' width='120' height='60' alt='".$title."' />";
		}
		else
			return "<img src='".$blog . "/images/noimage.png' width='120' height='60' alt='".$title."' />";
	}
?>
<?php
	function latest_news($post_id, $size)
	{
		global $wpdb;
				$querystr = " SELECT 
								ID AS 'ID',
								post_excerpt AS 'imageTitle',	
								guid AS 'imageGuid' 
					  FROM
								" . $wpdb->prefix . "posts
					  WHERE
									" . $wpdb->prefix . "posts.post_parent = ". $post_id . " 
								AND	" . $wpdb->prefix . "posts.post_type = \"attachment\"
					  ORDER BY 
								" . $wpdb->prefix . "posts.menu_order ASC
					  					  LIMIT 1";
		$pageposts = $wpdb->get_row($querystr);
		$attachment_size=wp_get_attachment_image_src($pageposts->ID, $size);
		if ($pageposts)
		{
			return "<img src='".$attachment_size[0]."' width=80 height=60 />";
		}
		else
			return "";
	}
?>
<?php
	function listing_single($post_id, $size)
	{
		global $wpdb;
			$querystr = " SELECT 
								ID AS 'ID',
								post_excerpt AS 'imageTitle',	
								guid AS 'imageGuid' 
					  FROM
								" . $wpdb->prefix . "posts
					  WHERE
									" . $wpdb->prefix . "posts.post_parent = ". $post_id . " 
								AND	" . $wpdb->prefix . "posts.post_type = \"attachment\"
					  ORDER BY 
								" . $wpdb->prefix . "posts.menu_order ASC
					  LIMIT 1";
		$pageposts = $wpdb->get_row($querystr);
		$attachment_size=wp_get_attachment_image_src($pageposts->ID, $size);
		$attachment_full=wp_get_attachment_image_src($pageposts->ID, 'full');
		$blog = get_bloginfo('template_url');
		if ($pageposts)
		{
			return "<a href=".$attachment_full[0]." rel='shadowbox' ><img src='".$attachment_size[0]."' width=284 height=186 /></a>";
		}
		else
			return "<img src='".$blog . "/images/noimage.png' />";
	}
?>
<?php

function photo_gallery($post_id, $size)
	{
		global $wpdb;
		$querystr = " SELECT 
								ID AS 'ID',
								post_excerpt AS 'imageTitle',	
								guid AS 'imageGuid' 
					  FROM
								" . $wpdb->prefix . "posts
					  WHERE
									" . $wpdb->prefix . "posts.post_parent = ". $post_id . " 
								AND	" . $wpdb->prefix . "posts.post_type = \"attachment\"
					  ORDER BY 
								" . $wpdb->prefix . "posts.menu_order ASC
					  ";
		$pageposts = $wpdb->get_results($querystr, OBJECT);
		
		for($i=1;$i<count($pageposts);$i++)
		{
			$attachment_size=wp_get_attachment_image_src($pageposts[$i]->ID, $size);
		    $attachment_full= wp_get_attachment_image_src($pageposts[$i]->ID, 'full');
			if ($attachment_size)
			{
			
			echo "<a rel='lightbox[image_gallery]' href='".$attachment_full[0]."'><img class='thumbs' src='".$attachment_size[0]."'  width='58' height='58' alt='".$title."' /></a>";

			}
		}
		
	}
?>
<?php
function slideshow($post_id, $size)
	{
		global $wpdb;
				$querystr = " SELECT 
								ID AS 'ID',
								post_excerpt AS 'imageTitle',	
								guid AS 'imageGuid' 
					  FROM
								" . $wpdb->prefix . "posts
					  WHERE
									" . $wpdb->prefix . "posts.post_parent = ". $post_id . " 
								AND	" . $wpdb->prefix . "posts.post_type = \"attachment\"
					  ORDER BY 
								" . $wpdb->prefix . "posts.menu_order ASC
					  ";
		$pageposts = $wpdb->get_results($querystr, OBJECT);
		
		for($i=1;$i<count($pageposts);$i++)
		{
			$attachment_size=wp_get_attachment_image_src($pageposts[$i]->ID, 'medium');
		    $thelink = get_permalink();
		    $title = get_the_title();
		    
		    			if ($attachment_size)
			{
				echo "<a href='".$thelink."'><img src='".$attachment_size[0]."'  width='358' height='216' alt='".$title."' /></a>";
			}
		}
		
	}
?>
<?php 

function description($text)
{
	if ($text == '')
	{
		$text = get_the_content('');
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$text = strip_tags($text, '<p><br/><br><b><strong><a>');
		$text = nl2br($text);
		$excerpt_length = apply_filters('excerpt_length', 9999);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '...');
			$text = implode(' ', $words);
			
			
		}
	}
	return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_new_excerpt');
?>
<?php 
function ShortenTitle($title){
$chars_max = 40;
$chars_text = strlen($title);
$title = $title."";
$title = substr($title,0,$chars_max);
$title = substr($title,0,strrpos($title,' '));
if ($chars_title > $chars_max)
{
$title = $title."...";
}
return $title;
}
function limit_content($str, $length) {
  $str = strip_tags($str);
  $str = explode(" ", $str);
  return implode(" " , array_slice($str, 0, $length));
}
?>
<?php 
function search_description($text)
{
	if ($text == '')
	{
		$text = get_the_content('');
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$text = strip_tags($text, '<p><br/><b><strong><a>');
		$text = nl2br($text);
		$excerpt_length = apply_filters('excerpt_length', 20);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '...');
			$text = implode(' ', $words);
		}
	}
	return $text;
}
function news_description($text)
{
	if ($text == '')
	{
		$text = get_the_content('');
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$text = strip_tags($text, '<br/><b><strong><a>');
		$text = nl2br($text);
		$excerpt_length = apply_filters('excerpt_length', 60);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '...');
			$text = implode(' ', $words);
		}
	}
	return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_new_excerpt');
?>
<?php
function ShortenText($text)

{

// Change to the number of characters you want to display
$chars_limit = 180;
$chars_text = strlen($text);
$text = $text." ";
$text = substr($text,0,$chars_limit);
$text = substr($text,0,strrpos($text,' '));
// If the text has more characters that your limit,
//add ... so the user knows the text is actually longer

if ($chars_text > $chars_limit)
{
$text = $text."...";
}
return $text;
}

//Agent-Uploader
$img_path2 = 'agent/';
$surlplugin2 = '/wp-content/uploads/';
$plugin_path_fix2 = './../wp-content/uploads/';
$max_img_width2 = 100; //in pixels (preview)
$max_img_height2 = 100; //in pixels (preview)
$img_extensions = array ( 'flv', 'png', 'jpg', 'jpeg', 'swf', 'gif', 'bmp', 'svg' );

add_action ( 'admin_menu', 'iu_add_pages2' );
register_activation_hook( __FILE__ , 'iu_install2' );

//
//function adds menu items
//
function iu_add_pages2()
{
	add_menu_page('Agent Photo', 'Agent Photo', 1, __FILE__."?agent-upload=1", 'iu_admin_page2');
	//add_submenu_page(__FILE__, 'Upload Picture', 'Upload Picture', 1, __FILE__,'iu_admin_page2');       
}

//
//This function actually moves the already uploaded file
//
function iu_upload_files ( $temp, $storage2 )
{
	/*global $img_path2, $plugin_path_fix2, $wpdb;
	
	$storage2 = stripslashes ( $storage2 );
	
	$filename2 = $storage2;
	
	$storage2 = $plugin_path_fix2 . $img_path2 . $storage2;
	*/
	
	global $img_path2, $plugin_path_fix2, $wpdb;
	
	$storage2 = stripslashes ( $storage2 );
	
	$filename2 = $storage2;
	
	$upload_dir = wp_upload_dir();
	
	wp_mkdir_p( trailingslashit($upload_dir['basedir']) . $img_path2 );
	
	$storage2 = trailingslashit($upload_dir['basedir']) . $img_path2 . $filename2;
	
	if( strlen( $storage2 ) > 0 )
	{
		move_uploaded_file ( $temp, $storage2 );
		$userId = $_POST['userId'];
		$sql = "SELECT image_id FROM `" . $wpdb->prefix . "agent_upload_plugin` WHERE `userId` = " . $userId;
		$row = $wpdb->get_row ( $sql, OBJECT );
		
		if ( $row->image_id == null )
		{
			$sql = "INSERT INTO `" . $wpdb->prefix . "agent_upload_plugin` ( `userId`, `filename`, `uploaded` ) " .
				   "VALUES ( $userId, '" . mysql_real_escape_string ( $filename2 ) . "', '" . time() . "' );";
		}
		else
		{
			$sql =  "UPDATE `" . $wpdb->prefix . "agent_upload_plugin` SET " .
				"`filename` = '" . mysql_real_escape_string ( $filename2 ) . "'," .
				"`uploaded` = '" . time() . "' " .
				"WHERE `userId` = " . $userId;
		}
		
		$wpdb->query ( $sql );
	}
	
	
}

//
//this function deletes a file
//
function iu_delete_photo ( $id )
{
	global $wpdb, $plugin_path_fix2, $img_path2;
	$sql = "SELECT `image_id`, `userId`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "agent_upload_plugin` WHERE `image_id`='" . mysql_real_escape_string ( $id ) . "'";
	$row = $wpdb->get_row ( $sql, OBJECT );
	
	$file = $plugin_path_fix2 . $img_path2 . $row->filename;
	
	//if the file exists....
	if ( file_exists ( $file ) && !empty ( $row->filename ) )
	{
		unlink ( $file );
		
		$sql = "DELETE FROM `" . $wpdb->prefix . "agent_upload_plugin` WHERE `image_id`='" . mysql_real_escape_string ( $id ) . "'";
		$wpdb->query ( $sql );
	}
}

//
//get the extension of a file
//
function iu_get_ext2 ( $str )
{
	$a = explode ( '.', $str );
	$fileext = strtolower ( $a [ count ( $a ) - 1 ] );
	
	return $fileext;
}

//
//shows the current images
//
function iu_show_current_photos()
{
	global $wpdb, $img_path2, $plugin_path_fix2, $imgs_per_row, $surlplugin2, $max_img_width2, $max_img_height2;
	global $current_user;
    get_currentuserinfo();
	
	$userId = $current_user->ID;
	$sql = "SELECT `image_id`, `userId`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "agent_upload_plugin` WHERE `userId` = $userId ORDER BY filename ASC";
	$results = $wpdb->get_results ( $sql );
	
	if ( !empty ( $results ) )
	{
		echo '<div class="wrap">
	<form action="" method="post">
	
	<h2>Current Photo</h2>
	<br class="clear" />';
	
		foreach ( $results as $row )
		{
			//
			//get file extension
			//
			$fileext = iu_get_ext2( $row->filename );
			
			$relpath = get_option ( 'siteurl' ) . $surlplugin2;
			$directpath = $relpath . $img_path2 . $row->filename;
			
			if ( $fileext == 'flv' || $fileext == 'swf' )
			{
				$imgpath = $relpath .  'flash.png';
			}
			else
			{
				$imgpath = $directpath;
			}
			
			list ( $w, $h ) = @getimagesize ( $directpath );
				
			$htmlcode = '<a href="' . $directpath . '"><img alt="Agent" src="' . $directpath . '" /></a>';
				
			echo '<div>' . $htmlcode . '<br /><a href="?page=agent-photo/agent-photo.php&delete=true&id=' . $row->image_id . '" onclick="return confirm(\'Are you sure you want to delete this file?\');"><br />Delete</a><br />
				</div>';
		}
		
		echo '</form></div>';
	}
	
	
}
add_filter('gallery_style', create_function('$a', 'return "
<div class=\'gallery\'>";'));
function iu_show_only_author_images( $authorId )
{
	global $wpdb, $img_path2, $plugin_path_fix2, $imgs_per_row, $surlplugin2, $max_img_width2, $max_img_height2;
	
	$sql = "SELECT `image_id`, `userId`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "image_upload_plugin` WHERE `userId` = " . $authorId;
	$results = $wpdb->get_results ( $sql );
	
	if ( !empty ( $results ) )
	{
		echo '';
	
		foreach ( $results as $row )
		{
			//
			//get file extension
			//
			$fileext = iu_get_ext( $row->filename );
			
			$relpath = get_option ( 'siteurl' ) . $surlplugin2;
			$directpath = $relpath . $img_path2 . $row->filename;
			
			if ( $fileext == 'flv' || $fileext == 'swf' )
			{
				$imgpath = $relpath .  'flash.png';
			}
			else
			{
				$imgpath = $directpath;
			}
			
			list ( $w, $h ) = @getimagesize ( $directpath );
				
			$blogurl = get_bloginfo('template_url');
			
			$htmlcode = '<img class="agentthumb" alt="Agent" src="'. $directpath . '"" />';
				
			echo '' . $htmlcode . '';
		}
		
		echo '';
	}
}

function iu_show_author_photos()
{
	global $wpdb, $img_path2, $plugin_path_fix2, $imgs_per_row, $surlplugin2, $max_img_width2, $max_img_height2;
	
	$userId = $current_user->ID;
		
	$sql = " SELECT U.display_name, I.filename, U.user_nicename " .
" FROM " . $wpdb->prefix . "users U JOIN " . $wpdb->prefix . "agent_upload_plugin I ON U.ID = I.userid " ;

	$results = $wpdb->get_results ( $sql );
	
	
	if ( !empty ( $results ) )
	{
		echo '';
	
		foreach ( $results as $row )
		{
			//
			//get file extension
			//
			$fileext = iu_get_ext2( $row->filename );
			
			$relpath = get_option ( 'siteurl' ) . $surlplugin2;
			$directpath = $relpath . $img_path2 . $row->filename;
			
			if ( $fileext == 'flv' || $fileext == 'swf' )
			{
				$imgpath = $relpath .  'flash.png';
			}
			else
			{
				$imgpath = $directpath;
			}
			
			list ( $w, $h ) = @getimagesize ( $directpath );
				
			$blogurl = get_bloginfo('template_url');
			$name = $row->display_name;
			$namelink = $row->user_nicename;
			$burl  = get_bloginfo('url');		
			
									$htmlcode = '<div style="float:left; width:142px;"><a href="'.$burl. '/author/'. $namelink.'"><img  width=120 style="border:3px solid #ccc;margin-right:10px;" alt="Agent" src="'. $directpath . '  " /><span> <a style="font-weight:bold;" href="'.$burl. '/author/'. $namelink.'">'.$name.'</a></span></div>';
			echo '' . $htmlcode . '';
				 
		}
		
		echo '';
	}
}

function iu_show_only_author_photos( $authorId )
{
	global $wpdb, $img_path2, $plugin_path_fix2, $imgs_per_row, $surlplugin2, $max_img_width2, $max_img_height2;
	
	$sql = "SELECT `image_id`, `userId`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "agent_upload_plugin` WHERE `userId` = " . $authorId;
	$results = $wpdb->get_results ( $sql );
	
	if ( !empty ( $results ) )
	{
		echo '';
	
		foreach ( $results as $row )
		{
			//
			//get file extension
			//
			$fileext = iu_get_ext2( $row->filename );
			
			$relpath = get_option ( 'siteurl' ) . $surlplugin2;
			$directpath = $relpath . $img_path2 . $row->filename;
			
			if ( $fileext == 'flv' || $fileext == 'swf' )
			{
				$imgpath = $relpath .  'flash.png';
			}
			else
			{
				$imgpath = $directpath;
			}
			
			list ( $w, $h ) = @getimagesize ( $directpath );
				
			$blogurl = get_bloginfo('template_url');
			
			$htmlcode = '<img class="agentthumb"  alt="Agent" src="'. $directpath . '" width=100"   />';				
			echo '' . $htmlcode . '';
		}
		
		echo '';
	}
}
function iu_show_only_author_photos_small( $authorId )
{
	global $wpdb, $img_path2, $plugin_path_fix2, $imgs_per_row, $surlplugin2, $max_img_width2, $max_img_height2;
	
	$sql = "SELECT `image_id`, `userId`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "agent_upload_plugin` WHERE `userId` = " . $authorId;
	$results = $wpdb->get_results ( $sql );
	
	if ( !empty ( $results ) )
	{
		echo '';
	
		foreach ( $results as $row )
		{
			//
			//get file extension
			//
			$fileext = iu_get_ext2( $row->filename );
			
			$relpath = get_option ( 'siteurl' ) . $surlplugin2;
			$directpath = $relpath . $img_path2 . $row->filename;
			
			if ( $fileext == 'flv' || $fileext == 'swf' )
			{
				$imgpath = $relpath .  'flash.png';
			}
			else
			{
				$imgpath = $directpath;
			}
			
			list ( $w, $h ) = @getimagesize ( $directpath );
				
			$blogurl = get_bloginfo('template_url');
			
			$htmlcode = '<img class="agent_single_small" alt="Agent" src="'.$blogurl.'/thumbnail.php?src=' . $directpath . '&amp;w=144&amp;h=144&amp;zc=1&amp;q=100" />';
				
			echo '' . $htmlcode . '';
		}
		
		echo '';
	}
}
function agent_home_small( $authorId )
{
	global $wpdb, $img_path2, $plugin_path_fix2, $imgs_per_row, $surlplugin2, $max_img_width2, $max_img_height2;
	
	$sql = "SELECT `image_id`, `userId`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "agent_upload_plugin` WHERE `userId` = " . $authorId;
	$results = $wpdb->get_results ( $sql );
	
	if ( !empty ( $results ) )
	{
		echo '';
	
		foreach ( $results as $row )
		{
			//
			//get file extension
			//
			$fileext = iu_get_ext2( $row->filename );
			
			$relpath = get_option ( 'siteurl' ) . $surlplugin2;
			$directpath = $relpath . $img_path2 . $row->filename;
			
			if ( $fileext == 'flv' || $fileext == 'swf' )
			{
				$imgpath = $relpath .  'flash.png';
			}
			else
			{
				$imgpath = $directpath;
			}
			
			list ( $w, $h ) = @getimagesize ( $directpath );
				
			$blogurl = get_bloginfo('template_url');
			
			$htmlcode = '<img class="agent_small_image" alt="Agent" src="'.$blogurl.'/thumbnail.php?src=' . $directpath . '&amp;w=56&amp;h=56&amp;zc=1&amp;q=100" />';
				
			echo '' . $htmlcode . '';
		}
		
		echo '';
	}
}


function show_logo( )
{
	global $wpdb, $img_path_iu, $plugin_path_fix_iu, $imgs_per_row, $surlplugin_iu, $max_img_width_iu, $max_img_height_iu;
	
	$sql = "SELECT `image_id`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "image_upload_plugin` LIMIT 1";
	$results = $wpdb->get_results ( $sql );
	
	if ( !empty ( $results ) )
	{
		echo '';
	
		foreach ( $results as $row )
		{
			//
			//get file extension
			//
			$fileext = iupload_get_ext2( $row->filename );
			
			$relpath = get_option ( 'siteurl' ) . $surlplugin_iu;
			$directpath = $relpath . $img_path_iu . $row->filename;
			
			if ( $fileext == 'flv' || $fileext == 'swf' )
			{
				$imgpath = $relpath .  'flash.png';
			}
			else
			{
				$imgpath = $directpath;
			}
			
			list ( $w, $h ) = @getimagesize ( $directpath );
				
			$blogurl = get_bloginfo('template_url');
			
			$htmlcode = '<img  alt="" src="'. $directpath . '"" />';
				
			echo '' . $htmlcode . '';
		}
		
		echo '';
	}
	$wpdb->flush();
}


//
//This function shows the main page in the admin menu
//
function iu_admin_page2()
{
	
	global $img_extensions, $wpdb, $plugin_path_fix2, $img_path2;
	//Someone pressed submit
	
	if ( isset ( $_POST['uploadBtn'] ) )
	{ 
		if (  $_FILES['uploadFiles']['name'] != "" )
		{

			$totalFiles = 0;
			
			$ext = iu_get_ext2 ( $_FILES['uploadFiles']['name'] );
			
			if ( in_array ( $ext, $img_extensions ) && $_FILES['uploadFiles']['error'] == 0 )
			{
				iu_upload_files ( $_FILES['uploadFiles']['tmp_name'], $_FILES['uploadFiles']['name'] );
				$totalFiles++;
			}
			
		}
		if ( isset ( $_POST['urlFiles'] ) )
		{
			//Dude want's to upload files from a site
			for ( $i = 0, $total = count ( $_POST['urlFiles'] ); $i < $total; $i++ )
			{
				unset ( $server_file );
				unset ( $this_file );
								
				$server_file = @fopen ( $_POST['urlFiles'][$i], 'rb' );
				
				if ( $server_file )
				{
					
					$temp = explode ( '/', $_POST['urlFiles'][$i] );
					$f = $temp [ count ( $temp ) - 1 ];
					
					$storage2 = $plugin_path_fix2 . $img_path2 . $f;
						
					$this_file = fopen ( $storage2, 'wb' );
					
					while ( $str = fread ( $server_file, 2048 ) )
					{
						fwrite ( $this_file, $str, 2048 );
					}
					
					fclose ( $server_file );
					fclose ( $this_file );
					
					$sql = "INSERT INTO `" . $wpdb->prefix . "agent_upload_plugin` ( `filename`, `uploaded` ) VALUES ( '" . $wpdb->escape ( $f ) . "', '" . time() . "' );";
					$wpdb->query ( $sql );
					
					$totalFiles++;
				}
			}
		}
		
		echo "<br /><strong>Sucessfully uploaded {$totalFiles} file(s).</strong><br /><br />";
	}
	else if ( isset ( $_GET['delete'] ) && isset ( $_GET['id'] ) )
	{
		iu_delete_photo ( $_GET['id'] );
	}
	
	global $current_user;
    get_currentuserinfo();
	
    //echo the add_images form
	echo '
	<form action="" method="post" enctype="multipart/form-data" name="uploadForm" id="uploadForm">
	<input type="hidden" name="userId" value="' . $current_user->ID . '">
	<div class="wrap"><h2>Agent Photo Uploader</h2>
	<br/>
	<div>Please upload your Agent photo here.
 
<br/><br/><br/>

		
	<input type="hidden" name="MAX_FILE_SIZE" value="100000000000000000" />
		<table class="form-table">
			<tr class="form-field form-required">
				<th scope="row" valign="top"><label>Browse for your Image:<br /></label></th>
				<td><div id="fileList"><input type="file" name="uploadFiles" /></div></td>
			</tr>
		</table>
		
		<p class="submit"><div id="spinner"></div><input type="submit"  class="button" name="uploadBtn" value="Upload" /></p></div></form><br /><br />';
		
	//display javascript...
	//echo file_get_contents ( 'scripts.html', true );
		
	iu_show_current_photos();
}

function iu_install2()
{
	global $wpdb;
	
	//SQL Syntax to make a new table
	$sql = "CREATE TABLE `" . $wpdb->prefix . "agent_upload_plugin` 
		(`image_id` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
		`userId` INT NOT NULL, 
		`filename` VARCHAR(255) NOT NULL, 
		`uploaded` INT NOT NULL) ENGINE = MYISAM";
	
	$wpdb->query ( $sql ); //do the query
}


//Image-Uploader
$img_path_iu = 'logo/';
$surlplugin_iu = '/wp-content/uploads/';
$plugin_path_fix_iu = './../wp-content/uploads/';
$max_img_width_iu = 100; //in pixels (preview)
$max_img_height_iu = 100; //in pixels (preview)
$img_extensions = array ( 'flv', 'png', 'jpg', 'jpeg', 'swf', 'gif', 'bmp', 'svg' );

add_action ( 'admin_menu', 'iupload_add_pages2' );
//register_activation_hook( __FILE__ , 'iupload_install2' );

//
//function adds menu items
//
function iupload_add_pages2()
{
	add_menu_page('Logo Upload', 'Logo Upload', 1, __FILE__."?image-upload=1", 'iupload_admin_page2');
	//add_submenu_page(__FILE__, 'Upload Picture', 'Upload Picture', 1, __FILE__,'iupload_admin_page2');       
}

//
//This function actually moves the already uploaded file
//
function iupload_upload_files ( $temp, $storage2 )
{
	global $img_path_iu, $plugin_path_fix_iu, $wpdb;
	
	$storage2 = stripslashes ( $storage2 );
	
	$filename2 = $storage2;

	$upload_dir = wp_upload_dir();
	
	wp_mkdir_p( trailingslashit($upload_dir['basedir']) . $img_path_iu );
	
	$storage2 = trailingslashit($upload_dir['basedir']) . $img_path_iu . $filename2;

	if( strlen( $storage2 ) > 0 )
	{
		move_uploaded_file ( $temp, $storage2 );

		$sql = "SELECT image_id FROM `" . $wpdb->prefix . "image_upload_plugin` LIMIT 1";
		$row = $wpdb->get_row ( $sql, OBJECT );
		
		if ( $row->image_id == null )
		{
			$sql = "INSERT INTO `" . $wpdb->prefix . "image_upload_plugin` ( `filename`, `uploaded` ) " .
				   "VALUES (  '" . mysql_real_escape_string ( $filename2 ) . "', '" . time() . "' );";
		}
		else
		{
			$sql =  "UPDATE `" . $wpdb->prefix . "image_upload_plugin` SET " .
				"`filename` = '" . mysql_real_escape_string ( $filename2 ) . "'," .
				"`uploaded` = '" . time() . "' " .
				"WHERE `image_id` = '" . $row->image_id . "'";
		}
		
		$wpdb->query ( $sql );
	}
	$wpdb->flush();
}

//
//this function deletes a file
//
function iupload_delete_photo ( $id )
{
	global $wpdb, $plugin_path_fix_iu, $img_path_iu;
	$sql = "SELECT `image_id`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "image_upload_plugin` WHERE `image_id`='" . mysql_real_escape_string ( $id ) . "'";
	$row = $wpdb->get_row ( $sql, OBJECT );
	
	$file = $plugin_path_fix_iu . $img_path_iu . $row->filename;
	
	//if the file exists....
	if ( file_exists ( $file ) && !empty ( $row->filename ) )
	{
		unlink ( $file );
		
		$sql = "DELETE FROM `" . $wpdb->prefix . "image_upload_plugin` WHERE `image_id`='" . mysql_real_escape_string ( $id ) . "'";
		$wpdb->query ( $sql );
	}
	$wpdb->flush();
}

//
//get the extension of a file
//
function iupload_get_ext2 ( $str )
{
	$a = explode ( '.', $str );
	$fileext = strtolower ( $a [ count ( $a ) - 1 ] );
	
	return $fileext;
}

//
//shows the current images
//
function iupload_show_current_photo()
{
	global $wpdb, $img_path_iu, $plugin_path_fix_iu, $imgs_per_row, $surlplugin_iu, $max_img_width_iu, $max_img_height_iu;
	
	$sql = "SELECT `image_id`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "image_upload_plugin` LIMIT 1";
	$results = $wpdb->get_results ( $sql );
	
	if ( !empty ( $results ) )
	{
		echo '<div class="wrap">
	<form action="" method="post">
	
	<h2>Current Photo</h2>
	<br class="clear" />';
	
		foreach ( $results as $row )
		{
			//
			//get file extension
			//
			$fileext = iupload_get_ext2( $row->filename );
			
			$relpath = get_option ( 'siteurl' ) . $surlplugin_iu;
			$directpath = $relpath . $img_path_iu . $row->filename;
			
			if ( $fileext == 'flv' || $fileext == 'swf' )
			{
				$imgpath = $relpath .  'flash.png';
			}
			else
			{
				$imgpath = $directpath;
			}
			
			list ( $w, $h ) = @getimagesize ( $directpath );
				
			$htmlcode = '<a href="' . $directpath . '"><img alt="Agent" src="' . $directpath . '" /></a>';
				
			echo '<div>' . $htmlcode . '<br /><a href="?page=image-upload/image-upload.php&delete=true&id=' . $row->image_id . '" onclick="return confirm(\'Are you sure you want to delete this file?\');"><br />Delete</a><br />
				</div>';
		}
		
		echo '</form></div>';
	}
	$wpdb->flush();
	
}

function image_home_small( )
{
	global $wpdb, $img_path_iu, $plugin_path_fix_iu, $imgs_per_row, $surlplugin_iu, $max_img_width_iu, $max_img_height_iu;
	
	$sql = "SELECT `image_id`, `filename`, `uploaded` FROM `" . $wpdb->prefix . "image_upload_plugin` LIMIT 1";
	$results = $wpdb->get_results ( $sql );
	
	if ( !empty ( $results ) )
	{
		echo '';
	
		foreach ( $results as $row )
		{
			//
			//get file extension
			//
			$fileext = iupload_get_ext2( $row->filename );
			
			$relpath = get_option ( 'siteurl' ) . $surlplugin_iu;
			$directpath = $relpath . $img_path_iu . $row->filename;
			
			if ( $fileext == 'flv' || $fileext == 'swf' )
			{
				$imgpath = $relpath .  'flash.png';
			}
			else
			{
				$imgpath = $directpath;
			}
			
			list ( $w, $h ) = @getimagesize ( $directpath );
				
			$blogurl = get_bloginfo('template_url');
			
			$htmlcode = '<img class="agentthumb" alt="Agent" width="56" height="56" src="'. $directpath . '"" />';
				
			echo '' . $htmlcode . '';
		}
		
		echo '';
	}
	$wpdb->flush();
}

//
//This function shows the main page in the admin menu
//
function iupload_admin_page2()
{
	
	global $img_extensions, $wpdb, $plugin_path_fix_iu, $img_path_iu;
	//Someone pressed submit
	
	if ( isset ( $_POST['uploadBtn'] ) )
	{ 
		if (  $_FILES['uploadFiles']['name'] != "" )
		{

			$totalFiles = 0;
			
			$ext = iupload_get_ext2 ( $_FILES['uploadFiles']['name'] );
			
			if ( in_array ( $ext, $img_extensions ) && $_FILES['uploadFiles']['error'] == 0 )
			{
				iupload_upload_files ( $_FILES['uploadFiles']['tmp_name'], $_FILES['uploadFiles']['name'] );
				$totalFiles++;
			}
			
		}
		
		echo "<br /><strong>Sucessfully uploaded {$totalFiles} file(s).</strong><br /><br />";
	}
	else if ( isset ( $_GET['delete'] ) && isset ( $_GET['id'] ) )
	{
		iupload_delete_photo ( $_GET['id'] );
	}
	
	global $current_user;
    get_currentuserinfo();
	
    //echo the add_images form
	echo '
	<form action="" method="post" enctype="multipart/form-data" name="uploadForm" id="uploadForm">
	<input type="hidden" name="userId" value="' . $current_user->ID . '">
	<div class="wrap"><h2>Image Uploader</h2>
	<br/>
	<div>Please upload your image here.
 
<br/><br/><br/>

		
	<input type="hidden" name="MAX_FILE_SIZE" value="100000000000000000" />
		<table class="form-table">
			<tr class="form-field form-required">
				<th scope="row" valign="top"><label>Browse for your Image:<br /></label></th>
				<td><div id="fileList"><input type="file" name="uploadFiles" /></div></td>
			</tr>
		</table>
		
		<p class="submit"><div id="spinner"></div><input type="submit"  class="button" name="uploadBtn" value="Upload" /></p></div></form><br /><br />';
		

	iupload_show_current_photo();
	
	$wpdb->flush();
}

function iupload_install2()
{
	global $wpdb;
	
	//SQL Syntax to make a new table
	$sql = "CREATE TABLE `" . $wpdb->prefix . "image_upload_plugin` 
		(`image_id` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
		`filename` VARCHAR(255) NOT NULL, 
		`uploaded` INT NOT NULL) ENGINE = MYISAM";
	
	$wpdb->query ( $sql ); //do the query
	
	$wpdb->flush();
}

$no_of_dropdowns = 3;
$order_by = 1;

//Various Wordpress hooks
add_action('admin_menu', 'dropdown_manager_addmenuitems');
//register_activation_hook( __FILE__ , 'dropdown_manager_install' );
//register_deactivation_hook( __FILE__ , 'dropdown_manager_uninstall' );

//add items to theme options menu
function dropdown_manager_addmenuitems()
{
	add_menu_page('Multi Search', 'Multi Search', 10, __FILE__."?dropdown-manager=1", 'dropdown_manager_show');
	
}
//this controls the theme options page
function theme_options (){
echo 'Welcome to your custom theme options page, Use the links above to control your options';
}
//this gets the # of dropdowns allowed
function dropdown_get_dropdowns()
{
	global $wpdb;
	
	$sql = "SELECT `value` as `dropdowns` FROM `" . $wpdb->prefix . "dropdown_plugin_settings` WHERE `name`='total_dropdowns';";
	$row = $wpdb->get_results ( $sql , OBJECT );
	
	return $row[0]->dropdowns;
}
//this gets the # of dropdowns allowed
function dropdown_get_orderby()
{
	global $wpdb;
	
	$sql = "SELECT `value` as `dropdowns` FROM `" . $wpdb->prefix . "dropdown_plugin_settings` WHERE `name`='order_by';";
	$row = $wpdb->get_results ( $sql , OBJECT );
	
	return $row[0]->dropdowns;
}

function dropdown_manager_paintdropdown( $num )
{
	global $wpdb;

	$wpdb->show_errors();

	$sql = "SELECT `terms`.`term_id` as `term_id`, `terms`.`name` as `name`, `label`
			FROM `" . $wpdb->prefix . "terms` as `terms`
			LEFT JOIN `" . $wpdb->prefix . "multisearch` as `dropdown`
			ON ( `dropdown`.`term_id` = `terms`.`term_id` )
			WHERE `dropdown`.`menu` = '" . (int)$num . "'
			ORDER BY terms." . (get_option('dropdown_sort_oder')=='1'?'name':'term_id') ." ASC;";
	
	$rows = $wpdb->get_results ( $sql, OBJECT );

		$blogurl = get_bloginfo('url');

	if ( $rows )
	{
		$i=0;
		foreach ( $rows as $row )
		{
			if ($i==0)
			{
				echo '<span class="dd'. ($i+1) . '"><span class="searchby">' . $row->label . '</span>';
				echo '<select class="style01" id="multisearch_'.$num.'" name="multisearch_'.$num.'"><option value="">' . attribute_escape(__('Select Category')) . '</option>';
				
			}
			$i++;
			
			$selected = '';
			
			if (isset($_POST['multisearch_'.$num]))
			{
				if ($_POST['multisearch_'.$num] == $row->term_id)
				{
					$selected = 'selected';
				}
			}
			//$option = '<option value="'. $blogurl .'/?cat=' . $row->term_id . '"  >' . $row->name . '</option>';

			$option = '<option value="'. $row->term_id . '" ' . $selected . ' >' . $row->name . '</option>';
			echo $option;
		}
	}	
	//echo out the end of the select
	echo '</select></span>';
}

//this is the control for the dropdown menu
function dropdown_manager_show()
{
	global $wpdb;
	
	$no_of_dropdowns = dropdown_get_dropdowns();
	$order_by = dropdown_get_orderby();
	
	$wpdb->show_errors();
	
	//user pressed "change"
	if ( isset ( $_POST['submit'] ) )
	{
		
		if (  $_POST['submit']  == 'Submit' )
		{
			$sql = "UPDATE `" . $wpdb->prefix . "dropdown_plugin_settings` SET `value`='" . (int)$_POST['total_dropdowns'] . "' WHERE `name`='total_dropdowns';";
			$wpdb->query ( $sql);
			
			$sql = "UPDATE `" . $wpdb->prefix . "dropdown_plugin_settings` SET `value`='" . (int)$_POST['order_by'] . "' WHERE `name`='order_by';";
			$wpdb->query ( $sql);
			
			$no_of_dropdowns = (int)$_POST['total_dropdowns'];
			
			//delete all the dropdows selected
			$sql = "TRUNCATE `" . $wpdb->prefix . "multisearch`";
			$wpdb->query ( $sql );
			
			for ( $i = 0; $i < $no_of_dropdowns; $i++ )
			{	
				if ( is_array ( $_POST['terms_' . $i ] ) && !empty ( $_POST['terms_' . $i ] ) )
				{
					//Enable each of the categories selected.
					foreach ( $_POST['terms_' . $i ] as $key=>$value )
					{
						$wpdb->show_errors();
						//$sql = "INSERT INTO " . $wpdb->prefix . "multisearch ( `term_id`, `menu` ) VALUES ( '" . (int)$value . "', '" . $i . "' )";
						
		
						$sql = "INSERT INTO " . $wpdb->prefix . "multisearch ( `term_id`, `menu`, `label` ) VALUES ( '" . (int)$value . "', '" . $i . "','". $_POST['name_' . $i ] ."' )";
						$wpdb->query ( $sql );
					}
				}
			} //end updating the categories
		}
		
	}
	
	if ( isset ( $_POST['reset'] ) )
	{
		$sql = "TRUNCATE `" . $wpdb->prefix . "multisearch`";
			$wpdb->query ( $sql );
	}
	
	if (isset($_POST['order_by']))
	{
		$order_by = (int)$_POST['order_by'];
		
		update_option('dropdown_sort_oder', $order_by);
	}
	
	echo '<div class="wrap">
	<style type="text/css">
	.formclass1
	{

		display: inline-block;
		padding-left: 15px;
	}
	#leftbuttons
	{
		text-align: left;
		margin-top: 10px;
		margin-left: 10px;
	}
	
	#settings
	{
		margin-top: 10px;
		margin-left: 10px;
	}
	
	.regular-text
	{
		width:150px;
		border:1px solid #CCCCCC;
		padding:3px;
	}
	
	</style>
	
	<div id="icon-options-general" class="icon32"><br /></div>
<h2>Multi Category Search management</h2>
	

	<form action="' . $PHP_SELF . '" method="post">';
	echo "<br/><table class=\"widefat\"><thead><tr><th>Number of Dropdown Search Modules</th></tr></thead>";
	echo '<tbody><tr><th><label for="blogname">Number of dropdown menus </label><select name="total_dropdowns" onchange="javascript:document.forms[0].submit()">';
	
	
	for ( $i = 0; $i <= 10; $i++ )
	{
		echo '<option value="'. $i . '"' . ( $i == $no_of_dropdowns ? ' selected="selected"' : '' ) .  '>' . $i . '</option>';
	}
	
	echo "</select>";
  	echo "</td></th></tr></tbody></table><br/>";
	
	
	
	if ($order_by == 1)
	{
	echo "<table class=\"widefat\"><thead><tr><th>Arrange Categories</th></tr></thead>";
		echo '<tbody><tr><th><label for="blogname"><label for="blogname">Sort categories by </label><select name="order_by"><option value="1" selected >Name</option><option value="2">Date</option></select>';
  	echo '</td></th></tr></tbody></table><br/>';
	}
	else
	{
		echo '<tbody><tr><th><label for="blogname"><label for="blogname">Sort categories by </label></th><td><select name="order_by"><option value="1">Name</option><option value="2" selected>Date</option></select>';
  	echo '</td></th></tr></tbody></table>';
	}
	echo "<table class=\"widefat\"><thead><tr><th>Category Search Builder</th></tr></thead>";

	
	for ( $menu = 0; $menu < $no_of_dropdowns; $menu++ )
	{
	echo "<span class=formclass1>";
	
	echo "<table style=\"float:left;width:220px;margin:20px;\" class=\"widefat \"><thead><tr><th>Categories for Menu " . ( $menu + 1 ) . "</th></tr></thead>";
		$sql = "SELECT `terms`.`term_id` as `term_id`, `terms`.`name` as `name`, `terms`.`slug` as `slug`
					FROM `" . $wpdb->prefix . "terms` as `terms` LEFT JOIN `" . $wpdb->prefix . "term_taxonomy` as `tax`
					ON ( `terms`.`term_id` = `tax`.`term_id` ) 

					WHERE `tax`.`taxonomy` = 'category' 
					ORDER BY terms." . ($order_by==1?'name':'term_id') ." ASC;";
				
		$rows = $wpdb->get_results ( $sql, OBJECT );
		

		$sql = "SELECT * FROM `" . $wpdb->prefix . "multisearch` WHERE menu = " . $menu . " ;";

		$selected = $wpdb->get_results ( $sql, OBJECT );
		
	
		if (is_array($selected))

	echo '<tbody><tr><th><label> &nbsp;  Enter Label </label><input style=\"margin:0;padding:1px;\" type="text" name="name_' . $menu . '" value="' . $selected[0]->label . '" /></th></tr>';


		//If there are any categories
		if ( $rows )
		{
			//go through each of them
			foreach ( $rows as $row )
			{
				//and check it wether or not it's enabled
				$checked = '';
				
				foreach ( $selected as $sel )
				{
					if ( $sel->menu == $menu && $sel->term_id == $row->term_id )
					{
						$checked =  ' checked="checked"';
					}
				}
				
				echo '<tbody><tr><th><label"><input type="checkbox" name="terms_' . $menu . '[]" value="' . $row->term_id . '"' . $checked . '/>  ' . $row->name . '</label><br/></th></tr>';

	
			}
			
			echo '</fieldset></td></tr>';
		}
		
		echo '</td></th></tr></tbody></table>';
		echo "</span>";
	}
	
	
	
	echo '<div id="leftbuttons"><input  class="button-primary" type="submit" name="submit" value="Submit"/><input class="button" name="reset" type="submit" value="Reset"/></div></form>';
	
	//sample dropdown menu
	echo "<br/><table class=\"widefat\"><thead><tr><th>MultiSearch Preview</th></tr></thead>";
	echo '<tbody><tr><th>';
	//the actual dropdown menu
	for ( $i = 0; $i < $no_of_dropdowns; $i++ )
	{
		dropdown_manager_paintdropdown( $i );
	}
			echo '</th></tr></tbody></table>';
}

function dropdown_manager_search_criteria()
{
	$number_of_categories = dropdown_get_dropdowns(); 
	if ($number_of_categories > 0)
	{	
		echo "<span class='breadcrumb'><strong>Search Results for:</strong> ";
		for($i=0;$i<($number_of_categories-1);$i++)
		{
			$category_id = $_POST['multisearch_'.$i];
			
			if ($category_id!="")
			{
				$cat = get_category( $category_id);
				echo "<a href=\"" . get_category_link( $category_id ) ."\">" .$cat->cat_name."</a> &raquo;</span>";
			}
		} 
	}
		

}

//this function takes care of altering the categories table with a dropdown column
function dropdown_manager_install()
{
	global $wpdb;

	$sql = "CREATE TABLE `" . $wpdb->prefix . "dropdown_plugin_settings` ( `setting_id` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` VARCHAR(255) NOT NULL, `value` VARCHAR(255) NOT NULL )"; 
	$wpdb->query ( $sql );
	
	
	$sql = "CREATE TABLE `" . $wpdb->prefix . "multisearch` ( `dropdown_id` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY, `term_id` MEDIUMINT NOT NULL, `menu` MEDIUMINT NOT NULL ,`label` VARCHAR(255) NOT NULL)";
	$wpdb->query ( $sql );
	
	$sql = "INSERT INTO `" . $wpdb->prefix . "dropdown_plugin_settings` ( `name`, `value` ) VALUES ( 'total_dropdowns', '3' );";
	$wpdb->query ( $sql );
	$sql = "INSERT INTO `" . $wpdb->prefix . "dropdown_plugin_settings` ( `name`, `value` ) VALUES ( 'order_by', '1' );";
	$wpdb->query ( $sql );
}

function dropdown_manager_uninstall()
{
	global $wpdb;

	$sql = "DROP TABLE `" . $wpdb->prefix . "dropdown_plugin_settings`"; 
	$wpdb->query ( $sql );
	
	
	$sql = "DROP TABLE `" . $wpdb->prefix . "multisearch`";
	$wpdb->query ( $sql );
	

}


//UPON ACTIVATION
if ( $_GET['activated'] == 'true' )
{
	theme_setup();
}

function label_field()
{
	global $wpdb;
	
	//SQL Syntax to make a new table
		$sql = "CREATE TABLE `" . $wpdb->prefix . "multisearch` ( `dropdown_id` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY, `term_id` MEDIUMINT NOT NULL, `menu` MEDIUMINT NOT NULL ,`label` VARCHAR(255) NOT NULL)";
	$wpdb->query ( $sql );
	
	
	$wpdb->flush();
}


function theme_setup()
{
	dropdown_manager_install();
	
	label_field();
	
	iu_install2();
	
	iupload_install2();
}
 

//Real State - Custom fields
function get_custom_label($option)
{
	$value = get_option($option);
	if ($value!=false)
	{
		echo $value;
	}
	else
	{
		echo $option;
	}
}

function get_more_fields($postID)
{
	$fields = array();
	$i = 0;

	while(get_post_meta($postID,'custom_field_'.$postID.'_'.$i,true)!="")
	{
		$value = get_post_meta($postID,'custom_field_'.$postID.'_'.$i,true);
		$label = get_option('custom_field_'.$postID.'_'.$i);
		
		$obj = new stdClass();

		$obj->label = $label;
		$obj->value = $value;
		
		$fields[$i] = $obj;
		
		$i++;
		
	}
			
	return $fields;
			
}

function get_custom_label_edit($option, $print=true)
{	$value = get_option($option);
	if ($value!=false)
	{
		if ($print)
			echo "<span class=\"button\" id=\"".$value."\" alt=\"".$option."\" onclick=\"editLabel(this,'".$option."')\">Edit</span> " . $value;
		else
			return "<span class=\"button\" onclick=\"deleteField(this,'".$option."')\">Delete</span> <span><span class=\"button\" id=\"".$value."\" alt=\"".$option."\" onclick=\"editLabel(this,'".$option."')\">Edit</span> " . $value . "</span>";
	}
	else
	{
		$message = 'Please edit';
		
		if ($print)
			echo "<span class=\"button\" alt=\"".$option."\" alt=\"".$option."\" onclick=\"editLabel(this,'".$option."')\">Edit</span> " . $option;
		else
			return "<span class=\"button\"  onclick=\"deleteField(this,'".$option."')\">Delete</span> <span><span class=\"button\" alt=\"".$option."\" alt=\"".$option."\" onclick=\"editLabel(this,'".$option."')\">Edit</span> " . $message . "</span>";
	}
}
if ( !defined('WP_CONTENT_URL') ) {
    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
    }
if ( !defined('WP_CONTENT_DIR') ) {
    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
    }
$plugin_path = WP_CONTENT_DIR.'/plugins/'.plugin_basename(dirname(__FILE__));
$plugin_url = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__));
if (re_dream_islisting() == 1) {
    add_filter('edit_form_advanced', 'red_customscreen'); 
    }
add_action('admin_menu', 're_dream_addmenu');  
add_action('edit_post', 'red_add_fields');
add_action('publish_post', 'red_add_fields');
add_action('save_post', 'red_add_fields');
function red_customscreen(){ 
    global $post;
    global $plugin_url;
    $price = get_post_meta($post->ID, 'price', true);
    $listing = get_post_meta($post->ID, 'listing', true);
    $property = get_post_meta($post->ID, 'property', true);
    $address = get_post_meta($post->ID, 'address', true);
    $city = get_post_meta($post->ID, 'city', true);
    $state = get_post_meta($post->ID, 'state', true);
    $zip = get_post_meta($post->ID, 'zip', true);
    $bed = get_post_meta($post->ID, 'bedrooms', true); 
    $bath = get_post_meta($post->ID, 'bathrooms', true);
    $sqft = get_post_meta($post->ID, 'sqft', true);       
    $school = get_post_meta($post->ID, 'school', true);
    $mlsurl = get_post_meta($post->ID, 'mlsurl', true);
    $mlsinfo = get_post_meta($post->ID, 'mlsinfo', true);
    $features = get_post_meta($post->ID, 'features', true);
    $water = get_post_meta($post->ID, 'water', true);
    ?>
<script>
	var current_post_id = <?php global $post; echo $post->ID; ?>;
	var current_custom_field_count = null;
	var current_obj=null;
	var current_parent=null;
	var current_custom_field=null;
	var html = "<span id='edit_form'><span class='button-primary' onclick='endEditing();'>Save</span><input type='text' id='txtName'/></span>";
	
	function addNewField()
	{
				
		info = "count="+current_custom_field_count+"&meta_key=custom_field_"+current_post_id+"_"+current_custom_field_count+"&meta_value=Enter the value&post_id="+current_post_id;
		
		current_custom_field_count++;
		
		jQuery.ajax({type: "POST", url:"<?php echo get_bloginfo('template_directory') ?>/ajax.php", data: info, success: function(msg){jQuery("#customFields").append(msg);}});
	}
	
	function deleteField(obj, custom_field)
	{
		current_obj = obj;
		current_custom_field=custom_field;
		current_parent = obj.parentNode;
				
		info = "delete=1&meta_key="+custom_field+"&post_id="+current_post_id;
		
		jQuery.ajax({type: "POST", url:"<?php echo get_bloginfo('template_directory') ?>/ajax.php", data: info, success: function(msg){}});
		
		obj.parentNode.innerHTML = '';
		
		jQuery("#"+custom_field).css("display","none");
	}
	
	function editLabel(obj, custom_field)
	{
		cancelEditing();
		
		current_obj = obj;
		current_custom_field=custom_field;
		current_parent = obj.parentNode;
		
		value_getted = current_parent.textContent.replace("Edit ","");
		
		obj.parentNode.innerHTML = html;
		
		jQuery("#txtName").val(value_getted);
		
		jQuery("#txtName").focus();
	}
	
	function endEditing()
	{

		jQuery.ajax({type: "POST", url: "<?php echo get_bloginfo('template_directory') ?>/ajax.php", data: "custom_field="+current_custom_field+","+jQuery("#txtName").val(), success: function(msg){}});
		
		current_parent.innerHTML =  "<span class=\"button\" onclick=\"editLabel(this,'"+current_custom_field+"')\">Edit</span> " + jQuery("#txtName").val();
		current_obj=null;
		current_custom_field=null;
		current_parent = null;
		
		jQuery("#edit_form").remove();	
	}
	
	function cancelEditing()
	{
	
		if (current_parent!=null)
		current_parent.innerHTML =  "<span class=\"button\" onclick=\"editLabel(this,'"+current_custom_field+"')\">Edit</span> " + jQuery("#txtName").val();
		
		current_obj=null;
		current_custom_field=null;
		current_parent = null;
		
		
		
		jQuery("#edit_form").remove();	
	}
</script>
<style>
input[type=text]{width: 200px;}
textarea{width: 300px;}
.Button {cursor:pointer;text-decoration:underline;}
#edit_form input[type=text] {font-size:12px; width:140px;}
span.cancel {color:red; cursor:pointer; font-size:10px;}

</style>



  <h2>Real Estate Management Module</h2>
  <div id="normal-sortables" class="meta-box-sortables ui-sortable" style="position: relative;">
  <div class="postbox">
	   <h3 class="hndle" style="font-weight: bold;">General Property Info</h3>
      
      
       <div class="inside">
       
       
        <table style="text-align: left;">
          <input value="1" type="hidden" name="isrealestate" />  
		     <tr>
         		 <td  valign="middle" style="font-size: 11px;"><input type="text" name="price" id="price" value="<?php echo $price; ?>"  size="12"></td>
         		 <td  valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("Price"); ?></td>
       		</tr>
      		 <tr>
		      
         	  <td  valign="middle" style="font-size: 11px;"><input type="text" name="listing" id="listing" value="<?php echo $listing; ?>"  size="12"></td>
         	  <td  valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("Listing Type"); ?></td>
        	</tr>
		     <tr>
		      
		      <td  valign="middle" style="font-size: 11px;"><input type="text" name="property" id="property" value="<?php echo $property; ?>"  scrolling="auto" size="4"></td>
		      <td  valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("Property Type"); ?></td>
		      </tr>
		   </table>
		  </div>
   </div>
   
 <div class="postbox">
	  
	  <h3 class="hndle" style="font-weight: bold;">Property Address</h3>
      
       <div class="inside">
        
        
        <table style="text-align: left;">
        <tr>
		      <td><input type="text" name="address" id="address" value="<?php echo $address; ?>"></td>
              <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("Street Address"); ?></td>        
		    </tr>
		    
		    <tr>
		      <td><input type="text" name="city" id="city" value="<?php echo $city; ?>"></td>
            <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("City"); ?></td> 
          
        </tr>
        
        <tr>
        
        
        <td><input type="text" name="state" id="state" value="<?php echo $state; ?>"></td>
            <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("State"); ?></td>
             </tr> 
             <tr>
            <td style="float: left;"><input type="text" name="zip" id="zip" value="<?php echo $zip; ?>"></td>
            <td valign="middle" style="font-size: 11px; text-align: left;"><?php get_custom_label_edit("Zip code"); ?></td>  
        </tr>
		    </table>
		   </div>
  </div>
  
  

  <div class="postbox">
	   <h3  class="hndle" style="font-weight: bold;">Detailed Info</h3>
       <div class="inside">
       
       
        <table style="float:left;">  
		     <tr>
          
          <td><input type="text" name="bedrooms" id="bedrooms" value="<?php echo $bed; ?>" ></td>
          <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("Bedrooms"); ?></td>
			</tr>
			
			
					
			</tr
			
          <td style="text-align: left;"><input type="text" name="school" id="school" value="<?php echo $school; ?>"></td>           <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("School District"); ?></td>
        </tr>
        <tr>
          
          <td style="text-align: left;"><input type="text" name="bathrooms" id="bathrooms" value="<?php echo $bath; ?>"></td>
          <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("Bathrooms"); ?></td>
        </tr>
        <tr>
          <td style="text-align: left;"><input type="text" name="mlsurl" id="mlsurl" value="<?php echo $mlsurl; ?>"></td>          
          <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("MLS Link"); ?></td>
        </tr>
        <tr>
          
          <td style="text-align: left;"><input type="text" name="sqft" id="sqft" value="<?php echo $sqft; ?>" ></td>
          <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("Sqft"); ?></td>
          </tr>
          <tr>
     
         <td><input type="text" name="water" id="water" value="<?php echo $water; ?>"></td>
            <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("Waterfront Property"); ?></td>
         </tr>
     
 </table>
         <table>
            <tr>
          <td style="text-align: left;"><textarea name="mlsinfo" cols="29" rows="3"><?php echo $mlsinfo; ?></textarea></td>
          <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("MLS Info"); ?></td>
        </tr>
        
                 
          <td style="text-align: left;"><textarea name="features" cols="29" rows="3" ><?php echo $features; ?></textarea></td>
           <td valign="middle" style="font-size: 11px;"><?php get_custom_label_edit("Features"); ?></td>
                </tr>
              </table>
		</div>
  <div style="clear:both"></div></div>  
  
<div class="postbox">
	   <h3  class="hndle" style="font-weight:bold;">Add More Features</h3>
       <div class="inside">
       <div style="margin:10px 0px 10px 0px;">
    	<span style="font-weight: bold;" class="button-primary" onclick="addNewField();">Click to add more fields</span>
    	</div>
        <table id='customFields'valign="top">  
		<?php 
			$i = 0;
			global $post;
			
			$custom_fields = get_post_custom($post->ID);
  $my_custom_field = $custom_fields['my_custom_field'];

  if (is_array($custom_fields)) foreach ( $custom_fields as $key => $value )
   {
   	if (stripos($key, "custom_field_")!== false)
   	{
   		$value = get_post_meta($post->ID,$key,true);
				
			if ($i % 2 == 0)
			echo "<tr >";
		
		
		echo "<tr ><td style=\"text-align: left;font-size: 11px;\"><input type=\"text\" name=\"". $key ."\" id=\"". $key ."\" value=\"" . $value . "\" size=\"3\"></td>";
		echo "<td style='font-size: 11px;'>". get_custom_label_edit($key, false) ."</td></tr>";
		
		
		if ($i % 2 != 0)
			echo "</tr>";
		
		$i++;
   	}
   }
   
   echo '<script>current_custom_field_count='.$i.';</script>';
				
		?>
              </table>
		</div>
  </div> 
   </div>
    <?php
    }

function red_add_fields($id){ 
    
    $isrealestate = stripslashes($_POST["isrealestate"]);
    $price = stripslashes($_POST["price"]);  
    $listing = stripslashes($_POST["listing"]);
    $property = stripslashes($_POST["property"]);
    $address = stripslashes($_POST["address"]);
    $city = stripslashes($_POST["city"]);
    $state = stripslashes($_POST["state"]);
    $zip = stripslashes($_POST["zip"]);
    $bed = stripslashes($_POST["bedrooms"]);
    $bath = stripslashes($_POST["bathrooms"]);
    $sqft = stripslashes($_POST["sqft"]);
    $school = stripslashes($_POST["school"]);
    $mlsurl = stripslashes($_POST["mlsurl"]);
    $mlsinfo = stripslashes($_POST["mlsinfo"]);
    $water = stripslashes($_POST["water"]);
    $features = stripslashes($_POST["features"]);


  if (isset($isrealestate) && !empty($isrealestate)) {  
    
    delete_post_meta($id, 'isrealestate');
    add_post_meta($id, 'isrealestate', $isrealestate);
    delete_post_meta($id, 'price');
    delete_post_meta($id, 'listing');
	delete_post_meta($id, 'property');
  	delete_post_meta($id, 'address');
    delete_post_meta($id, 'city');
    delete_post_meta($id, 'state');
    delete_post_meta($id, 'zip');
    delete_post_meta($id, 'bedrooms');
    delete_post_meta($id, 'bathrooms');
    delete_post_meta($id, 'sqft');
    delete_post_meta($id, 'school');
    delete_post_meta($id, 'mlsurl');
    delete_post_meta($id, 'mlsinfo');
    delete_post_meta($id, 'water');
    delete_post_meta($id, 'features');
	add_post_meta($id, 'price', $price);
	add_post_meta($id, 'listing', $listing);
	add_post_meta($id, 'property', $property);
	add_post_meta($id, 'address', $address);
	add_post_meta($id, 'city', $city);
	add_post_meta($id, 'state', $state);
	add_post_meta($id, 'zip', $zip);
	add_post_meta($id, 'bedrooms', $bed);
	add_post_meta($id, 'bathrooms', $bath);
	add_post_meta($id, 'sqft', $sqft);
	add_post_meta($id, 'school', $school);
	add_post_meta($id, 'mlsurl', $mlsurl);
	add_post_meta($id, 'mlsinfo', $mlsinfo);
	add_post_meta($id, 'water', $water);
	add_post_meta($id, 'features', $features);

   
  $i = 0;
	while(get_post_meta($id,'custom_field_'.$id.'_'.$i,true)!="")
	{
		$value = get_post_meta($id,'custom_field_'.$id.'_'.$i,true);
		delete_post_meta($id, 'custom_field_'.$id.'_'.$i);
		add_post_meta($id, 'custom_field_'.$id.'_'.$i, $_POST['custom_field_'.$id.'_'.$i]);
		$i++;
	}    
  }
}
function re_dream_redirect($post_id){
  $post = get_post($post_id);
  
  if (($post->post_type == 'post') && ($post->post_status == 'publish')) {
     $location = get_bloginfo('wpurl') . '/administracao/post-new.php?ref=red';
	   wp_redirect($location);
	   exit();
    }  
}


function re_dream_islisting(){ 
    $id = $_GET['post'];
    $ref = $_GET['ref'];
    $is_realestate = get_post_meta($id, 'isrealestate', $single = true);
    
    
    if (($ref == "red") || ($is_realestate == 1)) {
         return 1; 
      }
    else {
        return 0; 
      }
}

function re_dream_addmenu(){
    add_submenu_page('post.php','Add Listing', 'Add Listing', 2, 'post-new.php?ref=red'); 
    add_menu_page('Real Estate', 'Add Listing', 2, 'post-new.php?ref=red');}
 add_filter('manage_posts_columns', 're_dream_remove_columns');
function re_dream_remove_columns($defaults) {
    if( $_GET['mng'] == 'listing' ) {
      unset($defaults['comments']);
      unset($defaults['author']);
      unset($defaults['tags']);
      unset($defaults['categories']);
      unset($defaults['status']);
      unset($defaults['title']);
    }
  return $defaults;
    
}

add_filter('manage_posts_columns', 're_dream_columns');
add_action('manage_posts_custom_column', 're_dream_custom_column', 10, 2);

function re_dream_columns($defaults) {
  if( $_GET['mng'] == 'listing' ) {
      $defaults['title'] = 'Title';
      $defaults['image'] = 'Image';
      $defaults['info'] = 'Listing Info';

      $defaults['status'] = 'Status';
      }
  else{
      $defaults['isrealestate'] = '<center>Real Estate Listing?</center>';    }
return $defaults;  
}

function re_dream_custom_column($column_name, $post_id) { 
      global $wpdb;
      global $plugin_url;

     
   
    if( $column_name == 'isrealestate' ) { 
      $isrealestate = get_post_meta($post_id, 'isrealestate', true);
      
      if ($isrealestate){
        echo 'YES';
        }
      }
    if( $column_name == 'info' ) {
         $price = get_post_meta($post_id, 'price', true);
         $address = get_post_meta($post_id, 'address', true);
         $city = get_post_meta($post_id, 'city', true);
         $state = get_post_meta($post_id, 'state', true);
         $zip = get_post_meta($post_id, 'zip', true);
         $listing = get_post_meta($post_id, 'listing', true);
         $property = get_post_meta($post_id, 'property', true);
        
        $output = "$address <br />";
        
        if($city){
          $output .= $city . ", ";
          }
        
        $output .= $state ." " . $zip;
        
        if($price){
          $output .= "<br /><br /> <strong>Price</strong>: &#36;$price";
            }
        
        if($listing){
          $output .= "<br /> <strong>Listing Type</strong>: $listing";
          }
        if($property){
          $output .= "<br /> <strong>Property Type</strong>: $property";
          }
        
         echo $output;

          } 
        
  if( $column_name == 'image' ) {
    $image = get_post_meta($post_id, 'red_image1', true);
      if ($image){
        
         echo "<a href=\"{$image}\"><img src=\"{$plugin_url}/timthumb.php?src={$image}&w=220&h=130&zc=1\" /></a><br />";
          
        
          for ($i = 1, $a = 0; $i <= 12; $i++){
          $test = get_post_meta($post_id, "red_image$i", true);
           if($test){
              $a++;
              }
          }
          echo "$a of 12 Images Uploaded";
          }
        else {
          $image = $plugin_url . "/noimage.jpg"; 
          echo "<a href=\"{$image}\"><img src=\"{$plugin_url}/timthumb.php?src={$image}&w=220&h=130&zc=1\" /></a>"; } 
      }
}
add_action('load-edit.php', 're_dream_init_attachments');

function re_dream_init_attachments() {
    add_filter('posts_join', 're_dream_posts_join');
    add_action('restrict_manage_posts', 're_dream_restrict_manage_posts');
}
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
function re_dream_posts_join($join) {
	global $wpdb;

    if( $_GET['mng'] == 'listing' ) {
		$join .= " JOIN $wpdb->postmeta";
		$join .= " ON $wpdb->posts.ID = $wpdb->postmeta.post_id";
		$join .= " AND ($wpdb->postmeta.meta_key = 'isrealestate')";
	} 
	return $join;
}

function re_dream_restrict_manage_posts() {
  global $wp_version;
  if ($wp_version >= "2.5"){
    ?>
	<select name='mng' id='mng' class='postform'>
		<option value="0"><?php _e('View all posts and listings') ?></option>
		<option value="listing" <?php if( isset($_GET['mng']) && $_GET['mng']=='listing') echo 'selected="selected"' ?>><?php _e('View only Listings'); ?></option>

	</select>
<?php
  } 
}
add_theme_support( 'post-thumbnails' );
if ( function_exists('register_sidebar') )
    register_sidebars(4,array(
        'before_widget' => '<div class="widgets"><ul><li>',
        'after_widget' => '</li></ul></div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
?>