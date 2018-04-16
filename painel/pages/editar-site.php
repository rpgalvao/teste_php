<?php
    $site = Painel::select('website', false);
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Conteudo do Website</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])) {
                if(Painel::update($_POST, true)){
                    Painel::alert('sucesso',' Website atualizado com sucesso!');
                    $site = Painel::select('website', false);
                }else{
                    Painel::alert('erro',' Campos vazios nao sao permitidos!');
                }
            }
        ?>
        <div class="form-group">
            <label>Titulo do Site:</label>
            <input type="text" name="titulo" value="<?php echo $site['titulo']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Autor do Site:</label>
            <input type="text" name="autor" value="<?php echo $site['autor']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Descricao do Autor</label>
            <textarea name="descricao_autor"><?php echo $site['descricao_autor']; ?></textarea>
        </div><!--form-group-->,
        <?php for($i = 1; $i <= 3; $i++): ?>
            <div class="form-group">
                <label>Icone <?php echo $i; ?>:</label>
                <input type="text" name="icone<?php echo $i; ?>" value="<?php echo $site['icone'.$i] ?>">
            </div><!--form-group-->
            <div class="form-group">
                <label>Titulo do Icone <?php echo $i; ?>:</label>
                <input type="text" name="titulo_icone<?php echo $i; ?>" value="<?php echo $site['titulo_icone'.$i] ?>">
            </div><!--form-group-->
            <div class="form-group">
                <label>Descricao do Icone <?php echo $i; ?>:</label>
                <textarea name="desc_icone<?php echo $i; ?>"><?php echo $site['desc_icone'.$i] ?></textarea>
            </div><!--form-group-->
        <?php endfor; ?>
        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="website">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->