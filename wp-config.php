<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'shjinter_jwelery' );

/** Database username */
define( 'DB_USER', 'shjinter_jwelery' );

/** Database password */
define( 'DB_PASSWORD', 'jwelery@123!!' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '&tP&ZuX:0AgshBMJ`LwuP:=&Z_*^v[*.Ma]kj%O<l$:Y9Y{E7]]g_b;*&RKR3h;>' );
define( 'SECURE_AUTH_KEY',  '9C5DgZ[i2bO9|b*-h1wPa[yn3ffwN`pQes{d|pfx8lh;c+IB-g4CR]B9uWn2o8/M' );
define( 'LOGGED_IN_KEY',    'Q{;~2-qrh|@sP=o~R<Zg+nXqksWhJ;+j~p:^3y7FMo=>f6`Wk|h~NB.!wtE+[@_V' );
define( 'NONCE_KEY',        '#t(F=OtA}@X$v%7grq{)Roj`*# !}O2yB3,6zrSFw6+h:gIW^3C]<B_)U<mO9!j+' );
define( 'AUTH_SALT',        'i[yhEqP^Keh m^6*nX$cX@Eu! 7+=.8|N$NR$4FP<%Lzn?XYl2<i!Luqjc:r-#e ' );
define( 'SECURE_AUTH_SALT', 'iWXPcocinM8&1x|+h7PgA4u?Mp(8=?fD)M~~tAe2MV]8zxRy5d)=2lner&V?777k' );
define( 'LOGGED_IN_SALT',   'S)YEifeGB_aAWye 7Vp;SAg-TIab=PF&}1e*/SiM!^?^]`8OhF2KzaHJF)ySiX`|' );
define( 'NONCE_SALT',       'V;y^;Gi=DI-ETJBRHE~3CzAFEB-dYFO(*H;|iY1Z?wzt%hf[}g.*.9f2JfBK~FOo' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
