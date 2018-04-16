<?php 
    if(isset($_GET['logout'])){
        Painel::logout();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Painel de Controle</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>estilo/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_PAINEL; ?>css/style.css">
    </head>
    <body>
        <div class="menu">
            <div class="box-user">
                <?php if($_SESSION['imagem'] == ''): ?>
                    <div class="avatar-user">
                        <i class="fa fa-user"></i>
                    </div><!--avatar-user-->
                <?php else: ?>
                    <div class="img-user">
                        <img src="<?php echo BASE_PAINEL; ?>/uploads/<?php echo $_SESSION['imagem']; ?>">
                    </div>
                <?php endif; ?>
                <div class="nome-user">
                    <p><?php echo $_SESSION['nome']; ?></p>
                    <p><?php echo Painel::pegaCargo($_SESSION['cargo']) ?></p>
                </div><!--nome-user-->
            </div><!--box-user-->
            <div class="menu-lista">
                <h2>Cadastro</h2>
                <a <?php Painel::activeMenu('cadastrar-depoimento'); ?> href="<?php echo BASE_PAINEL; ?>cadastrar-depoimento">Cadastrar Depoimento</a>
                <a <?php Painel::activeMenu('cadastrar-servico'); ?> href="<?php echo BASE_PAINEL; ?>cadastrar-servico">Cadastrar Serviço</a>
                <a <?php Painel::activeMenu('cadastrar-slide'); ?> href="<?php echo BASE_PAINEL;?>cadastrar-slide">Cadastrar Slide</a>
                <h2>Gestão</h2>
                <a <?php Painel::activeMenu('listar-depoimentos'); ?> href="<?php echo BASE_PAINEL; ?>listar-depoimentos">Listar Depoimentos</a>
                <a <?php Painel::activeMenu('listar-servicos'); ?> href="<?php echo BASE_PAINEL; ?>listar-servicos">Listar Serviços</a>
                <a <?php Painel::activeMenu('listar-slides'); ?> href="<?php echo BASE_PAINEL; ?>listar-slides">Listar Slides</a>
                <h2>Administração do Painel</h2>
                <a <?php Painel::activeMenu('editar-usuarios'); ?> href="<?php echo BASE_PAINEL; ?>editar-usuarios">Editar Usuários</a>
                <a <?php Painel::activeMenu('cadastrar-usuarios'); Painel::permissaoMenu(2); ?> href="<?php echo BASE_PAINEL; ?>cadastrar-usuarios">Cadastrar Usuários</a>
                <h2>Configuração Geral</h2>
                <a <?php Painel::activeMenu('editar-site'); ?> href="<?php echo BASE_PAINEL; ?>editar-site">Editar Site</a>
                <h2>Cadastro - Notícias</h2>
                <a <?php Painel::activeMenu('cadastrar-categoria'); ?> href="<?php echo BASE_PAINEL; ?>cadastrar-categoria">Cadastrar Categoria</a>
                <a <?php Painel::activeMenu('cadastrar-noticia'); ?> href="<?php echo BASE_PAINEL; ?>cadastrar-noticia">Cadastrar Notícia</a>
                <h2>Gestão - Notícias</h2>
                <a <?php Painel::activeMenu('listar-categorias'); ?> href="<?php echo BASE_PAINEL; ?>listar-categorias">Listar Categorias</a>
                <a <?php Painel::activeMenu('listar-noticias'); ?> href="<?php echo BASE_PAINEL; ?>listar-noticias">Listar Noticias</a>
            </div><!--menu-lista-->
        </div><!--menu-->

        <header>
            <div class="container">
                <div class="menu-btn">
                    <i class="fa fa-bars"></i>
                </div><!--menu-btn-->
                <div class="logout">
                    <a <?php if(@$_GET['url'] == ''): ?> style="background-color: #657177; padding: 10px;" <?php endif; ?> title="Home" href="<?php echo BASE_PAINEL; ?>"><i class="fa fa-home"></i><span>Página Inicial</span></a>
                    <a title="Sair" href="<?php echo BASE_PAINEL; ?>?logout"><i class="fa fa-window-close"></i><span>Sair</span></a>
                </div><!--logout-->
                <div class="clear"></div>
            </div><!--container-->
        </header>

        <div class="content">

            <?php Painel::carregarPagina(); ?>

        </div><!--content-->

        <script src="<?php echo BASE_URL; ?>js/jquery.js"></script>
        <script src="<?php echo BASE_PAINEL; ?>js/jquery.mask.js"></script>
        <script src="<?php echo BASE_PAINEL; ?>js/functions.js"></script>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector:'.tinymce',
                plugins:'image',
                height:300
            });
        </script>
    </body>
</html>