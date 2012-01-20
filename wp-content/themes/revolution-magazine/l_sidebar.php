<!-- begin l_sidebar -->

<div id="l_sidebar">
	
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
	
		<h2>Sections</h2>
			<ul>
				<?php wp_list_categories('sort_column=name&title_li='); ?>
			</ul>
	
		<h2>Archives</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
			
	<?php endif; ?>
	
</div>

<!-- end l_sidebar -->