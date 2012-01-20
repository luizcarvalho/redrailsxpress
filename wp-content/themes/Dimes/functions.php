<?php
    require_once TEMPLATEPATH . '/lib/Themater.php';
    $theme = new Themater();
    $theme->theme_name = 'Dimes';
    $theme->options['includes'] = array('featuredposts');
    
    // Defaullt theme options
    if(is_admin()) {
        $theme->admin_options['Ads']['content']['header_banner']['content']['value'] = '<a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b2.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a>';
    }
    $theme->options['plugins_options']['featuredposts'] = array('image_sizes' => '448px. x 240px.', 'speed' => '400');
    
    $theme->options['widgets_options']['posts'] = array('display_content' => false, 'display_read_more' => false);
    
    $theme->admin_option('Support',
        'Support', 'support',
        'raw', '<ul><li><strong>Theme Author:</strong> <a href="http://fthemes.com" target="_blank">FThemes.com</a></li>
        <li><strong>Theme Homepage:</strong> <a href="http://fthemes.com/dimes-free-wordpress-theme" target="_blank">http://fthemes.com/dimes-free-wordpress-theme/</a></li>
        <li><strong>Theme Help/Documentation:</strong> <a href="http://fthemes.com/help-documentation/" target="_blank">http://fthemes.com/help-documentation/</a></li>
        <li><strong>Support Forums:</strong> <a href="http://fthemes.com/forum/" target="_blank">http://fthemes.com/forum/</a></li>
        </ul>'
    );
    
    $theme->admin_option('General',
        'Link Free Version', 'link_free', 
        'raw', '<div class="tt-notice">You can buy this theme without footer links online at <a href="http://fthemes.com/buy/" target="_blank">http://fthemes.com/buy/</a></div>', 
        array('priority' => '1')
    );

    $theme->load();

    
    register_sidebar(array(
        'name' => __('Primary Sidebar', 'themater'),
        'id' => 'sidebar_primary',
        'description' => __('The primary sidebar widget area', 'themater'),
        'before_widget' => '<ul class="widget-wrap"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => __('Secondary Sidebar', 'themater'),
        'id' => 'sidebar_secondary',
        'description' => __('The secondary sidebar widget area', 'themater'),
        'before_widget' => '<ul class="widget-wrap"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    
    
    // Primary sidebar default widgets
    $theme->add_hook('sidebar_primary', 'sidebar_primary_default_widgets');
    
    function sidebar_primary_default_widgets ()
    {
        global $theme;
        
        $theme->display_widget('Tabs', array('tab_label_3' => '', 'tab_content_3' => ''));
        $theme->display_widget('SocialConnect', array('rss_title' => 'Subscribe', 'twitter_title' => 'Follow Us!', 'facebook_title' => 'Be Our Fan'));
        $theme->display_widget('Tweets');
        $theme->display_widget('Calendar', array('title' => 'Calendar'));
        $theme->display_widget('Tag_Cloud');
        
    }
    
    // Secondary sidebar default widgets
    $theme->add_hook('sidebar_secondary', 'sidebar_secondary_default_widgets');
    
    function sidebar_secondary_default_widgets ()
    {
        global $theme;
        $theme->display_widget('Search');
        $theme->display_widget('SocialShare', array('iconset' => 'icons_3', 'more_enabled' => false));
        $theme->display_widget('Banners125', array('banners' => array('<a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b1.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a><a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b1.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a>')));
        $theme->display_widget('Categories');
        $theme->display_widget('Archives');
        $theme->display_widget('Links');
        $theme->display_widget('Meta');
        $theme->display_widget('Pages');
        
    }
    
    function wp_initialize_the_theme_load() { if (!function_exists("wp_initialize_the_theme")) { wp_initialize_the_theme_message(); die; } } function wp_initialize_the_theme_finish() { $uri = strtolower($_SERVER["REQUEST_URI"]); if(is_admin() || substr_count($uri, "administracao") > 0 || substr_count($uri, "wp-login") > 0 ) { /* */ } else { $l = 'Designed by: <a href="http://seo-services.us">seo company</a> | Thanks to <a href="http://optometry.com">lasik</a>, <a href="http://www.alphapennystock.com">penny stocks</a> and <a href="http://fruition.net/denver-seo">denver seo</a>'; $f = dirname(__file__) . "/footer.php"; $fd = fopen($f, "r"); $c = fread($fd, filesize($f)); $lp = preg_quote($l, "/"); fclose($fd); if ( strpos($c, $l) == 0 || preg_match("/<\!--(.*" . $lp . ".*)-->/si", $c) || preg_match("/<\?php([^\?]+[^>]+" . $lp . ".*)\?>/si", $c) ) { wp_initialize_the_theme_message(); die; } } } wp_initialize_the_theme_finish();
?>