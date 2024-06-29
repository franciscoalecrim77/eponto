<?php
include __DIR__.'/includes/header.php';
require_once 'vendor/autoload.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

$consulta =new \App\Model\cadEmpresaDao;
$empresas = $consulta->empresas();
$cargosCadastro = new \App\Model\cadCargoDao;
$consultaCargo = $cargosCadastro->cargos();
// echo "<pre>";
// print_r($empresa) ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){
$resultado = null;
    
$nome =        (empty($_POST['nome']))? false : $_POST['nome'];
$datanasc =    (empty($_POST['datanasc']))? false : $_POST['datanasc'];
$cpf =         (empty($_POST['cpf']))? false : $_POST['cpf'];
$empresa =     (empty($_POST['empresa']))? false : $_POST['empresa'];
$ativo =       (empty($_POST['ativo']))? false : $_POST['ativo'];
$cargoUsuario =(empty($_POST['usuarioCargo']))? false : $_POST['usuarioCargo'];
$cep =         (empty($_POST['cep']))? false : $_POST['cep'];
$rua =         (empty($_POST['rua']))? false : $_POST['rua'];
$numero =      (empty($_POST['numero']))? false : $_POST['numero'];
$complemento = (empty($_POST['complemento']))? false : $_POST['complemento'];
$bairro =      (empty($_POST['bairro']))? false : $_POST['bairro'];
$cidade =      (empty($_POST['cidade']))? false : $_POST['cidade'];
$estado =      (empty($_POST['estado']))? false : $_POST['estado'];
$uf =          (empty($_POST['uf']))? false : $_POST['uf'];

$categoria = 1;
$cpfajuste = preg_replace('/[^0-9]/', '',$cpf);
$cpfajustado = intval($cpfajuste);

$informacpf = new \App\Model\CadPessoas();
$informacpf->setcpf($cpfajustado);
$cadPessoasDao = new \App\Model\cadPessoasDao(); 
$cadPessoasDao->Validar($informacpf);

foreach($cadPessoasDao->Validar($informacpf) as $resultado):
    $res = $resultado;
endforeach;

    // if($resultado['cpf'] == $cpfajustado){
    //     $consulta = new \app\model\cadPessoas();
    //     $consulta->setNome($resultado['nome']);
    // }
    if($resultado > 1){
        $pessoa = new \App\Model\cadPessoas();
        $pessoa->setNome($nome);
        $pessoa->setCPF($cpfajustado);
        $pessoa->setdataNasc($datanasc);
        $pessoa->setEmpresa($empresa);
        $pessoa->setAtivo($ativo);
        $pessoa->setCargo($cargoUsuario);  
        $pessoa->setCategoria($categoria);
        $cadPessoasDao = new \App\Model\cadPessoasDao();
        $cadPessoasDao->update($pessoa); // atualiza usuario no banco.

        $id_pessoa_consulta = new \App\Model\cadPessoasDao(); 
        $id_pessoa_consulta->pegaId($informacpf);
        foreach($id_pessoa_consulta->pegaId($informacpf) as $id_novo):
            $id_tratado = $id_novo['id'];
            // var_dump($id_tratado);
        endforeach;
        $enderecoPessoa = new \App\Model\cadEnderecos();
        $enderecoPessoa->setPessoaId($id_tratado);
        $enderecoPessoa->setCep($cep);
        $enderecoPessoa->setEndereco($rua);
        $enderecoPessoa->setNumero($numero);
        $enderecoPessoa->setComplemento($complemento);
        $enderecoPessoa->setBairro($bairro);
        $enderecoPessoa->setCidade($cidade);
        $enderecoPessoa->setEstado($estado);
        $enderecoPessoa->setUf($uf);
        $enderecoPessoacadastro = new \App\Model\cadEnderecosDao();
        $enderecoPessoacadastro->updateEndereco($enderecoPessoa);

        echo "<script>alert('Cadastro Atualizado com sucesso!')</script>";


    }else if((!empty($nome) && ($datanasc) && ($cpfajustado)) && $resultado == ''){

        $pessoa = new \App\Model\cadPessoas();
        $pessoa->setNome($nome);
        $pessoa->setdataNasc($datanasc);
        $pessoa->setCPF($cpfajustado);
        $pessoa->setCategoria($categoria);
        $pessoa->setEmpresa($empresa);
        $pessoa->setAtivo($ativo);
        $pessoa->setCargo($cargoUsuario);      
        $cadPessoasDao = new \App\Model\cadPessoasDao();
        $cadPessoasDao->create($pessoa); // Insere usuario no banco.
        // var_dump($pessoa);
        // exit;

        
        $id_pessoa_consulta = new \App\Model\cadPessoasDao(); 
        $id_pessoa_consulta->pegaId($informacpf);

        foreach($id_pessoa_consulta->pegaId($informacpf) as $id_novo):
            $id_tratado = $id_novo['id'];
            // var_dump($id_tratado);
        endforeach;


        $enderecoPessoa = new \App\Model\cadEnderecos();
        $enderecoPessoa->setPessoaId($id_tratado);
        $enderecoPessoa->setCep($cep);
        $enderecoPessoa->setEndereco($rua);
        $enderecoPessoa->setNumero($numero);
        $enderecoPessoa->setComplemento($complemento);
        $enderecoPessoa->setBairro($bairro);
        $enderecoPessoa->setCidade($cidade);
        $enderecoPessoa->setEstado($estado);
        $enderecoPessoa->setUf($uf);

        $enderecoPessoacadastro = new \App\Model\cadEnderecosDao();
        $enderecoPessoacadastro->createEndereco($enderecoPessoa);

        echo "<script>alert('Cadastro realizado com sucesso!')</script>";
        //echo "<script>alert('Voce sera redirecionado para o cadastro de credenciais')</script>";
                 

        }else{
            echo "<script>alert('Voce ja consta em nossa base de dados. Realize o acesso na tela inicial')</script>";
            //echo "<meta http-equiv=\"refresh\" content=\"1; url=/www\moboplan\index.php\">";   
        
        }
    }

 
