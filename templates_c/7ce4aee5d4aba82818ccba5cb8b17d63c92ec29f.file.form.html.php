<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:12:12
         compiled from "./templates/categoria/form.html" */ ?>
<?php /*%%SmartyHeaderCode:2450877964f176dec7f7672-15809260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ce4aee5d4aba82818ccba5cb8b17d63c92ec29f' => 
    array (
      0 => './templates/categoria/form.html',
      1 => 1325795239,
    ),
  ),
  'nocache_hash' => '2450877964f176dec7f7672-15809260',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="frm_categoria" title="Administrar categorias" class="formulario">

    <p class="validar_categoria">Ingrese los datos.</p>
    <br />

    <form action="/index.php/categoria/guardar" method="post" name="frm_categoria">

        <label for="titulo">Titulo :</label>
        <input type="text" name="titulo" id="titulo" class="text ui-widget-content ui-corner-all" />
        <br /><br />
        <label for="descripcioncat">Descripcion :</label>
        <input type="text" name="descripcioncat" id="descripcioncat" class="text ui-widget-content ui-corner-all" />

        <input type="hidden" name="idcategoria" id="idcategoria" value ="-1"/>

    </form>
    <p class="cargando_categoria"><img alt="" src="/images/ajax-loader.gif" />Procesando...</p>

</div>