var initSpinner = function() {			
	$('input[type=number]').each(function() {
		var $input = $(this);
		$input.spinner({
			min: $input.attr('min'),
			max: $input.attr('max'),
			step: $input.attr('step')
		});
	});
};

if(!Modernizr.inputtypes.number){
	$(document).ready(initSpinner);
};
var initDatepicker = function() {
	$('input[type=date]').each(function() {
		var $input = $(this);
		$input.datepicker({
			minDate: $input.attr('min'),
			maxDate: $input.attr('max'),
			dateFormat: 'yy-mm-dd'
		});
	});
};

if(!Modernizr.inputtypes.date){
	$(document).ready(initDatepicker);
};