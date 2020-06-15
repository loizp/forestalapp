<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:12:43
         compiled from "./templates/requisito/list.html" */ ?>
<?php /*%%SmartyHeaderCode:18823599754f176e0bcf5539-67084039%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '074c7e854a5cd39198538f8b865a205a738becc7' => 
    array (
      0 => './templates/requisito/list.html',
      1 => 1323893005,
    ),
  ),
  'nocache_hash' => '18823599754f176e0bcf5539-67084039',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script type="text/javascript" src="/js/modulos/requisito.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grillarequisito')->value;?>
</script>

<table id="lsrequisito"></table>
<div id="pgrequisito"></div>


<button id="nuevo_requisito">Nuevo</button>
<button id="modificar_requisito">Modificar</button>
<button id="anular_requisito">Borrar</button>
<button id="aitem_requisito">Agregar Item</button>

<div class="espere_requisito" style="color: red;font-size: 12px;font-weight: bold">
    Procesando... <img alt="" src="/images/ajax-loader.gif">
</div>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('form')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('fasig')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
