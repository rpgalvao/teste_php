<?php
if(isset($_GET['excluir'])){
    $idExcluir = (int)$_GET['excluir'];
    Painel::excluir('categorias',$idExcluir);
    $noticias = Database::conectar()->prepare("SELECT * FROM noticias WHERE categoria_id = ?");
    $noticias->execute(array($idExcluir));
    $noticias = $noticias->fetchAll();
    foreach($noticias as $not){
        $imgDelete = $not['capa'];
        Painel::deleteFile($imgDelete);
    }
    $noticias = Database::conectar()->prepare("DELETE FROM noticias WHERE categoria_id = ?");
    $noticias->execute(array($idExcluir));
    Painel::redirect(BASE_PAINEL.'listar-categorias');
}elseif(isset($_GET['order']) && isset($_GET['id'])){
    Painel::orderItem('categorias',$_GET['order'],$_GET['id']);
}

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 4;
$categorias = Painel::selectAll('categorias',($paginaAtual-1)*$porPagina,$porPagina);
?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Categorias Cadastradas</h2>
    <div class="table-wraper">
        <table>
            <tr>
                <td>Categorias</td>
                <td class="table_center" colspan="2">Acoes</td>
                <td class="table_center" colspan="2">Ordenar</td>
            </tr>
            <?php foreach($categorias as $cat): ?>
                <tr>
                    <td><?php echo $cat['titulo'] ?></td>
                    <td class="table_center"><a class="btn edit" href="<?php echo BASE_PAINEL ?>editar-categoria?id=<?php echo $cat['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
                    <td class="table_center"><a actionBtn="confirmar" class="btn delete" href="<?php echo BASE_PAINEL ?>listar-categorias?excluir=<?php echo $cat['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                    <td class="table_center"><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-categorias?order=up&id=<?php echo $cat['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
                    <td class="table_center"><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-categorias?order=down&id=<?php echo $cat['id']; ?>"><i class="fa fa-angle-down"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div><!--table-wraper-->

    <div class="paginacao">
        <?php
        $totalPagina = ceil(count(Painel::selectAll('categorias'))/$porPagina);
        for($i = 1; $i <= $totalPagina; $i++){
            if($i == $paginaAtual){
                echo '<a class="page-selected" href="'.BASE_PAINEL.'listar-categorias?pagina='.$i.'">'.$i.'</a>';
            }else{
                echo '<a href="'.BASE_PAINEL.'listar-categorias?pagina='.$i.'">'.$i.'</a>';
            }
        }
        ?>
    </div><!--paginacao-->
</div><!--box-content-->