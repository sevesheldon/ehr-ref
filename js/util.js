$(document).ready(function(){
	$("#MDMform").on('click', 'button.add-row', function() {
		var $parentSection = $(this).closest('section');
		var $lastRow = $("div.row:last", $parentSection);
		$lastRow.after($lastRow.clone());
		var $newRow = $("div.row:last", $parentSection);
		$("div.row:last input[type='text']", $parentSection).each(function() {
			$(this).val('');
			$(this).removeAttr("value");
		});
		$("label", $newRow).html($("label", $newRow).html().replace(/#\d*/, "#" + $("div.row", $parentSection).length));
	});
	
	$("#MDMform").on('click', 'button.remove-row', function() {
		var $i = 1;
		if ($("div.row", $(this).closest('section')).length>1) {
			var $parentSection = $(this).closest('section');
			$(this).closest('div.row').remove();
			$("div.row", $parentSection).each(function() {
				$("label", $(this)).html($("label", $(this)).html().replace(/#\d*/, "#" + $i));
				$i++;
			});
		}
	});
	
	$('body').on('change', "#MDMform", calculateMDM);
});

function calculateMDM() {
	var MDMproblems = { "MDMminprob":1, "MDMstabprob":1, "MDMworseprob":2, "MDMnewprobno":3, "MDMnewprobyes":4 };
	var MDMdata = { "MDMdatalab":1, "MDMdataradio":1, "MDMdatamedicine":1, "MDMdatadiscuss":1, "MDMdatarecdec":1, "MDMdatarecrev":2 };
	var MDMresults = { 1:"Straightforward", 2:"Low", 3:"Moderate", 4:"High" };
	var MDMrisk = { "min":1, "low":2, "mod":3, "high":4 };
	var problem_types = {}, problem_points = 0, data_points = 0, mdm = '', problem_result = ''; data_result = '';
	
	for (var key in MDMproblems) {
		if (MDMproblems.hasOwnProperty(key)) {
			problem_types[key] = [];
			$('#MDMform input.' + key).each(function() {
				if ($(this).val()) {
					problem_types[key].push($(this).val());
				}
			});
		}
	}
		
	for (var key in problem_types) {
		if (problem_types.hasOwnProperty(key)) {
			problem_points += (problem_types[key].length * MDMproblems[key]);
		}
	}
	
	for (var key in MDMdata) {
		if (MDMdata.hasOwnProperty(key)) {
			if ($('#MDMform input#' + key).is(':checked')) {
				data_points += (MDMdata[key])
			}
		}
	}
	
	var risk_result = ($("#MDMform #MDMriskmenu").val()) ? MDMrisk[$("#MDMform #MDMriskmenu").val()] : 1;

	switch (true) {
		case (problem_points <= 1):
			problem_result = 1;
			break;
		case (problem_points == 2):
			problem_result = 2;
			break;
		case (problem_points <= 3):
			problem_result = 3;
			break;
		case (problem_points >= 4):
			problem_result = 4;
			break;
	}

	switch (true) {
		case (data_points <= 1):
			data_result = 1;
			break;
		case (data_points == 2):
			data_result = 2;
			break;
		case (data_points <= 3):
			data_result = 3;
			break;
		case (data_points >= 4):
			data_result = 4;
			break;
	}
	
	if ((problem_result == data_result) || (problem_result == risk_result)) {
		mdm = MDMresults[problem_result];
	} else if (data_result == risk_result) {
		mdm = MDMresults[data_result];
	} else {
		var results = [problem_result, data_result, risk_result];
		results.sort(function(a, b){return a-b});
		mdm = MDMresults[results[1]];
	}
}