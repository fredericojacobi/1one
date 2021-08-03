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
$errorArray = [];

$method = $_SERVER['REQUEST_METHOD'];
(isset($_GET['id'])) ? $id = intval($_GET['id']) : $id = null;

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
        $usuario = new Usuario(
            $postData['nome'],
            $postData['sobrenome'],
            $postData['dataNascimento'],
            $postData['cpf'],
            $postData['tipoUsuario'],
            $postData['endereco'],
            $postData['telefone'],
            $postData['email'],
            $postData['senha'],
            isset($postData['ativo']) ? $postData['ativo'] : false
        );
        $return = $usuarioBL->Create($usuario);
        if (is_numeric($return)) {
            http_response_code(200);
            echo json_encode($usuarioBL->Read($return)[0]);
        } else {
            http_response_code(400);
            echo json_encode($return);
        }
        return;

    case 'GET':
        echo json_encode($usuarioBL->Read($id));
        break;

    case 'PUT':
        $postData = json_decode(file_get_contents("php://input"), true);
        if (is_null($postData) || empty($postData)) {
            http_response_code(400);
            echo json_encode(array("message" => Constants::REQUEST_NO_BODY));
        }
        if (!isset($postData['id']) || is_null($postData['id'])) {
            http_response_code(400);
            echo json_encode(array("message" => Constants::REQUEST_NO_ID));
        }

        $usuario = new Usuario(
            $postData['nome'],
            $postData['sobrenome'],
            $postData['dataNascimento'],
            $postData['cpf'],
            $postData['tipoUsuario'],
            $postData['endereco'],
            $postData['telefone'],
            $postData['verificado']
        );
        $usuario->id = $postData['id'];
        $where = "id = {$postData['id']}";
        $return = $usuarioBL->Update($usuario, $where);
        if (!$return){
            http_response_code(500);
        }
        else
            http_response_code(200);
        if (!is_bool($return))
           echo $return;
        else
            echo json_encode(["message" => Constants::REQUEST_SUCCESS]);
        return $return;

    case 'DELETE':

        break;
}


