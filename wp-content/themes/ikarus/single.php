<?php get_header(); ?>

<div id="post">

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>

<div class="post-meta" id="main-post">
<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
<div class="postedby">
<div class="post-status">
<strong><?php _e('Posted by'); ?></strong>&nbsp;<?php the_author_posts_link(); ?> in <?php the_time('F jS, Y') ?>&nbsp;&nbsp;<?php edit_post_link('Edit', '', ''); ?>
</div>
<div class="comment-stats"><?php comments_popup_link('No Comment Yet', '1 Comment', '% Comments'); ?></div>
</div>
<div class="fileunder">
<div class="atgcat"><?php _e('Posted in'); ?>:&nbsp;<?php the_category(', ') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(function_exists("UTW_ShowTagsForCurrentPost")) : ?><?php UTW_ShowTagsForCurrentPost("commalist", array('last'=>' and %taglink%', 'first'=>'Tags in: %taglink%',)) ?><?php else : ?><?php if(function_exists("the_tags")) : ?><?php the_tags() ?><?php endif; ?><?php endif; ?> </div>
</div>





<?php if(file_exists(TEMPLATEPATH . '/social.php')): ?>
<?php include (TEMPLATEPATH . '/social.php'); ?>
<?php else: ?>
<?php endif; ?>




<div class="post-content">
<?php the_content("Read more..."); ?>

<h3>You Should Also Check Out This Post:</h3>
<ul>
<?php gte_random_posts(); ?>
</ul>

<h3>More Active Posts:</h3>
<ul>
<?php get_hottopics(); ?>
</ul>

</div>
</div>

<span class="article_seperator">&nbsp;</span>


<?php endwhile; ?>

<div class="clear-fix"></div>


<?php if(file_exists(TEMPLATEPATH . '/paginate.php')): ?>
<?php include (TEMPLATEPATH . '/paginate.php'); ?>
<?php else: ?>
<?php endif; ?>


<div class="clear-fix"></div>


<?php comments_template(); ?>




<?php else: ?>

<h2>Sorry the post you looking for did not exist or already removed by author</h2>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>