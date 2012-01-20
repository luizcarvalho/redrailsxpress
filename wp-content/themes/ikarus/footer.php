<?php wp_footer(); ?>

<?php include (TEMPLATEPATH . '/options/options.php'); ?>

</div>

</div>



<!-- BEGIN: BOTTOM SPOTLIGHT -->

<div id="botslwrap">

	<div id="botsl" class="clearfix">



	  	  <div class="box-leftcol" style="width: 44.9%;">

	    		<div class="moduletable">

							<h3>

					My Flickr				</h3>

				<div id="flickr-roll">

<?php if(function_exists("get_flickrrss")) : ?>

<ul>

<?php get_flickrrss(); ?>

</ul>

<?php else : ?>

<ul>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

<li><a href="#"><img src="<?php bloginfo('stylesheet_directory');?>/images/flick-sample.gif" alt="flick" border="0" /></a></li>

</ul>

<?php endif; ?>



</div>	</div>

			  </div>

	  

	  	  <div class="box-left" style="width: 27.5%;">

	    		<div class="moduletable">

							<?php if(function_exists("get_hottopics")) : ?>



<h3>Most Comments</h3>

<ul class="footer-block">

<?php get_hottopics(); ?>

</ul>



<?php endif; ?></div>

			  </div>

	  

	  	  <div class="box-right" style="width: 27.5%;">

	    		<div class="moduletable">

							<h3>

					Popular	Entries			</h3>

			

<ul class="footer-block">

<?php if(function_exists("akpc_most_popular")) : ?>

<?php akpc_most_popular(); ?>

<?php else : ?>

<li>you must install the popular plugin by alex king for this section to work</li>

<?php endif; ?>

</ul>	</div>

			  </div>

	  

	</div>

</div>

<!-- END: BOTTOM SPOTLIGHT -->





<div id="footerwrap-<?php echo $tn_mz_footer_color; ?>">

<div id="footer" class="clearfix">



	<small><?php the_time('Y'); ?> <?php bloginfo('name'); ?> .  WordPress . <!-- Start -->Wordpress themes<!-- End -->
 </small>

<div id="banner">

		<a href="<?php echo $tn_mz_banner2_url; ?>" target="_blank"><img src="<?php echo $tn_mz_banner2_image; ?>" border="0" alt="Advertisement" /></a>	</div>

	

</div>

</div>


<?php wp_footer(); ?>



</body>



</html>