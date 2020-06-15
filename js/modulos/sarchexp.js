$(function() {
    $( "#dialog:ui-dialog" ).dialog( "destroy" );
       
    var frmsarch = $( "#frmarch_expediente" );
    var espereexped = $( ".espere_expediente" );
    var loadarch = $( ".cargaarch_expediente" );
    
    var idexparch=$('#idexparch');
    var idrearch=$('#idreqarch');
    var carprequi=$('#carpreq');
    var idreqnuevo=$('#idreqnuevo');
    var depend=$('#depend');
    var idarchi=$('#idarchi');
    var ndoc=$('#ndoc');
    var estadoarch=$('#estadoarch');
    var subir=$('#sub');
    
    var gridexpediente = $("#lsexpediente");

    $("#btnarch_expediente").button()
    .click(function() {
        
        var indexR = gridexpediente.getGridParam("selrow");
        
        if (indexR != null){
            espereexped.css("display","block");
            
            idexparch.val(indexR);
            
            var cad= '/index.php/requisito/arbol?idexpediente='+indexR;
            cargaarbol(cad, 'arbolreq',indexR);
            $('#det_arch').html('');
            frmsarch.dialog( "open" );
            espereexped.css("display","none");
        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
    });
    
    $( "#borra_carpreq" ).button()
    .click(function() {
        if(idrearch.val()=='-1'){
            Mensaje('Seleccione un Requisito','Seleccione');
        } else {
            if(depend.val()=='0'){
                Mensaje('Requisito Principal no se puede Editar','Seleccione');
            } else {
                loadarch.css("display","block");
                $.get(
                    '/index.php/requisito/borrar',
                    {
                        ajax:'ajax',
                        idrequisito:idrearch.val(),
                        idexpediente:idexparch.val()
                    },

                    function(response){
                        var cadr= '/index.php/requisito/arbol?idexpediente='+idexparch.val();
                        cargaarbol(cadr, 'arbolreq',idexparch.val());
                        Mensaje('Borrado correctamente','Anular');
                        loadarch.css('display','none');
                    
                    },
                    'json'
                    );
                
            }
            
        }
    });
    
    $( "#mod_carpreq" ).button()
    .click(function() {
        if(idrearch.val()=='-1'){
            Mensaje('Seleccione un Requisito','Seleccione');
        } else {
            if(depend.val()=='0'){
                Mensaje('Requisito Principal no se puede Editar','Seleccione');
            } else {
                if(carprequi.val().length < 2){
                    Mensaje('ingrese nombre de carpeta','Seleccione');
                } else {
                    loadarch.css("display","block");
                    $.post(
                        '/index.php/requisito/guardar', //URL
                        {
                            ajax:'ajax',
                            dependencia: depend.val(),
                            descripcion: carprequi.val(),
                            idrequisito: idrearch.val()
                        },//parametros

                        function(response){//funcion para procesar los datos
                            var cadr= '/index.php/requisito/arbol?idexpediente='+idexparch.val();
                            cargaarbol(cadr, 'arbolreq',idexparch.val());
                            loadarch.css("display","none");
                        },
                        'json'//tipo de dato debuelto
                        );
                }
            }
            
        }
    });
    
    $( "#nuevo_carpreq" ).button()
    .click(function() {
        if(idrearch.val()=='-1'){
            Mensaje('Seleccione un Requisito','Seleccione');
        } else {
            if(carprequi.val().length < 2){
                Mensaje('ingrese nombre de carpeta','Seleccione');
            } else {
                loadarch.css("display","block");
                $.post(
                    '/index.php/requisito/guardar', //URL
                    {
                        ajax:'ajax',
                        dependencia: idrearch.val(),
                        descripcion:carprequi.val(),
                        idrequisito: idreqnuevo.val()
                    },//parametros

                    function(response){//funcion para procesar los datos
                        var cadr= '/index.php/requisito/arbol?idexpediente='+idexparch.val();
                        cargaarbol(cadr, 'arbolreq',idexparch.val());
                        loadarch.css("display","none");
                    },
                    'json'//tipo de dato debuelto
                    );
            }
            
        }
    });
    
    $("#sarchi").change(function() {
        subir.val('1');
    });
    
    $( "#upload_button" ).button()
    .click(function() {
        if(idrearch.val()=='-1'){
            Mensaje('Seleccione un Requisito','Seleccione');
        } else {
            if(subir.val()=='1'){
                if(ndoc.val().length>4 && ndoc.val().length<150){
                    loadarch.css("display","block");
                    var ident;
                    if(estadoarch.is(':checked')) {  
                        ident='1';  
                    } else {  
                        ident='0';   
                    } 
                    $("#sarchi").upload('/index.php/archivo/guardar',
                    {
                        idarchivo:idarchi.val(),
                        idexpediente:idexparch.val(), 
                        idrequisito:idrearch.val(),
                        numdoc:ndoc.val(),
                        estado:ident
                    }, function(res) {
                        $('#det_arch').html(res); 
                        $('#det_arch a').css({
                            'font-style': 'italic', 
                            'font-weight': 'bolder',
                            'color': 'red'
                        });
                        var cadr= '/index.php/requisito/arbol?idexpediente='+idexparch.val();
                        cargaarbol(cadr, 'arbolreq',idexparch.val());
                        loadarch.css("display","none");
                    }, 'html');
                } else
                    Mensaje('Ingrese numero de documento Unico menor a 140 caracteres','Seleccione');
            } else 
                Mensaje('Busca y selecione un Archivo para subir','Seleccione');
        }
    });
    
    $( "#modarch_button" ).button()
    .click(function() {
        if(idrearch.val()=='-1'){
            Mensaje('Seleccione un Requisito','Seleccione');
        } else {
            if(idarchi.val()!='-1'){
                loadarch.css("display","block");
                var ident;
                if(estadoarch.is(':checked')) {  
                    ident='1';  
                } else {  
                    ident='0';   
                }
                if(subir.val()=='1'){
                    $("#sarchi").upload('/index.php/archivo/guardar',
                    {
                        idarchivo:idarchi.val(),
                        estado:ident,
                        numdoc:ndoc.val()
                    }, function(res) {
                        $('#det_arch').html(res); 
                        $('#det_arch a').css({
                            'font-style': 'italic', 
                            'font-weight': 'bolder',
                            'color': 'red'
                        });
                        var cadr= '/index.php/requisito/arbol?idexpediente='+idexparch.val();
                        cargaarbol(cadr, 'arbolreq',idexparch.val());
                        loadarch.css("display","none");
                    }, 'html');
                } else {
                    $.post(
                        '/index.php/archivo/actualiza', //URL
                        {
                            ajax:'ajax',
                            idarchivo:idarchi.val(),
                            estado:ident
                        },//parametros

                        function(response){//funcion para procesar los datos
                            var cadr= '/index.php/requisito/arbol?idexpediente='+idexparch.val();
                            cargaarbol(cadr, 'arbolreq',idexparch.val());
                            $('#det_arch').html('');
                            loadarch.css("display","none");
                        },
                        'json'//tipo de dato debuelto
                        );
                }
                
            } else
                Mensaje('Seleccione un archivo de la lista a modificar','Seleccione');
        }
    });
    
    $( "#borraarch_button" ).button()
    .click(function() {
        if(idrearch.val()=='-1'){
            Mensaje('Seleccione un Requisito','Seleccione');
        } else {
            if(idarchi.val()!='-1'){
                loadarch.css("display","block");
                $.get(
                    '/index.php/archivo/borrar',
                    {
                        ajax:'ajax',
                        idarchivo:idarchi.val()
                    },

                    function(response){
                        var cadr= '/index.php/requisito/arbol?idexpediente='+idexparch.val();
                        cargaarbol(cadr, 'arbolreq',idexparch.val());
                        Mensaje('Borrado correctamente','Anular');
                        loadarch.css('display','none');
                        $('#det_arch').html('');
                    },
                    'json'
                    );
            } else 
                Mensaje('Seleccione un archivo de la lista','Seleccione');
        }
    });

});

function cargaarbol(url,idcomp,idexp){

    $.ajax({
        url:url,
        type: "GET",
        dataType: "html",
        complete : function (req, err) {
            $('#'+idcomp).html(req.responseText);
            $("#li"+idexp).treeview({
                unique: true,
                animated: "fast"
            });
            $('#idreqarch').val('-1');
            $('#idarchi').val('-1');
            $('#depend').val('-1');
            $('#ndoc').val('');
            $('#estadoarch').attr('checked', false);
            $('#carpreq').val('');
            $('#sub').val('0');
            $("#ndoc").attr("readOnly",false);
            $("#upload_button").removeAttr("disabled");
        } 
    });
        
}
    
function selecarchivo(ida,idr,dep){
    $('#idarchi').val(ida);
    
    $("#arbolreq .file a").css({
        'color':'black',
        'font-weight':'normal'
    });
    $("#lfile"+ida).css({
        'color':'blue',
        'font-weight':'bold'
    });
    
    selreqarch(idr,dep);
    
    $("#cargaarch_expediente").css("display","block");
    
    $.get(
        '/index.php/archivo/get',
        {
            ajax:'ajax',
            idarchivo:$('#idarchi').val()
        },

        function(response){
                    
            $('#ndoc').val(response.response['numdoc']);
            if (response.response['estado'] != 0)
                $('#estadoarch').attr('checked', true);
            else
                $('#estadoarch').attr('checked', false);
            $("#ndoc").attr("readOnly",true);
            $("#upload_button").attr("disabled","disabled");
            $("#cargaarch_expediente").css("display","none");

        },
        'json'
        );
    $.ajax({
        url:'/index.php/archivo/varch?idarchivo='+$('#idarchi').val(),
        type: "GET",
        dataType: "html",
        complete : function (req, err) {
            $('#det_arch').html(req.responseText); 
            $('#det_arch a').css({
                'font-style': 'italic', 
                'font-weight': 'bolder',
                'color': 'red'
            });
        } 
    });
               
}