<?php

include_once('ControllerBase.php');
include_once('models/tipoexp.php');

class cTipoexp extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'Tipoexp';

    public function indexAction() {
        global $smarty;

        $grilla = new jsGrid();

        $grilla->setCaption("Lista de tipos de expedientes");
        $grilla->setPager("pgtipoexp");
        $grilla->setTabla("lstipoexp");
        $grilla->setSortname("descripcion");
        $grilla->setUrl("/index.php/tipoexp/listar");
        $grilla->setWidth(600);
        $grilla->addColumnas("descripcion", "Descripcion",180);

        $smarty->assign('grillatipoexp', $grilla->buildJsGrid());
        $smarty->assign('form', 'tipoexp/form.html');

        $smarty->display('tipoexp/list.html');
        
    }


    public function guardarAjax(){

        $obj = new Tipoexp();
        $obj->setFields($_REQUEST);
        try{
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $obj->update();
        }catch(ORMException $e){
            $obj->create(true);
        }

        return $obj->getFields();

    }

    public function borrarAjax(){

        $obj = new Tipoexp();
        try{
            $obj->find($_REQUEST);

            $obj->delete();
        }catch(ORMException $e){}

        return $obj->getFields();

    }
    
    public function getAjax(){

        $obj = new Tipoexp();
        try{
            $obj->find($_REQUEST);
        }catch(ORMException $e){
            $obj = null;
        }

        return $obj->getFields();

    }

    public function listarAction() {

        $db = new jsGridBdORM();

        $db->setTabla('tipoexp');
        $db->setParametros($_REQUEST);

        $db->setColumnaId('idtipoexp');

        $db->addColumna('descripcion');

        echo $db->to_json();      
    }

}
?>