$(document).ready(function() {

    $('.filtraNomeAjax').keyup(function(event) {
        if($(this).val().length >= 3) {
            var campoSelect = $(this).next().attr('id');
            var campoNome = $(this).attr('name');
            var campoId = $(this).prev().attr('name');

            $.ajax({
                type: "get",
                url: '/ajax/'+campoNome+'/filtro/' + $(this).val() + '/' + campoId + '/' + campoNome + '/' + campoSelect,
                success: function (data) {
                    $('#' + campoSelect).html(data);
                    $('#' + campoSelect).css("display", "block");
                }
            });
        }
    });
    $('.filtraNomePequenoAjax').keyup(function(event) {
        // dd('aqui cheguei');
        if($(this).val().length >= 2) {
            var campoSelect = $(this).next().attr('id');
            var campoNome = $(this).attr('name');
            var campoId = $(this).prev().attr('name');

            $.ajax({
                type: "get",
                url: '/ajax/'+campoNome+'/filtro/' + $(this).val() + '/' + campoId + '/' + campoNome + '/' + campoSelect,
                success: function (data) {
                    $('#' + campoSelect).html(data);
                    $('#' + campoSelect).css("display", "block");
                }
            });
        }
    });
    /* $('.filtraMaterialConsumoAjax').keyup(function(event) {
         if($(this).val().length >= 3) {
             var campoSelect = $(this).next().attr('id');
             var campoNome = $(this).attr('name');
             var campoId = $(this).prev().attr('name');

             $.ajax({
                 type: "get",
                 url: '/ajax/'+campoNome+'/filtro/' + $(this).val() + '/' + campoId + '/' + campoNome + '/' + campoSelect,
                 success: function (data) {
                     $('#' + campoSelect).html(data);
                     $('#' + campoSelect).css("display", "block");

                 }
             });
         }
     });*/
    $('.filtraNovoRamal').keyup(function(event) {
        if($(this).val().length >= 2) {
            var campoSelect = $(this).next().attr('id');
            var campoNome = $(this).attr('name');
            var campoId = $(this).prev().attr('name');

            $.ajax({
                type: "get",
                //    url: '/ajax/ramal/novo_ramal/' + $(this).val(),
                url: '/ajax/'+campoNome+'/novo_ramal/' + $(this).val() + '/' + campoId + '/' + campoNome + '/' + campoSelect,
                success: function (data) {
                    $('#' + campoSelect).html(data);
                    $('#' + campoSelect).css("display", "block");

                }
            });
        }
    });

    $('.preencheRange').change(function(event) {
        var str = $(this).val();
        var res = str.split(".");
        var range_inicial = res[0]+'.'+res[1]+'.'+res[2]+'.2';
        $('#reservado_inicial').val(range_inicial);
        var range_final = res[0]+'.'+res[1]+'.'+res[2]+'.50';
        $('#reservado_final').val(range_final);
        var gateway = res[0]+'.'+res[1]+'.'+res[2]+'.1';
        $('#gateway').val(gateway);
    });

    $('.atualizaRange').click(function(event) {
        var local_id = $('#local_id').val();
        var meu_ip = $('#meu_ip').val();
        // alert(str);
        $.ajax({
            type: "get",
            url: '/ajax/local_range/filtro/' + local_id + '/' + meu_ip,
            success: function (data) {
                $('#selectIpsLiberados').html(data);
                //$('#' + campoSelect).css("display", "block");
            }
        });
    });


    /* se quando mudar de campo setor for vazio limpar o id */
    $('.filtraNomeAjax').change(function(event) {
        if($(this).val() == ''){
            $(this).prev().val(null);
            //esconde campo select
            //$(this).next().css("display","none");
        }
    });
    $('.filtraNomePequenoAjax').change(function(event) {
        if($(this).val() == ''){
            $(this).prev().val(null);
        }
    });
    /* Mascaras */

    /* mascara de CEP */
    $('.maskCep').keyup(function(event) {
        //xxxxx-xxx
        //alert($(this).val().length);
        if($(this).val().length == 5){
            $(this).val($(this).val()+'-');
        }
    });

    /* mascara de telefone */
    $('.maskFone').keyup(function(event) {
        //(xx)xxxx-xxxx 13
        //(xx)xxxxx-xxxx 14
        if($(this).val().length == 2){
            $(this).val('('+$(this).val()+')');
        }

        if($(this).val().length == 8){
            $(this).val($(this).val()+'-');
        }
    });

    $('.maskFone').change(function(event) {
        if($(this).val().length == 14){
            fone = $(this).val().replace("-", "");
            // alert(fone.substring(0, 4));
            // alert(fone.substring(4, 5));
            // alert(fone.substring(5, 9));
            // alert(fone.substring(9, 13));
            novoFone = fone.substring(0, 4)+' '+fone.substring(4, 5)+' '+fone.substring(5, 9)+'-'+fone.substring(9, 13);
            $(this).val(novoFone);
        }
    });

    /* mascara de CPF */
    $('.maskCpf').keyup(function(event) {
        //xxx.xxx.xxx-xx
        if($(this).val().length == 3){
            $(this).val($(this).val()+'.');
        }

        if($(this).val().length == 7){
            $(this).val($(this).val()+'.');
        }

        if($(this).val().length == 11){
            $(this).val($(this).val()+'-');
        }
        $('#cpf').focus();
    });

    /* mascara de CNPJ */
    $('.maskCNPJ').keyup(function(event) {
        //xx.xxx.xxx/xxxx-xx
        //alert($(this).val().length);
        if($(this).val().length == 2){
            $(this).val($(this).val()+'.');
        }

        if($(this).val().length == 6){
            $(this).val($(this).val()+'.');
        }

        if($(this).val().length == 10){
            $(this).val($(this).val()+'/');
        }

        if($(this).val().length == 15){
            $(this).val($(this).val()+'-');
        }
    });

    /* mascara de Mac Address */
    $('.maskMac').keyup(function(event) {
        //xx:xx:xx:xx:xx:xx
        if($(this).val().length == 2){
            $(this).val($(this).val()+':');
        }

        if($(this).val().length == 5){
            $(this).val($(this).val()+':');
        }

        if($(this).val().length == 8){
            $(this).val($(this).val()+':');
        }
        if($(this).val().length == 11){
            $(this).val($(this).val()+':');
        }

        if($(this).val().length == 14){
            $(this).val($(this).val()+':');
        }

        $('#mac_address').focus();
    });

    /* alternar os campos de motivo e solução na triagem do chamado*/
    var chamadoStatus = $("#chamado_status").val();
    // alert(chamadoStatus);
    if(chamadoStatus == 'R'){
        $('.chamadoMotivo').css('display', 'block');
        $('.chamadoSolucao').css('display', 'none');
    }else if(chamadoStatus == 'F'){
        $('.chamadoMotivo').css('display', 'none');
        $('.chamadoSolucao').css('display', 'block');
    }else {
        $('.chamadoMotivo').css('display', 'none');
        $('.chamadoSolucao').css('display', 'none');
    }

    //ao alterar o campo  de status do chamado verifica quais campos vao ficar visiveis
    $('#chamado_status').change(function(event) {
        var chamadoStatus = $("#chamado_status").val();
        if(chamadoStatus == 'R'){
            $('.chamadoMotivo').css('display', 'block');
            $('.chamadoSolucao').css('display', 'none');
        }else if(chamadoStatus == 'F'){
            $('.chamadoMotivo').css('display', 'none');
            $('.chamadoSolucao').css('display', 'block');
        }else {
            $('.chamadoMotivo').css('display', 'none');
            $('.chamadoSolucao').css('display', 'none');
        }
    });


});
