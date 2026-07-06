<?php
/**
 * Autoloader
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Core;

defined( 'ABSPATH' ) || exit;

class Loader {

	/**
	 * Register autoloader.
	 */
	public static function register(): void {

		spl_autoload_register( array( __CLASS__, 'autoload' ) );

	}

	/**
	 * Autoload HSGCM classes.
	 *
	 * @param string $class Fully qualified class name.
	 */
	private static function autoload( string $class ): void {

		// Kun vores egne klasser.
		if ( strpos( $class, 'HSGCM\\' ) !== 0 ) {
			return;
		}

		// Fjern namespace.
		$class = substr( $class, strlen( 'HSGCM\\' ) );

		// Namespace -> mappe.
		$class = str_replace( '\\', DIRECTORY_SEPARATOR, $class );

		$path = HSGCM_PATH . 'includes/' . $class . '.php';

		if ( file_exists( $path ) ) {
			require_once $path;
		}

	}

}
