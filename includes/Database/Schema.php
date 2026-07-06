<?php
/**
 * Database Schema
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Database;

defined( 'ABSPATH' ) || exit;

class Schema {

	/**
	 * Return all CREATE TABLE statements.
	 *
	 * @return array
	 */
	public static function get_tables(): array {

		global $wpdb;

		$charset = $wpdb->get_charset_collate();

		return array(

			/*
			 * Campaigns
			 */
			$wpdb->prefix . 'hsg_campaigns' => "

				CREATE TABLE {$wpdb->prefix}hsg_campaigns (

					id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

					name VARCHAR(255) NOT NULL,

					status TINYINT(1) NOT NULL DEFAULT 1,

					type VARCHAR(50) NOT NULL DEFAULT 'fixed_price',

					coupon_code VARCHAR(100) NULL,

					fixed_price DECIMAL(10,2) NULL,

					bundle_qty INT NULL,

					bundle_price DECIMAL(10,2) NULL,

					start_date DATETIME NULL,

					end_date DATETIME NULL,

					priority INT NOT NULL DEFAULT 100,

					created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

					updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
						ON UPDATE CURRENT_TIMESTAMP,

					PRIMARY KEY (id),

					KEY status (status),

					KEY coupon_code (coupon_code),

					KEY type (type)

				) {$charset}

			",

			/*
			 * Campaign Products
			 */
			$wpdb->prefix . 'hsg_campaign_products' => "

				CREATE TABLE {$wpdb->prefix}hsg_campaign_products (

					campaign_id BIGINT UNSIGNED NOT NULL,

					product_id BIGINT UNSIGNED NOT NULL,

					PRIMARY KEY (campaign_id, product_id),

					KEY product_id (product_id)

				) {$charset}

			",

			/*
			 * Campaign Categories
			 */
			$wpdb->prefix . 'hsg_campaign_categories' => "

				CREATE TABLE {$wpdb->prefix}hsg_campaign_categories (

					campaign_id BIGINT UNSIGNED NOT NULL,

					category_id BIGINT UNSIGNED NOT NULL,

					PRIMARY KEY (campaign_id, category_id),

					KEY category_id (category_id)

				) {$charset}

			",

			/*
			 * Campaign Customers
			 */
			$wpdb->prefix . 'hsg_campaign_customers' => "

				CREATE TABLE {$wpdb->prefix}hsg_campaign_customers (

					campaign_id BIGINT UNSIGNED NOT NULL,

					customer_id BIGINT UNSIGNED NOT NULL,

					PRIMARY KEY (campaign_id, customer_id),

					KEY customer_id (customer_id)

				) {$charset}

			",

			/*
			 * Campaign Usage
			 */
			$wpdb->prefix . 'hsg_campaign_usage' => "

				CREATE TABLE {$wpdb->prefix}hsg_campaign_usage (

					id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

					campaign_id BIGINT UNSIGNED NOT NULL,

					order_id BIGINT UNSIGNED NOT NULL,

					customer_id BIGINT UNSIGNED NULL,

					saving DECIMAL(10,2) DEFAULT 0,

					created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

					PRIMARY KEY (id),

					KEY campaign_id (campaign_id),

					KEY order_id (order_id)

				) {$charset}

			"

		);

	}

}
