<?php
require_once 'vendor/autoload.php';

// Configurações do banco de dados
$host = '127.0.0.1';
$user = "francisco";
$password = "weagle";
$db = "eponto";

try {
    // Conectar ao banco de dados
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = intval($_POST['id']);
        $field = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['field']);
        $value = $_POST['value'];

        // Verifique se os dados são válidos
        if ($id > 0 && in_array($field, ['hora_entrada', 'entrada_pausa', 'saida_pausa', 'hora_saida']) && preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $value)) {
            // Atualizar o valor no banco de dados
            $sql = "UPDATE registros SET $field = :value WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':value', $value);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo 'Horário atualizado com sucesso';

                // Recalcular e atualizar o tempo_diferenca
                $sqlUpdateTempoDiferenca = "
                    UPDATE registros
                    SET tempo_diferenca = SEC_TO_TIME(
                        TIME_TO_SEC(entrada_pausa) - TIME_TO_SEC(hora_entrada) + 
                        TIME_TO_SEC(hora_saida) - TIME_TO_SEC(saida_pausa) - 28800
                    )
                    WHERE id = :id";
                $stmtUpdateTempoDiferenca = $conn->prepare($sqlUpdateTempoDiferenca);
                $stmtUpdateTempoDiferenca->bindParam(':id', $id, PDO::PARAM_INT);

                if ($stmtUpdateTempoDiferenca->execute()) {
                    echo 'Tempo diferença atualizado com sucesso';
                } else {
                    echo 'Erro ao atualizar tempo diferença';
                }
            } else {
                echo 'Erro ao atualizar horário';
            }
        } else {
            echo 'Dados inválidos';
            echo "ID: $id, Field: $field, Value: $value";
        }
    }
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}


?>