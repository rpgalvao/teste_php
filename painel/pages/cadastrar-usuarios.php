<?php Painel::permissaoPagina(2);?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Usuários</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
        if(isset($_POST['acao'])){
            //Formul�rio enviado
            $user = $_POST['user'];
            $nome = $_POST['nome'];
            $senha = $_POST['senha'];
            $cargo = $_POST['cargo'];
            $imagem = $_FILES['imagem'];

            if($user == ''){
                Painel::alert('erro',' O campo Login não pode estar vazio!');
            }elseif($nome == ''){
                Painel::alert('erro',' O campo Nome não pode estar vazio!');
            }elseif($senha == ''){
                Painel::alert('erro',' O campo Senha não pode estar vazio!');
            }elseif($cargo == ''){
                Painel::alert('erro',' Favor selecionar um cargo!');
            }elseif($imagem['name'] == ''){
                Painel::alert('erro',' Favor selecionar uma imagem!');
            }else{
                //Pode cadastrar
                if(!Painel::imagemValida($imagem)){
                    Painel::alert('erro',' Favor selecionar uma imagem em um formato válido!');
                }elseif($cargo >= $_SESSION['cargo']){
                    Painel::alert('erro',' Voc� não tem permissão para criar usuários com esse cargo!');
                }elseif(Usuarios::userExists($user)){
                    Painel::alert('erro',' Nome de usuário em uso. Favor escolher outro nome de usuário');
                }else{
                    //Agora � s� inserir no banco.
                    Usuarios::saveUser($user, $senha, $imagem, $nome, $cargo);
                    Painel::alert('sucesso',' Usuário cadastrado com sucesso!');
                }
            }
        }

        ?>
        <div class="form-group">
            <label>Login:</label>
            <input type="text" name="user">
        </div><!--form-group-->
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome">
        </div><!--form-group-->
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha">
        </div><!--form-group-->
        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="imagem">
        </div><!--form-group-->
        <div class="form-group">
            <label>Nível de Acesso:</label>
            <select name="cargo">
                <?php foreach(Painel::$cargo as $key => $value){
                    if($key < $_SESSION['cargo']){echo '<option value="'.$key.'">'.$value.'</option>';}
                } ?>
            </select>
        </div><!--form-group-->
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->