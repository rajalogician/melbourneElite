<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'melbourneelite' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'mysql' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'XRyGJAVoa5Aemrqu1Y8XYnb8qkOe6InhHoc5mUZep6Byzl0d8jxzLgt22m0QrkGs');
define('SECURE_AUTH_KEY',  'aMuBXfzVYS5YRKrGtKQc35dqRj2CPEVx6Gf3ivxJWVXn0BzE5NBdd8Yp7BvNjT9i');
define('LOGGED_IN_KEY',    'r5JuFWmfAwtldh6ALQrP7QPzRpSKUTwHaJd25hLZ4V8WElmdpLYJRYV8hUcjsDBG');
define('NONCE_KEY',        'lVlECAzv8VMC0r0dZUvQTMYUvurzy85dLk4U4KAlCNxOYIzFrWmsR9ya2cJQAD35');
define('AUTH_SALT',        'ST4Cu7Xyd9RkGUZ3dqSl4NsfZqPcIdo5IkwvpmHQdXE7qj0DTPJMUVUfjxbqvc5Z');
define('SECURE_AUTH_SALT', 'jUb179CPb1yMglW1Q5YOtyWRrcq5G6P50srFb9pa74HXZO5xGyW9fYHCOWr3FLDM');
define('LOGGED_IN_SALT',   'Tdpaku6Wk0Aw7W235bHtCk1AOs6k6TGy202cFI7Y4qdUGiJTry8vxzR2JZqVwFN1');
define('NONCE_SALT',       'IniyAEn3HZRpWmtoXRtYm7p6B3iKXKo7aT5AJ0urSNPjLEVSxsWKml1pwL4MhaLQ');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
