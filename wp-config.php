<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u784570102_RNIM1' );

/** Database username */
define( 'DB_USER', 'u784570102_IaB5v' );

/** Database password */
define( 'DB_PASSWORD', 'iufZ47ffVM' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '`N!y]3uaZN|W{5qoF=Q<]({#dkSbppqwU%N[|b8(5ih&(soaI:`4d$zx&D-Ts6nY' );
define( 'SECURE_AUTH_KEY',   '?>~F/!k$A/:K_G+vftZmuVZvq434#xR}Uu<ve#]V.kAq5yqqQUAl-D5A^QuA7@!U' );
define( 'LOGGED_IN_KEY',     '2<3R{4qhWl]lfZ(.2urcU#b@c7o)R2x]9m@`&=Qna.k, KNfibmO`vhK@(1gVQ6)' );
define( 'NONCE_KEY',         '@3gNx7Mu&,<KPZaj1;^be%}V]~G4viVcl,eB&r.~52yE3<BaCTm,>%(r1o]7zp{L' );
define( 'AUTH_SALT',         '7-B#qGP#O0XJF]bXglP7cf<B6T$ePQiuJc=pz /N^$qC=Vvl@Mg6(Dp<F}U2rL6b' );
define( 'SECURE_AUTH_SALT',  '?Rn<qNVcd5$f4JJUn5h$=q_Z=m5/| CY1tPGa!XCw}H;wivr9hk|mC/rCxBESZ51' );
define( 'LOGGED_IN_SALT',    'D$8oL67Gu!>?5$dj+Ik}m~Yp[?7eo/j<aA&D+g]1x+XHBqSLQe)jLT^SAKT7GS4T' );
define( 'NONCE_SALT',        ':MUjn9vHF1>vb6A;v$6+y0{/+d,b08x)ZTnDDg@pG<7B&VK60Bh{q!=_Jz.7=^f7' );
define( 'WP_CACHE_KEY_SALT', 'I_0{B5_g_oh$S=8VEt!9AXQr#ts?]NE-O~hkZKR+y0/F9E/AI~K<7H@KL,#vBK,2' );


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

define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
