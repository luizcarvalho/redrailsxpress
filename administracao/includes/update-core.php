<?php
/**
 * WordPress core upgrade functionality.
 *
 * @package WordPress
 * @subpackage Administration
 * @since 2.7.0
 */

/**
 * Stores files to be deleted.
 *
 * @since 2.7.0
 * @global array $_old_files
 * @var array
 * @name $_old_files
 */
global $_old_files;

$_old_files = array(
'administracao/bookmarklet.php',
'administracao/css/upload.css',
'administracao/css/upload-rtl.css',
'administracao/css/press-this-ie.css',
'administracao/css/press-this-ie-rtl.css',
'administracao/edit-form.php',
'administracao/link-import.php',
'administracao/images/box-bg-left.gif',
'administracao/images/box-bg-right.gif',
'administracao/images/box-bg.gif',
'administracao/images/box-butt-left.gif',
'administracao/images/box-butt-right.gif',
'administracao/images/box-butt.gif',
'administracao/images/box-head-left.gif',
'administracao/images/box-head-right.gif',
'administracao/images/box-head.gif',
'administracao/images/heading-bg.gif',
'administracao/images/login-bkg-bottom.gif',
'administracao/images/login-bkg-tile.gif',
'administracao/images/notice.gif',
'administracao/images/toggle.gif',
'administracao/images/comment-stalk-classic.gif',
'administracao/images/comment-stalk-fresh.gif',
'administracao/images/comment-stalk-rtl.gif',
'administracao/images/comment-pill.gif',
'administracao/images/del.png',
'administracao/images/media-button-gallery.gif',
'administracao/images/media-buttons.gif',
'administracao/images/tail.gif',
'administracao/images/gear.png',
'administracao/images/tab.png',
'administracao/images/postbox-bg.gif',
'administracao/includes/upload.php',
'administracao/js/dbx-admin-key.js',
'administracao/js/link-cat.js',
'administracao/js/forms.js',
'administracao/js/upload.js',
'administracao/js/set-post-thumbnail-handler.js',
'administracao/js/set-post-thumbnail-handler.dev.js',
'administracao/js/page.js',
'administracao/js/page.dev.js',
'administracao/js/slug.js',
'administracao/js/slug.dev.js',
'administracao/profile-update.php',
'administracao/templates.php',
'wp-includes/images/audio.png',
'wp-includes/images/css.png',
'wp-includes/images/default.png',
'wp-includes/images/doc.png',
'wp-includes/images/exe.png',
'wp-includes/images/html.png',
'wp-includes/images/js.png',
'wp-includes/images/pdf.png',
'wp-includes/images/swf.png',
'wp-includes/images/tar.png',
'wp-includes/images/text.png',
'wp-includes/images/video.png',
'wp-includes/images/zip.png',
'wp-includes/js/dbx.js',
'wp-includes/js/fat.js',
'wp-includes/js/list-manipulation.js',
'wp-includes/js/jquery/jquery.dimensions.min.js',
'wp-includes/js/tinymce/langs/en.js',
'wp-includes/js/tinymce/plugins/autosave/editor_plugin_src.js',
'wp-includes/js/tinymce/plugins/autosave/langs',
'wp-includes/js/tinymce/plugins/directionality/images',
'wp-includes/js/tinymce/plugins/directionality/langs',
'wp-includes/js/tinymce/plugins/inlinepopups/css',
'wp-includes/js/tinymce/plugins/inlinepopups/images',
'wp-includes/js/tinymce/plugins/inlinepopups/jscripts',
'wp-includes/js/tinymce/plugins/paste/images',
'wp-includes/js/tinymce/plugins/paste/jscripts',
'wp-includes/js/tinymce/plugins/paste/langs',
'wp-includes/js/tinymce/plugins/spellchecker/classes/HttpClient.class.php',
'wp-includes/js/tinymce/plugins/spellchecker/classes/TinyGoogleSpell.class.php',
'wp-includes/js/tinymce/plugins/spellchecker/classes/TinyPspell.class.php',
'wp-includes/js/tinymce/plugins/spellchecker/classes/TinyPspellShell.class.php',
'wp-includes/js/tinymce/plugins/spellchecker/css/spellchecker.css',
'wp-includes/js/tinymce/plugins/spellchecker/images',
'wp-includes/js/tinymce/plugins/spellchecker/langs',
'wp-includes/js/tinymce/plugins/spellchecker/tinyspell.php',
'wp-includes/js/tinymce/plugins/wordpress/images',
'wp-includes/js/tinymce/plugins/wordpress/langs',
'wp-includes/js/tinymce/plugins/wordpress/popups.css',
'wp-includes/js/tinymce/plugins/wordpress/wordpress.css',
'wp-includes/js/tinymce/plugins/wphelp',
'wp-includes/js/tinymce/themes/advanced/css',
'wp-includes/js/tinymce/themes/advanced/images',
'wp-includes/js/tinymce/themes/advanced/jscripts',
'wp-includes/js/tinymce/themes/advanced/langs',
'wp-includes/js/tinymce/tiny_mce_gzip.php',
'wp-includes/js/wp-ajax.js',
'administracao/admin-db.php',
'administracao/cat.js',
'administracao/categories.js',
'administracao/custom-fields.js',
'administracao/dbx-admin-key.js',
'administracao/edit-comments.js',
'administracao/install-rtl.css',
'administracao/install.css',
'administracao/upgrade-schema.php',
'administracao/upload-functions.php',
'administracao/upload-rtl.css',
'administracao/upload.css',
'administracao/upload.js',
'administracao/users.js',
'administracao/widgets-rtl.css',
'administracao/widgets.css',
'administracao/xfn.js',
'wp-includes/js/tinymce/license.html',
'administracao/cat-js.php',
'administracao/edit-form-ajax-cat.php',
'administracao/execute-pings.php',
'administracao/import/b2.php',
'administracao/import/btt.php',
'administracao/import/jkw.php',
'administracao/inline-uploading.php',
'administracao/link-categories.php',
'administracao/list-manipulation.js',
'administracao/list-manipulation.php',
'wp-includes/comment-functions.php',
'wp-includes/feed-functions.php',
'wp-includes/functions-compat.php',
'wp-includes/functions-formatting.php',
'wp-includes/functions-post.php',
'wp-includes/js/dbx-key.js',
'wp-includes/js/tinymce/plugins/autosave/langs/cs.js',
'wp-includes/js/tinymce/plugins/autosave/langs/sv.js',
'wp-includes/js/tinymce/themes/advanced/editor_template_src.js',
'wp-includes/links.php',
'wp-includes/pluggable-functions.php',
'wp-includes/template-functions-author.php',
'wp-includes/template-functions-category.php',
'wp-includes/template-functions-general.php',
'wp-includes/template-functions-links.php',
'wp-includes/template-functions-post.php',
'wp-includes/wp-l10n.php',
'administracao/import-b2.php',
'administracao/import-blogger.php',
'administracao/import-greymatter.php',
'administracao/import-livejournal.php',
'administracao/import-mt.php',
'administracao/import-rss.php',
'administracao/import-textpattern.php',
'administracao/quicktags.js',
'wp-images/fade-butt.png',
'wp-images/get-firefox.png',
'wp-images/header-shadow.png',
'wp-images/smilies',
'wp-images/wp-small.png',
'wp-images/wpminilogo.png',
'wp.php',
'wp-includes/gettext.php',
'wp-includes/streams.php',
// MU
'administracao/wpmu-admin.php',
'administracao/wpmu-blogs.php',
'administracao/wpmu-edit.php',
'administracao/wpmu-options.php',
'administracao/wpmu-themes.php',
'administracao/wpmu-upgrade-site.php',
'administracao/wpmu-users.php',
'wp-includes/wpmu-default-filters.php',
'wp-includes/wpmu-functions.php',
'wpmu-settings.php',
'index-install.php',
'README.txt',
'htaccess.dist',
'administracao/css/mu-rtl.css',
'administracao/css/mu.css',
'administracao/images/site-admin.png',
'administracao/includes/mu.php',
'wp-includes/images/wordpress-mu.png',
// 3.0
'administracao/categories.php',
'administracao/edit-category-form.php',
'administracao/edit-page-form.php',
'administracao/edit-pages.php',
'administracao/images/wp-logo.gif',
'administracao/js/wp-gears.dev.js',
'administracao/js/wp-gears.js',
'administracao/options-misc.php',
'administracao/page-new.php',
'administracao/page.php',
'administracao/rtl.css',
'administracao/rtl.dev.css',
'administracao/update-links.php',
'administracao/administracao.css',
'administracao/administracao.dev.css',
'wp-includes/js/codepress',
'wp-includes/js/jquery/autocomplete.dev.js',
'wp-includes/js/jquery/interface.js',
'wp-includes/js/jquery/autocomplete.js',
'wp-includes/js/scriptaculous/prototype.js',
'wp-includes/js/tinymce/wp-tinymce.js',
'administracao/import',
'administracao/images/ico-edit.png',
'administracao/images/fav-top.png',
'administracao/images/ico-close.png',
'administracao/images/admin-header-footer.png',
'administracao/images/screen-options-left.gif',
'administracao/images/ico-add.png',
'administracao/images/browse-happy.gif',
'administracao/images/ico-viewpage.png',
// 3.1
'wp-includes/js/tinymce/blank.htm',
'wp-includes/js/tinymce/plugins/safari',
'administracao/edit-link-categories.php',
'administracao/edit-post-rows.php',
'administracao/edit-attachment-rows.php',
'administracao/link-category.php',
'administracao/edit-link-category-form.php',
'administracao/sidebar.php',
'administracao/images/list-vs.png',
'administracao/images/button-grad-vs.png',
'administracao/images/button-grad-active-vs.png',
'administracao/images/fav-arrow-vs.gif',
'administracao/images/fav-arrow-vs-rtl.gif',
'administracao/images/fav-top-vs.gif',
'administracao/images/screen-options-right.gif',
'administracao/images/screen-options-right-up.gif',
'administracao/images/visit-site-button-grad-vs.gif',
'administracao/images/visit-site-button-grad.gif',
'wp-includes/classes.php',
// 3.2
'wp-includes/default-embeds.php',
'wp-includes/js/tinymce/plugins/wordpress/img/more.gif',
'wp-includes/js/tinymce/plugins/wordpress/img/toolbars.gif',
'wp-includes/js/tinymce/plugins/wordpress/img/help.gif',
'wp-includes/js/tinymce/themes/advanced/img/fm.gif',
'wp-includes/js/tinymce/themes/advanced/img/sflogo.png',
'administracao/js/list-table.js',
'administracao/js/list-table.dev.js',
'administracao/images/logo-login.gif',
'administracao/images/star.gif',
// 3.3
'administracao/css/colors-classic-rtl.css',
'administracao/css/colors-classic-rtl.dev.css',
'administracao/css/colors-fresh-rtl.css',
'administracao/css/colors-fresh-rtl.dev.css',
'administracao/css/dashboard-rtl.css',
'administracao/css/dashboard-rtl.dev.css',
'administracao/css/dashboard.css',
'administracao/css/dashboard.dev.css',
'administracao/css/farbtastic-rtl.css',
'administracao/css/global-rtl.css',
'administracao/css/global-rtl.dev.css',
'administracao/css/global.css',
'administracao/css/global.dev.css',
'administracao/css/install-rtl.css',
'administracao/css/install-rtl.dev.css',
'administracao/css/login-rtl.css',
'administracao/css/login-rtl.dev.css',
'administracao/css/login.css',
'administracao/css/login.dev.css',
'administracao/css/ms.css',
'administracao/css/ms.dev.css',
'administracao/css/nav-menu-rtl.css',
'administracao/css/nav-menu-rtl.dev.css',
'administracao/css/nav-menu.css',
'administracao/css/nav-menu.dev.css',
'administracao/css/plugin-install-rtl.css',
'administracao/css/plugin-install-rtl.dev.css',
'administracao/css/plugin-install.css',
'administracao/css/plugin-install.dev.css',
'administracao/css/press-this-rtl.css',
'administracao/css/press-this-rtl.dev.css',
'administracao/css/press-this.css',
'administracao/css/press-this.dev.css',
'administracao/css/theme-editor-rtl.css',
'administracao/css/theme-editor-rtl.dev.css',
'administracao/css/theme-editor.css',
'administracao/css/theme-editor.dev.css',
'administracao/css/theme-install-rtl.css',
'administracao/css/theme-install-rtl.dev.css',
'administracao/css/theme-install.css',
'administracao/css/theme-install.dev.css',
'administracao/css/widgets-rtl.css',
'administracao/css/widgets-rtl.dev.css',
'administracao/css/widgets.css',
'administracao/css/widgets.dev.css',
'administracao/includes/internal-linking.php',
'wp-includes/images/admin-bar-sprite-rtl.png',
'wp-includes/js/jquery/ui.button.js',
'wp-includes/js/jquery/ui.core.js',
'wp-includes/js/jquery/ui.dialog.js',
'wp-includes/js/jquery/ui.draggable.js',
'wp-includes/js/jquery/ui.droppable.js',
'wp-includes/js/jquery/ui.mouse.js',
'wp-includes/js/jquery/ui.position.js',
'wp-includes/js/jquery/ui.resizable.js',
'wp-includes/js/jquery/ui.selectable.js',
'wp-includes/js/jquery/ui.sortable.js',
'wp-includes/js/jquery/ui.tabs.js',
'wp-includes/js/jquery/ui.widget.js',
'wp-includes/js/l10n.dev.js',
'wp-includes/js/l10n.js',
'wp-includes/js/tinymce/plugins/wplink/css',
'wp-includes/js/tinymce/plugins/wplink/img',
'wp-includes/js/tinymce/plugins/wplink/js',
'wp-includes/js/tinymce/themes/advanced/img/wpicons.png',
'wp-includes/js/tinymce/themes/advanced/skins/wp_theme/img/butt2.png',
'wp-includes/js/tinymce/themes/advanced/skins/wp_theme/img/button_bg.png',
'wp-includes/js/tinymce/themes/advanced/skins/wp_theme/img/down_arrow.gif',
'wp-includes/js/tinymce/themes/advanced/skins/wp_theme/img/fade-butt.png',
'wp-includes/js/tinymce/themes/advanced/skins/wp_theme/img/separator.gif',
);

