$('.sidebar-element-linked').click(function() {
	if ($('#sidebar-content-panel').is(':visible')) {
		var url = $(this).data('url');
		/*var divId = $(this).attr('id');
		if ( $('#sidebar-content-panel').find( $(divId + '-defalt-index')) ) {
			$('#sidebar-content-panel').toggle(300);
			return;
		}*/
	    $('#sidebar-content-panel').load(url);	
	}
	else {
		$('#sidebar-content-panel').toggle(300);
		var url = $(this).data('url');
	    $('#sidebar-content-panel').load(url);	
	}
});

$('#page-wrapper').on("click", function(e) {
	if ($('#sidebar-content-panel').is(':visible')) {
    	$('#sidebar-content-panel').toggle(300);
    }
});