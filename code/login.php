<?php
require_once("banco-usuario.php");
require_once("logica-usuario.php");

$usuario = buscaUsuario($conexao, $_POST['email'], $_POST['senha']);
if($usuario == NULL){
	$_SESSION['danger'] = "Usuário ou Senha inválida";
    header("Location: index.php");
} else {
	$_SESSION['success'] = "Usuário logado com sucesso!";
    logaUsuario($usuario['email']);
    header("Location: index.php");
}
die();