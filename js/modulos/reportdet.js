$(function() {

    $( "#dialog:ui-dialog" ).dialog( "destroy" );
    var vdetalleitem = $( "#vdetalleitem" );
    
    vdetalleitem.dialog({
        autoOpen: false,
        height: 500,
        width: 700,
        modal: true,
        close: function() {}
    });
});


function verdetreq(idrequ,idexpe){
    $("#arbolex .folder a").css({
        'color':'black',
        'font-weight':'normal'
    });
    $("#lireq"+idrequ).css({
        'color':'green',
        'font-weight':'bold'
    });
    
    $.ajax({
        url:'/index.php/expediente/listardetalle?idexpediente='+idexpe+'&idrequisito='+idrequ,
        type: "GET",
        dataType: "html",
        complete : function (req, err) {
            $('#tdetitem').html(req.responseText);
        } 
    });
    
    $( "#vdetalleitem" ).dialog( "open" );
    
}

function reloadarb(ide){
    cargaarbolrep('/index.php/expediente/arbolreport?idexpediente='+ide,'arbolex',ide);
}