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

		<button
			type="button"
			class="button button-primary hsgcm-new-campaign">

			➕ New Campaign

		</button>

	</div>

</div>

<div class="hsgcm-layout">

	<div class="hsgcm-left">

		<?php if ( empty( $campaigns ) ) : ?>

			<div class="hsgcm-empty">

				<h2>No campaigns yet</h2>

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

							<div>

								<h3>

									<?php echo esc_html( $campaign->post_title ); ?>

								</h3>

								<p>

									<?php
									echo $campaign->post_status === 'publish'
										? '🟢 Active'
										: '🟡 Draft';
									?>

								</p>

							</div>

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
									$start ?: '-'
								);

								echo ' → ';

								echo esc_html(
									$end ?: '-'
								);

								?>

							</p>

						</div>

						<div class="hsgcm-card-footer">

							<button
								class="button button-secondary hsgcm-edit-campaign"
								data-id="<?php echo esc_attr( $campaign->ID ); ?>">

								Edit

							</button>

							<button
								class="button hsgcm-duplicate-campaign"
								data-id="<?php echo esc_attr( $campaign->ID ); ?>">

								Duplicate

							</button>

							<button
								class="button button-link-delete hsgcm-delete-campaign"
								data-id="<?php echo esc_attr( $campaign->ID ); ?>">

								Delete

							</button>

						</div>

					</div>

				<?php endforeach; ?>

			</div>

		<?php endif; ?>

	</div>

	<div class="hsgcm-right">

		<?php

		$form = new \HSGCM\Admin\CampaignForm();

		$form->render();

		?>

	</div>

</div>
