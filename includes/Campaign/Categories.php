<?php
/**
 * Campaign Categories
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class Categories {

	/**
	 * Gem kategorier.
	 *
	 * @param int   $post_id
	 * @param array $categories
	 */
	public static function save( int $post_id, array $categories ): void {

		$categories = array_map( 'absint', $categories );

		update_post_meta(
			$post_id,
			'_hsgcm_categories',
			$categories
		);

	}

	/**
	 * Hent kategorier.
	 *
	 * @param int $post_id
	 *
	 * @return array
	 */
	public static function get( int $post_id ): array {

		$categories = get_post_meta(
			$post_id,
			'_hsgcm_categories',
			true
		);

		if ( ! is_array( $categories ) ) {
			return array();
		}

		return array_map( 'absint', $categories );

	}

	/**
	 * Kontroller om produktets kategorier matcher kampagnen.
	 *
	 * @param int $campaign_id
	 * @param int $product_id
	 *
	 * @return bool
	 */
	public static function has_product_category(
		int $campaign_id,
		int $product_id
	): bool {

		$campaign_categories = self::get( $campaign_id );

		if ( empty( $campaign_categories ) ) {
			return false;
		}

		$product_categories = wc_get_product_term_ids(
			$product_id,
			'product_cat'
		);

		foreach ( $product_categories as $category ) {

			if ( in_array( $category, $campaign_categories, true ) ) {
				return true;
			}

		}

		return false;

	}

}
