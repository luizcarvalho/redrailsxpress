<?php 
global $options; foreach ($options as $value) { if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>
 
<div id="sidebar">

	<?php if (strlen($wpzoom_ad_side_imgpath) > 1 && $wpzoom_ad_side_select == 'Yes'  && $wpzoom_ad_side_pos == 'Before') {?>
	<div class="banner"><?php echo stripslashes($wpzoom_ad_side_imgpath); ?></div>
	<?php } ?>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
	<?php endif; ?>
		
		
		<div id="sidebar_left">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Side Left') ) : ?>
			<?php endif; ?>
		</div> <!-- end side left -->
		   
		  
		<div id="sidebar_right">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Side Right') ) : ?>
			<?php endif; ?>
		</div> <!-- end side right -->
		

	<?php if (strlen($wpzoom_ad_side_imgpath) > 1 && $wpzoom_ad_side_select == 'Yes'  && $wpzoom_ad_side_pos == 'After') {?>
	<div class="banner"><?php echo stripslashes($wpzoom_ad_side_imgpath); ?></div>
	<?php } ?>
	 
</div> <!-- end sidebar -->