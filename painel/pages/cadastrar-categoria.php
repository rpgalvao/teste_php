<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Categoria</h2>

    <form method="post">
        <?php
        if(isset($_POST['acao'])){
            $nome = $_POST['titulo'];
            if($nome == ''){
                Painel::alert('erro',' O campo nome n�o pode ficar vazio');
            }else{
                //Pode cadastrar no banco
                $verificar = Database::conectar()->prepare("SELECT * FROM categorias WHERE titulo = ?");
                $verificar->execute(array($_POST['titulo']));
                if($verificar->rowCount() == 0){
                    $slug = Painel::generateSlug($_POST['titulo']);
                    $array = array('nome'=>$nome, 'slug'=>$slug, 'order_id'=>'0', 'nome_tabela'=>'categorias');
                    Painel::insert($array);
                    Painel::alert('sucesso',' Categoria cadastrada com sucesso!');
                }else{
                    Painel::alert('erro',' Ja existe uma categoria cadastrada com esse nome!');
                }
            }
        }

        ?>
        <div class="form-group">
            <label>Título da Categoria:</label>
            <input type="text" name="titulo">
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="categorias">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->