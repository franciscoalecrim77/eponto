$(document).ready(function(){
            
    $("input[name='cpfOperador']").blur(function(){        
        var $cpf = $("input[name='cpfOperador']");
        var $email = $("input[name='email']");
        $.getJSON('cadOperador.actions.php',{
            cpf: $ (this).val().replace(/[^\d]/g, '')
        }, function(json){
            if(json.cpf){
                $cpf.val(json.cpf);
                $email.val(json.email);
                $('.btnCadOperador').val("Atualizar");

            }else{
                // $cpf.val('');
                $email.val('');
                $(".btnCadOperador").val('Cadastrar');
            }

        });
    });
});