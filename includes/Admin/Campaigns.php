<?php
/**
 * Campaigns Controller
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

use HSGCM\Campaign\CampaignRepository;

defined( 'ABSPATH' ) || exit;

class Campaigns {

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
	 * Render campaigns page.
	 *
	 * @return void
	 */
	public function render(): void {

		$data = array(
			'campaigns' => $this->repository->all(),
			'total'     => $this->repository->count(),
		);

		$template = HSGCM_PATH . 'templates/admin/campaigns.php';

		if ( file_exists( $template ) ) {

			include $template;
			return;

		}

		echo '<div class="notice notice-error"><p>';
		echo esc_html__( 'Campaign template not found.', 'hsg-campaign-manager' );
		echo '</p></div>';

	}

}
