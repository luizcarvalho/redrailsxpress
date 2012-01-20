<?php
/*
Template Name: Tags
*/
?>
<?php get_header(); ?>
<div id="post">

<!--[if !IE]>INIT NORMAL BLOG CONTENT<![endif]-->
<div class="post-meta" id="post-<?php the_ID(); ?>">
<h1 class="post-title"><?php the_title(); ?></h1>
<div class="postedby">
<div class="post-status">
<strong><?php _e('Posted by'); ?></strong>&nbsp;<?php the_author_posts_link(); ?> in <?php the_time('F jS, Y') ?>&nbsp;&nbsp;<?php edit_post_link('Edit', '', ''); ?>
</div>
</div>

<div class="post-content">
<?php if(function_exists("UTW_ShowTagsForCurrentPost")) : ?>
<?php UTW_ShowWeightedTagSetAlphabetical("sizedtagcloud","","50") ?>
<?php else : ?>
<?php if(function_exists("wp_tag_cloud")) : ?>
<?php wp_tag_cloud('smallest=12&largest=20&'); ?>
<?php endif; ?>
<?php endif; ?>
</div>

</div>
<div class="clear-fix"></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>