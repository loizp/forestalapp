<?php
include_once('phpORM/ORMBase.php');

class Requisito extends ORMBase{
    protected $tablename = 'requisito';
    
    protected $hasmany = array(
        'Archivo' => 'Archivo',
        'Item' => 'Item'
        );
    
    public function deletereq(){
        
        $sql = "delete from requisito where idrequisito=".$this->idrequisito;
        
        return ORMConnection::Execute($sql);
    }
}
?>