<?php
/**
 * Plugin bootstrap
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Core;

use HSGCM\Admin\Admin;
use HSGCM\Admin\AjaxController;
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
	 * Get instance.
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

		add_action(
			'plugins_loaded',
			array( $this, 'init' ),
			20
		);

	}

	/**
	 * Initialize plugin.
	 *
	 * @return void
	 */
	public function init(): void {

		// WooCommerce skal være aktiv.
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		/*
		 * Admin
		 */
		new Admin();
		new AjaxController();

		/*
		 * Campaign
		 */
		new Campaign();
		new Editor();
		new Save();

		/*
		 * Pricing
		 */
		new Pricing();

		/*
		 * Coupons
		 */
		new Coupons();

	}

}
