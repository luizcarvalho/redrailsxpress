  <div class="span-24">
		<div id="footer">Copyright &copy; <a href="<?php bloginfo('home'); ?>"><strong><?php bloginfo('name'); ?></strong></a>  - <?php bloginfo('description'); ?></div>
        <?php /* 
                    All links in the footer should remain intact. 
                    These links are all family friendly and will not hurt your site in any way. 
                    Warning! Your site may stop working if these links are edited or deleted 
                    
                    You can buy this theme without footer links online at http://newwpthemes.com/buy/?theme=permanent 
                */ ?>
        <div id="credits">Powered by <a href="http://wordpress.org/"><strong>WordPress</strong></a> | Designed by: Best <a href="http://freewpthemes.co">Free WordPress Themes</a> | Compare <a href="http://wordpress4themes.com">Free WordPress 4 Themes</a>, Download <a href="http://allpremiumthemes.com">Premium WordPress Themes</a> and <a href="http://freewpthemes.co">Free WP Themes</a></div>
    </div>
</div>
</div>
<?php
	 wp_footer();
	echo get_theme_option("footer")  . "\n";
?>
</body>
</html>