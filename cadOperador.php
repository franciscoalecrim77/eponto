<?php
include __DIR__.'/includes/header.php';
require_once 'vendor/autoload.php';

setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

if($_SERVER['REQUEST_METHOD'] == "POST"){
$id = null;
$idUsuario = null;
$cpfrecolhido = null;
$cpf =      (empty($_POST['cpfOperador']))? false : $_POST['cpfOperador'];
$email =    (empty($_POST['email']))? false : $_POST['email'];
$password = (empty($_POST['password']))? false : $_POST['password'];
$criptografada = base64_encode($password);
$cpfajuste = preg_replace('/[^0-9]/', '',$cpf);
$cpfajustado = intval($cpfajuste);


$informacpf = new \app\model\cadUsuario();
$informacpf->setCpf($cpfajustado);
// $informacpf->setPessoaId($id);
// var_dump($informacpf);
$cadOperadorDao = new \app\model\cadUsuarioDao(); 
$cadOperadorDao->pegainfo($informacpf);
      foreach($cadOperadorDao->pegaInfo($informacpf) as $id):
    //    var_dump($id);
      endforeach;
      
    if($id == null){
        $id = 0;
    }else{
        $idUsuario = intval($id['id']);

    }

$setaCpf = new \app\model\cadUsuario();
$setaCpf->setCpf($cpfajustado);
$cadOperadorDao = new \app\model\cadUsuarioDao(); 
$cadOperadorDao->pegaCpf($setaCpf);
      foreach($cadOperadorDao->pegaCpf($setaCpf) as $cpfrecolhido):
    //   var_dump($cpfrecolhido);

      endforeach; 


    if($id == ''){ //eu valido se o cpf do formulario consta no cadastro de usuarios;
           
            echo"<script>alert('Voce não esta cadastrado. Realize seu cadastro na tela anterior, antes de criar suas credenciais')</script>";
            
        
      }else if($cpfrecolhido > 1){
        $operador = new \app\model\cadUsuario();
        $operador->SetPessoaId($idUsuario);
        $operador->setCpf($cpfajustado);
        $operador->setEmail($email);
        $operador->setPassword($criptografada);
        $operador->setAtivo("S");
        $cadUsuarioDao = new app\Model\cadUsuarioDao();
        $cadUsuarioDao->update($operador);
        // echo "<pre>";
        // print_r($operador);
        echo"<script>alert('Cadastro atualizado com sucesso!')</script>";
        // var_dump($operador);
      }
        else if((!empty($cpfajustado) && ($email) && ($password)) && $cpfrecolhido == ''){

            $operador = new \app\model\cadUsuario();
            $operador->SetPessoaId($idUsuario);
            $operador->setCpf($cpfajustado);
            $operador->setEmail($email);
            $operador->setPassword($criptografada);
            $operador->setAtivo("S");
            $cadUsuarioDao = new app\Model\cadUsuarioDao();
            $cadUsuarioDao->create($operador);
            // echo "<pre>";
            // print_r($operador);
            echo"<script>alert('Cadastro Realizado com sucesso!')</script>";
            // var_dump($operador);
            
        
        }else{
            echo"<script>alert('Suas credenciais ja estão cadastradas em nossa base de dados')</script>";
        }

        //else if($id > 0){ //aqui eu validei que um login cadastrado para o cpf informado
           // echo "Voce ja cadastrou suas credenciais em nossa base de dados. Realize o acesso na tela inicial";
            //echo "<meta http-equiv=\"refresh\" content=\"1; url=/www\moboplan\index.php\">";   

}

?>
    <h2>Cadastro de Operadores</h2>
<section class="cadastroOperador">

    <form action="" method="post">
        
        <fieldset>
            <legend>Cadastro de Credenciais</legend>
        </fieldset>
        <div class="dadosOperador">
            <div class="divOperadorCPF">
                <label class="labelOperadorCpf" for="cpf">Confirme o seu CPF:</label> 
            <input class="operadorCpf" oninput="mascara(this)" type="text" name="cpfOperador" id="cpfOperador" required>
        </div>
        <div class="divOperadorEmail">
            <label class="labelOperadorEmail" for="email">Informe seu Email:</label>
            <input class="operadorEmail" type="email" name="email" id="email" >
        </div>
        <div class="divOperadorPassword">
            <label class="labelOperadorPassword" for="password">Informe sua senha:</label> 
            <input class="operadorPassword" type="password" name="password" id="password" required>
        </div>
        
        <input class="btnCadOperador" type="submit" value="Cadastrar">
        
    </div>
    </form>
</section>

<script>
    function mascara(i){
        
        var v = i.value;
        
        if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length-1);
            return;
        }
        
        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";
        
    }
</script>

<?php

include __DIR__.'/includes/footer.php';

?>