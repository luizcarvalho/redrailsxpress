<?php $search_text = empty($_GET['s']) ? __('Search') : get_search_query(); ?> 
<div id="search" class="clerfix">
    <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/"> 
        <input type="text" value="<?php echo $search_text; ?>" 
            name="s" id="s"  onblur="if (this.value == '')  {this.value = '<?php echo $search_text; ?>';}"  
            onfocus="if (this.value == '<?php echo $search_text; ?>') {this.value = '';}" />
        <input type="image" src="<?php echo get_bloginfo('template_directory') ; ?>/images/search.png" title="<?php _e('Search'); ?>" class="search-image" /> 
    </form>
</div>