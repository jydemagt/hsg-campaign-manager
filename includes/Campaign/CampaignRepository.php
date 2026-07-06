<?php
/**
 * Campaign Repository
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class CampaignRepository {

	/**
	 * Return all campaigns.
	 *
	 * @return array
	 */
	public function all(): array {

		return get_posts(
			array(
				'post_type'      => 'hsg_campaign',
				'post_status'    => array(
					'publish',
					'draft',
				),
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);

	}

	/**
	 * Find campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return \WP_Post|null
	 */
	public function find( int $id ) {

		$post = get_post( $id );

		if ( ! $post ) {
			return null;
		}

		if ( 'hsg_campaign' !== $post->post_type ) {
			return null;
		}

		return $post;

	}

	/**
	 * Count campaigns.
	 *
	 * @return int
	 */
	public function count(): int {

		$count = wp_count_posts( 'hsg_campaign' );

		return isset( $count->publish )
			? (int) $count->publish
			: 0;

	}

	/**
	 * Delete campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return bool
	 */
	public function delete( int $id ): bool {

		return false !== wp_delete_post( $id, true );

	}

	/**
	 * Duplicate campaign.
	 *
	 * @param int $id Campaign ID.
	 *
	 * @return int|false
	 */
	public function duplicate( int $id ) {

		$campaign = $this->find( $id );

		if ( ! $campaign ) {
			return false;
		}

		$new_id = wp_insert_post(
			array(
				'post_type'   => 'hsg_campaign',
				'post_status' => 'draft',
				'post_title'  => $campaign->post_title . ' (Copy)',
			)
		);

		if ( is_wp_error( $new_id ) ) {
			return false;
		}

		$meta = get_post_meta( $id );

		foreach ( $meta as $key => $values ) {

			foreach ( $values as $value ) {

				add_post_meta(
					$new_id,
					$key,
					maybe_unserialize( $value )
				);

			}

		}

		return (int) $new_id;

	}

}
