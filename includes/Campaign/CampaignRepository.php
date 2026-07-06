<?php
/**
 * Campaign Repository
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class CampaignRepository {

	/**
	 * Return all campaigns.
	 *
	 * @return array
	 */
	public function all(): array {

		return get_posts(
			array(
				'post_type'      => 'hsg_campaign',
				'post_status'    => array(
					'publish',
					'draft',
				),
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);

	}

	/**
	 * Find campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return \WP_Post|null
	 */
	public function find( int $id ): ?\WP_Post {

		$post = get_post( $id );

		if ( ! $post ) {
			return null;
		}

		if ( 'hsg_campaign' !== $post->post_type ) {
			return null;
		}

		return $post;

	}

	/**
	 * Count campaigns.
	 *
	 * @return int
	 */
	public function count(): int {

		$count = wp_count_posts( 'hsg_campaign' );

		return (int) ( $count->publish ?? 0 );

	}

	/**
	 * Create campaign.
	 *
	 * @param array $data Campaign data.
	 *
	 * @return int|\WP_Error
	 */
	public function create( array $data ) {

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'hsg_campaign',
				'post_status' => $data['status'] ?? 'draft',
				'post_title'  => $data['title'] ?? '',
			),
			true
		);

		if ( is_wp_error( $post_id ) ) {
			return $post_id;
		}

		$this->save_meta( $post_id, $data );

		return (int) $post_id;

	}

	/**
	 * Update campaign.
	 *
	 * @param int   $id Campaign ID.
	 * @param array $data Campaign data.
	 *
	 * @return bool
	 */
	public function update( int $id, array $data ): bool {

		$result = wp_update_post(
			array(
				'ID'          => $id,
				'post_title'  => $data['title'] ?? '',
				'post_status' => $data['status'] ?? 'draft',
			),
			true
		);

		if ( is_wp_error( $result ) ) {
			return false;
		}

		$this->save_meta( $id, $data );

		return true;

	}

	/**
	 * Save campaign meta.
	 *
	 * @param int   $post_id Campaign ID.
	 * @param array $data Campaign data.
	 */
	private function save_meta( int $post_id, array $data ): void {

		update_post_meta(
			$post_id,
			'_hsgcm_coupon',
			sanitize_text_field( $data['coupon'] ?? '' )
		);

		update_post_meta(
			$post_id,
			'_hsgcm_price',
			wc_format_decimal( $data['price'] ?? '' )
		);

		update_post_meta(
			$post_id,
			'_hsgcm_start_date',
			sanitize_text_field( $data['start'] ?? '' )
		);

		update_post_meta(
			$post_id,
			'_hsgcm_end_date',
			sanitize_text_field( $data['end'] ?? '' )
		);

	}

	/**
	 * Delete campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return bool
	 */
	public function delete( int $id ): bool {

		return false !== wp_delete_post( $id, true );

	}

	/**
	 * Duplicate campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return int|false
	 */
	public function duplicate( int $id ) {

		$campaign = $this->find( $id );

		if ( ! $campaign ) {
			return false;
		}

		$new_id = $this->create(
			array(
				'title'  => $campaign->post_title . ' (Copy)',
				'status' => 'draft',
				'coupon' => get_post_meta( $id, '_hsgcm_coupon', true ),
				'price'  => get_post_meta( $id, '_hsgcm_price', true ),
				'start'  => get_post_meta( $id, '_hsgcm_start_date', true ),
				'end'    => get_post_meta( $id, '_hsgcm_end_date', true ),
			)
		);

		if ( is_wp_error( $new_id ) ) {
			return false;
		}

		return (int) $new_id;

	}

}
