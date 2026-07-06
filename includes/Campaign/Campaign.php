<?php
/**
 * Campaign Module
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

		add_action( 'init', array( $this, 'register_campaign_post_type' ) );

	}

	/**
	 * Register Campaign Custom Post Type.
	 */
	public function register_campaign_post_type(): void {

		register_post_type(
			'hsg_campaign',
			array(
				'labels' => array(
					'name'          => __( 'Campaigns', 'hsg-campaign-manager' ),
					'singular_name' => __( 'Campaign', 'hsg-campaign-manager' ),
				),
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => 'hsg-campaign-manager',
				'supports'        => array( 'title' ),
				'menu_icon'       => 'dashicons-tickets-alt',
				'capability_type' => 'post',
			)
		);

	}

}
