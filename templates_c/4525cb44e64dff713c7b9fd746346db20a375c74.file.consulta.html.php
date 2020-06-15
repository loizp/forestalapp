<?php /* Smarty version 3.0rc1, created on 2012-02-17 18:35:46
         compiled from "./templates/consulta.html" */ ?>
<?php /*%%SmartyHeaderCode:10227068394f3ee452b3b2a3-46227873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4525cb44e64dff713c7b9fd746346db20a375c74' => 
    array (
      0 => './templates/consulta.html',
      1 => 1325633651,
    ),
  ),
  'nocache_hash' => '10227068394f3ee452b3b2a3-46227873',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<style>
    #reportegeneral{
        margin: 30px;
        padding: 0;
    }
    #reportegeneral *{
        font-size: 11px;
    }
    
    #reportegeneral * ul li{
        padding: 0 20px;
        text-align: left;
    }
    #cabereport {
        margin: 5px;
    }
    #cabereport div{
        float: left;
        text-align: left;
        padding: 5px 40px;
    }
    #cabereport a{
        color: green;
        font-weight: bold;
    }
</style>
<script type="text/javascript" src="/js/reportini.js"></script>
<div id="consulta" class="cuerpo ui-widget-content">
    <div id="cabereport">
        <div><a href="/">||Home||::</a></div>
        <div><h3>Reporte de categoria : <?php echo $_smarty_tpl->getVariable('tcategoria')->value;?>
</h3></div>
    </div>
    <div id="reportegeneral">
        <div id="gridinicio">
            <?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('pgreporte')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        </div>
    </div>
</div>