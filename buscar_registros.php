<?php
require_once 'vendor/autoload.php';

use App\Model\insereRegistroDao;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioId = intval($_POST['usuarioId']);

    $pontoRegistrado = new insereRegistroDao();

    if ($usuarioId === 0) {
        $administracao = $pontoRegistrado->administracaoRegistros();
    } else {
        $administracao = $pontoRegistrado->buscarRegistrosPorUsuario($usuarioId);
    }

    foreach ($administracao as $retornoAdministracao) {
        $dataFormatoBrasileiro = DateTime::createFromFormat('Y-m-d', $retornoAdministracao['data_registro'])->format('d/m/Y');
        echo "<tr class='conteudo'>";
        echo "<td style='width: 200px;'>{$retornoAdministracao['nome']}</td>";
        echo "<td>{$dataFormatoBrasileiro}</td>";
        echo "<td><span class='hora'>{$retornoAdministracao['hora_entrada']}</span><i class='fas fa-edit edit-icon' data-field='hora_entrada' data-id='{$retornoAdministracao['id']}'></i></td>";
        echo "<td><span class='hora'>{$retornoAdministracao['entrada_pausa']}</span><i class='fas fa-edit edit-icon' data-field='entrada_pausa' data-id='{$retornoAdministracao['id']}'></i></td>";
        echo "<td><span class='hora'>{$retornoAdministracao['saida_pausa']}</span><i class='fas fa-edit edit-icon' data-field='saida_pausa' data-id='{$retornoAdministracao['id']}'></i></td>";
        echo "<td><span class='hora'>{$retornoAdministracao['hora_saida']}</span><i class='fas fa-edit edit-icon' data-field='hora_saida' data-id='{$retornoAdministracao['id']}'></i></td>";
        echo "</tr>";
    }
}