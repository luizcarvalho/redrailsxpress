<!-- begin footer -->

<div style="clear:both;"></div>

<div id="footer">

	<div id="footerleft">
		<p>Copyright &copy; 2007 <a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a> &middot; <a href="http://news.revolutiontheme.com" >Revolution Magazine theme</a> by <a href="http://www.briangardner.com" >Brian Gardner</a> &middot; <?php wp_loginout(); ?> </p>
	</div>
	
	<div id="footerright">
		<p><a href="http://news.revolutiontheme.com"><img src="<?php bloginfo('template_url'); ?>/images/rev.gif" alt="Revolution Magazine Theme" /></a><a href="http://wordpress.org"><img src="<?php bloginfo('template_url'); ?>/images/wp.gif" alt="WordPress" /></a></p>
	</div>
	
</div>

<?php do_action('wp_footer'); ?>

<div id="bottom">
	<img src="<?php bloginfo('template_url'); ?>/images/bottom.gif" alt="Bottom" />
</div>

</div>

</body>
</html>