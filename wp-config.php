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
define('DB_NAME', 'bimitech');

/** MySQL database username */
define('DB_USER', 'bimitech');

/** MySQL database password */
define('DB_PASSWORD', 'KXH6P.rc3J+.;E8P');

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
define('AUTH_KEY',         '8Fe5jDFL8l0g|C@;e}$e=U+Ni}?fzKF;!9|^qPq<CXzov@p<x[|:1e=E(/a5SXL$');
define('SECURE_AUTH_KEY',  'obmeB,bA/=t!^_4uvwRX`H.QavOYS(11Rz5mD8L``y`Cq&1W1x.?=}0##r2pZ(h>');
define('LOGGED_IN_KEY',    'l,^)=;r3T0*v<AZ--6aLh8clk|UC)Ijr2Rp|V`:ur`y0XGL-=n3O9Sk%*eB,e,@-');
define('NONCE_KEY',        '4Xkwf]*[q[pJ?6AZS<NF1|[3K(&d,pANgSFloCJ0_rxH/^{HXZI`}}!.]qc49TPw');
define('AUTH_SALT',        '}1%M}^r*~#=8on)JQF,,[AgDv1et6xh.M9V&(7E28_+FkAx|?xBu~)~KDlZM31}%');
define('SECURE_AUTH_SALT', 'I,4HggZ?ej0gitd0,(,8jOn{g!p3UZy7x>nj!r>{~{m|/e^#k3.RQ)x:o/I$.2B6');
define('LOGGED_IN_SALT',   '!tdjt!tTg %(DOD<pHLugp}WooQaR3CkC&0Q=R.YH|=y,~=ajICRsz19yCCx*j{u');
define('NONCE_SALT',       'p)Yf)Q*Dz}aQiR8/ i|uDT-;Pn5b^+6zvMuzqq{<!^gsK:]p(yp}8SX/W<+yOh,@');

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
