$(document).ready(function() {
	$.each(documentos, function(i, value) {
		disabled = "";

		if (value.extension!="png" && value.extension!="jpg" && value.extension!="jpeg" && value.extension!="gif" && value.extension!="pdf" && value.extension!="txt") disabled = "disabled";

		$("table tr[data-index="+i+"] .ver").addClass(disabled);
	});
});

$(document).on('click', '.baixar, .ver', function() {
	index = $(this).closest('tr').data("index");
	link = documentos[index]['dirname']+"\\"+documentos[index]['basename'];

	console.log(link);

	if ($(this).hasClass('ver')) $("#ver").attr('href', link)[0].click();
	if ($(this).hasClass('baixar')) $("#baixar").attr('href', link)[0].click();
});

$("#novo").click(function() {
	$("#novo-arquivo form")[0].reset();
	$("#novo-arquivo .input .upload .nome").text("Nenhum Arquivo");
	$("#novo-arquivo").fadeIn().css({display: 'flex'});
});

$("#novo-arquivo .fechar").click(function() {
	$("#novo-arquivo").fadeout();
});