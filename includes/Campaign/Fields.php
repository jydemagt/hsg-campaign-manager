<?php
/**
 * Campaign Fields
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class Fields {

	/**
	 * Returnerer alle felter der anvendes af kampagner.
	 *
	 * @return array
	 */
	public static function get_fields(): array {

		return array(

			'coupon' => array(
				'label' => __( 'Coupon code', 'hsg-campaign-manager' ),
				'type'  => 'text',
				'meta'  => '_hsgcm_coupon',
			),

			'fixed_price' => array(
				'label' => __( 'Fixed price', 'hsg-campaign-manager' ),
				'type'  => 'number',
				'meta'  => '_hsgcm_fixed_price',
			),

			'bundle_qty' => array(
				'label' => __( 'Bundle quantity', 'hsg-campaign-manager' ),
				'type'  => 'number',
				'meta'  => '_hsgcm_bundle_qty',
			),

			'bundle_price' => array(
				'label' => __( 'Bundle price', 'hsg-campaign-manager' ),
				'type'  => 'number',
				'meta'  => '_hsgcm_bundle_price',
			),

			'priority' => array(
				'label' => __( 'Priority', 'hsg-campaign-manager' ),
				'type'  => 'number',
				'meta'  => '_hsgcm_priority',
			),

			'start_date' => array(
				'label' => __( 'Start date', 'hsg-campaign-manager' ),
				'type'  => 'date',
				'meta'  => '_hsgcm_start',
			),

			'end_date' => array(
				'label' => __( 'End date', 'hsg-campaign-manager' ),
				'type'  => 'date',
				'meta'  => '_hsgcm_end',
			),

			'enabled' => array(
				'label' => __( 'Active campaign', 'hsg-campaign-manager' ),
				'type'  => 'checkbox',
				'meta'  => '_hsgcm_enabled',
			),

		);

	}

}
