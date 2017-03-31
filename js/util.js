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
	var problem_types = {}, problem_points = 0;
	
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
		
	for (problem in problem_types) {
		if (problem_types.hasOwnProperty(problem)) {
			problem_points += (problem_types[problem].length * MDMproblems[problem]);
		}
	}
}