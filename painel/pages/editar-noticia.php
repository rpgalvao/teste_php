<?php
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $noticias = Painel::select('noticias','id=?',array($id));
}else{
    Painel::alert('erro',' Você precisa informar uma identificação válida!');
    die();
}
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Notícia</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
        if(isset($_POST['acao'])){
            //Formul�rio enviado
            $titulo = $_POST['titulo'];
            $conteudo = $_POST['conteudo'];
            $categoria_id = $_POST['categoria_id'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $verifica = Database::conectar()->prepare("SELECT id FROM noticias WHERE titulo = ? AND categoria_id = ? AND id != ?");
            $verifica->execute(array($titulo, $categoria_id, $id));
            if($verifica->rowCount() == 0){
                if($imagem['name'] != ''){
                    //Existe upload de imagem
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile($imagem_atual);
                        $imagem = Painel::uploadFile($imagem);
                        $slug = Painel::generateSlug($titulo);
                        $array = array(
                            'categoria_id'=>$categoria_id,
                            'data'=>date('Y-m-d'),
                            'titulo'=>$titulo,
                            'conteudo'=>$conteudo,
                            'capa'=>$imagem,
                            'slug'=>$slug,
                            'id'=>$id,
                            'nome_tabela'=>'noticias');
                        Painel::update($array);
                        $noticias = Painel::select('noticias','id=?',array($id));
                        Painel::alert('sucesso',' A notícia foi editada junto com a imagem!');
                    }else{
                        Painel::alert('erro',' Formato da imagem não é válido!');
                    }
                }else{
                    $imagem = $imagem_atual;
                    $slug = Painel::generateSlug($titulo);
                    $array = ['categoria_id'=>$categoria_id,'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id'=>$id,'nome_tabela'=>'noticias'];
                    Painel::update($array);
                    $noticias = Painel::select('noticias','id=?',array($id));
                    Painel::alert('sucesso',' Notícia editada com sucesso!');
                }
            }else{
                Painel::alert('erro',' Já existe uma notícia cadastrarda com esse nome!');
            }
        }
        ?>
        <div class="form-group">
            <label>Titulo da Noticia:</label>
            <input type="text" name="titulo" value="<?php echo $noticias['titulo']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Descricao da Noticia:</label>
            <textarea class="tinymce" name="conteudo"><?php echo $noticias['conteudo']; ?></textarea>
        </div><!--form-group-->
        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
                <?php $categorias = Painel::selectAll('categorias');
                foreach($categorias as $cat):
                    ?>
                    <option <?php if($cat['id'] == $noticias['categoria_id']) echo 'selected'; ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['titulo']; ?></option>
                <?php endforeach; ?>
            </select>
        </div><!--form-group-->
        <div class="form-group">
            <label>Capa da Noticia:</label>
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $noticias['capa']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->