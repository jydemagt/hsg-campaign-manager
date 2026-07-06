<?php
/**
 * Ajax Controller
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

use HSGCM\Campaign\CampaignRepository;

defined( 'ABSPATH' ) || exit;

class Ajax {

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

	}

	/**
	 * Return campaign as JSON.
	 *
	 * @return void
	 */
	public function get_campaign(): void {

		check_ajax_referer(
			'hsgcm_admin',
			'nonce'
		);

		$id = isset( $_POST['id'] )
			? absint( $_POST['id'] )
			: 0;

		$campaign = $this->repository->find( $id );

		if ( ! $campaign ) {

			wp_send_json_error();

		}

		wp_send_json_success(

			array(

				'id' => $campaign->ID,

				'title' => $campaign->post_title,

				'status' => $campaign->post_status,

				'coupon' => get_post_meta(
					$id,
					'_hsgcm_coupon',
					true
				),

				'price' => get_post_meta(
					$id,
					'_hsgcm_price',
					true
				),

				'start' => get_post_meta(
					$id,
					'_hsgcm_start_date',
					true
				),

				'end' => get_post_meta(
					$id,
					'_hsgcm_end_date',
					true
				)

			)

		);

	}

}
