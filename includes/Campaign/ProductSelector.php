<?php
/**
 * Product Selector
 *
 * @package HSGCampaignManager
 */

namespace HSGCM\Campaign;

defined( 'ABSPATH' ) || exit;

class ProductSelector {

	/**
	 * Render produktvælger.
	 *
	 * @param int $post_id
	 * @return void
	 */
	public static function render( int $post_id ): void {

		$products = get_post_meta(
			$post_id,
			'_hsgcm_products',
			true
		);

		if ( ! is_array( $products ) ) {
			$products = array();
		}

		?>

		<tr>

			<th>

				<label for="hsgcm_products">

					<?php esc_html_e(
						'Products',
						'hsg-campaign-manager'
					); ?>

				</label>

			</th>

			<td>

				<select
					id="hsgcm_products"
					name="hsgcm_products[]"
					class="wc-product-search"
					multiple="multiple"
					style="width:600px;"
					data-placeholder="<?php esc_attr_e(
						'Search products...',
						'hsg-campaign-manager'
					); ?>">

					<?php

					foreach ( $products as $product_id ) {

						$product = wc_get_product( $product_id );

						if ( ! $product ) {
							continue;
						}

						?>

						<option
							value="<?php echo esc_attr( $product_id ); ?>"
							selected="selected">

							<?php echo esc_html( $product->get_name() ); ?>

						</option>

						<?php

					}

					?>

				</select>

				<p class="description">

					<?php esc_html_e(
						'Choose one or more products.',
						'hsg-campaign-manager'
					); ?>

				</p>

			</td>

		</tr>

		<?php

	}

}
