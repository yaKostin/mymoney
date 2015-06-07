$( "#cards" ).click(function() {
	if ( $('#sidebar-content-panel').is(':visible') ) {
		$('#sidebar-content-panel').toggle(300);
	}
	else {
	    $('#sidebar-content-panel').toggle(300);
	    $('#sidebar-content-panel').load('http://localhost/mymoney/frontend/web/index.php?r=accounts');
	}
});

$( "#tags" ).click(function() {
	if ( $('#sidebar-content-panel').is(':visible') ) {
		$('#sidebar-content-panel').toggle(300);
	}
	else {
	    $('#sidebar-content-panel').toggle(300);
	    $('#sidebar-content-panel').load('http://localhost/mymoney/frontend/web/index.php?r=tags');
	}
});

$( "#reminders" ).click(function() {
	if ( $('#sidebar-content-panel').is(':visible') ) {
		$('#sidebar-content-panel').toggle(300);
	}
	else {
	    $('#sidebar-content-panel').toggle(300);
	    $('#sidebar-content-panel').load('http://localhost/mymoney/frontend/web/index.php?r=reminders');
	}
});

$('#page-wrapper').on("click", function(e) {
    //$('#sidebar-content-panel').toggle(300);
    //alert('ff');
});