<?php
include_once('ControllerBase.php');
include_once('models/usuario.php');

class cUsuario extends ControllerBase{
    protected $defaultaction = 'index';
    protected $model = 'Usuario';

    public function indexAction(){
        global  $smarty;

        $usuarios = $this->listAjax();

        $smarty->assign('usuarios',
                $usuarios['data']);

        $smarty->assign('content','usuario/list.html');
        $smarty->display('index.html');
    }

    public function saveAjax(){
        $obj = new Usuario();
        
        $obj->setFields($_REQUEST);
        try{
            $obj->find($_REQUEST);
            if($_REQUEST['pwd']!='0')
                $_REQUEST['pwd']=sha1($_REQUEST['pwd']);
            else
                $_REQUEST['pwd']=$obj->pwd;
            $obj->setFields($_REQUEST);
            $obj->update();
        }catch(ORMException $e){
            $obj->create(true);
        }
        
        return $obj->getFields();
        
    }
}
?>