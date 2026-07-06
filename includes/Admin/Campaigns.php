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

				<h3>No campaigns yet</h3>

				<p>Create your first campaign.</p>

			</div>

		<?php else : ?>

			<div class="hsgcm-campaign-grid">

				<!-- Her bliver alle campaign cards -->

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
