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

			modal.fadeOut('slow', function(){
				form[0].reset();
				UIkit.notification.closeAll();
			});
		});
	}
}