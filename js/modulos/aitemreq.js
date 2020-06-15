$(function() {
    $( "#dialog:ui-dialog" ).dialog( "destroy" );
    
    var frmaitems = $( "#frm_aitem" );
    var gridreq = $("#lsrequisito");
    var idrequi = $( "#idrequi" );
    var gridselitem = $("#lsaitem");

    var loadingreq1 = $( ".cargando_requisito" );

    $( "#aitem_requisito" ).button()
    .click(function() {
        var indexR = gridreq.getGridParam("selrow");
        
        if (indexR != null){
            idrequi.val(indexR);
            loadingreq1.css('display','none');
            
            cargagridaitem(indexR);
            gridselitem.jqGrid('setGridParam',{
                url:"/index.php/item/listar?idrequisito="+indexR
            }).trigger('reloadGrid');
            
            frmaitems.dialog( "open" );
            
        } else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
            
    });

});

function cargagridaitem (idr){
    jQuery("#lsaitem").jqGrid({ 
        url:'/index.php/item/listar?idrequisito='+idr, 
        datatype: "json", 
        colNames:['Nombre Item','Descripcion'], 
        colModel:[
        {
            name:'descripcion',
            index:'descripcion', 
            width:300
        },
        {
            name:'informacion',
            index:'informacion', 
            width:400
        }
        ], 
        rowNum:10, 
        rowList:[10,20,30], 
        pager: '#pgaitem', 
        sortname: 'descripcion', 
        recordpos: 'left',
        viewrecords: true, 
        sortorder: "desc",
        onSelectRow: function(id){
            $('#aiditem').val(id);
          
            $('.espere_aitem').css('display','block');
            
            $.get(
                '/index.php/item/get',
                {
                    ajax:'ajax',
                    iditem:$('#aiditem').val(),
                    idrequisito:$("#idrequi").val()
                },

                function(response){
                    
                    $('#anombre').val(response.response['descripcion']);
                    $('#descripcionaitem').val(response.response['informacion']);
                    $('#aiditem').val(response.response['iditem']);

                    $('.espere_aitem').css('display','none');

                },
                'json'
                );
        },
        caption: "Seleccione Items a Asignar" 
    }); 
    jQuery("#lsaitem").jqGrid('navGrid','#pgaitem',
    {
        add:false,
        del:false,
        edit:false,
        position:'right'
    }); 
    $("#lsaitem *").css("font-size","10px");
    $("#pgaitem *").css("font-size","10px");
    $("#btnsel_aitem").css("color","blue");
}