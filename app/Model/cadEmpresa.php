<?php

namespace App\Model;

class cadEmpresa{
    private $cnpj;
    private $razaoSocial;
    private $nomeFantasia;

    public function getCnpj(){
        return $this->cnpj;
    }

    public function setCnpj($cnpj){
        $this->cnpj = $cnpj;
    }

    public function getRazaoSocial(){
        return $this->razaoSocial;
    }

    public function setRazaoSocial($rs){
        $this->razaoSocial = $rs;
    }

    public function getNomeFantasia(){
        return $this->nomeFantasia;
    }

    public function setNomeFantasia($nf){
        $this->nomeFantasia = $nf;
    }

}

?>