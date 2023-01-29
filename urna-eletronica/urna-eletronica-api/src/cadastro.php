<?php
    if(isset($_POST['nome']) && isset($_POST['usuario']) && isset($_POST['titulo']) && isset($_POST['senha'])){
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $usuario = filter_input(INPUT_POST, 'usuario', FILTER_DEFAULT);
        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
        $senha_normal = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
        $senha = password_hash($senha_normal, PASSWORD_DEFAULT);

        $init = curl_init("http://localhost/urna-eletronica/urna-eletronica-api/src/cadastrar.php");
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);

        $dados = array(
            "nome" => $nome, 
            "usuario" => $usuario,
            "titulo" => $titulo,
            "senha" => $senha
        );

        curl_setopt($init, CURLOPT_POST, true);
        curl_setopt($init, CURLOPT_POSTFIELDS, $dados);
        curl_exec($init);
        $retorno = curl_multi_getcontent($init);
        curl_close($init);	

        $msg = json_decode($retorno,TRUE);

        if ($msg != 'Erro'){
            header('Location: ./?msg=1');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <style>
    </style>
</head>
<body>
    <form id="cadastro-form" action="" method="post">
        <h3>Nome Completo:</h3>
        <input type="text" name="nome" id="nome"/> 
        </br>   
        <h3>Usuário:</h3>
        <input type="text" name="usuario" id="usuario">
        </br>
        <h3>Título de eleitor (12 dígitos):</h3>
        <input type="text" name="titulo" id="titulo" max="12">
        </br>
        <h3>Senha:</h3>
        <input type="password" name="senha" id="senha"></br></br>
        <input type="submit" value="Cadastrar">
        <a href="./">Logar</a>
    </form>
</body>
</html>