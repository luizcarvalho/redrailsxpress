<?php 
global $options; foreach ($options as $value) { if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>
<?php get_header(); ?>
 
	<div id="middle">
       
		<div id="posts">
	
		<h2><?php _e('Nothing Found', 'wpzoom');?></h2><br />
		
		<strong><?php _e('We\'re sorry, but the page you\'re looking for, doesn\'t exist or has been removed.', 'wpzoom');?></strong>
 		
		</div><!-- end posts -->	
		
	</div><!-- end middle -->	
  
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>