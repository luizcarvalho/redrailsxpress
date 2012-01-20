<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="robots" content="follow, all" />
<meta name="language" content="en, sv" />
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<link rel="Shortcut Icon" href="<?php echo get_settings('home'); ?>/" type="image/x-icon" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
<script src="<?php bloginfo('template_directory'); ?>/scripts/prototype-1.6.0.3.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/effects.js" type="text/javascript"></script>
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head();?>
</head>
<body id="body" <?php if ( is_home() ) { ?> class="home"<?php } ?> <?php if ( is_single() ) { ?>  onload="load()" onunload="GUnload()"<?php } ?>>
<div id="topstripe">
<div class="container_12">
<div id="topstripe_left" class="grid_6">
<p><?php bloginfo('name'); ?></p>
</div><!-- end topstripe_left -->
<div id="topstripe_right" class="grid_6">
<p><?php bloginfo('description'); ?></p>
</div><!-- end topstripe_right -->
</div><!-- end topstripe container_12 -->
</div><!-- end topstripe -->
<div id="wrapper" class="container_12">
<div id="logo" class="grid_3">
<a href="<?php bloginfo('url');?>"><?php if ( !function_exists('show_logo')
		|| !show_logo() ) : ?></a>
		<?php endif; ?>
</div><!-- end logo -->	<span style="float:left;"><?php newThemeOptions_showHeaderBanner() ?></span>
<div id="contact_button"><a href="/contact"><img alt="" src="<?php bloginfo('template_url') ?>/images/online_help.png" /></a></div>	
<!-- end contact button -->	
<div class="clear"></div>
<div id="menubg">
<div  class="grid_12 ">
<ul class="sf-menu">
<li ><a title="Find your Dream Home, Click here to access our search services"  href="<?php echo get_option('home'); ?>/" class="on">Find a Home</a></li>	
<?php wp_list_pages('exclude=Home&sort_column=menu_order&title_li='); ?>
</ul>  <!-- end menu -->
</div> <!-- end nav -->
</div> <!-- end menubg -->