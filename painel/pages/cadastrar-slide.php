<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Slide</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
        if(isset($_POST['acao'])){
            //Formul�rio enviado
            $nome = $_POST['nome'];
            $imagem = $_FILES['imagem'];

            if($nome == ''){
                Painel::alert('erro',' Não são permitidos campos vazios!');
            }else{
                //Pode cadastrar
                if(!Painel::imagemValida($imagem)){
                    Painel::alert('erro',' Favor selecionar uma imagem em um formato válido!');
                }else{
                    //Agora � s� inserir no banco.
                    $imagem = Painel::uploadFile($imagem);
                    include('../classes/wideimage/WideImage.php');
                    //WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
                    $array = ['nome'=>$nome,'slide'=>$imagem,'order_id'=>'0','nome_tabela'=>'slides'];
                    Painel::insert($array);
                    Painel::alert('sucesso',' Slide cadastrado com sucesso!');
                }
            }
        }
        ?>
        <div class="form-group">
            <label>Título do Slide:</label>
            <input type="text" name="nome">
        </div><!--form-group-->
        <div class="form-group">
            <label>Imagem do Slide:</label>
            <input type="file" name="imagem">
        </div><!--form-group-->
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->