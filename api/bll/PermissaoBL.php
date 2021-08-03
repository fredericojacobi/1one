<?php
require_once "./config/Database.php";
require_once "./config/Tables.php";

class PermissaoBL
{
    public $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function Create(Permissao $permissao, string $tableName = Tables::PERMISSAO)
    {
        unset($permissao->id);
        unset($permissao->dataModificacao);
        unset($permissao->dataCadastro);

        $arrayPermissao = get_object_vars($permissao);
        foreach ($arrayPermissao as $key => $value) {
            if (is_string($value))
                $arrayPermissao[$key] = "'$value'";
        }
        $implodeHeader = implode(", ", array_keys($arrayPermissao));
        $implodeValues = implode(", ", array_values($arrayPermissao));
        $sql = "
            INSERT INTO $tableName ($implodeHeader)
            VALUES
            ( $implodeValues )
        ";
        return $this->database->Insert($sql);
    }

    public function Read($id = null, $tableName = Tables::PERMISSAO)
    {
        $sql = "SELECT * FROM $tableName";
        $this->database = $this->database->getConnection();
        try {
            if (is_numeric($id)) {
                $sql .= " WHERE id = :id";
                $stmt = $this->database->prepare($sql);
                $stmt->execute(['id' => $id]);
            } else{
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

    public function Update(Permissao $permissao, string $where = null, string $tableName = Tables::PERMISSAO)
    {
        if (is_null($where))
            $where = " Id = $permissao->id";
        unset($permissao->dataCadastro);
        unset($permissao->dataModificacao);
        $arrayUsuario = get_object_vars($permissao);
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
}