$('.sidebar-element-linked').click(function() {
	if ($('#sidebar-content-panel').is(':visible')) {
		$('#sidebar-content-panel').toggle(300);	
	}
	else {
		$('#sidebar-content-panel').toggle(300);
		var url = $(this).data('url');
	    $('#sidebar-content-panel').load(url);	
	}
});

$('#page-wrapper').on("click", function(e) {
    //$('#sidebar-content-panel').toggle(300);
    //alert('ff');
});