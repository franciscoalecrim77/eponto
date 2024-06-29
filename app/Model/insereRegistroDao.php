<?php



namespace App\Model;

class insereRegistroDao{

    
    public function inserirRegistro(InsereRegistro $ir){
        $sql = 'INSERT INTO registros (pessoa_id) VALUES (?)';
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $ir->getusuarioLogado());
   
        $stmt->execute();
        
    }
    
}
header("location: gerencial.php");

?>

