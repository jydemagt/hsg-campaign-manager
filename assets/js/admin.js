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

			// New Campaign
			$(document).on('click', '.hsgcm-new-campaign', this.newCampaign);

			// Edit Campaign
			$(document).on('click', '.hsgcm-edit-campaign', this.editCampaign);

			// Delete Campaign
			$(document).on('click', '.hsgcm-delete-campaign', this.deleteCampaign);

			// Search
			$(document).on('keyup', '#hsgcm-search', this.searchCampaigns);

		},

		newCampaign(e) {

			e.preventDefault();

			alert('New Campaign kommer i næste sprint.');

		},

		editCampaign(e) {

			e.preventDefault();

			alert('Edit Campaign kommer i næste sprint.');

		},

		deleteCampaign(e) {

			e.preventDefault();

			if (!confirm('Er du sikker på at du vil slette kampagnen?')) {
				return;
			}

			alert('Delete Campaign kommer i næste sprint.');

		},

		searchCampaigns() {

			const value = $(this).val().toLowerCase();

			$('.hsgcm-table tbody tr').each(function () {

				$(this).toggle(
					$(this).text().toLowerCase().indexOf(value) > -1
				);

			});

		}

	};

	$(function () {

		HSGCM.init();

	});

})(jQuery);
