<?php
/**
 * Class Loader
 *
 * @package HSGCampaignManager
 */

defined( 'ABSPATH' ) || exit;

class HSGCM_Loader {

	/**
	 * Register autoloader.
	 *
	 * @return void
	 */
	public static function register() {
		spl_autoload_register( array( __CLASS__, 'autoload' ) );
	}

	/**
	 * Autoload HSGCM classes.
	 *
	 * @param string $class Class name.
	 * @return void
	 */
	public static function autoload( $class ) {

		// Kun vores egne klasser.
		if ( strpos( $class, 'HSGCM_' ) !== 0 ) {
			return;
		}

		// Fjern præfiks.
		$class = str_replace( 'HSGCM_', '', $class );

		// Konverter til filnavn.
		$file = 'class-' . strtolower( str_replace( '_', '-', $class ) ) . '.php';

		// Mulige placeringer.
		$locations = array(
			HSGCM_PLUGIN_PATH . 'includes/' . $file,
			HSGCM_PLUGIN_PATH . 'admin/' . $file,
			HSGCM_PLUGIN_PATH . 'includes/modules/' . strtolower( $class ) . '/' . $file,
		);

		foreach ( $locations as $path ) {
			if ( file_exists( $path ) ) {
				require_once $path;
				return;
			}
		}
	}
}
