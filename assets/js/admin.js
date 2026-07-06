/**
 * HSG Campaign Manager
 * Admin
 */

(function ($) {

	'use strict';

	class HSGCampaignManager {

		constructor() {

			this.form = $('#hsgcm-campaign-form');

			this.bindEvents();

		}

		bindEvents() {

			$(document).on(
				'click',
				'.hsgcm-edit-campaign',
				this.editCampaign.bind(this)
			);

			$(document).on(
				'click',
				'.hsgcm-delete-campaign',
				this.deleteCampaign.bind(this)
			);

			$(document).on(
				'click',
				'.hsgcm-duplicate-campaign',
				this.duplicateCampaign.bind(this)
			);

			$(document).on(
				'click',
				'.hsgcm-new-campaign,#hsgcm-reset',
				this.resetForm.bind(this)
			);

			this.form.on(
				'submit',
				this.saveCampaign.bind(this)
			);

		}

		resetForm(e) {

			if (e) {
				e.preventDefault();
			}

			this.form.trigger('reset');

			$('#hsgcm-id').val('');

			$('#hsgcm-form-title').text('New Campaign');

		}

		editCampaign(e) {

			e.preventDefault();

			const id = $(e.currentTarget).data('id');

			$.post(

				hsgcmAdmin.ajaxUrl,

				{
					action: 'hsgcm_get_campaign',
					nonce: hsgcmAdmin.nonce,
					id: id
				}

			).done((response) => {

				if (!response.success) {

					alert(response.data.message);

					return;

				}

				const c = response.data;

				$('#hsgcm-form-title').text('Edit Campaign');

				$('#hsgcm-id').val(c.id);

				$('#hsgcm-title').val(c.title);

				$('#hsgcm-status').val(c.status);

				$('#hsgcm-coupon').val(c.coupon);

				$('#hsgcm-price').val(c.price);

				$('#hsgcm-start').val(c.start);

				$('#hsgcm-end').val(c.end);

			});

		}

		saveCampaign(e) {

			e.preventDefault();

			const data = {

				action: 'hsgcm_save_campaign',

				nonce: hsgcmAdmin.nonce,

				id: $('#hsgcm-id').val(),

				title: $('#hsgcm-title').val(),

				status: $('#hsgcm-status').val(),

				coupon: $('#hsgcm-coupon').val(),

				price: $('#hsgcm-price').val(),

				start: $('#hsgcm-start').val(),

				end: $('#hsgcm-end').val()

			};

			const button = $('#hsgcm-save');

			button.prop('disabled', true);

			button.text('Saving...');

			$.post(

				hsgcmAdmin.ajaxUrl,

				data

			).done((response) => {

				button.prop('disabled', false);

				button.text('Save Campaign');

				if (!response.success) {

					alert(response.data.message);

					return;

				}

				alert(response.data.message);

				location.reload();

			}).fail(() => {

				button.prop('disabled', false);

				button.text('Save Campaign');

				alert('Unexpected server error.');

			});

		}

		deleteCampaign(e) {

			e.preventDefault();

			if (!confirm('Delete this campaign?')) {

				return;

			}

			const id = $(e.currentTarget).data('id');

			$.post(

				hsgcmAdmin.ajaxUrl,

				{

					action: 'hsgcm_delete_campaign',

					nonce: hsgcmAdmin.nonce,

					id: id

				}

			).done((response) => {

				if (!response.success) {

					alert(response.data.message);

					return;

				}

				location.reload();

			});

		}

		duplicateCampaign(e) {

			e.preventDefault();

			const id = $(e.currentTarget).data('id');

			$.post(

				hsgcmAdmin.ajaxUrl,

				{

					action: 'hsgcm_duplicate_campaign',

					nonce: hsgcmAdmin.nonce,

					id: id

				}

			).done((response) => {

				if (!response.success) {

					alert(response.data.message);

					return;

				}

				location.reload();

			});

		}

	}

	$(function () {

		new HSGCampaignManager();

	});

})(jQuery);
