<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:11:36
         compiled from "./templates/dash.html" */ ?>
<?php /*%%SmartyHeaderCode:8758147884f176dc894cc63-76664496%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '434322714df82cb69261a4fc7e844b729fa3b416' => 
    array (
      0 => './templates/dash.html',
      1 => 1325534815,
    ),
  ),
  'nocache_hash' => '8758147884f176dc894cc63-76664496',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_count_characters')) include '/home/loizp/www/web/smarty/plugins/modifier.count_characters.php';
?><script type="text/javascript" src="/js/jquery.upload-1.0.2.min.js"></script>
<script type="text/javascript" src="/js/jquery-layout.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript" src="/js/util.js"></script>

<style> 
    #centerPane *{ 
        font-size: 11px; 
        text-align: left;
    }
    
    .paneluser a{
        color:green;
        font-style: italic;
        font-weight: bold;
    }
</style>
<div id="dashboard" class="cuerpo">
    <?php $_template = new Smarty_Internal_Template("menu.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

    <div class="paneluser ui-layout-north ui-widget-content">
        Bienvenido: <?php if (smarty_modifier_count_characters($_smarty_tpl->getVariable('login')->value['nick'])>2){?> <?php echo $_smarty_tpl->getVariable('login')->value['nick'];?>
 <?php }else{ ?> <?php echo $_smarty_tpl->getVariable('login')->value['login'];?>
 <?php }?>
        <b>|</b>
        <a href="javascript:void(0)" onclick="moduser('<?php echo $_smarty_tpl->getVariable('login')->value['idusuario'];?>
');">Edit-User<span class="ui-button ui-icon ui-icon-contact" title="Editar Usuario"></span></a>
        <b>|</b>
        <a href="logout">Salir<span class="ui-button ui-icon ui-icon-closethick" title="Salir del Sistema"></span></a>
    </div>
    <div id="centerPane" class="ui-layout-center ui-helper-reset ui-widget-content">
      <div id="tabs" class="jqgtabs">                    
         <ul><li><a href="#tabs-1">GORESAM</a></li></ul>
         <div id="tabs-1"></div>
      </div>
   </div>
</div>
<?php $_template = new Smarty_Internal_Template("usermod.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
