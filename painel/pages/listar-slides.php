<?php
if(isset($_GET['excluir'])){
    $idExcluir = (int)$_GET['excluir'];
    $selectImage = Database::conectar()->prepare("SELECT slide FROM slides WHERE id = ?");
    $selectImage->execute(array($_GET['excluir']));
    $imagem = $selectImage->fetch()['slide'];
    Painel::deleteFile($imagem);
    Painel::excluir('slides',$idExcluir);
    Painel::redirect(BASE_PAINEL.'listar-slides');
}elseif(isset($_GET['order']) && isset($_GET['id'])){
    Painel::orderItem('slides',$_GET['order'],$_GET['id']);
}

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 4;
$slides = Painel::selectAll('slides',($paginaAtual-1)*$porPagina,$porPagina);
?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Servicos Cadastrados</h2>
    <div class="table-wraper">
        <table>
            <tr>
                <td>Titulo do Slide</td>
                <td>Imagem do Slide</td>
                <td colspan="2">Acoes</td>
                <td colspan="2">Ordenar</td>
            </tr>
            <?php foreach($slides as $slide): ?>
                <tr>
                    <td><?php echo $slide['nome'] ?></td>
                    <td><img style="width: 50px;height: 30px;" src="<?php echo BASE_PAINEL ?>uploads/<?php echo $slide['slide']; ?>" alt=""></td>
                    <td><a class="btn edit" href="<?php echo BASE_PAINEL ?>editar-slide?id=<?php echo $slide['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
                    <td><a actionBtn="confirmar" class="btn delete" href="<?php echo BASE_PAINEL ?>listar-slides?excluir=<?php echo $slide['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                    <td><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-slides?order=up&id=<?php echo $slide['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
                    <td><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-slides?order=down&id=<?php echo $slide['id']; ?>"><i class="fa fa-angle-down"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div><!--table-wraper-->

    <div class="paginacao">
        <?php
        $totalPagina = ceil(count(Painel::selectAll('slides'))/$porPagina);
        for($i = 1; $i <= $totalPagina; $i++){
            if($i == $paginaAtual){
                echo '<a class="page-selected" href="'.BASE_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
            }else{
                echo '<a href="'.BASE_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
            }
        }
        ?>
    </div><!--paginacao-->
</div><!--box-content-->