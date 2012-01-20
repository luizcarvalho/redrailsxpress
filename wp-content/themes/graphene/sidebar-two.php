<?php
/**
 * The Sidebar 2 for display in the content page.
 * Is only called by header.php or footer.php if the sidebar is needed, so no checking is required!
 *
 * @package WordPress
 * @subpackage Graphene
 * @since graphene 1.0
 */
global $graphene_settings;
?>
    
<div id="sidebar2" class="sidebar">

	<?php do_action('graphene_before_sidebar2'); ?>

    <?php 	/* Widgetized sidebar, if supported. */
    if (!is_front_page() && is_active_sidebar('sidebar-two-widget-area')) { // Not home, display normal sidebar if active
		dynamic_sidebar('sidebar-two-widget-area'); 
		
	} elseif (is_front_page() && !$graphene_settings['alt_home_sidebar'] && is_active_sidebar('sidebar-two-widget-area')) { // Home, but alternate sidebar disabled, display normal sidebar if active
		dynamic_sidebar('sidebar-two-widget-area');
	} elseif (is_front_page() && $graphene_settings['alt_home_sidebar'] && is_active_sidebar('home-sidebar-two-widget-area')) { // Home, alternate sidebar enabled, display alternate sidebar if active
		dynamic_sidebar('home-sidebar-two-widget-area');
	} else { // Display the default unwidgetised sidebar otherwise	?>   
    
	<?php /* Author information is disabled per default. Uncomment and fill in your details if you want to use it.
    
	<h3>About the author</h3>
    <p>A little something about you, the author. Nothing lengthy, just an overview.</p>
    </li>
	
    */ ?>
              
    <div class="sidebar-wrap clearfix">
    <h3><?php _e('Meta','graphene'); ?></h3>
        <ul>
            <?php wp_register(); ?>                    
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
            <li class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Posts RSS','graphene'); ?></a></li>
            <li class="rss"><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments RSS','graphene'); ?></a></li>
            <?php /* translators: %s is the link to wordpress.org */ ?>
            <li><?php printf(__('Powered by %s','graphene'), '<a href="http://www.wordpress.org" title="'.esc_attr__('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'graphene').'">WordPress</a>'); ?></li>
        </ul>
    </div>
    
    <div class="sidebar-wrap clearfix">
    <h3><?php _e('Archives', 'graphene'); ?></h3>
        <ul>
        <?php wp_get_archives('type=monthly'); ?>
        </ul>
    </div>
    
    <?php } ?>
    
    <?php wp_meta(); ?>
    
    <?php do_action('graphene_after_sidebar2'); ?>

</div><!-- #sidebar2 -->