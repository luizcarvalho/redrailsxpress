<?php $mb_skyscraper = stripslashes(get_option('mb_skyscraper')); ?>

<?php if( !$mb_skyscraper ) echo''; else { ?>
<!-- widget -->
<div class="widget" id="ad-skyscraper">
	<?php echo $mb_skyscraper; ?>
</div>
<!-- /widget -->
<?php } ?>