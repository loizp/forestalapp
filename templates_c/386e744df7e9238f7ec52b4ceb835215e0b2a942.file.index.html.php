<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:03:09
         compiled from "./templates/index.html" */ ?>
<?php /*%%SmartyHeaderCode:10203385194f176bcd3227a6-59851709%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '386e744df7e9238f7ec52b4ceb835215e0b2a942' => 
    array (
      0 => './templates/index.html',
      1 => 1324312332,
    ),
  ),
  'nocache_hash' => '10203385194f176bcd3227a6-59851709',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=8" />

        <title>Sistema Forestal</title>

        <link type="text/css" href="/css/index.css" rel="stylesheet" />
        <link type="text/css" href="/css/jqueryui/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
        <link type="text/css" href="/css/treeview/jquery.treeview.css" rel="stylesheet" />
        <link type="text/css" href="/css/ui.jqgrid.css" rel="stylesheet" />
        <script type="text/javascript" src="/js/jquery-latest.js"></script>
        <script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/js/jquery.treeview.js"></script>
        <script type="text/javascript" src="/js/jquery-ui-1.8.16.custom.min.js"></script>

        <script type="text/javascript" src="/js/grid.locale-es.js"></script>
        <script type="text/javascript" src="/js/jquery.jqGrid.min.js"></script>

    </head>
    <body>
        <?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        <?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('main')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        <?php $_template = new Smarty_Internal_Template("pie.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

    </body>
</html>