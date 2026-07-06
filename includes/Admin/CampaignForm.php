<?php
/**
 * Campaign Form View
 *
 * @package HSGCampaignManager
 */

defined( 'ABSPATH' ) || exit;

$campaign = $data['campaign'] ?? null;

$id     = '';
$title  = '';
$status = 'draft';
$coupon = '';
$price  = '';
$start  = '';
$end    = '';

if ( $campaign ) {

	$id     = $campaign->ID;
	$title  = $campaign->post_title;
	$status = $campaign->post_status;

	$coupon = get_post_meta(
		$id,
		'_hsgcm_coupon',
		true
	);

	$price = get_post_meta(
		$id,
		'_hsgcm_price',
		true
	);

	$start = get_post_meta(
		$id,
		'_hsgcm_start_date',
		true
	);

	$end = get_post_meta(
		$id,
		'_hsgcm_end_date',
		true
	);

}

?>

<div class="hsgcm-form">

	<h2 id="hsgcm-form-title">

		<?php echo $campaign ? 'Edit Campaign' : 'New Campaign'; ?>

	</h2>

	<form id="hsgcm-campaign-form">

		<?php wp_nonce_field( 'hsgcm_admin', 'hsgcm_nonce' ); ?>

		<input
			type="hidden"
			id="hsgcm-id"
			name="id"
			value="<?php echo esc_attr( $id ); ?>">

		<table class="form-table">

			<tr>

				<th>

					<label for="hsgcm-title">

						Campaign Name

					</label>

				</th>

				<td>

					<input
						type="text"
						class="regular-text"
						id="hsgcm-title"
						name="title"
						value="<?php echo esc_attr( $title ); ?>"
						required>

				</td>

			</tr>

			<tr>

				<th>

					<label for="hsgcm-status">

						Status

					</label>

				</th>

				<td>

					<select
						id="hsgcm-status"
						name="status">

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

				<th>

					<label for="hsgcm-coupon">

						Coupon

					</label>

				</th>

				<td>

					<input
						type="text"
						class="regular-text"
						id="hsgcm-coupon"
						name="coupon"
						value="<?php echo esc_attr( $coupon ); ?>">

				</td>

			</tr>

			<tr>

				<th>

					<label for="hsgcm-price">

						Campaign Price

					</label>

				</th>

				<td>

					<input
						type="number"
						step="0.01"
						id="hsgcm-price"
						name="price"
						value="<?php echo esc_attr( $price ); ?>">

				</td>

			</tr>

			<tr>

				<th>

					<label for="hsgcm-start">

						Start Date

					</label>

				</th>

				<td>

					<input
						type="date"
						id="hsgcm-start"
						name="start"
						value="<?php echo esc_attr( $start ); ?>">

				</td>

			</tr>

			<tr>

				<th>

					<label for="hsgcm-end">

						End Date

					</label>

				</th>

				<td>

					<input
						type="date"
						id="hsgcm-end"
						name="end"
						value="<?php echo esc_attr( $end ); ?>">

				</td>

			</tr>

		</table>

		<p>

			<button
				type="submit"
				class="button button-primary button-large"
				id="hsgcm-save">

				Save Campaign

			</button>

			<button
				type="button"
				class="button"
				id="hsgcm-reset">

				New Campaign

			</button>

		</p>

	</form>

</div>
