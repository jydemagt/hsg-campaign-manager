<?php
/**
 * Campaign Save Handler
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class Save {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action(
			'save_post_hsg_campaign',
			array( $this, 'save' )
		);

	}

	/**
	 * Save campaign.
	 *
	 * @param int $post_id
	 *
	 * @return void
	 */
	public function save( int $post_id ): void {

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

		// Autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Revision
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		// Rettigheder
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		/*
		 * Coupon
		 */

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

		/*
		 * Campaign Price
		 */

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

		/*
		 * Product ID
		 */

		$product_id = 0;

		if ( isset( $_POST['hsgcm_product_id'] ) ) {

			$product_id = absint(
				wp_unslash( $_POST['hsgcm_product_id'] )
			);

		}

		update_post_meta(
			$post_id,
			'_hsgcm_product_id',
			$product_id
		);

	}

}
