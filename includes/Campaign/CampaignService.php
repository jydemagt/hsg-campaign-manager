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
	 * Save campaign.
	 *
	 * @param array $data Campaign data.
	 *
	 * @return array
	 */
	public function save( array $data ): array {

		$validation = $this->validate( $data );

		if ( true !== $validation['success'] ) {
			return $validation;
		}

		$id = absint( $data['id'] ?? 0 );

		if ( $id > 0 ) {

			$result = $this->repository->update( $id, $data );

			if ( ! $result ) {

				return array(
					'success' => false,
					'message' => __( 'Unable to update campaign.', 'hsg-campaign-manager' ),
				);

			}

			return array(
				'success' => true,
				'id'      => $id,
				'message' => __( 'Campaign updated.', 'hsg-campaign-manager' ),
			);

		}

		$new_id = $this->repository->create( $data );

		if ( is_wp_error( $new_id ) ) {

			return array(
				'success' => false,
				'message' => $new_id->get_error_message(),
			);

		}

		return array(
			'success' => true,
			'id'      => $new_id,
			'message' => __( 'Campaign created.', 'hsg-campaign-manager' ),
		);

	}

	/**
	 * Delete campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return array
	 */
	public function delete( int $id ): array {

		if ( ! $this->repository->delete( $id ) ) {

			return array(
				'success' => false,
				'message' => __( 'Unable to delete campaign.', 'hsg-campaign-manager' ),
			);

		}

		return array(
			'success' => true,
			'message' => __( 'Campaign deleted.', 'hsg-campaign-manager' ),
		);

	}

	/**
	 * Duplicate campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return array
	 */
	public function duplicate( int $id ): array {

		$new_id = $this->repository->duplicate( $id );

		if ( ! $new_id ) {

			return array(
				'success' => false,
				'message' => __( 'Unable to duplicate campaign.', 'hsg-campaign-manager' ),
			);

		}

		return array(
			'success' => true,
			'id'      => $new_id,
			'message' => __( 'Campaign duplicated.', 'hsg-campaign-manager' ),
		);

	}

	/**
	 * Validate campaign.
	 *
	 * @param array $data Campaign data.
	 *
	 * @return array
	 */
	private function validate( array $data ): array {

		$title = trim( $data['title'] ?? '' );

		if ( '' === $title ) {

			return array(
				'success' => false,
				'message' => __( 'Campaign name is required.', 'hsg-campaign-manager' ),
			);

		}

		if (
			isset( $data['price'] ) &&
			'' !== $data['price'] &&
			! is_numeric( $data['price'] )
		) {

			return array(
				'success' => false,
				'message' => __( 'Price must be numeric.', 'hsg-campaign-manager' ),
			);

		}

		$start = $data['start'] ?? '';
		$end   = $data['end'] ?? '';

		if (
			'' !== $start &&
			'' !== $end &&
			strtotime( $start ) > strtotime( $end )
		) {

			return array(
				'success' => false,
				'message' => __( 'Start date must be before end date.', 'hsg-campaign-manager' ),
			);

		}

		return array(
			'success' => true,
		);

	}

}
