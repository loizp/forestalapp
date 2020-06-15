<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:26:23
         compiled from "./templates/expediente/list.html" */ ?>
<?php /*%%SmartyHeaderCode:9502132274f17713fa85ea0-68100452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2dac5baed4a9803960388bf43f854c49e4a7eac4' => 
    array (
      0 => './templates/expediente/list.html',
      1 => 1324497137,
    ),
  ),
  'nocache_hash' => '9502132274f17713fa85ea0-68100452',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script type="text/javascript" src="/js/modulos/expediente.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grillaexpediente')->value;?>
</script>

<table id="lsexpediente"></table>
<div id="pgexpediente"></div>


<button id="nuevo_expediente">Nuevo</button>
<button id="modificar_expediente">Modificar</button>
<button id="subir_mapexpediente">Subir Mapa</button>
<button id="anular_expediente">Cambiar Estado</button>
<button id="adet_expediente">Registro Detalle</button>
<button id="btnarch_expediente">Subir Archivo</button>

<div class="espere_expediente" style="color: red;font-size: 12px;font-weight: bold">
    Procesando... <img alt="" src="/images/ajax-loader.gif" />
</div>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('form')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('fasig')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template("expediente/sarch.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template("expediente/smap.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
