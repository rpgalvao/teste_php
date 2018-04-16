<?php
    $url = explode('/',$_GET['url']);
    if(!isset($url[2])):
        $categoria = Database::conectar()->prepare("SELECT * FROM categorias WHERE slug = ?");
        $categoria->execute(@array($url[1]));
        $categoria = $categoria->fetch();
?>

<section class="news-header">
    <div class="center">
        <h2><i class="fa fa-newspaper-o" aria-hidden="true"></i></h2>
        <h2>Leia aqui as últimas <b>notícias do portal</b></h2>
    </div><!--center-->
</section><!--news-header-->

<section class="news-content">
    <div class="center">
        <div class="sidebar">
            <div class="box-content-sidebar">
                <h3><i class="fa fa-search"></i> Realizar uma busca:</h3>
                <form method="post">
                    <input type="text" name="busca" placeholder="O que você deseja procurar?" required>
                    <input type="submit" name="acao" value="Pesquisar!">
                </form>
            </div><!--box-content-sidebar-->
            <div class="box-content-sidebar">
                <h3><i class="fa fa-list-ul"></i> Selecione a categoria:</h3>
                <form>
                    <select name="categoria">
                        <option value="" selected>Todas as categorias</option>
                        <?php
                            $categorias = Database::conectar()->prepare("SELECT * FROM categorias");
                            $categorias->execute();
                            $categorias = $categorias->fetchAll();
                            foreach ($categorias as $cat):
                        ?>
                        <option <?php if($cat['slug'] == @$url[1]) echo 'selected'; ?> value="<?php echo $cat['slug']; ?>"><?php echo $cat['titulo']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div><!--box-content-sidebar-->
            <div class="box-content-sidebar">
                <h3><i class="fa fa-user"></i> Sobre o autor:</h3>
                <div class="autor-box-portal">
                    <?php
                        $infoSite = Database::conectar()->prepare("SELECT * FROM website");
                        $infoSite->execute();
                        $infoSite = $infoSite->fetch();
                    ?>
                    <div class="portal-img-autor"></div>
                    <div class="texto-autor-portal text-center">
                        <h3><?php echo $infoSite['autor']; ?></h3>
                        <p><?php echo substr($infoSite['descricao_autor'],0,500); ?><a href="<?php BASE_URL; ?>home"> ... Leia mais</a></p>
                    </div>
                </div>
            </div><!--box-content-sidebar-->
        </div><!--sidebar-->

        <div class="main-content">
            <div class="header-main-content">
                <?php
                $porPg = 5;
                if(!isset($_POST['busca'])) {
                    if ($categoria['titulo'] == '') {
                        echo "<h2>Visualizando todas as notícias</h2>";
                    } else {
                        echo "<h2>Visualizando notícias de <span>" . $categoria['titulo'] . "</span></h2>";
                    }
                }else{
                    echo '<h2><i class="fa fa-check"></i> Exibindo resultados da sua busca!</h2>';
                }
                $query = "SELECT * FROM noticias";
                if($categoria['titulo'] != ''){
                    $query .= " WHERE categoria_id = $categoria[id]";
                }
                if(isset($_POST['busca'])){
                    if(strstr($query,'WHERE')){
                        $busca = $_POST['busca'];
                        $query .= " AND titulo LIKE '%$busca%'";
                    }else{
                        $busca = $_POST['busca'];
                        $query .= " WHERE titulo LIKE '%$busca%'";
                    }
                }
                $query2 = "SELECT * FROM noticias";
                if($categoria['titulo'] != ''){
                    $query2 .= " WHERE categoria_id = $categoria[id]";
                }
                if(isset($_POST['busca'])){
                    if(strstr($query2,'WHERE')){
                        $busca = $_POST['busca'];
                        $query2 .= " AND titulo LIKE '%$busca%'";
                    }else{
                        $busca = $_POST['busca'];
                        $query2 .= " WHERE titulo LIKE '%$busca%'";
                    }
                }
                $totalPaginas = Database::conectar()->prepare($query2);
                $totalPaginas->execute();
                $totalPaginas = ceil($totalPaginas->rowCount() / $porPg);
                if(!isset($_POST['busca'])) {
                    if (isset($_GET['pagina'])) {
                        $pagina = (int)$_GET['pagina'];
                        if ($pagina > $totalPaginas) {
                            $pagina = 1;
                        }
                        $queryPg = ($pagina - 1) * $porPg;
                        $query .= " ORDER BY order_id ASC LIMIT $queryPg,$porPg";
                    } else {
                        $pagina = 1;
                        $query .= " ORDER BY order_id ASC LIMIT $porPg";
                    }
                }else{
                    $query .= " ORDER BY order_id ASC";
                }
                $sql = Database::conectar()->prepare($query);
                $sql->execute();
                $noticias = $sql->fetchAll();
                ?>
            </div><!--header-main-content-->
            <?php foreach($noticias as $not):
                $slug = Database::conectar()->prepare("SELECT slug FROM categorias WHERE id = ?");
                $slug->execute(array($not['categoria_id']));
                $slug = $slug->fetch()['slug'];
                ?>
            <div class="noticias">
                <h2><?php echo date('d/m/Y',strtotime($not['data'])); ?> - <?php echo $not['titulo']; ?></h2>
                <p><?php echo substr(strip_tags($not['conteudo']),0,300); ?> ...</p>
                <a href="<?php BASE_URL; ?>noticias/<?php echo $slug;?>/<?php echo $not['slug']; ?>">Leia mais</a>
            </div><!--noticias-->
            <?php endforeach; ?>
            <div class="paginacao">
                <?php
                    if(!isset($_POST['busca'])) {
                        for ($i = 1; $i <= $totalPaginas; $i++) {
                            $catStr = ($categoria['titulo'] != '') ? '/' . $categoria['slug'] : '';
                            if ($pagina == $i) {
                                echo '<a class="active-page" href="' . BASE_URL . 'noticias' . $catStr . '?pagina=' . $i . '">' . $i . '</a>';
                            } else {
                                echo '<a href="' . BASE_URL . 'noticias' . $catStr . '?pagina=' . $i . '">' . $i . '</a>';
                            }
                        }
                    }
                ?>
            </div><!--paginacao-->
        </div><!--main-content-->
        <div class="clear"></div>
    </div><!--center-->
</section><!--news-content-->
<?php else:
      include 'noticia-single.php';
      endif;
?>