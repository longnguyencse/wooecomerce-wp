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
define('DB_NAME', 'wp_long');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'SF+kdfJ^OgpIoi,n{#Vh+F:u0SXA:fZd2IzrIBRNNni]2c0>?.T=#4Uzk8iho!z8');
define('SECURE_AUTH_KEY',  'X.^N. EOLp|$]jQjx)Ax--Tj2Q0wPx9bRshRSqwe.3~f:JO6Hq0Y>p-+`aa|M:T/');
define('LOGGED_IN_KEY',    'nGgJicn*LYORvZMi1ystzpuuR2v:BD0H~M^+iY0V`wd{Dhn0 C.e5q}?[0Qt@Y>r');
define('NONCE_KEY',        ';pP6o+5$8R1&o%3eC~+Qn4_$ Pg;~e.4J!D4XCoFVmG3BEZJ@CJjPUpl_vL }|{y');
define('AUTH_SALT',        'A>B|TQBwy6ljnjQ9HZq&X5kMn 51D(.MSfA$;f:RCo7lC5MS_IAIMewYEY>sO4&D');
define('SECURE_AUTH_SALT', 'P#q+i|K)xRJOgsG-JDX**jvsY#m)3^75#i7<;Tv9O;bP}DJuSc-wAA-jccIu8#/@');
define('LOGGED_IN_SALT',   'YX|1iYh}!zNDU NA%9B!DTP 6)3$DTj%m]Fx!tTAD?2fSZ)d>97z>p`wBCL0yJma');
define('NONCE_SALT',       'MJIj,kV}>En6Itp8H);;[^C,._0uC}DaLm(xGx^Hpckj0+YC4a-,NkYo*Z}j2bcw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
