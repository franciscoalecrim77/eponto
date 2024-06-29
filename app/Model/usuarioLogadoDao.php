<?php 

namespace app\Model;

class usuarioLogadoDao{

    public function usuarioLogado(usuarioLogado $ul){
        $sql = 'SELECT
	a.pessoa_id,
	b.nome,
	b.id_empresa,
	c.cnpj,
	c.fantasia,
	d.cargo
FROM
	usuarios a
JOIN pessoas b ON
	a.pessoa_id = b.id
join empresas c on b.id_empresa = c.id 
join cargos d on b.idcargos = d.idcargos 
WHERE
	b.id = ?';        
        $stmt = Conn::getConn()->prepare($sql);
        $stmt->bindValue(1, $ul->getIdUsuario());
        $stmt->execute();
        $resultado = $stmt->fetchALL(\PDO::FETCH_ASSOC);
        return $resultado;
    }
}