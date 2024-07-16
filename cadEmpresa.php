<?php
include __DIR__.'/includes/header.php';
require_once 'vendor/autoload.php';

setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

$empresaCadastrada = new \App\Model\cadEmpresaDao();
$listaEmpresaCadastrada = $empresaCadastrada->empresas();


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $resultado = null;

    $cnpj =         (empty($_POST['cnpj']))? false : $_POST['cnpj'];
    $razaoSocial =  (empty($_POST['razaoSocial']))? false : $_POST['razaoSocial'];
    $nomeFantasia = (empty($_POST['nomeFantasia']))? false : $_POST['nomeFantasia'];

    $consulta = new \App\Model\cadEmpresa();
    $consulta->setCnpj($cnpj);
    $cadEmpresaDao = new \App\Model\cadEmpresaDao();
    $cadEmpresaDao->pegaCnpj($consulta);
    foreach ($cadEmpresaDao->pegaCnpj($consulta) as $resultado) {
        $res = $resultado;
        // echo $res;
    }

    if($resultado > 1){
    $empresa = new \App\Model\cadEmpresa();
    $empresa->setCnpj($cnpj);
    $empresa->setRazaoSocial($razaoSocial);
    $empresa->setNomeFantasia($nomeFantasia);
    $empresaCadastrada = new \App\Model\cadEmpresaDao();
    $empresaCadastrada->empresas(); 

    $insereEmpresa = new \App\Model\cadEmpresaDao();
    $insereEmpresa->update($empresa);
    echo"<script>alert('Dados de Empresa atualizado com sucesso!')</script>";
    }else if(!empty($cnpj) && ($razaoSocial) && ($nomeFantasia) && $resultado == ''){
        $empresa = new \App\Model\cadEmpresa();
        $empresa->setCnpj($cnpj);
        $empresa->setRazaoSocial($razaoSocial);
        $empresa->setNomeFantasia($nomeFantasia);
        $insereEmpresa = new \App\Model\cadEmpresaDao();
        $insereEmpresa->create($empresa);
        echo"<script>alert('Empresa cadastrado com sucesso!')</script>";
    }
    



}


?>

<h2>Cadastro de Empresas</h2>
    <section class="cadastroEmpresa">
        <form action="" method="post">
            <fieldset>
                <legend>Dados da Empresa</legend>
            </fieldset>
            <div class="dadosEmpresa">
                <div class="empresasCadastradas">
                    <label class="labelEmpresasCadastradas" for="listaEmpresa"> Empresas Cadastradas:</label>
                    <select class="listaEmpresa" name="listaEmpresa" id="listaEmpresa">
                        <option value="0" default>Empresas Cadastradas</option>
                        <?php foreach($listaEmpresaCadastrada as $listaEmpresa): ?>
                            <option value="<?php echo $listaEmpresa['id']; ?>" 
                                    data-cnpj="<?php echo $listaEmpresa['cnpj']; ?>"
                                    data-razao="<?php echo $listaEmpresa['razao']; ?>"
                                    data-fantasia="<?php echo $listaEmpresa['fantasia']; ?>">
                                <?php echo $listaEmpresa['fantasia'] . ' - ' .$listaEmpresa['cnpj']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="divCnpj">
                    <label class="labelCnpj" for="cnpj">CNPJ:</label>
                    <input class="cnpjEmpresa" type="number" name="cnpj" id="cnpj">
                </div>
                <div class="divRazaoSocial">
                    <label class="labelRazaoSocial" for="razaoSocial">Razao Social:</label>
                    <input class="razaoSocial" type="text" name="razaoSocial" id="razaoSocial">
                </div>
                <div class="divNomeFantasia">
                    <label class="labelNomeFantasia" for="cnpj">Nome Fantasia:</label>
                    <input class="nomeFantasia" type="text" name="nomeFantasia" id="nomeFantasia">
                </div>
                <input class="btnCadEmpresa" type="submit" value="Cadastrar">
            </div>
        </form>
    </section>

<?php
include_once "./includes/footer.php";
?>
<script>
$(document).ready(function() {
        $('#listaEmpresa').change(function() {
            // Pega a opção selecionada
            var selectedOption = $(this).find('option:selected');
            
            // Pega os valores dos atributos data
            var cnpj = selectedOption.attr('data-cnpj');
            var razaoSocial = selectedOption.attr('data-razao');
            var nomeFantasia = selectedOption.attr('data-fantasia');
            
            // Preenche os campos com os valores
            $('#cnpj').val(cnpj);
            $('#razaoSocial').val(razaoSocial);
            $('#nomeFantasia').val(nomeFantasia);
        });
    });
    </script>
