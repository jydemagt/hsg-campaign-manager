<?php
/**
 * Campaign Editor
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class Editor {

	public function __construct() {

		add_action(
			'add_meta_boxes',
			array( $this, 'register_meta_box' )
		);

	}

	/**
	 * Register meta box.
	 */
	public function register_meta_box(): void {

		add_meta_box(
			'hsgcm_campaign',
			__( 'Campaign Settings', 'hsg-campaign-manager' ),
			array( $this, 'render' ),
			'hsg_campaign',
			'normal',
			'high'
		);

	}

	/**
	 * Render editor.
	 */
	public function render( \WP_Post $post ): void {

		wp_nonce_field(
			'hsgcm_campaign_save',
			'hsgcm_campaign_nonce'
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

		?>

		<table class="form-table">

			<tr>

				<th>
					<label for="hsgcm_coupon">
						<?php esc_html_e(
							'Coupon',
							'hsg-campaign-manager'
						); ?>
					</label>
				</th>

				<td>

					<input
						type="text"
						name="hsgcm_coupon"
						id="hsgcm_coupon"
						value="<?php echo esc_attr( $coupon ); ?>"
						class="regular-text">

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
						name="hsgcm_price"
						id="hsgcm_price"
						value="<?php echo esc_attr( $price ); ?>">

				</td>

			</tr>

		</table>

		<?php

	}

}
