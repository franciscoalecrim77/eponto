<?php



namespace App\Model;
class cadPessoasDao{
    
    public function create(CadPessoas $cd){
        $sql = 'INSERT INTO pessoas (cpf, nome, data_nasc, id_empresa, ativo, idcargos, categoria_id ) VALUES (?,?,?,?,?,?,?)';
        $stmt = Conn::getConn()->prepare($sql);       
        $stmt->bindValue(1, $cd->getCPF());
        $stmt->bindValue(2, $cd->getNome());
        $stmt->bindValue(3, $cd->getdataNasc());
        $stmt->bindValue(4, $cd->getEmpresa());
        $stmt->bindValue(5, $cd->getAtivo());
        $stmt->bindValue(6, $cd->getCargo());
        $stmt->bindValue(7, $cd->getCategoria());
        $stmt->execute();
     
            $consulta = 'SELECT * FROM pessoas where cpf =' . $cd->getcpf();
            $stmt = Conn::getConn()->prepare($consulta);
            $stmt->execute();
            $resultado = $stmt->fetchALL(\PDO::FETCH_ASSOC);
            return $resultado;
       
    }

    public function Validar(cadPessoas $c){
            $sql = 'SELECT * FROM pessoas where cpf = ?';
            $stmt = Conn::getConn()->prepare($sql);  
            $stmt->bindValue(1, $c->getCPF());
            $stmt->execute();
            $resultado = $stmt->fetchALL(\PDO::FETCH_ASSOC);
                return $resultado;           
            /*if($stmt->rowCount() > 1):
                $resultado = $stmt->fetchALL(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;*/                                   
    }

    public function pegaId(cadPessoas $id){
       
          $sql = 'SELECT id FROM pessoas where cpf = ?';
          $stmt = Conn::getConn()->prepare($sql);  
          $stmt->bindValue(1, $id->getCPF());
          $stmt->execute();
          $resultado = $stmt->fetchALL(\PDO::FETCH_ASSOC);
              return $resultado;                                            
  }

   public function consulta(){
        $sql = 'SELECT * FROM pessoas';
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchALL(\PDO::FETCH_ASSOC);
        return $resultado;
   }

   public function update(CadPessoas $cd) {
    $sql = 'UPDATE pessoas SET nome = ?, data_nasc = ?, id_empresa = ?, ativo = ?, idcargos = ?, categoria_id = ? WHERE cpf = ?';
    $stmt = Conn::getConn()->prepare($sql);
    $stmt->bindValue(1, $cd->getNome());
    $stmt->bindValue(2, $cd->getdataNasc());
    $stmt->bindValue(3, $cd->getEmpresa());
    $stmt->bindValue(4, $cd->getAtivo());
    $stmt->bindValue(5, $cd->getCargo());
    $stmt->bindValue(6, $cd->getCategoria());
    $stmt->bindValue(7, $cd->getCPF());
    $stmt->execute();
}
}


?>

