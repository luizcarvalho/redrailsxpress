<?php 
global $options; foreach ($options as $value) { if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<title><?php if ($wpzoom_seo_enable == 'Enable') { wpzoom_titles(); } else { ?> <?php bloginfo('name'); wp_title('-'); } ?></title>
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if ($wpzoom_seo_enable == 'Enable') { 
if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<meta name="description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />
<?php meta_post_keywords(); ?>
<?php endwhile; endif; elseif(is_home()) : ?>
<meta name="description" content="<?php if (strlen($wpzoom_meta_desc) < 1) { bloginfo('description');} else {echo"$wpzoom_meta_desc";}?>" />
<?php meta_home_keywords(); ?>
<?php endif; ?>
<?php wpzoom_index(); ?>
<?php wpzoom_canonical(); } ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php wpzoom_rss(); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/dropdown.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/custom.css" type="text/css" media="screen" />
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" /><![endif]-->
<?php if (strlen($wpzoom_misc_favicon) > 1 ) { ?><link rel="shortcut icon" href="<?php echo "$wpzoom_misc_favicon";?>" type="image/x-icon" /><?php } ?>
<?php remove_action('wp_print_styles', 'pagenavi_stylesheets'); ?>	
<?php wp_enqueue_script('jquery');  ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>	
<?php wp_head(); ?>
<?php wpzoom_js( "dropdown" ); ?>
<script type="text/javascript">
var autochangemenu = <?php if ($wpzoom_slider_rotate == 'Yes') { ?>1<?php } ?><?php if ($wpzoom_slider_rotate == 'No') { ?>0<?php } ?>;
</script>

<?php if (is_home() && $paged < 2) { ?><script src="<?php bloginfo('template_directory'); ?>/js/tabs.js" type="text/javascript"></script><?php }?> 
 
</head>

<body>
 
	<div id="header">
	
		<div id="logo">
			<a href="<?php echo get_option('home'); ?>"><?php if ($wpzoom_misc_logo_path) { ?><img src="<?php echo "$wpzoom_misc_logo_path";?>" alt="<?php bloginfo('name'); ?>" /><?php } else { ?><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /><?php } ?></a>
 		</div>
      
		<?php if (strlen($wpzoom_ad_head_imgpath) > 1 && $wpzoom_ad_head_select == 'Yes') { echo '<div id="ad468">'.stripslashes($wpzoom_ad_head_imgpath)."</div>"; }?>
		
	</div>

	<div id="menu">
		<div id="menu-wrap">
			<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => 'dropdown', 'sort_column' => 'menu_order', 'theme_location' => 'primary' ) ); ?>
			
			<div id="rss">
			
				<ul>
				
					<li class="rssimg"><a href="<?php wpzoom_rss(); ?>"><?php echo"$wpzoom_misc_feedburner_t"; ?></a></li>
 					<?php if (strlen($wpzoom_misc_feedburnerID) > 0) {?><li class="emailimg"><a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo"$wpzoom_misc_feedburnerID"; ?>&amp;loc=en_US"><?php echo"$wpzoom_misc_feedburnerID_t"; ?></a></li><?php } ?>
				
				</ul>
				
			</div>
		
		
			<div id="search"> 
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>  
			</div>
			
		</div> <!-- end menu wrap -->
    
    </div> <!-- end menu -->
    
    
	<div id="content-wrap">
		<div id="content">