<?php
/**
 * Campaign Save Handler
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class Save {

	public function __construct() {

		add_action(
			'save_post_hsg_campaign',
			array( $this, 'save' ),
			10,
			2
		);

	}

	/**
	 * Save campaign.
	 *
	 * @param int      $post_id
	 * @param \WP_Post $post
	 *
	 * @return void
	 */
	public function save( int $post_id, $post ): void {

		// Autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Revision
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		// Nonce
		if ( ! isset( $_POST['hsgcm_campaign_nonce'] ) ) {
			return;
		}

		if (
			! wp_verify_nonce(
				sanitize_text_field(
					wp_unslash( $_POST['hsgcm_campaign_nonce'] )
				),
				'hsgcm_campaign_save'
			)
		) {
			return;
		}

		// Rettigheder
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Kupon
		$coupon = '';

		if ( isset( $_POST['hsgcm_coupon'] ) ) {

			$coupon = strtoupper(
				sanitize_text_field(
					wp_unslash( $_POST['hsgcm_coupon'] )
				)
			);

		}

		update_post_meta(
			$post_id,
			'_hsgcm_coupon',
			$coupon
		);

		// Kampagnepris
		$price = 0;

		if ( isset( $_POST['hsgcm_price'] ) ) {

			$price = wc_format_decimal(
				wp_unslash( $_POST['hsgcm_price'] )
			);

		}

		update_post_meta(
			$post_id,
			'_hsgcm_price',
			$price
		);

	}

}
