<?php
/* 
Plugin Name: Secure and Accessible PHP Contact Form
Plugin URI: http://green-beast.com/blog/?page_id=136
Version: v.2.0WP B20070213
Author: <a href="http://green-beast.com/">Mike Cherim</a> and <a href="http://www.blue-anvil.com/">Mike Jolley</a>
Description: This powerful yet easy-to-install contact form features exceptional accessibility and usability while still providing extensive anti-spam and anti-exploit security features. A marriage of communication and peace-of-mind. 
*/

/* 
Secure and Accessible PHP Contact Form v.2.0WP (c) Copyright 2006-current. All rights reserved.
Mike Cherim (http://green-beast.com/) and Mike Jolley  (http://www.blue-anvil.com/)
You are free to use this application but may not redistribute it without written permission.
Use of this application will be at your own risk. No guarantees or warranties are made, direct or implied.
The creators cannot and will not be liable or held accountable for damages, direct or consequential.
By using this application it implies agreement to these conditions. 
*/
function wp_gb_contact_form() { 	
// Add a new top-level menu:
     add_menu_page('Contact Form', 'Contact Form', 6, __FILE__ , 'gb_contact_form_admin_welcome');
// Add submenus to the custom top-level menu:
     add_submenu_page(__FILE__, 'Configuration', 'Configuration', 6, 'Configuration', 'gb_contact_form_admin');
     add_submenu_page(__FILE__, 'Styling', 'Styling', 6, 'Styling', 'gb_contact_form_admin_style');
     add_submenu_page(__FILE__, 'Documentation', 'Documentation', 6, 'Documentation', 'gb_contact_form_admin_docs');
}
add_action('admin_menu', 'wp_gb_contact_form');

############################################################################
// Checks if user has configured options yet
############################################################################
function gb_check_config() {
    $email=get_option('gb_email_address'); 
    $loc=get_option('form_location');
if($email=="youremail@yourdomain.com" || $email=="" || $loc=="http://yourdomain.com/contact/" || $loc=="") {
    echo ' <div class="updated error"><p><strong>Notice!</strong> It seems that your form is not yet configured. Please <a href="admin.php?page=Configuration">Configure</a> before use. <a href="admin.php?page=Documentation#form-help" title="See Frequently Asked Questions">Why?</a></p></div>'."\n";
}
if(strpos($email,".") === FALSE || strpos($email,"@") === FALSE) {
    echo ' <div class="updated error"><p><strong>Warning!</strong> Please check the <a href="admin.php?page=Configuration#gen">Configured</a> email address(es) as it/they could be somehow malformed. <a href="admin.php?page=Documentation#form-help" title="See Frequently Asked Questions">Why?</a></p></div>'."\n";
}
if(strpos($loc,".") === FALSE || strpos($loc,"http://") === FALSE) {
    echo ' <div class="updated error"><p><strong>Warning!</strong> Please check the <a href="admin.php?page=Configuration#gen">Configured</a> form page <abbr><span class="abbr" title="Uniform resource Locator">URL</span></abbr> as it could be somehow malformed. <a href="admin.php?page=Documentation#form-help" title="See Frequently Asked Questions">Why?</a></p></div>'."\n";
}
return;
}

