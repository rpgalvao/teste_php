<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $depoimento = Painel::select('depoimentos','id = ?',array($id));
    }else{
        Painel::alert('erro',' Voce precisa informar uma identificacao valida!');
        die();
    }
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Depoimento</h2>

    <form method="post">
        <?php
        if(isset($_POST['acao'])){
            if(Painel::update($_POST)){
                Painel::alert('sucesso',' Depoimento atualizado com sucesso!');
                $depoimento = Painel::select('depoimentos','id = ?',array($id));
            }else{
                Painel::alert('erro',' Campos vazios nao sao permitidos!');
            }
        }

        ?>
        <div class="form-group">
            <label>Nome do depoente:</label>
            <input type="text" name="nome" value="<?php echo $depoimento['nome']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Depoimento:</label>
            <textarea name="depoimento"><?php echo $depoimento['depoimento']; ?></textarea>
        </div><!--form-group-->
        <div class="form-group">
            <label>Data:</label>
            <input formato="data" type="text" name="data" value="<?php echo $depoimento['data']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="depoimentos">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->