<?php
/**
 * Template Name: Two columns, sidebar on the left
 *
 * A custom page template with the main content on 
 * the right side and one sidebar on the left side.
 *
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.1.5
 */
 get_header(); ?>
 
    <?php
    /* Run the loop to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-single.php and that will be used instead.
     */
     get_template_part('loop', 'single');
    ?>

<?php get_footer(); ?>