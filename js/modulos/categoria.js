$(function() {

    $( "#dialog:ui-dialog" ).dialog( "destroy" );
        
    var frmcategoria = $( "#frm_categoria" );
    var gridareq = $( "#grid_areq" );

    //variables para datos
    var descripcioncat = $( "#descripcioncat" );
    var idcategoria = $( "#idcategoria" );
    var titulo = $( "#titulo" );
    
    var idcateg = $( "#idcateg" );
    var arrreq;
    var limpio=0;
        
    //variable para calidacion
    var allFields = $([])
    .add(descripcioncat)
    .add(titulo);
    
    var tips = $( ".validar_categoria" );
    var loadingcat = $( ".cargando_categoria" );
    var esperecat = $( ".espere_categoria" );
    var esperer = $( ".espere_areq" );

    var gridcat2 = $("#lscategoria");
    var grillar = $("#lsareq");
        
    //inicializando variables
    esperecat.css('display','none');
    esperer.css('display','none');
    
    //Funciones
    jQuery("#btnsel_areq").click( function() { 

        $.ajax({
            data:{
                idcategoria: idcateg.val()
            },
            type: "GET",
            dataType: "json",
            url: "/index.php/requisito/getcat",
            success: function(data){
                $.each(data, function(index, objreq){
                    $.each(objreq,function(clave,id){
                        if (clave == 'idrequisito'){
                            grillar.jqGrid('setSelection',id);
                        }
                    });

                });  
            }
        });
    });
    
    frmcategoria.dialog({
        autoOpen: false,
        height: 200,
        width: 300,
        modal: true,        
        buttons: {
            "Guardar": function() {

                var bValid = true;
                allFields.removeClass( "ui-state-error" );
                
                bValid = bValid && checkLength( titulo, "titulo", 3, 45,tips );
                bValid = bValid && checkLength( descripcioncat, "descripcioncat", 0, 120,tips );

                if ( bValid ) {

                    loadingcat.css('display','block');

                    frmcategoria.submit();

                }
            },
            
            Cancelar: function() {
                $( this ).dialog( "close" );
            }
        },
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
        }
    });

    gridareq.dialog({
        autoOpen: false,
        height: 400,
        width: 550,
        modal: true,
        buttons: {
            "Asignar":function(){
                arrreq = grillar.jqGrid('getGridParam','selarrrow');
                limpio=0;
                if (arrreq.length>0){
                    esperer.css('display','block');
                    gridareq.submit();                 
                }else 
                    Mensaje('Seleccione un valor de la grilla','Seleccione');
            },
            "limpiar":function(){
                limpio=1;
                esperer.css('display','block');
                gridareq.submit();  
            },
            Cancelar: function() {
                gridareq.dialog( "close" );
            }
        },
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
        }
    });

    $( "#nuevo_categoria" ).button()
    .click(function() {
        idcategoria.val(-1);
        loadingcat.css('display','none');
        frmcategoria.dialog( "open" );
    });

    $( "#modificar_categoria" ).button()
    .click(function() {

        var indexR = gridcat2.getGridParam("selrow");
        
        if (indexR != null){
            esperecat.css('display','block');

            $.get(
                '/index.php/categoria/get',
                {
                    ajax:'ajax',
                    idcategoria:indexR
                },

                function(response){
                    loadingcat.css('display','none');
                    
                    titulo.val(response.response['titulo']);
                    descripcioncat.val(response.response['descripcion']);
                    idcategoria.val(response.response['idcategoria']);

                    esperecat.css('display','none');
                    frmcategoria.dialog( "open" );

                },
                'json'
                );
        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
    });

    $( "#anular_categoria" )
    .button()
    .click(function() {

        var indexR = gridcat2.getGridParam("selrow");
        if (indexR != null){

            esperecat.css('display','block');

            $.get(
                '/index.php/categoria/borrar',
                {
                    ajax:'ajax',
                    idcategoria:indexR
                },

                function(response){

                    esperecat.css('display','none');
                    Mensaje('Borrado correctamente','Anular');
                    gridcat2.trigger("reloadGrid");

                },
                'json'
                );

        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
                    
    });

    frmcategoria.submit(function(event) {

        event.preventDefault();

        $.post(
            '/index.php/categoria/guardar', //URL
            {
                ajax:'ajax',
                descripcion: descripcioncat.val(),
                titulo: titulo.val(),
                idcategoria: idcategoria.val()
            },//parametros

            function(response){//funcion para procesar los datos
                frmcategoria.dialog( "close" );
                gridcat2.trigger("reloadGrid");
            },
            'json'//tipo de dato debuelto
            );
          
    });
    
    gridareq.submit(function(event) {

        event.preventDefault();

        $.post(
            '/index.php/categoria/asignareq', //URL
            {
                ajax:'ajax',
                'idrequisito[]': arrreq,
                idcategoria: idcateg.val(),
                limpio:limpio
            },//parametros

            function(response){//funcion para procesar los datos
                gridareq.dialog( "close" );
                esperer.css('display','none');
                gridcat2.trigger("reloadGrid");
            },
            'json'//tipo de dato debuelto
            );
    });

});