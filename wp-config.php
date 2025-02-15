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
define( 'DB_NAME', 'cityzenpath' );

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
define( 'AUTH_KEY',         '`/X.}mcwp#<7G-?CwrhcdC|qB#ck111xBHyZ]AR~!XOTmV[cm@v^|j+(iFA/eFq,' );
define( 'SECURE_AUTH_KEY',  'AVK>y)6&0s 1{u[h[sE=#/Ts@GMXKWP<JlEzig]2/ZEqD=J_X<W<jW2C~lcDr^4p' );
define( 'LOGGED_IN_KEY',    '1EJ4Xd VCDb!qM-)e<!K1+yZi0`z>3SDrD<XfdIj}6ai#c67X+sr&)XPomaCq+{?' );
define( 'NONCE_KEY',        'oQ?+Hw7,}20L*I|a#K^7co3z;@7(G%fEC}dL_AirXGH0}}7L|SAUe=PGXWVxxpta' );
define( 'AUTH_SALT',        '^/Utp<-Lv v,@{)(5]sVEQS>Hq6rNRnGsQzD/8lfzH!cZUok&Zq~)m``f-N^^pTa' );
define( 'SECURE_AUTH_SALT', 'Br3<FnAfTj$AYzlNa-# pi2XW`WO;d jdq,P.{%#Q=Dpx&To/XSX,tM`pKcisjqh' );
define( 'LOGGED_IN_SALT',   'YNt<i.o1i^44QWC)*3$,Y)=%{fsjv@cqgIjICeRl1c>q@3nqePzD4K*^A~@}Uy6T' );
define( 'NONCE_SALT',       '?I=$sgFuEfhYIY3-yQ0V$NTG}6}%#J:0C(G8i:8CxR8zRgxt1bSLN5Li@/(&apsO' );

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
