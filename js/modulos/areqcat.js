$(function() {
    $( "#dialog:ui-dialog" ).dialog( "destroy" );
    
    var gridareq = $( "#grid_areq" );
    var gridcat = $("#lscategoria");
    var idcateg = $( "#idcateg" );
    var grillasel = $("#lsareq");

    var loadingcat1 = $( ".cargando_categoria" );

    $( "#areq_categoria" ).button()
    .click(function() {
        var indexR = gridcat.getGridParam("selrow");
        
        if (indexR != null){
            idcateg.val(indexR);
            loadingcat1.css('display','none');
            
            cargagrilla();
            grillasel.trigger("reloadGrid");

            gridareq.dialog( "open" );
            
        } else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
            
    });

});

function cargagrilla (){
    jQuery("#lsareq").jqGrid({ 
        url:'/index.php/requisito/listar?ini=1', 
        datatype: "json", 
        colNames:['Descripcion Requisito'], 
        colModel:[
        {
            name:'descripcion',
            index:'descripcion', 
            width:480
        }
        ], 
        rowNum:20, 
        rowList:[20,40,60], 
        pager: '#pgareq', 
        sortname: 'descripcion', 
        recordpos: 'left',
        viewrecords: true, 
        sortorder: "desc", 
        multiselect: true, 
        caption: "Seleccione Requisitos a Asignar" 
    }); 
    jQuery("#lsareq").navGrid('#pgareq',
    {
        add:false,
        del:false,
        edit:false,
        position:'right'
    });
    $("#lsareq *").css("font-size","10px");
    $("#pgareq *").css("font-size","10px");
    $("#btnsel_areq").css("color","blue");
}