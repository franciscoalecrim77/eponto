<?php

namespace App\Model;
class CadPessoas{
    private $id;
    private $nome;
    private $cpf;
    private $dataNasc;
    private $consulta;
    private $ativo;
    private $empresa;
    private $cargo;
    private $categoria;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($no){
        $this->nome = $no;
    }

    public function getcpf(){
        return $this->cpf;
    }
    public function setcpf($cpf){
        $this->cpf = intval($cpf);
    }

    public function getdataNasc(){
        return $this->dataNasc;
    }
    public function setdataNasc($dn){
        $this->dataNasc = $dn;
    }

    public function getEmpresa(){
        return $this->empresa;
    }

    public function setEmpresa($em){
        $this->empresa = $em;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setAtivo($ativo){
        $this->ativo = $ativo;
    }

    public function getCargo(){
        return $this->cargo;
    }

    public function setCargo($ca){
        $this->cargo = $ca;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($cat){
        $this->categoria = $cat;
    }
    
    public function getConsulta(){
        return $this->consulta;
    }
    
    public function setConsulta($con){
        $this->consulta = $con;
    }

   
}

?>