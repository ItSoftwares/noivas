$("#form-cadastro form").submit(function(e) {
    e.preventDefault();

    data = formToArray($(this).serializeArray());
    data.funcao = "cadastro";

    teste = verificarCampos();

    if (teste !== false) {
        teste.focus();
        return;
    }

    data.telefone = $("[name=telefone]").cleanVal();

    // console.log(data); return;

    $(this).find("button").attr("disabled", true);
    chamarPopupLoading("Aguarde enquanto criamos sua conta!");
    $.ajax({
        type: "post",
        url: "php/handler/usuarioHandler.php",
        data: data,
        success: function(result) {
            console.log(result);
            result = JSON.parse(result);

            if (result.estado == 1) {
            	chamarPopupConf("Cadastro realizado com sucesso, redirecionando...");
                setTimeout(function() {
                	location.href = "visitante/stands-visitados";
                }, 5000);

                $("#form-cadastro form")[0].reset();
            } else {
                chamarPopupInfo(result.mensagem);
                $("#form-cadastro form").find("button").attr("disabled", false);
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            chamarPopupErro("Desculpe, houve um erro, por favor atualize a página ou nos contate.");
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        },
        complete: function() {
            removerLoading();
        }
    });
});

function verificarCampos() {
    teste = false;
    $("#form-cadastro input").each(function(i, elem) {
        if ($(elem).val() == "") {
            teste = $(elem);
            return false;
        }

        repetirSenha = $("#form-cadastro #repetir-senha").val();

        if ($(elem).attr('name') == 'data_casamento' && $(elem).val().length < 10) {
            chamarPopupInfo("Preencha a data do casamento corretamente!");
            teste = $(elem);
            return false;
        } else if ($(elem).attr('name') == 'telefone' && $(elem).val().length < 14) {
            chamarPopupInfo("Preencha o telefone corretamente!");
            teste = $(elem);
            return false;
        } else if ($(elem).attr('name') == 'senha') {
            if ($(elem).val().length < 8) {
                chamarPopupInfo("A senha deve ter no mínimo 8 dígitos!");
                teste = $(elem);
                return false;
            } else if ($(elem).val() != $("#repetir-senha").val()) {
                chamarPopupInfo("Repita a senha corretamente!");
                teste = $(elem);
                return false;
            }

        }
    });

    if (teste === false) {
        $("#form-cadastro select").each(function(i, elem) {
            if ($(elem).val() == 0) {
                chamarPopupInfo("Esolha uma opção!");
                teste = $(elem);
                return false;
            }
        });
    }

    return teste;
}