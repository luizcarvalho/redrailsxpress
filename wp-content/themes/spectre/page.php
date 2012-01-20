<?php get_header(); ?>
				
				<!-- content -->
				<div id="content">

					<?php while (have_posts()) : the_post(); ?>
						
					<!-- page -->
					<div class="page">
									
						<h1><?php the_title(); ?></h1>
					
						<?php the_content() ?>
					
					</div>
					<!-- /page -->
					
					<?php endwhile; ?>

				</div>
				<!-- /content -->

				<!-- sidebar -->
				<div id="sidebar">

					<?php get_sidebar(); ?>

				</div>
				<!-- /sidebar -->
				
<?php get_footer(); ?>
