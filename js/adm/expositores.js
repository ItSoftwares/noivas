var funcao = "cadastro";
var exp;

$(document).ready(function() {
	temp = {};
	$.each(expositores, function(i, value) {
		temp[value.id] = value;
	});
	expositores = temp;
});

$("#novo").click(function() {
	$("#novo-expositor").fadeIn().css({display: 'flex'});
	$("#novo-expositor h3").text('Novo Expositor');
	$("#novo-expositor form [name=razao_social").focus();
	funcao = "cadastro";
});

$(document).on('click', 'i.editar', function() {
	exp = expositores[$(this).closest('tr').data('id')];

	$.each(exp, function(i, value) {
		$("#novo-expositor [name="+i+"]").val(value).trigger('input');
	});

	$("#novo-expositor").fadeIn().css({display: 'flex'});
	$("#novo-expositor h3").text('Atualizar Dados do Expositor');
	// $("#novo-expositor button").text('Atualizar');
	$("#novo-expositor form [name=razao_social").focus().select();
	funcao = "atualizar";
})

$(document).on('click', 'i.arquivos', function() {
	id = $(this).closest('tr').data('id');

	location.href = "documentos?expositor="+id;
});


$("#novo-expositor .fechar").click(function() {
	$("#novo-expositor").fadeOut();
	$("#novo-expositor form")[0].reset();
});

$("#novo-expositor form").submit(function(e) {
    e.preventDefault();

    data = formToArray($(this).serializeArray());
    data.funcao = funcao;
    data.tipoUsuario = "expositor";

    if (funcao=='atualizar') {
    	data.id = exp.id;
    }

    teste = verificarCampos();

    if (teste !== false) {
        teste.focus();
        return;
    }

    data.cnpj = $("[name=cnpj]").cleanVal();
    data.cep = $("[name=cep]").cleanVal();
    data.telefone = $("[name=telefone]").cleanVal();

    // console.log(data); return;

    $(this).find("button").attr("disabled", true);
    chamarPopupLoading("Aguarde enquanto a conta é criada!");
    $.ajax({
        type: "post",
        url: "../php/handler/usuarioHandler.php",
        data: data,
        success: function(result) {
            console.log(result);
            result = JSON.parse(result);

            if (result.estado == 1) {
            	chamarPopupConf(result.mensagem);

            	if (funcao=='cadastro') adicionarExpositor(result.usuario);
            	else if (funcao=='atualizar') atualizarExpositor(result.atualizado);

                $("#novo-expositor .fechar").click();
            } else {
                chamarPopupInfo(result.mensagem);
                $("#novo-expositor form").find("button").attr("disabled", false);
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
    $("#novo-expositor input").each(function(i, elem) {
        if ($(elem).val() == "") {
            teste = $(elem);
            return false;
        }

        if ($(elem).attr('name') == 'telefone' && $(elem).val().length < 14) {
            chamarPopupInfo("Preencha o telefone corretamente!");
            teste = $(elem);
            return false;
        } else if ($(elem).attr('name') == 'senha' && $(elem).val().length < 8) {
            chamarPopupInfo("A senha deve ter no mínimo 8 dígitos!");
            teste = $(elem);
            return false;
        }
    });

    return teste;
}

function adicionarExpositor(data) {
	temp = "";

	temp += "<tr data-id="+data.id+">";
	temp += "<td>"+data.id+"</td>";
	temp += "<td>"+data.nome_fantasia+"</td>";
	temp += "<td>"+data.cnpj+"</td>";
	temp += "<td>"+data.telefone+"</td>";
	temp += "<td class='centro'>";
	temp += "<i class='fa fa-file-alt arquivos botao verde icon' title='Arquivos'></i>";
	temp += "<i class='fa fa-edit editar botao amarelo icon' title='Editar'></i>";
	temp += "<i class='fa fa-trash excluir botao vermelho icon' title='Excluir'></i>";
	temp += "</td>";
	temp += "</tr>";

	$("#expositores table").preppend(temp);

	expositores[data.id] = data;
}

function atualizarExpositor(data) {
	expositores[data.id] = data;

	$("#expositores table tr[data-id="+data.id+"] .nome_fantasia").text(data.nome_fantasia);
	$("#expositores table tr[data-id="+data.id+"] .cnpj").text(data.cnpj).trigger('input');
	$("#expositores table tr[data-id="+data.id+"] .telefone").text(data.telefone).trigger('input');
}