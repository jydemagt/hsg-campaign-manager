<?php
/**
 * Dashboard Controller
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

defined( 'ABSPATH' ) || exit;

class Dashboard {

	/**
	 * Render dashboard.
	 *
	 * @return void
	 */
	public function render(): void {

		$data = array(
			'total_campaigns' => wp_count_posts( 'hsg_campaign' )->publish ?? 0,
			'woocommerce'     => class_exists( 'WooCommerce' ),
			'plugin_version'  => HSGCM_VERSION,
			'php_version'     => PHP_VERSION,
			'wp_version'      => get_bloginfo( 'version' ),
		);

		$template = HSGCM_PATH . 'templates/admin/dashboard.php';

		if ( file_exists( $template ) ) {
			include $template;
		}

	}

}
