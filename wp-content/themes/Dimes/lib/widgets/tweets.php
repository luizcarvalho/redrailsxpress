<?php

global $theme;

$themater_tweets_defaults = array(
    'title' => 'Recent Tweets',
    'number' => '5',
    'username' => 'twitter',
    'link_title' => 'true',
    'refresh' => '30',
    'bird' => 'true',
    'autolinks' => 'true',
    'user_links' => 'true',
    'date' => 'true'
);
  
$theme->options['widgets_options']['tweets'] = is_array($theme->options['widgets_options']['tweets'])
    ?  array_merge($themater_tweets_defaults, $theme->options['widgets_options']['tweets'])
    : $themater_tweets_defaults;
    
add_action('widgets_init', create_function('', 'return register_widget("ThematerTweets");'));

class ThematerTweets extends WP_Widget 
{
    function ThematerTweets() 
    {
        $widget_options = array('description' => __('Advanced widget for displaying the recent tweets', 'themater') );
        $control_options = array( 'width' => 400);
		$this->WP_Widget('themater_tweets', '&raquo; Twitter Widget', $widget_options, $control_options);
    }

    function widget($args, $instance)
    {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        
        $twitterFeed = $this->loadTwitterFeed($instance);
        if (!is_wp_error( $twitterFeed ) ) {
            $maxitems = $twitterFeed->get_item_quantity($instance['number']); 
            $rss_items = $twitterFeed->get_items(0, $maxitems); 
            if($maxitems > 0) {
            ?>
                <ul class="widget-wrap"><li class="tweets-widget">
                <?php  if ( $title ) {  ?> <h3 class="widgettitle"><?php 
                    if($instance['link_title']) {
                        printf("%s$title%s", "<a href=\"http://twitter.com/$instance[username]\" target=\"_blank\" title=\"$title\">", "</a>");
                    } else {
                        echo $title; 
                    }
                ?></h3> <?php }  ?>
                    <ul>
                        <?php
                        foreach($rss_items as $item) { ?>
                        
                             <li <?php if($instance['bird']) { echo 'class="tweets-bird"'; } ?>>
                                <?php
                                    $output_msg = substr(strstr($item->get_description(),': '), 2, strlen($item->get_description()));
                                    if ($instance['autolinks']) { 
                                        $output_msg = $this->conver_hyperlinks($output_msg); 
                                    }
                                    if ($instance['user_links']) { 
                                        $output_msg = $this->conver_twitter_users($output_msg); 
                                    }
                                    
                                    if ($instance['date']) { 
                                        $time = strtotime($item->get_date());
                    
                                        if ( ( abs( time() - $time) ) < 86400 ) {
                                            $human_time = sprintf( __('%s ago', 'themater'), human_time_diff( $time ) );
                                        } else {
                                            $human_time = date(__('F j, Y'), $time);
                                        }
                                        
                                        $output_msg = $output_msg . sprintf( __('%s'),' <a href="'.$item->get_permalink().'" class="tweets-widget-time" title="' . date(__('h:i A F j, Y'), $time) . '" target="_blank">'.$human_time.'</a>' );
                                    }
                                    
                                    echo $output_msg;
                                ?>
                             </li>
                             
                         <?php } ?>
                    </ul>
                    <?php
                ?>
                </li></ul>
                <?php
            }
        }
    }

    function update($new_instance, $old_instance) 
    {				
    	$instance = $old_instance;
    	$instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['username'] = str_replace(array('http://twitter.com/', 'http://www.twitter.com/', 'www.twitter.com', 'twitter.com'), array('','','',''), strip_tags($new_instance['username']) );
        $instance['link_title'] = strip_tags($new_instance['link_title']);
        $instance['refresh'] = strip_tags($new_instance['refresh']);
        $instance['bird'] = strip_tags($new_instance['bird']);
        $instance['autolinks'] = strip_tags($new_instance['autolinks']);
        $instance['user_links'] = strip_tags($new_instance['user_links']);
        $instance['date'] = strip_tags($new_instance['date']);
        return $instance;
    }
    
    function form($instance) 
    {	
        global $theme;
        
		$instance = wp_parse_args( (array) $instance, $theme->options['widgets_options']['tweets'] );
        
        ?>
            <div class="tt-widget">
                <table width="100%">
                    <tr>
                        <td class="tt-widget-label" width="20%"><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label></td>
                        <td class="tt-widget-content" width="80%"><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></td>
                    </tr>
                    
                    <tr>
                        <td class="tt-widget-label"><label for="<?php echo $this->get_field_id('username'); ?>">Twitter Username:</label></td>
                        <td class="tt-widget-content"><input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($instance['username']); ?>" /></td>
                    </tr>
                    
                    <tr>
                        <td class="tt-widget-label">Display:</td>
                        <td class="tt-widget-content">
                            latest <input style="width: 50px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($instance['number']); ?>" /> tweets, refresh every 
                            <input style="width: 50px;" id="<?php echo $this->get_field_id('refresh'); ?>" name="<?php echo $this->get_field_name('refresh'); ?>" type="text" value="<?php echo esc_attr($instance['refresh']); ?>" /> minutes
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="tt-widget-label">Misc Options:</td>
                        <td class="tt-widget-content">
                            <input type="checkbox" name="<?php echo $this->get_field_name('link_title'); ?>"  <?php checked('true', $instance['link_title']); ?> value="true" /> Link the widget title to my Twitter profile hmepage.
                            <br /><input type="checkbox" name="<?php echo $this->get_field_name('bird'); ?>"  <?php checked('true', $instance['bird']); ?> value="true" /> Display the bird icon.
                            <br /><input type="checkbox" name="<?php echo $this->get_field_name('autolinks'); ?>"  <?php checked('true', $instance['autolinks']); ?> value="true" />  Convert URLs to links
                            <br /><input type="checkbox" name="<?php echo $this->get_field_name('user_links'); ?>"  <?php checked('true', $instance['user_links']); ?> value="true" />  Convert @users to links
                            <br /><input type="checkbox" name="<?php echo $this->get_field_name('date'); ?>"  <?php checked('true', $instance['date']); ?> value="true" /> Show the date/time
                        </td>
                    </tr>
                    
                </table>
            </div>
        
        <?php 
    }
    
    function loadTwitterFeed($instance)
    {   
        require_once (ABSPATH . WPINC . '/class-feed.php');
        $url = 'http://twitter.com/statuses/user_timeline/' . $instance['username'] .'.rss';
        $cache_duration = $instance['refresh'] * 60;
        
    	$feed = new SimplePie();
    	$feed->set_feed_url($url);
    	$feed->set_cache_class('WP_Feed_Cache');
    	$feed->set_file_class('WP_SimplePie_File');
    	$feed->set_cache_duration($cache_duration);
    	$feed->init();
    	$feed->handle_content_type();

        if ( $feed->error() ) {
            return new WP_Error('simplepie-error', $feed->error());
        }
        return $feed;
    }
    
    
    function conver_hyperlinks($text) 
    {
        $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
        $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);    
        $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
        $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
        return $text;
    }
    
    function conver_twitter_users($text) 
    {
        $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
        return $text;
    } 
} 
?>