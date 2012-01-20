<?php
/**
 * Setting the default admin theme options and menus
*/

    /*********************************************
     * General Options
     *********************************************
    */

        // General Settings
        $this->admin_option('General', 
            'Logo Image', 'logo', 
            'imageupload', get_bloginfo('template_directory') . "/images/logo.png", 
            array('help' => "Enter the full url to your logo image. Leave it blank if you don't want to use a logo image.")
        );
        
        $this->admin_option('General', 
            'Favicon', 'favicon', 
            'imageupload', get_bloginfo('template_directory') . "/images/favicon.png", 
            array('help' => "Enter the full url to your favicon file. Leave it blank if you don't want to use a favicon.")
        );
        
        $this->admin_option('General',
            'Posts Date Format', 'dateformat', 
            'text', 'F d, Y', 
            array('help' => 'Please, check <a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">this reference</a> for more details.', 'display'=>'extended')
        );
        
        $this->admin_option('General',
            'RSS Feed URL', 'rss_url', 
            'text', '', 
            array('help' => 'Enter your custom RSS Feed URL, Feedburner or other.')
        );
        
        $this->admin_option('General',
            'Custom CSS', 'custom_css', 
            'textarea', '', 
            array('help' => 'Any code you add here will appear in the head section of every page of your site. Add only the css code without &lt;style&gt;&lt;/style&gt; style blocks. They are auto added.', 'style'=>'height: 180px;')
        );
        
        $this->admin_option('General',
            'Head Code', 'head_code', 
            'textarea', '', 
            array('help' => 'Any code you add here will appear in the head section, just before &lt;/head&gt; of every page of your site.', 'style'=>'height: 180px;')
        );
        
        $this->admin_option('General',
            'Footer Code', 'footer_code', 
            'textarea', '', 
            array('help' => 'Any code you add here will appear just before &lt;/body&gt; tag of every page of your site.', 'style'=>'height: 180px;')
        );
        
        $this->admin_option('General',
        'Reset Theme Options', 'reset_options', 
        'content', '
        <div id="fp_reset_options" style="margin-bottom:40px; display:none;"></div>
        <div style="margin-bottom:40px;"><a class="button-primary tt-button-red" onclick="if (confirm(\'All the saved settings will be lost! Do you really want to continue?\')) { themater_form(\'admin_options&do=reset\', \'fpForm\',\'fp_reset_options\',\'true\'); } return false;">Reset Options Now</a></div>', 
        array('help' => 'Reset the theme options to default values. <span style="color:red;"><strong>Note:</strong> All the previous saved settings will be lost!</span>', 'display'=>'extended-top')
    );
    
    
    /*********************************************
     * Layout Options
     *********************************************
    */
        
        $this->admin_option('Layout', 
            'Featured Image Options', 'featured_image_settings', 
            'content', ''
        );
        
        $this->admin_option('Layout',
            'Image Width', 'featured_image_width', 
            'text', '200', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout',
            'Image Height', 'featured_image_height', 
            'text', '160', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout',
            'Image Position', 'featured_image_position', 
            'radio', 'alignleft', 
            array('options'=>array('alignleft' => 'Left', 'alignright'=> 'Right', 'aligncenter'=>'Center') , 'display'=>'inline')
        );
        
        
        $this->admin_option('Layout',
            '"Read More" Text', 'read_more', 
            'text', 'Read More'
        );

        $this->admin_option('Layout', 
            'Custom Footer Text', 'footer_custom_text', 
            'textarea', '', 
            array('help' => 'Add your custom footer text. Will override the default theme generated text.', 'display'=>'extended-top', 'style'=>'height: 140px;')
        );
    
   /*********************************************
     * Ads
     *********************************************
    */

    $this->admin_option('Ads', 
        'Header Banner', 'header_banner', 
        'textarea', '', 
        array('help' => 'Enter your 468x60 px. ad code. You may use any html code here, including your 468x60 px Adsense code.', 'style'=>'height: 120px;')
    ); 
    
?>