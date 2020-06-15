<?php
include_once('phpORM/ORMBase.php');

class Item extends ORMBase{
    protected $tablename = 'item';
    
    protected $hasone = array(
        'Requisito'=>'Requisito'
        );
}
?>