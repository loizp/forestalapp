<?php
include_once('phpORM/ORMBase.php');

class Expediente extends ORMBase{
    protected $tablename = 'expediente';
    
    protected $hasone = array(
        'Categoria'=>'Categoria',
        'Tipoexp'=>'Tipoexp'
        );
    
    protected $hasmany = array('Archivo' => 'Archivo');
    
    public function updatemapa(){
        
        $sql = 'update expediente set mapa= "'.$this->mapa.'", timapa="'.$this->timapa.'" , extmapa="'.$this->extmapa.'" where idexpediente='.$this->idexpediente;
        
        return ORMConnection::Execute($sql);
    }
}
?>