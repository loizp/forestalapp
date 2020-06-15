<?php

include_once('ControllerBase.php');
include_once('models/archivo.php');

class cArchivo extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'Archivo';
    
    public function rights() {

        if ($this->actionName == 'verarchivoAction')
            return true;
        // Si se ha logueado
        if (array_key_exists('login', $_SESSION))
            return true;

        return false;
    }

    public function indexAction() {
        
    }

    public function guardarAction() {

        $cad = '';
        $name = $_FILES['sarchi']['name'];
        $archivo = $_FILES['sarchi']['tmp_name'];
        $tamanio = $_FILES['sarchi']['size'];
        $tipo = $_FILES['sarchi']['type'];
        list($txt, $ext) = explode(".", $name);

        if (is_uploaded_file($archivo)) {
            $fp = fopen($archivo, "rb");
            $contenido = fread($fp, filesize($archivo));
            $contenido = addslashes($contenido);

            fclose($fp);


            $obj = new Archivo();

            $obj->idarchivo = $_REQUEST['idarchivo'];
            $obj->estado = $_REQUEST['estado'];
            $obj->contenido = $contenido;
            $obj->tipomime = $tipo;
            $obj->nombre = $_REQUEST['numdoc'] . '.' . $ext;
            $obj->fechasubida = date("Y-m-d");

            if ($_REQUEST['idarchivo'] == '-1') {
                $obj->idexpediente = $_REQUEST['idexpediente'];
                $obj->idrequisito = $_REQUEST['idrequisito'];
                $obj->numdoc = $_REQUEST['numdoc'];

                $obja = new Archivo();

                $obja = $obja->getAll()
                        ->WhereAnd("numdoc=", $_REQUEST['numdoc']);

                if ($obja->count() > 0) {
                    $cad = '<p>El Numero de Documento ya Existe</p>';
                } else {

                    try {
                        $obj->subirarch();

                        $obja = new Archivo();

                        $obja = $obja->getAll()
                                ->WhereAnd("numdoc=", $_REQUEST['numdoc']);
                        foreach ($obja as $u) {
                            $cad = '<div><p>Num. de Documento : <b>' . $u->numdoc . '</b></p></div><div><a href="/index.php/archivo/verarchivo?idarchivo=' . $u->idarchivo . '">Descargar</a></div>';
                        }
                    } catch (ORMException $e) {
                        $cad = '<p>No se pudo Guardar</p>';
                    }
                }
            } else {
                try {
                    $obj->cambiararch();
                    $cad = '<div><p>Num. de Documento : <b>' . $_REQUEST['numdoc'] . '</b></p></div><div><a href="/index.php/archivo/verarchivo?idarchivo=' . $_REQUEST['idarchivo'] . '">Descargar</a></div>';
                } catch (ORMException $e) {
                    $cad = '<p>No se pudo Guardar</p>';
                }
            }
        } else
            $cad = '<p>No se puede subir Archivo</p>';

        echo $cad;
    }

    public function varchAction() {
        $obj = new Archivo();
        $obj->find($_REQUEST);
        echo '<div><p>Num. de Documento : <b>' . $obj->numdoc . '</b></p></div><div><a href="/index.php/archivo/verarchivo?idarchivo=' . $obj->idarchivo . '"><i>Descargar</i></a></div>';
    }

    public function verarchivoAction() {
        $obje = new Archivo();
        $obje->find($_REQUEST);
        header("Content-type: $obje->tipomime");

        header('Content-Disposition: attachment; filename="' . $obje->nombre . '"');

        print $obje->contenido;
    }

    public function borrarAjax() {

        $obj = new Archivo();
        try {
            $obj->find($_REQUEST);
            $obj->delete();
        } catch (ORMException $e) {
            
        }

        return $obj->getFields();
    }

    public function getAjax() {

        $obj = new Archivo();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }

        return $obj->getFields();
    }

    public function listarAction() {
        
        $larchiv = '<ul>'.$this->reqdepend($_REQUEST['idrequisito'],$_REQUEST['idexpediente']).'</ul>';
        
        echo $larchiv;
    }

    private function reqdepend($requi,$expe) {
        include_once ('models/requisito.php');
        
        $lista='';
        
        $obja = new Archivo();
            
        $obja = $obja->getAll()
                ->whereAnd('idexpediente =', $expe)
                ->whereAnd('idrequisito =', $requi);
            
        if($obja->count()>0){
            foreach ($obja as $a) {
                $lista .='<li><a href="javascript:void(0)" id="larch'.$a->idarchivo.'" onclick="selecarchdet('.$a->idarchivo.',1);">'.$a->nombre.'</a></li>';
            }
        }
        
        $obj = new Requisito();
        $obj = $obj->getAll()
                ->WhereAnd("dependencia=", $requi);
        
        if($obj->count()>0){
            foreach ($obj as $r) {
                $lista .= $this->reqdepend($r->idrequisito,$expe);
            }
        }
        
        return $lista; 
    }

    public function actualizaAjax() {

        $obj = new Archivo();

        $obj->idarchivo = $_REQUEST['idarchivo'];
        $obj->estado = $_REQUEST['estado'];

        try {
            $obj->actdescrip();
        } catch (ORMException $e) {
            $obj = null;
        }

        return $obj->getFields();
    }

}

?>