var pin;
 
$("#pin input").keyup(function() {
    if ($(this).parent().attr("id")=="pin_4") {
        pin = "";
 
        $("#pin input").each(function(i, value) {
            pin += $(this).val();
        });
 
        if (codigoEntrada!="1111") {
            if (pin==codigoEntrada) {
                chamarPopupConf("PIN Correto, redirecionando...");
                $('#div_session_write').load('escreverSessao.php?pin=valido');
 
                setTimeout(function() {
                    location.href = "expositores";
                }, 3000)
 
            } else {
                resetarFormPin("PIN incorreto!");
            }
        } else {
            definirPin();
        }
    } else {
        // console.log($(this).next())
        if ($(this).val().length==1) {
            $(this).parent().next().find("input").focus();
        } else if ($(this).val().length>1) {
            resetarFormPin("Digite um PIN válido!");
        }
    }
});
 
function definirPin() {
    if (pin.length!=4 || typeof Number(pin) != "number") {
        resetarFormPin("PIN inválido!");
        return;
    }
 
    $("#pin button, #pin input").attr("disabled", true);
    $.ajax({
        type: "post",
        url: "../php/handler/usuarioHandler.php",
        data: {pin: pin, funcao: "atualizarPin", id: usuario.id},
        success: function(result) {
            result = JSON.parse(result);
            console.log(result);
             
            if (result.estado==1) {
                chamarPopupConf(result.mensagem);
 
                setTimeout(function() {
                    location.href = "expositores";
                }, 3000)
 
                $("#pin button, #pin input").attr("disabled", false);
            } else {
                chamarPopupInfo(result.mensagem);
                $("#pin button, #pin input").attr("disabled", false);
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
}
 
$("#redefinir").click(function() {
    $("#definir-pin").show()
    $("#pin").fadeIn().find("h1").html("Defina um PIN de acesso <br>Somente números");
    codigoEntrada = "aaaa";
});
 
function resetarFormPin(mensagem) {
    $("#pin input").val("");
    chamarPopupInfo(mensagem);
    $("#pin_1 input").focus();
}