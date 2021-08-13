<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "./config/Database.php";
require_once "./Models/Usuario.php";
require_once "./bll/UsuarioBL.php";
require_once "./bll/PermissaoBL.php";
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

        $permissaoBL = new PermissaoBL($database);
        $permissoes = $permissaoBL->Read();
        if($usuario->tipoUsuario == '1')
            $functions->SetPermission($permissoes, 'Basico', 'Cliente', $usuario);
        else
            $functions->SetPermission($permissoes, 'Basico', 'Parceiro', $usuario);

        $return = $usuarioBL->Create($usuario);
        if (is_numeric($return)) {
            http_response_code(200);
            echo json_encode($usuarioBL->Read($return));
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
            echo json_encode(["message" => Constants::REQUEST_NO_BODY, "status" => "0"]);
            return;
        }
        if (!$id) {
            http_response_code(404);
            echo json_encode(["message" => Constants::REQUEST_USER_NOT_FOUND]);
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
            $postData['ativo'],
            $postData['verificado']
        );

        $usuario->id = $id;
        $return = $usuarioBL->Update($usuario);
        if (!$return) {
            http_response_code(500);
            echo json_encode(["message" => Constants::REQUEST_ERROR, "status" => "0"]);
        } else
            http_response_code(200);
        if (!is_bool($return))
            echo json_encode(["message" => $return, "status" => "0"]);
        else
            echo json_encode(["message" => Constants::REQUEST_SUCCESS, "status" => "1"]);
        return $return;

    case 'DELETE':
        if (!$id) {
            http_response_code(404);
            echo json_encode(["message" => Constants::REQUEST_NO_ID, "status" => "0"]);
            return;
        }
        $usuario = new Usuario("", "", "", "", "", "", "", "", "");
        $usuario->id = $id;
        return $usuarioBL->Desativar($usuario);
}


