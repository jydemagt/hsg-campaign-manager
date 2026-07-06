<?php
/**
 * Main plugin class
 *
 * @package HSGCampaignManager
 */

defined( 'ABSPATH' ) || exit;

class HSGCM_Plugin {

	/**
	 * Singleton instance
	 *
	 * @var HSGCM_Plugin|null
	 */
	private static $instance = null;

	/**
	 * Return singleton instance.
	 *
	 * @return HSGCM_Plugin
	 */
	public static function instance() {

		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {

		$this->load_files();

		add_action( 'plugins_loaded', array( $this, 'init' ) );

	}

	/**
	 * Load required classes.
	 *
	 * @return void
	 */
	private function load_files() {

		$files = array(
			'includes/class-loader.php',
			'admin/class-admin.php',
			'includes/class-campaign.php',
			'includes/class-pricing.php',
			'includes/class-coupons.php',
		);

		foreach ( $files as $file ) {

			$path = HSGCM_PLUGIN_PATH . $file;

			if ( file_exists( $path ) ) {
				require_once $path;
			}

		}

	}

	/**
	 * Initialize plugin.
	 *
	 * @return void
	 */
	public function init() {

		if ( class_exists( 'WooCommerce' ) === false ) {

			add_action(
				'admin_notices',
				function () {

					echo '<div class="notice notice-error"><p>';
					echo esc_html__( 'HSG Campaign Manager requires WooCommerce to be installed and activated.', 'hsg-campaign-manager' );
					echo '</p></div>';

				}
			);

			return;
		}

		if ( class_exists( 'HSGCM_Admin' ) ) {
			new HSGCM_Admin();
		}

		if ( class_exists( 'HSGCM_Campaign' ) ) {
			new HSGCM_Campaign();
		}

		if ( class_exists( 'HSGCM_Pricing' ) ) {
			new HSGCM_Pricing();
		}

		if ( class_exists( 'HSGCM_Coupons' ) ) {
			new HSGCM_Coupons();
		}

	}

}
