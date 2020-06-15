<?php

include_once('ControllerBase.php');
include_once('models/item.php');

class cItem extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'Item';

    public function indexAction() {
        global $smarty;

        $grilla = new jsGrid();

        $grilla->setCaption("Lista de items");
        $grilla->setPager("pgitem");
        $grilla->setTabla("lsitem");
        $grilla->setSortname("nombre");
        $grilla->setUrl("/index.php/item/listar");
        $grilla->setWidth(600);
        $grilla->addColumnas("nombre", "Nombre",300);
        $grilla->addColumnas("descripcion", "Descripcion",400);
        
        $smarty->assign('form', 'item/form.html');
        $smarty->assign('grillaitem', $grilla->buildJsGrid());

        $smarty->display('item/list.html');
        
    }


    public function guardarAjax(){

        $obj = new Item();
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

        $obj = new Item();
        try{
            $obj->find($_REQUEST);

            $obj->delete();
        }catch(ORMException $e){}

        return $obj->getFields();

    }
    
    public function getAjax(){

        $obj = new Item();
        try{
            $obj->find($_REQUEST);
        }catch(ORMException $e){
            $obj = null;
        }

        return $obj->getFields();

    }

    public function listarAction() {

        $db = new jsGridBdORM();

        $db->setTabla('item');
        $db->setParametros($_REQUEST);

        $db->setColumnaId('iditem');
        $db->addColumna('descripcion');
        $db->addColumna('informacion');
        
        if (array_key_exists('idrequisito', $_REQUEST))
            $db->addWhereAnd("idrequisito=",$_REQUEST['idrequisito']);

        echo $db->to_json();      
    }

    public function getitemAction(){

        $obj = new Item();

        $obj = $obj->getAll()
                ->WhereAnd("idrequisito=",$_REQUEST['idrequisito']);
        
        echo $obj->toJSON();
    }
}
?>