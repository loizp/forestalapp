<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:03:09
         compiled from "./templates/principal.html" */ ?>
<?php /*%%SmartyHeaderCode:10194383904f176bcd6e2477-77999409%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e71a7b509c2307bc5b0e39a8ff060c86cc62af4' => 
    array (
      0 => './templates/principal.html',
      1 => 1325660942,
    ),
  ),
  'nocache_hash' => '10194383904f176bcd6e2477-77999409',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<link type="text/css" href="/css/principal.css" rel="stylesheet" />
<script type="text/javascript" src="/js/pngFix/jquery.pngFix.js"></script>
<script type="text/javascript" src="/js/mopSlider/mopSlider-2.4.js"></script>
<script type="text/javascript" src="/js/principal.js"></script>

<div id="pgprincipal" class="cuerpo">
    <div class="mensaje1">
        <div class="mensaje1izq"></div>
        <div class="mensaje1cent"><h3>¿QUÉ ES?</h3></div>
        <div class="mensaje1der"><a href="/index.php/intranet">Intranet</a></div>
    </div>
    <div class="contenidoprinc">
        Es un sistema de información que permite registrar y consultar información acerca de Autorizaciones, Concesiones Forestales Maderables y No Maderables, Permisos, Intervenciones, Otorgamientos entre otros, de la Dirección Ejecutiva de Administración y Conservación de los Recursos Naturales, del Gobierno Regional San Martín.
    </div>
    <div class="contenidoprinc">
        Información disponible sobre la gestión y administración de los bosques, como parte de las competencias transferidas.
    </div>
    <div class="mainconsulta">
        <div class="titles">Consultar :</div>
        <div class="containerconsulta">
            <div id="sliderconsulta">
                <?php  $_smarty_tpl->tpl_vars["c"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lcateg')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["c"]->key => $_smarty_tpl->tpl_vars["c"]->value){
?>
                <div class="listcateg">
                    <div class="pic"><img src="/images/4.png" width="80" height="80" alt="<?php echo $_smarty_tpl->getVariable('c')->value->titulo;?>
" /></div>
                    <div class="title"><?php echo $_smarty_tpl->getVariable('c')->value->titulo;?>
</div>
                    <div class="description"><p><?php echo $_smarty_tpl->getVariable('c')->value->descripcion;?>
</p></div>
                    <div class="link"><a href="/index.php/expediente/report?idcategoria=<?php echo $_smarty_tpl->getVariable('c')->value->idcategoria;?>
">Ver Expedientes</a></div>
                    <div class="clear"></div>
                </div>
                <?php }} ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
        
</div>