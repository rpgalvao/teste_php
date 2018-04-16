$(function(){
	var open = true;
	var windowSize = $(window)[0].innerWidth;

	var tamanhoMenu = (windowSize <= 400) ? 200 : 300;

	if(windowSize <= 768){
		$('.menu').css('width','0');
		open = false;
	}

	$('.menu-btn i').click(function(){
		if(open){
			//O menu está aberto. Podemos fechar e adaptar o conteúdo
			$('.menu').animate({'width':'0'}, function(){
				open = false;
			});			
			$('header, .content').css('width','100%');
			$('header, .content').animate({'left':'0'}, function(){
				open = false;
			});
			$('.logout').css('display','block');
		}else{
			//Menu fechado
			$('.menu').css('display','block');
			$('.menu').animate({'width':tamanhoMenu+'px'}, function(){
				open = true;
			});			
			$('header, .content').css('width','calc(100% - 300px)');
			$('header, .content').animate({'left':tamanhoMenu+'px'}, function(){
				open = true;
			});
			$('.logout').css('display','none');
		}
	});

	$(window).resize(function(){
		windowSize = $(window)[0].innerWidth;
		tamanhoMenu = (windowSize <= 400) ? 200 : 300;
		if(windowSize <= 768){
			$('.menu').css('width','0');
			open = false;
		}else{
			$('.menu').animate({'width':tamanhoMenu+'px'}, function(){
				open = true;
			});
			$('header, .content').css('width','calc(100% - 300px)');
			$('header, .content').animate({'left':tamanhoMenu+'px'}, function(){
				open = true;
			});
		}
	});

	$('[formato=data]').mask('99/99/9999');

	$('[actionBtn=confirmar]').click(function(){

		var r = confirm("Deseja realmente apagar o registro?");
		if (r == true) {
			return true;
		} else {
			return false;
		}
	});
});