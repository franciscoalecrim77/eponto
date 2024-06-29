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
    <link rel="icon" type="image/x-icon" href="/img/favicon-16x16.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/cadOperador.css">
    <link rel="stylesheet" href="css/aside.css">
    <link rel="stylesheet" href="css/cadEmpresa.css">
    <link rel="stylesheet" href="css/Setores.css">
    <link rel="stylesheet" href="css/cargos.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <script src="js/cadastro.js"></script>
    <script src="/js/cadOperador.js"></script>
    <script src="/js/empresa.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
    <!-- <script type="text/javascript" src="/js/header.js"></script> -->
    <script type="text/javascript">
        jQuery(window).load(function ($) {
            atualizaRelogio();
        });
            
    </script>
</head>
<body>
    <header class="header">
        <a href="gerencial.php"><img src="/img/seu-logo-aqui-1.png" alt=""></a>
        <h1 class="titulo">Sistema Gerenciador de Ponto Eletronico </h1>
        <div class="sessao">
            <div class="usuarioLogado">Usuario Logado: <?php echo $validado['nome']?></div>
            <div class="empresa">Empresa: Dados da Empresa Aqui</div>
            <div class="cnpj">CNPJ: 62753042000150</div>
            <div class="dataHora"><output id="hora" class="hora"></output> - <output id="data" class="data"></output></div>
            <button class="registro" action="registro.php"><a href="registro.php">Registrar</a></button>
        </div>
    </header>
    <div class="aside-bar">
    <div class="headerAside-Bar">
        <div class="usuario"><?php echo $validado['nome']?></div>
        <div class="cargo">Cargo: Analista de suporte</div>
        <div class="banco">Total de banco: 02:00h</div>
    </div>
    <div class="menu">
        <div class="item"><a class="sub-btn"><i class="fa-solid fa-file-lines"></i>Cadastros
            <i class="fas fa-angle-right dropdown"></i>
            </a>
            <div class="sub-menu">
                <!-- <a href="" class="sub-item">Categorias</a> -->
                <a href="cadCargo.php" class="sub-item">Cargos</a>
                <a href="cadEmpresa.php" class="sub-item">Empresa</a>
                <a href="cadOperador.php" class="sub-item">Operadores</a>
                <a href="cadSetor.php" class="sub-item">Setores</a>   
                <a href="cadastro.php" class="sub-item">Usuarios</a>
                <!-- <a href="" class="sub-item">Chablau</a> -->
            </div>
        </div>
        <div class="item"><a class="sub-btn"><i class="fas fa-table"></i>Relatorios</a></div>
        <div class="item"><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></i>Sair</a></div>
    </div>
</div>
    <script>
        $(".registro").click('Registro inserido com sucesso');
    </script>

