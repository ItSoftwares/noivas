$("#toggle-menu").click(function() {
	$("body").toggleClass('fechado');

	if (!$('body').hasClass('fechado')) $("#menu-lateral ul li span").css('display', 'unset');
	else $("#menu-lateral ul li span").css('display', 'none');
});

$("#menu-lateral ul li").hover(function() {
	if (!$('body').hasClass('fechado')) return;
	$(this).find('span').show().css('display', 'table');
}, function() {
	if (!$('body').hasClass('fechado')) return;
	$(this).find('span').hide();
});

$("#perfil > i").click(function() {
	$("#perfil-menu").fadeToggle();
});