(function($){
	Drupal.behaviors.lezoo_module_admin = {
		attach: function(context, settings) {
			var field_group = [];
			var controller = $('.field-name-field-artist-name input[type="text"]');
			var subs = $('.field-name-field-artist-name').siblings('div:not(input)').once('lezoo-admin', function(){
				console.log($(this).siblings('.field-name-field-artist-name').find('input[type="text"]').val());
				if( $(this).siblings('.field-name-field-artist-name').find('input[type="text"]').val() == '' )
				{
					$(this).hide();
				}
			});
			controller.on('propertychange keyup input paste', function(){
				var dependents = $(this).parents('.field-name-field-artist-name').siblings('div');
				console.log(controller.val());
				if(controller.val() != '')
				{
					dependents.slideDown();
				}
				else
				{
					dependents.slideUp().find('input').val('');
				}
			});
		},
	}
})(jQuery)