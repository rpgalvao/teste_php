$(function(){
	$('body').on('submit','form.ajax_form',function(){
		var form = $(this);
		$.ajax({
			beforeSend:function(){
				$('.sendMail').fadeIn();
			},
			url:include_path+'ajax/formulario.php',
			method:'POST',
			dataType:'json',
			data:form.serialize()
		}).done(function(data){
			if(data.sucesso){
				$('.sendMail').fadeOut();
				$('.mailSuccess').fadeIn();
				setTimeout(function(){
					$('.mailSuccess').fadeOut();
				}, 3000);
			} else{
				$('.sendMail').fadeOut();
				$('.mailError').fadeIn();
				setTimeout(function(){
					$('.mailError').fadeOut();
				}, 3000);
			}
		});

		return false;
	})
})