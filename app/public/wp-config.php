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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '_&6S}DW{y7DZ,P9NhR &H+%Zh!l;t+5]K6s@7Gx*e=+@$VO_v/zrrXY3|/TsAhmZ' );
define( 'SECURE_AUTH_KEY',   'G=j[96M{/<2fB+T;[#E>+Y[0hU#-NHp&wA@:8**@pn(Miz+_Sz3C+gZY>,SF3bqX' );
define( 'LOGGED_IN_KEY',     '%oKmo[&+*(2O:%@>v o(^Y6t)7Bkm5Y2Z/VK-E !U3yE,6v*5DNH)x9EIbCYzze4' );
define( 'NONCE_KEY',         'IBvn]czw0;nx:C9$D*E[BB0k+)TP(Aiz|qiX?v8BB80d`wU$8dMW-eW{pxIxr+`=' );
define( 'AUTH_SALT',         'or:T3hvJ5|kl1)=8;Q~lqJspr^_4<v26X*EW?{UgOW<%qYMf<IDD7zhqx 3YfkbE' );
define( 'SECURE_AUTH_SALT',  '2_ON#xRQOd{x1do2h6[rd~JKoJY}eL.EOjr|;>u{<<TN<F1Dw+E)|xfHbMr`cO!`' );
define( 'LOGGED_IN_SALT',    '@<UM[LS+Y%ay_;3O4E$%LI#`gY-[p,s`OI,zqiq`sE&dTf%MYy|k*K)L?xbb26|$' );
define( 'NONCE_SALT',        '!khi]g!o l#{TZ/YPB7UFZ>+^E2H9D:Z]i}QYUD}=T7CQ,5AJ#jeg)jLEZ~jqlJ{' );
define( 'WP_CACHE_KEY_SALT', 'My(&>?]wIVCb=M}GUGa+OJmY:f%nS^U1.`m5o:0GJ}Y6]2u&PWuk8Ec%$#BJq,Hy' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
