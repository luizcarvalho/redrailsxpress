<?php global $theme; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php function wp_initialize_the_theme() { if (!function_exists("wp_initialize_the_theme_load") || !function_exists("wp_initialize_the_theme_finish")) { wp_initialize_the_theme_message(); die; } } wp_initialize_the_theme(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php $theme->meta_title(); ?></title>
<?php $theme->hook('meta'); ?>
<link rel="stylesheet" href="<?php echo THEMATER_URL; ?>/css/screen.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo THEMATER_URL; ?>/css/print.css" type="text/css" media="print" />
<!--[if lt IE 8]><link rel="stylesheet" href="<?php echo THEMATER_URL; ?>/css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<link rel="stylesheet" href="<?php echo THEMATER_URL; ?>/css/defaults.css" type="text/css" media="screen, projection" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen, projection" />

<?php  wp_head(); ?>
<?php $theme->hook('head'); ?>

</head>

<body <?php body_class(); ?>>
<?php $theme->hook('html_before'); ?>

<div id="wrapper">

    <div id="container" class="container">
    
    <?php if($theme->display('menu_primary')) { ?>
        <div class="span-24">
            <?php $theme->hook('menu_primary'); ?>
        </div>
    <?php } ?>
    
        <div id="header" class="span-24">
        
            <div class="branding">
            <?php if ($theme->display('logo')) { ?> 
                <a href="<?php bloginfo('url'); ?>"><img class="logo" src="<?php $theme->option('logo'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
            <?php } else { ?> 
                <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
                <h2 class="site-description"><?php bloginfo('description'); ?></h2>
            <?php } ?> 
            </div><!-- .branding -->

            <div class="header-banner">

                <?php $theme->option('header_banner'); ?> 

            </div><!-- .header-banner -->
            
        </div><!-- #header -->
        
        <?php if($theme->display('menu_secondary')) { ?>
            <div class="span-24">
                <?php $theme->hook('menu_secondary'); ?>
            </div>
        <?php } ?>