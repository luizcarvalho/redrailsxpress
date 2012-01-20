				<div id="masscol" class="clearfix">
                <script language="javascript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/mootabs1.2.js"></script>
				<script type="text/javascript">
					window.addEvent('domready', initmootabs);
					function initmootabs() {
						myTabs1 = new jamootabs('tabswrap-bot', {
							
	width: 			'414px', 
	height: 		'auto', 
	duration:		500,
	changeTransition: Fx.Transitions.Quad.easeOut
						});
					}
				</script>
                <div id="tabswrap" class="clearfix">
                
				<div id="tabswrap-top">
				<div id="tabswrap-bot">	
				<div class="tab-panels">
               
							<div class="moduletable">
							<h3>
					Videos			</h3>
				          <ul class="nolist"><p><?php get_latestvideo(); ?></p></ul>
		</div>
				<div class="moduletable">
							<h3>
					Tags			</h3>
				<ul style="line-height:24px">

<?php if(function_exists("UTW_ShowTagsForCurrentPost")) : ?>
<?php UTW_ShowWeightedTagSetAlphabetical("sizedtagcloud","","50") ?>
<?php else : ?>
<?php if(function_exists("wp_tag_cloud")) : ?>
<?php wp_tag_cloud('smallest=12&largest=20&'); ?>
<?php endif; ?>
<?php endif; ?>

</ul></div>
				<div class="moduletable">
							<h3>
					Latest			</h3>
				<ul class="list">
<?php get_archives('postbypost', 10); ?>
</ul>
		</div>
        
       
						</div>
				</div></div></div>
							</div>
				