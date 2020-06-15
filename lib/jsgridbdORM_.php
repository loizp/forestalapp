<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class jsGridBdORM{
    
    var $pagina;
    var $countRows;
    var $totalPaginas;
    var $numRowsPagina;
    var $condicionGrilla;
    var $coneccion;
    var $sql;
    var $sqlCount;
    var $paginacion;
    var $resultado;
    var $start;

    var $tabla;
    var $Modelo = null;
    var $all = false;
    var $columnas = array();
    var $columnaId;

    public function setParametros($parametros){

        if(!$parametros['sidx']) $parametros['sidx'] =1;

        $this->pagina = $parametros['page'];
        $this->numRowsPagina = $parametros['rows'];
        $this->condicionGrilla = $this->getCondicion($parametros['_search'],$parametros);
        $this->addOrderBy($parametros['sidx'], $parametros['sord']);

    }

    private function getCondicion($search,$params){

        $wh = "";

        $qopers = array(
                          'eq'=>" = ",
                          'ne'=>" <> ",
                          'lt'=>" < ",
                          'le'=>" <= ",
                          'gt'=>" > ",
                          'ge'=>" >= ",
                          'bw'=>" like ",
                          'bn'=>" not like ",
                          'in'=>" in ",
                          'ni'=>" not in ",
                          'ew'=>" like ",
                          'en'=>" not like ",
                          'cn'=>" like " ,
                          'nc'=>" not like " );

        if ($search == 'true'){
            
            $field = $params['searchField'];
            $op = $params['searchOper'];
            $text = $params['searchString'];
            $cond = $qopers[$op];

            $this->addWhereAnd($field.$cond, $text);

            switch ($op) {
                case 'bw':
                case 'bn':
                    $text = is_numeric($text)?$text:"'".$text."%'";
                    $wh = $field.$cond.$text;
                    break;
                case 'ew':
                case 'en':
                    $text = is_numeric($text)?$text:"'%".$text."'";
                    $wh = $field.$cond.$text;
                    break;
                case 'cn':
                case 'nc':
                    $text = is_numeric($text)?$text:"'%".$text."%'";
                    $wh = $field.$cond.$text;
                    break;
                case 'in':
                case 'ni':
                    $text = is_numeric($text)?$text:" ('".$text."')";
                    $wh = $field.$cond.$text;
                    break;
                default:
                    $text = is_numeric($text)?$text:"'".$text."'";
                    $wh = $field.$cond.$text;
                    break;
            }

        }
        
        return $wh;
    }

    public function setColumnaId($columnaId){
        $this->columnaId = $columnaId;
    }

    public function setTabla($Tabla){
        
        $this->tabla = $Tabla;

        $mod = strtolower($Tabla);

        include_once "models/$mod.php";

        $this->Modelo = new $mod;
    }

    public function addColumna($columna){
        $this->columnas[] = $columna;
    }

    public function addWhereAnd($property,$value=null)
    {
        if ($this->all == false){
            $this->Modelo = $this->Modelo->getAll();
            $this->all = true;
        }

        $this->Modelo = $this->Modelo->WhereAnd($property,$value);
    }

    public function addWhereOr($property,$value=null)
    {
        if ($this->all == false){
            $this->Modelo = $this->Modelo->getAll();
            $this->all = true;
        }

        $this->Modelo = $this->Modelo->WhereOr($property,$value);
    }

    public function addOrderby($property,$asc=null)
    {
        if ($this->all == false){
            $this->Modelo = $this->Modelo->getAll();
            $this->all = true;
        }

        $this->Modelo = $this->Modelo->Orderby($property,$asc);
    }

    public function addGroupBy($property){

        if ($this->all == false){
            $this->Modelo = $this->Modelo->getAll();
            $this->all = true;
        }

        $this->Modelo = $this->Modelo->GroupBy($property);
    }

    private function getValor($vall,$col){

        $listacol = explode('->', $col);

        $long = count($listacol);

        $res = $vall;

        for ($i = 0 ; $i < $long ; $i++)
            $res = $res->$listacol[$i];

        return $res;

    }

    public function to_json(){

        if ($this->all == false){
            $this->Modelo = $this->Modelo->getAll();
            $this->all = true;
        }

        $this->countRows = $this->Modelo->count();

        if( $this->countRows >0 ) {
            $this->totalPaginas = ceil($this->countRows/$this->numRowsPagina);
        } else {
            $this->totalPaginas = 0;
        }

        $responce->page = $this->pagina;
        $responce->total = $this->totalPaginas;
        $responce->records = $this->countRows;

        $this->Modelo = $this->Modelo->getDatos($this->numRowsPagina,$this->pagina);

        $i=0;

        foreach ($this->Modelo as $key){

            $idT = $this->columnaId;

            $responce->rows[$i]['id']=$key->$idT;

            $data = array();

            foreach ($this->columnas as $c) {
                $data[] = $this->getValor($key,$c);
            }

            $responce->rows[$i]['cell']=$data;
            $i++;

        }

        return json_encode($responce);

    }

}

?>
