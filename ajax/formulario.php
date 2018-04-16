<?php 

	include('../config.php');

	$data = array();
	if ($_POST['ident'] == 'form_home'){
		$assunto = "Novo e-mail cadastrado para newsletter!";
	} elseif ($_POST['ident'] == 'form_contato'){
		$assunto = "Novo contato do site";
	}
	
	$corpo = '';
	foreach ($_POST as $key => $value) {
		$corpo .= $key.' : '.$value;
		$corpo .= '<hr/>';
	}
	$info = array('assunto'=>$assunto,'corpo'=>$corpo);
	$mail = new Email('br610.hostgator.com.br','teste@rpg.not.br','curso123456','@rpg Sistemas');
	$mail->addAdress('renato@rpg.not.br','Renato');
	$mail->formatarEmail($info);
	if ($mail->enviarEmail()){
		$data['sucesso'] = true;
	} else{
		$data['erro'] = true;
	}

	die(json_encode($data));

?>