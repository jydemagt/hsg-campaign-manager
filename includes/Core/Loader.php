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
	 * Registrer autoloader.
	 */
	public static function register(): void {

		spl_autoload_register( array( __CLASS__, 'autoload' ) );

	}

	/**
	 * Automatisk indlæsning af HSGCM-klasser.
	 *
	 * @param string $class Klassenavn.
	 */
	private static function autoload( string $class ): void {

		// Kun vores namespace.
		if ( strpos( $class, 'HSGCM\\' ) !== 0 ) {
			return;
		}

		// Fjern namespace.
		$class = str_replace( 'HSGCM\\', '', $class );

		$parts = explode( '\\', $class );

		if ( count( $parts ) < 2 ) {
			return;
		}

		$folder = $parts[0];
		$file   = $parts[1];

		$path = HSGCM_PATH .
			'includes/' .
			$folder .
			'/' .
			$file .
			'.php';

		if ( file_exists( $path ) ) {
			require_once $path;
		}

	}

}
