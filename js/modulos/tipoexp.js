$(function() {
    // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!

    $( "#dialog:ui-dialog" ).dialog( "destroy" );
        
    var frmtipoexp = $( "#frm_tipoexp" );


    //variables para datos
    var descripcion = $( "#descripcion" );
    var idtipoexp = $( "#idtipoexp" );
        
    //variable para calidacion
    var allFields = $([])
    .add( descripcion )
        
    var tips = $( ".validar_tipoexp" );
    var loading = $( ".cargando_tipoexp" );
    var espere = $( ".espere_tipoexp" );

    var grilla = $("#lstipoexp");
        
    //inicializando variables


    espere.css('display','none');

    frmtipoexp.dialog({
        autoOpen: false,
        height: 150,
        width: 300,
        modal: true,
        buttons: {
            "Guardar": function() {

                var bValid = true;
                allFields.removeClass( "ui-state-error" );

                bValid = bValid && checkLength( descripcion, "descripcion", 3, 45,tips );

                bValid = bValid && checkLetras( descripcion,tips );

                if ( bValid ) {

                    loading.css('display','block');

                    frmtipoexp.submit();


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

    $( "#nuevo_tipoexp" ).button()
    .click(function() {
        idtipoexp.val(-1);
        loading.css('display','none');
        frmtipoexp.dialog( "open" );
    });

    $( "#modificar_tipoexp" ).button()
    .click(function() {

        var indexR = grilla.getGridParam("selrow");
        if (indexR != null){

            espere.css('display','block');

            $.get(
                '/index.php/tipoexp/get',
                {
                    ajax:'ajax',
                    idtipoexp:indexR
                },

                function(response){
                    loading.css('display','none');

                    descripcion.val(response.response['descripcion']);
                    idtipoexp.val(response.response['idtipoexp']);

                    espere.css('display','none');
                    frmtipoexp.dialog( "open" );

                },
                'json'
                );

        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
    });

    $( "#anular_tipoexp" )
    .button()
    .click(function() {

        var indexR = grilla.getGridParam("selrow");
        if (indexR != null){

            espere.css('display','block');

            $.get(
                '/index.php/tipoexp/borrar',
                {
                    ajax:'ajax',
                    idtipoexp:indexR
                },

                function(response){

                    espere.css('display','none');
                    Mensaje('Borrado correctamente','Anular');
                    grilla.trigger("reloadGrid");

                },
                'json'
                );

        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
                    
    });

    frmtipoexp.submit(function(event) {

        event.preventDefault();

        $.post(
            '/index.php/tipoexp/guardar', //URL
            {
                ajax:'ajax',
                descripcion: descripcion.val(),
                idtipoexp: idtipoexp.val()
            },//parametros

            function(response){//funcion para procesar los datos
                frmtipoexp.dialog( "close" );
                grilla.trigger("reloadGrid");
            },
            'json'//tipo de dato debuelto
            );
          
    });

});