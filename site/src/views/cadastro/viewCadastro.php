<?php
require "../../../../api/models/Usuario.php";
require "../../../../generics/Generics.php";
//require "../../../../generics/Constants.php";

$method = $_SERVER['REQUEST_METHOD'];
$generics = new Generics();
switch ($method) {
    case 'POST':
        if (empty($_POST)) {
            $generics->Redirect("/cadastro");
        }
        if ($_POST['Senha'] == $_POST['ConfirmarSenha']) {
            $senha = hash('sha256', $_POST['Senha']);
        }
        $usuarioModel = new Usuario(
            $_POST['Nome'],
            $_POST['Sobrenome'],
            $_POST['DataNascimento'],
            $_POST['Cpf'],
            $_POST['TipoUsuario'],
            $_POST['Endereco'],
            $_POST['Telefone'],
            $_POST['Email'],
            $senha,
        );
        $url = Constants::API_URL . "usuario.php";

        if (isset($_POST['Id'])) {
            $usuarioModel->id = $_POST['Id'];
            return $generics->PutMethod($url, $usuarioModel);
        }

        return $generics->PostMethod($url, $usuarioModel);

    case 'GET':
        if (empty($_GET))
            $generics->Redirect("/cadastro");
        if($_GET['id'])
            $url = Constants::API_URL . "usuario.php?id=" . $_GET['id'];
        else
            $url = Constants::API_URL . "usuario.php";

        echo $generics->GetMethod($url);
        return;
}
