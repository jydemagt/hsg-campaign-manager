<?php
/**
 * Campaigns View
 *
 * @package HSGCampaignManager
 */

defined( 'ABSPATH' ) || exit;

$campaigns = $data['campaigns'] ?? array();
$total     = $data['total'] ?? 0;

?>

<div class="hsgcm-header">

	<div>

		<h2><?php esc_html_e( 'Campaigns', 'hsg-campaign-manager' ); ?></h2>

		<p>

			<?php
			printf(
				esc_html__( '%d campaign(s)', 'hsg-campaign-manager' ),
				(int) $total
			);
			?>

		</p>

	</div>

	<div>

		<a class="button button-primary hsgcm-new-campaign"
			href="<?php echo esc_url( admin_url( 'post-new.php?post_type=hsg_campaign' ) ); ?>">

			➕ <?php esc_html_e( 'New Campaign', 'hsg-campaign-manager' ); ?>

		</a>

	</div>

</div>

<p>

	<input
		type="search"
		id="hsgcm-search"
		class="regular-text"
		placeholder="<?php esc_attr_e( 'Search campaigns…', 'hsg-campaign-manager' ); ?>">

</p>

<table class="widefat striped hsgcm-table">

	<thead>

	<tr>

		<th width="60">
			<?php esc_html_e( 'Status', 'hsg-campaign-manager' ); ?>
		</th>

		<th>
			<?php esc_html_e( 'Campaign', 'hsg-campaign-manager' ); ?>
		</th>

		<th width="140">
			<?php esc_html_e( 'Coupon', 'hsg-campaign-manager' ); ?>
		</th>

		<th width="120">
			<?php esc_html_e( 'Price', 'hsg-campaign-manager' ); ?>
		</th>

		<th width="220">
			<?php esc_html_e( 'Actions', 'hsg-campaign-manager' ); ?>
		</th>

	</tr>

	</thead>

	<tbody>

	<?php if ( empty( $campaigns ) ) : ?>

		<tr>

			<td colspan="5">

				<?php esc_html_e(
					'No campaigns found.',
					'hsg-campaign-manager'
				); ?>

			</td>

		</tr>

	<?php else : ?>

		<?php foreach ( $campaigns as $campaign ) : ?>

			<?php

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

			?>

			<tr>

				<td>

					<?php
					echo $campaign->post_status === 'publish'
						? '🟢'
						: '🟡';
					?>

				</td>

				<td>

					<strong>

						<?php echo esc_html( $campaign->post_title ); ?>

						</strong>

				</td>

				<td>

					<?php echo esc_html( $coupon ); ?>

				</td>

				<td>

					<?php

					if ( '' !== $price ) {

						echo wp_kses_post(
							wc_price( (float) $price )
						);

					} else {

						echo '&mdash;';

					}

					?>

				</td>

				<td>

					<a
						class="button button-small hsgcm-edit-campaign"
						href="<?php echo esc_url(
							admin_url(
								'post.php?post=' .
								$campaign->ID .
								'&action=edit'
							)
						); ?>">

						<?php esc_html_e( 'Edit', 'hsg-campaign-manager' ); ?>

					</a>

					<a
						class="button button-small"
						href="#">

						<?php esc_html_e( 'Duplicate', 'hsg-campaign-manager' ); ?>

					</a>

					<a
						class="button button-small button-link-delete"
						href="#">

						<?php esc_html_e( 'Delete', 'hsg-campaign-manager' ); ?>

					</a>

				</td>

			</tr>

		<?php endforeach; ?>

	<?php endif; ?>

	</tbody>

</table>
