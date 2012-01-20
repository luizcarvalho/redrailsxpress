<?php $mb_bigbox = stripslashes(get_option('mb_bigbox')); ?>

<?php if( !$mb_bigbox ) echo''; else { ?>
<!-- widget -->
<div class="widget" id="ad-bigbox">
	<?php echo $mb_bigbox; ?>
</div>
<!-- /widget -->
<?php } ?>