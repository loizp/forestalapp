<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:12:43
         compiled from "./templates/requisito/form.html" */ ?>
<?php /*%%SmartyHeaderCode:15054080134f176e0bd2dee4-15691606%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6a09cd94a9e6b36ae788b4b696ea7107b396778' => 
    array (
      0 => './templates/requisito/form.html',
      1 => 1323892992,
    ),
  ),
  'nocache_hash' => '15054080134f176e0bd2dee4-15691606',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="frm_requisito" title="Administrar los tipos de Expedientes" class="formulario">

	<p class="validar_requisito">Ingrese los datos.</p>
        <br />

        <form action="/index.php/requisito/guardar" method="post" name="frm_requisito">

		<label for="descripcionreq">Descripcion :</label>
		<input type="text" name="descripcionreq" id="descripcionreq" class="text ui-widget-content ui-corner-all" />
                
                <input type="hidden" name="dependencia" id="dependencia" value ="0"/>
                <input type="hidden" name="idrequisito" id="idrequisito" value ="-1"/>
                
	</form>
        <p class="cargando_requisito"><img alt="" src="/images/ajax-loader.gif">Procesando...</p>
        
</div>