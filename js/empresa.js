$(document).ready(function(){
            
    $("input[name='cnpj']").blur(function(){        
        var $cnpj = $("input[name='cnpj']");
        var $razao = $("input[name='razaoSocial']");
        var $fantasia = $("input[name='nomeFantasia']");
        $.getJSON('cadEmpresa.actions.php',{
            cnpj: $ (this).val().replace(/[^\d]/g, '')
        }, function(json){
            if(json.cnpj){
                $cnpj.val(json.cnpj);
                $razao.val(json.razao);
                $fantasia.val(json.fantasia);
                $('.btnCadEmpresa').val("Atualizar");

            }else{
                $razao.val('');
                $fantasia.val('');
                $(".btnCadOperador").val('Cadastrar');
            }

        });
    });

    
});

$(document).ready(function() {
    $('#listaEmpresa').change(function() {
        // Pega a opção selecionada
        var selectedOption = $(this).find('option:selected');
        
        // Pega os valores dos atributos data
        var cnpj = selectedOption.data('cnpj');
        var razaoSocial = selectedOption.data('razaoSocial');
        var nomeFantasia = selectedOption.data('nomeFantasia');
        
        // Preenche os campos com os valores
        $('#cnpj').val(cnpj);
        $('#razaoSocial').val(razaoSocial);
        $('#nomeFantasia').val(nomeFantasia);
    });
});