(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

/**
 * Function checkForm
 * 
 * Recebe um elemento form busca os inputs e faz uma verificação simples, no final retorna o resultado
 * 
 * @param form = el form html
 */
function checkForm(form) {
	'use strict';
	var elements = form.find('.uk-input, .uk-select'),
		count = 0;

	elements.each(function(index){
		if (jQuery(this).val().length === 0) {
			jQuery(this).addClass('uk-form-danger');
			count++;
		} else {
			jQuery(this).addClass('uk-form-success');
		}
	});
	return count;
}

/**
 * Função registerProject
 * 
 * 
 * @param ajaxUrl = url admin ajax
 */
function registerProject(ajaxUrl){
	'use strict';
	var form = jQuery('#modal-projetos').find('form');
	
	var projectName 		= jQuery('#uchb_project_name').val(),
		projectDescription 	= jQuery('#uchb_project_description').val(),
		projectSpecs 		= jQuery('#uchb_project_specs').val(),
		projectDetails 		= jQuery('#uchb_project_details').val(),
		projectType 		= jQuery('#uchb_project_types').val(),
		projectCustomer 	= jQuery('#uchb_project_customer').val(),
		projectProposal 	= jQuery('#uchb_project_proposal').val(),
		projectDeadline 	= jQuery('#uchb_project_deadline').val(),
		projectHours 		= jQuery('#uchb_project_hours').val(),
		projectPrice 		= jQuery('#uchb_project_price').val(),
		projectStatus 		= jQuery('#uchb_project_status').val();

	var dataToSend = projectName 
					+ '||' + projectDescription 
					+ '||' + projectSpecs 
					+ '||' + projectDetails 
					+ '||' + projectType 
					+ '||' + projectCustomer
					+ '||' + projectProposal
					+ '||' + projectDeadline
					+ '||' + projectHours
					+ '||' + projectPrice
					+ '||' + projectStatus;

	// Send to backend
	if (checkForm(form) === 0) {
		jQuery.ajax({
			type: 'POST',
			url: ajaxUrl,
			data: {
				action: 'uchb_create_project',
				data: dataToSend
			},
			success: function(res)
			{
				UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Projeto cadastrado com sucesso!', status: 'success', pos: 'bottom-center'});
			},
			error: function(res)
			{
				UIkit.notification({message: '<span uk-icon=\'icon: close\'></span> Projeto cadastrado com sucesso!', status: 'error', pos: 'bottom-center'});
			}
		}).done(function() {
			var modal = jQuery('#modal-projetos');

			modal.fadeOut('fast', function(){
				form[0].reset();
				UIkit.notification.closeAll();
			});
		});
	}
}

/**
 * Função registerCustomer
 * 
 * @param ajaxUrl = url admin ajax
 */
function registerCustomer(ajaxUrl){
	'use strict';
	var form = jQuery('#modal-clientes').find('form');

	var customerName 		= jQuery('#uchb_client_name').val(),
		customerCompany 	= jQuery('#uchb_client_company').val(),
		customerDoc 		= jQuery('#uchb_client_doc').val(),
		customerEmail 		= jQuery('#uchb_client_email').val(),
		customerTel 		= jQuery('#uchb_client_telnumber').val(),
		customerBranch 		= jQuery('#uchb_client_branch').val(),
		customerAddress 	= jQuery('#uchb_client_address').val();

	// Send to backend
	if (checkForm(form) === 0){
		var dataToSend = customerName
					+ '||' + customerCompany
					+ '||' + customerDoc
					+ '||' + customerEmail
					+ '||' + customerTel
					+ '||' + customerBranch
					+ '||' + customerAddress;

		// Send to backend
		jQuery.ajax({
			type: 'POST',
			url: ajaxUrl,
			data: {
				action: 'uchb_register_customer',
				data: dataToSend
			},
			success: function(res)
			{
				UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Cliente cadastrado com sucesso!', status: 'success', pos: 'bottom-center'});
			},
			error: function(res)
			{
				UIkit.notification({message: '<span uk-icon=\'icon: close\'></span> Houve um problema com o cadastro. Tente novamente! <br /> Err: ' + res, status: 'error', pos: 'bottom-center'});
			}
		}).done(function() {
			var modal = jQuery('#modal-clientes');

			modal.fadeOut('slow', function(){
				form[0].reset();
				UIkit.notification.closeAll();
			});
		});
	}
}

/**
 * Função registerBudget
 * 
 * @param ajaxUrl = url admin ajax
 */
function registerBudget(ajaxUrl){
	'user strict';
	var form = jQuery('#modal-orcamentos').find('form');

	var budgetName 			= jQuery('#uchb_budget_name').val(),
		budgetDescription 	= jQuery('#uchb_budget_description').val(),
		budgetHours 		= jQuery('#uchb_budget_hours').val(),
		budgetDeadline 		= jQuery('#uchb_budget_deadline').val(),
		budgetPrice 		= jQuery('#uchb_budget_price').val(),
		budgetCustomerEmail = jQuery('#uchb_budget_client_email').val(),
		budegtCustomerName 	= jQuery('#uchb_budget_client_name').val();

	if (checkForm(form) === 0){
		var dataToSend = budgetName
					+ '||' + budgetDescription
					+ '||' + budgetHours
					+ '||' + budgetDeadline
					+ '||' + budgetPrice
					+ '||' + budgetCustomerEmail
					+ '||' + budegtCustomerName;

		// Send to back end
		jQuery.ajax({
			type: 'POST',
			url: ajaxUrl,
			data: {
				action: 'uchb_register_budget',
				data: dataToSend
			},
			success: function(res)
			{
				UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Orçamento cadastrado com sucesso!', status: 'success', pos: 'bottom-center'});
			},
			error: function(res)
			{
				UIkit.notification({message: '<span uk-icon=\'icon: close\'></span> Houve um problema com o cadastro. Tente novamente! <br /> Err: ' + res, status: 'error', pos: 'bottom-center'});
			}
		}).done(function(){
			var modal = jQuery('#modal-orcamentos');

			modal.fadeOut('slow', function(){
				form[0].reset();
				UIkit.notification.closeAll();
			});
		});
	} else {
		console.log('Inválido!');
	}
}