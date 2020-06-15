<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:12:12
         compiled from "./templates/categoria/asigreq.html" */ ?>
<?php /*%%SmartyHeaderCode:586091304f176dec803ae3-02656827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c64cb0e05e4dd997c9b0ff15e3a66b42d0412eb' => 
    array (
      0 => './templates/categoria/asigreq.html',
      1 => 1323893721,
    ),
  ),
  'nocache_hash' => '586091304f176dec803ae3-02656827',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="grid_areq" title="Seleccione requisitos asociados" >
    <script type="text/javascript" src="/js/modulos/areqcat.js"></script>
    <center><label for="idcateg">Asignar a CategoriaID :</label>
        <input type="text" name="idcateg" id="idcateg" value="" size="3" readonly /></center>
    <br /><br />
    <table id="lsareq"></table> 
    <div id="pgareq" ></div> 
    <br /> 
    <div class="espere_areq" style="color: red;font-size: 12px;font-weight: bold">
        Procesando... <img alt="" src="/images/ajax-loader.gif" />
    </div>
    <a href="javascript:void(0)" id="btnsel_areq">||Ver Asignados||</a>
</div>