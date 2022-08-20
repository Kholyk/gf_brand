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
define( 'DB_NAME', 'gf' );

/** MySQL database username */
define( 'DB_USER', 'homestead' );

/** MySQL database password */
define( 'DB_PASSWORD', 'secret' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '1wt%g>L6ocFlajCF|2n?=%INps[YMkrR{Cg1>pu,@-!|=FJQQaU*CnhQJjj^p]`b' );
define( 'SECURE_AUTH_KEY',  ':oo,ew@h.VnyJ5fJ.)[-7`>X>$3$;SB5y(?C#l4*@jnXI/zH$.U1#h%xHb_)E^~*' );
define( 'LOGGED_IN_KEY',    ')ooaoLmqBB8`mZnu6!K2tXl,1P`.N{[<nHX4v:-|43g^jLLCd@PkDBX]/cWe>%^d' );
define( 'NONCE_KEY',        'mkZkiakJoxG37D6jt)DAYk Ff3Pv=xG6v?-89gq`6+}g2HLwTO5$$gn6{~,+o?#F' );
define( 'AUTH_SALT',        '.ge< ?wyHo6c0]6uv-3?h(nem:Us~b9]Tk9g|.VnXBz]FI^N!b826uz&cO:C6bkp' );
define( 'SECURE_AUTH_SALT', '`0_z1=t xa 0YvI4n#:7T_s:8jS$+@g[]W]gNb2ED>|FN.RCl,4L@$XeO)MR4-QT' );
define( 'LOGGED_IN_SALT',   'x<%^Qy=P*,qtk@yto+%8uS*MQ:R1X&zCym3(sUF}%ah9Q)VR|FuQ@*KL-loLx@MS' );
define( 'NONCE_SALT',       ',ld1YEheMej`@AgZOF~x8*a}%{DU2^^pbu@e%?:nUXn:)[%a^Mb`:.WW[O:7G]3v' );

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
