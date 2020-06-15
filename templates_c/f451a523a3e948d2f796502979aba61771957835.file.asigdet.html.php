<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:26:23
         compiled from "./templates/expediente/asigdet.html" */ ?>
<?php /*%%SmartyHeaderCode:12249437714f17713fb8bde5-61500937%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f451a523a3e948d2f796502979aba61771957835' => 
    array (
      0 => './templates/expediente/asigdet.html',
      1 => 1325109595,
    ),
  ),
  'nocache_hash' => '12249437714f17713fb8bde5-61500937',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<style>
    .archidet{
        float: left;
        margin: 0;
        padding: 0;
        width: 43%;
    }
    
    #arbolarch * a{
        color: #2694e8;
    }
</style>
<div id="frm_adet" title="Administrar Detalle Expediente" class="formulario">
<script type="text/javascript" src="/js/modulos/adetexp.js"></script>
    <p class="validar_adet">Ingrese los datos.</p>

    <form action="/index.php/expediente/adet" method="post" name="frm_adet">
        <div class="dfexp">
            <label for="listareq">Requisito :</label>
            <select name="listareq" id="listareq"></select>
        </div><div class="dfexp">
            <label for="listaitem">Items :</label>
            <select name="listaitem" id="listaitem"></select>
        </div>
        <div class="dfexp">
            <label for="descripciondet">Descripcion :</label>
            <input type="text" name="descripciondet" id="descripciondet" class="text ui-widget-content ui-corner-all" />
        </div>
        <div class="dfexp">
            <fieldset class="archidet"><legend>Lista de Archivos :</legend><div id="arbolarch" ></div></fieldset>
            <fieldset class="archidet"><legend>Datos de Archivo :</legend><a href="javascript:void(0)" id="larch0" onclick="selecarchdet(0,0);">Quitar</a><div id="detselarch" ></div></fieldset>
        </div>
        <input type="hidden" name="idexpedi" id="idexpedi" />
        <input type="hidden" name="idlistareq" id="idlistareq" />
        <input type="hidden" name="idar" id="idar" value="0" />
        <input type="hidden" name="idlistaitem" id="idlistaitem" />

    </form>
    <p class="cargando_adet"><img alt="" src="/images/ajax-loader.gif">Procesando...</p>

</div>