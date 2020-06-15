<?php

include_once('ControllerBase.php');

class cIndex extends ControllerBase {

    protected $defaultaction = 'index';
    protected $autoRoute = true;
    protected $route = array(
        "categoria" => "cCategoria",
        "item" => "cItem",
        "requisito" => "cRequisito",
        "tipoexp" => "cTipoexp",
        "expediente" => "cExpediente",
        "archivo" => "cArchivo",
        "usuario" => "cUsuario"
    );

    protected function init() {
        date_default_timezone_set('America/Lima');
        global $smarty;

        $smarty->assign('login', @$_SESSION['login']);
        $smarty->assign('main', 'blank.html');
    }

    public static function _403() {
        global $smarty;
        unset($_SESSION['login']);
        session_destroy();
        $smarty->display('403.html');
    }

    public function rights() {

        // Procesa el Login
        if ($this->actionName == 'loginAction')
            return true;
        // Muestra la pantalla de login
        if ($this->actionName == 'indexAction')
            return true;
        if ($this->actionName == 'logoutAction')
            return true;

        if ($this->actionName == 'intranetAction')
            return true;

        if ($this->actionName == 'consultaAction')
            return true;

        if ($this->actionName == 'expedienteAction')
            return true;
        
        if ($this->actionName == 'archivoAction')
            return true;

        // Si se ha logueado
        if (array_key_exists('login', $_SESSION))
            return true;

        return false;
    }

    public function loginAction() {
        include_once('models/usuario.php');

        $obj = new Usuario();
        $_REQUEST['userkey'] = sha1($_REQUEST['userkey']);
        $obj = $obj->getAll()
                ->whereAnd('estado =', 1)
                ->whereAnd('login =', $_REQUEST['username'])
                ->whereAnd('pwd =', $_REQUEST['userkey'])
        ;
        if ($obj->count() == 0) {
            header('Location: /index.php/intranet?error=NOT_VALID');
            die();
        }
        $_SESSION['login'] = $obj->get(0)->getFields();
        $_SESSION['fecha'] = date('d/m/yy');
        header('Location: /index.php/admin');
    }

    public function logoutAction() {
        unset($_SESSION['login']);
        session_destroy();
        header('Location: /');
    }

    public function adminAction() {
        global $smarty;

        $smarty->assign('main', 'dash.html');
        $smarty->display('index.html');
    }

    public function indexAction() {

        global $smarty;

        include_once('models/categoria.php');

        $categ = new Categoria();
        $categ = $categ->getAll();

        $smarty->assign('lcateg', $categ);
        $smarty->assign('main', 'principal.html');

        $smarty->display('index.html');
    }

    public function intranetAction() {
        global $smarty;

        if (array_key_exists('error', $_REQUEST)) {
            $errors = array(
                'NOT_VALID' => 'Usuario o Contraseña no validos'
            );
            $errorMessage = @$errors[$_REQUEST['error']];
            $smarty->assign('loginMessage', $errorMessage);
        }

        if (!isset($_SESSION['login']))
            $smarty->assign('main', 'login.html');

        $smarty->display('index.html');
    }
}

?>
