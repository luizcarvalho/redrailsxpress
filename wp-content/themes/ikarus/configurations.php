<?php
require_once( dirname(__FILE__) . '../../../../wp-config.php');
require_once( dirname(__FILE__) . '/functions.php');
header("Content-type: text/css");

global $options;

foreach ($options as $value) {
	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>

body {
	color: #000000;
	background: #FFFFFF;
	font-family: <?php echo $tn_mz_blog_font_type; ?>;
	line-height: <?php echo $tn_mz_blog_line_height; ?>;
}

a.more-link {
	
	width: 102px;
	display: block;
	background: url(images/<?php echo $tn_mz_text_color; ?>/readon.gif) no-repeat bottom;
	color: #EFEFEF;
	font-size: 11px;
	line-height: 20px;
	text-indent: 25px;
	height: 20px;
	
	
}

a.more-link:hover {
	background: url(images/<?php echo $tn_mz_text_color; ?>/readon.gif) no-repeat top;
	color: #FFFFFF;
	text-decoration: none;
}

#headerwrap {
	background: url(images/<?php echo $tn_mz_header_style; ?>/<?php echo $tn_mz_header_color; ?>.jpg) no-repeat center top;
}





body.fs3{
	font-size: <?php echo $tn_mz_blog_font_size; ?>;
}


#topslwrap {
	background: url(images/headerbar/<?php echo $tn_mz_bar_color; ?>.gif);
}

/* MODULE
--------------------------------------------------------- */
div.module h3 {
	margin: 0 0 8px;
	padding: 0 5px 0 0;
	white-space: nowrap;
	background: url(images/h3-bg.gif) no-repeat 50% 5px;
	font-size: 110%;
	font-weight: bold;
	line-height: 52px;
}

div.module h3 span {
	padding-left: 22px;
	display: block;
	background: url(images/h3span-bg.gif) no-repeat left 45%;
}

div.module,
div.module-hilite {
	margin: 0 0 10px;
	padding: 0;
	float: left;
	width: 100%;
	clear: both;
	background: url(images/box-br.gif) no-repeat bottom right;
	overflow: hidden;
}

div.module-hilite a{
	color: #FFFFFF;
}

div.module-hilite a:hover{
	color: #CCCCCC;
	text-decoration: none;
}

div.module div,
div.module-hilite div {
	padding: 0;
	background: url(images/box-bl.gif) no-repeat bottom left;
}

div.module div div,
div.module-hilite div div {
	padding: 0;
	background: url(images/box-tr.gif) no-repeat top right;
}

div.module div div div,
div.module-hilite div div div {
	padding: 0 20px 20px;
	background: url(images/box-tl.gif) no-repeat top left;
}

/*no-title module*/
div.module-notitle {
	margin: 0 0 10px;
	padding: 0;
	float: left;
	width: 100%;
	background: url(images/box-br.gif) no-repeat bottom right;
}

div.module-notitle div {
	padding: 0;
	background: url(images/box-bl.gif) no-repeat bottom left;
}

div.module-notitle div div {
	padding: 0;
	background: url(images/box-notitle-tr.gif) no-repeat top right;
}

div.module-notitle div div div {
	padding: 15px;
	background: url(images/box-notitle-tl.gif) no-repeat top left;
}



/* Module hilite */
div.module-hilite h3 {
	margin: 0 0 8px;
	padding: 0 5px 0 0;
	white-space: nowrap;
	background: none;
	font-size: 110%;
	font-weight: bold;
	line-height: 52px;
}

div.module-hilite h3 span {
    padding-left: 22px;
	display: block;
	background: url(images/h3span-hilite-bg.gif) no-repeat center left;
}

div.module-hilite {
	background: url(images/<?php echo $tn_mz_widget_color; ?>/box-hilite-br.gif) no-repeat bottom right;
}

div.module-hilite div {
	background: url(images/<?php echo $tn_mz_widget_color; ?>/box-hilite-bl.gif) no-repeat bottom left;
}

div.module-hilite div div {
	background: url(images/<?php echo $tn_mz_widget_color; ?>/box-hilite-tr.gif) no-repeat top right;
}

div.module-hilite div div div {
	background: url(images/<?php echo $tn_mz_widget_color; ?>/box-hilite-tl.gif) no-repeat top left;
}

#colwrap {
	float: <?php echo $tn_mz_sidebar_style; ?>;
	width: 44.9%;
	overflow: hidden;
}

#content {
	float: <?php echo $tn_mz_content_style; ?>;
	width: 55%;
	background: url(images/content-center.gif) repeat-y;
}