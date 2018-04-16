<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Notícia</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
        if(isset($_POST['acao'])){
            //Formulário enviado
            $categoria_id = $_POST['categoria_id'];
            $titulo = $_POST['titulo'];
            $conteudo = $_POST['conteudo'];
            $imagem = $_FILES['capa'];

            if($titulo == '' || $conteudo == ''){
                Painel::alert('erro',' Não são permitidos campos vazios!');
            }else{
                if($imagem['tmp_name'] == ''){
                    Painel::alert('erro', ' Favor selecionar uma imagem de capa');
                }else{
                    //Pode cadastrar
                    if (Painel::imagemValida($imagem)){
                        $verifica = Database::conectar()->prepare("SELECT * FROM noticias WHERE titulo = ? AND categoria_id = ?");
                        $verifica->execute(array($titulo, $categoria_id));
                        if ($verifica->rowCount() == 0){
                            $capa = Painel::uploadFile($imagem);
                            $slug = Painel::generateSlug($titulo);
                            $array = array(
                                'categoria_id' => $categoria_id,
                                'data' => date('Y-m-d'),
                                'titulo' => $titulo,
                                'conteudo' => $conteudo,
                                'capa' => $capa,
                                'slug' => $slug,
                                'order_id' => '0',
                                'nome_tabela' => 'noticias'
                            );
                            if (Painel::insert($array)) {
                                Painel::redirect(BASE_PAINEL.'cadastrar-noticia?sucesso');
                            }
                        }else {
                        Painel::alert('erro', ' Já existe uma notícia cadastrada com esse nome!');
                        }
                    }else{
                        Painel::alert('erro', ' Favor selecionar uma imagem válida!');
                    }
                }
            }
        }
        if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
            Painel::alert('sucesso', ' Notícia cadastrada com sucesso!');
        }
        ?>
        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
                <?php $categorias = Painel::selectAll('categorias');
                    foreach($categorias as $cat):
                ?>
                <option <?php if($cat['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['titulo']; ?></option>
                <?php endforeach; ?>
            </select>
        </div><!--form-group-->
        <div class="form-group">
            <label>Título da Notícia:</label>
            <input type="text" name="titulo" value="<?php recoverPost('titulo'); ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Conteúdo da Notícia:</label>
            <textarea class="tinymce" name="conteudo"><?php recoverPost('conteudo'); ?></textarea>
        </div><!--form-group-->
        <div class="form-group">
            <label>Imagem de Capa:</label>
            <input type="file" name="capa">
        </div><!--form-group-->
        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="noticias">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->