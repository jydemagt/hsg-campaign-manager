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
	 * Dashboard.
	 *
	 * @var Dashboard
	 */
	private Dashboard $dashboard;

	/**
	 * Campaigns.
	 *
	 * @var Campaigns
	 */
	private Campaigns $campaigns;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->dashboard = new Dashboard();
		$this->campaigns = new Campaigns();

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
	 * Render page.
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

			<div class="hsgcm-content">

				<?php

				switch ( $tab ) {

					case 'campaigns':
						$this->campaigns->render();
						break;

					case 'statistics':
						echo '<h2>Statistics</h2><p>Kommer i version 1.1</p>';
						break;

					case 'settings':
						echo '<h2>Settings</h2><p>Kommer i version 1.1</p>';
						break;

					default:
						$this->dashboard->render();
						break;

				}

				?>

			</div>

		</div>

		<?php

	}

}
