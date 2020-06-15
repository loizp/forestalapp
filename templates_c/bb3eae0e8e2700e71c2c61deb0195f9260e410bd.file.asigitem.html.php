<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:12:43
         compiled from "./templates/requisito/asigitem.html" */ ?>
<?php /*%%SmartyHeaderCode:11462183104f176e0bd9ab86-46802863%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb3eae0e8e2700e71c2c61deb0195f9260e410bd' => 
    array (
      0 => './templates/requisito/asigitem.html',
      1 => 1324415666,
    ),
  ),
  'nocache_hash' => '11462183104f176e0bd9ab86-46802863',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="frm_aitem" title="Registrar Items" class="formulario">
    <script type="text/javascript" src="/js/modulos/aitemreq.js"></script>
    <p class="validar_aitem">Ingrese nuevo item.</p>
    <br />

    <form action="/index.php/item/guardar" method="post" name="frm_aitem">
        <center><label for="idrequi">Asignar a CategoriaID :</label>
            <input type="text" name="idrequi" id="idrequi" value="" size="3" readonly /></center>
        <br /><br />
        <label for="anombre">Nombre :</label>
        <input type="text" name="anombre" id="anombre" class="text ui-widget-content ui-corner-all" />
        <br /><br />
        <label for="descripcionaitem">Descripcion :</label>
        <input type="text" name="descripcionaitem" id="descripcionaitem" class="text ui-widget-content ui-corner-all" />

        <input type="hidden" name="aiditem" id="aiditem" value ="-1"/>

    </form>

    <br />
    <div>
        <table id="lsaitem"></table> 
        <div id="pgaitem" ></div> 
    </div>
    <br /> 
    <div class="espere_aitem" style="color: red;font-size: 12px;font-weight: bold">
        Procesando... <img alt="" src="/images/ajax-loader.gif" />
    </div>

</div>