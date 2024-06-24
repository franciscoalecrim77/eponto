<?php

require_once "./library/db.php";
require_once "./vendor/autoload.php";

setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

function consultaOperador($cpf,$mysqli){
            $result_operador = "SELECT
            pessoa_id,
            cpf,
            email,
            senha
        FROM
            eponto.usuarios
        where
            cpf = '$cpf'";
    $resultado_operador = mysqli_query($mysqli, $result_operador);
    if($resultado_operador->num_rows > 0){
        $row_operador = mysqli_fetch_array($resultado_operador);
        $valoresOperador['pessoa_id'] = $row_operador['pessoa_id'];
        $valoresOperador['cpf'] = $row_operador['cpf'];
        $valoresOperador['email'] = $row_operador['email'];
        $valoresOperador['senha'] = $row_operador['senha'];
    }else{
        $valoresOperador['cpf'] = '';
    }
    return json_encode($valoresOperador);
}
echo consultaOperador($_GET['cpf'], $mysqli);



// echo "<pre>";
// var_dump($mysqli);
?>