<?php
/**
 * Campaign Save Handler
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class Save {

	public function __construct() {
		add_action( 'save_post_hsg_campaign', array( $this, 'save' ) );
	}

	public function save( int $post_id ): void {

		// Nonce.
		if ( ! isset( $_POST['hsgcm_campaign_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce(
			sanitize_text_field( wp_unslash( $_POST['hsgcm_campaign_nonce'] ) ),
			'hsgcm_campaign_save'
		) ) {
			return;
		}

		// Autosave.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Rettigheder.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$fields = Fields::get_fields();

		foreach ( $fields as $field ) {

			$key = $field['meta'];

			switch ( $field['type'] ) {

				case 'checkbox':

					update_post_meta(
						$post_id,
						$key,
						isset( $_POST[ $key ] ) ? 1 : 0
					);

					break;

				case 'number':

					update_post_meta(
						$post_id,
						$key,
						wc_format_decimal(
							$_POST[ $key ] ?? ''
						)
					);

					break;

				default:

					update_post_meta(
						$post_id,
						$key,
						sanitize_text_field(
							$_POST[ $key ] ?? ''
						)
					);

			}

		}

	}

}
