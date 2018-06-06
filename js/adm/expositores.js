$("#novo").click(function() {
	$("#novo-expositor").fadeIn().css({display: 'flex'});
	$("#novo-expositor form [name=razao_social").focus();
});

$("#novo-expositor .fechar").click(function() {
	$("#novo-expositor").fadeOut();
	$("#novo-expositor form")[0].reset();
});