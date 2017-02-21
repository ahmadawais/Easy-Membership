<?php
/**
 * Plugin Name: Easy Membership
 * Plugin URI: http://AhmadAwais.com/
 * Description: WordPress Membership Plugins.
 * Author: mrahmadawais, WPTie
 * Author URI: http://AhmadAwais.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package EM
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Define global constants.
 *
 * @since 1.0.0
 */
// Plugin version.
if ( ! defined( 'EM_VERSION' ) ) {
    define( 'EM_VERSION', '1.0.0' );
}

if ( ! defined( 'EM_NAME' ) ) {
    define( 'EM_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}

if ( ! defined('EM_DIR' ) ) {
    define( 'EM_DIR', WP_PLUGIN_DIR . '/' . EM_NAME );
}

if ( ! defined('EM_URL' ) ) {
    define( 'EM_URL', WP_PLUGIN_URL . '/' . EM_NAME );
}

/**
 * Initializer.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/lib/init.php' ) ) {
    require_once( EM_DIR . '/lib/init.php' );
}
