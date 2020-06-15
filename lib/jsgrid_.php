<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class jsGrid{

    var $url =''; //ulr de php para cargar datos
    var $datatype ='json';//tipo de datos a cargar
    var $rowNum =10; //numero de filas por a mostrar
    var $pager = ''; //div de la grilla
    var $tabla = ''; //tabla de la grilla
    var $sortname =null; //columna para ordenar por defecto
    var $viewrecords ='true'; //ver registros
    var $multiselect ='false'; //seleccion multiple
    var $sortorder ='asc'; //metodo de ordenacion por defecto
    var $width = 600; //ancho de la grilla
    var $caption ='Titulo'; //titulo de la grilla

    var $rowList = "10,20,30"; //lista de cuantas filas de deben mostrar

    var $columnas = array();//columnas de la base datos
    var $columnasView = array();//columnas a ver en las cabeceras


//name=sss, width:150, sortable:false}index:'id_marca'
//search:true,align:"right",

    private function crearGrilla(){

        $colN = $this->getColNames();
        $colM = $this->getColModel();
        
        $cadena = "jQuery('#$this->tabla').jqGrid({\n";
        $cadena .="url:'$this->url',\n";
        $cadena .="datatype: '$this->datatype',\n";
        $cadena .="colNames:[$colN],";
        $cadena .="colModel:[$colM],";
        $cadena .="rowNum:$this->rowNum,\n";
        $cadena .="rowList:[$this->rowList],\n";
        $cadena .="pager:'#$this->pager',\n";
        $cadena .="sortname:'$this->sortname',\n";
        $cadena .="viewrecords:$this->viewrecords,\n";
        $cadena .="multiselect:$this->multiselect,\n";
        $cadena .="sortorder:'$this->sortorder',\n";
        $cadena .="width:$this->width,\n";
        $cadena .="gridview: true,\n";
        $cadena .="height:220,\n";
        $cadena .="rownumbers:true,\n";
        $cadena .="caption:'$this->caption'\n";
        $cadena .="});\n";

        return $cadena;
    }

    private function getColModel(){
        $cadena = "";

        foreach ($this->columnas as $value) {
            $cadena .="{";
            $cadena .="name:'".$value['name']."',";
            $cadena .="index:'".$value['index']."',";
            $cadena .="width:'".$value['width']."',";
            $cadena .="sortable:'".$value['sortable']."',";
            $cadena .="search:'".$value['search']."',";
            $cadena .="align:'".$value['align']."'";
            $cadena .="},";
        }

        $cadena = substr($cadena,0,strlen($cadena)-1);

        return $cadena;
        
    }

    private function getColNames(){
        $cadena = "";

        foreach ($this->columnasView as $value) {
            $cadena .="'".$value."',";
        }

        $cadena = substr($cadena,0,strlen($cadena)-1);

        return $cadena;
    }

    public function buildJsGrid(){

        $cadena = "jQuery(document).ready(function(){\n";
        $cadena .= $this->crearGrilla();
        $cadena .= "jQuery('#$this->tabla').jqGrid('navGrid','#$this->pager',{edit:false,add:false,del:false});";
        $cadena .= "jQuery('#$this->tabla').jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});";
        $cadena .= "});";

        return $cadena;

    }

    public function addColumnas($nombre,$nombreView,$width=150,$sortable='true',$search='true',$align='left'){
        $this->columnasView[] = $nombreView;
        $this->columnas[] = array(
            'name'=>$nombre,
            'index'=>$nombre,
            'width'=>$width,
            'sortable'=>$sortable,
            'search'=>$search,
            'align'=>$align
            );

    }

    public function getTabla() {
        return $this->tabla;
    }

    public function setTabla($tabla) {
        $this->tabla = $tabla;
    }

        public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getDatatype() {
        return $this->datatype;
    }

    public function setDatatype($datatype) {
        $this->datatype = $datatype;
    }

    public function getRowNum() {
        return $this->rowNum;
    }

    public function setRowNum($rowNum) {
        $this->rowNum = $rowNum;
    }

    public function getPager() {
        return $this->pager;
    }

    public function setPager($pager) {
        $this->pager = $pager;
    }

    public function getSortname() {
        return $this->sortname;
    }

    public function setSortname($sortname) {
        $this->sortname = $sortname;
    }

    public function getViewrecords() {
        return $this->viewrecords;
    }

    public function setViewrecords($viewrecords) {
        $this->viewrecords = $viewrecords;
    }

    public function getMultiselect() {
        return $this->multiselect;
    }

    public function setMultiselect($multiselect) {
        $this->multiselect = $multiselect;
    }

    public function getSortorder() {
        return $this->sortorder;
    }

    public function setSortorder($sortorder) {
        $this->sortorder = $sortorder;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getCaption() {
        return $this->caption;
    }

    public function setCaption($caption) {
        $this->caption = $caption;
    }
    
    public function getRowList() {
        return $this->rowList;
    }

    public function setRowList($rowList) {
        $this->rowList = $rowList;
    }

    var $includeJsPatch="js/";
    var $includeCssPatch="js/";

    public function getIncludeJsPatch() {
        return $this->includeJsPatch;
    }

    public function setIncludeJsPatch($includeJsPatch) {
        $this->includeJsPatch = $includeJsPatch;
    }

    public function getIncludeCssPatch() {
        return $this->includeCssPatch;
    }

    public function setIncludeCssPatch($includeCssPatch) {
        $this->includeCssPatch = $includeCssPatch;
    }

        private function getincludeScript(){
        
        $linea = "

        function jqGridInclude()
        {

            var pathtojsfiles = '".$this->includeJsPatch."'; // need to be ajusted
            var pathtocssfiles = '".$this->includeCssPatch."'; // need to be ajusted

            var minver = true;

            var modules = [
            { include: true, incfile:'jquery-ui-1.8.6.custom.min.js',minfile: 'jquery-ui-1.8.6.custom.min.js'}, // jqGrid
            { include: true, incfile:'jquery.layout.js',minfile: 'jquery.layout.js'}, // jqGrid
            { include: true, incfile:'grid.locale-es.js',minfile: 'grid.locale-es.js'}, // jqGrid
            { include: true, incfile:'ui.multiselect.js',minfile: 'ui.multiselect.js'}, // jqGrid
            { include: true, incfile:'jquery.jqGrid.min.js',minfile: 'jquery.jqGrid.min.js'}, // jqGrid
            { include: true, incfile:'jquery.tablednd.js',minfile: 'jquery.tablednd.js'}, // jqGrid
            { include: true, incfile:'jquery.contextmenu.js',minfile: 'jquery.contextmenu.js'}];

            var modulescss = [
            { include: true, incfile:'jquery-ui-1.8.6.custom.css'}, // jqGrid
            { include: true, incfile:'ui.jqgrid.css'},
            { include: true, incfile:'ui.multiselect.css'}];

            for(var i=0;i<modulescss.length; i++)
            {
                if(modulescss[i].include === true) {
                    IncludeCss(pathtocssfiles + modulescss[i].incfile);
                }
            }

	    function IncludeCss(cssFile)
            {
                var oHead = document.getElementsByTagName('head')[0];
                var oScript = document.createElement('link');
                oScript.type = 'text/css';
                oScript.rel = 'stylesheet';
                oScript.media = 'screen';
                oScript.href = cssFile;
                oHead.appendChild(oScript);
            }
            
            for(var i=0;i<modules.length; i++)
            {
                if(modules[i].include === true) {
                    if (minver !== true)
                        IncludeJavaScript(pathtojsfiles + modules[i].incfile);
                    else
                        IncludeJavaScript(pathtojsfiles + modules[i].minfile);
                }
            }

            function IncludeJavaScript(jsFile)
            {
                var oHead = document.getElementsByTagName('head')[0];
                var oScript = document.createElement('script');
                oScript.type = 'text/javascript';
                oScript.src = jsFile;
                oHead.appendChild(oScript);
            }

        }
            ";

        return $linea;

    }

}

?>
