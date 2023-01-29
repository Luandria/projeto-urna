<?php
    if(isset($_GET['erro']) && $_GET['erro']==1){
        echo '<h3 style="color: red;">Login inválido</h3>';
    }
    if(isset($_GET['msg']) && $_GET['msg']==1){
        echo '<h3 style="color: green;">Conta criada com sucesso!</h3>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Urna eletrônica</title>
</head>
<body>
    <form action="autenticar.php" method="post" id="login">
        <div class="login">
            <h3>Usuário</h3>
            <input type="text" name="usuario" id="usuario" placeholder="Digite o usuário">
            <h3>Senha</h3>
            <input type="password" name="senha" id="senha" placeholder="Digite a senha"></br></br>
            <input type="submit" value="Entrar">
            <a href="cadastro.php">Cadastrar-se</a>
        </div>
    </form>
</body>
</html>