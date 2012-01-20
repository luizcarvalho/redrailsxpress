<?php
/*
Template Name: Links
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
<ul><?php get_links(-1, '<li>', '</li>', ' - '); ?> </ul>
</div>

</div>
<div class="clear-fix"></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>