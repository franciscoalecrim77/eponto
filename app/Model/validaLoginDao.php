<?php

namespace App\Model;

class ValidaLoginDao {

    public function validaLogin(ValidaLogin $vL) {     
        $sql = 'SELECT pessoa_id, email, senha FROM usuarios WHERE email = ? AND senha = ?';
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $vL->getEmail());
        $stmt->bindValue(2, $vL->getPassword());
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $resultado;
    }

    public function idSessao(ValidaLogin $is) {
        $sql = 'SELECT pessoa_id FROM usuarios WHERE email = ?';
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $is->getEmail());
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }
}

?>