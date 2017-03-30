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
});