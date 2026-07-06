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
	 * Constructor
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'register_menu' ) );

	}

	/**
	 * Register admin menu.
	 */
	public function register_menu(): void {

		add_submenu_page(
			'woocommerce',
			__( 'HSG Campaign Manager', 'hsg-campaign-manager' ),
			__( 'Campaign Manager', 'hsg-campaign-manager' ),
			'manage_woocommerce',
			'hsg-campaign-manager',
			array( $this, 'dashboard' )
		);

	}

	/**
	 * Dashboard page.
	 */
	public function dashboard(): void {

		?>
		<div class="wrap">

			<h1>HSG Campaign Manager</h1>

			<p>Version <?php echo esc_html( HSGCM_VERSION ); ?></p>

			<hr>

			<h2>Status</h2>

			<table class="widefat striped">

				<tbody>

					<tr>
						<td>WooCommerce</td>
						<td>
							<?php echo class_exists( 'WooCommerce' ) ? '✅ Aktiv' : '❌ Ikke installeret'; ?>
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

			<p style="margin-top:25px;">
				<strong>Næste version:</strong><br>

				✔ Kampagner<br>
				✔ Prisregler<br>
				✔ Kuponer<br>
				✔ Statistik
			</p>

		</div>
		<?php

	}

}
