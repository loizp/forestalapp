function cargalinkdet(){
    var ids = $("#lsreporte").jqGrid('getDataIDs');
    for(var i=0;i < ids.length;i++){ 
        var cl = ids[i];
        $("#lsreporte").jqGrid('setRowData',ids[i],{act:'<a href="javascript:void(0)" onclick="verdetalle('+cl+');">Ver</a>'});
    }
}

function verdetalle(ide){
    dashreport("/index.php/expediente/detreport?idexpediente="+ide,'');
    var cadre= '/index.php/expediente/arbolreport?idexpediente='+ide;
    cargaarbolrep(cadre, 'arbolex',ide);
}

function cargaarbolrep(url,idcomp,idexp){

    $.ajax({
        url:url,
        type: "GET",
        dataType: "html",
        complete : function (req, err) {
            $('#'+idcomp).html(req.responseText);
            $("#lis"+idexp).treeview({
                unique: true,
                animated: "fast"
            });
        } 
    });       
}