<?php
/**
 * Campaign Form Controller
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

use HSGCM\Campaign\CampaignRepository;

defined( 'ABSPATH' ) || exit;

class CampaignForm {

	/**
	 * Repository.
	 *
	 * @var CampaignRepository
	 */
	private CampaignRepository $repository;

	public function __construct() {
		$this->repository = new CampaignRepository();
	}

	/**
	 * Render form.
	 *
	 * @param int|null $campaign_id Campaign ID.
	 *
	 * @return void
	 */
	public function render( ?int $campaign_id = null ): void {

		$campaign = null;

		if ( $campaign_id ) {
			$campaign = $this->repository->find( $campaign_id );
		}

		$data = array(
			'campaign' => $campaign,
		);

		$template = HSGCM_PATH . 'templates/admin/campaign-form.php';

		if ( file_exists( $template ) ) {
			include $template;
		}

	}
}
