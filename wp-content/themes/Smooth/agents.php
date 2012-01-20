<?php
/*
Template Name: Agents

*/
?>

<?php get_header(); ?>
<div id="main_content" class="grid_8">

<h2><?php the_title(); ?></h2><br/>
<div class="float_left_image"><!--  Author Photo -->
<?php iu_show_author_photos();?> 
</div>

</div><!-- end main_content grid_8 -->
<div id="sidebar" class="grid_4 omega">
<?php get_sidebar();?>
</div><!-- end sidebar-->
<?php get_footer();?>


