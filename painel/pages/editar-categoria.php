<?php
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $categoria = Painel::select('categorias','id = ?',array($id));
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
            $slug = Painel::generateSlug($_POST['titulo']);
            $array = array_merge($_POST, array('slug'=>$slug));
            $verificar = Database::conectar()->prepare("SELECT * FROM categorias WHERE titulo = ? AND id != ?");
            $verificar->execute(array($_POST['titulo'], $id));
            $info = $verificar->fetch();
            if($verificar->rowCount() == 1){
                Painel::alert('erro', ' Ja existe uma categoria cadastrada com esse nome!');
            }else{
                if (Painel::update($array)) {
                    Painel::alert('sucesso', ' Categoria atualizada com sucesso!');
                    $categoria = Painel::select('categorias', 'id = ?', array($id));
                } else {
                    Painel::alert('erro', ' Campos vazios nao sao permitidos!');
                }
            }
        }

        ?>
        <div class="form-group">
            <label>Categoria:</label>
            <input type="text" name="titulo" value="<?php echo $categoria['titulo']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="categorias">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->