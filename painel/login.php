<?php
    if(isset($_COOKIE['lembrar'])){
        $user = $_COOKIE['user'];
        $senha = $_COOKIE['senha'];
        $query = "SELECT * FROM usuarios_painel WHERE usuario = ? AND senha = ?";
        $sql = Database::conectar()->prepare($query);
        $sql->execute(array($user,$senha));
        if($sql->rowCount() == 1) {
            $array = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['senha'] = $senha;
            $_SESSION['nome'] = $array['nome'];
            $_SESSION['cargo'] = $array['cargo'];
            $_SESSION['imagem'] = $array['imagem'];
            header("Location: ".BASE_PAINEL);
            die();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Painel de Controle</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>estilo/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_PAINEL; ?>css/style.css">
    </head>
    <body>
    	<div class="box_login">
            <?php 
                if(isset($_POST['acao'])){
                    $user = $_POST['user'];
                    $senha = $_POST['senha'];

                    $query = "SELECT * FROM usuarios_painel WHERE usuario = ? AND senha = ?";
                    $sql = Database::conectar()->prepare($query);
                    $sql->execute(array($user,$senha));

                    if($sql->rowCount() == 1){
                        //Logamos com sucesso
                        $array = $sql->fetch();
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['nome'] = $array['nome'];
                        $_SESSION['cargo'] = $array['cargo'];
                        $_SESSION['imagem'] = $array['imagem'];
                        if(isset($_POST['lembrar'])){
                            setcookie('lembrar',true,time()+(60*60*24),'/');
                            setcookie('user',$user,time()+(60*60*24),'/');
                            setcookie('senha',$senha,time()+(60*60*24),'/');
                        }
                        header("Location: ".BASE_PAINEL);
                        die();
                    }else{
                        //Falhou o login
                        echo '<div class="box-erro"><i class="fa fa-times"></i> Usuário e/ou senha incorretos!</div>';
                    }
                }
            ?>
    		<h3>Faça o seu login:</h3>
    		<form method="POST">
    			<input type="text" name="user" placeholder="Usuário" required>
    			<input type="password" name="senha" placeholder="Senha" required>
                <div class="form-group-login left">
    			    <input type="submit" name="acao" value="Login">
                </div>
                <div class="form-group-login right">
                    <label>Lembrar-me</label>
                    <input type="checkbox" name="lembrar">
                </div>
    		</form>
    	</div><!--box_login-->
    </body>
</html>