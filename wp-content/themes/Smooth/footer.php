</div> <!-- end wrapper -->
<div style="clear:both"></div>
<div id="footer" >
<div id="footer_inner" class="container_12">
<div id="footer_left" class="grid_4 alpha">
<?php if ( !function_exists('dynamic_sidebar')
      || !dynamic_sidebar(2) ) : ?>
     <?php endif; ?>
</div><!-- end footer_left-->
<div id="footer_center" class="grid_4">
<?php if ( !function_exists('dynamic_sidebar')
      || !dynamic_sidebar(3) ) : ?>
     <?php endif; ?>
</div><!-- end footer_center-->
<div id="footer_right" class="grid_4 omega">
	<?php newThemeOptions_showBannersSquare();	?>
</div><!-- end footer_right-->
</div>
</div><!-- end footer-->
<?php wp_footer();?>
<script type="text/javascript">

function sfHoverEvents(sfEls) {
  var len = sfEls.length;
  for (var i=0; i<len; i++) {
    sfEls[i].onmouseover=function() {
      this.className+=" sfhover";
    }
    sfEls[i].onmouseout=function() {
      this.className=this.className.replace(" sfhover", "");
    }
  }
}
function sfHover() {
var ULs = document.getElementsByTagName("UL");
var len = ULs.length;
  for(var i=0;i<len;i++) {
    if(ULs[i].className.indexOf("sf-menu") != -1)
      sfHoverEvents(ULs[i].getElementsByTagName("LI"));
  }
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
</script>
</body>
</html>