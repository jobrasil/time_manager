jQuery().ready(function() {

    //Datas do formulário de importacao
    jQuery("#data_inicial").mask('99/99/9999');
    jQuery("#data_final").mask('99/99/9999');

    //Datas do formulario de relatorio
    jQuery("#Relatorio_data_inicial").mask('99/99/9999');
    jQuery("#Relatorio_data_final").mask('99/99/9999');

    jQuery('#btnUploadImportacao').click(function() {
        jQuery('#Importacao').find('input:file').trigger('click');
    });

    jQuery("#Importacao_importacao_empresa").change(function() {

        $("#Importacao_importacao_modelo option[value='recebimento']").remove();
        $("#Importacao_importacao_modelo option[value='tributo']").remove();

        if ($(this).val() != 941) {
            $("#Importacao_importacao_modelo").append(new Option("Recebimento", "recebimento"));
            $("#Importacao_importacao_modelo").append(new Option("Tributos", "tributo"));
        }

    });

    //acao do change do campo file
    jQuery('#arquivo').on('change', function() {
        if (jQuery(this).val() == '') {
            return false;
        }

        var re = /(?:\.([^.]+))?$/;
        var path = jQuery(this).val();
        var fileName = path.match(/[^\/\\]+$/);
        var ext = re.exec(fileName)[1];
        if (ext != "xls" && ext != "xlsx") {
            $.jGrowl("Tipo de Arquivo Não Suportado!", {theme: 'growl-error', header: 'Erro Tipo de Arquivo!', 'life': 4000});
            jQuery('#arquivo').val("")
            return false;
        }

        jQuery('#inputTextFile').val(fileName);
    });

    //Importa Planilha
    jQuery("#btnImportaArquivo").click(function() {
        var form_id = $(this).parent().parent().parent().parent().attr('id');

        if (!validaCampos(form_id))
            return false;

        jQuery("#modalProgress").modal("show");
        jQuery('#Importacao').ajaxForm({
            success: function(data) {
                if (data.resultado == "Erro") {
                    jQuery("#modalProgress").modal("toggle");
                    jQuery.growl.error({message: "Erro," + data.resultado});
                } else {
                    if (data.resultado == "OK") {
                        jQuery("#modalProgress").modal("toggle");
//                        setInterval(function() {
//                            location.reload()
//                        }, 2000);
                        location.reload()
                        jQuery.growl.success({message: "Arquivo Importado com Sucesso!"});
                    }
                }
                return false;
            },
            type: 'post',
            dataType: 'json',
            url: '/sconfin/gerenciar/importacoes/importaarquivo',
            resetForm: true,
            cache: false,
        }).submit();
    })


    //Gerar Relatório
    jQuery("#btnGeraRelatorio").click(function() {
        var form_id = $(this).parent().parent().parent().parent().attr('id');

        if (!validaCampos(form_id))
            return false;

        jQuery.ajax({
            'url': '/sconfin/gerenciar/importacoes/relatoriofaturamento',
            'data': jQuery("#Relatorio").serialize(),
            'dataType': 'json',
            'type': 'post',
            'success': function(data) {
                if (data.resultado == "Erro") {
                    jQuery.growl.error({message: 'Erro!!! ' + data.detalhes});
                } else {
                    if (data.resultado == "OK") {
                        jQuery("#modalRelatorio").modal("show");
                    }
                }
            },
            'cache': false
            , });
    })



});


function validaCampos(form)
{
    var empresa = jQuery("#Importacao_importacao_empresa").val();
    var modelo_arquivo = jQuery("#Importacao_importacao_modelo").val();

    var dt_inicial;
    var dt_final;

    if (form == 'Importacao') {
        
        var dt_inicial = jQuery("#data_inicial").val();
        var dt_final = jQuery("#data_final").val();
        
        //Validações
        if (empresa.length == 0 || empresa == "") {
            jQuery.growl.error({message: "Campo empresa obrigatório!"});
            return false;
        } else if (dt_inicial.length == 0 || dt_inicial == "") {
            jQuery.growl.error({message: "Campo Período Inicial obrigatório!"});
            return false;
        } else if (dt_final.length == 0 || dt_final == "") {
            jQuery.growl.error({message: "Campo Período Final obrigatório!"});
            return false;
        } else if (!validaData(dt_inicial)) {
            jQuery.growl.error({message: "Data Inicial Inválida!"});
            return false;
        } else if (!validaData(dt_final)) {
            jQuery.growl.error({message: "Data Final Inválida!"});
            return false;
        } else if (!(validaIntervaloData(dt_inicial, dt_final))) {
            jQuery.growl.error({message: "Intervalo de datas Inválido!"});
            return false;
        }

        return true;
    } else if (form == 'Relatorio') {
        
        var dt_inicial = jQuery("#Relatorio_data_inicial").val();
        var dt_final = jQuery("#Relatorio_data_final").val();
        
        //Validações
        if (dt_inicial.length == 0 || dt_inicial == "") {
            jQuery.growl.error({message: "Campo Período Inicial obrigatório!"});
            return false;
        } else if (dt_final.length == 0 || dt_final == "") {
            jQuery.growl.error({message: "Campo Período Final obrigatório!"});
            return false;
        } else if (!validaData(dt_inicial)) {
            jQuery.growl.error({message: "Data Inicial Inválida!"});
            return false;
        } else if (!validaData(dt_final)) {
            jQuery.growl.error({message: "Data Final Inválida!"});
            return false;
        } else if (!(validaIntervaloData(dt_inicial, dt_final))) {
            jQuery.growl.error({message: "Intervalo de datas Inválido!"});
            return false;
        }
        
        return true;
        
    } else {
        return false;
    }

}