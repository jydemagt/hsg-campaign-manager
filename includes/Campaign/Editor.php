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

		add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
		add_action( 'save_post_hsg_campaign', array( $this, 'save' ) );

	}

	/**
	 * Register meta box.
	 */
	public function register_meta_boxes(): void {

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
	public function render( $post ): void {

		wp_nonce_field( 'hsgcm_campaign_save', 'hsgcm_campaign_nonce' );

		$coupon = get_post_meta( $post->ID, '_hsgcm_coupon', true );
		$price  = get_post_meta( $post->ID, '_hsgcm_price', true );

		?>

		<table class="form-table">

			<tr>

				<th>
					<label for="hsgcm_coupon">
						<?php esc_html_e( 'Coupon Code', 'hsg-campaign-manager' ); ?>
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
						<?php esc_html_e( 'Campaign Price', 'hsg-campaign-manager' ); ?>
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

	/**
	 * Save campaign.
	 */
	public function save( int $post_id ): void {

		if ( ! isset( $_POST['hsgcm_campaign_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['hsgcm_campaign_nonce'], 'hsgcm_campaign_save' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		update_post_meta(
			$post_id,
			'_hsgcm_coupon',
			sanitize_text_field( $_POST['hsgcm_coupon'] ?? '' )
		);

		update_post_meta(
			$post_id,
			'_hsgcm_price',
			wc_format_decimal( $_POST['hsgcm_price'] ?? 0 )
		);

	}

}
