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
	 * Campaign form.
	 *
	 * @var CampaignForm
	 */
	private CampaignForm $form;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->repository = new CampaignRepository();
		$this->form       = new CampaignForm();

	}

	/**
	 * Render page.
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
		}

		echo '<hr style="margin:40px 0;">';

		$this->form->render();

	}

}
