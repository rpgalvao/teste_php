<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Usuarios</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
        if(isset($_POST['acao'])){
            //Formulário enviado
            $u = new Usuarios();
            $nome = $_POST['nome'];
            $senha = $_POST['senha'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            if($imagem['name'] != ''){
                //Existe upload de imagem
                if(Painel::imagemValida($imagem)){
                    Painel::deleteFile($imagem_atual);
                    $imagem = Painel::uploadFile($imagem);
                    if($u->atualizarUsuario($nome, $senha, $imagem)){
                        $_SESSION['imagem'] = $imagem;
                        Painel::alert('sucesso','Atualizado com sucesso, junto com a imagem!');
                    }else{
                        Painel::alert('erro','Falha ao atualizar, junto com a imagem.');
                    }
                }else{
                    Painel::alert('erro','Formato da imagem não é válido!');
                }
            }else{
                if($u->atualizarUsuario($nome, $senha, $imagem_atual)){
                    Painel::alert('sucesso','Atualizado com sucesso!');
                }else{
                    Painel::alert('erro','Falha ao atualizar...');
                }
            }
        }
        ?>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" required value="<?php echo $_SESSION['nome']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" required value="<?php echo $_SESSION['senha']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['imagem']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->