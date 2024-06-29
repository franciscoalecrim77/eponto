<?php

namespace app\Model;

class cadCargo{
    private $cargo;
    private $setorId;

    public function getCargo(){
        return $this->cargo;
    }
    public function setCargo($cargo){
        $this->cargo = $cargo;
    }

    public function getSetorId(){
        return $this->setorId;
    }
    public function setSetorId($si){
        $this->setorId = $si;
    }
}