function mycarousel_initCallback(carousel) {
  jQuery('#features-nav .features-nav-item').bind('click', function() {
    carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
    return false;
  });
};

jQuery(document).ready(function() {
  jQuery("#features").jcarousel({
    scroll: 1,
    initCallback: mycarousel_initCallback,
    buttonNextHTML: null,
    buttonPrevHTML: null
  });
});	

jQuery(document).ready(function() {
	$("#features-nav .features-nav-item").click(function(){
	    $("#features-nav .features-nav-item").removeClass("current").addClass("");
	    $(this).addClass("current");
	});
});

jQuery(document).ready(function() {
  jQuery("#screenshots").jcarousel({
    scroll: 1
  });
});

jQuery(document).ready(function() {
	var el = $('#portfolio-services');
		if(el.html()) { el.html(el.html().replace(/, /ig, "</li><li>")); }
});