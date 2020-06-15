<?php
include_once('phpORM/ORMBase.php');

class Categoria extends ORMBase{
    protected $tablename = 'categoria';
    
    protected $hasmany = array('Detalle_categoria' => 'Detalle_categoria');
}
?>