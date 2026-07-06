<?php
/**
 * Ajax Controller
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

use HSGCM\Campaign\CampaignRepository;
use HSGCM\Campaign\CampaignService;

defined( 'ABSPATH' ) || exit;

class AjaxController {

	/**
	 * Repository.
	 *
	 * @var CampaignRepository
	 */
	private CampaignRepository $repository;

	/**
	 * Service.
	 *
	 * @var CampaignService
	 */
	private CampaignService $service;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->repository = new CampaignRepository();
		$this->service    = new CampaignService();

		add_action(
			'wp_ajax_hsgcm_get_campaign',
			array( $this, 'get_campaign' )
		);

		add_action(
			'wp_ajax_hsgcm_save_campaign',
			array( $this, 'save_campaign' )
		);

		add_action(
			'wp_ajax_hsgcm_delete_campaign',
			array( $this, 'delete_campaign' )
		);

		add_action(
			'wp_ajax_hsgcm_duplicate_campaign',
			array( $this, 'duplicate_campaign' )
		);

	}

	/**
	 * Verify AJAX request.
	 */
	private function verify(): void {

		check_ajax_referer(
			'hsgcm_admin',
			'nonce'
		);

		if ( ! current_user_can( 'manage_woocommerce' ) ) {

			wp_send_json_error(
				array(
					'message' => 'Permission denied.',
				),
				403
			);

		}

	}

	/**
	 * Get campaign.
	 */
	public function get_campaign(): void {

		$this->verify();

		$id = absint( $_POST['id'] ?? 0 );

		$campaign = $this->repository->find( $id );

		if ( ! $campaign ) {

			wp_send_json_error(
				array(
					'message' => 'Campaign not found.',
				)
			);

		}

		wp_send_json_success(
			array(
				'id'      => $campaign->ID,
				'title'   => $campaign->post_title,
				'status'  => $campaign->post_status,
				'coupon'  => get_post_meta( $id, '_hsgcm_coupon', true ),
				'price'   => get_post_meta( $id, '_hsgcm_price', true ),
				'start'   => get_post_meta( $id, '_hsgcm_start_date', true ),
				'end'     => get_post_meta( $id, '_hsgcm_end_date', true ),
			)
		);

	}

	/**
	 * Save campaign.
	 */
	public function save_campaign(): void {

		$this->verify();

		$data = array(
			'title'  => sanitize_text_field( $_POST['title'] ?? '' ),
			'status' => sanitize_text_field( $_POST['status'] ?? 'draft' ),
			'coupon' => sanitize_text_field( $_POST['coupon'] ?? '' ),
			'price'  => wc_format_decimal( $_POST['price'] ?? '' ),
			'start'  => sanitize_text_field( $_POST['start'] ?? '' ),
			'end'    => sanitize_text_field( $_POST['end'] ?? '' ),
		);

		$id = absint( $_POST['id'] ?? 0 );

		if ( $id > 0 ) {

			$success = $this->service->update( $id, $data );

			if ( ! $success ) {

				wp_send_json_error(
					array(
						'message' => 'Unable to update campaign.',
					)
				);

			}

			wp_send_json_success(
				array(
					'id'      => $id,
					'message' => 'Campaign updated.',
				)
			);

		}

		$new_id = $this->service->create( $data );

		if ( is_wp_error( $new_id ) ) {

			wp_send_json_error(
				array(
					'message' => $new_id->get_error_message(),
				)
			);

		}

		wp_send_json_success(
			array(
				'id'      => $new_id,
				'message' => 'Campaign created.',
			)
		);

	}

	/**
	 * Delete campaign.
	 */
	public function delete_campaign(): void {

		$this->verify();

		$id = absint( $_POST['id'] ?? 0 );

		if ( ! $this->service->delete( $id ) ) {

			wp_send_json_error(
				array(
					'message' => 'Unable to delete campaign.',
				)
			);

		}

		wp_send_json_success(
			array(
				'message' => 'Campaign deleted.',
			)
		);

	}

	/**
	 * Duplicate campaign.
	 */
	public function duplicate_campaign(): void {

		$this->verify();

		$id = absint( $_POST['id'] ?? 0 );

		$new_id = $this->service->duplicate( $id );

		if ( ! $new_id ) {

			wp_send_json_error(
				array(
					'message' => 'Unable to duplicate campaign.',
				)
			);

		}

		wp_send_json_success(
			array(
				'id'      => $new_id,
				'message' => 'Campaign duplicated.',
			)
		);

	}

}
