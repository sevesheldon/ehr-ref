$(document).ready(function(){
	// When any MDM form element is updated, calculate the MDM based on the current element values
	$('body').on('change', "#MDMform", calculateMDM);
	
	// Add a new input row to the form based on the button pressed
	$("#MDMform").on('click', 'button.add-row', function() {
		var $parentSection = $(this).closest('section');
		var $lastRow = $("div.row:last", $parentSection);
		$lastRow.after($lastRow.clone());
		var $newRow = $("div.row:last", $parentSection);
		if ($("input + input", $newRow).length) {
			$("input + input", $newRow).remove();
		}
		$("div.row:last input[type='text']", $parentSection).each(function() {
			$(this).val('');
			$(this).removeAttr("value");
		});
		$("label", $newRow).html($("label", $newRow).html().replace(/#\d*/, "#" + $("div.row", $parentSection).length));
		$("input", $newRow).focus();
	});
	
	// Remove the input row from the form corresponding to the button pressed
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
	
	// When a billing code is selected, place the value in the "Target Code" box and apply some styles
	$("#MDMform").on('click', '#mdm-codes button.select-code', function() {
		$("#targetcode").val($(this).val());
		$("#targetcode").css("text-align", "center");
		$("#targetcode").css("font-weight", "700");
		$("#targetcode").css("font-size", "22px");
	});
	
	// When a new problem with additional planned workup is entered, add a text box for the additional planned workup
	$("#MDMform").on('change', 'section.newproblemsyeswork input.MDMnewprobyes', function() {
		$parent = $(this).parent();
		if ($(this).val()) {
			if (!$("input + input", $parent).length) {
				$parent.append("<input type=\"text\" value=\"\" class=\"form-control MDMnewprobwork\" name=\"MDMnewprobwork[]\" placeholder=\"Describe additional workup plan here\">");
				$("input + input", $parent).focus();
			}
		} else {
			$("input + input", $parent).remove();
		}
	});
	
	// When clicking ROS Singles, the "Other" fields on any system, PFSH speech/physical therapy, or Learned to read fields dynamically add a text box for elaboration
	$("#PFSHform").on('change', 'input[type=checkbox]#PFSHtherapy', genericAddTextField);
	$("#PFSHform").on('change', 'input[type=checkbox]#PFSHread', {inverse: true}, genericAddTextField);
	$("#ROSform").on('change', 'input[type=checkbox].ROSother', genericAddTextField);
	$("#ROSform").on('change', 'section.ROSsingles input[type=checkbox]', genericAddTextField);
	$("#PEform").on('change', 'input[type=checkbox]#PEgagroom', {inverse: true, defaultText: "Inappropriately groomed and/or dressed - Please Elaborate"}, genericAddTextField);
	$("#PEform").on('change', 'input[type=checkbox]#PEganourish', {inverse: true, defaultText: "Pt. has nutritional deficiencies. - Please Elaborate"}, genericAddTextField);
	$("#PEform").on('change', 'input[type=checkbox]#PEgadevel', {inverse: true, defaultText: "Has deformities relevant to mental status - Please Elaborate"}, genericAddTextField);
	$("#PEform").on('change', 'input[type=checkbox]#PEAOname', {inverse: true}, genericAddTextField);
	$("#PEform").on('change', 'input[type=checkbox]#PEAOplace', {inverse: true}, genericAddTextField);
	$("#PEform").on('change', 'input[type=checkbox]#PEAOdate', {inverse: true}, genericAddTextField);
	$("#PEform").on('change', 'input[type=checkbox]#PElanguage', {inverse: true}, genericAddTextField);
	$("#PEform").on('change', 'input[type=checkbox]#PEknowledge', {inverse: true}, genericAddTextField);
	$("#PEform").on('change', 'input[type=checkbox]#PEgait', {inverse: true}, genericAddTextField);
});

function calculateMDM() {
	var MDMproblems = { "MDMminprob":1, "MDMstabprob":1, "MDMworseprob":2, "MDMnewprobno":3, "MDMnewprobyes":4 };
	var MDMdata = { "MDMdatalab":1, "MDMdataradio":1, "MDMdatamedicine":1, "MDMdatadiscuss":1, "MDMdatarecdec":1, "MDMdatarecrev":2 };
	var MDMresults = { 1:"Straightforward", 2:"Low", 3:"Moderate", 4:"High" };
	var MDMcodes = { "Straightforward":[99212,99201,99202], "Low":[99213,99203], "Moderate":[99214,99204], "High":[99215,99205] };
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
	
	$("#MDMresult div.row:first").empty();
	$("#MDMresult div.row #MDM").empty();
	$("#MDMresult div.row #mdm-codes").empty();
	
	$("#MDMresult").addClass("alert-success");
	$("#MDMresult div.row:first").append("<h2>Select Billing Code</h2>");
	$("#MDMresult div.row #MDM").append("<h3>MDM:</h3>");
	$("#MDMresult div.row #MDM").append("<span class=\"h3\">" + mdm + "</span>");
	
	for (code in MDMcodes[mdm]) {
		$("#MDMresult div.row #mdm-codes").append("<button type=\"button\" class=\"select-code btn btn-primary btn-lg\" value=\"" + MDMcodes[mdm][code] + "\">" + MDMcodes[mdm][code] + "</button>");
	}
	
	$("#devinfo").empty();
	switch($("#MDMform #MDMriskmenu").val()) { case "min": devrisk = "Minimal"; break; case "low": devrisk = "Low"; break; case "mod": devrisk = "Moderate"; break; case "high": devrisk = "High"; break; default: devrisk = "Minimal"; break; }
	$("#devinfo").append(
		"<h4 style=\"font-weight: bold;\">#####Dev Info Only#####</h4> \
		<h4 style=\"font-weight: bold;\">MDM Calculator Results</h4> \
		<ul class=\"list-unstyled\"> \
		<li style=\"font-size: 18px;\">Problem Points: " + problem_result + "</li> \
		<li style=\"font-size: 18px;\">Data Points: " + data_result + "</li> \
		<li style=\"font-size: 18px;\">Risk to patient: " + devrisk + "</li> \
		</ul>"		
	);
}

function genericAddTextField(event) {
	$inverse = false;
	$defaultText = "Please Elaborate";
	
	if(typeof(event.data) != "undefined" && event.data !== null) {
		if(typeof(event.data.inverse) != "undefined" && event.data.inverse !== null) {
			$inverse = event.data.inverse;
		}
		
		if(typeof(event.data.defaultText) != "undefined" && event.data.defaultText !== null) {
			$defaultText = event.data.defaultText;
		}
	}
	
	$parent = $(this).parent();
	$id = $(this).attr('id');
	if (($(this).is(':checked') && !$inverse) || (!$(this).is(':checked') && $inverse)) {
		$parent.append("<input type=\"text\" value=\"\" class=\"form-control\" name=\"" + $id + "Elaboration\" placeholder=\"" + $defaultText + "\">");
		$("input + input", $parent).focus();
	} else {
		$("input + input", $parent).remove();
	}
}