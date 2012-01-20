<?php if (function_exists('dropdown_manager_paintdropdown')): ?>
	<?php $number_of_categories = dropdown_get_dropdowns();
	 if ($number_of_categories > 0): ?>

	<form method="post" action="<?php echo get_bloginfo('url') . '/index.php'; ?>">

		<?php
			for($i=0;$i<($number_of_categories);$i++)
			{
				if ( !function_exists('dropdown_manager_paintdropdown') || !dropdown_manager_paintdropdown( $i ) ){} 
			}
		?>
		
		<div class="search_right">
			<input type="hidden" name="s" value="%" />
			<input type="submit" class="submit_button" value="Search" alt="[Submit]" name="submit" title="Search" />
		</div>
	</form>
	<?php endif; ?>
<?php endif; ?>

