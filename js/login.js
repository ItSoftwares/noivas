$("#form-login form").submit(function(e) {
    e.preventDefault();
    
    data = formToArray($(this).serializeArray());
    data.funcao = "login";
    
    $(this).find("button").attr("disabled", true);
    chamarPopupLoading("Aguarde enquanto criamos sua conta!");
    $.ajax({
        type: "post",
        url: "php/handler/usuarioHandler.php",
        data: data,
        success: function(result) {
            console.log(result);
            result = JSON.parse(result);
            
            if (result.estado==1) {
            	if (result.tipo_usuario=='adm') {
	                // redirecionar PIN
	                chamarPopupConf(result.mensagem);
	                setTimeout(function() {
	                	location.href = "adm/pin";
	                }, 3000);
	                
	                $("#form-login form")[0].reset();
	            } else if (result.tipo_usuario=='visitante') {
	            	// redirecionar Visitante
	                chamarPopupConf(result.mensagem);
	                setTimeout(function() {
	                	location.href = "visitante/stands-visitados";
	                }, 3000);
	                
	                $("#form-login form")[0].reset();
	            } 
            } else {
                chamarPopupInfo(result.mensagem);
                $("#form-login form").find("button").attr("disabled", false);
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