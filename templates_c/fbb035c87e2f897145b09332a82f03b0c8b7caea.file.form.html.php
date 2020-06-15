<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:20:51
         compiled from "./templates/tipoexp/form.html" */ ?>
<?php /*%%SmartyHeaderCode:493137994f176ff3cb2e79-58047968%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fbb035c87e2f897145b09332a82f03b0c8b7caea' => 
    array (
      0 => './templates/tipoexp/form.html',
      1 => 1323892350,
    ),
  ),
  'nocache_hash' => '493137994f176ff3cb2e79-58047968',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="frm_tipoexp" title="Administrar los tipos de Expedientes" class="formulario">

	<p class="validar_tipoexp">Ingrese los datos.</p>
        <br />

        <form action="/index.php/tipoexp/guardar" method="post" name="frm_tipoexp">

		<label for="descripcion">Descripcion :</label>
		<input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" />
                
                <input type="hidden" name="idtipoexp" id="idtipoexp" value ="-1"/>
                
	</form>
        <p class="cargando_tipoexp"><img alt="" src="/images/ajax-loader.gif">Procesando...</p>
        
</div>