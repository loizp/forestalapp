<?php

include_once('ControllerBase.php');
include_once('models/requisito.php');

class cRequisito extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'requisito';

    public function indexAction() {
        global $smarty;

        $grilla = new jsGrid();

        $grilla->setCaption("Lista de reqisitos");
        $grilla->setPager("pgrequisito");
        $grilla->setTabla("lsrequisito");
        $grilla->setSortname("descripcion");
        $grilla->setUrl("/index.php/requisito/listar?ini=1");
        $grilla->setWidth(600);
        $grilla->addColumnas("descripcion", "Descripcion", 180);

        $smarty->assign('form', 'requisito/form.html');
        $smarty->assign('fasig', 'requisito/asigitem.html');
        $smarty->assign('grillarequisito', $grilla->buildJsGrid());

        $smarty->display('requisito/list.html');
    }

    public function guardarAjax() {

        $obj = new Requisito();
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

    public function borrarAjax() {

        $ide = 0;

        if (isset($_REQUEST['idexpediente']))
            $ide = $_REQUEST['idexpediente'];

        $obj = new Requisito();
        try {
            $obj->find($_REQUEST);
            if ($this->borra_arbol($obj->idrequisito, $ide))
                $obj->delete();
        } catch (ORMException $e) {
            
        }

        return $obj->getFields();
    }

    private function borra_arbol($nivel = 0, $idex=0) {

        include_once ('models/archivo.php');

        $obj = new Requisito();
        $obj = $obj->getAll()
                ->WhereAnd("dependencia=", $nivel);

        $i = 0;
        $borr = array();
        $elim = true;
        foreach ($obj as $u) {
            $borr[$i] = true;
            $obj2 = new Requisito();

            $obj2 = $obj2->getAll()
                    ->WhereAnd("dependencia=", $u->idrequisito);

            $depend = $obj2->count();

            if ($depend > 0)
                $borr[$i] = $this->borra_arbol($u->idrequisito, $idex);

            if ($idex != 0) {
                $objar = new Archivo();

                $objar = $objar->getAll()
                        ->WhereAnd("idrequisito=", $u->idrequisito)
                        ->WhereAnd("idexpediente<>", $idex);

                if ($objar->count() > 0) {
                    $borr[$i] = false;
                } elseif ($borr[$i]) {
                    $u->delete();
                    $borr[$i] = true;
                }
                $objar = new Archivo();

                $objar = $objar->getAll()
                        ->WhereAnd("idrequisito=", $u->idrequisito)
                        ->WhereAnd("idexpediente=", $idex);
                
                foreach ($objar as $a) {
                    $a->delete();
                }
            } else {
                $u->delete();
                $borr[$i] = true;
            }
            $i++;
        }

        if ($idex != 0) {
            $objar = new Archivo();

            $objar = $objar->getAll()
                    ->WhereAnd("idrequisito=", $nivel)
                    ->WhereAnd("idexpediente<>", $idex);

            if ($objar->count() > 0)
                $elim = false;
            else
                $elim = true;
            
            $objar = new Archivo();

                $objar = $objar->getAll()
                        ->WhereAnd("idrequisito=", $nivel)
                        ->WhereAnd("idexpediente=", $idex);
                
                foreach ($objar as $a) {
                    $a->delete();
                }

            for ($j = $i-1; $j >= 0; $j--) {
                $elim = $elim && $borr[$j];
            }
        }

        return $elim;
    }

    public function getAjax() {

        $obj = new Requisito();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }

        return $obj->getFields();
    }

    public function listarAction() {

        $db = new jsGridBdORM();

        $db->setTabla('requisito');
        $db->setParametros($_REQUEST);

        $db->setColumnaId('idrequisito');

        $db->addColumna('descripcion');

        if (array_key_exists('ini', $_REQUEST))
            $db->addWhereAnd("dependencia=", "0");

        echo $db->to_json();
    }

    public function getcatAction() {
        include_once ('models/detalle_categoria.php');

        $obj = new Detalle_categoria();

        $obj = $obj->getAll()
                ->WhereAnd("idcategoria=", $_REQUEST['idcategoria']);

        echo $obj->toJSON();
    }

    public function getreqAction() {
        include_once ('models/expediente.php');
        $obj = new Expediente();

        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }

        include_once ('models/detalle_categoria.php');

        $objdc = new Detalle_categoria();

        $objdc = $objdc->getAll()
                ->WhereAnd("idcategoria=", $obj->Categoria->idcategoria);

        if ($objdc->count() > 0) {
            $obj = new Requisito();
            $obj = $obj->getAll();

            foreach ($objdc as $u)
                $obj = $obj->WhereOr("idrequisito=", $u->Requisito->idrequisito);

            echo $obj->toJSON();
        } else {
            echo '';
        }
    }

    public function arbolAction() {
        include_once ('models/expediente.php');

        $obj = new Expediente();

        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }

        $ide = $obj->idexpediente;

        $cad = '<ul id="li' . $obj->idexpediente . '" class="filetree">';
        $cad .= '<li><span class="folder">' . $obj->codigo . '</span>';

        include_once ('models/detalle_categoria.php');

        $objdc = new Detalle_categoria();

        $objdc = $objdc->getAll()
                ->WhereAnd("idcategoria=", $obj->Categoria->idcategoria);

        if ($objdc->count() > 0) {
            $obj = new Requisito();
            $obj = $obj->getAll();

            foreach ($objdc as $u)
                $obj = $obj->WhereOr("idrequisito=", $u->Requisito->idrequisito);

            $cad .= $this->crea_arbol(0, $obj, $ide);
        }
        $cad .= '</li></ul>';

        echo $cad;
    }

    private function crea_arbol($nivel = 0, $objr = null, $idexp=null) {
        include_once ('models/archivo.php');
        $lista = '<ul>';

        if ($nivel == 0) {
            $obj = $objr;
        } else {
            $obj = new Requisito();
            $obj = $obj->getAll()
                    ->WhereAnd("dependencia=", $nivel);
        }

        foreach ($obj as $u) {

            $lista .= '<li><div class="folder"><a href="javascript:void(0)" id="lar' . $u->idrequisito . '" onclick="selreqarch(' . $u->idrequisito . ',' . $u->dependencia . ');">' . $u->descripcion . '</a></div>';

            $obj2 = new Requisito();

            $obj2 = $obj2->getAll()
                    ->WhereAnd("dependencia=", $u->idrequisito);

            if ($obj2->count() > 0)
                $lista .= $this->crea_arbol($u->idrequisito, null, $idexp);

            $obja = new Archivo();

            $obja = $obja->getAll()
                    ->whereAnd('idexpediente =', $idexp)
                    ->whereAnd('idrequisito =', $u->idrequisito);

            if ($obja->count() > 0) {
                $lista .='<ul>';
                foreach ($obja as $a) {
                    $lista .='<li><div class="file"><a href="javascript:void(0)" id="lfile' . $a->idarchivo . '" onclick="selecarchivo(' . $a->idarchivo . ',' . $a->Requisito->idrequisito . ',' . $a->Requisito->dependencia . ');">' . $a->nombre . '</a></div></li>';
                }
                $lista .='</ul>';
            }

            $lista .='</li>';
        }
        $lista .='</ul>';

        return $lista;
    }

}

?>