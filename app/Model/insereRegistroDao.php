<?php



namespace App\Model;

class insereRegistroDao{
    
    public function buscarRegistrosPorUsuario(int $usuarioId) {
        $sql = "SELECT r.id, r.pessoa_id, p.nome, r.data_registro, r.hora_entrada, r.entrada_pausa, r.saida_pausa, r.hora_saida, r.tempo_diferenca FROM registros r inner join pessoas p on r.pessoa_id = p.id where pessoa_id = ? limit 15;";
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $usuarioId, \PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function historicoRegistros(insereRegistro $hr){
        $sql = "SELECT r.pessoa_id, p.nome, r.data_registro, r.hora_entrada, r.entrada_pausa, r.saida_pausa, r.hora_saida, r.tempo_diferenca FROM registros r inner join pessoas p on r.pessoa_id = p.id where pessoa_id = ? limit 10;";
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $hr->getUsuarioLogado());
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;

    }


    public function validaRegistro(insereRegistro $vl){
        $sql = "SELECT * FROM registros where pessoa_id = ? order by data_registro desc limit 1";
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $vl->getUsuarioLogado());
        $stmt->execute();
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
        
    }

    public function InserirHoraEntrada(InsereRegistro $ir){
        $sql = 'INSERT INTO registros (pessoa_id,data_registro, hora_entrada) VALUES (?,?,?)';
        try {
            $stmt = Conn::getConn()->prepare($sql);
            $stmt->bindValue(1, $ir->getUsuarioLogado());
            $stmt->bindValue(2, $ir->getDataRegistro());
            $stmt->bindValue(3, $ir->getHoraEntrada());
            $stmt->execute();

        } catch (\PDOException $e) {
            echo "Erro ao inserir registro: " . $e->getMessage();
        }
    }

    public function inserirEntradaPausa(InsereRegistro $ir){
        $data = date('Y-m-d');
        $horaAtual = date('H:i:s');
        $sql = "UPDATE registros set entrada_pausa = '{$horaAtual}' where pessoa_id = ? and data_registro = '{$data}'";
        try {
            $stmt = Conn::getConn()->prepare($sql);
            $stmt->bindValue(1, $ir->getUsuarioLogado());
            $stmt->execute();

        } catch (\PDOException $e) {
            echo "Erro ao inserir registro: " . $e->getMessage();
        }
    }

    public function inserirSaidaPausa(InsereRegistro $ir){
        $data = date('Y-m-d');
        $horaAtual = date('H:i:s');
        $sql = "UPDATE registros set saida_pausa = '{$horaAtual}' where pessoa_id = ? and data_registro = '{$data}'";
        try {
            $stmt = Conn::getConn()->prepare($sql);
            $stmt->bindValue(1, $ir->getUsuarioLogado());
            $stmt->execute();

        } catch (\PDOException $e) {
            echo "Erro ao inserir registro: " . $e->getMessage();
        }
    }

    public function inserirHoraSaida(InsereRegistro $ir){
        $data = date('Y-m-d');
        $horaAtual = date('H:i:s');
        $sql = "UPDATE registros set hora_saida = '{$horaAtual}' where pessoa_id = ? and data_registro = '{$data}'";
        try {
            $stmt = Conn::getConn()->prepare($sql);
            $stmt->bindValue(1, $ir->getUsuarioLogado());
            $stmt->execute();

        } catch (\PDOException $e) {
            echo "Erro ao inserir registro: " . $e->getMessage();
        }
    }

    public function inserirHoraDiferenca(insereRegistro $ir){
        $data = date('Y-m-d');
        $sql = "UPDATE registros SET tempo_diferenca = SEC_TO_TIME(TIME_TO_SEC(entrada_pausa) - TIME_TO_SEC(hora_entrada) + TIME_TO_SEC(hora_saida) - TIME_TO_SEC(saida_pausa) - 28800)WHERE data_registro = '{$data}' AND pessoa_id = ?";
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $ir->getUsuarioLogado());
        $stmt->execute();
    }

    public function pegaDiferenca(insereRegistro $pd){
        // $data = date('Y-m-d');
        $sql = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( tempo_diferenca ) ) ),'%H:%i:%s') as tempo_diferenca FROM registros where pessoa_id = ?";
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $pd->getUsuarioLogado());
        $stmt->execute();
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function administracaoRegistros() {
        $sql = "SELECT p.nome, r.* FROM registros r JOIN pessoas p ON r.pessoa_id = p.id ORDER BY r.data_registro DESC LIMIT 15";
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }

}



?>

