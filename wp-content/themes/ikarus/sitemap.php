<?php
/*
Template Name: Sitemap
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
<h3>Blog Pages</h3>
<ul>
<?php $archive_query = new WP_Query('showposts=1000');
while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> (<?php comments_number('0', '1', '%'); ?>)</li>
<?php endwhile; ?>
</ul>

<?php if(function_exists("get_hottopics")) : ?>
<h3>Hot Topics</h3><ul><?php get_hottopics(); ?></ul>
<?php else : ?>
<?php endif; ?>

<h3>Feeds Syndicator</h3>
<ul>
<li><a href="<?php bloginfo('rdf_url'); ?>" title="RDF/RSS 1.0 feed"><acronym title="Resource Description Framework">RDF</acronym>/<acronym title="Really Simple Syndication">RSS</acronym> 1.0 feed</a></li>
<li><a href="<?php bloginfo('rss_url'); ?>" title="RSS 0.92 feed"><acronym title="Really Simple Syndication">RSS</acronym> 0.92 feed</a></li>
<li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0 feed"><acronym title="Really Simple Syndication">RSS</acronym> 2.0 feed</a></li>
<li><a href="<?php bloginfo('atom_url'); ?>" title="Atom feed">Atom feed</a></li>
</ul>
</div>

</div>
<div class="clear-fix"></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>