<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:20:51
         compiled from "./templates/tipoexp/list.html" */ ?>
<?php /*%%SmartyHeaderCode:16952617474f176ff3c4f331-96417297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c59d4747df8dcacc1e6a7f644cc4c5b3f9a332c' => 
    array (
      0 => './templates/tipoexp/list.html',
      1 => 1323892322,
    ),
  ),
  'nocache_hash' => '16952617474f176ff3c4f331-96417297',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script type="text/javascript" src="/js/modulos/tipoexp.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grillatipoexp')->value;?>
</script>

<table id="lstipoexp"></table>
<div id="pgtipoexp"></div>


<button id="nuevo_tipoexp">Nuevo</button>
<button id="modificar_tipoexp">Modificar</button>
<button id="anular_tipoexp">borrar</button>

<div class="espere_tipoexp" style="color: red;font-size: 12px;font-weight: bold">
    Procesando... <img alt="" src="/images/ajax-loader.gif">
</div>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('form')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
