<?php

namespace App\Model;

    class cadSetorDao{
        function create(cadSetor $s){
            $sql = "INSERT INTO setores (setor) values (?)";
            $stmt = Conn::getConn()->prepare($sql);
            $stmt->bindValue(1, $s->getSetor());
            $stmt->execute();
        }

        function consulta(){
            $sql = "SELECT * FROM setores";
            $stmt = Conn::getConn()->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }
    }


?>