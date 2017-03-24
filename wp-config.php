<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bef');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '`U+W}?j[i|shg_4`KedPwdx/LSAk3p[vbGP.r8#9~#~Swig](ZzATA&-YRom>Ib:');
define('SECURE_AUTH_KEY',  'c:lS#lJ`#}mpS0eI<TSzKu<o++ba{ADxeG?1jr~NGQ81w-*VMa]%cBwNe_TvLT((');
define('LOGGED_IN_KEY',    '8TJW^+=jIRUk!0et)jjoci% /%&ub;-&BYqG[m`J-S)UuJGzJ!_a|2Uy=A|Bgjll');
define('NONCE_KEY',        'Kk>if0vodBS+tzc V#9R}wfI6-{! 4rn,Z<UT?I3=TQXP-RW)$D`K -I|q4-r/@q');
define('AUTH_SALT',        'CrLZB,q5;XcR,+|QgnWuTjv=_|YN1/$@tD?3(y,{]dp~h|}/~<c+2g%;JRPHc{7X');
define('SECURE_AUTH_SALT', 'd)R>3E`fEHmnCeiY2`|VE]@SGo]shG&SD]`o6BNC/GwGnBx[pT)FG(VXbPd!-Y:X');
define('LOGGED_IN_SALT',   'm7Y4-WiB?hvIVYSX]2`+eS{nW #/X(tzc`)=v[}QpLiINyN!0NlC|9puJLP)|/m)');
define('NONCE_SALT',       'm-Y3$LgJ*#eipB_#$vyJjgV~Gurn`|O{%5r5)8(!e[i)s#EURnlVwmi}7]=H<yJp');
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
