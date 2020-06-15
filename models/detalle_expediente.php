<?php
include_once('phpORM/ORMBase.php');

class Detalle_expediente extends ORMBase{
    protected $tablename = 'detalle_expediente';
    
    protected $hasone = array(
        'Expediente'=>'Expediente',
        'Requisito'=>'Requisito',
        'Item'=>'Item'
        );
}
?>