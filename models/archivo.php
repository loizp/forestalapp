<?php
include_once('phpORM/ORMBase.php');

class Archivo extends ORMBase{
    protected $tablename = 'archivo';
    
    protected $hasone = array(
        'Expediente'=>'Expediente',
        'Requisito'=>'Requisito'
        );
    
    public function subirarch(){
        
        $sql = 'insert into archivo (numdoc,contenido,estado,idexpediente,idrequisito,nombre,fechasubida,tipomime) values ("'.$this->numdoc.'" , "'.$this->contenido.'" , "'.$this->estado.'", '.$this->idexpediente.', '.$this->idrequisito.', "'.$this->nombre.'", "'.$this->fechasubida.'", "'.$this->tipomime.'")';
        
        return ORMConnection::Execute($sql);
    }
    
    public function cambiararch(){
        
        $sql = 'update archivo set contenido= "'.$this->contenido.'", estado="'.$this->estado.'" , nombre="'.$this->nombre.'", fechasubida="'.$this->fechasubida.'", tipomime="'.$this->tipomime.'" where idarchivo='.$this->idarchivo;
        
        return ORMConnection::Execute($sql);
    }
    
    public function actdescrip(){
        
        $sql = 'update archivo set estado="'.$this->estado.'" where idarchivo='.$this->idarchivo;
        
        return ORMConnection::Execute($sql);
    }
}
?>