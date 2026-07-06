<?php

namespace HSGCM\Core;

use HSGCM\Admin\Admin;
use HSGCM\Campaign\Campaign;
use HSGCM\Campaign\Editor;
use HSGCM\Campaign\Save;
use HSGCM\Pricing\Pricing;
use HSGCM\Coupons\Coupons;

defined( 'ABSPATH' ) || exit;

class Plugin {

	private static ?Plugin $instance = null;

	public static function instance(): Plugin {

		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;

	}

	private function __construct() {

		add_action( 'plugins_loaded', array( $this, 'init' ) );

	}

	public function init(): void {

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		new Admin();
		new Campaign();
		new Editor();
		new Save();
		new Pricing();
		new Coupons();

	}

}