/**
 * Stores new files in wp-content to copy
 *
 * The contents of this array indicate any new bundled plugins/themes which
 * should be installed with the WordPress Upgrade. These items will not be
 * re-installed in future upgrades, this behaviour is controlled by the
 * introduced version present here being older than the current installed version.
 *
 * The content of this array should follow the following format:
 *  Filename (relative to wp-content) => Introduced version
 * Directories should be noted by suffixing it with a trailing slash (/)
 *
 * @since 3.2.0
 * @global array $_new_bundled_files
 * @var array
 * @name $_new_bundled_files
 */
global $_new_bundled_files;

$_new_bundled_files = array(
'plugins/akismet/' => '2.0',
'themes/twentyten/' => '3.0',
'themes/twentyeleven/' => '3.2'
);

/**
 * Upgrade the core of WordPress.
 *
 * This will create a .maintenance file at the base of the WordPress directory
 * to ensure that people can not access the web site, when the files are being
 * copied to their locations.
 *
 * The files in the {@link $_old_files} list will be removed and the new files
 * copied from the zip file after the database is upgraded.
 *
 * The files in the {@link $_new_bundled_files} list will be added to the installation
 * if the version is greater than or equal to the old version being upgraded.
 *
 * The steps for the upgrader for after the new release is downloaded and
 * unzipped is:
 *   1. Test unzipped location for select files to ensure that unzipped worked.
 *   2. Create the .maintenance file in current WordPress base.
 *   3. Copy new WordPress directory over old WordPress files.
 *   4. Upgrade WordPress to new version.
 *     4.1. Copy all files/folders other than wp-content
 *     4.2. Copy any language files to WP_LANG_DIR (which may differ from WP_CONTENT_DIR
 *     4.3. Copy any new bundled themes/plugins to their respective locations
 *   5. Delete new WordPress directory path.
 *   6. Delete .maintenance file.
 *   7. Remove old files.
 *   8. Delete 'update_core' option.
 *
 * There are several areas of failure. For instance if PHP times out before step
 * 6, then you will not be able to access any portion of your site. Also, since
 * the upgrade will not continue where it left off, you will not be able to
 * automatically remove old files and remove the 'update_core' option. This
 * isn't that bad.
 *
 * If the copy of the new WordPress over the old fails, then the worse is that
 * the new WordPress directory will remain.
 *
 * If it is assumed that every file will be copied over, including plugins and
 * themes, then if you edit the default theme, you should rename it, so that
 * your changes remain.
 *
 * @since 2.7.0
 *
 * @param string $from New release unzipped path.
 * @param string $to Path to old WordPress installation.
 * @return WP_Error|null WP_Error on failure, null on success.
 */
