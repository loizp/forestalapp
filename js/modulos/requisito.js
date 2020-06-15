$(function() {

    $( "#dialog:ui-dialog" ).dialog( "destroy" );
        
    var frmrequisito = $( "#frm_requisito" );
    var frmaitem = $( "#frm_aitem" );

    //variables para datos
    var descripcionreq = $( "#descripcionreq" );
    var idrequisito = $( "#idrequisito" );
    var dependencia = $( "#dependencia" );
    
    var descripcionaitem = $( "#descripcionaitem" );
    var anombre = $( "#anombre" );
    var aiditem = $( "#aiditem" );
    
    var idrequi = $( "#idrequi" );
        
        
    //variable para calidacion
    var allFields = $([])
    .add(descripcionreq);
    
    var tips = $( ".validar_requisito" );
    var loadingreq = $( ".cargando_requisito" );
    var esperereq = $( ".espere_requisito" );
    var esperei = $( ".espere_aitem" );

    var gridrequi1 = $("#lsrequisito");
    var gridaitem = $("#lsaitem");
        
    //inicializando variables
    esperereq.css('display','none');
    esperei.css('display','none');

    //Funciones

    frmrequisito.dialog({
        autoOpen: false,
        height: 200,
        width: 300,
        modal: true,
        buttons: {
            "Guardar": function() {

                var bValid = true;
                allFields.removeClass( "ui-state-error" );
                
                bValid = bValid && checkLength( descripcionreq, "Descripcion", 3, 100,tips );

                if ( bValid ) {

                    loadingreq.css('display','block');

                    frmrequisito.submit();


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
    
    
    frmaitem.dialog({
        autoOpen: false,
        height: 500,
        width: 750,
        modal: true,
        buttons: {
            "Guardar":function(){
                var bValid = true;
                allFields.removeClass( "ui-state-error" );                
                
                bValid = bValid && checkLength( anombre, "Nombre Item", 3, 100,tips );
                bValid = bValid && checkLength( descripcionaitem, "Descripcion", 0, 250,tips );

                if ( bValid ) {

                    esperei.css('display','block');

                    frmaitem.submit();


                }
                
            },
            "Nuevo":function(){
                aiditem.val('-1');
                anombre.val(null);
                descripcionaitem.val(null);
                gridaitem.trigger("reloadGrid");
            },
            "Eliminar":function(){
                var indexR = gridaitem.getGridParam("selrow");
                if (indexR != null){
                    aiditem.val(indexR);
                    esperei.css('display','block');

                    $.get(
                        '/index.php/item/borrar',
                        {
                            ajax:'ajax',
                            iditem: aiditem.val(),
                            idrequisito:idrequi.val()
                        },

                        function(response){

                            esperei.css('display','none');
                            Mensaje('Borrado correctamente','Anular');
                            gridaitem.trigger("reloadGrid");

                        },
                        'json'
                        );

                }else
                    Mensaje('Seleccione un valor de la grilla','Seleccione');
            },
            Salir: function() {
                frmaitem.dialog( "close" );
            }
        },
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
        }
    });

    $( "#nuevo_requisito" ).button()
    .click(function() {
        idrequisito.val(-1);
        loadingreq.css('display','none');
        frmrequisito.dialog( "open" );
    });

    $( "#modificar_requisito" ).button()
    .click(function() {

        var indexR = gridrequi1.getGridParam("selrow");
        if (indexR != null){

            esperereq.css('display','block');

            $.get(
                '/index.php/requisito/get',
                {
                    ajax:'ajax',
                    idrequisito:indexR
                },

                function(response){
                    loadingreq.css('display','none');
                    
                    descripcionreq.val(response.response['descripcion']);
                    idrequisito.val(response.response['idrequisito']);

                    esperereq.css('display','none');
                    frmrequisito.dialog( "open" );

                },
                'json'
                );

        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
    });

    $( "#anular_requisito" )
    .button()
    .click(function() {

        var indexR = gridrequi1.getGridParam("selrow");
        if (indexR != null){

            esperereq.css('display','block');

            $.get(
                '/index.php/requisito/borrar',
                {
                    ajax:'ajax',
                    idrequisito:indexR
                },

                function(response){

                    esperereq.css('display','none');
                    Mensaje('Borrado correctamente','Anular');
                    gridrequi1.trigger("reloadGrid");

                },
                'json'
                );

        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
                    
    });

    frmrequisito.submit(function(event) {

        event.preventDefault();

        $.post(
            '/index.php/requisito/guardar', //URL
            {
                ajax:'ajax',
                depencia: dependencia.val(),
                descripcion: descripcionreq.val(),
                idrequisito: idrequisito.val()
            },//parametros

            function(response){//funcion para procesar los datos
                frmrequisito.dialog( "close" );
                gridrequi1.trigger("reloadGrid");
            },
            'json'//tipo de dato debuelto
            );
    });
        
    frmaitem.submit(function(event) {

        event.preventDefault();

        $.post(
            '/index.php/item/guardar', //URL
            {
                ajax:'ajax',
                descripcion:anombre.val(),
                informacion: descripcionaitem.val(),
                iditem: aiditem.val(),
                idrequisito:idrequi.val()
            },//parametros

            function(response){//funcion para procesar los datos
                gridaitem.trigger("reloadGrid");
                esperei.css('display','none');
            },
            'json'//tipo de dato debuelto
            );
          
    });

});