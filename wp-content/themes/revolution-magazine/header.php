<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="robots" content="follow, all" />
<meta name="language" content="en, sv" />

<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<!-- leave this for stats please -->

<link rel="Shortcut Icon" href="<?php echo get_settings('home'); ?>/wp-content/themes/revolution-magazine/images/favicon.ico" type="image/x-icon" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
<style type="text/css" media="screen">
<!-- @import url( <?php bloginfo('stylesheet_url'); ?> ); -->
</style>
<link rel="stylesheet" type="text/css" href="<?php echo get_settings('home'); ?>/wp-content/themes/revolution-magazine/javascript/ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="<?php echo get_settings('home'); ?>/wp-content/themes/revolution-magazine/javascript/ajaxtabs/ajaxtabs.js">
</script>
</head>

<body>

<div id="wrap">

<div id="top">
	<img src="<?php bloginfo('template_url'); ?>/images/top.gif" alt="Top" />
</div>

<div id="header">

	<div class="headerleft">
		<a href="<?php echo get_settings('home'); ?>/"><img src="<?php bloginfo('template_url'); ?>/images/logo.gif" alt="<?php bloginfo('description'); ?>" /></a>
	</div>
	
	<div class="headerright">
		<a href="#"><img src="<?php bloginfo('template_url'); ?>/images/468x60.gif" alt="Featured Ad" /></a>
	</div>

</div>

<div id="navbar">

	<div id="navbarleft">
		<ul>
			<?php wp_list_pages('title_li=&depth=1&sort_column=menu_order'); ?>
		</ul>
	</div>
	
	<div id="navbarright">	
		<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="text" value="Search this website..." name="s" id="s" onfocus="if (this.value == 'Search this website...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search this website...';}" />
		<input type="submit" id="sbutt" value="GO" /></form>
	</div>
	
</div>

<div id="subnav">

	<div id="subnavleft">
		<script src="<?php bloginfo('template_url'); ?>/javascript/date.js" type="text/javascript"></script>
	</div>
	
	<div id="subnavright">
		<a href="<?php bloginfo('rss_url'); ?>"><img style="vertical-align:middle" src="<?php bloginfo('template_url'); ?>/images/rss.gif" alt="Subscribe to <?php bloginfo('name'); ?>" /></a><a href="<?php bloginfo('rss_url'); ?>">Subscribe</a>
	</div>
		
</div>