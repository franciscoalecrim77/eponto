<?php

require_once "./library/db.php";
require_once "./vendor/autoload.php";

setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

function consultaEmpresa($cnpj,$mysqli){
            $result_empresa = "SELECT
            cnpj,
            razao,
            fantasia
        FROM
            empresas
        where
            cnpj = '$cnpj'";
    $resultado_empresa = mysqli_query($mysqli, $result_empresa);
    if($resultado_empresa->num_rows > 0){
        $row_empresa = mysqli_fetch_array($resultado_empresa);
        $valoresEmpresa['cnpj'] = $row_empresa['cnpj'];
        $valoresEmpresa['razao'] = $row_empresa['razao'];
        $valoresEmpresa['fantasia'] = $row_empresa['fantasia'];
    }else{
        $valoresEmpresa['empresa'] = '';
    }
    return json_encode($valoresEmpresa);
}
echo consultaEmpresa($_GET['cnpj'], $mysqli);



// echo "<pre>";
// var_dump($mysqli);
?>