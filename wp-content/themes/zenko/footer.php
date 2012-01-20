<?php 
global $options; foreach ($options as $value) { if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>
</div> <!-- end content -->
</div> <!-- end content wrap -->
 
	<div id="footer">
	
		<div class="footer-wrap">
      
			<div id="fside">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
				<?php endif; ?>
			</div>
			
		</div> <!-- end footer wrap-->
        
        <div class="clear"></div>      
                      
		<div id="copyright">
          
			<div class="footer-wrap"><?php _e('Copyright', 'wpzoom');?> &copy; <?php echo date("Y"); ?> &mdash; <a href="<?php echo get_option('home'); ?>/" class="on"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved.', 'wpzoom');?><br />
			<span><?php _e('Designed by', 'wpzoom');?> <a href="http://www.wpzoom.com" target="_blank" title="WPZOOM WordPress Themes"><img src="<?php bloginfo('template_directory'); ?>/images/wpzoom.png" alt="WPZOOM" /></a></span>
                
			</div> <!-- end footer wrap-->
			
		</div>
		
   </div> <!-- end footer -->
   
<?php if ($wpzoom_misc_analytics != '' && $wpzoom_misc_analytics_select == 'Yes')
{
  echo stripslashes($wpzoom_misc_analytics);
} ?>
  
<?php wp_footer() ?> 
 
</body>
</html>