function update_core($from, $to) {
	global $wp_filesystem, $_old_files, $_new_bundled_files, $wpdb;

	@set_time_limit( 300 );

	$php_version    = phpversion();
	$mysql_version  = $wpdb->db_version();
	$required_php_version = '5.2.4';
	$required_mysql_version = '5.0';
	$wp_version = '3.3';
	$php_compat     = version_compare( $php_version, $required_php_version, '>=' );
	if ( file_exists( WP_CONTENT_DIR . '/db.php' ) && empty( $wpdb->is_mysql ) )
		$mysql_compat = true;
	else
		$mysql_compat = version_compare( $mysql_version, $required_mysql_version, '>=' );

	if ( !$mysql_compat || !$php_compat )
		$wp_filesystem->delete($from, true);

	if ( !$mysql_compat && !$php_compat )
		return new WP_Error( 'php_mysql_not_compatible', sprintf( __('The update cannot be installed because WordPress %1$s requires PHP version %2$s or higher and MySQL version %3$s or higher. You are running PHP version %4$s and MySQL version %5$s.'), $wp_version, $required_php_version, $required_mysql_version, $php_version, $mysql_version ) );
	elseif ( !$php_compat )
		return new WP_Error( 'php_not_compatible', sprintf( __('The update cannot be installed because WordPress %1$s requires PHP version %2$s or higher. You are running version %3$s.'), $wp_version, $required_php_version, $php_version ) );
	elseif ( !$mysql_compat )
		return new WP_Error( 'mysql_not_compatible', sprintf( __('The update cannot be installed because WordPress %1$s requires MySQL version %2$s or higher. You are running version %3$s.'), $wp_version, $required_mysql_version, $mysql_version ) );

	// Sanity check the unzipped distribution
	apply_filters('update_feedback', __('Verifying the unpacked files&#8230;'));
	$distro = '';
	$roots = array( '/wordpress/', '/wordpress-mu/' );
	foreach( $roots as $root ) {
		if ( $wp_filesystem->exists($from . $root . 'readme.html') && $wp_filesystem->exists($from . $root . 'wp-includes/version.php') ) {
			$distro = $root;
			break;
		}
	}
	if ( !$distro ) {
		$wp_filesystem->delete($from, true);
		return new WP_Error('insane_distro', __('The update could not be unpacked') );
	}

	apply_filters('update_feedback', __('Installing the latest version&#8230;'));

	// Create maintenance file to signal that we are upgrading
	$maintenance_string = '<?php $upgrading = ' . time() . '; ?>';
	$maintenance_file = $to . '.maintenance';
	$wp_filesystem->delete($maintenance_file);
	$wp_filesystem->put_contents($maintenance_file, $maintenance_string, FS_CHMOD_FILE);

	// Copy new versions of WP files into place.
	$result = _copy_dir($from . $distro, $to, array('wp-content') );

	// Custom Content Directory needs updating now.
	// Copy Languages
	if ( !is_wp_error($result) && $wp_filesystem->is_dir($from . $distro . 'wp-content/languages') ) {
		if ( WP_LANG_DIR != ABSPATH . WPINC . '/languages' || @is_dir(WP_LANG_DIR) )
			$lang_dir = WP_LANG_DIR;
		else
			$lang_dir = WP_CONTENT_DIR . '/languages';

		if ( !@is_dir($lang_dir) && 0 === strpos($lang_dir, ABSPATH) ) { // Check the language directory exists first
			$wp_filesystem->mkdir($to . str_replace(ABSPATH, '', $lang_dir), FS_CHMOD_DIR); // If it's within the ABSPATH we can handle it here, otherwise they're out of luck.
			clearstatcache(); // for FTP, Need to clear the stat cache
		}

		if ( @is_dir($lang_dir) ) {
			$wp_lang_dir = $wp_filesystem->find_folder($lang_dir);
			if ( $wp_lang_dir )
				$result = copy_dir($from . $distro . 'wp-content/languages/', $wp_lang_dir);
		}
	}

	// Copy New bundled plugins & themes
	// This gives us the ability to install new plugins & themes bundled with future versions of WordPress whilst avoiding the re-install upon upgrade issue.
	if ( !is_wp_error($result) && ( ! defined('CORE_UPGRADE_SKIP_NEW_BUNDLED') || ! CORE_UPGRADE_SKIP_NEW_BUNDLED ) ) {
		$old_version = $GLOBALS['wp_version']; // $wp_version in local scope == new version
		foreach ( (array) $_new_bundled_files as $file => $introduced_version ) {
			// If $introduced version is greater than what the site was previously running
			if ( version_compare($introduced_version, $old_version, '>') ) {
				$directory = ('/' == $file[ strlen($file)-1 ]);
				list($type, $filename) = explode('/', $file, 2);

				if ( 'plugins' == $type )
					$dest = $wp_filesystem->wp_plugins_dir();
				elseif ( 'themes' == $type )
					$dest = trailingslashit($wp_filesystem->wp_themes_dir()); // Back-compat, ::wp_themes_dir() did not return trailingslash'd pre-3.2
				else
					continue;

				if ( ! $directory ) {
					if ( $wp_filesystem->exists($dest . $filename) )
						continue;

					if ( ! $wp_filesystem->copy($from . $distro . 'wp-content/' . $file, $dest . $filename, FS_CHMOD_FILE) )
						$result = new WP_Error('copy_failed', __('Could not copy file.'), $dest . $filename);
				} else {
					if ( $wp_filesystem->is_dir($dest . $filename) )
						continue;

					$wp_filesystem->mkdir($dest . $filename, FS_CHMOD_DIR);
					$_result = copy_dir( $from . $distro . 'wp-content/' . $file, $dest . $filename);
					if ( is_wp_error($_result) ) //If a error occurs partway through this final step, keep the error flowing through, but keep process going.
						$result = $_result;
				}
			}
		} //end foreach
	}

	// Handle $result error from the above blocks
	if ( is_wp_error($result) ) {
		$wp_filesystem->delete($maintenance_file);
		$wp_filesystem->delete($from, true);
		return $result;
	}

	// Remove old files
	foreach ( $_old_files as $old_file ) {
		$old_file = $to . $old_file;
		if ( !$wp_filesystem->exists($old_file) )
			continue;
		$wp_filesystem->delete($old_file, true);
	}

	// Upgrade DB with separate request
	apply_filters('update_feedback', __('Upgrading database&#8230;'));
	$db_upgrade_url = admin_url('upgrade.php?step=upgrade_db');
	wp_remote_post($db_upgrade_url, array('timeout' => 60));

	// Remove working directory
	$wp_filesystem->delete($from, true);

	// Force refresh of update information
	if ( function_exists('delete_site_transient') )
		delete_site_transient('update_core');
	else
		delete_option('update_core');

	// Remove maintenance file, we're done.
	$wp_filesystem->delete($maintenance_file);

	// If we made it this far:
	do_action( '_core_updated_successfully', $wp_version );

	return $wp_version;
}

