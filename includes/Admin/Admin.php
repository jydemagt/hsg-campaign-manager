<?php
/**
 * Admin Menu
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

defined( 'ABSPATH' ) || exit;

class Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action(
			'admin_menu',
			array( $this, 'register_menu' )
		);

	}

	/**
	 * Register admin menu.
	 */
	public function register_menu(): void {

		/*
		 * Dashboard
		 */
		add_submenu_page(
			'woocommerce',
			__( 'HSG Campaign Manager', 'hsg-campaign-manager' ),
			__( 'Campaign Manager', 'hsg-campaign-manager' ),
			'manage_woocommerce',
			'hsg-campaign-manager',
			array( $this, 'dashboard_page' )
		);

		/*
		 * Campaigns
		 */
		add_submenu_page(
			'woocommerce',
			__( 'Campaigns', 'hsg-campaign-manager' ),
			__( 'Campaigns', 'hsg-campaign-manager' ),
			'manage_woocommerce',
			'edit.php?post_type=hsg_campaign'
		);

		/*
		 * Settings
		 */
		add_submenu_page(
			'woocommerce',
			__( 'Settings', 'hsg-campaign-manager' ),
			__( 'Settings', 'hsg-campaign-manager' ),
			'manage_woocommerce',
			'hsgcm-settings',
			array( $this, 'settings_page' )
		);

		/*
		 * Statistics
		 */
		add_submenu_page(
			'woocommerce',
			__( 'Statistics', 'hsg-campaign-manager' ),
			__( 'Statistics', 'hsg-campaign-manager' ),
			'manage_woocommerce',
			'hsgcm-statistics',
			array( $this, 'statistics_page' )
		);

	}

	/**
	 * Dashboard page.
	 */
	public function dashboard_page(): void {

		?>

		<div class="wrap">

			<h1>HSG Campaign Manager</h1>

			<p>
				Version
				<strong><?php echo esc_html( HSGCM_VERSION ); ?></strong>
			</p>

			<hr>

			<h2>Status</h2>

			<table class="widefat striped">

				<tbody>

					<tr>
						<td>WooCommerce</td>
						<td>
							<?php echo class_exists( 'WooCommerce' ) ? '✅ Aktiv' : '❌ Ikke aktiv'; ?>
						</td>
					</tr>

					<tr>
						<td>Plugin Version</td>
						<td><?php echo esc_html( HSGCM_VERSION ); ?></td>
					</tr>

					<tr>
						<td>PHP</td>
						<td><?php echo esc_html( PHP_VERSION ); ?></td>
					</tr>

					<tr>
						<td>WordPress</td>
						<td><?php echo esc_html( get_bloginfo( 'version' ) ); ?></td>
					</tr>

				</tbody>

			</table>

			<br>

			<h2>Quick Links</h2>

			<p>

				<a class="button button-primary"
					href="<?php echo esc_url( admin_url( 'post-new.php?post_type=hsg_campaign' ) ); ?>">

					➕ Opret kampagne

				</a>

				&nbsp;

				<a class="button"
					href="<?php echo esc_url( admin_url( 'edit.php?post_type=hsg_campaign' ) ); ?>">

					📋 Se kampagner

				</a>

			</p>

		</div>

		<?php

	}

	/**
	 * Settings page.
	 */
	public function settings_page(): void {

		?>

		<div class="wrap">

			<h1>Settings</h1>

			<p>Kommer i Version 1.1</p>

		</div>

		<?php

	}

	/**
	 * Statistics page.
	 */
	public function statistics_page(): void {

		?>

		<div class="wrap">

			<h1>Statistics</h1>

			<p>Kommer i Version 1.1</p>

		</div>

		<?php

	}

}
