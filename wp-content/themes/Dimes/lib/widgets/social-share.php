<?php

global $theme;
$themater_social_share_defaults = array(
    'iconset' => 'icons_1',
    'title' => 'Share',
    'twitter_enabled' => 'true', 'twitter_order' => '1',
    'facebook_enabled' => 'true', 'facebook_order' => '2',
    'digg_enabled' => 'true', 'digg_order' => '3',
    'delicious_enabled' => 'true', 'delicious_order' => '4',
    'stumbleupon_enabled' => 'true', 'stumbleupon_order' => '5',
    'favorites_enabled' => 'true', 'favorites_order' => '6',
    'more_enabled' => 'true', 'more_order' => '7'
);

$theme->options['widgets_options']['socialshare'] = is_array($theme->options['widgets_options']['socialshare'])
    ? array_merge($themater_social_share_defaults, $theme->options['widgets_options']['socialshare'])
    : $themater_social_share_defaults;

add_action('widgets_init', create_function('', 'return register_widget("ThematerSocialShare");'));

class ThematerSocialShare extends WP_Widget 
{
    function ThematerSocialShare() 
    {
        $widget_options = array('description' => __('Add social network sharing icons. Uses AddThis.com', 'themater') );
        $control_options = array( 'width' => 280);
		$this->WP_Widget('themater_social_share', '&raquo; Social Share Buttons', $widget_options, $control_options);
    }

    function widget($args, $instance)
    {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        
        $display_networks = false;
        
        $social_networks = $this->getSocialNetworks();
        
        $i = 1;
        foreach($social_networks as $social_network_name => $social_network_title) {
            if($instance[$social_network_name . '_enabled']) {
                $display_networks[$social_network_name] = $instance[$social_network_name . '_order'] ? $instance[$social_network_name . '_order'] : $i;
                $i++;
            } 
        }
        if(is_array($display_networks)) {
            asort($display_networks);
            ?>
            <ul class="widget-wrap"><li class="social-share-widget"><?php if($title) {?><h3 class="widgettitle"><?php echo $title; ?></h3><?php }?>
                <ul><li>
                <?php
                foreach($display_networks as $display_network_name => $display_network_title) {
                ?>
                    <a class="addthis_button_<?php echo $display_network_name; ?>"><img src="<?php echo THEMATER_URL; ?>/images/social-share/<?php echo $instance['iconset']; ?>/<?php echo $display_network_name; ?>.png" width="32" height="32" alt="<?php echo $display_network_title; ?>" /></a><?php echo "\n"; ?>
                <?php    
                }
                ?>
                </li></ul>
                <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
            </li></ul>
        <?php
        }
            
        
    }

    function update($new_instance, $old_instance) 
    {				
    	$instance = $old_instance;
    	$instance['iconset'] = strip_tags($new_instance['iconset']);
        $instance['title'] = strip_tags($new_instance['title']);
        $social_networks = $this->getSocialNetworks();
        
        foreach($social_networks as $social_network_name => $social_network_title) {
            $instance[$social_network_name . '_enabled'] = strip_tags($new_instance[$social_network_name . '_enabled']);
            $instance[$social_network_name . '_order'] = strip_tags($new_instance[$social_network_name . '_order']);
        }
        return $instance;
    }
    
    function form($instance) 
    {	
        global $theme;
		$instance = wp_parse_args( (array) $instance, $theme->options['widgets_options']['socialshare'] );
        $icon_sets = 8;
        $social_networks = $this->getSocialNetworks();
        
        ?>
        <div class="tt-widget">
            <table width="100%">
                <tr>
                    <td class="tt-widget-label" width="20%"><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label></td>
                    <td class="tt-widget-content" width="80%"><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></td>
                </tr>
            </table>
        </div>
        
        <div class="tt-widget">
            <div class="tt-widgettitle">Select Icon Set</div>
            <table width="100%">
                <?php
                    for($i=1; $i <= $icon_sets; $i++) {
                        $icons_id = 'icons_' . $i;
                        ?>
                            <tr>
                                <td class="tt-widget-label" width="5%"><input type="radio" name="<?php echo $this->get_field_name('iconset'); ?>" <?php checked($icons_id, $instance['iconset']); ?> value="<?php echo $icons_id; ?>"  /></td>
                                <td class="tt-widget-content" width="95%">
                                    <?php
                                        foreach($social_networks as $social_network_name => $social_network_title) {
                                            echo '<img src="' . THEMATER_URL . '/images/social-share/' . $icons_id . '/' . $social_network_name . '.png" title="' . $social_network_title . '" /> ';
                                        }
                                    ?>
                                
                                </td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
        </div>  
        
        <div class="tt-widget"> 
            <div class="tt-widgettitle">Customize View / Order</div>
            <table width="100%">
                <tr>
                    <td class="tt-widget-label" width="34%"><strong>Network:</strong></td>
                    
                    <td class="tt-widget-content" width="33%"><strong>Enabled?</strong></td>
                    <td class="tt-widget-content"><strong>Order:</strong></td>
                </tr>
                <?php
                    $j = 1;
                    foreach($social_networks as $social_network_name => $social_network_title) {
                        ?>
                        <tr>
                            <td class="tt-widget-label"><?php echo '<img src="' . THEMATER_URL . '/images/social-share/' . $instance['iconset'] . '/' . $social_network_name . '.png" title="' . $social_network_title . '" /> '; ?></td>
                            
                            <td class="tt-widget-content"> <input type="checkbox" name="<?php echo $this->get_field_name($social_network_name . '_enabled'); ?>" <?php checked('true', $instance[$social_network_name . '_enabled']); ?> value="true" /> </td>
                            <td class="tt-widget-content"><input type="text" style="width: 40px;" name="<?php echo $this->get_field_name($social_network_name . '_order'); ?>" value="<?php if(!$instance[$social_network_name . '_order']) { echo $j; } else { echo $instance[$social_network_name . '_order']; }; ?>" /></td>
                        </tr>
                        <?php
                        $j++;
                    }
                ?>
                </table>
        </div>

        <?php 
    }
    
    function getSocialNetworks()
    {
        $social_networks = array('twitter' => 'Twitter', 'facebook' => 'Facebook', 'digg' => 'Digg', 'delicious' => 'Delicious', 'stumbleupon' => 'StumbleUpon', 'favorites'=> 'Favorites', 'more' => 'More Networks');
        return $social_networks;
    }
} 
?>