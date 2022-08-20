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
define( 'DB_NAME', 'database_name_and_login' );

/** MySQL database username */
define( 'DB_USER', 'database_name_and_login' );

/** MySQL database password */
define( 'DB_PASSWORD', 'database_password' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', 'utf8_general_ci' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '7;bM1}9NmLYDv.QR?{-nO/C-!x?tPkgKoYa$Yd%Y#sL{KS?a=3i<pEiGpHk3Nzhs' );
define( 'SECURE_AUTH_KEY',   'Waj~1C!<W,FR}$GF4E$<=v{y|HsK/xO:a!#c>{:rk;.7cI}<w}FMX.xuE?(:DM1v' );
define( 'LOGGED_IN_KEY',     'NOhTUtufZVJ{a+HiJ4Od^Z/6CkiMA%2Ye.-=8H2)/ >I{rW],I-V}fm>)Z@sAv_/' );
define( 'NONCE_KEY',         'OZgE?:PSUR+).o#m=P_Of@S6Jte8:p S+wDSpYfWWS32*pxeR^x:%**SffzW9_/~' );
define( 'AUTH_SALT',         ')yQ@R3%Z)A^BE}2J@BL4%Nihm_zEBrt7P<<<dd LEwYkmb^8zZ(K%*`t&yR$c&S]' );
define( 'SECURE_AUTH_SALT',  '(4Fi1Ch9cvmj)XCr#`Vi#,a:d*ow,T`2h2UlJf^ NTnP-+{0g@} 7C~%ItOG}%|k' );
define( 'LOGGED_IN_SALT',    'u;ZU]K]e/:%t1E[~RW7n j[Om5Jm4uFX^{OnHY?vyc1pKLwQ~prw0B0J~?xqpWOr' );
define( 'NONCE_SALT',        'WB*t*4[J!22uPT#zPi?!SCUuLhh:ZhSFq?DdNd3!Wbonj.ymkzT8hs k*T$sfoIG' );
define( 'WP_CACHE_KEY_SALT', '^;{N0GB {=`ugkH8%;30T/OU;.UONKmvE~Tk)^=T`+ jI@L]fMj>PgzvER3EFG8.' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
