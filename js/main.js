var mainLayout;

$(document).ready(function () {
    
    $( "#dialog:ui-dialog" ).dialog( "destroy" );
    
    var frmusermod = $( "#frm_usermod" );
    var tips = $( ".validar_usermod" );
    var loadmoduser = $( ".cargando_usermod" );
    
    var nicku = $( "#nicku" );
    var loginu = $( "#loginu" );
    var pass1u = $( "#pass1u" );
    var pass2u = $( "#pass2u" );
    var iduser = $( "#iduser" );
    
    var allFields = $([])
    .add(nicku)
    .add(loginu)
    .add(pass1u)
    .add(pass2u)
    .add(iduser);
    
    loadmoduser.css('display','none');
    
    mainLayout = $('#dashboard').layout({
        resizerClass: 'ui-state-default',
        west__onresize: function (pane, $Pane) {
            jQuery("#west-grid").jqGrid('setGridWidth',$Pane.innerWidth()-2);
        }
    });
   
    $.jgrid.defaults = $.extend($.jgrid.defaults,{
        loadui:"enable"
    });

    var maintab =jQuery('#tabs','#centerPane').tabs({
        add: function(e, ui) {
            $(ui.tab).parents('li:first')
            .append('<span class="ui-tabs-close ui-icon ui-icon-close" title="Cerrar Tab"></span>')
            .find('span.ui-tabs-close')
            .click(function() {
                maintab.tabs('remove', $('li', maintab).index($(this).parents('li:first')[0]));
            });
            maintab.tabs('select', '#' + ui.panel.id);
        }
    });

    dashreport('/index.php/expediente/report','');

    jQuery("#west-grid").jqGrid({
        url: "/lib/tree.xml",
        datatype: "xml",
        height: "auto",
        pager: false,
        loadui: "disable",
        colNames: ["id","Menu","url"],
        colModel: [
        {
            name: "id", 
            width:1, 
            hidden:true, 
            key:true
        },

        {
            name: "menu", 
            width:130, 
            resizable: false, 
            sortable:false
        },

        {
            name: "url", 
            width:1, 
            hidden:true
        }
        ],
        treeGrid: true,
        caption: "Panel de Administracion",
        ExpandColumn: "menu",
        autowidth: true,
        rowNum: 200,
        ExpandColClick: true,
        treeIcons: {
            leaf:'ui-icon-document-b'
        },
        onSelectRow: function(rowid) {
            var treedata = $("#west-grid").jqGrid('getRowData',rowid);

            if(treedata.isLeaf=="true") {
                //treedata.url
                var st = "#t"+treedata.id;

                if($(st).html() != null ) {
                    maintab.tabs('select',st);
                } else {

                    maintab.tabs('add',st, treedata.menu);

                    $.ajax({
                        url: treedata.url,
                        type: "GET",
                        dataType: "html",
                        complete : function (req, err) {
                            $(st,"#tabs").append(req.responseText);
                        } 
                    });
                }
            }
        }

    });
    
    frmusermod.dialog({
        autoOpen: false,
        height: 450,
        width: 500,
        modal: true,
        buttons: {
            "Guardar": function() {

                var bValid = true;
                allFields.removeClass( "ui-state-error" );
                
                bValid = bValid && checkLength( loginu, "Usuario", 3, 45,tips );
                
                if(pass1u.val().length > 0){
                    bValid = bValid && checkLength( pass1u, "Clave", 6, 20,tips );
                    bValid = bValid && validaclave( pass1u,pass2u,tips );
                } else
                    pass1u.val('0');
                
                if ( bValid ) {
                    loadmoduser.css('display','block');
                    frmusermod.submit();
                }
            },
            Cancelar: function() {
                $( this ).dialog( "close" );
            }
        },
        close: function() {
            allFields.removeClass( "ui-state-error" );
        }
    });
    
    frmusermod.submit(function(event) {
            
        event.preventDefault();

        $.post(
            '/index.php/usuario/save', //URL
            {
                ajax:'ajax',
                idusuario: iduser.val(),
                nick: nicku.val(),
                login: loginu.val(),
                pwd: pass1u.val()
            },//parametros

            function(response){//funcion para procesar los datos
                loadmoduser.css('display','none');
                Mensaje('Guardado Correctamente','Seleccione');
                pass1u.val('');
                pass2u.val('');
            },
            'json'//tipo de dato debuelto
            );
    });
    
});

function dashreport(url,idc){
    
    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
        complete : function (req, err) {
            $("#tabs-1").html(req.responseText);
        } 
    });
}

function moduser(idu){
    $( "#frm_usermod" ).dialog( "open" );
}