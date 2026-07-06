<?php
/**
 * Plugin bootstrap class
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Core;

defined( 'ABSPATH' ) || exit;

class Plugin {

	/**
	 * Singleton instance.
	 *
	 * @var Plugin|null
	 */
	private static ?Plugin $instance = null;

	/**
	 * Return singleton instance.
	 */
	public static function instance(): Plugin {

		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;

	}

	/**
	 * Constructor.
	 */
	private function __construct() {

		$this->load();

		add_action( 'plugins_loaded', array( $this, 'init' ) );

	}

	/**
	 * Load required files.
	 */
	private function load(): void {

		require_once HSGCM_PATH . 'includes/Core/Loader.php';

		Loader::register();

	}

	/**
	 * Initialize plugin.
	 */
	public function init(): void {

		// WooCommerce skal være aktiv.
		if ( ! class_exists( 'WooCommerce' ) ) {

			add_action(
				'admin_notices',
				function () {

					echo '<div class="notice notice-error"><p>';
					echo esc_html__( 'HSG Campaign Manager requires WooCommerce.', 'hsg-campaign-manager' );
					echo '</p></div>';

				}
			);

			return;

		}

		/*
		 * Start moduler
		 */

		new \HSGCM\Admin\Admin();

		new \HSGCM\Campaign\Campaign();

		new \HSGCM\Pricing\Pricing();

		new \HSGCM\Coupons\Coupons();

	}

}
