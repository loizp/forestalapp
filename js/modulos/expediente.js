$(function() {

    $( "#dialog:ui-dialog" ).dialog( "destroy" );
    $(".dfexp *").css("margin","10px");
        
    var frmexpediente = $( "#frm_expediente" );
    var frmadet = $( "#frm_adet" );
    var frmsmapa = $( "#frm_mapexpediente" )
    var frmsarch = $( "#frmarch_expediente" );
        
    //variables para datos
    var observacion = $( "#observacion" );
    var codigo = $( "#codigo" );
    var titular = $( "#titular" );
    var ubicacion = $( "#ubicacion" );
    var fecha = $( "#fecha" ).datepicker({dateFormat: 'yy-mm-dd'});
    var idexpediente = $( "#idexpediente" );
    var estado = $( "#estado" );
    var idtipoexp = $( "#listatiexp" );
    var idcategoria = $( "#listacateg" );
    var mapa = $( "#mapa" );
    
    var mapaid=$('#mapaid');
    var idearch= $('#idexparch');
    var idarc= $('#idar');
    var carpreq= $('#carpreq');
    
    var descripciondet = $( "#descripciondet" );
    
    var idexpedi=$('#idexpedi');
    var idlistareq=$('#idlistareq');
    var idlistaitem=$('#idlistaitem');
        
    //variable para calidacion
    var allFields = $([])
    .add(titular)
    .add(ubicacion)
    .add(fecha)
    .add(observacion)
    .add(codigo)
    .add(estado)
    .add(idtipoexp)
    .add(idcategoria);

        
    var tips = $( ".validar_expediente" );
    var loadingexped = $( ".cargando_expediente" );
    var espereexped = $( ".espere_expediente" );
    var loadingadet = $( ".cargando_adet" )
    var gridexpediente = $("#lsexpediente");
    var lodingarch = $(".cargaarch_expediente");
    var lodingmap = $(".cargando_mapexpediente");
        
    //inicializando variables
    espereexped.css('display','none');
    loadingadet.css('display','none');
    lodingarch.css('display','none');
    lodingmap.css('display','none');

    //Funciones
    frmexpediente.dialog({
        autoOpen: false,
        height: 420,
        width: 350,
        modal: true,
        buttons: {
            "Guardar": function() {

                var bValid = true;
                allFields.removeClass( "ui-state-error" );

                bValid = bValid && checkLength( observacion, "observacion", 0, 400,tips );
                bValid = bValid && checkLength( codigo, "codigo", 3, 140,tips );
                
                bValid = bValid && checkLetrasNumeros( codigo,tips );

                if ( bValid ) {

                    loadingadet.css('display','block');

                    frmexpediente.submit();

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
    
    frmsmapa.dialog({
        autoOpen: false,
        height: 400,
        width: 500,
        modal: true,
        buttons: {
            Salir: function() {
                $( this ).dialog( "close" );
            }
        },
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
        }
    });
        
    frmadet.dialog({
        autoOpen: false,
        height: 450,
        width: 500,
        modal: true,
        buttons: {
            "Guardar": function() {

                var bValid = true;
                allFields.removeClass( "ui-state-error" );
                
                bValid = bValid && checkLength( descripciondet, "Descripcion", 0, 800,tips );
                
                if ( bValid ) {
                    loadingadet.css('display','block');
                    frmadet.submit();
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
    
    frmsarch.dialog({
        autoOpen: false,
        height: 580,
        width: 850,
        modal: true,
        buttons: {
            "limpiar": function() {
                
                var cadr= '/index.php/requisito/arbol?idexpediente='+idearch.val();
                cargaarbol(cadr, 'arbolreq',idearch.val());
                $('#det_arch').html('');
            },
            salir: function() {
                $( this ).dialog( "close" );
            }
        },
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
        }
    });
    
    mapa.change(function() {
        $(this).upload('/index.php/expediente/savemapa',{
            idexpediente:mapaid.val()
            }, function(res) {
            $('#imgmapa').html(res);
            $('#imgmapa img').css({
                'height': '220px', 
                'width': '350px'
            });
        }, 'html');
        });
    
    $( "#nuevo_expediente" ).button()
    .click(function() {
        idexpediente.val('-1');
        loadingexped.css('display','none');
        frmexpediente.dialog( "open" );
    });

    $( "#modificar_expediente" ).button()
    .click(function() {

        var indexR = gridexpediente.getGridParam("selrow");
        if (indexR != null){

            espereexped.css('display','block');

            $.get(
                '/index.php/expediente/get',
                {
                    ajax:'ajax',
                    idexpediente:indexR
                },

                function(response){
                    loadingexped.css('display','none');

                    observacion.val(response.response['observacion']);
                    codigo.val(response.response['codigo']);
                    titular.val(response.response['titular']);
                    ubicacion.val(response.response['ubicacion']);
                    fecha.datepicker( "setDate" , response.response['fecha'] )
                    idexpediente.val(response.response['idexpediente']);
                    if (response.response['estado'] != 0)
                        estado.attr('checked', true);
                    else
                        estado.attr('checked', false);
                    estado.val(response.response['estado']);
                    idcategoria.val(response.response['idcategoria']).attr("selected",true);
                    idtipoexp.val(response.response['idtipoexp']).attr("selected",true);

                    espereexped.css('display','none');
                    frmexpediente.dialog( "open" );

                },
                'json'
                );

        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
    });
    
    $( "#subir_mapexpediente" )
    .button()
    .click(function() {

        var indexR = gridexpediente.getGridParam("selrow");
        if (indexR != null){
            mapaid.val(indexR);
            espereexped.css('display','block');
                       
            frmsmapa.dialog( "open" );
            espereexped.css('display','none');
                    
            $.ajax({
                url:'/index.php/expediente/vmap?idexpediente='+indexR,
                type: "GET",
                dataType: "html",
                complete : function (req, err) {
                    $('#imgmapa').html(req.responseText);
                    $('#imgmapa img').css({'height': '220px', 'width': '350px'});
                } 
            });

        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
                    
    });

    $( "#anular_expediente" )
    .button()
    .click(function() {

        var indexR = gridexpediente.getGridParam("selrow");
        if (indexR != null){
            
            espereexped.css('display','block');

            $.get(
                '/index.php/expediente/anular',
                {
                    ajax:'ajax',
                    idexpediente:indexR
                },

                function(response){

                    espereexped.css('display','none');
                    Mensaje('Cambio de Estado correctamente','Anular');
                    gridexpediente.trigger("reloadGrid");

                },
                'json'
                );
                    
        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
                    
    });
        
    $("#listareq").change(function () {
        loadingadet.css('display','block');
        var sela = $("#listareq option:selected").val();
        idlistareq.val(sela);
        
        cargacombo('/index.php/item/getitem',{idrequisito:idlistareq.val()},'listaitem','iditem');
        
        var cadr= '/index.php/archivo/listar?idexpediente='+$('#idexpedi').val()+'&idrequisito='+$('#idlistareq').val();
        arbolarchi(cadr, 'arbolarch',$('#idexpedi').val());
        loadingadet.css('display','none');
    });
    
    $("#listaitem").change(function () {
        loadingadet.css('display','block');
        var seli = $("#listaitem option:selected").val();
        idlistaitem.val(seli);
        cargadetexp(idexpedi.val(),idlistareq.val(),idlistaitem.val());
        loadingadet.css('display','none');
    });

    frmexpediente.submit(function(event) {
            
        event.preventDefault();
            
        var ident;
        if(estado.is(':checked')) {  
            ident='1';  
        } else {  
            ident='0';   
        } 
            
        var selcatego = $("#listacateg option:selected").val();
        var seltipoex = $("#listatiexp option:selected").val();

        $.post(
            '/index.php/expediente/guardar', //URL
            {
                ajax:'ajax',
                observacion: observacion.val(),
                mapa: null,
                idexpediente: idexpediente.val(),
                codigo: codigo.val(),
                fecha: fecha.val(),
                titular: titular.val(),
                ubicacion: ubicacion.val(),
                estado: ident,
                idcategoria: selcatego,
                idtipoexp: seltipoex
            },//parametros

            function(response){
                frmexpediente.dialog( "close" );
                gridexpediente.trigger("reloadGrid");
            },
            'json'//tipo de dato debuelto
            );
    });
    
    frmadet.submit(function(event) {
            
        event.preventDefault();

        $.post(
            '/index.php/expediente/savedet', //URL
            {
                ajax:'ajax',
                idexpediente: idexpedi.val(),
                idrequisito: idlistareq.val(),
                iditem: idlistaitem.val(),
                archivo: idarc.val(),
                descripcion: descripciondet.val()
            },//parametros

            function(response){//funcion para procesar los datos
                loadingadet.css('display','none');
                Mensaje('Guardado Correctamente','Seleccione');
            },
            'json'//tipo de dato debuelto
            );
    });
});

function selreqarch(idra,depend){
        $('#depend').val(depend);
        $("#idreqarch").val(idra);
        $("#arbolreq .folder a").css({'color':'black','font-weight':'normal'});
        $("#lar"+idra).css({'color':'green','font-weight':'bold'});
        $("#cargaarch_expediente").css("display","block");
        
        if($('#depend').val()!='0'){
            $.get(
                '/index.php/requisito/get',
                {
                    ajax:'ajax',
                    idrequisito:$("#idreqarch").val()
                },

                function(response){
                    
                    $('#carpreq').val(response.response['descripcion']);

                    $("#cargaarch_expediente").css("display","none");

                },
                'json'
                );
        } else {
            $('#carpreq').val(null);
        }
    };