<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
 <input type="text" name="s" id="se" size="35" onblur="if (this.value == '') {this.value = '<?php _e('search...', 'wpzoom') ?>';}" onfocus="if (this.value == '<?php _e('search...', 'wpzoom') ?>') {this.value = '';}" value="<?php _e('search...', 'wpzoom') ?>" class="text" />
 <input type="submit" id="searchsubmit" class="submit" value="<?php _e('Search', 'wpzoom') ?>" />
</form>
