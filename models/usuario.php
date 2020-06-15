<?php
include_once('phpORM/ORMBase.php');
class Usuario extends ORMBase{
    protected $tablename = 'usuario';

    public function delete(){
        $this->estado = 0;
        $this->update();
    }
}
?>