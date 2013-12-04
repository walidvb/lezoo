(function($){
	Drupal.behaviors.lezoo_module = {
		attach: function(context, settings) {
			var year = $('.views-widget-filter-field_date_value_2 select.date-year');
			var ymonth = $('.views-widget-filter-field_date_value_1 select.date-month');
			var yearm = $('.views-widget-filter-field_date_value_1 select.date-year');

			ymonth.change(function(e){
				var value = $(this).val();
				//var value = e.target.value;
				var empty = value == "";
				console.log(value, empty);
				if(!empty)
				{
					yearm.val(year.val()).trigger("chosen:updated");
				}
				else
				{
					yearm.val("").trigger("chosen:updated");
				}
			});

		},
	}
})(jQuery)