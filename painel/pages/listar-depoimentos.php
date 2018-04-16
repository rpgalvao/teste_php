<?php
    if(isset($_GET['excluir'])){
        $idExcluir = (int)$_GET['excluir'];
        Painel::excluir('depoimentos',$idExcluir);
        Painel::redirect(BASE_PAINEL.'listar-depoimentos');
    }elseif(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('depoimentos',$_GET['order'],$_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    $depoimentos = Painel::selectAll('depoimentos',($paginaAtual-1)*$porPagina,$porPagina);
?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Depoimentos Cadastrados</h2>
    <div class="table-wraper">
        <table>
            <tr>
                <td>Nome</td>
                <td>Data</td>
                <td colspan="2">Acoes</td>
                <td colspan="2">Ordenar</td>
            </tr>
            <?php foreach($depoimentos as $dep): ?>
            <tr>
                <td><?php echo $dep['nome'] ?></td>
                <td><?php echo $dep['data'] ?></td>
                <td><a class="btn edit" href="<?php echo BASE_PAINEL ?>editar-depoimento?id=<?php echo $dep['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
                <td><a actionBtn="confirmar" class="btn delete" href="<?php echo BASE_PAINEL ?>listar-depoimentos?excluir=<?php echo $dep['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                <td><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-depoimentos?order=up&id=<?php echo $dep['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
                <td><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-depoimentos?order=down&id=<?php echo $dep['id']; ?>"><i class="fa fa-angle-down"></i></a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div><!--table-wraper-->

    <div class="paginacao">
        <?php
            $totalPagina = ceil(count(Painel::selectAll('depoimentos'))/$porPagina);
            for($i = 1; $i <= $totalPagina; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.BASE_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
                }else{
                    echo '<a href="'.BASE_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
                }
            }
        ?>
    </div><!--paginacao-->
</div><!--box-content-->