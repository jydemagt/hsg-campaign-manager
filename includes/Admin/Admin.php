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
	 * Register menu.
	 */
	public function register_menu(): void {

		add_submenu_page(
			'woocommerce',
			__( 'HSG Campaign Manager', 'hsg-campaign-manager' ),
			__( 'Campaign Manager', 'hsg-campaign-manager' ),
			'manage_woocommerce',
			'hsg-campaign-manager',
			array( $this, 'render' )
		);

	}

	/**
	 * Render admin page.
	 */
	public function render(): void {

		$tab = isset( $_GET['tab'] )
			? sanitize_key( wp_unslash( $_GET['tab'] ) )
			: 'dashboard';

		?>

		<div class="wrap">

			<h1 class="wp-heading-inline">
				HSG Campaign Manager
			</h1>

			<span style="float:right;margin-top:10px;">
				Version <?php echo esc_html( HSGCM_VERSION ); ?>
			</span>

			<hr class="wp-header-end">

			<nav class="nav-tab-wrapper">

				<a href="?page=hsg-campaign-manager&tab=dashboard"
				   class="nav-tab <?php echo $tab === 'dashboard' ? 'nav-tab-active' : ''; ?>">
					🏠 Dashboard
				</a>

				<a href="?page=hsg-campaign-manager&tab=campaigns"
				   class="nav-tab <?php echo $tab === 'campaigns' ? 'nav-tab-active' : ''; ?>">
					🎯 Campaigns
				</a>

				<a href="?page=hsg-campaign-manager&tab=statistics"
				   class="nav-tab <?php echo $tab === 'statistics' ? 'nav-tab-active' : ''; ?>">
					📈 Statistics
				</a>

				<a href="?page=hsg-campaign-manager&tab=settings"
				   class="nav-tab <?php echo $tab === 'settings' ? 'nav-tab-active' : ''; ?>">
					⚙️ Settings
				</a>

			</nav>

			<div style="background:#fff;padding:25px;border:1px solid #ccd0d4;border-top:none;">

				<?php

				switch ( $tab ) {

					case 'campaigns':
						$this->campaigns();
						break;

					case 'statistics':
						$this->statistics();
						break;

					case 'settings':
						$this->settings();
						break;

					default:
						$this->dashboard();
						break;

				}

				?>

			</div>

		</div>

		<?php

	}

	/**
	 * Dashboard tab.
	 */
	private function dashboard(): void {

		$total = wp_count_posts( 'hsg_campaign' );

		?>

		<h2>Dashboard</h2>

		<table class="widefat striped" style="max-width:700px;">

			<tbody>

				<tr>
					<th>Total Campaigns</th>
					<td><?php echo esc_html( $total->publish ?? 0 ); ?></td>
				</tr>

				<tr>
					<th>WooCommerce</th>
					<td><?php echo class_exists( 'WooCommerce' ) ? '✅ Active' : '❌ Missing'; ?></td>
				</tr>

				<tr>
					<th>Plugin Version</th>
					<td><?php echo esc_html( HSGCM_VERSION ); ?></td>
				</tr>

				<tr>
					<th>PHP</th>
					<td><?php echo esc_html( PHP_VERSION ); ?></td>
				</tr>

			</tbody>

		</table>

		<p style="margin-top:25px;">

			<a class="button button-primary"
			   href="<?php echo esc_url( admin_url( 'post-new.php?post_type=hsg_campaign' ) ); ?>">
				➕ New Campaign
			</a>

		</p>

		<?php

	}

	/**
	 * Campaign tab.
	 */
	private function campaigns(): void {

		?>

		<h2>Campaigns</h2>

		<p>

			<a class="button button-primary"
			   href="<?php echo esc_url( admin_url( 'post-new.php?post_type=hsg_campaign' ) ); ?>">
				➕ New Campaign
			</a>

			<a class="button"
			   href="<?php echo esc_url( admin_url( 'edit.php?post_type=hsg_campaign' ) ); ?>">
				Campaign List
			</a>

		</p>

		<p>
			I næste version vises kampagnelisten direkte her.
		</p>

		<?php

	}

	/**
	 * Statistics tab.
	 */
	private function statistics(): void {

		?>

		<h2>Statistics</h2>

		<p>Kommer i Version 1.1.</p>

		<?php

	}

	/**
	 * Settings tab.
	 */
	private function settings(): void {

		?>

		<h2>Settings</h2>

		<p>Kommer i Version 1.1.</p>

		<?php

	}

}
