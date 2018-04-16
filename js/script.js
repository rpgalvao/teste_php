$(function() {
	$('nav.mobile').click(function() {
		var listaMenu = $('nav.mobile ul');
		if (listaMenu.is(':hidden') == true) {
			var icone = $('.botao-menu-mobile i');
			icone.removeClass('fa-bars');
			icone.addClass('fa-times');
			listaMenu.slideToggle();
		} else {
			var icone = $('.botao-menu-mobile i');
			icone.removeClass('fa-times');
			icone.addClass('fa-bars');
			listaMenu.slideToggle();
		}
	});

	if ($('target').length > 0) {
		var elemento = '#'+$('target').attr('target');
		var divScroll = $(elemento).offset().top;

		$('html, body').animate({'scrollTop':divScroll}, 1500);
	}

	carregarDinamico();

	function carregarDinamico(){
		$('[realtime]').click(function(){
			var pagina = $(this).attr('realtime');
			$('.main-container').hide();
			$('.main-container').load(include_path+'pages/'+pagina+'.php');

			setTimeout(function(){
				initialize();
				addMarker(-25.459289,-49.225680,'','@rpg Sistemas',false,true);
			}, 1000);

			$('.main-container').fadeIn(1000);
			window.history.pushState('', '', pagina);

			return false;
		});
	}
});