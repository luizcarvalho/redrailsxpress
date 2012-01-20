<?php $mb_style = stripslashes(get_option('mb_style')); $mb_featured = stripslashes(get_option('mb_featured')); $mb_exclude_pages = stripslashes(get_option('mb_exclude_pages')); $mb_social_twitter = stripslashes(get_option('mb_social_twitter')); $mb_subscribe_feed = stripslashes(get_option('mb_subscribe_feed')); $mb_subscribe_email = stripslashes(get_option('mb_subscribe_email')); $mb_logo_image = stripslashes(get_option('mb_logo_image')); $mb_logo_width = stripslashes(get_option('mb_logo_width')); $mb_logo_height = stripslashes(get_option('mb_logo_height')); $mb_point1_title = stripslashes(get_option('mb_point1_title')); $mb_point1_desc = stripslashes(get_option('mb_point1_desc')); $mb_point2_title = stripslashes(get_option('mb_point2_title')); $mb_point2_desc = stripslashes(get_option('mb_point2_desc')); $mb_point3_title = stripslashes(get_option('mb_point3_title')); $mb_point3_desc = stripslashes(get_option('mb_point3_desc')); $mb_about_path = stripslashes(get_option('mb_about_path')); $mb_contact_path = stripslashes(get_option('mb_contact_path')); $mb_business = stripslashes(get_option('mb_business')); $mb_availability = stripslashes(get_option('mb_availability')); $mb_resize = stripslashes(get_option('mb_resize')); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>	
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/reset.css" type="text/css" />	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/screen.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jcarousel.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/<?php echo $mb_style; ?>.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/lytebox.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print" />
	<!--[if lte IE 7]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" type="text/css" media="screen, projection" /><![endif]-->
	<!--[if IE 6]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" type="text/css" media="screen, projection" /><![endif]-->
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if( $mb_subscribe_feed ) { echo $mb_subscribe_feed; } else { bloginfo('rss2_url'); } ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
	
	<?php wp_head(); ?>
	
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.jcarousel.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.actions.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/lytebox.js"></script>
	
</head>

