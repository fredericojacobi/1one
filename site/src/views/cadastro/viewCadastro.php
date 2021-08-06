<?php
require "../../../../api/models/Usuario.php";
require "../../../../generics/Generics.php";

$method = $_SERVER['REQUEST_METHOD'];
$generics = new Generics();
switch ($method) {
    case 'POST':
        if (empty($_POST)) {
            $generics->Redirect("/cadastro");
        }
        if ($_POST['Senha'] == $_POST['ConfirmarSenha']) {
            $novaSenha = hash('sha256', $_POST['Senha']);
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
            $novaSenha
        );
        if (isset($_POST['SenhaAtual'])) {
            $senhaAtual = hash('sha256', $_POST['SenhaAtual']);
            $url = Constants::API_URL . "usuario.php?id=" . $_POST['Id'];
            $return = $generics->GetMethod($url);
            $usuario = json_decode($return);
            $senhaBd = $usuario->Senha;
            if (!empty($senhaBd)) {
                if ($senhaBd == $senhaAtual) {
                    $usuarioModel->senha = $novaSenha;
                } else {
                    echo json_encode(
                        [
                            'status' => 0,
                            'message' => Constants::REQUEST_WRONG_PASSWORD
                        ]);
                    return;
                }
                $usuarioModel->id = $_POST['Id'];
                echo $generics->PutMethod($url, $usuarioModel);
            }
        } else {
            $url = Constants::API_URL . "usuario.php";
            echo $generics->PostMethod($url, $usuarioModel);
        }
        return;

    case 'GET':
        if (empty($_GET))
            $generics->Redirect("/cadastro");
        if ($_GET['id'])
            $url = Constants::API_URL . "usuario.php?id=" . $_GET['id'];
        else
            $url = Constants::API_URL . "usuario.php";

        echo $generics->GetMethod($url);
        return;
}
