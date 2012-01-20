
<?php if (is_single()) { ?>
<div id="post-navigator-single">
<div class="alignleft">Previous: <?php previous_post_link('%link') ?></div>
<div class="alignleft">Next: <?php next_post_link('%link') ?></div>
</div>

<?php } else if (is_page()) { ?>

<div id="post-navigator">
<?php link_pages('<strong>Pages:</strong> ', '', 'number'); ?>
</div>

<?php } else { ?>

<div id="post-navigator">
<?php if (function_exists('wp_pagenavi')) : ?>
<?php wp_pagenavi(); ?>
<?php else : ?>
<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;'); ?></div>
<div class="alignleft"><?php next_posts_link('&laquo; Older Entries'); ?></div>
<?php endif; ?>
</div>

<?php } ?>