<?php
/**
 * Campaign Service
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class CampaignService {

	/**
	 * Repository.
	 *
	 * @var CampaignRepository
	 */
	private CampaignRepository $repository;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->repository = new CampaignRepository();

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
				'post_title'  => sanitize_text_field(
					$data['title'] ?? ''
				),
			)
		);

		if ( is_wp_error( $post_id ) ) {
			return $post_id;
		}

		$this->save_meta( $post_id, $data );

		return $post_id;

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
				'post_title'  => sanitize_text_field(
					$data['title'] ?? ''
				),
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
	 * Delete campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return bool
	 */
	public function delete( int $id ): bool {

		return $this->repository->delete( $id );

	}

	/**
	 * Duplicate campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return int|false
	 */
	public function duplicate( int $id ) {

		return $this->repository->duplicate( $id );

	}

	/**
	 * Save campaign meta.
	 *
	 * @param int   $post_id Campaign ID.
	 * @param array $data Campaign data.
	 *
	 * @return void
	 */
	private function save_meta(
		int $post_id,
		array $data
	): void {

		$fields = array(

			'_hsgcm_coupon'      => sanitize_text_field(
				$data['coupon'] ?? ''
			),

			'_hsgcm_price'       => wc_format_decimal(
				$data['price'] ?? ''
			),

			'_hsgcm_start_date'  => sanitize_text_field(
				$data['start'] ?? ''
			),

			'_hsgcm_end_date'    => sanitize_text_field(
				$data['end'] ?? ''
			),

		);

		foreach ( $fields as $meta_key => $value ) {

			update_post_meta(
				$post_id,
				$meta_key,
				$value
			);

		}

	}

}
