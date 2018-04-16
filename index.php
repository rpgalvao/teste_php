<?php include 'config.php'; ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php
	$dados_site = Database::conectar()->prepare("SELECT * FROM website");
	$dados_site->execute();
	$dados_site = $dados_site->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title><?php echo $dados_site['titulo']; ?></title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>estilo/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>estilo/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="palavras-chave,do,meu,site">
		<meta name="description" content="Descrição do meu website">
		<link rel="icon" href="<?php echo BASE_URL; ?>favicon.ico" type="image/x-icon">
		<meta charset="utf-8">
	</head>
	<body>
	<base base="<?php echo BASE_URL; ?>" />
		<?php  
			$url = isset($_GET['url']) ? $_GET['url'] : 'home';
			switch ($url) {
				case 'sobre':
					echo '<target target="sobre" />';
					break;
				
				case 'servicos':
					echo '<target target="servicos" />';
					break;
			}
		?>
		<div class="sendMail">
			<img src="images/ajax-loader.gif">
		</div><!--sendMail-->
		<div class="mailSuccess">
			<p><b><i class="fa fa-check"></i></b> E-mail enviado com sucesso!</p>
		</div><!--mailSuccess-->
		<div class="mailError">
			<p><b><i class="fa fa-times"></i></b> Não foi possível enviar o seu e-mail!</p>
		</div><!--mailError-->
		<header>
			<div class="center">
				<div class="logo left"><a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>images/logo_nova.png"></a></div><!--logo-->
				<nav class="desktop right">
					<ul>
						<li><a href="<?php echo BASE_URL; ?>">Home</a></li>
						<li><a href="<?php echo BASE_URL; ?>sobre">Sobre</a></li>
						<li><a href="<?php echo BASE_URL; ?>servicos">Serviços</a></li>
						<li><a href="<?php echo BASE_URL; ?>noticias">Notícias</a></li>
						<li><a realtime="contato" href="<?php echo BASE_URL; ?>contato">Contato</a></li>
					</ul>
				</nav>
				<nav class="mobile right">
					<div class="botao-menu-mobile">
						<i class="fa fa-bars" aria-hidden="true"></i>
					</div>
					<ul>
						<li><a href="<?php echo BASE_URL; ?>">Home</a></li>
						<li><a href="<?php echo BASE_URL; ?>sobre">Sobre</a></li>
						<li><a href="<?php echo BASE_URL; ?>servicos">Serviços</a></li>
						<li><a href="<?php echo BASE_URL; ?>noticias">Notícias</a></li>
						<li><a realtime="contato" href="<?php echo BASE_URL; ?>contato">Contato</a></li>
					</ul>
				</nav>
				<div class="clear"></div>
			</div><!--center-->
		</header>

		<div class="main-container">
			<?php 

				if (file_exists('pages/'.$url.'.php')) {
					include 'pages/'.$url.'.php';
				} else {
					if ($url != 'sobre' && $url != 'servicos') {
						$urlPar = explode('/',$url)[0];
						if ($urlPar != 'noticias'){
							$pagina404 = true;
							include 'pages/404.php';
						} else {
							include 'pages/noticias.php';
						}
					} else {
						include 'pages/home.php';
					}
					
				}
			?>
		</div><!--main-container-->

		<footer <?php if (isset($pagina404) && $pagina404 == true) {echo 'class="fixed"';} ?>>
			<div class="center">
				<p>&copy;2017 - @rpg Sistemas - Todos os direitos reservados</p>
			</div><!--center-->
		</footer>

		<script src="<?php echo BASE_URL; ?>js/jquery.js"></script>
		<script src="<?php echo BASE_URL; ?>js/constants.js"></script>
		<script src="<?php echo BASE_URL; ?>js/map.js"></script>
		<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4'></script>
		<script src="<?php echo BASE_URL; ?>js/script.js"></script>
		<?php if ($url == 'home' || $url == ''): ?>
			<script src="<?php echo BASE_URL; ?>js/slider.js"></script>
		<?php endif; ?>
		<!--<script src="<?php echo BASE_URL; ?>js/animate.js"></script>-->
		<script src="<?php echo BASE_URL; ?>js/formularios.js"></script>
		<?php if(is_array($url) && strstr($url[0],'noticias') !== false): ?>
		<script>
			$(function(){
				$('select').change(function(){
					location.href = include_path+"noticias/"+$(this).val();
				});
			});
		</script>
		<?php endif; ?>
	</body>
</html>