<?php

namespace app\Model;

class cadEmpresaDao{

    function create(cadEmpresa $empresa){
        $insert = 'INSERT INTO empresas (cnpj, razao, fantasia) VALUES(?,?,?)';
        $stmt = Conn::getConn()->prepare($insert);
        $stmt->bindValue(1, $empresa->getCnpj());
        $stmt->bindValue(2, $empresa->getRazaoSocial());
        $stmt->bindValue(3, $empresa->getNomeFantasia());
        $stmt->execute();
    }

    function pegaCnpj(cadEmpresa $pc){
        $consulta = 'SELECT * from empresas WHERE cnpj = ?';
        $stmt = Conn::getConn()->prepare($consulta);
        $stmt->bindValue(1, $pc->getCnpj());
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    function update(cadEmpresa $empresa){
        $update = 'UPDATE empresas SET razao = ?, fantasia = ? WHERE cnpj = ?';
        $stmt = Conn::getConn()->prepare($update);
        $stmt->bindValue(1, $empresa->getRazaoSocial());
        $stmt->bindValue(2, $empresa->getNomeFantasia());
        $stmt->bindValue(3, $empresa->getCnpj());
        $stmt->execute();
    }

    function empresas(){
        $consulta = 'SELECT * from empresas';
        $stmt = Conn::getConn()->prepare($consulta);
        // $stmt->bindValue(1, $pc->getCnpj());
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }
}
?>