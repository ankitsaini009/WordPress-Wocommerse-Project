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
define( 'DB_NAME', 'woocommerce_wordprese' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '5)~[jFC* ;[n24!T?ViE@@Z>Rj-eAbmTYg~a=Zp4:^PdxIyk6)96MZ_W u2y+a!E' );
define( 'SECURE_AUTH_KEY',  'WsjStPke81y{#6ycl9z=81!T~Cr`1dec{ya@pjLdpk//cFqlphIAm_aj5f(D0WF^' );
define( 'LOGGED_IN_KEY',    'GcRleX@:pBaYHg3~u`vwt~c^GH^mcGB.oz[S0pC.4Ef@iiwNRUVEq&Gc6wt:R->p' );
define( 'NONCE_KEY',        'uEYw@9HLD&wkMomT)@o3^9IO&0$RxvXGgBv];+#dGV+E1*=5F?vgCf4T7s8VMc/U' );
define( 'AUTH_SALT',        '!2{i 0>CnGib%w|yPcm|HxpVpnQ=uPOgB_R` CyXT!Jn++@AJ/>r2)/LEJI,K<2u' );
define( 'SECURE_AUTH_SALT', '{w.Q(A3SVW)L{1,Fx54vtiuJ]@N4UygA#A3c4@?R3!+3,!96f)b} #:~^x ;]/=>' );
define( 'LOGGED_IN_SALT',   'I+:N^6j4mH6[4:f`Q([eLx6njSX38GDc:%0MjV#XkI0?%tp-PI+R>41VR9NY`}+a' );
define( 'NONCE_SALT',       'O~Di{Z~l]52zVz!I)l_xr_U:I1>70>U|}Wopm ~NDZ@[(|+||E|jD]+#Y{3VX8_q' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
