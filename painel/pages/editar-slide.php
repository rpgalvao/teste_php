<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $slide = Painel::select('slides','id=?',array($id));
    }else{
        Painel::alert('erro',' Voce precisa informar uma identificacao valida!');
        die();
    }
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Slide</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
        if(isset($_POST['acao'])){
            //Formulário enviado
            $nome = $_POST['nome'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            if($imagem['name'] != ''){
                //Existe upload de imagem
                if(Painel::imagemValida($imagem)){
                    Painel::deleteFile($imagem_atual);
                    $imagem = Painel::uploadFile($imagem);
                    $array = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'slides'];
                    Painel::update($array);
                    $slide = Painel::select('slides','id=?',array($id));
                    Painel::alert('sucesso',' O Slide foi editado junto com a imagem!');
                }else{
                    Painel::alert('erro',' Formato da imagem não é válido!');
                }
            }else{
                $imagem = $imagem_atual;
                $array = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'slides'];
                Painel::update($array);
                $slide = Painel::select('slides','id=?',array($id));
                Painel::alert('sucesso',' Slide editado com sucesso!');
            }
        }
        ?>
        <div class="form-group">
            <label>Titulo do Slide:</label>
            <input type="text" name="nome" required value="<?php echo $slide['nome']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Imagem do Slide:</label>
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->