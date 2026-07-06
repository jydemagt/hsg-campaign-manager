<?php
/**
 * Database Installer
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Database;

defined( 'ABSPATH' ) || exit;

class Installer {

	/**
	 * Installer pluginets databasetabeller.
	 *
	 * @return void
	 */
	public static function install(): void {

		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$table = $wpdb->prefix . 'hsg_campaigns';

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE {$table} (

			id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

			name VARCHAR(255) NOT NULL,

			status TINYINT(1) NOT NULL DEFAULT 1,

			coupon_code VARCHAR(100) DEFAULT NULL,

			campaign_type VARCHAR(50) NOT NULL DEFAULT 'fixed_price',

			fixed_price DECIMAL(10,2) DEFAULT NULL,

			bundle_qty INT DEFAULT NULL,

			bundle_price DECIMAL(10,2) DEFAULT NULL,

			start_date DATETIME DEFAULT NULL,

			end_date DATETIME DEFAULT NULL,

			priority INT NOT NULL DEFAULT 100,

			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

			updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
				ON UPDATE CURRENT_TIMESTAMP,

			PRIMARY KEY (id),

			KEY status (status),

			KEY coupon_code (coupon_code),

			KEY campaign_type (campaign_type)

		) {$charset_collate};";

		dbDelta( $sql );

		update_option( 'hsgcm_db_version', '1.0.0' );

	}
}
