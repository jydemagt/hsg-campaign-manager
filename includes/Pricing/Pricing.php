<?php
/**
 * Pricing Engine
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Pricing;

defined( 'ABSPATH' ) || exit;

class Pricing {

	public function __construct() {

		add_action(
			'woocommerce_before_calculate_totals',
			array( $this, 'apply_campaign_price' ),
			100
		);

	}

	/**
	 * Apply campaign prices.
	 *
	 * @param \WC_Cart $cart WooCommerce cart.
	 */
	public function apply_campaign_price( $cart ): void {

		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			return;
		}

		if ( ! $cart instanceof \WC_Cart ) {
			return;
		}

		if ( did_action( 'woocommerce_before_calculate_totals' ) > 1 ) {
			return;
		}

		// Hent anvendte kuponer.
		$applied_coupons = array_map(
			'strtoupper',
			$cart->get_applied_coupons()
		);

		if ( empty( $applied_coupons ) ) {
			return;
		}

		// Hent alle aktive kampagner.
		$campaigns = get_posts(
			array(
				'post_type'      => 'hsg_campaign',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			)
		);

		if ( empty( $campaigns ) ) {
			return;
		}

		foreach ( $campaigns as $campaign ) {

			$coupon = strtoupper(
				get_post_meta(
					$campaign->ID,
					'_hsgcm_coupon',
					true
				)
			);

			if ( empty( $coupon ) ) {
				continue;
			}

			if ( ! in_array( $coupon, $applied_coupons, true ) ) {
				continue;
			}

			$product_id = absint(
				get_post_meta(
					$campaign->ID,
					'_hsgcm_product_id',
					true
				)
			);

			$price = get_post_meta(
				$campaign->ID,
				'_hsgcm_price',
				true
			);

			if ( $product_id === 0 ) {
				continue;
			}

			foreach ( $cart->get_cart() as $cart_item ) {

				if ( $cart_item['product_id'] !== $product_id ) {
					continue;
				}

				$cart_item['data']->set_price(
					(float) $price
				);

			}

		}

	}

}
