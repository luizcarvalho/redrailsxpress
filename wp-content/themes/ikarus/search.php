<?php get_header(); ?>



<div id="post-index">

<?php if (have_posts()) : ?>

<h2>Search Result For &quot; <?php the_search_query(); ?> &quot;</h2>

<?php while (have_posts()) : the_post(); ?>

<div class="post-meta" id="post-<?php the_ID(); ?>">  
<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
<div class="postedby">
<div class="post-status">
<strong><?php _e('Posted by'); ?></strong>&nbsp;<?php the_author_posts_link(); ?> in <?php the_time('F jS, Y') ?>&nbsp;&nbsp;<?php edit_post_link('Edit', '', ''); ?>
</div>
<div class="comment-stats"><?php comments_popup_link('Leave comment', '1 Comment', '% Comments'); ?></div>
</div>
<div class="fileunder">
<div class="atgcat"><?php _e('Posted in'); ?>:&nbsp;<?php the_category(', ') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(function_exists("UTW_ShowTagsForCurrentPost")) : ?><?php UTW_ShowTagsForCurrentPost("commalist", array('last'=>' and %taglink%', 'first'=>'Tags in: %taglink%',)) ?><?php else : ?><?php if(function_exists("the_tags")) : ?><?php the_tags() ?><?php endif; ?><?php endif; ?> </div>
</div>


<div class="post-content">
<?php the_excerpt("Read more..."); ?>
</div>
</div>

<?php endwhile; ?>

<div class="clear-fix"></div>

<?php if(file_exists(TEMPLATEPATH . '/paginate.php')): ?>
<?php include (TEMPLATEPATH . '/paginate.php'); ?>
<?php else: ?>
<!--[if !IE]>missing paginate templates<![endif]-->
<?php endif; ?>


<?php else: ?>

<h2>Sorry the search keyword you looking for did not exist or already removed by author</h2>

<?php endif; ?>

</div>
<!--[if !IE]>END FRONTPAGE CONFIGURATION<![endif]-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>