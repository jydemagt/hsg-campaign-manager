<?php
/**
 * Campaign Editor
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class Editor {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action(
			'add_meta_boxes',
			array( $this, 'register_meta_box' )
		);

	}

	/**
	 * Register campaign meta box.
	 */
	public function register_meta_box(): void {

		add_meta_box(
			'hsgcm_campaign_settings',
			__( 'Campaign Settings', 'hsg-campaign-manager' ),
			array( $this, 'render' ),
			'hsg_campaign',
			'normal',
			'high'
		);

	}

	/**
	 * Render meta box.
	 */
	public function render( \WP_Post $post ): void {

		wp_nonce_field(
			'hsgcm_campaign_save',
			'hsgcm_campaign_nonce'
		);

		$enabled = get_post_meta(
			$post->ID,
			'_hsgcm_enabled',
			true
		);

		$coupon = get_post_meta(
			$post->ID,
			'_hsgcm_coupon',
			true
		);

		$price = get_post_meta(
			$post->ID,
			'_hsgcm_price',
			true
		);

		$start = get_post_meta(
			$post->ID,
			'_hsgcm_start_date',
			true
		);

		$end = get_post_meta(
			$post->ID,
			'_hsgcm_end_date',
			true
		);

		?>

		<table class="form-table">

			<tr>

				<th>
					<label for="hsgcm_enabled">
						<?php esc_html_e(
							'Campaign Active',
							'hsg-campaign-manager'
						); ?>
					</label>
				</th>

				<td>

					<label>

						<input
							type="checkbox"
							name="hsgcm_enabled"
							id="hsgcm_enabled"
							value="1"
							<?php checked( $enabled, 1 ); ?>>

						<?php esc_html_e(
							'Enable campaign',
							'hsg-campaign-manager'
						); ?>

					</label>

				</td>

			</tr>

			<tr>

				<th>

					<label for="hsgcm_coupon">

						<?php esc_html_e(
							'Coupon Code',
							'hsg-campaign-manager'
						); ?>

					</label>

				</th>

				<td>

					<input
						type="text"
						class="regular-text"
						name="hsgcm_coupon"
						id="hsgcm_coupon"
						value="<?php echo esc_attr( $coupon ); ?>">

				</td>

			</tr>

			<tr>

				<th>

					<label for="hsgcm_price">

						<?php esc_html_e(
							'Campaign Price',
							'hsg-campaign-manager'
						); ?>

					</label>

				</th>

				<td>

					<input
						type="number"
						step="0.01"
						min="0"
						class="small-text"
						name="hsgcm_price"
						id="hsgcm_price"
						value="<?php echo esc_attr( $price ); ?>">

					<p class="description">

						Fast pris når kampagnen er aktiv.

					</p>

				</td>

			</tr>

			<tr>

				<th>

					<label for="hsgcm_start_date">

						<?php esc_html_e(
							'Start Date',
							'hsg-campaign-manager'
						); ?>

					</label>

				</th>

				<td>

					<input
						type="date"
						name="hsgcm_start_date"
						id="hsgcm_start_date"
						value="<?php echo esc_attr( $start ); ?>">

				</td>

			</tr>

			<tr>

				<th>

					<label for="hsgcm_end_date">

						<?php esc_html_e(
							'End Date',
							'hsg-campaign-manager'
						); ?>

					</label>

				</th>

				<td>

					<input
						type="date"
						name="hsgcm_end_date"
						id="hsgcm_end_date"
						value="<?php echo esc_attr( $end ); ?>">

				</td>

			</tr>

			<tr>

				<th>

					<?php esc_html_e(
						'Products',
						'hsg-campaign-manager'
					); ?>

				</th>

				<td>

					<p>

						<strong>Næste version:</strong>

						Her kommer WooCommerce's produktvælger.

					</p>

				</td>

			</tr>

		</table>

		<?php

	}

}
