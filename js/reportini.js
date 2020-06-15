function dashreport(url,idc){
    $.ajax({
        url: url+'?idcat='+idc,
        type: "GET",
        dataType: "html",
        complete : function (req, err) {
            $("#reportegeneral").html(req.responseText);
        } 
    });
}