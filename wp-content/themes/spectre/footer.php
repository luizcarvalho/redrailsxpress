<?php $mb_footer_include = stripslashes(get_option('mb_footer_include')); ?>				
				
			</div>			
		</div>
		<!-- /mid -->
				
		<!-- footer -->
		<div id="footer">		
			<div id="footer-inner">	
				<p id="footer-credits">&copy; Copyright <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>			
				<p id="footer-meta"><a href="http://mattbrett.com">Designed &amp; Developed by Matt Brett</a> <span>/</span> <a href="http://wordpress.org">Powered by WordPress</a></p>
			</div>
		</div>
		<!-- footer -->
		
	</div>
	<!-- wrapper -->
	
	<?php echo $mb_footer_include; ?>
	
	<?php wp_footer(); ?>

</body>
</html>