<?php
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $servico = Painel::select('servicos','id = ?',array($id));
}else{
    Painel::alert('erro',' Voce precisa informar uma identificacao valida!');
    die();
}
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Servico</h2>

    <form method="post">
        <?php
        if(isset($_POST['acao'])){
            if(Painel::update($_POST)){
                Painel::redirect(BASE_PAINEL.'listar-servicos?sucesso');
                //Painel::alert('sucesso',' Servico atualizado com sucesso!');
                //$servico = Painel::select('servicos','id = ?',array($id));
            }else{
                Painel::alert('erro',' Campos vazios nao sao permitidos!');
            }
        }

        ?>
        <div class="form-group">
            <label>Servico:</label>
            <textarea name="servico"><?php echo $servico['servico']; ?></textarea>
        </div><!--form-group-->
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="servicos">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->