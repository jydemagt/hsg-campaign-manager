<?php
/**
 * Plugin Name: HSG Campaign Manager
 * Plugin URI: https://github.com/jydemagt/hsg-campaign-manager
 * Description: Advanced Campaign Manager for WooCommerce.
 * Version: 1.0.0
 * Author: Michael Sommerlund
 * Author URI: https://hsg-whisky.dk
 * Requires at least: 6.5
 * Requires PHP: 8.1
 * Text Domain: hsg-campaign-manager
 * Domain Path: /languages
 * License: GPL v2 or later
 */

defined( 'ABSPATH' ) || exit;

/**
 * Plugin constants.
 */
define( 'HSGCM_VERSION', '1.0.0' );
define( 'HSGCM_FILE', __FILE__ );
define( 'HSGCM_PATH', plugin_dir_path( __FILE__ ) );
define( 'HSGCM_URL', plugin_dir_url( __FILE__ ) );

/*
|--------------------------------------------------------------------------
| Load the plugin core
|--------------------------------------------------------------------------
*/

require_once HSGCM_PATH . 'includes/Core/Plugin.php';

/*
|--------------------------------------------------------------------------
| Start plugin
|--------------------------------------------------------------------------
*/

HSGCM\Core\Plugin::instance();
