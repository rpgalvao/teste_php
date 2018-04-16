<?php
	
	session_start();
	date_default_timezone_set("America/Sao_Paulo");
	$autoload = function($class){
		if ($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('BASE_URL', 'http://localhost/danki/dev_web/Projeto_01/');
	define('BASE_PAINEL', 'http://localhost/danki/dev_web/Projeto_01/painel/');
	define('BASE_DIR_PANEL', __DIR__.'/painel');
	
	//Constantes da conexão com o banco de dados
	define('HOST','localhost');
	define('DATABASE','projeto_01');
	define('USER','root');
	define('PASS','root');

	function recoverPost($post){
		if(isset($_POST[$post])){
			echo $_POST[$post];
		}
	}