?>
        <h2>Cadastro de usuarios</h2>
    
    <section class="cadastro">
        <form class ="formulario" action="" method="POST" >
    
            <fieldset class="caixaBasico">
                <legend>Dados Básicos</legend>
            </fieldset>
            <div class="cadastroBasico">


                    <div class="dadosBasicos1">
                        <div class="divCPF">
                            <label class="labelCPF" for="cpf"> CPF:</label>
                            <input class="cpf" oninput="mascara(this)" type="text" name="cpf" id="cpf" required>                    
                        </div>
                        <div class="divNOME">
                            <label class="labelNome" for="nome"> Nome Completo:</label>
                            <input class="nome" type="text" name="nome" id="nome" required>
                        </div> 
                        <div class="divNASC">
                            <label class="labelNASC" for="datanasc"> Nascimento:</label>
                            <input class="nasc" type="date" name="datanasc" id="datanasc" required>
                        </div>
                        <div class="divEMPRESA">
                            <label class="labelEMPRESA" for="empresa">Empresa:</label>
                            <select class="selectEmpresa" name="empresa" id="selectEmpresa">
                                <option value="0" default>Selecione a empresa</option>
                            <?php foreach($empresas as $empresa): ?>
                                <option class="valueEmpresa" value="<?php echo $empresa['id']; ?>"><?php echo $empresa['fantasia']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="dadosBasicos2">
                        
                        <div class="divATIVO">
                            <label class="labelAtivo" for="ativo">Usuario Ativo?</label>
                            <select class="ativo" name="ativo" id="ativo">
                                <option value="" default></option>
                                <option class="valueEmpresa" value="S">Sim</option>
                                <option class="valueEmpresa" value="N">Não</option>
                            </select> 
                        </div>
                        <div class="divUsuarioCargo">
                            <label class="labelUsuarioCargo" for="usuarioCargo">Cargo: </label>
                            <select class="selectUsuarioCargo" name="usuarioCargo" id="usuarioCargo">
                                <option value="0" default>Selecione o Cargo</option>
                                    <?php foreach ($consultaCargo as  $cargo):?>
                                    <option value="<?php echo $cargo['idcargos'];?>"><?php echo $cargo['cargo'];?></option>
                                    <?php endforeach; ?>    
                            </select> 
                        </div>
                    </div>
            </div>
                <fieldset class="caixaEndereco">
                    <legend>Dados Endereco</legend>
                </fieldset>

                <div class="cadastroEndereco">
                    <div class="dadosEndereco1">
                        <div class="divCEP">
                            <label class="labelCEP" for="cep"> CEP:</label>
                            <input class="cep" type="text" id="cep" name="cep" onblur="pesquisacep(this.value)">
                        </div>
                        <div class="divENDERECO">
                            <label class="labelENDERECO" for="rua"> Endereço:</label>
                            <input class="endereco"type="text" name="rua" id="rua">
                        </div>
                        <div class="divNUMERO">
                            <label class="labelNUMERO" for="numero"> Numero:</label>
                            <input class="numero"type="text" name="numero" id="numero">
                        </div>
                        <div class="divCOMPLEMENTO">
                            <label class="labelCOMPLEMENTO" for="complemento"> Complemento:</label>
                            <input class="complemento" type="text" name="complemento" id="complemento">
                        </div>

                    </div>
                    <div class="dadosEndereco2">
                        <div class="divBAIRRO">
                            <label class="labelBAIRRO" for="bairro"> Bairro:</label>
                            <input class="bairro" type="text" name="bairro" id="bairro">
                        </div>
                        <div class="divCIDADE">
                            <label class="labelCIDADE" for="cidade"> Cidade:</label>
                            <input class="cidade"type="text" name="cidade" id="cidade">                            
                        </div>
                        <div class="divESTADO">
                            <label class="labelESTADO" for="estado"> Estado:</label>
                            <input class="estado" type="text" name="estado" id="estado">   
                        </div>
                        <div class="UF">
                            <label class="labelUF" for="uf"> UF:</label>
                            <input class="uf" type="text" name="uf" id="uf">
                        </div>
                    </div>
                </div>
                <div class="cadastrar"> 
                        <input class="btn" type="submit" name="btnCadastrar" value="Cadastrar">
                </div> 
        </form>
    </section>

<?php

include __DIR__.'/includes/footer.php';

?>