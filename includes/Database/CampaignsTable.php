<?php
/**
 * Campaign Database Table
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Database;

defined( 'ABSPATH' ) || exit;

class CampaignsTable {

	/**
	 * Table name.
	 *
	 * @return string
	 */
	private static function table(): string {

		global $wpdb;

		return $wpdb->prefix . 'hsg_campaigns';

	}

	/**
	 * Find campaign by id.
	 *
	 * @param int $id Campaign id.
	 *
	 * @return object|null
	 */
	public static function find( int $id ) {

		global $wpdb;

		return $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM " . self::table() . " WHERE id = %d",
				$id
			)
		);

	}

	/**
	 * Return all campaigns.
	 *
	 * @return array
	 */
	public static function all(): array {

		global $wpdb;

		return $wpdb->get_results(
			"SELECT * FROM " . self::table() . " ORDER BY priority ASC, name ASC"
		);

	}

	/**
	 * Return active campaigns.
	 *
	 * @return array
	 */
	public static function active(): array {

		global $wpdb;

		return $wpdb->get_results(
			"SELECT *
			 FROM " . self::table() . "
			 WHERE status = 1
			 ORDER BY priority ASC"
		);

	}

	/**
	 * Delete campaign.
	 *
	 * @param int $id Campaign id.
	 *
	 * @return bool
	 */
	public static function delete( int $id ): bool {

		global $wpdb;

		return (bool) $wpdb->delete(
			self::table(),
			array(
				'id' => $id,
			),
			array(
				'%d',
			)
		);

	}

	/**
	 * Insert campaign.
	 *
	 * @param array $data Campaign data.
	 *
	 * @return int|false
	 */
	public static function insert( array $data ) {

		global $wpdb;

		$result = $wpdb->insert(
			self::table(),
			$data
		);

		if ( ! $result ) {
			return false;
		}

		return (int) $wpdb->insert_id;

	}

	/**
	 * Update campaign.
	 *
	 * @param int   $id Campaign id.
	 * @param array $data Campaign data.
	 *
	 * @return bool
	 */
	public static function update( int $id, array $data ): bool {

		global $wpdb;

		return false !== $wpdb->update(
			self::table(),
			$data,
			array(
				'id' => $id,
			)
		);

	}

}
