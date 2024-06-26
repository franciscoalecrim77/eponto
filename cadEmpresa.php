<?php

// use app\Model\cadEmpresa;

include __DIR__.'/includes/header.php';
require_once 'vendor/autoload.php';

setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

// print_r($_SERVER);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $resultado = null;

    $cnpj =         (empty($_POST['cnpj']))? false : $_POST['cnpj'];
    $razaoSocial =  (empty($_POST['razaoSocial']))? false : $_POST['razaoSocial'];
    $nomeFantasia = (empty($_POST['nomeFantasia']))? false : $_POST['nomeFantasia'];

    $consulta = new \app\model\cadEmpresa();
    $consulta->setCnpj($cnpj);
    $cadEmpresaDao = new \app\model\cadEmpresaDao();
    $cadEmpresaDao->pegaCnpj($consulta);
    foreach ($cadEmpresaDao->pegaCnpj($consulta) as $resultado) {
        $res = $resultado;
        // echo $res;
    }

    if($resultado > 1){
    $empresa = new \app\model\cadEmpresa();
    $empresa->setCnpj($cnpj);
    $empresa->setRazaoSocial($razaoSocial);
    $empresa->setNomeFantasia($nomeFantasia);

    $insereEmpresa = new \app\model\cadEmpresaDao();
    $insereEmpresa->update($empresa);
    echo"<script>alert('Dados de Empresa atualizado com sucesso!')</script>";
    }else if(!empty($cnpj) && ($razaoSocial) && ($nomeFantasia) && $resultado == ''){
        $empresa = new \app\model\cadEmpresa();
        $empresa->setCnpj($cnpj);
        $empresa->setRazaoSocial($razaoSocial);
        $empresa->setNomeFantasia($nomeFantasia);
        $insereEmpresa = new \app\model\cadEmpresaDao();
        $insereEmpresa->create($empresa);
        echo"<script>alert('Empresa cadastrado com sucesso!')</script>";
    }
    



}


?>
<?php

?>
<div>
    </div>
    <h2>Cadastro de Empresas</h2>
    <section class="cadastroEmpresa">
        <form action="" method="post">
            <fieldset>
            
            <legend>Dados da Empresa</legend>
        </fieldset>
        <div class="dadosEmpresa">
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