<?php
require "../../../../api/models/Usuario.php";
require "../../../../generics/Generics.php";
require "../../../../generics/Constants.php";

$method = $_SERVER['REQUEST_METHOD'];
$generics = new Generics();
switch ($method) {
    case 'POST':
        if (empty($_POST))
            $generics->Redirect("/cadastro");
        if (empty($_POST['Senha'])) {
            http_response_code(400);
            echo json_encode([
                "message" => Constants::REQUEST_WRONG_PASSWORD,
                "status" => false
            ]);
        }
        $url = Constants::API_URL . "login.php?XDEBUG_SESSION_START=11320";
        $senhaCript = hash('sha256', $_POST['Senha']);
        $login = [
            "Email" => $_POST['Email'],
            "Senha" => $senhaCript
        ];
        echo $generics->PostMethod($url, $login);
        break;
}