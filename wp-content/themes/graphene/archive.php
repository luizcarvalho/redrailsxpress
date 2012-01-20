<?php
/**
 * The archive template file
 *
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.1.5
 */
get_header();
?>

<?php
/* Queue the first post, that way we know
 * what date we're dealing with (if that is the case).
 *
 * We reset this later so we can run the loop
 * properly with a call to rewind_posts().
 */
if (have_posts())
    the_post();
?>

<h1 class="page-title">
    <?php if (is_day()) : ?>
        <?php printf(__('Daily Archive: <span>%s</span>', 'graphene'), get_the_date()); ?>
    <?php elseif (is_month()) : ?>
        <?php printf(__('Monthly Archive: <span>%s</span>', 'graphene'), 
		/* translators: F will be replaced with month, and Y will be replaced with year, so "F Y" in English would be replaced with something like "June 2008". */
		get_the_date(__('F Y', 'graphene'))); ?>
    <?php elseif (is_year()) : ?>
        <?php printf(__('Yearly Archive: <span>%s</span>', 'graphene'), get_the_date('Y')); ?>
    <?php elseif (is_category()) : ?>
        <?php $cats = get_the_category(); printf(__('Category Archive: <span>%s</span>', 'graphene'), $cats[0]->name); ?>
    <?php else : ?>
        <?php _e('Blog Archive', 'graphene'); ?>
    <?php endif; ?>
</h1>
<?php
    /* Since we called the_post() above, we need to
     * rewind the loop back to the beginning that way
     * we can run the loop properly, in full.
     */
    rewind_posts();

    /* Run the loop for the archives page to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-archives.php and that will be used instead.
     */
    get_template_part('loop', 'archive');
?>

<?php get_footer(); ?>