<?php /* Smarty version 3.0rc1, created on 2012-01-18 20:03:18
         compiled from "./templates/login.html" */ ?>
<?php /*%%SmartyHeaderCode:17023948744f176bd65afb74-00194094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35d625b9220e24ba6b4c2233dd9c8efe5682c791' => 
    array (
      0 => './templates/login.html',
      1 => 1324310817,
    ),
  ),
  'nocache_hash' => '17023948744f176bd65afb74-00194094',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<link type="text/css" href="/css/login.css" rel="stylesheet" />

<div id="login" class="cuerpo">
    <div class="mitad" id="logisq">
        <h3><a href="/">Home</a></h3>
    </div>
    <div class="mitad" id="logder">
        <h3>Iniciar Sesi&oacute;n</h3>
        <p>Debe tener un usuario y clave para poder acceder al sistema</p>
        <div id="formlogin" class="ui-widget-content ui-corner-all">
            <div id="mensaje"><?php echo $_smarty_tpl->getVariable('loginMessage')->value;?>
</div>
            <form id="flogin" class="formular" method="POST" action="/index.php/login">
                <div>
                    <label>Usuario :</label>
                    <input type="text" name="username" id="usuario" class="loguser" />
                </div>
                <div>
                    <label>Contrase&ntilde;a :</label>
                    <input type="password" name="userkey" id="clave" class="loguser" />
                </div>
                <input class="boton" type="submit" value="Ingresar" />
            </form>
        </div>
        <div id="expand">
            <div id="enlase">
                <div id="isq"><a href="#">Ayuda</a></div>
                <div id="der"><a href="#">Olvide mi Contrase&ntilde;a</a></div>
            </div>
        </div>
    </div>
</div>