$("#nova").click(function() {
	promp("Registrar Visita", "ID do participante", function(valor) {
		// sim
		data = {};
	    data.funcao = "adicionarVisita";
	    data.id_usuario = valor;
	    data.id_expositor = usuario.id;

	    // console.log(data); return;

	    $(this).find("button").attr("disabled", true);
	    chamarPopupLoading("Aguarde...");
	    $.ajax({
	        type: "post",
	        url: "../php/handler/usuarioHandler.php",
	        data: data,
	        success: function(result) {
	            console.log(result);
	            result = JSON.parse(result);

	            if (result.estado == 1) {
	            	chamarPopupConf(result.mensagem);

	            	adicionarVisita(result.visita);
	            } else {
	                chamarPopupInfo(result.mensagem);
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
	}, function() {
		//nao
		
	})
});

function adicionarVisita(data) {
	temp = "";

	temp += "<tr>";
	temp += "<td>"+data.nome+"</td>";
	temp += "<td>"+(getData(data.time)+", "+getHora(data.time))+"</td>";
	temp += "<td class='centro'>"+data.id+"</td>";
	temp += "</tr>";

	$("#ultimos").prepend(temp);
}