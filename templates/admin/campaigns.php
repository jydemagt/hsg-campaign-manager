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

		<h2>Campaigns</h2>

		<p><?php echo esc_html( $total ); ?> campaign(s)</p>

	</div>

	<div>

		<a class="button button-primary">

			➕ New Campaign

		</a>

	</div>

</div>

<?php if ( empty( $campaigns ) ) : ?>

	<div class="hsgcm-empty">

		<h3>No campaigns yet</h3>

		<p>Create your first campaign.</p>

	</div>

<?php else : ?>

	<div class="hsgcm-campaign-grid">

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

		?>

		<div class="hsgcm-campaign-card">

			<div class="hsgcm-card-header">

				<h3>

					<?php echo esc_html( $campaign->post_title ); ?>

				</h3>

				<span class="hsgcm-status">

					<?php
					echo $campaign->post_status === 'publish'
						? '🟢 Active'
						: '🟡 Draft';
					?>

				</span>

			</div>

			<div class="hsgcm-card-body">

				<p>

					<strong>Price:</strong>

					<?php

					if ( $price ) {

						echo wp_kses_post(
							wc_price( (float) $price )
						);

					} else {

						echo '—';

					}

					?>

				</p>

				<p>

					<strong>Coupon:</strong>

					<?php echo esc_html( $coupon ?: '—' ); ?>

				</p>

				<p>

					<strong>Period:</strong>

					<?php

					echo esc_html(
						$start ?: 'No start'
					);

					echo ' → ';

					echo esc_html(
						$end ?: 'No end'
					);

					?>

				</p>

			</div>

			<div class="hsgcm-card-footer">

				<a class="button button-small"

					href="<?php echo esc_url(
						admin_url(
							'post.php?post=' .
							$campaign->ID .
							'&action=edit'
						)
					); ?>">

					Edit

				</a>

				<a class="button button-small">

					Duplicate

				</a>

				<a class="button button-small button-link-delete">

					Delete

				</a>

			</div>

		</div>

	<?php endforeach; ?>

	</div>

<?php endif; ?>
