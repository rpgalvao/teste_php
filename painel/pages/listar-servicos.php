<?php
if(isset($_GET['excluir'])){
    $idExcluir = (int)$_GET['excluir'];
    Painel::excluir('servicos',$idExcluir);
    Painel::redirect(BASE_PAINEL.'listar-servicos');
}elseif(isset($_GET['order']) && isset($_GET['id'])){
    Painel::orderItem('servicos',$_GET['order'],$_GET['id']);
}

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 4;
$depoimentos = Painel::selectAll('servicos',($paginaAtual-1)*$porPagina,$porPagina);
if(isset($_GET['sucesso'])){
    Painel::alert('sucesso',' Servico atualizado com sucesso!');
}
?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Servicos Cadastrados</h2>
    <div class="table-wraper">
        <table>
            <tr>
                <td width="800">Servicos</td>
                <td class="table_center" colspan="2">Acoes</td>
                <td class="table_center" colspan="2">Ordenar</td>
            </tr>
            <?php foreach($depoimentos as $dep): ?>
                <tr>
                    <td><?php echo $dep['servico'] ?></td>
                    <td class="table_center"><a class="btn edit" href="<?php echo BASE_PAINEL ?>editar-servico?id=<?php echo $dep['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
                    <td class="table_center"><a actionBtn="confirmar" class="btn delete" href="<?php echo BASE_PAINEL ?>listar-servicos?excluir=<?php echo $dep['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                    <td class="table_center"><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-servicos?order=up&id=<?php echo $dep['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
                    <td class="table_center"><a class="btn order" href="<?php echo BASE_PAINEL ?>listar-servicos?order=down&id=<?php echo $dep['id']; ?>"><i class="fa fa-angle-down"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div><!--table-wraper-->

    <div class="paginacao">
        <?php
        $totalPagina = ceil(count(Painel::selectAll('servicos'))/$porPagina);
        for($i = 1; $i <= $totalPagina; $i++){
            if($i == $paginaAtual){
                echo '<a class="page-selected" href="'.BASE_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
            }else{
                echo '<a href="'.BASE_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
            }
        }
        ?>
    </div><!--paginacao-->
</div><!--box-content-->