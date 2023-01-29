<?php
session_start();

$usuario = filter_input(INPUT_POST, 'usuario', FILTER_DEFAULT);
$senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
$init = curl_init("http://localhost/urna-eletronica/urna-eletronica-api/src/autenticar.php");
curl_setopt($init, CURLOPT_RETURNTRANSFER, true);

$dados = array(
    "usuario" => $usuario, 
    "senha" => $senha
);

curl_setopt($init, CURLOPT_POST, true);
curl_setopt($init, CURLOPT_POSTFIELDS, $dados);
curl_exec($init);
$retorno = curl_multi_getcontent($init);
curl_close($init);	

$autenticacao = json_decode($retorno,TRUE);

if(isset($autenticacao['usuario'])){
    $_SESSION['nome'] = $autenticacao['nome'];			
    $_SESSION['usuario'] = $autenticacao['usuario'];
    $_SESSION['titulo'] = $autenticacao['titulo'];
    header('Location: ./votar.php');
}
else{
    header('Location: ./?erro=1');
}
?>