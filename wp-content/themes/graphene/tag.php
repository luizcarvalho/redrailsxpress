<?php
/**
 * The tag archive template file
 *
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.1.5
 */
get_header();
?>

<h1 class="page-title">
    <?php
        printf(__('Tag Archive: <span>%s</span>', 'graphene'), single_tag_title('', false));
    ?>
</h1>
<?php
    /* Run the loop for the tag archive to output the posts
     * If you want to overload this in a child theme then include a file
     * called loop-tag.php and that will be used instead.
     */
    get_template_part('loop', 'tag');
?>

<?php get_footer(); ?>