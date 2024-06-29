<?php

namespace App\Model;

class cadCargoDao{

    function create(cadCargo $c){
        $sql = "INSERT INTO cargos (cargo, setor_id) VALUES (?,?)";
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $c->getCargo());
        $stmt->bindValue(2, $c->getSetorId());
        $stmt->execute();
    }

    function cargos(){
        $consulta = 'select c.idcargos, c.cargo, s.setor from cargos c inner join setores s on c.setor_id = s.idsetores order by c.setor_id';
        $stmt = Conn::getConn()->prepare($consulta);
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }

}