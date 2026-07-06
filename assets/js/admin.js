/**
 * HSG Campaign Manager
 * Admin
 */

(function ($) {

	'use strict';

	const HSGCM = {

		init() {

			this.bindEvents();

			console.log('HSG Campaign Manager loaded');

		},

		bindEvents() {

			$(document).on(
				'click',
				'.hsgcm-edit-campaign',
				this.editCampaign
			);

			$(document).on(
				'click',
				'.hsgcm-new-campaign,#hsgcm-reset',
				this.newCampaign
			);

			$(document).on(
				'submit',
				'#hsgcm-campaign-form',
				this.saveCampaign
			);

		},

		/**
		 * New campaign.
		 */
		newCampaign(e) {

			e.preventDefault();

			$('#hsgcm-form-title').text('New Campaign');

			$('#hsgcm-id').val('');

			$('#hsgcm-title').val('');

			$('#hsgcm-status').val('draft');

			$('#hsgcm-coupon').val('');

			$('#hsgcm-price').val('');

			$('#hsgcm-start').val('');

			$('#hsgcm-end').val('');

		},

		/**
		 * Edit campaign.
		 */
		editCampaign(e) {

			e.preventDefault();

			const id = $(this).data('id');

			$.post(

				hsgcmAdmin.ajaxUrl,

				{

					action: 'hsgcm_get_campaign',

					nonce: hsgcmAdmin.nonce,

					id: id

				},

				function (response) {

					if (!response.success) {

						alert('Unable to load campaign.');

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

					$('html,body').animate({

						scrollTop: $('.hsgcm-form').offset().top - 30

					},300);

				}

			);

		},

		/**
		 * Save campaign.
		 */
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

			$.post(

				hsgcmAdmin.ajaxUrl,

				data,

				function (response) {

					if (!response.success) {

						alert(response.data.message);

						return;

					}

					alert(response.data.message);

					location.reload();

				}

			);

		}

	};

	$(function () {

		HSGCM.init();

	});

})(jQuery);
