$('#choose').change(function(event) {
	var alltabs = $(".update");
	var y = 0;
	for ( var x = 0; x < alltabs.length; x++ )
	{
		if($(alltabs[x]).is(":visible")) {
			$(alltabs[x]).html($('#choose').val());	
		}
	}
}); 


function refreshchoose() {
//refreshes per section because it doesn't automatically get reassigned to the current visible section
	$("#choose").load(location.href + " #choose > *");
}
