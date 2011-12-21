<?php
/**
 * Includes all of the WordPress Administration API files.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Bookmark Administration API */
require_once(ABSPATH . 'administracao/includes/bookmark.php');

/** WordPress Comment Administration API */
require_once(ABSPATH . 'administracao/includes/comment.php');

/** WordPress Administration File API */
require_once(ABSPATH . 'administracao/includes/file.php');

/** WordPress Image Administration API */
require_once(ABSPATH . 'administracao/includes/image.php');

/** WordPress Media Administration API */
require_once(ABSPATH . 'administracao/includes/media.php');

/** WordPress Import Administration API */
require_once(ABSPATH . 'administracao/includes/import.php');

/** WordPress Misc Administration API */
require_once(ABSPATH . 'administracao/includes/misc.php');

/** WordPress Plugin Administration API */
require_once(ABSPATH . 'administracao/includes/plugin.php');

/** WordPress Post Administration API */
require_once(ABSPATH . 'administracao/includes/post.php');

/** WordPress Administration Screen API */
require_once(ABSPATH . 'administracao/includes/screen.php');

/** WordPress Taxonomy Administration API */
require_once(ABSPATH . 'administracao/includes/taxonomy.php');

/** WordPress Template Administration API */
require_once(ABSPATH . 'administracao/includes/template.php');

/** WordPress List Table Administration API and base class */
require_once(ABSPATH . 'administracao/includes/class-wp-list-table.php');
require_once(ABSPATH . 'administracao/includes/list-table.php');

/** WordPress Theme Administration API */
require_once(ABSPATH . 'administracao/includes/theme.php');

/** WordPress User Administration API */
require_once(ABSPATH . 'administracao/includes/user.php');

/** WordPress Update Administration API */
require_once(ABSPATH . 'administracao/includes/update.php');

/** WordPress Deprecated Administration API */
require_once(ABSPATH . 'administracao/includes/deprecated.php');

/** WordPress Multisite support API */
if ( is_multisite() ) {
	require_once(ABSPATH . 'administracao/includes/ms.php');
	require_once(ABSPATH . 'administracao/includes/ms-deprecated.php');
}

?>
