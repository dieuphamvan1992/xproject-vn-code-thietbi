
$(document).ready(function() {
	var oTable = $('#customers').dataTable( {
		"bProcessing": true,
		"sPaginationType": "full_numbers",
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
		}
	} );
    $("#tu").click(function(){
       var den = $("#den").val();
       var tu = $("#tu").val();
       if (den != ''){
            if (tu > den){
                $("#tu").val(den);
            }
       } 
    });
    $("#den").click(function(){
       var tu = $("#tu").val();
       var den = $("#den").val();
       if (tu != ''){
        if (den < tu){
            $("#den").val(tu);
        }
       } 
    });
});