$(function() {
    $( "#dialog:ui-dialog" ).dialog( "destroy" );
       
    var frmadet = $( "#frm_adet" );
    var espereexped = $( ".espere_expediente" );
    
    var idexpedi=$('#idexpedi');
    var loadadet=$('#cargando_adet');
    var idlistaitem=$('#idlistaitem');
    
    $('#larch0').css('color', 'red');
    $('#larch0').css('display', 'none');
    var gridexpediente = $("#lsexpediente");
    
    loadadet.css('display','none');
      
    $( "#adet_expediente" ).button()
    .click(function() {
                    
        var indexR = gridexpediente.getGridParam("selrow");
        
        if (indexR != null){
            idexpedi.val(indexR);
            espereexped.css('display','block');

            cargacombo('/index.php/requisito/getreq',{
                idexpediente:idexpedi.val()
                },'listareq','idrequisito');
            frmadet.dialog( "open" );
            espereexped.css('display','none');
            
            
        }else
            Mensaje('Seleccione un valor de la grilla','Seleccione');
    });

});

function cargacombo(url,data,cmb,llave){

    $.getJSON(url,data, function(json){
        $('#'+cmb).html('');
        
        var cadena='';
        $.each(json, function(index, objreq){
            $.each(objreq,function(clave,id){
                if (clave == llave)
                    cadena = '<option value="'+id+'" >';
                                                    
                if (clave == 'descripcion')
                    cadena = cadena + id + '</option>'; 
            });
            
            $('#'+cmb).append(cadena);
        });
        $('#'+cmb).selectedIndex=0;
        $("#id"+cmb).val($('#'+cmb).val());
        if (cmb=='listareq'){
            cargacombo('/index.php/item/getitem',{
                idrequisito:$('#idlistareq').val()
                },'listaitem','iditem');
            var cadr= '/index.php/archivo/listar?idexpediente='+$('#idexpedi').val()+'&idrequisito='+$('#idlistareq').val();
            arbolarchi(cadr, 'arbolarch',$('#idexpedi').val());
        }
        if (cmb=='listaitem')
            cargadetexp($('#idexpedi').val(),$('#idlistareq').val(),$('#idlistaitem').val());
    });
        
}
    
function cargadetexp(idex,idre,idit){
    $('#descripciondet').val(null);
    $.ajax({
        data:{
            idexpediente:idex,
            idrequisito:idre,
            iditem:idit
        },
        type:"GET",
        dataType:"json",
        url: '/index.php/expediente/getditem',
        success: function(data){
            $.each(data, function(index, objdet){
                $.each(objdet, function(col, valor){
                    if (col=='descripcion')
                        $('#descripciondet').val(valor);
                    if (col=='archivo')
                        selecarchdet(valor,'1');
                });
            });
        }
    });
}

function arbolarchi(url,idcomp,idexp){

    $.ajax({
        url:url,
        type: "GET",
        dataType: "html",
        complete : function (req, err) {
            $('#'+idcomp).html(req.responseText);
//            $("#lia"+idexp).treeview({
//                unique: true,
//                animated: "fast"
//            });
            $('#idar').val('0');
        } 
    });
        
}

function selecarchdet(ida,acio){
    $('#idar').val(ida);
    $('#larch0').css('display', 'block');
    $("#arbolarch * a").css({
        'color':'#2694e8',
        'font-weight':'normal'
    });
    
    if (acio=='1' && ida!='0'){
        $("#larch"+ida).css({
            'color':'blue',
            'font-weight':'bold'
        });
    
        $("#cargando_adet").css("display","block");
    
        $.get(
            '/index.php/archivo/get',
            {
                ajax:'ajax',
                idarchivo:$('#idar').val()
            },

            function(response){
                $("#cargando_adet").css("display","none");
            },
            'json'
            );
        $.ajax({
            url:'/index.php/archivo/varch?idarchivo='+$('#idar').val(),
            type: "GET",
            dataType: "html",
            complete : function (req, err) {
                $('#detselarch').html(req.responseText); 
                $('#detselarch a').css({
                    'font-style': 'italic', 
                    'font-weight': 'bolder',
                    'color': 'red'
                });
            } 
        });
    } else {
        $('#detselarch').html('');
        $('#larch0').css('display', 'none');
    }             
}