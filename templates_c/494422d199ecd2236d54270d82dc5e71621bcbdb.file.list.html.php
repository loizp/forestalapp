<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:12:12
         compiled from "./templates/categoria/list.html" */ ?>
<?php /*%%SmartyHeaderCode:20921039514f176dec7682d4-88231479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '494422d199ecd2236d54270d82dc5e71621bcbdb' => 
    array (
      0 => './templates/categoria/list.html',
      1 => 1323894509,
    ),
  ),
  'nocache_hash' => '20921039514f176dec7682d4-88231479',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script type="text/javascript" src="/js/modulos/categoria.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grillacategoria')->value;?>
</script>

<table id="lscategoria"></table>
<div id="pgcategoria"></div>


<button id="nuevo_categoria">Nuevo</button>
<button id="modificar_categoria">Modificar</button>
<button id="anular_categoria">Borrar</button>
<button id="areq_categoria">Agregar Req.</button>

<div class="espere_categoria" style="color: red;font-size: 12px;font-weight: bold">
    Procesando... <img alt="" src="/images/ajax-loader.gif" />
</div>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('form')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('fasig')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
