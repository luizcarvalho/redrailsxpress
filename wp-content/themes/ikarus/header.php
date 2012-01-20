<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title>
<?php if ( is_home()) { ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>
<?php } else { ?>
<?php bloginfo('name'); ?>
<?php if(function_exists("UTW_ShowTagsForCurrentPost")) : ?>
<?php if (is_tag()) { echo ' : '; UTW_ShowCurrentTagSet('tagsettextonly'); ''; } ?>
<?php endif; ?><?php wp_title(' : '); ?><?php } ?>
</title>

<meta name="description" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>"/>
<?php include (TEMPLATEPATH . '/options/options.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/configurations.php" type="text/css" media="screen"/>

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="icon" href="<?php bloginfo('stylesheet_directory');?>/favicon.ico" type="images/x-icon" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>


<link href="<?php bloginfo('template_directory'); ?>/scripts/mootabs1.2.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/menus/sosdmenu.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/ja.script.js"></script>                    
<link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet" type="text/css"  />
<script language="javascript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/mootools.v1.1.js"></script>

<link href="<?php bloginfo('template_directory'); ?>/<?php echo $tn_mz_text_color; ?>.css" rel="stylesheet" type="text/css"  />

<!--[if lte IE 6]>
<style type="text/css">
.clearfix {height: 1%;}
img, H3 {
	background-position: -1000px;
	behavior: url("<?php bloginfo('template_directory'); ?>/scripts/iepngfix.htc");
}

h1.logo a, #search {
	background-position: -1000px;
}

h1.logo a {
	cursor: pointer;
}
</style>
<![endif]-->

<!--[if gte IE 7.0]>
<style type="text/css">
.clearfix {display: inline-block;}
</style>
<![endif]-->

<!--Mootabs script load-->
<script type="text/javascript" charset="utf-8">
/*<![CDATA[*/
document.write ('<style type="text\/css">#tabswrap .moduletable {display: none;}<\/style>');
/*]]>*/
</script>
<!--[if lte IE 6]>
<script type="text/javascript">
window.addEvent ('domready', makeTransBG);
function makeTransBG() {
	makeTransBg($('mainnav'), '<?php bloginfo('template_directory'); ?>/images/mainnav-bg.png')
	makeTransBg($E('#topsl'), '<?php bloginfo('template_directory'); ?>/images/topsl-bg.png')
}
</script>
<![endif]-->
</head>

<body id="bd" class="wide fs3">
<!-- BEGIN: HEADER -->
<div id="headerwrap">
<div id="header">

	<h1 class="<?php echo $tn_mz_header_logo; ?>"><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a></h1>

<!-- BEGIN: TOP BANNER 468x60 -->
 <div id="banner">
		<a href="<?php echo $tn_mz_banner_url; ?>" target="_blank"><img src="<?php echo $tn_mz_banner_image; ?>" border="0" alt="Advertisement" /></a>	
 </div>
<!-- END: TOP BANNER--> 		
	

		
	<!-- BEGIN: MAIN NAVIGATION -->
	<?php include (TEMPLATEPATH . '/navigation.php'); ?>
	<!-- END: MAIN NAVIGATION -->
   
	
</div>
</div>
<!-- END: HEADER -->

<!-- BEGIN: TOP SPOTLIGHT -->
<div id="topslwrap">
<div id="topsl" >
	<div class="newflash" >
		<?php if($tn_mz_header_img_post_status==yes): ?>	
	
    <a href="<?php echo $tn_mz_header_url; ?>"><img src="<?php echo $tn_mz_header_image; ?>" border="0" alt="Featured Content" /></a>	
    <?php else : ?>
	
  <?php include (ABSPATH . '/wp-content/plugins/content-gallery/gallery.php'); ?>
    
    <?php endif; ?>

</div></div>
</div>
<!-- END: TOP SPOTLIGHT -->

<div id="pathwaywrap"> 
	
    <?php include (TEMPLATEPATH . '/searchform.php'); ?>	
	 <?php if (function_exists('fc_feedcount')): ?>
<div id="rss-feeds"><div id="rss-block"><a href="#">&nbsp;</a></div>
<div id="rs-count"><?php fc_feedcount(); ?></div></div>
<?php endif; ?>

  </div>
<div align="center"><?php include (TEMPLATEPATH . '/admin/admin-navigation.php'); ?> </div>
<div id="containerwrap">
	<div id="container" class="clearfix">
    
    <!-- BEGIN: CONTENT -->
		<div id="content">
		<div id="content-top">
		<div id="content-bot">
		<div class="innerpad clearfix">