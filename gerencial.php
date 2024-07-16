<?php
require_once 'vendor/autoload.php';
include __DIR__ . '/includes/header.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

$usuarioSessao = intval($_SESSION['id']);
$usuarioLogado = new \App\Model\insereRegistro;
$usuarioLogado->setUsuarioLogado($usuarioSessao);
$pontoRegistrado = new \App\Model\insereRegistroDao;
$consulta = $pontoRegistrado->historicoRegistros($usuarioLogado);
$administracao = $pontoRegistrado->administracaoRegistros($usuarioLogado);

$buscaUsuarios = new \App\Model\cadPessoasDao;
$retornoUsuarios = $buscaUsuarios->consulta();


?>


<div class="divTabela <?php ?>">
    <h4 class="tituloTabela">Historico de Registros</h4>
    <table class="tabela">
        <!-- <thead>Registro de pont o</thead> -->
        <tr class="descricaoTabela">
            <th>Dia</th>
            <th>Entrada 1</th>
            <th>Saida 1</th>
            <th>Entrada 2</th>
            <th>Saida 2</th>
        </tr>
        <?php foreach ($consulta as $retornoRegistros) :
            $dataFormatoBrasileiro = DateTime::createFromFormat('Y-m-d', $retornoRegistros['data_registro'])->format('d/m/Y');
        ?>
            <tr class="conteudo">
                <td><?php echo $dataFormatoBrasileiro ?></td>
                <td><?php echo $retornoRegistros['hora_entrada'] ?></td>
                <td><?php echo $retornoRegistros['entrada_pausa'] ?></td>
                <td><?php echo $retornoRegistros['saida_pausa'] ?></td>
                <td><?php echo $retornoRegistros['hora_saida'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<div class=" <?php echo ($_SESSION['categoria'] != 1) ? 'esconder' : 'divTabelaAdministrador'; ?>">

    <h4 class="tituloTabela">Administração de Registros</h4>
    <label class="labelUsuariosCadastrados" for="listaUsuarios"> Buscar Registros do Usuario :</label>
    <select class="listaUsuarios" name="listaUsuarios" id="listaUsuarios">
        <option value="0" default>Todos os Usuarios</option>
        <?php foreach ($retornoUsuarios as $listaUsuarios) : ?>
            <option value="<?php echo $listaUsuarios['id']; ?>"><?php echo $listaUsuarios['nome']; ?></option>
        <?php endforeach; ?>
    </select>
    <div id="resposta"></div>
    <table class="tabela">
    <thead>
        <tr class="descricaoTabela">
            <th>Usuario</th>
            <th>Dia</th>
            <th>Entrada 1</th>
            <th>Saida 1</th>
            <th>Entrada 2</th>
            <th>Saida 2</th>
        </tr>
    </thead>
    <tbody id="tabela-registros">
        <?php foreach ($administracao as $retornoAdministracao) :
            $dataFormatoBrasileiro = DateTime::createFromFormat('Y-m-d', $retornoAdministracao['data_registro'])->format('d/m/Y');
        ?>
            <tr class="conteudo">
                <td style="width: 200px;"><?php echo $retornoAdministracao['nome'] ?></td>
                <td><?php echo $dataFormatoBrasileiro ?></td>
                <td>
                    <span class="hora"><?php echo $retornoAdministracao['hora_entrada'] ?></span>
                    <i class="fas fa-edit edit-icon" data-field="hora_entrada" data-id="<?php echo $retornoAdministracao['id'] ?>"></i>
                </td>
                <td>
                    <span class="hora"><?php echo $retornoAdministracao['entrada_pausa'] ?></span>
                    <i class="fas fa-edit edit-icon" data-field="entrada_pausa" data-id="<?php echo $retornoAdministracao['id'] ?>"></i>
                </td>
                <td>
                    <span class="hora"><?php echo $retornoAdministracao['saida_pausa'] ?></span>
                    <i class="fas fa-edit edit-icon" data-field="saida_pausa" data-id="<?php echo $retornoAdministracao['id'] ?>"></i>
                </td>
                <td>
                    <span class="hora"><?php echo $retornoAdministracao['hora_saida'] ?></span>
                    <i class="fas fa-edit edit-icon" data-field="hora_saida" data-id="<?php echo $retornoAdministracao['id'] ?>"></i>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>




<?php
include __DIR__ . '/includes/footer.php';
?>

<script>
$(document).ready(function() {
    function buscarRegistros(usuarioId) {
        $.ajax({
            url: 'buscar_registros.php',
            method: 'POST',
            data: { usuarioId: usuarioId },
            success: function(response) {
                $('#tabela-registros').html(response);
                associarEventosEdicao(); // Re-associar eventos de edição após a atualização da tabela
            },
            error: function() {
                console.log('Erro ao buscar registros');
                $('#resposta').text('Erro ao buscar registros').show().fadeOut(3000);
            }
        });
    }

    $('#listaUsuarios').change(function() {
        var usuarioId = $(this).val();
        buscarRegistros(usuarioId); // Buscar registros independente do valor de usuarioId
    });

    function associarEventosEdicao() {
        $('.edit-icon').click(function() {
            var $icon = $(this);
            var $span = $icon.siblings('.hora');
            var currentValue = $span.text();
            var field = $icon.data('field');
            var id = $icon.data('id');

            var $input = $('<input type="time" />').val(currentValue);
            $span.replaceWith($input);
            $input.focus();

            $input.on('blur', function() {
                var newValue = $input.val();
                $input.replaceWith('<span class="hora">' + newValue + '</span>');
                saveChanges(id, field, newValue);
            });

            // Para salvar quando Enter é pressionado
            $input.on('keypress', function(e) {
                if (e.which === 13) { // Enter key
                    $input.blur();
                }
            });
        });
    }

    function saveChanges(id, field, value) {
        $.ajax({
            url: 'cadRegistro.actions.php',
            method: 'POST',
            data: {
                id: id,
                field: field,
                value: value
            },
            success: function(response) {
                console.log('Horário atualizado com sucesso');
                alert('Horário atualizado com sucesso!')
            },
            error: function() {
                console.log('Erro ao atualizar horário');
                $('#resposta').text('Erro ao atualizar horário').show().fadeOut(3000);
            }
        });
    }

    // Inicialmente associar eventos de edição
    associarEventosEdicao();
});
</script>