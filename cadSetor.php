<?php

include __DIR__.'/includes/header.php';
require_once 'vendor/autoload.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

$setoresCadastro = new \App\Model\cadSetorDao;
$consulta = $setoresCadastro->consulta();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $setor = (empty($_POST['setor']))? false : $_POST['setor'];

    if(!empty($setor)){

        $setorCadastro = new \App\Model\cadSetor;
        $setorCadastro->setSetor($setor);
        $insert = new \App\Model\cadSetorDao;
        $insert->create($setorCadastro);
        $setoresCadastro = new \App\Model\cadSetorDao;
        $consulta = $setoresCadastro->consulta();
        echo"<script>alert('Setor Cadastrado com sucesso!')</script>";
    }else{
        echo"<script>alert('Informe o nome do setor!')</script>";
    }

}

?>

<h2>Cadastro de setores</h2>
    <section class="cadastroEmpresa">
        <form action="" method="post">
            <fieldset>
                <legend>Dados do Setor</legend>
            </fieldset>
            <div class="dadosSetor">
                <Label class="labelSetor" for="setores">Setores Cadastrados:</Label>
                    <select class="selectSetor" name="setores" id="setor">
                    <?php foreach($consulta as $setor): ?>
                        <option class="valueEmpresa" value="<?php echo $setor['idsetores'];?>"><?php echo $setor['setor']; ?></option>
                    <?php endforeach; ?>
                    </select>
                <div class="divSetor">
                    <label class="labelSetor" for="setor">Nome do Setor: </label>
                    <input class="setor" type="text" name="setor" id="setor">
                </div>
                <input class="btnCadSetor" type="submit" value="Cadastrar">
            </div>
        </form>
    </section>