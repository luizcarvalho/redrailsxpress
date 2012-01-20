<!--[if !IE]>user status<![endif]-->

<?php
  global $user_ID, $user_identity;
  get_currentuserinfo();
  if ($user_ID):
?>
<div id="user-panel">

<li> Logged in: <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><strong><?php echo $user_identity; ?></strong></a></li>
<li> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/index.php">Dashboard</a></li>
<li>  <a href="<?php echo get_option('siteurl'); ?>/wp-admin/post-new.php">Write</a></li>
<li> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/edit.php">Manage</a></li>
<li> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/edit-comments.php">Comments</a></li>
<li> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/themes.php">Presentation</a></li>
<li> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/plugins.php">Plugins</a></li>
<li> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/users.php">Users</a></li>
<li> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php">Options</a></li>
<li> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/themes.php?page=functions.php">Ikarus Options</a></li>
<li> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout"><font color="#CC6600">Logout</font></a></li>

</div>
<?php endif; ?>

<!--[if !IE]>end user status<![endif]-->