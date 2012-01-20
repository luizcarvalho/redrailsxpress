<?php $mb_blog = stripslashes(get_option('mb_blog')); ?>
<?php if(is_home()) echo ''; else { ?><!-- widget -->
<div class="widget">
	<h3>Categories</h3>
	<ul>
		<?php wp_list_categories('orderby=name&show_count=1&child_of=' . $mb_blog . '&title_li='); ?>
	</ul>
</div>
<!-- /widget --><?php } ?>