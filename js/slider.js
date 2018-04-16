$(function(){

	var curSlide = 0;
	var maxSlide = $('.banner-single').length - 1;

	initSlider();
	changeSlide();

	function initSlider(){
		$('.banner-single').hide();
		$('.banner-single').eq(0).show();
		for(var i = 0; i < maxSlide+1; i++){
			var conteudo = $('.bullets').html();
			if(i == 0){
				conteudo += '<span class="active-bullet"></span>';
			} else{
				conteudo += '<span></span>';
			}
			
			$('.bullets').html(conteudo);
		}
	}

	function changeSlide(){
		setInterval(function(){
			$('.banner-single').eq(curSlide).stop().fadeOut(1500);
			curSlide++;
			if (curSlide > maxSlide)
				curSlide = 0;
			$('.banner-single').eq(curSlide).stop().fadeIn(1500);
			$('.bullets span').removeClass();
			$('.bullets span').eq(curSlide).addClass('active-bullet');
		}, 5000);
	}

	$('body').on('click','.bullets span',function(){
		var bulletAtual = $(this);
		$('.banner-single').eq(curSlide).stop().fadeOut(1500);
		curSlide = bulletAtual.index();
		$('.banner-single').eq(curSlide).stop().fadeIn(1500);
		$('.bullets span').removeClass();
		bulletAtual.addClass('active-bullet');
	});
});