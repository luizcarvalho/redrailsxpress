<?php
    new FlexiThemes_FeaturedPosts();
    
    class FlexiThemes_FeaturedPosts
    {
        var $theme;
        var $status = false;
        var $url;
        
        var $defaults = array(
            'enabled_in' => array('homepage'),
            'hook' => 'content_before',
            'hook_priority' => '1',
            'label' => '',
            'image_sizes' => '',
            'source' => 'category',
            'category_num' => '5',
            'excerpt_length' => '32',
            'readmore' => 'More &raquo;',
            'effect' => 'fade',
            'timeout' => '4000',
            'delay' => '0',
            'speed' => '1000', 
            'speedIn' => '',
            'speedOut' => '',
            'default_moreoptions' => array('thumbnail','post_title', 'post_excerpt', 'pager', 'next_prev', 'sync','pause', 'pauseOnPagerHover')
        );
        
        var $moreoptions =  array(
            'thumbnail' => 'Show Thumbnail',
            'post_title' => 'Show Post Title',
            'post_excerpt' => 'Show Post Excerpt',
            'pager' => 'Show Pager / Page Numbers',
            'next_prev' => 'Show Next / Previous Buttons',
            'sync' => 'In/Out transitions should occur simultaneously',
            'pause' => 'Pause on hover',
            'pauseOnPagerHover' => 'Pause when hovering over pager link',
            'continuous' => 'Start next transition immediately after current one completes (Will overwrite the other timing options like: delay, speed etc.)'
        );
        
        var $effects = array(
            'none' => 'No Effect', 
            'fade' => 'Fade', 
            'fadeZoom' => 'Fade Zoom', 
            'blindX' => 'Blind X',
            'blindY' => 'Blind Y',
            'blindZ' => 'Blind Z',
            'cover' => 'Cover',
            'uncover' => 'Uncover',
            'curtainX' => 'Curtain X',
            'curtainY' => 'Curtain Y',
            'growX' => 'Grow X',
            'growY' => 'Grow Y',
            'scrollUp' => 'Scroll Up',
            'scrollDown' => 'Scroll Down',
            'scrollLeft' => 'Scroll Left',
            'scrollRight' => 'Scroll Right',
            'scrollHorz' => 'Scroll Horizontal',
            'scrollVert' => 'Scroll Vertical',
            'slideX' => 'Slide X',
            'slideY' => 'Slide Y',
            'turnDown' => 'Turn Down',
            'turnLeft' => 'Turn Left',
            'turnRight' => 'Turn Right',
            'wipe' => 'Wipe',
            'zoom' => 'Zoom'
        );
        
        function FlexiThemes_FeaturedPosts()
        {
            global $theme;
            $this->theme = $theme;
            $this->url = THEMATER_INCLUDES_URL . '/featuredposts';
            
            if(is_array($this->theme->options['plugins_options']['featuredposts']) ) {
                $this->defaults = array_merge($this->defaults, $this->theme->options['plugins_options']['featuredposts']);
            }
            
            $this->theme->add_hook('head', array(&$this, 'featuredposts_head'));
            $this->theme->add_hook($this->defaults['hook'], array(&$this, 'display_featuredposts'), $this->defaults['hook_priority']);
  
            if(is_admin()) {
                $this->themater_options();
            }
        }
        
        function featuredposts_head()
        {
            if($this->enabled()) {
                echo  "\n<!-- Featured Posts -->\n";
                echo '<script src="' . $this->url . '/scripts/jquery.cycle.all.min.js" type="text/javascript"></script>' . "\n";
                echo  "<!-- /jquery.cycle.all.min.js -->\n\n";
            }
        }
        
        function display_featuredposts()
        {
            if($this->enabled()) {
                
                $featuredposts_moreoptions = $this->theme->get_option('featuredposts_moreoptions');

                $cycle_js = "jQuery(document).ready(function() {\n\t";
                $cycle_js .= "jQuery('.fp-slides').cycle({\n\t\t";
                $cycle_js .= "fx: '" . $this->theme->get_option('featuredposts_effect') ."',\n\t\t";
                $cycle_js .= "timeout: " . $this->theme->get_option('featuredposts_timeout') .",\n\t\t";
                $cycle_js .= "delay: " . $this->theme->get_option('featuredposts_delay') .",\n\t\t";
                $cycle_js .= "speed: " . $this->theme->get_option('featuredposts_speed') .",\n\t\t";
                $cycle_js .= "next: '.fp-next',\n\t\t";
                $cycle_js .= "prev: '.fp-prev',\n\t\t";
                $cycle_js .= "pager: '.fp-pager',\n\t\t";
                
                if($this->theme->display('featuredposts_speedIn')) {
                    $cycle_js .= "speedIn: " . $this->theme->get_option('featuredposts_speedIn') .",\n\t\t";
                }
                
                if($this->theme->display('featuredposts_speedOut')) {
                    $cycle_js .= "speedOut: " . $this->theme->get_option('featuredposts_speedOut') .",\n\t\t";
                }
                
                $featuredposts_continuous = $this->theme->display('continuous', $featuredposts_moreoptions) ? '1' : '0';
                $cycle_js .= "continuous: $featuredposts_continuous,\n\t\t";
                
                $featuredposts_sync = $this->theme->display('sync', $featuredposts_moreoptions) ? '1' : '0';
                $cycle_js .= "sync: $featuredposts_sync,\n\t\t";
                
                $featuredposts_pause = $this->theme->display('pause', $featuredposts_moreoptions) ? '1' : '0';
                $cycle_js .= "pause: $featuredposts_pause,\n\t\t";
                
                $featuredposts_pauseOnPagerHover = $this->theme->display('pauseOnPagerHover', $featuredposts_moreoptions) ? '1' : '0';
                $cycle_js .= "pauseOnPagerHover: $featuredposts_pauseOnPagerHover,\n\t\t";
                
                
                
                $cycle_js .= "cleartype: true,\n\t\t";
                $cycle_js .= "cleartypeNoBg: true\n\t";
                $cycle_js .= "});\n });\n";
                
                $this->theme->custom_js($cycle_js);
                
                if(file_exists(THEMATER_INCLUDES_DIR . '/featuredposts/template.php') ) {
                    require_once(THEMATER_INCLUDES_DIR . '/featuredposts/template.php');
                }
            }
        }
        
        function enabled()
        {
            if($this->status) {
                $is_enabled = $this->status == 'enabled' ? true : false;
                return $is_enabled;
            } else {
                $featuredposts_enabled = $this->theme->get_option('featuredposts_enabled');
                if(is_array($featuredposts_enabled)) {
                    if(
                        (is_home() && in_array('homepage', $featuredposts_enabled) ) 
                        || (is_category() && in_array('categories', $featuredposts_enabled) ) 
                        || (is_tag() && in_array('tags', $featuredposts_enabled) ) 
                        || ((is_day() || is_month() || is_year()) && in_array('archives', $featuredposts_enabled) ) 
                        || (is_search() && in_array('searches', $featuredposts_enabled) ) 
                    ){
                        $this->status = 'enabled';
                        return true;
                    }
                } 
                $this->status = 'disabled';
                return false;
            }
        }

        function featuredposts_source()
        {
            $get_featuredposts_source = $this->theme->get_option('featuredposts_source');
            $featuredposts_sources = array('category'=> 'Category', 'posts' => 'Selected Posts', 'pages' => 'Selected Pages');
            
            foreach($featuredposts_sources as $key=>$val) {
                $featuredposts_sources_selected = $get_featuredposts_source == $key ? 'checked="checked"' : '';
                ?>
                <input type="radio" name="featuredposts_source" onclick="javascript:themater_featuredposts_source('<?php echo $key; ?>');" value="<?php echo $key; ?>" <?php echo $featuredposts_sources_selected; ?> /> <?php echo $val; ?> &nbsp;
                <?php
            }
            ?>
                <script type="text/javascript">
                    function themater_featuredposts_source(source)
                    {
                        $thematerjQ("#flexithemes_featuredposts_category").hide();
                        $thematerjQ("#flexithemes_featuredposts_posts").hide();
                        $thematerjQ("#flexithemes_featuredposts_pages").hide();
                        
                        $thematerjQ("#flexithemes_featuredposts_"+source+"").fadeIn();
                    }
                    jQuery(document).ready(function(){
                        themater_featuredposts_source('<?php echo $get_featuredposts_source; ?>');
                    });
                    
                </script>
            <?php
        }
        
        
        function themater_options()
        {
            $this->theme->admin_option(array('Featured Posts', 15), 
                'Featured Posts', 'featuredposts_enabled', 
                'checkboxes', $this->defaults['enabled_in'], 
                array('options' =>array('homepage'=>'Homepage', 'categories' => 'Category Pages', 'tags' => 'Tag Pages', 'archives' => 'Archive Pages', 'searches'=>'Search Results Pages'), 'help'=> 'Enable featured posts slideshow at:', 'display'=>'extended-top')
            );
            
        
            $image_sizes = $this->defaults['image_sizes'] ? 'Recommended image sizes <strong>' . $this->defaults['image_sizes'] . '</strong>' : '';
            $this->theme->admin_option('Featured Posts', 
                'Featured Posts Images', 'featuredposts_images', 
                'content','<i>The images should be added using the "Set Featured Image" link, located under categories list at post write/edit page. ' . $image_sizes . '</i>'
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Featured Posts Source', 'featuredposts_source', 
                'callback', $this->defaults['source'], 
                array('callback' => array(&$this, 'featuredposts_source'))
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Featured Posts Category Wrap', 'featuredposts_source_category_wrap', 
                'raw', '<div id="flexithemes_featuredposts_category">', 
                array('display'=>'clean')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Number of Feautured Posts', 'featuredposts_source_category_num', 
                'text', $this->defaults['category_num'], 
                array('help'=>'The number of posts you want to show on featured slideshow.', 'display'=>'inline', 'style'=>'width: 60px;')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Featured Posts Category', 'featuredposts_source_category', 
                'select', '', 
                array('options'=>$this->theme->get_categories_array(true, array(''=>'Select Category')), 'help'=>'The selected number of posts form the selected category will be listed in the featured slideshow. The selected category should contain at last 2 posts with featured image set.', 'display'=>'inline')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Featured Posts Category Wrap End', 'featuredposts_source_category_end_wrap', 
                'raw', '</div>', 
                array('display'=>'clean')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Featured Selected Posts Wrap', 'featuredposts_source_posts_wrap', 
                'raw', '<div id="flexithemes_featuredposts_posts">', 
                array('display'=>'clean')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Post IDs', 'featuredposts_source_posts', 
                'text', '', 
                array('help'=>'Enter individual post IDs to display in the slideshow. Separate IDs with commas. <br />You should add at last 2 post ID\'s with featured image set.', 'display'=>'inline')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Featured Selected Posts Wrap End', 'featuredposts_source_posts_wrap_end', 
                'raw', '</div>', 
                array('display'=>'clean')
            );
            
            
            $this->theme->admin_option('Featured Posts', 
                'Featured Selected Pages Wrap', 'featuredposts_source_pages_wrap', 
                'raw', '<div id="flexithemes_featuredposts_pages">', 
                array('display'=>'clean')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Page IDs', 'featuredposts_source_pages', 
                'text', '', 
                array('help'=>'Enter individual page IDs to display in the slideshow. Separate IDs with commas. <br />You should add at last 2 page ID\'s with featured image set.', 'display'=>'inline')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Featured Selected Pages Wrap End', 'featuredposts_source_pages_wrap_end', 
                'raw', '</div>', 
                array('display'=>'clean')
            );
            
             $this->theme->admin_option('Featured Posts', 
                'Slideshow Effect', 'featuredposts_effect', 
                'select', $this->defaults['effect'], 
                array('options'=> $this->effects)
            );
            
             $this->theme->admin_option('Featured Posts', 
                'Misc Options', 'featuredposts_misc_options_info', 
                'content', ''
            );

            $this->theme->admin_option('Featured Posts', 
                'Heading Label', 'featuredposts_label', 
                'text', $this->defaults['label'], 
                array('help'=> 'Leave blank to hide',  'display'=>'inline')
            );
            
            $this->theme->admin_option('Featured Posts', 
                '"Read More" link text', 'featuredposts_readmore', 
                'text', $this->defaults['readmore'], 
                array('help'=> 'Leave blank to hide',  'display'=>'inline')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Post Excerpt Length', 'featuredposts_excerpt_length', 
                'text', $this->defaults['excerpt_length'], 
                array('suffix'=> 'words', 'style'=>'width: 80px;', 'display'=>'inline')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Slides Timeout', 'featuredposts_timeout', 
                'text', $this->defaults['timeout'], 
                array('suffix'=> ' ms.', 'style'=>'width: 80px;', 'display'=>'inline', 'help' => 'Milliseconds between slide transitions (0 to disable auto advance)')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Slides Delay', 'featuredposts_delay', 
                'text', $this->defaults['delay'], 
                array('suffix'=> ' ms.', 'style'=>'width: 80px;', 'display'=>'inline', 'help'=>'Additional delay (in ms) for first transition (hint: can be negative)')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Slides Speed', 'featuredposts_speed', 
                'text', $this->defaults['speed'], 
                array('suffix'=> ' ms.', 'style'=>'width: 80px;', 'display'=>'inline', 'help'=>'Speed of the transition (any valid fx speed value)')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Slides Speed In', 'featuredposts_speedIn', 
                'text', $this->defaults['speedIn'], 
                array('suffix'=> ' ms.', 'style'=>'width: 80px;', 'display'=>'inline', 'help'=>'speed of the \'in\' transition ')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'Slides Speed Out', 'featuredposts_speedOut', 
                'text', $this->defaults['speedOut'], 
                array('suffix'=> ' ms.', 'style'=>'width: 80px;', 'display'=>'inline', 'help'=>'speed of the \'out\' transition ')
            );
            
            $this->theme->admin_option('Featured Posts', 
                'More Slideshow Options', 'featuredposts_moreoptions', 
                'checkboxes', $this->defaults['default_moreoptions'], 
                array('display'=>'clean', 'options'=> $this->moreoptions)
            );
        }
    }
?>