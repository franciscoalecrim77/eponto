$(document).ready(function(){
            
    $("input[name='cpfOperador']").blur(function(){        
        var $cpf = $("input[name='cpfOperador']");
        var $email = $("input[name='email']");
        var $password = $("input[name='password']");
        $.getJSON('cadOperador.actions.php',{
            cpf: $ (this).val().replace(/[^\d]/g, '')
        }, function(json){
            if(json.cpf){
                $cpf.val(json.cpf);
                $email.val(json.email);
                $password.val(json.senha);
                $('.btnCadOperador').val("Atualizar");

            }else{
                // $cpf.val('');
                $email.val('');
                $password.val('');
                $(".btnCadOperador").val('Cadastrar');
            }

        });
    });
});