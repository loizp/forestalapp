// Utilidades basicas de java script

function ucWords(string){
    var arrayWords;
    var returnString = "";
    var len;


    if(string == null)
        return string;
     
    arrayWords = string.split(" ");
    len = arrayWords.length;
    for(i=0;i < len ;i++){
        if(i != (len-1)){
            returnString = returnString+ucFirst(arrayWords[i])+" ";
        }
        else{
            returnString = returnString+ucFirst(arrayWords[i]);
        }
    }
    return returnString;
}

function ucFirst(string){
    return string.toUpperCase();
}

function trim(cadena,campo)
{


    for(i=0; i<cadena.length; )
    {
        if(cadena.charAt(i)==" ")
            cadena=cadena.substring(i+1, cadena.length);
        else
            break;
    }

    for(i=cadena.length-1; i>=0; i=cadena.length-1)
    {
        if(cadena.charAt(i)==" ")
            cadena=cadena.substring(0,i);
        else
            break;
    }

    document.getElementById(campo).value=cadena;
    
    return cadena;
}

function BorrarEspacio(cadena)
{


    for(i=0; i<cadena.length; )
    {
        if(cadena.charAt(i)==" ")
            cadena=cadena.substring(i+1, cadena.length);
        else
            break;
    }

    for(i=cadena.length-1; i>=0; i=cadena.length-1)
    {
        if(cadena.charAt(i)==" ")
            cadena=cadena.substring(0,i);
        else
            break;
    }

    return cadena;
}

function ValidarFecha(Cadena,caja){
    var Fecha= new String(Cadena)   // Crea un string
    // Cadena Año
    var Ano= new String(Fecha.substring(Fecha.lastIndexOf("/")+1,Fecha.length))
    // Cadena Mes
    var Mes= new String(Fecha.substring(Fecha.indexOf("/")+1,Fecha.lastIndexOf("/")))
    // Cadena Día
    var Dia= new String(Fecha.substring(0,Fecha.indexOf("/")))

    // Valido el año
    if (isNaN(Ano) || Ano.length<4 || parseFloat(Ano)<1900){
        return 'Año inválido de ' + caja;
    }
    // Valido el Mes
    if (isNaN(Mes) || parseFloat(Mes)<1 || parseFloat(Mes)>12){
        return 'Mes inválido de ' + caja;
    }
    // Valido el Dia
    if (isNaN(Dia) || parseInt(Dia, 10)<1 || parseInt(Dia, 10)>31){
        return 'Día inválido de ' + caja;
    }
    if (Mes==4 || Mes==6 || Mes==9 || Mes==11 || Mes==2) {

        var diasF = 28;

        if(Ano%4 == 0 && Ano%100 != 0){
            diasF = 29;
        }

        if ((Mes==2 && Dia > diasF) || Dia>30) {
            return 'Día inválido de ' + caja;
        }
    }

    //para que envie los datos, quitar las  2 lineas siguientes
    //  alert("Fecha correcta.")
    return true
}




///FUNCIONES PARA EL LOGIN
var cadena="";

function concatenar(id,txt){
    dato=document.getElementById(id).value;
    cadena=cadena+dato;
    document.getElementById(txt).value=cadena;

}
function limpiar(id1,id2){
    document.getElementById(id1).value="";
    document.getElementById(id2).value="";
    cadena="";
}
function validaclave(o1,o2,tips){
    if ( o1.val()!= o2.val()) {
        o1.addClass( "ui-state-error" );
        o2.addClass( "ui-state-error" );
        updateTips( tips,"Claves deben ser iguales" );
        return false;
    } else {
        return true;
    }
}

///FUNCIONES DE VALIDACION DE JQUERY UI

function updateTips(tips, t ) {
    tips.text( t ).addClass( "ui-state-highlight" );
    setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
}
        
function checkLength( o, n, min, max ,tips) {
    if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( tips,"Longitud de " + n + " deve estar entre " +
            min + " y " + max + "." );
        return false;
    } else {
        return true;
    }
}

function checkRegexp( o, regexp, n,tips ) {
    if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips(tips, n );
        return false;
    } else {
        return true;
    }
}

function checkEmail( o,tips ) {
    return checkRegexp( o, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "Ej. persona@mimail.com" ,tips );
}

function checkLetrasNumeros(o,tips ) {
    return checkRegexp( o, /^[a-zA-Z]([0-9a-z_\d\s])+$/i, "Campo deve contener a-z, 0-9.",tips );
}

function checkNumeros(o,tips ) {
    return checkRegexp( o, /^([0-9])+$/i, "Campo deve contener solo numeros.",tips );
}

function checkLetras(o,tips ) {
    return checkRegexp( o, /^[a-zA-Z]([a-zA-Z\d\s])+$/i, "Campo deve contener solo letras.",tips );
}

function checkDireccion(o,tips ) {
    return checkRegexp( o, /[A-Za-z.#\d\s]/, "Campo direccion incorrecto.",tips );
}

//Mensajes

var Mensaje;

$(document).ready(function(){

    Mensaje = function (msg,title, icon, fpostprocess){

        var div = document.createElement("div");
        $(div).html(msg);

        $(document).append(div);


        $(div).dialog({
            title: title,
            modal: true,
            buttons: {
                "OK": function() {
                    $(this).dialog("close");
                    $(this).dialog("destroy");
                    $(div).remove();
                }
            },
            open: function(e,ui){
                $(div).find("button").focus();
            },
            close: function(e,ui) {
                if ( typeof(fpostprocess) == 'function' ) fpostprocess();
            }
        });
    };
            
    $("#litree").treeview();

});