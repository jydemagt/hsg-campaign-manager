<?php
/**
 * Dashboard
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

		$campaigns = wp_count_posts( 'hsg_campaign' );

		$total_campaigns = 0;

		if ( $campaigns ) {
			$total_campaigns = (int) $campaigns->publish;
		}

		?>

		<div class="hsgcm-dashboard">

			<h2><?php esc_html_e( 'Dashboard', 'hsg-campaign-manager' ); ?></h2>

			<div class="hsgcm-cards">

				<div class="hsgcm-card">

					<h3><?php esc_html_e( 'Campaigns', 'hsg-campaign-manager' ); ?></h3>

					<p class="hsgcm-number">
						<?php echo esc_html( $total_campaigns ); ?>
					</p>

				</div>

				<div class="hsgcm-card">

					<h3><?php esc_html_e( 'WooCommerce', 'hsg-campaign-manager' ); ?></h3>

					<p>

						<?php
						echo class_exists( 'WooCommerce' )
							? '✅ Active'
							: '❌ Missing';
						?>

					</p>

				</div>

				<div class="hsgcm-card">

					<h3><?php esc_html_e( 'Plugin Version', 'hsg-campaign-manager' ); ?></h3>

					<p><?php echo esc_html( HSGCM_VERSION ); ?></p>

				</div>

			</div>

			<hr>

			<h2><?php esc_html_e( 'Quick Actions', 'hsg-campaign-manager' ); ?></h2>

			<p>

				<a class="button button-primary"
					href="<?php echo esc_url( admin_url( 'post-new.php?post_type=hsg_campaign' ) ); ?>">

					<?php esc_html_e( 'New Campaign', 'hsg-campaign-manager' ); ?>

				</a>

			</p>

		</div>

		<style>

			.hsgcm-cards{

				display:flex;
				gap:20px;
				margin:20px 0;
				flex-wrap:wrap;

			}

			.hsgcm-card{

				background:#fff;
				border:1px solid #ccd0d4;
				padding:20px;
				min-width:220px;

			}

			.hsgcm-card h3{

				margin-top:0;

			}

			.hsgcm-number{

				font-size:42px;
				font-weight:bold;
				margin:10px 0;

			}

		</style>

		<?php

	}

}
