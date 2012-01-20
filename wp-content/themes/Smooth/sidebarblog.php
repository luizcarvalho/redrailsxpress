<div id="sidebar_inner"><!-- Right Sidebar -->
	
<h2>Multi Category Search</h2>

<!-- Search box - keyword search -->
<form  method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" name="s" value="Enter partial address, keywords" onclick="this.value='';" class="search_input" />
<input type="submit" class="submitt_button" value="Go" alt="[Submit]" name="submit" title="Search Our Properties" />
</form>
<!-- End Search box - keyword search -->

<!--  Dropdown Selections -->
<div class="dd_search">
<?php include (TEMPLATEPATH . '/multisearch.php'); ?>

</div>
<div style="clear:both;"></div>

<!--  End Dropdown Selections -->


<?php if ( !function_exists('dynamic_sidebar')
      || !dynamic_sidebar(5) ) : ?>
     <?php endif; ?>


</div><!-- End sidebar_inner -->
		
	
<div class="banner300x250"> 
    <?php  newThemeOptions_showBigBanner()  ?>
</div>


