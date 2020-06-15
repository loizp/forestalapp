<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:11:36
         compiled from "./templates/usermod.html" */ ?>
<?php /*%%SmartyHeaderCode:13129865964f176dc8a7ec98-36756307%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6fc8cbfba494436f3c802b98ba142c20b940bfe2' => 
    array (
      0 => './templates/usermod.html',
      1 => 1325537896,
    ),
  ),
  'nocache_hash' => '13129865964f176dc8a7ec98-36756307',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="frm_usermod" title="Modificar Usuario" class="formulario">

    <p class="validar_usermod">Ingrese los datos.</p>
    <br />

    <form action="/index.php/usuario/guardar" method="post" name="frm_usermod">

        <label for="nicku">Titulo :</label>
        <input type="text" name="nicku" value="<?php echo $_smarty_tpl->getVariable('login')->value['nick'];?>
" id="nicku" class="text ui-widget-content ui-corner-all" />
        <br /><br />
        <label for="loginu">Usuario :</label>
        <input type="text" name="loginu" id="loginu" value="<?php echo $_smarty_tpl->getVariable('login')->value['login'];?>
" class="text ui-widget-content ui-corner-all" />
        <br /><br />
        <label for="pass1u">Clave :</label>
        <input type="password" name="pass1u" value="" id="pass1u" class="text ui-widget-content ui-corner-all" />
        <br /><br />
        <label for="pass2u">Repetir Clave :</label>
        <input type="password" name="pass2u" value="" id="pass2u" class="text ui-widget-content ui-corner-all" />

        <input type="hidden" name="iduser" id="iduser" value ="<?php echo $_smarty_tpl->getVariable('login')->value['idusuario'];?>
"/>

    </form>
    <p class="cargando_usermod"><img alt="" src="/images/ajax-loader.gif" />Procesando...</p>

</div>