<?php

include_once('ControllerBase.php');
include_once('models/categoria.php');

class cCategoria extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'Categoria';

    public function indexAction() {
        global $smarty;

        $grilla = new jsGrid();

        $grilla->setCaption("Lista de Categorias");
        $grilla->setPager("pgcategoria");
        $grilla->setTabla("lscategoria");
        $grilla->setSortname("titulo");
        $grilla->setUrl("/index.php/categoria/listar");
        $grilla->setWidth(600);
        $grilla->addColumnas("titulo", "Titulo", 100);
        $grilla->addColumnas("descripcion", "Descripcion", 180);
        
        $smarty->assign('form', 'categoria/form.html');
        $smarty->assign('fasig', 'categoria/asigreq.html');
        $smarty->assign('grillacategoria', $grilla->buildJsGrid());

        $smarty->display('categoria/list.html');
    }

    public function guardarAjax() {

        $obj = new Categoria();
        $obj->setFields($_REQUEST);
        try {
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $obj->update();
        } catch (ORMException $e) {
            $obj->create(true);
        }

        return $obj->getFields();
    }

    public function asignareqAjax() {

        include_once('models/detalle_categoria.php');
        
        
        
        $obj = new Detalle_categoria();

        $obj->idcategoria = $_REQUEST['idcategoria'];

        try {
            $obj->dellistcate();
        } catch (ORMException $e) {
            
        }
        if ($_REQUEST['limpio'] == 0) {
            $idreqarr = $_REQUEST['idrequisito'];
            $obj = new Detalle_categoria();

            for ($x = 0; $x < count($idreqarr); $x++) {
                $obj->setFields(array('idcategoria' => $_REQUEST['idcategoria'], 'idrequisito' => $idreqarr[$x]));
                $obj->create(true);
            }
        }
        
        return $obj->getFields();
    }

    public function borrarAjax() {

        $obj = new Categoria();
        try {
            $obj->find($_REQUEST);

            $obj->delete();
        } catch (ORMException $e) {
            
        }

        return $obj->getFields();
    }

    public function getAjax() {

        $obj = new Categoria();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }

        return $obj->getFields();
    }

    public function listarAction() {

        $db = new jsGridBdORM();

        $db->setTabla('categoria');
        $db->setParametros($_REQUEST);

        $db->setColumnaId('idcategoria');
        $db->addColumna('titulo');
        $db->addColumna('descripcion');

        echo $db->to_json();
    }

}

?>