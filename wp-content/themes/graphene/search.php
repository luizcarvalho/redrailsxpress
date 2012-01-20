<?php
/**
 * @package WordPress
 * @subpackage khairul-syahir.com-v2_Theme
 */

get_header(); ?>

<h1 class="page-title">
    <?php
        printf(__('Search results for: <span>%s</span>', 'graphene'), get_search_query());
    ?>
</h1>

<?php if (isset($_GET['search_404'])) { get_template_part('search', '404'); } else {get_template_part('loop', 'search');} ?>

<?php get_footer(); ?>