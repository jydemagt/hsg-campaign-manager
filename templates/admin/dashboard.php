<?php
/**
 * Dashboard View
 *
 * @package HSGCampaignManager
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="hsgcm-dashboard">

	<div class="hsgcm-header">

		<h2><?php esc_html_e( 'Dashboard', 'hsg-campaign-manager' ); ?></h2>

		<a class="button button-primary"
		   href="?page=hsg-campaign-manager&tab=campaigns&action=new">

			➕ <?php esc_html_e( 'New Campaign', 'hsg-campaign-manager' ); ?>

		</a>

	</div>

	<div class="hsgcm-cards">

		<div class="hsgcm-card">

			<h3><?php esc_html_e( 'Campaigns', 'hsg-campaign-manager' ); ?></h3>

			<p class="number">

				<?php echo esc_html( $data['total_campaigns'] ); ?>

			</p>

		</div>

		<div class="hsgcm-card">

			<h3><?php esc_html_e( 'WooCommerce', 'hsg-campaign-manager' ); ?></h3>

			<p>

				<?php if ( $data['woocommerce'] ) : ?>

					<span class="hsgcm-success">✅ Active</span>

				<?php else : ?>

					<span class="hsgcm-error">❌ Missing</span>

				<?php endif; ?>

			</p>

		</div>

		<div class="hsgcm-card">

			<h3><?php esc_html_e( 'Plugin Version', 'hsg-campaign-manager' ); ?></h3>

			<p>

				<?php echo esc_html( $data['plugin_version'] ); ?>

			</p>

		</div>

		<div class="hsgcm-card">

			<h3><?php esc_html_e( 'Environment', 'hsg-campaign-manager' ); ?></h3>

			<p>

				PHP <?php echo esc_html( $data['php_version'] ); ?>

				<br>

				WordPress <?php echo esc_html( $data['wp_version'] ); ?>

			</p>

		</div>

	</div>

	<div class="hsgcm-panel">

		<h3><?php esc_html_e( 'Welcome', 'hsg-campaign-manager' ); ?></h3>

		<p>

			HSG Campaign Manager er klar.

		</p>

		<p>

			Næste skridt er at oprette den første kampagne.

		</p>

	</div>

</div>
