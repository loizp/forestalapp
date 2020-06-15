<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:26:23
         compiled from "./templates/expediente/form.html" */ ?>
<?php /*%%SmartyHeaderCode:17348204094f17713fb28581-67779066%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e28faf217a44d0f2779232f801e3243b40f3242' => 
    array (
      0 => './templates/expediente/form.html',
      1 => 1324447424,
    ),
  ),
  'nocache_hash' => '17348204094f17713fb28581-67779066',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="frm_expediente" title="Administrar Expediente" class="formulario">

    <p class="validar_expediente">Ingrese los datos.</p>

    <form action="/index.php/expediente/guardar" method="post" name="frm_expediente">
        <div class="dfexp">
            <label for="codigo">Codigo :</label>
            <input type="text" name="codigo" id="codigo" class="text ui-widget-content ui-corner-all" />
        </div><div class="dfexp">
            <label for="titular">Titular :</label>
            <input type="text" name="titular" id="titular" class="text ui-widget-content ui-corner-all" />
        </div><div class="dfexp">
            <label for="ubicacion">Ubicacion :</label>
            <input type="text" name="ubicacion" id="ubicacion" class="text ui-widget-content ui-corner-all" />
        </div><div class="dfexp">
            <label for="observacion">Observacion :</label>
            <input type="text" name="observacion" id="observacion" class="text ui-widget-content ui-corner-all" />
        </div><div class="dfexp">
            <label for="fecha">Fecha :</label>
            <input type="text" name="fecha" id="fecha" class="text ui-widget-content ui-corner-all" />
        </div><div class="dfexp">
            <label for="estado">Activo :</label>
            <input name="estado" id="estado" type="checkbox" value="1" />
        </div><div class="dfexp">
            <label for="listatiexp">Tipo Expediente :</label>
            <select name="listatiexp" id="listatiexp">
                <?php  $_smarty_tpl->tpl_vars["lt"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listtipex')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["lt"]->key => $_smarty_tpl->tpl_vars["lt"]->value){
?>
                <option value="<?php echo $_smarty_tpl->getVariable('lt')->value->idtipoexp;?>
" ><?php echo $_smarty_tpl->getVariable('lt')->value->descripcion;?>
</option>
                <?php }} ?>
            </select>
        </div><div class="dfexp">
            <label for="listacateg">Categoria :</label>
            <select name="listacateg" id="listacateg">
                <?php  $_smarty_tpl->tpl_vars["lc"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listcateg')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["lc"]->key => $_smarty_tpl->tpl_vars["lc"]->value){
?>
                <option value="<?php echo $_smarty_tpl->getVariable('lc')->value->idcategoria;?>
" ><?php echo $_smarty_tpl->getVariable('lc')->value->titulo;?>
</option>
                <?php }} ?>
            </select>
        </div>
        <input type="hidden" name="idexpediente" id="idexpediente" value ="-1"/>

    </form>
    <p class="cargando_expediente"><img alt="" src="/images/ajax-loader.gif">Procesando...</p>

</div>