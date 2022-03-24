<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_demo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '=J*C{=)4kf?)-eQh#{w3r#G|1^;~~a?uoZ 2$If)>6^bv&r]oZ.<jldR4n:P[L6p' );
define( 'SECURE_AUTH_KEY',  'ngL`!.J-voPH1,KGPhKF6,Eb+ o_2U&j`{v4;{*63Ku1S(riHcdWjA*m*{eoy@?d' );
define( 'LOGGED_IN_KEY',    'W2al?,^f757m&70 oRkBcFjO.:@.j_5Y_:]YnOQKQ_Kxtv%.TG7Eb;]w9lx&3/1:' );
define( 'NONCE_KEY',        '-%.zWmj5S.oZ#sXh=P74*vAu&|mA@Jelrd1rsye4:2BoLe,2NWCN62lyIdQorS/#' );
define( 'AUTH_SALT',        '^A]#%R<B#Ttn#?^9;G,hli0$]x[at)rPw~|&Q,i-Z]~Iq[=V0SFf*q?An]eH?IWw' );
define( 'SECURE_AUTH_SALT', 'gXe4alRjl#-1kyg%Igr6<{?]%eCSu#hv1-:8p-mWb6Dd%=<0 few2((g?;-</4Gz' );
define( 'LOGGED_IN_SALT',   '#/k OqvoKm$5}1aa8v)AVt1;&Fknb0<apaoG8Cg|_F9=X`kEh;Sqd{YT3hhWmwP1' );
define( 'NONCE_SALT',       'z?(/V7FN4r%6i82,>RLm#UF()s|j=Kkl%X!?#9D%OeH1Ws]u,&;EFBbn&q#4XT7k' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