/**
 * Copies a directory from one location to another via the WordPress Filesystem Abstraction.
 * Assumes that WP_Filesystem() has already been called and setup.
 *
 * This is a temporary function for the 3.1 -> 3.2 upgrade only and will be removed in 3.3
 *
 * @ignore
 * @since 3.2.0
 * @see copy_dir()
 *
 * @param string $from source directory
 * @param string $to destination directory
 * @param array $skip_list a list of files/folders to skip copying
 * @return mixed WP_Error on failure, True on success.
 */
function _copy_dir($from, $to, $skip_list = array() ) {
	global $wp_filesystem;

	$dirlist = $wp_filesystem->dirlist($from);

	$from = trailingslashit($from);
	$to = trailingslashit($to);

	$skip_regex = '';
	foreach ( (array)$skip_list as $key => $skip_file )
		$skip_regex .= preg_quote($skip_file, '!') . '|';

	if ( !empty($skip_regex) )
		$skip_regex = '!(' . rtrim($skip_regex, '|') . ')$!i';

	foreach ( (array) $dirlist as $filename => $fileinfo ) {
		if ( !empty($skip_regex) )
			if ( preg_match($skip_regex, $from . $filename) )
				continue;

		if ( 'f' == $fileinfo['type'] ) {
			if ( ! $wp_filesystem->copy($from . $filename, $to . $filename, true, FS_CHMOD_FILE) ) {
				// If copy failed, chmod file to 0644 and try again.
				$wp_filesystem->chmod($to . $filename, 0644);
				if ( ! $wp_filesystem->copy($from . $filename, $to . $filename, true, FS_CHMOD_FILE) )
					return new WP_Error('copy_failed', __('Could not copy file.'), $to . $filename);
			}
		} elseif ( 'd' == $fileinfo['type'] ) {
			if ( !$wp_filesystem->is_dir($to . $filename) ) {
				if ( !$wp_filesystem->mkdir($to . $filename, FS_CHMOD_DIR) )
					return new WP_Error('mkdir_failed', __('Could not create directory.'), $to . $filename);
			}
			$result = _copy_dir($from . $filename, $to . $filename, $skip_list);
			if ( is_wp_error($result) )
				return $result;
		}
	}
	return true;
}

