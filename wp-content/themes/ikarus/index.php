<?php include (TEMPLATEPATH . '/options/options.php'); ?>
<?php get_header(); ?>

<!--[if !IE]>INTI GLOBAL POSTPAGE FUNCTIONS<![endif]-->

<?php if(($tn_mz_blog_style == 'list') || ($tn_mz_blog_style == 'blog')){ ?>
<div id="post-index">
<?php } else { ?>
<div id="post">
<?php } ?>

<?php if($tn_mz_blog_style == TRUE){ ?>
<?php include (TEMPLATEPATH . '/layouts/' .$tn_mz_blog_style. '.php'); ?>
<?php } else { ?>
<?php include (TEMPLATEPATH . 'layouts/blog.php'); ?>
<?php } ?>


<div class="clear-fix"></div>

</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>