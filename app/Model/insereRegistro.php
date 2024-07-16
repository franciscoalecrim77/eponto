<?php
namespace App\Model;
class insereRegistro{
    private $usuarioLogado;
    private $dataRegistro;
    private $horaEntrada;
    private $entradaPausa;
    private $saidaPausa;
    private $hora_saida;
    private $usuarioId; 

    public function getUsuarioLogado(){
        return $this->usuarioLogado;
    }
    public function setUsuarioLogado($usuarioLogado){
        $this->usuarioLogado = $usuarioLogado;
    }

    public function getUsuarioId(){
        return $this->usuarioId;
    }
    public function setUsuarioId($ui){
        $this->usuarioId = $ui;
    }
    
    public function getDataRegistro(){
        return $this->dataRegistro;
    }
    public function setDataRegistro($dr){
        $this->dataRegistro = $dr;
    }

    public function getHoraEntrada(){
        return $this->horaEntrada;
    }
    public function setHoraEntrada($he){
        $this->horaEntrada = $he;
    }

    public function getEntradaPausa(){
        return $this->entradaPausa;
    }
    public function setEntradaPausa($ep){
        $this->entradaPausa = $ep;
    }
    public function getSaidaPausa(){
        return $this->saidaPausa;
    }
    public function setSaidaPausa($sp){
        $this->saidaPausa = $sp;
    }

    public function getHoraSaida(){
        return $this->hora_saida;
    }
    public function setHoraSaida($hs){
        $this->hora_saida = $hs;
    }
}


?>