<body>

	<!-- wrapper -->
	<div id="wrapper">
		
		<!-- header -->
		<div id="header">
			
			<!-- branding -->
			<div id="branding">
				<?php if($mb_logo_image) { ?><div id="logo-custom" style="width:<?php echo $mb_logo_width; ?>px; height:<?php echo $mb_logo_height; ?>px;"><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?><span style="background: url('<?php echo $mb_logo_image; ?>') no-repeat 0 0">&nbsp;</span></a></div><?php } else { ?>
				<div id="logo"><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?><span>&nbsp;</span></a></div>
				<div id="description"><?php bloginfo('description'); ?></div><?php } ?>
			</div>
			<!-- branding -->
			
			<?php if($mb_availability) { ?><!-- availability -->
			<div id="availability">
				Currently booking for <strong><?php echo $mb_availability; ?></strong><br/>
				<a href="<?php echo $mb_contact_path; ?>">Hire <?php if($mb_business == 1) echo 'Us!'; else echo 'Me!'; ?></a>
			</div>
			<!-- availability --><?php } ?>			
			<!-- search -->
			<form id="search" method="get" action="<?php bloginfo('url'); ?>"<?php if(!$mb_availability) echo ' style="margin-top:78px;"'; ?>>
				<div>
					<input value="<?php the_search_query(); ?>" name="s" id="s" onfocus="if(this.value=='What are you looking for?')value=''" value="<?php the_search_query(); ?>" />
					<input name="search" type="image" src="<?php bloginfo('template_directory'); ?>/images/<?php echo $mb_style; ?>/search-button.jpg" alt="Search" id="search-submit" />
				</div>
				<script type="text/javascript">
					var s = document.getElementById("s");
					if ( s.value == '' )
						s.value = "What are you looking for?";
					s.onfocus = function() { var s = document.getElementById("s"); s.value = ( s.value == "What are you looking for?" ) ? '' : s.value; }
					s.onblur = function() { var s = document.getElementById("s"); s.value = ( s.value == '' ) ? "What are you looking for?" : s.value; }
				</script>
			</form>
			<!-- /search -->
			
			<!-- nav -->
			<div id="nav">
				<ul id="navlist">
					<li><a href="<?php bloginfo('home'); ?>">Home</a></li>
					<?php wp_list_pages('title_li=&exclude=' . $mb_exclude_pages . ''); ?>
				</ul>
				<ul id="subscribe-links">
					<li id="subscribe-feed"><a href="<?php if($mb_subscribe_feed) { echo $mb_subscribe_feed; } else { bloginfo('rss2_url'); } ?>" title="Subscribe to RSS Feed">RSS Feed</a></li>
					<?php if($mb_subscribe_email) { ?><li id="subscribe-email"><a href="<?php echo $mb_subscribe_email; ?>" rel="lyteframe" rev="width: 550px; height: 450px; scrolling: no;" title="Sign-up for Email Updates">Email Updates</a></li><?php } ?>
				</ul>
			</div>
			<!-- /nav -->			
			
		</div>
		<!-- /header -->
		
		<?php if(is_home()) { ?>
		<!-- features -->
		<div id="features" class="jcarousel-features">			
			
	    <ul>
				<?php $mb_featured_posts = new WP_Query('cat=' . $mb_featured . '&showposts=3'); ?>
				<?php while ($mb_featured_posts->have_posts()) : $mb_featured_posts->the_post(); $more = 0; ?>
	      <li><?php if (get_post_meta($post->ID, 'feature_image_value', true) && $mb_resize == 0) { ?><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "feature_image_value", $single = true); ?>&amp;w=630&amp;h=250&amp;zc=1&amp;q=95" alt="<?php the_title(); ?>" /><?php } else if (get_post_meta($post->ID, 'feature_image_value', true) && $mb_resize == 1) { ?><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "feature_image_value", $single = true); ?>" alt="<?php the_title(); ?>" /><?php } else { ?><img src="<?php bloginfo('template_directory'); ?>/images/placeholder-feature.jpg" alt="" /><?php } ?><span class="features-effects">&nbsp;</span><div class="button" id="btn-moreinfo"><a href="<?php the_permalink() ?>">More Info</a></div></li>
				<?php endwhile; ?>
	    </ul>
	
			<div id="features-nav">
				<div id="features-nav1" class="features-nav-item current">					
					<span>1</span>
					<?php $mb_featured_posts = new WP_Query('cat=' . $mb_featured . '&showposts=1'); ?>
					<?php while ($mb_featured_posts->have_posts()) : $mb_featured_posts->the_post(); $more = 0; ?>
					<div class="features-nav-tnail"><?php if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 0) { ?><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>&amp;w=58&amp;h=58&amp;zc=1&amp;q=95" alt="<?php the_title(); ?>" /><?php } else if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 1) { ?><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>" alt="<?php the_title(); ?>" /><?php } else { ?><img src="<?php bloginfo('template_directory'); ?>/images/placeholder-feature-tnail.jpg" alt="" /><?php } ?></div>
					<h3><?php echo get_post_meta($post->ID, "feature_title_value", $single = true); ?></h3>
					<p><?php echo get_post_meta($post->ID, "feature_description_value", $single = true); ?></p>
					<?php endwhile; ?>
				</div>				
	      <div id="features-nav2" class="features-nav-item">
					<span>2</span>
					<?php $mb_featured_posts = new WP_Query('cat=' . $mb_featured . '&showposts=1&offset=1'); ?>
					<?php while ($mb_featured_posts->have_posts()) : $mb_featured_posts->the_post(); $more = 0; ?>
					<div class="features-nav-tnail"><?php if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 0) { ?><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>&amp;w=58&amp;h=58&amp;zc=1&amp;q=95" alt="<?php the_title(); ?>" /><?php } else if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 1) { ?><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>" alt="<?php the_title(); ?>" /><?php } else { ?><img src="<?php bloginfo('template_directory'); ?>/images/placeholder-feature-tnail.jpg" alt="" /><?php } ?></div>
					<h3><?php echo get_post_meta($post->ID, "feature_title_value", $single = true); ?></h3>
					<p><?php echo get_post_meta($post->ID, "feature_description_value", $single = true); ?></p>
					<?php endwhile; ?>
				</div>
	      <div id="features-nav3" class="features-nav-item">
					<span>3</span>
					<?php $mb_featured_posts = new WP_Query('cat=' . $mb_featured . '&showposts=1&offset=2'); ?>
					<?php while ($mb_featured_posts->have_posts()) : $mb_featured_posts->the_post(); $more = 0; ?>
					<div class="features-nav-tnail"><?php if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 0) { ?><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>&amp;w=58&amp;h=58&amp;zc=1&amp;q=95" alt="<?php the_title(); ?>" /><?php } else if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 1) { ?><img src="<?php bloginfo('home'); ?><?php echo get_post_meta($post->ID, "post_image_value", $single = true); ?>" alt="<?php the_title(); ?>" /><?php } else { ?><img src="<?php bloginfo('template_directory'); ?>/images/placeholder-feature-tnail.jpg" alt="" /><?php } ?></div>
					<h3><?php echo get_post_meta($post->ID, "feature_title_value", $single = true); ?></h3>
					<p><?php echo get_post_meta($post->ID, "feature_description_value", $single = true); ?></p>
					<?php endwhile; ?>
				</div>
	    </div>		
			
		</div>
		<!-- /features -->
		
		<?php if($mb_point1_title) { ?><!-- points -->
		<div id="points">
			<div id="points-inner">			
				<div id="point-start" class="point">
					<h3><?php echo $mb_point1_title; ?></h3>
					<p><?php echo $mb_point1_desc; ?></p>
				</div>			
				<div class="point">
					<h3><?php echo $mb_point2_title; ?></h3>
					<p><?php echo $mb_point2_desc; ?></p>
				</div>			
				<div id="point-end" class="point">
					<h3><?php echo $mb_point3_title; ?></h3>
					<p><?php echo $mb_point3_desc; ?></p>
					<?php if($mb_about_path) { ?><div class="button <?php if($mb_business == 0) echo 'me'; ?>" id="btn-moreabout"><a href="<?php echo $mb_about_path; ?>">More About Us</a></div><?php } ?>
				</div>			
			</div>			
		</div>
		<!-- /points --><?php } ?>
		<?php } ?>
		
		<!-- mid -->
		<div id="mid" class="content">
			<div id="mid-inner">