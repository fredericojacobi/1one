<?php
require_once "./config/Database.php";
require_once "./config/Tables.php";

/**
 * @author Frederico Jacobi
 * @version 0.0.1
 * @description Business logic class to handle Servico's requests
 * @date 2021/07/29
 * @lastModifiedDate 2021/07/29
 */
class ServicoBL
{
    public $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function Create(Servico $servico, string $tableName = Tables::SERVICO)
    {
        unset($servico->id);
        unset($servico->dataModificacao);
        $dateTime = new DateTime('now');
        $dateTime->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        $servico->dataCadastro = $dateTime->format('Y-m-d H:i:s');
        $arrayServico = get_object_vars($servico);
        foreach ($arrayServico as $key => $value) {
            if (is_string($value))
                $arrayServico[$key] = "'$value'";
        }
        $implodeHeader = implode(", ", array_keys($arrayServico));
        $implodeValues = implode(", ", array_values($arrayServico));
        $sql = "
            INSERT INTO $tableName ($implodeHeader)
            VALUES
            ( $implodeValues )
        ";
        return $this->database->Insert($sql);
    }

    public function Read($id = null, $tableName = Tables::SERVICO)
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

    public function Update(Servico $servico, string $where = null, string $tableName = Tables::SERVICO)
    {
        if (is_null($where))
            $where = " Id = $servico->id";
        unset($servico->id);
        unset($servico->dataCadastro);
        $dateTime = new DateTime('now');
        $dateTime->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        $servico->dataModificacao = $dateTime->format('Y-m-d H:i:s');
        $arrayServico = get_object_vars($servico);
        $arraySet = [];
        foreach ($arrayServico as $key => $value) {
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