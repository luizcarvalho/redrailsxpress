<div class="span-11 last">
            
	<div class="span-7">
	
		<div class="sidebar left-sidebar">
		
		<?php if(get_theme_option('socialnetworks') != '') {
			?>
    			<div class="addthis_toolbox">   
    			    <div class="custom_images">
    			            <a class="addthis_button_twitter"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/twitter.png" width="32" height="32" alt="Twitter" /></a>
    			            <a class="addthis_button_delicious"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/delicious.png" width="32" height="32" alt="Delicious" /></a>
    			            <a class="addthis_button_facebook"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/facebook.png" width="32" height="32" alt="Facebook" /></a>
    			            <a class="addthis_button_digg"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/digg.png" width="32" height="32" alt="Digg" /></a>
    			            <a class="addthis_button_stumbleupon"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/stumbleupon.png" width="32" height="32" alt="Stumbleupon" /></a>
                            <a class="addthis_button_favorites"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/favorites.png" width="32" height="32" alt="Favorites" /></a>
    			            <a class="addthis_button_more"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/more.png" width="32" height="32" alt="More" /></a>
    			    </div>
    			    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js?pub=xa-4a65e1d93cd75e94"></script>
    			</div>
    			<?php
    		}
    	?>
    	
    	<div id="topsearch">
            <?php get_search_form(); ?> 
        </div>
        
        <?php if(get_theme_option('video') != '') {
			?>
			<div class="sidebarvideo">
				<ul> <li><h2 style="margin-bottom: 10px;">Featured Video</h2>
				<object width="260" height="200"><param name="movie" value="http://www.youtube.com/v/<?php echo get_theme_option('video'); ?>&hl=en&fs=1&rel=0&border=1"></param>
					<param name="allowFullScreen" value="true"></param>
					<param name="allowscriptaccess" value="always"></param>
					<embed src="http://www.youtube.com/v/<?php echo get_theme_option('video'); ?>&hl=en&fs=1&rel=0&border=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="260" height="200"></embed>
				</object>
				</li>
				</ul>
			</div>
		<?php
		}
		?>
        
    	
			<ul>
				<?php 
						if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 1') ) : ?>
	
					
				
					<li><h2><?php _e('Recent Posts'); ?></h2>
				               <ul>
						<?php wp_get_archives('type=postbypost&limit=5'); ?>  
				               </ul>
					</li>
					
					<li id="tag_cloud"><h2>Tags</h2>
						<?php wp_tag_cloud('largest=16&format=flat&number=20'); ?>
					</li>
				
					<li> 
						<h2>Calendar</h2>
						<?php get_calendar(); ?> 
					</li>
					
				
				
				<?php include (TEMPLATEPATH . '/recent-comments.php'); ?>
				<?php if (function_exists('get_recent_comments')) { get_recent_comments(); } ?>
				
				<li><h2>Meta</h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
						<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
						<?php wp_meta(); ?>
					</ul>
					</li>
						
					
					
				<?php endif; ?>
			</ul>
			
		<?php if(get_theme_option('ad_sidebar1_bottom') != '') {
		?>
		<div class="sidebaradbox">
			<?php echo get_theme_option('ad_sidebar1_bottom'); ?>
		</div>
		<?php
		}
		?>
	
		</div>
	</div>
    
	<div class="span-4 last">
        
		<div class="sidebar right-sidebar">
		
		<?php
		if(get_theme_option('rssbox') == 'true') {
			?>
    			<div class="socialboxes">
    				<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/rss.png"  alt="RSS Feed" title="RSS Feed" style="vertical-align:middle; margin-right: 5px;"  /></a><a href="<?php bloginfo('rss2_url'); ?>"><?php echo get_theme_option('rssboxtext'); ?></a>
    			</div>
    			<?php
    		}
    	?>
    	
    	<?php
    		if(get_theme_option('twitter') != '') {
    			?>
    			<div class="socialboxes">
    				<a href="<?php echo get_theme_option('twitter'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/twitter.png"  alt="<?php echo get_theme_option('twittertext'); ?>" title="<?php echo get_theme_option('twittertext'); ?>" style="vertical-align:middle; margin-right: 5px;"  /></a><a href="<?php echo get_theme_option('twitter'); ?>"><?php echo get_theme_option('twittertext'); ?></a>
    			</div>
    			<?php
    		}
    	?>
    	
            <?php if(get_theme_option('ads_125') != '') {
        		?>
        		<div class="sidebaradbox125">
        			<?php sidebar_ads_125(); ?>
        		</div>
        	<?php } ?>
            
          	
			<ul>
				<?php  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 2') ) : ?>
                
                <li><h2>Archives</h2>
					<ul>
					<?php wp_get_archives('type=monthly'); ?>
					</ul>
				</li>
				<?php wp_list_bookmarks(); ?>
                        
				
	
				<?php endif; ?>
			</ul>
		<?php if(get_theme_option('ad_sidebar2_bottom') != '') {
		?>
		<div class="sidebaradbox">
			<?php echo get_theme_option('ad_sidebar2_bottom'); ?>
		</div>
		<?php
		}
		?>
          
		</div>
	</div>
	
</div>
