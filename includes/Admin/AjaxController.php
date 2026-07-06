<?php
/**
 * Ajax Controller
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

use HSGCM\Campaign\CampaignRepository;

defined( 'ABSPATH' ) || exit;

class AjaxController {

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
	 * Verify request.
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

			wp_send_json_error();

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

		wp_send_json_success(
			array(
				'message' => 'Kommer i Sprint 3.2',
			)
		);

	}

	/**
	 * Delete campaign.
	 */
	public function delete_campaign(): void {

		$this->verify();

		wp_send_json_success(
			array(
				'message' => 'Kommer i Sprint 3.4',
			)
		);

	}

	/**
	 * Duplicate campaign.
	 */
	public function duplicate_campaign(): void {

		$this->verify();

		wp_send_json_success(
			array(
				'message' => 'Kommer i Sprint 3.5',
			)
		);

	}

}
