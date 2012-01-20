<?php $mb_style = stripslashes(get_option('mb_style')); $mb_social_twitter = stripslashes(get_option('mb_social_twitter')); $mb_business = stripslashes(get_option('mb_business')); ?>

<?php if (function_exists('aktt_sidebar_tweets')) { ?><!-- twitter -->
<div id="twitter" class="widget">
	<h2>Twitter Updates</h2>
	<img src="<?php bloginfo('template_directory'); ?>/images/<?php echo $mb_style; ?>/twitter.gif" alt="" />
	<?php aktt_sidebar_tweets(); ?>
	<?php if($mb_social_twitter) { ?><div class="button <?php if($mb_business == 0) echo 'me'; ?>" id="btn-twitter"><a href="<?php echo $mb_social_twitter; ?>">Follow <?php if($mb_business == 0) echo 'Me'; else echo 'Us'; ?> on Twitter</a></div><?php } ?>
</div>
<!-- /twitter --><?php } ?>