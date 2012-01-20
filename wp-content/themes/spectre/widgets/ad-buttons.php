<?php 
	$mb_button_1 = stripslashes(get_option('mb_button_1'));
	$mb_button_2 = stripslashes(get_option('mb_button_2'));
	$mb_button_3 = stripslashes(get_option('mb_button_3'));
	$mb_button_4 = stripslashes(get_option('mb_button_4'));
?>

<?php if( !$mb_button_1 ) echo''; else { ?>
<!-- widget -->
<div class="widget" id="ad-buttons">
	<?php echo $mb_button_1; ?>		
	<?php echo $mb_button_2; ?>
	<?php echo $mb_button_3; ?>
	<?php echo $mb_button_4; ?>
</div>
<!-- /widget -->
<?php } ?>