<?php

include_once('ControllerBase.php');
include_once('models/expediente.php');

class cExpediente extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'expediente';

    public function rights() {

        if ($this->actionName == 'reportAction')
            return true;
        if ($this->actionName == 'lreportAction')
            return true;
        if ($this->actionName == 'arbolreportAction')
            return true;
        if ($this->actionName == 'detreportAction')
            return true;
        if ($this->actionName == 'vermapaAction')
            return true;
        if ($this->actionName == 'listardetalleAction')
            return true;
        // Si se ha logueado
        if (array_key_exists('login', $_SESSION))
            return true;

        return false;
    }

    public function indexAction() {
        global $smarty;

        $grilla = new jsGrid();

        $grilla->setCaption("Lista de Expedientes");
        $grilla->setPager("pgexpediente");
        $grilla->setTabla("lsexpediente");
        $grilla->setSortname("codigo");
        $grilla->setUrl("/index.php/expediente/listar");
        $grilla->setWidth(730);
        $grilla->addColumnas("codigo", "Codigo", 100);
        $grilla->addColumnas("titular", "Titular", 200);
        $grilla->addColumnas("ubicacion", "Ubicacion", 150);
        $grilla->addColumnas("observacion", "Observacion", 200);
        $grilla->addColumnas("estado", "Estado", 20);

        include_once ('models/categoria.php');
        $cat = new Categoria();
        $cat = $cat->getAll();

        include_once ('models/tipoexp.php');
        $tex = new Tipoexp();
        $tex = $tex->getAll();

        $smarty->assign('listcateg', $cat);
        $smarty->assign('listtipex', $tex);
        $smarty->assign('form', 'expediente/form.html');
        $smarty->assign('fasig', 'expediente/asigdet.html');
        $smarty->assign('grillaexpediente', $grilla->buildJsGrid());

        $smarty->display('expediente/list.html');
    }

    public function guardarAjax() {

        $val = false;
        $obj = new Expediente();

        $obj->setFields($_REQUEST);
        try {
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $obj->update();
            $val = true;
        } catch (ORMException $e) {
            $obje = new Expediente();

            $obje = $obje->getAll()
                    ->whereAnd('codigo =', $_REQUEST['codigo']);

            if ($obje->count() == 0) {
                $obj->create(true);
                $val = true;
            }
        }

        return $val;
    }

    public function savedetAjax() {
        include_once ('models/detalle_expediente.php');

        $obj = new Detalle_expediente();
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

    public function anularAjax() {

        $obj = new Expediente();
        try {
            $obj->find($_REQUEST);

            if ($obj->estado == 0)
                $obj->estado = 1;
            else
                $obj->estado = 0;
            $obj->update();
        } catch (ORMException $e) {
            
        }

        return $obj->getFields();
    }

    public function getAjax() {

        $obj = new Expediente();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }

        return $obj->getFields();
    }

    public function listarAction() {

        $db = new jsGridBdORM();

        $db->setTabla('expediente');
        $db->setParametros($_REQUEST);

        $db->setColumnaId('idexpediente');

        $db->addColumna('codigo');
        $db->addColumna('titular');
        $db->addColumna('ubicacion');
        $db->addColumna('observacion');
        $db->addColumna('estado');
        echo $db->to_json();
    }

    public function getditemAction() {
        include_once ('models/detalle_expediente.php');

        $obj = new Detalle_expediente();

        $obj = $obj->getAll()
                ->whereAnd('idexpediente =', $_REQUEST['idexpediente'])
                ->whereAnd('idrequisito =', $_REQUEST['idrequisito'])
                ->whereAnd('iditem =', $_REQUEST['iditem']);

        echo $obj->toJSON();
    }

    public function savemapaAction() {
        $mimetypes = array("image/jpg", "image/jpeg", "image/pjpeg", "image/gif", "image/png");

        $cad = '';
        $name = $_FILES['mapa']['name'];
        $archivo = $_FILES['mapa']['tmp_name'];
        $tamanio = $_FILES['mapa']['size'];
        $tipo = $_FILES['mapa']['type'];
        list($txt, $ext) = explode(".", $name);

        if (is_uploaded_file($archivo)) {
            if (in_array($tipo, $mimetypes)) {
                $fp = fopen($archivo, "rb");
                $contenido = fread($fp, filesize($archivo));
                $contenido = addslashes($contenido);

                fclose($fp);

                $obj = new Expediente();

                $obj->idexpediente = $_REQUEST['idexpediente'];
                $obj->mapa = $contenido;
                $obj->timapa = $tipo;
                $obj->extmapa = $ext;

                try {
                    $obj->updatemapa();
                    $cad = '<a href="/index.php/expediente/vermapa?idexpediente=' . $_REQUEST['idexpediente'] . '">
                    <img src="/index.php/expediente/vermapa?idexpediente=' . $_REQUEST['idexpediente'] . '" alt="mapa" /></a>';
                } catch (ORMException $e) {
                    $cad = '<p>No se pudo Guardar</p>';
                }
            } else
                $cad = '<p>error de tipo de archivo ' . $tipo . '</p>';
        } else
            $cad = '<p>No se puede subir Archivo</p>';

        echo $cad;
    }

    public function vmapAction() {
        echo '<a href="/index.php/expediente/vermapa?idexpediente=' . $_REQUEST['idexpediente'] . '">
                    <img src="/index.php/expediente/vermapa?idexpediente=' . $_REQUEST['idexpediente'] . '" alt="mapa" /></a>';
    }

    public function vermapaAction() {
        $obje = new Expediente();
        $obje->find($_REQUEST);
        header("Content-type: $obje->timapa");

        header('Content-Disposition: attachment; filename="' . $obje->codigo . '.' . $obje->extmapa . '"');

        print $obje->mapa;
    }

    public function reportAction() {
        global $smarty;

        $grilla = new jsGrid();

        $pg = '';

        $grilla->setCaption("Reporte Expedientes");
        $grilla->setPager("pgreporte");
        $grilla->setTabla("lsreporte");
        $grilla->setSortname("codigo");
        $grilla->setFnCargaCompleta("cargalinkdet");
        $grilla->addColumnas("codigo", "Codigo", 100);
        $grilla->addColumnas("titular", "Titular", 150);
        $grilla->addColumnas("ubicacion", "Ubicacion", 150);
        $grilla->addColumnas("fecha", "FechaReg", 80);

        if (isset($_REQUEST['idcategoria'])) {
            $grilla->setUrl("/index.php/expediente/lreport?idcategoria=" . $_REQUEST['idcategoria']);
            $grilla->setWidth(880);

            include_once ('models/categoria.php');
            $obj = new Categoria();

            try {
                $obj->find($_REQUEST);
                $smarty->assign('tcategoria', $obj->titulo);
            } catch (ORMException $e) {
                
            }

            $smarty->assign('pgreporte', 'reporte/gridreport.html');
            $smarty->assign('main', 'consulta.html');
            $pg = 'index.html';
        } elseif (isset($_REQUEST['idcat'])) {
            $grilla->setUrl("/index.php/expediente/lreport?idcategoria=" . $_REQUEST['idcat']);
            $grilla->setWidth(880);
            $pg = 'reporte/gridreport.html';
        } else {
            $grilla->setUrl("/index.php/expediente/lreport");
            $grilla->setWidth(730);
            $grilla->addColumnas("idcategoria", "Categoria", 200, "false", "false");
            $pg = 'reporte/gridreport.html';
        }

        $grilla->addColumnas("act", "Det.", 25, "false", "false");

        $smarty->assign('grillareport', $grilla->buildJsGrid());

        $smarty->display($pg);
    }

    public function lreportAction() {
        $db = new jsGridBdORM();

        $db->setTabla('expediente');
        $db->setParametros($_REQUEST);

        $db->setColumnaId('idexpediente');

        $db->addColumna('codigo');
        $db->addColumna('titular');
        $db->addColumna('ubicacion');
        $db->addColumna('fecha');
        if (isset($_REQUEST['idcategoria'])) {
            $db->addWhereAnd("idcategoria=", $_REQUEST['idcategoria']);
        } else {
            $db->addColumna('Categoria->titulo');
        }

        $db->addWhereAnd("estado=", 1);

        echo $db->to_json();
    }

    public function detreportAction() {
        global $smarty;

        $o = new Expediente();
        try {
            $o->find($_REQUEST);
            $smarty->assign('obj', $o);
        } catch (ORMException $e) {
            
        }
            $mapae = '<br /><p>Mapa : <a style="color:red;" href="/index.php/expediente/vermapa?idexpediente=' . $_REQUEST['idexpediente'] . '"><b><i>Descargar</i></b></a></p>
                    <center><img style="width:290px; height:200px;" src="/index.php/expediente/vermapa?idexpediente=' . $_REQUEST['idexpediente'] . '" alt="mapa" /></center>';

        $smarty->assign('mapae', $mapae);
        $smarty->display('reporte/detreport.html');
    }

    public function arbolreportAction() {

        $obj = new Expediente();

        $requi = array();
        $archi = array();

        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }

        $ide = $obj->idexpediente;

        $cad = '<ul id="lis' . $obj->idexpediente . '" class="filetree">';
        $cad .= '<li><span class="folder">' . $obj->codigo . '</span>';

        $obja = $obj->Archivo
                ->WhereAnd("estado=", 1);

        if ($obja->count() > 0) {
            foreach ($obja as $a) {
                $idre = $this->crealista($a->idrequisito, $a->Requisito->dependencia);
                if (!in_array($idre, $requi))
                    $requi[] = $idre;

                $archi[$idre][] = $a->idarchivo;
            }

            include_once ('models/requisito.php');
            include_once ('models/archivo.php');

            for ($i = 0; $i < count($requi); $i++) {
                $cad .= '<ul>';
                $requisito = new Requisito();

                $requisito = $requisito->getAll()
                        ->WhereAnd("idrequisito=", $requi[$i]);

                foreach ($requisito as $requisito1) {
                    $cad .= '<li><div class="folder"><a href="javascript:void(0)" id="lireq' . $requisito1->idrequisito . '" onclick="verdetreq(' . $requisito1->idrequisito . ',' . $ide . ');">' . $requisito1->descripcion . '</a></div>';
                }
                $cad .= '<ul>';
                for ($j = 0; $j < count($archi[$requi[$i]]); $j++) {

                    $archivo = new Archivo();

                    $archivo = $archivo->getAll()
                            ->WhereAnd("idarchivo=", $archi[$requi[$i]][$j]);

                    foreach ($archivo as $archivo1) {
                        $cad .='<li><div class="file"><a href="/index.php/archivo/verarchivo?idarchivo=' . $archivo1->idarchivo . '">' . $archivo1->nombre . '</a></div></li>';
                    }
                }
                $cad .= '</ul></li></ul>';
            }
        }

        $cad .= '</li></ul>';

        echo $cad;
    }

    private function crealista($idr, $depen) {
        include_once ('models/requisito.php');

        $objr = new Requisito();

        if ($depen > 0) {
            $objr = $objr->getAll()
                    ->WhereAnd("idrequisito=", $depen);
            foreach ($objr as $r) {
                $idr = $this->crealista($r->idrequisito, $r->dependencia);
            }
        }

        return $idr;
    }

    public function listardetalleAction() {
        include_once ('models/detalle_expediente.php');

        $obj = new Detalle_expediente();

        $obj = $obj->getAll()
                ->WhereAnd("idexpediente=", $_REQUEST['idexpediente'])
                ->WhereAnd("idrequisito=", $_REQUEST['idrequisito']);

        $caddet = '';

        if ($obj->count() > 0) {
            $caddet .='<br /><table><thead><tr><th class="nomitem">Nombre de Item</th><th>Descripcion Detalle</th></tr></thead><tbody>';
            foreach ($obj as $d) {
                $caddet .= '<tr><td class="nomitem">' . $d->Item->descripcion . '</td><td>' . $d->descripcion;

                if ($d->archivo > 0) {
                    $caddet .=' -:| ver mas detalles haciendo click <a href="/index.php/archivo/verarchivo?idarchivo=' . $d->archivo . '"><i><b>AQUI</b></i></a>';
                }
                $caddet .='</td></tr>';
            }
            $caddet .= '</tbody></table>';
        } else
            $caddet = '<p>No se han hecho registros para este requisito<p>';

        echo $caddet;
    }

}

?>