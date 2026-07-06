<?php
/**
 * Settings Controller
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

defined( 'ABSPATH' ) || exit;

class Settings {

	/**
	 * Render settings page.
	 *
	 * @return void
	 */
	public function render(): void {

		$template = HSGCM_PATH . 'templates/admin/settings.php';

		if ( file_exists( $template ) ) {
			include $template;
			return;
		}

		echo '<h2>Settings</h2>';
		echo '<p>Template mangler.</p>';

	}

}
