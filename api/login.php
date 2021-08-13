<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "./config/Database.php";
require_once "./Models/Usuario.php";
require_once "./bll/UsuarioBL.php";
require_once "../generics/Constants.php";
require_once "../generics/Generics.php";

$database = new Database();
$database->getConnection();
$functions = new Generics();
$method = $_SERVER['REQUEST_METHOD'];
$usuarioBL = new UsuarioBL($database);
switch ($method) {
    case 'POST':
        $postData = json_decode(file_get_contents("php://input"), true);
        if (is_null($postData)) {
            http_response_code(400);
            echo json_encode([
                'error' => Constants::REQUEST_WRONG_BODY
            ]);
            return;
        }
        $retorno = $usuarioBL->Login(
            new Usuario(
                "", "", "", "", "", "", "",
                $postData['Email'],
                $postData['Senha'])
        );
        if ($retorno) {
            http_response_code(200);
            echo json_encode($retorno);
        } else {
            http_response_code(404);
            echo json_encode(["message" => Constants::REQUEST_USER_NOT_FOUND]);
        }

        break;
}
