$( "#cards" ).click(function() {
    $('#sidebar-content-panel').toggle(300);
    $('#sidebar-content-panel').load('http://localhost/mymoney/frontend/web/index.php?r=accounts');
});