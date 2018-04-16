<?php
	$url = explode('/',$_GET['url']);
	$checkCat = Database::conectar()->prepare("SELECT * FROM categorias WHERE slug = ?");
	$checkCat->execute(array($url[1]));
	if($checkCat->rowCount() == 0){
		Painel::redirect(BASE_PAINEL.'noticias');
	}
	$catInfo = $checkCat->fetch();

	$noticia = Database::conectar()->prepare("SELECT * FROM noticias WHERE slug = ? AND categoria_id = ?");
	$noticia->execute(array($url[2],$catInfo['id']));
	if($noticia->rowCount() == 0){
		Painel::redirect(BASE_URL.'noticias');
	}
	// SE CHEGOU AQUI É PORQUE TEM NOTÍCIA. BASTA INCLUÍ-LA NA PÁGINA
	$noticia = $noticia->fetch();
?>
<section class="noticia-single">
	<div class="center">
		<header>
			<h1><i class="fa fa-calendar"></i> <small><?php echo $noticia['data']; ?></small> - <?php echo $noticia['titulo']; ?></h1>
		</header>
		<article>
			<?php echo $noticia['conteudo']; ?>
		</article>
	</div><!--center-->
</section><!--noticia-single-->