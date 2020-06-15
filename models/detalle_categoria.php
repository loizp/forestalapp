<?php
include_once('phpORM/ORMBase.php');

class Detalle_categoria extends ORMBase{
    protected $tablename = 'categoria_has_requisito';

    protected $hasone = array(
        'Categoria'=>'Categoria',
        'Requisito'=>'Requisito'
        );
    
    public function dellistcate(){
        
        $sql = "delete from categoria_has_requisito where idcategoria=".$this->idcategoria;
        
        return ORMConnection::Execute($sql);
    }
}
?>