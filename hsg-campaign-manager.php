<?php
/**
 * Plugin Name: HSG Campaign Manager
 * Plugin URI: https://github.com/jydemagt/hsg-campaign-manager
 * Description: Advanced Campaign Manager for WooCommerce.
 * Version: 1.0.0
 * Author: Michael Sommerlund
 * Requires at least: 6.5
 * Requires PHP: 8.1
 * Text Domain: hsg-campaign-manager
 */

defined( 'ABSPATH' ) || exit;

define( 'HSGCM_VERSION', '1.0.0' );
define( 'HSGCM_FILE', __FILE__ );
define( 'HSGCM_PATH', plugin_dir_path( __FILE__ ) );
define( 'HSGCM_URL', plugin_dir_url( __FILE__ ) );

/*
 * Loader SKAL indlæses først
 */
require_once HSGCM_PATH . 'includes/Core/Loader.php';

HSGCM\Core\Loader::register();

/*
 * Derefter Plugin
 */
require_once HSGCM_PATH . 'includes/Core/Plugin.php';

HSGCM\Core\Plugin::instance();
