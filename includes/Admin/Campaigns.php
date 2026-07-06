<?php
/**
 * Campaigns Page
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Admin;

defined( 'ABSPATH' ) || exit;

class Campaigns {

	/**
	 * Render page.
	 *
	 * @return void
	 */
	public function render(): void {

		$campaigns = get_posts(
			array(
				'post_type'      => 'hsg_campaign',
				'post_status'    => array( 'publish', 'draft' ),
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);

		?>

		<h2><?php esc_html_e( 'Campaigns', 'hsg-campaign-manager' ); ?></h2>

		<p>

			<a
				class="button button-primary"
				href="<?php echo esc_url( admin_url( 'post-new.php?post_type=hsg_campaign' ) ); ?>">

				➕ <?php esc_html_e( 'New Campaign', 'hsg-campaign-manager' ); ?>

			</a>

		</p>

		<table class="widefat striped">

			<thead>

				<tr>

					<th width="80">
						<?php esc_html_e( 'Status', 'hsg-campaign-manager' ); ?>
					</th>

					<th>
						<?php esc_html_e( 'Campaign', 'hsg-campaign-manager' ); ?>
					</th>

					<th width="150">
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

							if ( 'publish' === $campaign->post_status ) {

								echo '🟢';

							} else {

								echo '🟡';

							}

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

								echo esc_html(
									wc_price( (float) $price )
								);

							}

							?>

						</td>

						<td>

							<a
								class="button button-small"
								href="<?php echo esc_url(
									admin_url(
										'post.php?post=' .
										$campaign->ID .
										'&action=edit'
									)
								); ?>">

								<?php esc_html_e(
									'Edit',
									'hsg-campaign-manager'
								); ?>

							</a>

						</td>

					</tr>

				<?php endforeach; ?>

			<?php endif; ?>

			</tbody>

		</table>

		<?php

	}

}
