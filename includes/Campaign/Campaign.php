<?php
/**
 * Campaign Custom Post Type
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class Campaign {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ) );

	}

	/**
	 * Register Campaign post type.
	 *
	 * @return void
	 */
	public function register_post_type(): void {

		$labels = array(
			'name'               => __( 'Campaigns', 'hsg-campaign-manager' ),
			'singular_name'      => __( 'Campaign', 'hsg-campaign-manager' ),
			'add_new'            => __( 'Add Campaign', 'hsg-campaign-manager' ),
			'add_new_item'       => __( 'Add Campaign', 'hsg-campaign-manager' ),
			'edit_item'          => __( 'Edit Campaign', 'hsg-campaign-manager' ),
			'new_item'           => __( 'New Campaign', 'hsg-campaign-manager' ),
			'view_item'          => __( 'View Campaign', 'hsg-campaign-manager' ),
			'search_items'       => __( 'Search Campaigns', 'hsg-campaign-manager' ),
			'not_found'          => __( 'No campaigns found.', 'hsg-campaign-manager' ),
			'not_found_in_trash' => __( 'No campaigns found in Trash.', 'hsg-campaign-manager' ),
			'menu_name'          => __( 'Campaigns', 'hsg-campaign-manager' ),
		);

		register_post_type(
			'hsg_campaign',
			array(
				'labels'             => $labels,
				'public'             => false,
				'publicly_queryable' => false,
				'show_ui'            => true,
				'show_in_menu'       => 'hsg-campaign-manager',
				'menu_position'      => 56,
				'menu_icon'          => 'dashicons-megaphone',
				'supports'           => array(
					'title',
				),
				'has_archive'        => false,
				'hierarchical'       => false,
				'show_in_rest'       => false,
				'capability_type'    => 'post',
			)
		);

	}

}
