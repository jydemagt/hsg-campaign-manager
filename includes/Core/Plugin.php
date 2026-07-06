<?php
/**
 * Main plugin bootstrap class.
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Core;

use HSGCM\Admin\Admin;
use HSGCM\Campaign\Campaign;
use HSGCM\Campaign\Editor;
use HSGCM\Campaign\Save;
use HSGCM\Pricing\Pricing;
use HSGCM\Coupons\Coupons;

defined( 'ABSPATH' ) || exit;

class Plugin {

	/**
	 * Singleton instance.
	 *
	 * @var Plugin|null
	 */
	private static ?Plugin $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @return Plugin
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

		add_action( 'plugins_loaded', array( $this, 'init' ), 20 );

	}

	/**
	 * Load plugin core.
	 *
	 * @return void
	 */
	private function load(): void {

		require_once HSGCM_PATH . 'includes/Core/Loader.php';

		Loader::register();

	}

	/**
	 * Initialize plugin.
	 *
	 * @return void
	 */
	public function init(): void {

		// WooCommerce skal være installeret.
		if ( ! class_exists( 'WooCommerce' ) ) {

			add_action(
				'admin_notices',
				function () {

					?>
					<div class="notice notice-error">
						<p>
							<?php esc_html_e( 'HSG Campaign Manager requires WooCommerce to be installed and activated.', 'hsg-campaign-manager' ); ?>
						</p>
					</div>
					<?php

				}
			);

			return;

		}

		$this->boot_modules();

	}

	/**
	 * Boot plugin modules.
	 *
	 * @return void
	 */
	private function boot_modules(): void {

		new Admin();

		new Campaign();

		new Editor();

		new Save();

		new Pricing();

		new Coupons();

	}

}