function gb_contact_form_head() {
    $doslash = get_option('x_or_html');
if($doslash == 'xhtml') {
    $isslash = " /";    
} else {
    $isslash = "";
}
    $sheet = get_option('gb_style');
if($sheet=='theme') {
    echo "\n\n<!-- GBCF -->\n".'<link rel="stylesheet" type="text/css" media="screen" href="'.get_bloginfo('wpurl').'/wp-content/plugins/wp-gbcf/wp-gbcf_themes/'.get_option('gb_theme').'"'.$isslash.'>'."\n";
}
    echo '<!--[if IE]><script src="'.get_bloginfo('wpurl').'/wp-content/plugins/wp-gbcf/wp-gbcf_focus.js" type="text/javascript"></script><![endif]-->'."\n<!-- GBCF -->\n\n";
}
add_action('wp_head', 'gb_contact_form_head');
function gb_admin_form_head() {				
?>
<style type="text/css" media="screen">
  abbr, .abbr { border-bottom:1px dotted #999; cursor:help; }
  input.btn { cursor:pointer; padding:5px 30px 5px 30px; }
  input.reset { cursor:pointer; border:2px outset #999; padding:1px; }
  p.restore { float:left; margin-top:-40px; margin-left:2px; }
  .alert { font-weight:bold; color:#cd0000; font-size:1.1em; }
  .reg_alert { color:#cd0000; }
  fieldset.options { border:1px solid #999; }
  legend { font-weight:bold; color:navy; }
  code { color:navy; font-weight:bold; font-size:1.1em; }
  p.restore a { padding:2px 5px 2px 5px; border:1px solid #999; background-color:#f8f8f8; }
  p.restore a:hover, p.restore a:focus, p.restore a:active { border:1px solid #000; background-color:#cd0000; color:#fff; }
  h2 { font-size:210%; }
  h3 { color:navy; }
  legend a, legend a:visited, .jump a, .jump a:visited { margin:0 5px 0 10px; padding: 0 8px 0 8px; background-color:#666; color: #fff; text-transform:uppercase; font-size:.8em; font-weight:bold; }
  .jump a, .jump a:visited { font-size: .65em; margin:0; text-decoration:none; border:0; white-space: nowrap; }
  legend a:hover, legend a:focus, legend a:active, legend a:visited:hover, legend a:visited:focus, legend a:visited:active, .jump a:hover, .jump a:focus, .jump a:active, .jump a:visited:hover, .jump a:visited:focus, .jump a:visited:active { background-color:navy; color:#fff; }
  span.bump { margin-right: 10px; }
  span.lbump { margin-left: 10px; }
  hr { background-color:#ccc; border:1px solid #ccc; }
  textarea#themebox { width:99%; font-family:'courier new', monospace; font-size:1.1em; }
  dt { font-weight : bold; }
  .error { text-align:center; }
</style>
<?php
}
add_action('admin_head', 'gb_admin_form_head');
if(!function_exists('htmlspecialchars_decode')){
  function htmlspecialchars_decode($text){
  return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
 }
}
################################################################################
// OVERVIEW PAGE
################################################################################
function gb_contact_form_admin_welcome(){
gb_set_options();
add_option('spamCount', '0', 'Spam counter', 'yes');
?>
<div class="wrap">
<h2>Secure and Accessible <abbr><span class="abbr" title="PHP Hypertext Preprocessor">PHP</span></abbr> Contact Form v.2.0WP</h2>
 <p>This powerful yet easy-to-install <abbr><span class="abbr" title="PHP Hypertext Preprocessor">PHP</span></abbr> contact form, brought to you by <a href="http://green-beast.com/">Mike Cherim</a> and <a href="http://www.blue-anvil.com/">Mike Jolley</a>, features exceptional accessibility and usability while still providing extensive anti-spam and anti-exploit security features. A perfect marriage of communication and peace-of-mind. And it works. So far this form has saved you from getting 
   <code class="alert"><?php echo get_option('spamCount');?></code> spam emails! Happy now? Please make a <a href="#donate">Donation</a>.</p>
<?php
		 gb_check_config();
?>
</div>
<div id="over" class="wrap">
<h2>Contact Form Overview</h2>
<p>Shown below is the current <a href="admin.php?page=Configuration#gen">General Configuration</a> of your contact form. Questions? Please review the <a href="admin.php?page=Documentation">Documentation</a> or <a href="admin.php?page=Documentation#form-help"><abbr><span class="abbr" title="Frequently Asked Questions">FAQs</span></abbr></a>.</p>
 <ul>
  <li>As configured, your contact name is <strong><?php echo get_option('gb_contact_name');?></strong></li>
  <li>As configured, you&#8217;re being referred to <strong><?php 
if (get_option('gb_possession')=="pers") { 
    echo ' personally';
} else {
    echo ' as an organization';
}
?></strong></li>
  <li>As configured, you&#8217;ll be receiving emails at <strong><?php echo get_option('gb_email_address');?></strong><?php
    $email=get_option('gb_email_address');
if ($email=="youremail@yourdomain.com" || $email==""){
     echo ' <span class="reg_alert">&laquo; Configuration Required!</span>';
} else if(strpos($email,".") === FALSE || strpos($email,"@") === FALSE) {
     echo ' <span class="reg_alert">&laquo; Malformed Email Address(es)?</span>';
}
?></li>
  <li>As configured, your form page&#8217;s <abbr><span class="abbr" title="Uniform resource Locator">URL</span></abbr> is <strong><?php echo get_option('form_location'); ?></strong><?php
    $loc=get_option('form_location');
if ($loc=="http://yourdomain.com/contact/" || $loc==""){
     echo ' <span class="reg_alert">&laquo; Configuration Required!</span>';
} else if(strpos($loc,".") === FALSE || strpos($loc,"http://") === FALSE) {
     echo ' <span class="reg_alert">&laquo; Malformed Form Page URL?</span>';
}
?></li>
  <li>As configured, your website as named in the email is <strong><?php echo get_option('gb_website_name'); ?></strong></li>
  <li>Based on server location, your web server&#8217;s date/time is <strong><?php echo date("l, F jS, Y \\a\\t g:i a"); ?></strong></li>
  <li>As configured, your time zone offset from the date/time shown above is <strong><?php echo get_option('gb_time_offset'); ?></strong> hours.</li>
  <li>Thus, your form&#8217;s adjusted date/time is <strong><?php echo date("l, F jS, Y \\a\\t g:i a", time()+get_option('gb_time_offset')*60*60); ?></strong></li>
  <li>As configured, <?php
    $style=get_option('gb_style');
    $theme=get_option('gb_theme');
    $themename=str_replace(".css", "", $theme);
if ($style=='none') {
    echo 'you currently have <strong>no form theme</strong> selected &#8212;';
} else {
if ($theme == 'default.css') {
    echo 'you&#8217;re currently using the <strong>default</strong> theme &#8212;';
} else if ($theme == 'custom.css') {
    echo 'you&#8217;re currently using your own <strong>custom</strong> theme &#8212;';
} else {
    echo 'you&#8217;re currently using the pre-made <strong>'.$themename.'</strong> theme &#8212;';
 }                 
}   
?> Change this on the <a href="admin.php?page=Styling">Styling</a> page.</li>
 </ul>
 <p class="submit jump"><a href="#wphead">Top</a></p>
</div>

<div id="donate" class="wrap">
 <h2>Donations Accepted</h2>
 <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
 <fieldset>
  <legend>We Appreciate Your Appreciation &#8212; Make a Donation Today</legend>
   <p style="text-indent:5px;">We spent hours working on this Secure and Accessible <abbr><span class="abbr" title="PHP Hypertext Preprocessor">PHP</span></abbr> Contact Form saving you from hours of fun with spam. Enjoy!</p> 
   <div style="width:600px; height:auto; margin:auto; text-align:center;">
    <input type="hidden" name="cmd" value="_s-xclick" alt="cmd" />
    <label for="submit"><input id="submit" type="image" src="<?php echo(get_bloginfo('wpurl')); ?>/wp-content/plugins/wp-gbcf/wp-gbcf_themes/wp-gbcf_images/wp-gbcf_donate.jpg" name="submit" alt="Make a Donation to the Fight Against Spam via PayPal" title="Make a Donation to the Fight Against Spam via PayPal" style="width:600px;height:60px;cursor:pointer;" /></label>
    <img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
    <input alt="encrypted" type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHLwYJKoZIhvcNAQcEoIIHIDCCBxwCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCRG3v+ofTZ1jHW2YyU0dnZeQeNjw5O3HevXQ17eQSwRJ2swGEpB9V01+n2mU/UXMjJRcR9jmLyWqvSbmX6eWTGXTF4Xaw7ug5+EPnWEL5aPFtnxKXITaJH0HRlwKqAiXl41g9i9GGw/opbGb1ct+8PINiJddtubPp4GC4gFihN7jELMAkGBSsOAwIaBQAwgawGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIQU+iYOA781KAgYiLEM5Qe6+RUri940De766terCCXDoR4RDnz4epG0tekcud3olz89/dOYYeCYhmrf77tJslcATLuazpPQ8cRhELQkSJB4MJFCuGpkPnXODyG4CYnPZtDn3mAaU1Qb/EhZYuKr+2PBx39ua5RswmKQdZH+xcoNeEaiaLzjF0bt7yhOGieaFp6dP5oIIDhzCCA4MwggLsoAMCAQICAQAwDQYJKoZIhvcNAQEFBQAwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMB4XDTA0MDIxMzEwMTMxNVoXDTM1MDIxMzEwMTMxNVowgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBR07d/ETMS1ycjtkpkvjXZe9k+6CieLuLsPumsJ7QC1odNz3sJiCbs2wC0nLE0uLGaEtXynIgRqIddYCHx88pb5HTXv4SZeuv0Rqq4+axW9PLAAATU8w04qqjaSXgbGLP3NmohqM6bV9kZZwZLR/klDaQGo1u9uDb9lr4Yn+rBQIDAQABo4HuMIHrMB0GA1UdDgQWBBSWn3y7xm8XvVk/UtcKG+wQ1mSUazCBuwYDVR0jBIGzMIGwgBSWn3y7xm8XvVk/UtcKG+wQ1mSUa6GBlKSBkTCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb22CAQAwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOBgQCBXzpWmoBa5e9fo6ujionW1hUhPkOBakTr3YCDjbYfvJEiv/2P+IobhOGJr85+XHhN0v4gUkEDI8r2/rNk1m0GA8HKddvTjyGw/XqXa+LSTlDYkqI8OwR8GEYj4efEtcRpRYBxV8KxAW93YDWzFGvruKnnLbDAF6VR5w/cCMn5hzGCAZowggGWAgEBMIGUMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbQIBADAJBgUrDgMCGgUAoF0wGAYJKoZIhvcNAQkDMQsGCSqGSIb3DQEHATAcBgkqhkiG9w0BCQUxDxcNMDYxMDA4MDAxMDI0WjAjBgkqhkiG9w0BCQQxFgQUaiFM2BrBdlakqJVNhkhAerCIasgwDQYJKoZIhvcNAQEBBQAEgYApIKvS3Qx3+CQ4q5iCnb5iowBLYtaNiFrvhHF9ybgPrIvW7XlOTgjU/ZqU3NNXvyoGTzQyBF0amqMavDj2XCZyMF8AanLTYeB3Hbk7JvYmNrqvCHAyYILXKzUYiruFCiytQKL+qI7kiZO/OnnyHOzHmumKoeSjR4MgGBjwHs+Wwg==-----END PKCS7-----" />
   <p style="text-indent:5px; margin-top:3px;"><strong>Note:</strong> Please mark PayPal contributions with <strong>WP-GBCF Donation</strong>. Thank you!</p>
   </div>
  <hr />
  <h3>Not a PayPal User?</h3>
   <p>If PayPal&#8217;s not for you? Please telephone 603.942.5498 or send an <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#109;&#105;&#107;&#101;&#99;&#104;&#101;&#114;&#105;&#109;&#64;&#103;&#114;&#101;&#101;&#110;&#45;&#98;&#101;&#97;&#115;&#116;&#46;&#99;&#111;&#109;?subject=[WP-GBCF]%20Donation" title="Email Mike Cherim">email</a> to make other arrangements. Major credit cards accepted.</p>
  </fieldset>
  </form>
  <p class="submit jump"><a href="#wphead">Top</a></p>
</div>
<?php 
$currentyear = "".date('Y')."";
if($currentyear == "2006") {
    $copyyear = "";
} else { 
    $copyyear = "2006-";
}
?>
<div id="official" class="wrap">
 <h2>Copyright and Disclaimer</h2>
  <p>This Secure and Accessible PHP Contact Form v.2.0WP - &copy; Copyright <?php echo("".$copyyear."".date('Y').""); ?>, <a href="http://green-beast.com/">Mike Cherim</a> and <a href="http://www.blue-anvil.com/">Mike Jolley</a>. All rights reserved. You are free to use this application but may not redistribute it without written permission. Use of this application will be at your own risk. No guarantees or warranties are made, direct or implied. The creators cannot and will not be liable or held accountable for damages, direct or consequential. By using this application it implies agreement to these conditions.</p>
  <p class="submit jump"><a href="#wphead">Top</a></p>
</div>

<?php
}

################################################################################
// DOCUMENTATION PAGE
################################################################################
function gb_contact_form_admin_docs(){
$include_lock = "unlocked";
?>
<div class="wrap">
<h2>Secure and Accessible <abbr><span class="abbr" title="PHP Hypertext Preprocessor">PHP</span></abbr> Contact Form v.2.0WP</h2>
 <p>This page offers <a href="#form-config">Form Configuration Instructions</a>, <a href="#form-style">Form Styling Help</a>, some <a href="#form-help">Helpful <abbr><span class="abbr" title="Frequently Asked Questions">FAQ</span></abbr>s</a>, and a review copy of the <a href="#form-install">Form Installation Instructions</a>. If additional support is needed, please contact <a href="http://green-beast.com/contact/">Mike Cherim</a> or <a href="http://www.blue-anvil.com/contact/">Mike Jolley</a>. Please note, however, free support is on a first-come, first-served basis and will be limited. Paid support, though, is always available and will be given top priority.</p>
<?php
 gb_check_config();
echo('</div>');
include('../wp-content/plugins/wp-gbcf/wp-gbcf_help.php');
}

################################################################################
// FORM STYLING OUTPUT
################################################################################
function gb_process_style($styleFile) {
//processes style page forms
if(!empty($_POST['saveFile'])){
//update css file
    $newfile = stripslashes($_POST['cssFile']);      	
if(is_writeable($styleFile)) {
    $f = fopen($styleFile, 'w+');
         fwrite($f, $newfile);
         fclose($f);

    $style=get_option('gb_style');
    $theme=get_option('gb_theme');
    $themename=$theme;

    echo ' <div id="message" class="updated fade"><p><strong>The &#8220;'.$themename.'&#8221; Stylesheet Has Been Updated</strong></p></div>'."\n";
} else {

    $style=get_option('gb_style');
    $theme=get_option('gb_theme');
    $themename=$theme;

    echo ' <div id="message" class="updated fade"><div class="update error" style="padding-top:14px;padding-bottom:14px;margin-left:15px;"><strong>Write Error!</strong> The &#8220;<code>'.$themename.'</code>&#8221; file is not currently editable/writable! File permissions must first be changed.</p></div>
   <p>To make the file editable, use your server admin or an <abbr><span class="abbr" title="File Transfer Protocol">FTP</span></abbr> program and go to <code>/wp-content/plugins/wp-gbcf/wp-gbcf_themes/</code> and change the file permissions of the <abbr><span class="abbr" title="Cascading Style Sheet">CSS</span></abbr> file to <code class="reg-alert">666</code>. You should then be able to edit the selected file. If you have made a lot of edits and wish not to lose them, change the &#8220;<code>'.$themename.'</code>&#8221; file permissions then simply refresh this page with your browser.</p></div>'."\n";
 }
} else if (!empty($_POST['saveTheme'])){
    $theme=$_POST['theme'];
if($theme=='none'){
      update_option('gb_style', 'none');
      update_option('gb_theme', '');
} else if ($theme=='custom'){
      update_option('gb_style', 'theme');
      update_option('gb_theme', 'custom.css');
} else {
      update_option('gb_style', 'theme');
      update_option('gb_theme', $_POST['theme']);
} 

    $style=get_option('gb_style');
    $theme=get_option('gb_theme');
    $themename=str_replace(".css", "", $theme);
if ($style=='none') {
    $themename = "No";
}

    echo ' <div id="message" class="updated fade"><p><strong>&#8220;'.$themename.'&#8221; Theme Selected</strong></p></div>'."\n";
 }
return($theme);
}

################################################################################
// FORM STYLING ADMIN
################################################################################
function gb_contact_form_admin_style(){
//make sure options exist for the style page
//config options
add_option('gb_style', 'theme', 'Method of styling the form', 'yes');						
add_option('gb_theme', 'default.css', 'Theme', 'yes');			

// $styleFile set to selected theme
    $style=get_option('gb_theme');           
    $styleFile = '../wp-content/plugins/wp-gbcf/wp-gbcf_themes/'.$style;
    $style=gb_process_style($styleFile);
?>
<div class="wrap">
<h2>Secure and Accessible <abbr><span class="abbr" title="PHP Hypertext Preprocessor">PHP</span></abbr> Contact Form v.2.0WP</h2>
 <p>Use this page to modify your contact form&#8217;s styling, assign a specific pre-made theme, no theme, or create your own custom theme.</p> 
<?php
 gb_check_config();
?>
</div>
<div id="thm" class="wrap">
<h2>Form Theme Selector</h2>
<p>Select a pre-made theme, &#8220;none&#8221; to use your own style sheet, or select &#8220;custom.css&#8221; to create your own theme. <span class="lbump jump"><a href="admin.php?page=Documentation#themes">Themes Help</a></span></p>
<form action="admin.php?page=Styling" method="post" id="gb_form" name="configtheme">
<!-- THEME -->		
 <fieldset class="options" id="gen">
  <legend>Selected Form Theme</legend>		
   <table class="optiontable"> 
    <tr> 
     <th scope="row">Choose a theme <abbr><span class="abbr" title="Cascading Style Sheet">CSS</span></abbr>: </th> 
      <td><select style="cursor:pointer;" name="theme"><?php
// read css file in theme directory and magically add them
   $d='../wp-content/plugins/wp-gbcf/wp-gbcf_themes'; #define which dir you want to read
   $dir = opendir($d); #open directory
   $found=false;
   $printcustom=false;
   $printcustomsel=false;
while ($f = readdir($dir)) {
if(eregi("\.css",$f)){ #if filename matches .txt in the name
if($f<>'custom.css') {
if($f==get_option('gb_theme')) {
    echo '<option selected="selected">'.$f.'</option>'."\n";
      $found=true;
} else {
    echo '<option>'.$f.'</option>';
 }									
} else {
if ($f==get_option('gb_theme')) {
    $printcustomsel=true;
    $found=true;
} else {
    $printcustom=true;    								 
   }					
  }
 }
}
if ($printcustomsel==true){
    echo '<option selected="selected">custom.css</option>'."\n";
} else if ($printcustom==true){
    echo '<option>custom.css</option>';
}
if ($found==false){
    echo '<option selected="selected">none</option>'."\n";
} else {
    echo '<option>none</option>';
}
?></select><?php
    $style=get_option('gb_style');
    $thm=get_option('gb_theme');
    $tname=str_replace(".css", "", $thm);
    $tfile=$thm;
if ($style=='none') {
    $tname = "";
    $tnamewith = "View Unstyled Form";
    $tfile = "";
} else {
    $tname = "$tname theme";
    $tnamewith = "View Form with $tname";
    $tfile = "$tfile";
}
    $loc=get_option('form_location');
if($loc=="http://yourdomain.com/contact/" || $loc==""){
     echo ' <span class="reg_alert">Form Page Not Yet <a href="admin.php?page=Configuration#gen">Configured</a>!</span>'."\n";
} else if(strpos($loc,".") === FALSE || strpos($loc,"http://") === FALSE) {
     echo ' <span class="reg_alert">Form Page URL Malformed? Check <a href="admin.php?page=Configuration#gen">Configuration</a>!</span>'."\n";
} else {
     echo ' <span class="lbump jump"><a style="font-size:1.1em;padding:3px 6px 3px 6px;" href="'.$loc.'">'.$tnamewith.'</a></span>'."\n";
}
?></td> 
     </tr>
    </table>
  </fieldset>
 <p class="submit"><input class="btn" type="submit" style="padding:5px 30px 5px 30px;" value="Select Theme" name="saveTheme" /></p>
 </form>
 <p class="submit jump"><a href="#wphead">Top</a>&nbsp;&nbsp;</p>
</div>
<?php
if (get_option('gb_style')<>'none') {
// custom is selected so output the options
?>
<div id="edt" class="wrap">
<h2>Form Theme Editor</h2>
 <p>Use this simple <abbr><span class="abbr" title="Cascading Style Sheet">CSS</span></abbr> file editor to modify your form&#8217;s currently selected <strong><?php echo $tname; ?></strong> style sheet file. <span class="lbump jump"><a href="admin.php?page=Documentation#editor">Editor Help</a></span></p>
 <form method="post" action="admin.php?page=Styling">
  <fieldset>
   <legend>Contact Form Style File Editor. Now Editing: <code style="font-size:1.2em;"><?php echo $tfile; ?></code></legend>
    <textarea rows="20" cols="118" id="themebox" name="cssFile"><?php 
     $style=get_option('gb_theme');		
     $styleFile = '../wp-content/plugins/wp-gbcf/wp-gbcf_themes/'.$style;
//readfile("".$styleFile.""); 
if(!is_file($styleFile))
     $error = 1;
if(!$error && filesize($styleFile) > 0) {
     $f="";
     $f = fopen($styleFile, 'r');
     $file = fread($f, filesize($styleFile));
    echo $file;
      fclose($f);
} else 
    echo 'Sorry. The file you are looking for could not be found';
		?></textarea>
   <p class="submit"><input class="btn" type="submit" style="padding:5px 30px 5px 30px;" value="Save Changes" name="saveFile" /></p>
  </fieldset>
</form>
 <p class="submit jump"><a href="#wphead">Top</a>&nbsp;&nbsp;</p>
</div>
<?php 
//end custom styling
 }
}

################################################################################
// FORM PROCESSESS
################################################################################
function gb_process_admin(){

update_option('gb_email_address', trim($_POST['email']));
update_option('gb_contact_name', trim(stripslashes($_POST['gbname'])));
update_option('gb_possession', $_POST['poss']);
update_option('gb_website_name', trim(stripslashes($_POST['webname'])));
update_option('gb_time_offset', trim($_POST['time_offset']));

    $loc=$_POST['form_location'];
update_option('form_location', $loc);

    $opt=$_POST['options'];
    $opt = explode("\n", $opt);
foreach ($opt as $item){
     $item=trim(stripslashes($item));
if(!empty($item)){
    $options.='"';
    $options.=$item;
    $options.='",';
  }
}
//remove last ( , ) to avoid empty option
$text = trim($options);
$last = $text{strlen($text)-1};
if(!strcmp($last,",")) {
    $text = rtrim($text, 'a..z');
    $text = rtrim($text, ',');
}
update_option('gb_options', $text);

update_option('gb_randomq', trim(stripslashes($_POST['ranqu'])));
update_option('gb_randoma', trim(stripslashes($_POST['ranquans'])));

update_option('gb_heading', $_POST['gb_heading']);
update_option('error_heading', trim(stripslashes($_POST['errorheading'])));
update_option('success_heading', trim(stripslashes($_POST['successheading'])));
update_option('showformhead', $_POST['showformhead']);
update_option('x_or_html', $_POST['x_or_html']);
update_option('send_button', trim(stripslashes($_POST['send_button'])));
update_option('showcredit', $_POST['showcredit']);
update_option('showprivacy', $_POST['showprivacy']);
update_option('privacyurl', trim($_POST['privacyurl']));
update_option('gb_show_cc', trim($_POST['gb_show_cc']));

    $tabindex= $_POST['tab_privacy']; $tabindex.=",";
    $tabindex.=$_POST['tab_name']; $tabindex.=",";
    $tabindex.=$_POST['tab_email']; $tabindex.=",";
    $tabindex.=$_POST['tab_phone']; $tabindex.=",";
    $tabindex.=$_POST['tab_url']; $tabindex.=",";
    $tabindex.=$_POST['tab_reason']; $tabindex.=",";
    $tabindex.=$_POST['tab_message']; $tabindex.=",";
    $tabindex.=$_POST['tab_spam']; $tabindex.=",";
    $tabindex.=$_POST['tab_why']; $tabindex.=",";
    $tabindex.=$_POST['tab_cc']; $tabindex.=",";
    $tabindex.=$_POST['tab_submit'];
													
update_option('tabindex',$tabindex);

    $opt=$_POST['blacklist'];
    $opt = explode("\n", $opt);
foreach ($opt as $item){
    $item=trim(stripslashes($item));
if (!empty($item)){
    $blacklist.='"';
    $blacklist.=$item;
    $blacklist.='",';
  }
}
//remove last ( , ) to avoid empty option
    $text = trim($blacklist);
    $last = $text{strlen($text)-1};
if (!strcmp($last,",")) {
    $text = rtrim($text, 'a..z');
    $text = rtrim($text, ',');
}
update_option('ip_blacklist', $text);

    echo '<div id="message" class="updated fade"><p><strong>Contact Form Configuration Updated</strong></p></div>'."\n";
}

################################################################################
// ADMIN PAGE
################################################################################
function gb_contact_form_admin(){
if ($_REQUEST['del']){
	 gb_del_options();
}

if ($_POST['sub']) {
    gb_process_admin();//gets post data and modifies options
} else {
    gb_set_options();//sets up options for first time use with defaults
}
##get options to show in fields
    $options=get_alloptions();	
// set up arrays from option data
    $gb_options = explode(",", $options->gb_options);
    $ip_blacklist = explode(",", $options->ip_blacklist);
    $tabindex_pieces = explode(",", $options->tabindex);                                     
// preferred tabindexes
    $tab_privacy=  trim($tabindex_pieces[0]);
    $tab_name=     trim($tabindex_pieces[1]);
    $tab_email=    trim($tabindex_pieces[2]);
    $tab_phone=    trim($tabindex_pieces[3]);
    $tab_url=      trim($tabindex_pieces[4]);
    $tab_reason=   trim($tabindex_pieces[5]);
    $tab_message=  trim($tabindex_pieces[6]);
    $tab_spam=     trim($tabindex_pieces[7]);
    $tab_why=      trim($tabindex_pieces[8]);
    $tab_cc=       trim($tabindex_pieces[9]);
    $tab_submit=   trim($tabindex_pieces[10]);                                                                                                                                  
// Fix cases to prevent admin config errors
    $gb_possession = strtolower($options->gb_possession);
    $x_or_html = strtolower($options->x_or_html);
    $showcredit = strtolower($options->showcredit);
    $showprivacy = strtolower($options->showprivacy);
    $gb_show_cc = strtolower($options->gb_show_cc);
?>
<div class="wrap">
<h2>Secure and Accessible <abbr><span class="abbr" title="PHP Hypertext Preprocessor">PHP</span></abbr> Contact Form v.2.0WP</h2>
 <p>Use this page to configure the form for use on your web log. If you need help or have questions, please review the <a href="admin.php?page=Documentation">Documentation</a>.</p>
<?php
 gb_check_config();
?>
</div>
<div class="wrap" id="form-config">
<h2>Form Configuration</h2>
<div>
 <form action="admin.php?page=Configuration" method="post" id="gb_form" name="config">

<!-- GENERAL -->		
 <fieldset class="options" id="gen">
  <legend>Section 1 of 7 &raquo; General Configuration 
<?php
    $email=get_option('gb_email_address'); 
    $loc=get_option('form_location');
if($email=="youremail@yourdomain.com" || $email=="" || $loc=="http://yourdomain.com/contact/" || $loc=="") {
    echo '- <span class="alert">Required!</span> ';
} else if(strpos($email,".") === FALSE || strpos($email,"@") === FALSE) {
    echo '- <span class="alert">Malformation?</span>';
} else if(strpos($loc,".") === FALSE || strpos($loc,"http://") === FALSE) {
    echo '- <span class="alert">Malformation?</span>';
}
?><small><a href="admin.php?page=Documentation#sect-1">Section 1 Help</a></small></legend>		
   <table class="optiontable"> 
    <tr>
     <th scope="row">&nbsp;</th>
      <td>These options are essential for branding and functionality.</td>
    </tr>
    <tr> 
     <th scope="row">Your name or company name: </th> 
      <td><input type="text" value="<?php echo $options->gb_contact_name; ?>" name="gbname" id="gbname" /></td> 
    </tr>
    <tr> 
     <th scope="row"><?php
    $email=get_option('gb_email_address');
if($email=="youremail@yourdomain.com" || $email==""){
    echo '<span class="alert">Your email address(<span class="abbr" title="Mulitple addresses must be comma-separated">es</span>)</span>: ';
} else {
     echo 'Your email address(<span class="abbr" title="Mulitple addresses must be comma-separated">es</span>): ';
} 
?></th> 
      <td><input type="text" value="<?php echo $options->gb_email_address; ?>" name="email" id="email" />
<?php 
if(strpos($email,".") === FALSE || strpos($email,"@") === FALSE) {
     echo ' <span class="reg_alert">&laquo; Malformed Email Address(es)?</span>';
} 
?></td> 
    </tr>
    <tr>
     <th scope="row"><?php
    $loc=get_option('form_location');
if($loc=="http://yourdomain.com/contact/" || $loc==""){
    echo '<span class="alert">Your form page <abbr><span class="abbr" title="Uniform Resource Locator">URL</span></abbr></span>: ';
} else {
     echo 'Your form page <abbr><span class="abbr" title="Uniform Resource Locator">URL</span></abbr>: ';
} 
?></th> 
    <td><input type="text" value="<?php echo $options->form_location; ?>" name="form_location" id="form_location" /><?php 
if(strpos($loc,".") === FALSE || strpos($loc,"http://") === FALSE) {
     echo ' <span class="reg_alert">&laquo; Malformed Form Page URL?</span>';
} 
?></td>
    </tr>
    <tr> 
     <th scope="row">Form possession: </th> 
      <td><select style="cursor:pointer;" name="poss" id="poss">
<?php 			
if($gb_possession=='pers') {
    echo '       <option value="pers" selected="selected">Personal</option>'."\n";
    echo '       <option value="org">Organization</option>'."\n";
} else {
    echo '       <option value="pers">Personal</option>'."\n";
    echo '       <option value="org" selected="selected">Organization</option>'."\n";
} ?>    </select></td> 
    </tr>
    <tr> 
     <th scope="row">Your website&#8217;s name: </th> 
      <td><input type="text" value="<?php echo $options->gb_website_name; ?>" name="webname" id="webname" /></td> 
    </tr>
	<tr> 
     <th scope="row">Time offset (e.g. +1, -1): </th> 
      <td><input type="text" value="<?php echo $options->gb_time_offset; ?>" name="time_offset" id="time_offset" /></td> 
    </tr>
   </table>
 <p class="submit jump"><a href="#wphead">Top</a></p>
  </fieldset>		

<!-- REASONS -->	
  <fieldset class="options" id="rsn">
  <legend>Section 2 of 7 &raquo; Contact Reason Menu <small><a href="admin.php?page=Documentation#sect-2">Section 2 Help</a></small></legend>		
   <table class="optiontable"> 
    <tr>
     <th scope="row">&nbsp;</th>
      <td>Add unlimited pull-down menu options. Enter each option on a new line.</td>
    </tr>
    <tr valign="top">
     <th scope="row">Pull-down menu options: </th>
      <td><textarea rows="5" cols="45" name="options">
<?php
foreach ($gb_options as $option){
    $option = str_replace('"', "", "$option");
    $option = trim($option);
if(!empty($option)){											
    echo $option;
    echo ''."\n";
  }
} 
?>     </textarea></td>
    </tr>
   </table>
 <p class="submit jump"><a href="#wphead">Top</a></p>
  </fieldset>	

<!-- ANTI SPAM -->
  <fieldset class="options" id="ats">
  <legend>Section 3 of 7 &raquo; Anti-Spam Question/Answer <small><a href="admin.php?page=Documentation#sect-3">Section 3 Help</a></small></legend>		
   <table class="optiontable"> 
    <tr>
     <th scope="row">&nbsp;</th>
      <td>Change question/answer now and then, make sure it&#8217;s easy to answer by a person.</td>
    </tr>
    <tr>
     <th scope="row">Enter a simple question: </th>
      <td><input type="text" value="<?php echo $options->gb_randomq; ?>" name="ranqu" id="ranqu" /></td>
    </tr>
    <tr>
     <th scope="row">Enter the logical answer: </th>
      <td><input type="text" value="<?php echo $options->gb_randoma; ?>" name="ranquans" id="ranquans" /></td>
    </tr>		
   </table>
 <p class="submit jump"><a href="#wphead">Top</a></p>
  </fieldset>	

<!-- HEADINGS -->
  <fieldset class="options" id="hdo">
  <legend>Section 4 of 7 &raquo; Heading Options <small><a href="admin.php?page=Documentation#sect-4">Section 4 Help</a></small></legend>		
   <table class="optiontable"> 
    <tr>
     <th scope="row">&nbsp;</th>
      <td>These options change the default headings shown on your form.</td>
    </tr>
    <tr>
     <th scope="row">Error heading size (1 is largest): </th>
      <td><select style="cursor:pointer;" name="gb_heading" >
        <option<?php if ($options->gb_heading=='1') echo ' selected="selected"'; ?>>1</option>
        <option<?php if ($options->gb_heading=='2') echo ' selected="selected"'; ?>>2</option>
        <option<?php if ($options->gb_heading=='3') echo ' selected="selected"'; ?>>3</option>
        <option<?php if ($options->gb_heading=='4') echo ' selected="selected"'; ?>>4</option>
        <option<?php if ($options->gb_heading=='5') echo ' selected="selected"'; ?>>5</option>
        <option<?php if ($options->gb_heading=='6') echo ' selected="selected"'; ?>>6</option>		
       </select></td>
    </tr>
    <tr>
     <th scope="row">Error heading text: </th>
      <td><input type="text" value="<?php echo $options->error_heading; ?>" name="errorheading" id="errorheading" /></td>
    </tr>
    <tr>
     <th scope="row">Success heading text: </th>
      <td><input type="text" value="<?php echo $options->success_heading; ?>" name="successheading" id="successheading" /></td>
    </tr>
    <tr>
     <th scope="row" valign="top">Show form heading?: </th>
      <td><select style="cursor:pointer;" name="showformhead">
<?php 
if ($options->showformhead=='yes') { 
    echo '   <option selected="selected">yes</option>'."\n";
    echo '   <option>no</option>'."\n";
} else {
    echo '   <option>yes</option>'."\n";
    echo '   <option selected="selected">no</option>'."\n";
} ?>  </select></td>
    </tr>
   </table>
 <p class="submit jump"><a href="#wphead">Top</a></p>
  </fieldset>

<!-- OPTIONS -->		
  <fieldset class="options" id="oth">
  <legend>Section 5 of 7 &raquo; Other Configuration Options <small><a href="admin.php?page=Documentation#sect-5">Section 5 Help</a></small></legend>		
   <table class="optiontable"> 
   <tr>
     <th scope="row">&nbsp;</th>
      <td>These are some special form customization options.</td>
    </tr>
    <tr>
     <th scope="row">Choose <abbr><span class="abbr" title="Extensible HyperText Markup Language">XHTML</span></abbr> or <abbr><span class="abbr" title="HyperText Markup Language">HTML</span></abbr>?</th>
      <td><select style="cursor:pointer;" name="x_or_html">
       <option<?php if ($x_or_html=='xhtml') echo ' selected="selected"'; ?>>xhtml</option>
       <option<?php if ($x_or_html=='html') echo ' selected="selected"'; ?>>html</option>
	  </select></td>
    </tr>
    <tr>
     <th scope="row">Submit button text: </th>
      <td><input type="text" value="<?php echo $options->send_button; ?>" name="send_button" id="send_button" /></td>
    </tr>
    <tr>
     <th scope="row">Show form credits line? </th>
      <td><select style="cursor:pointer;" name="showcredit">
       <option<?php if ($showcredit=='yes') echo ' selected="selected"'; ?>>yes</option>
       <option<?php if ($showcredit=='no') echo ' selected="selected"'; ?>>no</option>
      </select></td>
    </tr>
	<tr>
     <th scope="row">Show link to your privacy page? </th>
      <td><select style="cursor:pointer;" name="showprivacy">
       <option<?php if ($showprivacy=='yes') echo ' selected="selected"'; ?>>yes</option>
       <option<?php if ($showprivacy=='no') echo ' selected="selected"'; ?>>no</option>
	  </select></td>
    </tr>
    <tr>
     <th scope="row">Full privacy page <abbr><span class="abbr" title="Uniform Resource Locator">URL</span></abbr>: </th>
      <td><input type="text" value="<?php echo $options->privacyurl; ?>" name="privacyurl" id="privacyurl" /></td>
    </tr>	
	<tr> 
     <th scope="row">Offer carbon copy option?: </th> 
      <td><select style="cursor:pointer;" name="gb_show_cc" id="gb_show_cc">
       <option<?php if ($gb_show_cc=='yes') echo ' selected="selected"'; ?>>yes</option>
       <option<?php if ($gb_show_cc=='no') echo ' selected="selected"'; ?>>no</option> 
      </select></td>
    </tr>	
   </table>
 <p class="submit jump"><a href="#wphead">Top</a></p>
  </fieldset>

<!-- TABINDEXES -->
  <fieldset class="options" id="tab">
  <legend>Section 6 of 7 &raquo; Custom Tabindex Assignments <small><a href="admin.php?page=Documentation#sect-6">Section 6 Help</a></small></legend>		
   <table class="optiontable"> 
    <tr>
     <th scope="row">&nbsp;</th>
      <td>Enter your preferred tabindexing on the contact form.</td>
    </tr>
    <tr>
     <th scope="row">Privacy link: </th>
      <td><input type="text" value="<?php echo $tab_privacy; ?>" style="width:32px" name="tab_privacy" /> <small><strong>Note:</strong> Leave &#8220;0&#8221; if Privacy Policy link is not offered!</small></td>
    </tr>
    <tr>
     <th scope="row">Name field: </th>
      <td><input type="text" value="<?php echo $tab_name; ?>" style="width:32px" name="tab_name" /></td>
    </tr>		
    <tr>
     <th scope="row">Email field: </th>
      <td><input type="text" value="<?php echo $tab_email; ?>" style="width:32px" name="tab_email" /></td>
    </tr>	
    <tr>
     <th scope="row">Phone field: </th>
      <td><input type="text" value="<?php echo $tab_phone; ?>" style="width:32px" name="tab_phone" /></td>
    </tr>	
    <tr>
     <th scope="row">Website field: </th>
      <td><input type="text" value="<?php echo $tab_url; ?>" style="width:32px" name="tab_url" /></td>
    </tr>	
    <tr>
     <th scope="row">Reason field: </th>
      <td><input type="text" value="<?php echo $tab_reason; ?>" style="width:32px" name="tab_reason" /></td>
    </tr>	
    <tr>
     <th scope="row">Message field: </th>
      <td><input type="text" value="<?php echo $tab_message; ?>" style="width:32px" name="tab_message" /></td>
    </tr>	
    <tr>
     <th scope="row">Spam-Q field: </th>
      <td><input type="text" value="<?php echo $tab_spam; ?>" style="width:32px" name="tab_spam" /></td>
    </tr>	
    <tr>
     <th scope="row">Why? Link: </th>
      <td><input type="text" value="<?php echo $tab_why; ?>" style="width:32px" name="tab_why" /></td>
    </tr>
    <tr>
     <th scope="row">CC checkbox: </th>
      <td><input type="text" value="<?php echo $tab_cc; ?>" style="width:32px" name="tab_cc" /> <small><strong>Note:</strong> Leave &#8220;0&#8221; if Carbon Copy option is not offered!</small></td>
    </tr>
    <tr>
     <th scope="row">Submit button: </th>
      <td><input type="text" value="<?php echo $tab_submit; ?>" style="width:32px" name="tab_submit" /></td>
    </tr>
   </table>
 <p class="submit jump"><a href="#wphead">Top</a></p>
  </fieldset>

<!-- IP BLACKLIST -->
  <fieldset class="options" id="ipb">
  <legend>Section 7 of 7 &raquo; <abbr><span class="abbr" title="Internet Protocol">IP</span></abbr> Blacklist <small><a href="admin.php?page=Documentation#sect-7">Section 7 Help</a></small></legend>		
   <table class="optiontable"> 
    <tr>
     <th scope="row">&nbsp;</th>
      <td>Block IP addresses ONLY if necessary - Enter each on a new line</td>
    </tr>
    <tr valign="top">
     <th scope="row">Blacklisted <abbr><span class="abbr" title="Internet Protocol">IP</span></abbr>s: </th>
      <td><textarea rows="5" cols="45" name="blacklist">
<?php
foreach ($ip_blacklist as $item){		
    $item = str_replace('"', "", "$item");
    $item = trim($item);					
if (!empty($item)){
    echo $item;
    echo ''."\n";
 }
} 
?>     </textarea></td>
    </tr>
   </table>
 <p class="submit jump"><a href="#wphead">Top</a></p>
  </fieldset>

<!-- SUBMIT FORM -->
   <table class="optiontable"> 
    <tr>
     <th scope="row">&nbsp;</th>
      <td><p class="submit"><input type="hidden" name="sub" value="sub" /><input type="submit" class="btn" name="save" style="padding:5px 30px 5px 30px;" value="Save Form Configuration" /></p></td>
    </tr>
   </table>
   <p class="restore"><a href="admin.php?page=Configuration&amp;del=del">Restore All Default Values &amp; Zero Spam Counter</a></p>
   <p class="submit jump" style="margin-top:-10px;"><a href="#wphead">Top</a>&nbsp;&nbsp;</p>
  </form>
 </div>
</div>
<?php
}
################################################################################
// OPTIONS PART 1 - Main form options
################################################################################
function gb_del_options() {

delete_option('spamCount');	
delete_option('gb_contact_name');																													
delete_option('gb_email_address');
delete_option('form_location');
delete_option('gb_possession');##
delete_option('gb_website_name');
delete_option('gb_time_offset');
################################################################################
// OPTIONS PART 2 - "Contact Reason" menu
################################################################################		
delete_option('gb_options');
################################################################################
// OPTIONS PART 3 - "Anti-Spam" q/a options
################################################################################
delete_option('gb_randomq');
delete_option('gb_randoma');
################################################################################
// OPTIONS PART 4 - Heading options            
################################################################################
delete_option('gb_heading');
delete_option('error_heading');
delete_option('success_heading');
delete_option('showformhead');
################################################################################
// OPTIONS PART 5 - Other config options         
################################################################################
delete_option('x_or_html');##
delete_option('send_button');
delete_option('showcredit');##
delete_option('showprivacy');##
delete_option('privacyurl');
delete_option('gb_show_cc');
################################################################################
// OPTIONS PART 6 - Custom tabindex assignments         
################################################################################
delete_option('tabindex');##
################################################################################
// OPTIONS PART 7 - IP Blacklist       
################################################################################
delete_option('ip_blacklist');##
################################################################################
}
################################################################################
// OPTIONS PART 1 - Main form options
################################################################################
function gb_set_options() {
																
add_option('gb_contact_name', 'Form User', 'Your name or company name', 'yes');														
add_option('gb_email_address', 'youremail@yourdomain.com', 'Your email address(es)', 'yes');
add_option('form_location', 'http://yourdomain.com/contact/', 'Form location URL', 'yes');
add_option('gb_possession', 'pers', 'Form posession', 'yes');##
add_option('gb_website_name', 'Your Website', 'Pull-down menu options', 'yes');
add_option('gb_time_offset', '0', 'Time offset', 'yes');

################################################################################
// OPTIONS PART 2 - "Contact Reason" menu
################################################################################		
add_option('gb_options', 'To make a comment'.",".'To ask a question'.",".'Report a site problem'.",".'Other (explain below)'.",", 'Your website name', 'yes');

################################################################################
// OPTIONS PART 3 - "Anti-Spam" q/a options
################################################################################
add_option('gb_randomq', 'Is fire hot or cold?', 'Random qu', 'yes');
add_option('gb_randoma', 'hot', 'Random qu Answer', 'yes');

################################################################################
// OPTIONS PART 4 - Heading options            
################################################################################
add_option('gb_heading', '2', 'Error heading size (1 is largest)', 'yes');
add_option('error_heading', 'Whoops! Error Made!', 'Enter error heading text', 'yes');
add_option('success_heading', 'Success! Mail Sent!', 'Enter success heading text', 'yes');
add_option('showformhead', 'yes', 'Show the form header', 'yes');

################################################################################
// OPTIONS PART 5 - Other config options         
################################################################################
add_option('x_or_html', 'xhtml', 'Choose XHTML or HTML', 'yes');##
add_option('send_button', 'Submit Form', 'Submit button text', 'yes');
add_option('showcredit', 'yes', 'Enter credit link option', 'yes');##
add_option('showprivacy', 'no', 'Enter privacy link option', 'yes');##
add_option('privacyurl', 'http://yourdomain.com/privacy/', 'Enter privacy link URL', 'yes');
add_option('gb_show_cc', 'yes', 'Show CC', 'yes');##

################################################################################
// OPTIONS PART 6 - Custom tabindex assignments         
################################################################################
add_option('tabindex', '0,0,0,0,0,0,0,0,0,0,0', 'Tabindex assignments', 'yes');##

################################################################################
// OPTIONS PART 7 - IP Blacklist       
################################################################################
add_option('ip_blacklist', '0.0.0.0'.",".'00.11.22.33'.",".'00.255.255.255'.",", 'Block IPs', 'yes');##

################################################################################
}
function trim_value(&$value) { 
   $value = trim($value); 
}
function gbcf_show(){
    // Function shows the form inside a template, instead of making a page.
    $show=show_contact_form("<!--gb_contact_form-->");
    echo $show;
}
add_filter('the_content', 'show_contact_form');
function show_contact_form($content='') {
if(strstr ($content, "<!--gb_contact_form-->" )){
################################################################################
// Secure and Accessible PHP Contact Form v.2.0WP by Mike Cherim and Mike Jolley
################################################################################
$forms="";//stores form ready for output to page		
// VERSION NUMBER
$form_version = "v.2.0WP";
$build = "B20070213";

################################################################################
// Get all options, process options that contain arrays ready for use
// $options->option name;	<----This is how you get the options value in the script	
################################################################################
    $options=get_alloptions();	

// set up arrays from option data
    $gb_options = explode(",", $options->gb_options);		
    $gb_options=str_replace ( '"', "", $gb_options );
	
    $ip_blacklist = explode(",", $options->ip_blacklist);		
    $ip_blacklist=str_replace ( '"', "", $ip_blacklist );
			
    $tabindex_pieces = explode(",", $options->tabindex);                                     
// preferred tabinxes
    $tab_privacy=            $tabindex_pieces[0];
    $tab_name=               $tabindex_pieces[1];
    $tab_email=              $tabindex_pieces[2];
    $tab_phone=              $tabindex_pieces[3];
    $tab_url=                $tabindex_pieces[4];
    $tab_reason=             $tabindex_pieces[5];
    $tab_message=            $tabindex_pieces[6];
    $tab_spam=               $tabindex_pieces[7];
    $tab_why=                $tabindex_pieces[8];
    $tab_cc=                 $tabindex_pieces[9];
    $tab_submit=             $tabindex_pieces[10];    
                                                                                                                              
//get other options 
    $gb_email_address = $options->gb_email_address;
    $gb_contact_name = $options->gb_contact_name;
    $gb_website_name = $options->gb_website_name;
    $gb_show_cc = $options->gb_show_cc;
    $gb_randomq = $options->gb_randomq;
    $gb_randoma = $options->gb_randoma;
    $gb_heading = $options->gb_heading;
    $error_heading = $options->error_heading;
    $success_heading = $options->success_heading;
    $privacyurl = $options->privacyurl;
    $send_button = $options->send_button;			   
    $form_location = $options->form_location;

// Fix cases to prevent admin config errors
    $gb_possession = strtolower($options->gb_possession);
    $x_or_html = strtolower($options->x_or_html);
    $showcredit = strtolower($options->showcredit);
    $showprivacy = strtolower($options->showprivacy);
    $gb_show_cc = strtolower($options->gb_show_cc);

// Possession management conditions begin
if($gb_possession == "pers") {
     $i_or_we = "I";
     $me_or_us = "me";;
     $my_or_our = "my";
} else if ($gb_possession == "org") {
     $i_or_we = "we";
     $me_or_us = "us";
     $my_or_our = "our";
 } else {
     $i_or_we = "I";
     $me_or_us = "me";
     $my_or_our = "my";
}

// X/HTML choice negotiation
if($x_or_html == "xhtml") {
     $x_or_h_br = "<br />";
     $x_or_h_in = " /";
} else if($x_or_html == "html") {
     $x_or_h_br = "<br>";
     $x_or_h_in = "";
} else {
     $x_or_h_br = "<br />";
     $x_or_h_in = " /";
}

// Unique ID generators (random values would require a session)
     $fl = "$form_location";
     $fv = "$form_version";
     $fp = "$gb_possession";
     $fd = date("TOZ");

// The Pierre Modification
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
     $fh = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
     $fh = gethostbyaddr($_SERVER['REMOTE_ADDR']);
}

     $form_id = ''.$fd.''.$fp.''.$fl.''.$fv.''.$fh.'';
     $trap1_value = ''.$fp.''.$fv.''.$fh.''.$fl.''.$fd.'';
     $send_value = ''.$fh.''.$fd.''.$fv.''.$fp.''.$fl.'';
     $form_id = strtoupper(trim(rtrim(str_replace(array("&", "/", "#", "\\", ":", "%", "|", "^", ";", "@", "?", "+", "$", ".", "~", "-", "=", "_", " ",), 'Xz7r9e6', $form_id)))); 
     $trap1_value = strtoupper(trim(rtrim(str_replace(array("&", "/", "#", "\\", ":", "%", "|", "^", ";", "@", "?", "+", "$", ".", "~", "-", "=", "_", " ",), 'fi7c41x', $trap1_value)))); 
     $send_value = strtoupper(trim(rtrim(str_replace(array("&", "/", "#", "\\", ":", "%", "|", "^", ";", "@", "?", "+", "$", ".", "~", "-", "=", "_", " ",), '6wPsA3c', $send_value)))); 

$forms.="\n".'<div id="gb_form_div"><!-- BEGIN: Secure and Accessible PHP Contact Form '.$form_version.' by Mike Cherim (http://green-beast.com/) and Mike Jolley (http://www.blue-anvil.com/) -->'."\n";

 if ($_POST[$send_value]) {

// Posted variables
     $gbname = $_POST['gbname'];           
     $email = $_POST['email'];         
     $phone = $_POST['phone'];     
     $url = $_POST['url'];
     $reason = $_POST['reason'];       
     $message = $_POST['message'];     
     $formid = $_POST['GB'.$form_id.''];
     $trap1 = $_POST['GB'.$trap1_value.''];
     $trap2 = $_POST['p-mail'];
     $spamq = $_POST['spamq']; 
     $gbcc = @$_POST['gbcc'];
     $ltd = date("l, F jS, Y \\a\\t g:i a", time()+$options->gb_time_offset*60*60);

     $ip = getenv("REMOTE_ADDR");
     $hr = getenv("HTTP_REFERER");
     $hst = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
     $ua = $_SERVER['HTTP_USER_AGENT'];

// Strip slashes, html, php, binary, and scrub posted vars
     $gbname = stripslashes(strip_tags(trim($gbname)));
     $email = stripslashes(strip_tags(trim(strtolower($email))));
     $phone = stripslashes(strip_tags(trim($phone)));
     $url = stripslashes(strip_tags(trim($url)));
     $reason = stripslashes(strip_tags(trim($reason)));
     $message = stripslashes(strip_tags(trim($message)));
     $spamq = strtolower(trim($spamq));
     $gb_randoma = strtolower(trim($gb_randoma));
     $ltd = stripslashes(strip_tags(trim($ltd)));
     $ip = stripslashes(strip_tags(trim($ip)));
     $hr = stripslashes(strip_tags(trim($hr)));
     $hst = stripslashes(strip_tags(trim($hst)));
     $ua = stripslashes(strip_tags(trim($ua)));
     $formid = stripslashes(strip_tags(trim($formid)));

// Email header
     $gb_email_header = "From: $gb_email_address\n"."Reply-To: $email\n"."MIME-Version: 1.0\n"."Content-type: text/plain; charset=\"utf-8\"\n"."Content-transfer-encoding: quoted-printable\n\n"; 

// Strip more html, php, and binary, then scrub 
     $gb_email_header = stripslashes(strip_tags(trim($gb_email_header)));

// Identify exploits
     $head_expl = "/(bcc:|cc:|document.cookie|onclick|onload)/i";
     $inpt_expl = "/(content-type|to:|bcc:|cc:|document.cookie|onclick|onload)/i";

// Modify referrer to counter bogus www/no.www mismatch errors
     $form_location = strtolower(trim(rtrim(str_replace(array("http", "www", "&", "/", "#", "\\", ":", "%", "|", "^", ";", "@", "?", "+", "$", ".", "~", "-", "=", "_", " ",), '', $form_location)))); 
     $new_referrer = strtolower(trim(rtrim(str_replace(array("http", "www", "&", "/", "#", "\\", ":", "%", "|", "^", ";", "@", "?", "+", "$", ".", "~", "-", "=", "_", " ",), '', $_SERVER['HTTP_REFERER'])))); 

// Carbon Copy request negotiation
if($gbcc == "gbcc") {
     $gb_cc = ", $email";
     $cc_notify1 = "".$x_or_h_br."<small>(A carbon copy has also been sent to this address.)</small>";
     $cc_notify2 = "(Copy sent)";
     $cc_notify3 = "";
} else {
     $gb_cc = "";
     $cc_notify1 = ""; 
     $cc_notify2 = ""; 
     $cc_notify3 = "";
} 

// Required fields need stuffing or get an error showing fields needed
if(!isset($gbname,$email,$reason,$message,$spamq) || empty($gbname) || empty($email) || empty($reason) || empty($message) || empty($spamq)){
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'> 
     <p><span class="error">Required Field(s) Missed:</span> The following &#8220;Required&#8221; fields were not filled in. Using your &#8220;Back&#8221; button, please go back and fill in all required fields.</p>'."\n");
     $forms.=('      <dl>'."\n");
     $forms.=('       <dt>Empty Field(s):</dt>'."\n");
if(empty($gbname)) { 
     $forms.=('        <dd>&#8220;Enter your full name&#8221;</dd>'."\n"); 
}
if(empty($email)) { 
     $forms.=('        <dd>&#8220;Enter your email address&#8221;</dd>'."\n"); 
}
if(empty($reason)) { 
     $forms.=('        <dd>&#8220;Select a contact reason&#8221;</dd>'."\n"); 
}
if(empty($message)) { 
     $forms.=('        <dd>&#8220;Enter your message&#8221;</dd>'."\n"); 
}
if(empty($spamq)) { 
     $forms.=('        <dd>&#8220;'.$gb_randomq.'&#8221;</dd>'."\n"); 
}
     $forms.=('      </dl>'."\n");
} else {

// Or the email doesn't seem to be properly formed or has illegal email characters
if(!ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})", "$email")) {
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Invalid Email Address:</span> The email address you have submitted seems to be invalid. Using your &#8220;Back&#8221; button, please go back and check the address you entered. Please try not to worry, '.$i_or_we.' do respect your privacy.</p>'."\n");
		 inc_spam_count();
// Anti-spam verification
} else if($spamq !== "$gb_randoma") {
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Anti-Spam Question/Answer Mismatch:</span> The answer you supplied to the anti-spam question is incorrect. Using your &#8220;Back&#8221; button, please go back and try again or use '.$my_or_our.' regular email, <a href="mailto:'.$gb_email_address.'?subject='.$gb_website_name.'%20Backup%20Email%20[Anti-Spam Question/Answer Mismatch]">'.$gb_email_address.'</a>, if having Anti-Spam question difficulty.</p>'."\n");
		 inc_spam_count();
// Anti-spam trap 1
} else if($trap1 !== "") {
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Anti-Spam Trap 1 Field Populated:</span> You populated a spam trap anti-spam input so you must be a spambot. Go away!</p>'."\n");
     inc_spam_count();
// Anti-spam trap 2
} else if($trap2 !== "") {
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Anti-Spam Trap 2 Field Populated:</span> You populated a spam trap anti-spam input that is meant to confuse automated spam-sending machines. If you accidently entered data in this field, using your &#8220;Back&#8221; button, please go back and remove it before submitting this form. Sorry for the confusion.</p>'."\n");
		 inc_spam_count();
// Input length error tripping
} else if(strlen($gbname) > 40 || strlen($email) > 40 || strlen($phone) > 30 || strlen($url) > 60 || strlen($gbcc) > 4) {
       $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Input Maxlength Violation:</span> Certain inputs have been populated beyond that which is allowed by the form. Therefore you must be trying to post remotely and are probably a spambot. Go away!</p>'."\n");
		 inc_spam_count();
// Contact reason validation
} else if(!in_array($reason, $gb_options)) { 
       $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Contact Reason Violation:</span> You have tried to post a &#8220;Contact Reason&#8221; which doesn&#8217;t exist in '.$my_or_our.' menu. Therefore you must be trying to post remotely and are probably a spambot. Go away!</p>'."\n");
		 inc_spam_count();
// Check the IP black list
} else if(in_array($ip, $ip_blacklist)) { 
       $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Blacklisted IP Address:</span> Sorry, but your IP address has been blocked. Perhaps you have abused your form submission privileges in the past. If you&#8217;ve sent spam to '.$me_or_us.' in the past, this could be the reason.</p>'."\n");
		 inc_spam_count();
// Form value confirmation
} else if($formid !== "GB".$form_id."") {
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Form ID Value Mismatch:</span> The submitted ID does not match registered ID of this form which means you&#8217;re trying to post remotely so this mean you must be a spambot. Go away!</p>'."\n");
		 inc_spam_count();
// Let match the referrer to ensure it's sent from here and not elsewhere
} else if($new_referrer !== $form_location) {
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Referrer Missing or Mismatch:</span> It looks like you&#8217;re trying to post remotely or you have blocked referrers on your user agent or browser. Using your &#8220;Back&#8221; button, please go back and try again or use '.$my_or_our.' regular email, <a href="mailto:'.$gb_email_address.'?subject='.$gb_website_name.'%20Backup%20Email%20[Referrer Missing or Mismatch]">'.$gb_email_address.'</a>, to circumvent Referrer Mismatch.</p>'."\n");
		 inc_spam_count();
// And now let's see if the variable for submit matches what's required
} else if(!(isset($_POST[''.$send_value.'']))) {
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Submit Variable Mismatch:</span> It looks like you&#8217;re trying to post remotely as the submit variable is unmatched. Using your &#8220;Back&#8221; button, please go back and try again  or try '.$my_or_our.' regular email, <a href="mailto:'.$gb_email_address.'?subject='.$gb_website_name.'%20Backup%20Email%20[Submit Variable Mismatch]">'.$gb_email_address.'</a>, to circumvent Variable Mismatch.</p>'."\n");
		 inc_spam_count();
// Finally, my long version of Jem's exploit killer
} else if(preg_match($head_expl, $gb_email_header) || preg_match($inpt_expl, $gbname) || preg_match($inpt_expl, $email) || preg_match($inpt_expl, $phone) || preg_match($inpt_expl, $url) || preg_match($inpt_expl, $message)) {
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="error">'.$error_heading.'</span></h'.$gb_heading.'>
     <p><span class="error">Injection Exploit Detected:</span> It seems that you&#8217;re possibly trying to apply a header or input injection exploit in '.$my_or_our.' form. If you are, please stop at once! If not, using your &#8220;Back&#8221; button, please go back and check to make sure you haven&#8217;t entered <strong>content-type</strong>, <strong>to:</strong>, <strong>bcc:</strong>, <strong>cc:</strong>, <strong>document.cookie</strong>, <strong>onclick</strong>, or <strong>onload</strong> in any of the form inputs. If you have and you&#8217;re trying to send a legitimate message, for security reasons, please find another way of communicating these terms.</p>'."\n");
		 inc_spam_count();
// Holy smokes, looks like all's cool and we can send the message
} else {
     $gb_content = "Hello $gb_contact_name,\n\nYou are being contacted via $gb_website_name by $gbname. $gbname has provided the following information so you may contact them:\n\n   Email: $email $cc_notify2\n   Phone: $phone\n   Website: $url\n   Reason: $reason\n\nMessage:\n   $message\n\n\n--------------------------\nOther Data and Information:\n   IP Address: $ip\n   Time Stamp: $ltd\n   Referrer: $hr\n   Host: $hst\n   User Agent: $ua\n   Resolve IP Whois: http://www.arin.net/whois/\n   Secure and Accessible PHP Contact Form $form_version\n   Created by Mike Cherim - http://green-beast.com/ and Mike Jolley - http://www.blue-anvil.com/\n\n";
     $gb_ccmail = "Hello $gbname,\n\nThis is a copy of the email you sent to $gb_website_name. If appropriate to your message, you should receive a response quickly. You successfully sent the following information:\n\n   Email: $email $cc_notify3\n   Phone: $phone\n   Website: $url\n   Reason: $reason\n\nMessage:\n   $message\n\n\n--------------------------\nOther Data and Information:\n   Time Stamp: $ltd\n   Secure and Accessible PHP Contact Form $form_version\n   Created by Mike Cherim - http://green-beast.com/ and Mike Jolley - http://www.blue-anvil.com/\n\n";

// Remove tags and slashes from content-including header then trim it again
     $gb_content = stripslashes(strip_tags(trim($gb_content)));
     $gb_ccmail = stripslashes(strip_tags(trim($gb_ccmail)));

// The mail function helps, let's send this stuff
     mail("$gb_email_address", "[$gb_website_name] Contact from $gbname", $gb_content, $gb_email_header);

if($gb_cc !== "") {
     mail("$gb_cc", "[Copy] Email sent to $gb_website_name", $gb_ccmail, $gb_email_header);
}

// And let's inform the user and show them what they sent
     $forms.=('   <h'.$gb_heading.' class="formhead" id="results">Results: <span class="success">'.$success_heading.'</span> <small>[ <a href="'.$hr.'">Reset Form</a> ]</small></h'.$gb_heading.'>
    <p><span class="success">Message Sent:</span> You have successfully sent a message to '.$me_or_us.', '.$gbname.'. If appropriate to your message, '.$i_or_we.' will get back to you shortly. You submitted the following information:</p> 
     <ul>
      <li><span class="items">Name:</span> '.$gbname.'</li>
      <li><span class="items">Email:</span> <a href="mailto:'.$email.'">'.$email.'</a> '.$cc_notify1.'</li>
      <li><span class="items">Phone:</span> '.$phone.'</li>
      <li><span class="items">Website:</span> <a href="'.$url.'">'.$url.'</a></li>
      <li><span class="items">Reason:</span> '.$reason.'</li>
     </ul>
    <dl id="result_dl_blockq">
      <dt>Message:</dt>
       <dd>
        <blockquote cite="'.$form_location.'">
         <p>'.$message.'</p>
         <p><cite>&#8212;'.$gbname.'</cite></p>
        </blockquote>
       </dd>
     </dl>
     <dl>
      <dt><small>Time Stamp:</small></dt>
       <dd><small>Form Submitted: '.$ltd.'</small></dd>
       <dd><small><em>Secure and Accessible PHP Contact Form '.$form_version.'<br />Created by <a href="http://green-beast.com/">Mike Cherim</a> &amp; <a href="http://www.blue-anvil.com/">Mike Jolley</a></em></small></dd>
     </dl>'."\n");
  }
 }
} else { 
// No errors so far? No successes so far? No confirmation? Hmm. Maybe the user needs a contact form
 if ($options->showformhead=='yes'){
     $forms.=('  <h'.$gb_heading.' class="main_formhead">'.$gb_website_name.' Contact Form</h'.$gb_heading.'>'."\n"); 
 }
     $forms.=('  <form id="gb_form" method="post" action="'.$_SERVER['REQUEST_URI'].'#results">
<!-- Form Intro -->
      ');

if($showprivacy == "yes") {
    $forms.=('   <small class="privacy">[&nbsp;<a tabindex="'.$tab_privacy.'" href="'.$privacyurl.'" title="Review '.$my_or_our.' privacy policy">Privacy</a>&nbsp;]</small></legend>'); 
} else {
    $forms.=('</legend>');
}
$forms.=('
<!-- Required Info -->
      <fieldset>
       <legend>Required contact info:</legend>
        <label for="name">Enter your full name'.$x_or_h_br.'<input tabindex="'.$tab_name.'" class="med" type="text" name="gbname" id="name" size="35" maxlength="40" value=""'.$x_or_h_in.'></label>'.$x_or_h_br.' 
        <label for="email">Enter your email address'.$x_or_h_br.'<input tabindex="'.$tab_email.'" class="med" type="text" name="email" id="email" size="35" maxlength="40" value=""'.$x_or_h_in.'></label>
      </fieldset>
<!-- Optional Info -->
      <fieldset>
       <legend>Optional contact info:</legend>
        <label for="phone">Enter your phone number'.$x_or_h_br.'<input tabindex="'.$tab_phone.'" class="med" type="text" name="phone" id="phone" size="35" maxlength="30" value=""'.$x_or_h_in.'></label>'.$x_or_h_br.' 
        <label for="url">Enter your website address'.$x_or_h_br.'<input tabindex="'.$tab_url.'" class="med" type="text" name="url" id="url" size="35" maxlength="60" value="http://"'.$x_or_h_in.'></label>
      </fieldset>
<!-- Required Reasons -->
      <fieldset>
       <legend>Required contact reason:</legend>
        <label for="reason">Select a contact reason'.$x_or_h_br.' 
         <select tabindex="'.$tab_reason.'" class="med" style="cursor:pointer;" name="reason" id="reason">
          <option value="" selected="selected">Please make a selection</option>'."\n"); 
reset($gb_options);
while (list(, $gb_opts) = each($gb_options)) {	
	$gb_opts = str_replace('"', "", "$gb_opts");
    $forms.=('          <option value="'.$gb_opts.'">'.$gb_opts.'</option>'."\n"); 
} 
    $forms.=('         </select>
        </label>
       </fieldset>
<!-- Required Form Comments Area -->
      <fieldset>
       <legend>Required comments area:</legend>
        <label for="message">Enter your message'.$x_or_h_br.'<textarea tabindex="'.$tab_message.'" class="textbox" rows="12" cols="60" name="message" id="message"></textarea></label>
      </fieldset>
<!-- Required anti spam confirmation -->
      <fieldset>
       <legend>Required anti-spam question:</legend>
        <label title="No worries, the text entered here is case-insensitive" for="spamq">'.$gb_randomq.' <input tabindex="'.$tab_spam.'" class="short" type="text" name="spamq" id="spamq" size="15" maxlength="30" value=""'.$x_or_h_in.'> <small class="whythis" title="This confirms you\'re a human user!">- <a tabindex="'.$tab_why.'" href="#spamq" style="cursor:help;">Why ask? <span>This confirms you&#8217;re a human user!</span></a></small></label>'.$x_or_h_br.' 
<!-- Special anti-spam input: hidden type -->
        <input type="hidden" name="GB'.$trap1_value.'" id="GB'.$trap1_value.'" alt="Cherim-Hartmann Anti-Spam Trap One" value=""'.$x_or_h_in.'>
<!-- Special anti-spam input: non-displayed type -->
       <div style="position:absolute; top: -9000px; left:-9000px;">'.$x_or_h_br.' 
        <label for="p-mail"><small><strong>Note:</strong> The input below should <em>not</em> be filled in. It is a spam trap. Please ignore it. If you populate this input, the form will return an error.</small>'.$x_or_h_br.' 
        <input type="text" name="p-mail" id="p-mail" alt="Cherim-Hartmann Anti-Spam Trap Two" value=""'.$x_or_h_in.'>
        </label>
       </div>
<!-- Special anti-spam form id field -->
        <input type="hidden" name="GB'.$form_id.'" id="GB'.$form_id.'" alt="Form ID Field" value="GB'.$form_id.'"'.$x_or_h_in.'>
      </fieldset>
<!-- Form Buttons -->
      <fieldset>
       <legend>Time to send it to '.$me_or_us.':</legend>'."\n");
if(@$gb_show_cc == "yes") {
    $forms.=('         <label for="gbcc"><input tabindex="'.$tab_cc.'" class="checkbox" type="checkbox" name="gbcc" id="gbcc" value="gbcc" /> <small>Check this box if you want a carbon copy of this email.</small></label>'.$x_or_h_br.''."\n"); 
} else {
    $forms.=(''."\n");
}
    $forms.=('         <input tabindex="'.$tab_submit.'" style="cursor:pointer;" class="button" type="submit" alt="Click Button to '.$send_button.'" value="'.$send_button.'" name="'.$send_value.'" id="'.$send_value.'" title="Click Button to Submit Form"'.$x_or_h_in.'>'."\n"); 
if(@$showcredit == "yes") {
    $forms.=('          <p class="creditline"><small>Secure and Accessible <abbr><span class="abbr" title="PHP Hypertext Preprocessor">PHP</span></abbr> Contact Form <span title="'.$build.'">'.$form_version.'</span> by <a href="http://green-beast.com/" title="Green-Beast.com">Mike Cherim</a> &amp; <a href="http://www.blue-anvil.com/" title="Blue-Anvil.com">Mike Jolley</a>.</small></p>'."\n"); 
} else {
    $forms.=('          <p style="position:absolute; top: -9000px; left:-9000px;"><small>Secure and Accessible <abbr><span class="abbr" title="PHP Hypertext Preprocessor">PHP</span></abbr> Contact Form <span title="'.$build.'">'.$form_version.'</span> by <a href="http://green-beast.com/" title="Green-Beast.com">Mike Cherim</a> &amp; <a href="http://www.blue-anvil.com/" title="Blue-Anvil.com">Mike Jolley</a>.</small></p>'."\n");
}
    $forms.=('      </fieldset>
    </fieldset>
  </form>'."\n");
}
    $forms.=('  </div><!-- END: Secure and Accessible PHP Contact Form '.$form_version.' by Mike Cherim (http://green-beast.com/) and Mike Jolley (http://www.blue-anvil.com/) -->'."\n\n");
// if(strstr ($content, "<!--gb_contact_form-->" )) { 
    $content = str_replace("<p><!--gb_contact_form--></p>", "<!--gb_contact_form-->", "$content $forms");  
//  IF YOU WANT CONTENT BELOW YOUR FORM INSTEAD OF BEFORE THE FORM, 
//  COMMENT OUT THE $content LINE ABOVE WITH 2 FORWARD SLASHES AND UNCOMMENT THE LINE BELOW
//  $content = str_replace("<p><!--gb_contact_form--></p>", "<!--gb_contact_form-->", "$forms $content");  
}
return $content;
}
function inc_spam_count(){
    $count=get_option('spamCount');
    $count++;
update_option('spamCount',$count);
}
// That's it folks. Man this is a big script
?>