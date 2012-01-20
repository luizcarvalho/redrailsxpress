<!-- begin r_sidebar -->

<div id="r_sidebar">
	
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>
	
		<h2>Related Sites</h2>
			<ul>
				<?php get_links(-1, '<li>', '</li>', ' - '); ?>
			</ul>
	
		<h2>Admin</h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<li><a href="http://www.wordpress.org/">WordPress</a></li>
				<?php wp_meta(); ?>
				<li><a href="http://validator.w3.org/check?uri=referer">XHTML</a></li>
			</ul>

	<?php endif; ?>
	
</div>

<!-- end r_sidebar -->