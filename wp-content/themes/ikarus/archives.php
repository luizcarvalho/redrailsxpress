<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
<div id="post">

<div class="post-meta" id="post-<?php the_ID(); ?>">
<h1 class="post-title"><?php the_title(); ?></h1>
<div class="postedby">
<div class="post-status">
<strong><?php _e('Posted by'); ?></strong>&nbsp;<?php the_author_posts_link(); ?> in <?php the_time('F jS, Y') ?>&nbsp;&nbsp;<?php edit_post_link('Edit', '', ''); ?>
</div>
</div>

<div class="post-content">
<h3>Monthly Archives</h3><ul><?php wp_get_archives('type=monthly') ?></ul>
<h3>Category Archives</h3><ul><?php wp_list_cats('sort_column=name&optioncount=1&feed=RSS') ?></ul>
<h3>Fresh Archives</h3><ul><?php get_archives('postbypost', 10); ?></ul>
<h3>Tags Archives</h3>
<?php if(function_exists("UTW_ShowTagsForCurrentPost")) : ?>
<?php UTW_ShowWeightedTagSetAlphabetical("sizedtagcloud","","1000") ?>
<?php else : ?>
<?php if(function_exists("wp_tag_cloud")) : ?>
<?php wp_tag_cloud('smallest=11&largest=24&'); ?>
<?php endif; ?>
<?php endif; ?>
</div>

</div>

<div class="clear-fix"></div>


</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>