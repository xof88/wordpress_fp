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
define('DB_NAME', 'janefinalproject');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '^Evj|2#fU0{YcS}uxM&u%AHBp*V~g+9:i?5q3Ytl!{*HJMcj8Q[LH8D5kdIOWSLh');
define('SECURE_AUTH_KEY',  ' __#M6%`)?Mu]~ZYyQlR1-l{[y53WIPi3x8/e2FicNE_,)UM=PyG46w4rWbOP}|x');
define('LOGGED_IN_KEY',    '2+#B?TdkseldQ)Q.2Z3eib.U)*>KxY}h*CO4PZZ:CI[=s5>01[oa.Dwy1T$69dJ]');
define('NONCE_KEY',        'PO8mI{,H9e!umndMcD,$idZy!cIXAhCD55%306)-bd2@X_vKMw$n0L(4{L@Cgnn_');
define('AUTH_SALT',        'hGV= M.Si+kT/IKhu,=kI*WcwQvvC8ku=3#d<>A`%!Zw_.KxzOFI6&1N1^X-qzuX');
define('SECURE_AUTH_SALT', ':#<(pSli}^/jDTDgS(;1d-BN$Cr@UTSxv+,fP73d#dqXq<mh{m)>)XrLqJd*1@x@');
define('LOGGED_IN_SALT',   '|v.|j6BJ+p5tYKfaM7J6B)NRItvOzA%*^|m&4:o,yYL%5&rRH =g$vfM8sRrA8O{');
define('NONCE_SALT',       '}a[qd0 =u*N3fB`;:#D|nIsjM-|NxQMas]C1YLxiQ`LM(5zaYc_jeh+9y(0IV.B[');

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
