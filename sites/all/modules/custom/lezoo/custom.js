(function($){
	Drupal.behaviors.lezoo_module = {
		attach: function(context, settings) {

			//Trick the user into believing that it has 1 date filter
			var year = $('.views-widget-filter-field_date_value_2 select.date-year');
			var ymonth = $('.views-widget-filter-field_date_value_1 select.date-month');
			var yearm = $('.views-widget-filter-field_date_value_1 select.date-year');

			ymonth.once('lezoo', function(){
				$(this).change(function(e){
					var value = $(this).val();
					var empty = value == "";
					if(!empty)
					{
						yearm.val(year.val()).trigger("chosen:updated");
					}
					else
					{
						yearm.val("").trigger("chosen:updated");
					}
				});
			});

			year.once('lezoo', function(){
				$(this).change(function(e){
					if(ymonth.val() != '')
					{
						yearm.val(year.val()).trigger('chosen:updated');
					}
					else
					{
						month.val('').trigger('chosen:updated');
					}
				});
			});

			//Remove duplicate grouping

		},
	}
})(jQuery)