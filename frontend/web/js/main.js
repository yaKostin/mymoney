$( "#cards" ).click(function() {
    //$('.sidebar-last-row').toggle(300);
    $('.sidebar-last-row').load('http://localhost/mymoney/frontend/web/index.php?r=accounts');
});