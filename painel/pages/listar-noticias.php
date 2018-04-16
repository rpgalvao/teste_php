<?php
if(isset($_GET['excluir'])){
    $idExcluir = (int)$_GET['excluir'];
    $selectImage = Database::conectar()->prepare("SELECT capa FROM noticias WHERE id = ?");
    $selectImage->execute(array($_GET['excluir']));
    $imagem = $selectImage->fetch()['capa'];
    Painel::deleteFile($imagem);
    Painel::excluir('noticias',$idExcluir);
    Painel::redirect(BASE_PAINEL.'listar-noticias');
}elseif(isset($_GET['order']) && isset($_GET['id'])){
    Painel::orderItem('noticias',$_GET['order'],$_GET['id']);
}

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 4;
$noticias = Painel::selectAll('noticias',($paginaAtual-1)*$porPagina,$porPagina);
?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Notícias Cadastradas</h2>
    <div class="table-wraper">
        <table>
            <tr>
                <td>Título da Noticia</td>
                <td>Categoria</td>
                <td>Capa da Notícia</td>
                <td colspan="2">Ações</td>
                <td colspan="2">Ordenar</td>
            </tr>
            <?php foreach($noticias as $not):
                $nomeCategoria = Painel::select('categorias','id=?',array($not['categoria_id']))['titulo'];
            ?>
                <tr>
                    <td><?php echo $not['titulo'] ?></td>
                    <td><?php echo $nomeCategoria ?></td>
                    <td><img style="width: 50px;height: 30px;" src="<?php echo BASE_PAINEL ?>uploads/<?php echo $not['capa']; ?>" alt=""></td>
                    <td><a class="btn edit" href="<?php echo BASE_PAINEL ?>editar-noticia?id=<?php echo $not['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
                    <td><a actionBtn="confirmar" class="btn delete" href="<?php echo BASE_PAINEL ?>listar-noticias?excluir=<?php echo $not['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                    <td><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-noticias?order=up&id=<?php echo $not['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
                    <td><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-noticias?order=down&id=<?php echo $not['id']; ?>"><i class="fa fa-angle-down"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div><!--table-wraper-->

    <div class="paginacao">
        <?php
        $totalPagina = ceil(count(Painel::selectAll('noticias'))/$porPagina);
        for($i = 1; $i <= $totalPagina; $i++){
            if($i == $paginaAtual){
                echo '<a class="page-selected" href="'.BASE_PAINEL.'listar-noticias?pagina='.$i.'">'.$i.'</a>';
            }else{
                echo '<a href="'.BASE_PAINEL.'listar-noticias?pagina='.$i.'">'.$i.'</a>';
            }
        }
        ?>
    </div><!--paginacao-->
</div><!--box-content-->