/**
 * Redirect to the About WordPress page after a successful upgrade.
 *
 * This function is only needed when the existing install is older than 3.3.0.
 *
 * @since 3.3.0
 *
 */
function _redirect_to_about_wordpress( $new_version ) {
	global $wp_version, $pagenow, $action;

	if ( version_compare( $wp_version, '3.3', '>=' ) )
		return;

	// Ensure we only run this on the update-core.php page. wp_update_core() could be called in other contexts.
	if ( 'update-core.php' != $pagenow )
		return;

 	if ( 'do-core-upgrade' != $action && 'do-core-reinstall' != $action )
 		return;

	// Load the updated default text localization domain for new strings
	load_default_textdomain();

	// See do_core_upgrade()
	show_message( __('WordPress updated successfully') );
	show_message( '<span class="hide-if-no-js">' . sprintf( __( 'Welcome to WordPress %1$s. You will be redirected to the About WordPress screen. If not, click <a href="%s">here</a>.' ), $new_version, esc_url( admin_url( 'about.php?updated' ) ) ) . '</span>' );
	show_message( '<span class="hide-if-js">' . sprintf( __( 'Welcome to WordPress %1$s. <a href="%2$s">Learn more</a>.' ), $new_version, esc_url( admin_url( 'about.php?updated' ) ) ) . '</span>' );
	echo '</div>';
	?>
<script type="text/javascript">
window.location = '<?php echo admin_url( 'about.php?updated' ); ?>';
</script>
	<?php

	// Include admin-footer.php and exit
	include(ABSPATH . 'administracao/admin-footer.php');
	exit();
}
add_action( '_core_updated_successfully', '_redirect_to_about_wordpress' );
