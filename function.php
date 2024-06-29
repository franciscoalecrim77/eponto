<?php
include 'library/db.php';
require_once 'vendor/autoload.php';


setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

function retorna($cpf, $mysqli){
    $result_analista = "select
	p.cpf,
	p.nome,
	p.data_nasc,
    p.id_empresa,
    p.ativo,
    p.idcargos,
	e.cep,
	e.endereco,
	e.numero,
	e.complemento,
	e.bairro,
	e.cidade,
	e.estado,
    e.uf
from
	eponto.enderecos e 
inner join eponto.pessoas p on
	p.cpf = '$cpf'";
    $resultado_analista = mysqli_query($mysqli, $result_analista);
    if($resultado_analista->num_rows > 0){
        $row_analista = mysqli_fetch_array($resultado_analista);
        $valores['cpf'] = $row_analista['cpf'];
        $valores['nome'] = $row_analista['nome'];
        $valores['data_nasc'] = $row_analista['data_nasc'];
        $valores['id_empresa'] = $row_analista['id_empresa'];
        $valores['ativo'] = $row_analista['ativo'];
        $valores['idcargos'] = $row_analista['idcargos'];
        $valores['cep'] = $row_analista['cep'];
        $valores['endereco'] = $row_analista['endereco'];
        $valores['numero'] = $row_analista['numero'];
        $valores['complemento'] = $row_analista['complemento'];
        $valores['bairro'] = $row_analista['bairro'];
        $valores['cidade'] = $row_analista['cidade'];
        $valores['estado'] = $row_analista['estado'];
        $valores['uf'] = $row_analista['uf'];


        //print_r($valores);
    }else{
        $valores['nome'] = '';
    }
    return json_encode($valores);
}

if(isset($_GET['cpf'])){
    echo retorna($_GET['cpf'], $mysqli);
}

?>