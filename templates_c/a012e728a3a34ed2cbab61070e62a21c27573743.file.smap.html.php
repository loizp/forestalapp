<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:26:23
         compiled from "./templates/expediente/smap.html" */ ?>
<?php /*%%SmartyHeaderCode:14980044024f17713fbe3688-46816568%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a012e728a3a34ed2cbab61070e62a21c27573743' => 
    array (
      0 => './templates/expediente/smap.html',
      1 => 1325097101,
    ),
  ),
  'nocache_hash' => '14980044024f17713fbe3688-46816568',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="frm_mapexpediente" title="Subir Mapa de Expediente" class="formulario">

    <p class="validar_mapexpediente">Subir Imagen menor a 2MB</p>

    <form action="/index.php/expediente/savemapa" enctype="multipart/form-data" method="post" name="frm_mapexpediente">
        <div class="dfexp">
            <label for="mapa">Mapa :</label>
            <input type="file" name="mapa" id="mapa" class="text ui-widget-content ui-corner-all" />
        </div>
        <input type="hidden" name="mapaid" id="mapaid" />

    </form>
    
    <p class="cargando_mapexpediente"><img alt="" src="/images/ajax-loader.gif">Procesando...</p>
    
    <div id="imgmapa"></div>
</div>