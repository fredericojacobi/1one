<?php
require "../../../../api/models/Usuario.php";
require "../../../../generics/Generics.php";
require "../../../../generics/Constants.php";

$method = $_SERVER['REQUEST_METHOD'];
$generics = new Generics();
switch ($method) {
    case 'POST':
        if (empty($_POST)){
           $generics->Redirect("/cadastro");
        }
        $usuarioModel = new Usuario(
            $_POST['Nome'],
            $_POST['Sobrenome'],
            $_POST['DataNascimento'],
            $_POST['Cpf'],
            $_POST['TipoUsuario'],
            $_POST['Endereco'],
            $_POST['Telefone']);

        $url = Constants::API_URL . "usuario.php";
        return $generics->PostMethod($url, $usuarioModel);

    case 'GET':
        if(empty($_GET))
            $generics->Redirect("/cadastro");
        $url = Constants::API_URL . "usuario.php?id=" . $_GET['id'];
        echo $generics->GetMethod($url);
        return;
}
