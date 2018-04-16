<section class="banner-principal">
	<?php
		$sql = Database::conectar()->prepare("SELECT * FROM slides ORDER BY order_id ASC LIMIT 3");
		$sql->execute();
		$slides = $sql->fetchAll();
		foreach($slides as $slide):
	?>
		<div style="background-image: url('<?php echo BASE_PAINEL; ?>uploads/<?php echo $slide['slide']; ?>');" class="banner-single"></div><!--banner-single-->

	<?php endforeach; ?>
	<div class="overlay"></div>
	<div class="bullets"></div>
	<div class="center">
		<form class="ajax_form" method="POST">
			<h2>Qual o seu melhor e-mail?</h2>
			<input type="hidden" name="ident" value="form_home">
			<input type="email" name="email" required>
			<input type="submit" name="acao" value="Cadastrar!">
		</form>
	</div><!--center-->
</section><!--banner-principal-->

<section class="descricao-autor">
	<div id="sobre" class="center">
		<div class="w100 left">
			<h2 class="text-center"><img src="<?php echo BASE_URL; ?>images/Foto_prof.jpg"> <?php echo $dados_site['autor']; ?></h2>
			<p><?php echo $dados_site['descricao_autor']; ?></p>
		</div><!--w100-->
		<div class="clear"></div>
	</div><!--center-->
</section><!--descricao-autor-->

<section class="especialidades">
	<div class="center">
		<h2 class="title">Minhas Especialidades</h2>
		<div class="w33 left box-especialidade">
			<h3><i class="<?php echo $dados_site['icone1']; ?>" aria-hidden="true"></i></h3>
			<h4><?php echo $dados_site['titulo_icone1']; ?></h4>
			<p><?php echo $dados_site['desc_icone1']; ?></p>
		</div><!--box-especialidade-->
		<div class="w33 left box-especialidade">
			<h3><i class="<?php echo $dados_site['icone2']; ?>" aria-hidden="true"></i></h3>
			<h4><?php echo $dados_site['titulo_icone2']; ?></h4>
			<p><?php echo $dados_site['desc_icone2']; ?></p>
		</div><!--box-especialidade-->
		<div class="w33 left box-especialidade">
			<h3><i class="<?php echo $dados_site['icone3']; ?>" aria-hidden="true"></i></h3>
			<h4><?php echo $dados_site['titulo_icone3']; ?></h4>
			<p><?php echo $dados_site['desc_icone3']; ?></p>
		</div><!--box-especialidade-->
		<div class="clear"></div>
	</div><!--center-->		
</section>

<section class="extras">
	<div class="center">
		<div class="w50 left depoimentos-container">
			<h2 class="title">Depoimentos dos nossos clientes</h2>
			<?php
				$sql = Database::conectar()->prepare("SELECT * FROM depoimentos ORDER BY order_id ASC LIMIT 3");
				$sql->execute();
				$depoimentos = $sql->fetchAll();
				foreach($depoimentos as $dep):
			?>
			<div class="depoimento-single">
				<p class="depoimento-descricao"><?php echo $dep['depoimento']; ?></p>
				<p class="nome-autor"><?php echo $dep['nome']; ?> - <?php echo $dep['data']; ?></p>
			</div><!--depoimento-single-->
			<?php endforeach; ?>
		</div><!--w50-->
		<div id="servicos" class="w50 left servicos-container">
			<h2 class="title">Serviços</h2>
			<div class="servicos">
				<ul>
					<?php
						$sql = Database::conectar()->prepare("SELECT * FROM servicos ORDER BY order_id ASC LIMIT 5");
						$sql->execute();
						$servicos = $sql->fetchAll();
						foreach($servicos as $servico):
					?>
					<li><?php echo $servico['servico']; ?></li>
					<?php endforeach; ?>
				</ul>
		</div><!--servicos-->
		</div><!--w50-->
		<div class="clear"></div>
	</div><!--center-->
</section><!--extras-->