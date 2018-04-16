$(function(){
	var atual = -1;
	var maximo = $('.box-especialidade').lenght -1;
	var timer;

	runAnimate();

	function runAnimate(){
		$('.box-especialidade').hide();
		timer = setInterval(function(){
			atual++;
			if(atual > maximo){
				clearInterval(timer);
				return false;
			}
			$('.box-especialidade').eq(atual).fadeIn();
		}, 3000);
	}
});