<?php get_header(); ?>
<div class="span-24" id="contentwrap">
	<div class="span-13">
		<div id="content">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

		<?php while (have_posts()) : the_post(); ?>
						<div class="postwrap">
						<div <?php post_class('post') ?> id="post-<?php the_ID(); ?>">
							<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<div class="postdate">Posted by <strong><?php the_author() ?></strong> on  <?php the_time('F jS, Y') ?> <?php if (current_user_can('edit_post', $post->ID)) { ?> | <?php edit_post_link('Edit', '', ''); } ?></div>
							<div class="entry">
                                <?php if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) { the_post_thumbnail(array(200,160), array('class' => 'alignleft post_thumbnail')); } ?>
								<?php the_excerpt(); ?>
								<div class="readmorecontent">
									<a class="readmore" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Read More &raquo;</a>
								</div>
							</div>
							
						</div><!--/post-<?php the_ID(); ?>-->
						</div>
				<?php endwhile; ?>

		<div class="navigation">
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			<?php } ?>
		</div>

	<?php else : ?>

		<h2 class="pagetitle">No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

		</div>
	</div>

<?php get_sidebars(); ?>
</div>
<?php get_footer(); ?>