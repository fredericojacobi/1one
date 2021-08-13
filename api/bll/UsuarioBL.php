<?php
require_once "./config/Database.php";
require_once "./config/Tables.php";

/**
 * @author Frederico Jacobi
 * @version 0.0.3
 * @description Business logic class to handle Usuario's requests
 * @date 2021/07/15
 * @lastModifiedDate 2021/07/21
 */
class UsuarioBL
{
    public $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function Create(Usuario $usuario, string $tableName = Tables::USUARIO)
    {
        unset($usuario->id);
        unset($usuario->dataModificacao);
        $dateTime = new DateTime('now');
        $dateTime->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        $usuario->dataCadastro = $dateTime->format('Y-m-d H:i:s');
        if ($usuario->verificado)
            $usuario->dataVerificado = $dateTime->format('Y-m-d H:i:s');
        $arrayUsuario = get_object_vars($usuario);
        if ($arrayUsuario['verificado'] == "")
            $arrayUsuario['verificado'] = false;
        foreach ($arrayUsuario as $key => $value) {
            if (is_string($value))
                $arrayUsuario[$key] = "'$value'";
        }
        $implodeHeader = implode(", ", array_keys($arrayUsuario));
        $implodeValues = implode(", ", array_values($arrayUsuario));
        $sql = "
            INSERT INTO $tableName ($implodeHeader)
            VALUES
            ( $implodeValues )
        ";
        return $this->database->Insert($sql);
    }

    public function Read($id = null, $tableName = Tables::USUARIO)
    {
        $sql = "SELECT * FROM $tableName";
        $this->database = $this->database->getConnection();
        try {
            if (is_numeric($id)) {
                $sql .= " WHERE id = :id";
                $stmt = $this->database->prepare($sql);
                $stmt->execute(['id' => $id]);
            } else {
                $stmt = $this->database->prepare($sql);
                $stmt->execute();
            }
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return (count($rows) > 1) ? $rows : $rows[0];
        } catch (PDOException $exception) {
            $this->database->rollBack();
            return [
                "status" => 500,
                "errorCode" => $exception->getCode(),
                "message" => $exception->getMessage(),
                "file" => $exception->getFile()];
        }
    }

    public function Update(Usuario $usuario)
    {
        $tableName = Tables::USUARIO;
        $where = " Id = $usuario->id";
        unset($usuario->dataCadastro);
        $dateTime = new DateTime('now');
        $dateTime->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        $usuario->dataModificacao = $dateTime->format('Y-m-d H:i:s');
        $arrayUsuario = get_object_vars($usuario);
        $arraySet = [];
        foreach ($arrayUsuario as $key => $value) {
            if (is_string($value))
                $value = "'$value'";
            array_push($arraySet, "$key = $value");
        }
        $arraySetImplode = implode(", ", $arraySet);
        $query = "
                UPDATE $tableName
                SET $arraySetImplode
                WHERE $where ;
            ";

        return $this->database->Update($query);
    }

    public function Desativar(Usuario $usuario)
    {
        $query = "UPDATE " . Tables::USUARIO . "
                  SET Ativo = 0
                  WHERE Id = $usuario->id";
        return $this->database->Delete($query);
    }

    public function Login(Usuario $usuario)
    {
        $query = "SELECT * FROM " . Tables::USUARIO . "
                  WHERE Email = '$usuario->email'
                  AND   Senha = '$usuario->senha'";

        try {
            $this->database = $this->database->getConnection();
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return (empty($rows)) ? false : $rows[0];
        } catch (PDOException $exception) {
            $this->database->rollBack();
            return [
                "status" => 500,
                "errorCode" => $exception->getCode(),
                "message" => $exception->getMessage(),
                "file" => $exception->getFile()];
        }
    }
}