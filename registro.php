<?php

include('protect.php');
setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

$usuarioLogado = intval($_SESSION['id']);
require_once 'vendor/autoload.php';

$data = date('Y-m-d');
$horaAtual = date('H:i:s');
// echo $horaAtual;

//criação objeto para pegar as informações do registro.
$usuario = new \App\Model\insereRegistro;
$usuario->setUsuarioLogado($_SESSION['id']);

$registro = new \App\Model\insereRegistroDao;
$pontoLogado = $registro->validaRegistro($usuario);

if ($pontoLogado === false) {
    // Nenhum registro encontrado, inicialize o array
    $pontoLogado = [
        'data_registro' => null,
        'hora_entrada' => null,
        'entrada_pausa' => null,
        'saida_pausa' => null,
        'hora_saida' => null
    ];
}

if (empty($pontoLogado['data_registro'])) {
    // Se não há registro de data, é uma nova entrada
    $usuario->setDataRegistro($data);
    $usuario->setHoraEntrada($horaAtual);
    $registro->InserirHoraEntrada($usuario);
    $responseMessage = "Entrada registrada com sucesso!";
} elseif ($pontoLogado['data_registro'] == $data) {
    // Se há um registro na data atual, verificar o estado do registro
    if (empty($pontoLogado['hora_entrada'])) {
        $usuario->setHoraEntrada($horaAtual);
        $registro->InserirHoraEntrada($usuario);
        $responseMessage = "Entrada registrada com sucesso!";
    } elseif (empty($pontoLogado['entrada_pausa'])) {
        $usuario->setEntradaPausa($horaAtual);
        $registro->inserirEntradaPausa($usuario);
        $responseMessage = "Pausa registrada com sucesso!";
    } elseif (empty($pontoLogado['saida_pausa'])) {
        $usuario->setSaidaPausa($horaAtual);
        $registro->inserirSaidaPausa($usuario);
        $responseMessage = "Saída da pausa registrada com sucesso!";
    } elseif (empty($pontoLogado['hora_saida'])) {
        $usuario->setHoraSaida($horaAtual);
        $registro->inserirHoraSaida($usuario);
        $registro->inserirHoraDiferenca($usuario);
        $responseMessage = "Saída registrada com sucesso!";
    } else {
        $responseMessage = "Você não pode mais registrar hoje!";
    }
} else {
    // Novo dia, registrar nova entrada
    $usuario->setDataRegistro($data);
    $usuario->setHoraEntrada($horaAtual);
    $registro->InserirHoraEntrada($usuario);
    $responseMessage = "Entrada registrada com sucesso!";
}

echo $responseMessage;

?>