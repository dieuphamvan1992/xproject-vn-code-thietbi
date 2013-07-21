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