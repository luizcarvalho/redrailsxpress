<?php
/**
 * Template Name: Three columns, sidebar left and right
 *
 * A custom page template with the main content in 
 * the middle and two sidebars (left and right side).
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