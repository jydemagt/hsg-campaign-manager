<?php
/**
 * Campaign Products
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class Products {

	/**
	 * Gem valgte produkter.
	 *
	 * @param int   $post_id Post ID.
	 * @param array $products Produkt ID'er.
	 *
	 * @return void
	 */
	public static function save( int $post_id, array $products ): void {

		$products = array_map( 'absint', $products );

		update_post_meta(
			$post_id,
			'_hsgcm_products',
			$products
		);

	}

	/**
	 * Hent produkter.
	 *
	 * @param int $post_id
	 *
	 * @return array
	 */
	public static function get( int $post_id ): array {

		$products = get_post_meta(
			$post_id,
			'_hsgcm_products',
			true
		);

		if ( ! is_array( $products ) ) {
			return array();
		}

		return array_map( 'absint', $products );

	}

	/**
	 * Er produkt omfattet af kampagnen?
	 *
	 * @param int $campaign_id
	 * @param int $product_id
	 *
	 * @return bool
	 */
	public static function has_product(
		int $campaign_id,
		int $product_id
	): bool {

		$products = self::get( $campaign_id );

		return in_array(
			$product_id,
			$products,
			true
		);

	}

}
