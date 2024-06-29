<?php
include __DIR__.'/includes/header.php';
require_once 'vendor/autoload.php';

setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

$setoresCadastro = new \App\Model\cadSetorDao;
$consulta = $setoresCadastro->consulta();

$cargosCadastro = new \App\Model\cadCargoDao;
$consultaCargo = $cargosCadastro->cargos();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $cargo = (empty($_POST['cargo']))?false:$_POST['cargo'];
    $setor = (empty($_POST['setorSelect']))?false:$_POST['setorSelect'];

    if(!empty($cargo) && $setor){
        $pegaCargo = new \App\Model\cadCargo;
        $pegaCargo->setCargo($cargo);
        $pegaCargo->setSetorId(($setor));
        $insereCargo = new \App\Model\cadCargoDao;
        $insereCargo->create($pegaCargo);
        echo'<script>alert("Cadastro realizado com sucesso")</script>';
        $cargosCadastro = new \App\Model\cadCargoDao;
        $consultaCargo = $cargosCadastro->cargos();
    }

}
?>


<h2>Cadastro de Cargos</h2>
    <section class="cadastroEmpresa">
        <form action="" method="post">
            <fieldset>
                <legend>Dados dos Cargos</legend>
            </fieldset>
            
            <div class="dadosCargo">                           
                    <Label class="labelCargoSelect" for="cargoSelect">Cargos Cadastrados:</Label>
                    <select class="selectCargo" name="cargoSelect" id="cargoSelect">
                    <?php foreach($consultaCargo as $cargos): ?>
                        <option class="valueEmpresa" value="<?php echo $cargos['idcargos'];?>"><?php echo $cargos['cargo'] . ' - ' . $cargos['setor'] ; ?></option>
                    <?php endforeach; ?>
                    </select>
                <div class="divCargo">
                    <label class="labelCargo" for="cargo">Nome do Cargo: </label>
                    <input class="cargo" type="text" name="cargo" id="cargo">
                </div>

                <div class="setores">
                    <Label class="labelSetorSelect" for="setorSelect">Setores Cadastrados:</Label>
                    <select class="setorSelect" name="setorSelect" id="setorSelect">
                        <option value="0">Selecione um Setor</option>
                    <?php foreach($consulta as $setor): ?>
                        <option class="setorSelect" value="<?php echo $setor['idsetores'];?>"><?php echo $setor['setor']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="submit">

                    <input class="btnCadCargo" type="submit" value="Cadastrar">
                </div>
            </div>
        </form>
    </section>


    <?php

include __DIR__.'/includes/footer.php';

    ?>