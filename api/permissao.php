<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "./config/Database.php";
require_once "./Models/Permissao.php";
require_once "./bll/PermissaoBL.php";
require_once "../generics/Constants.php";
require_once "../generics/Generics.php";

$database = new Database();
$database->getConnection();
$functions = new Generics();
$errorArray = [];
$method = $_SERVER['REQUEST_METHOD'];
(isset($_GET['id'])) ? $id = intval($_GET['id']) : $id = null;

$permissaoBL = new PermissaoBL($database);
switch ($method) {
    case 'POST':
        $postData = json_decode(file_get_contents("php://input"), true);
        if (is_null($postData)) {
            http_response_code(400);
            echo json_encode([
                'error' => 'erro em permissao'
            ]);
            return;
        }
        $permissao = new Permissao(
            $postData['nome'],
            $postData['nivel'],
            $postData['categoria'],
        );
        $return = $permissaoBL->Create($permissao);
        if (is_numeric($return)) {
            http_response_code(200);
            echo json_encode($permissaoBL->Read($return)[0]);
        } else {
            http_response_code(400);
            echo json_encode($return);
        }
        return;

    case 'GET':
        echo json_encode($permissaoBL->Read($id));
        break;

    case 'PUT':
        parse_str(file_get_contents('php://input'), $postData);
        if (is_null($postData) || empty($postData)) {
            http_response_code(400);
            echo json_encode(["message" => Constants::REQUEST_NO_BODY]);
        }
        foreach ($postData as $key => $value) {
            if (isset($value) || empty($value) || is_null($value)) {
                array_push($errorArray);
            }
        }
        if (count($errorArray) > 0) {
            $implodeError = implode(", ", $errorArray);
            http_response_code(400);
            echo json_encode(["message" => Constants::REQUEST_FIELD_ERROR . $implodeError]);
        }
        $permissao = new Permissao(
            $postData['id'],
            $postData['nome'],
            $postData['nivel'],
            $postData['categoria'],
        );
        $return = $permissaoBL->Update($permissao);
        if (!$return)
            http_response_code(500);
        else
            http_response_code(200);
        echo json_encode(["message" => Constants::REQUEST_SUCCESS]);
        return $return;

    case 'DELETE':
        if (!$id) {
            http_response_code(404);
            echo json_encode(["message" => Constants::REQUEST_USER_NOT_FOUND, "status" => 0]);
        }
        $usuario = new Usuario("", "", "", "", "", "", "", "", "");
        $usuario->id = $id;
        echo $usuarioBL->Desativar($usuario);
        return;
}



