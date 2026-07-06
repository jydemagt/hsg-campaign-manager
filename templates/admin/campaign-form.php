<?php
/**
 * Campaign Form View
 *
 * @package HSGCampaignManager
 */

defined( 'ABSPATH' ) || exit;

$campaign = $data['campaign'] ?? null;

$title = '';
$coupon = '';
$price = '';
$start = '';
$end = '';
$status = 'publish';

if ( $campaign ) {

	$title  = $campaign->post_title;
	$status = $campaign->post_status;

	$coupon = get_post_meta(
		$campaign->ID,
		'_hsgcm_coupon',
		true
	);

	$price = get_post_meta(
		$campaign->ID,
		'_hsgcm_price',
		true
	);

	$start = get_post_meta(
		$campaign->ID,
		'_hsgcm_start_date',
		true
	);

	$end = get_post_meta(
		$campaign->ID,
		'_hsgcm_end_date',
		true
	);

}

?>

<div class="hsgcm-form">

	<h2>

		<?php echo $campaign ? 'Edit Campaign' : 'New Campaign'; ?>

	</h2>

	<table class="form-table">

		<tr>

			<th>Campaign name</th>

			<td>

				<input
					type="text"
					class="regular-text"
					id="hsgcm-title"
					value="<?php echo esc_attr( $title ); ?>">

			</td>

		</tr>

		<tr>

			<th>Status</th>

			<td>

				<select id="hsgcm-status">

					<option
						value="publish"
						<?php selected( $status, 'publish' ); ?>>

						Active

					</option>

					<option
						value="draft"
						<?php selected( $status, 'draft' ); ?>>

						Draft

					</option>

				</select>

			</td>

		</tr>

		<tr>

			<th>Coupon</th>

			<td>

				<input
					type="text"
					class="regular-text"
					id="hsgcm-coupon"
					value="<?php echo esc_attr( $coupon ); ?>">

			</td>

		</tr>

		<tr>

			<th>Campaign price</th>

			<td>

				<input
					type="number"
					step="0.01"
					id="hsgcm-price"
					value="<?php echo esc_attr( $price ); ?>">

			</td>

		</tr>

		<tr>

			<th>Start date</th>

			<td>

				<input
					type="date"
					id="hsgcm-start"
					value="<?php echo esc_attr( $start ); ?>">

			</td>

		</tr>

		<tr>

			<th>End date</th>

			<td>

				<input
					type="date"
					id="hsgcm-end"
					value="<?php echo esc_attr( $end ); ?>">

			</td>

		</tr>

	</table>

	<p>

		<button
			class="button button-primary hsgcm-save-campaign">

			Save Campaign

		</button>

	</p>

</div>
