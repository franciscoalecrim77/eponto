<?php

namespace App\Model;

class validaLoginDao {

    public function validaLogin(validaLogin $vL) {     
        $sql = 'SELECT pessoa_id, email, senha FROM usuarios WHERE email = ? AND senha = ?';
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $vL->getEmail());
        $stmt->bindValue(2, $vL->getPassword());
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;

    }

    public function idSessao(ValidaLogin $is) {
        $sql = 'SELECT s.pessoa_id, p.categoria_id, c.id, c.categoria FROM usuarios s JOIN pessoas p ON s.pessoa_id = p.id JOIN categoria c ON p.categoria_id = c.id where email = ?';
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $is->getEmail());
        $stmt->execute();
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        // var_dump($resultado);
        return $resultado;
    }
}

?>