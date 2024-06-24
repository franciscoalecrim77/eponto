<?php
include('protect.php');
$usuarioLogado = intval($_SESSION['id']);

require_once 'vendor/autoload.php';
$operadorLogado = new \app\model\usuarioLogado();
$operadorLogado->setIdUsuario($usuarioLogado);
// $operadorLogadoDao = new \app\model\usuarioLogadoDao();
$usuarioLogado = new \app\model\usuarioLogadoDao();
$usuarioLogado->usuarioLogado($operadorLogado);
foreach($usuarioLogado->usuarioLogado($operadorLogado) as $validado):
  //print_r($validado);
endforeach;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerencial</title>
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/cadOperador.css">
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <script src="js/cadastro.js"></script>
    <script src="/js/cadOperador.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
    <script type="text/javascript" src="/js/header.js"></script>
    <script type="text/javascript">
        jQuery(window).load(function ($) {
            atualizaRelogio();
        });
            
    </script>
</head>
<body>
    <header class="header">
        <img src="/img/ecletica.jpg" alt="">
        <h1 class="titulo">Sistema Gerenciador de Ponto Eletronico </h1>
        <div class="sessao">
            <div class="usuarioLogado">Usuario Logado: <?php echo $validado['nome']?></div>
            <div class="empresa">Empresa: Prestsoft soluções em informatica</div>
            <div class="cnpj">CNPJ: 02143500000108</div>
            <div class="dataHora"><output id="hora" class="hora"></output> - <output id="data" class="data"></output></div>
            <button class="registro" action="registro.php"><a href="registro.php">Registrar</a></button>
        </div>
    </header>

    <script>
        $(".registro").click('Registro inserido com sucesso');
    </script>

