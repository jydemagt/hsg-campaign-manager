<?php
/**
 * Statistics Controller
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

defined( 'ABSPATH' ) || exit;

class Statistics {

	/**
	 * Render statistics page.
	 *
	 * @return void
	 */
	public function render(): void {

		$template = HSGCM_PATH . 'templates/admin/statistics.php';

		if ( file_exists( $template ) ) {
			include $template;
			return;
		}

		echo '<h2>Statistics</h2>';
		echo '<p>Template mangler.</p>';

	}

}
