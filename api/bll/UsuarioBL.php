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
        if($arrayUsuario['verificado'] == "")
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
        if (is_numeric($id)) {
            $sql .= " WHERE id = :id";
        }
        $database = new Database();
        try {
            $stmt = $database->getConnection()->prepare($sql);
            $stmt->execute(['id' => $id]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $exception) {
            $this->database->rollBack();
            return [
                "status" => 500,
                "errorCode" => $exception->getCode(),
                "message" => $exception->getMessage(),
                "file" => $exception->getFile()];
        }
    }

    public function Update(Usuario $usuario, string $where = null, string $tableName = Tables::USUARIO)
    {
        if (is_null($where))
            $where = " Id = $usuario->id";
        unset($usuario->id);
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
                SET @update_id := 0;
                UPDATE $tableName
                SET $arraySetImplode, Id = (SELECT @update_id := Id)
                WHERE $where ;
                SELECT @update_id;
            ";

        return $this->database->Update($query);
    }
}