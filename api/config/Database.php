<?php
include_once "Configuration.php";

/**
 * @author Frederico Jacobi
 * @version 0.0.5
 * @description Represents the handle method to MySQL database
 * @date 2021/07/15
 * @lastModifiedDate 2021/07/29
 */
class Database extends PDO
{
    public $database;

    public function __construct()
    {
    }

    public function getConnection(): PDO
    {
        try {
            $this->database = new PDO(Configuration::CONNECTION_STRING,
                Configuration::USERNAME,
                Configuration::PASSWORD);
            $this->database->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->database;
    }

    public function Insert(string $query)
    {
        $this->database = $this->getConnection();
        try {
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->database->beginTransaction();
            $this->database->exec($query);
            $lastId = $this->database->lastInsertId();
            $this->database->commit();
        } catch (PDOException $pdoException) {
            $this->database->rollBack();
            return [
                "errorCode" => $pdoException->getCode(),
                "message" => $pdoException->getMessage(),
                "file" => $pdoException->getFile()];
        } finally {

        }
        return $lastId;
    }

    public function Update($query)
    {
        $this->database = $this->getConnection();
        try {
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->database->beginTransaction();
            $return = $this->database->exec($query);
            $this->database->commit();
        } catch (PDOException $pdoException) {
            $this->database->rollBack();
            return json_encode([
                "errorCode" => $pdoException->getCode(),
                "message" => $pdoException->getMessage(),
                "file" => $pdoException->getFile()]);
        } finally {
        }
        return true;
    }

    public function Select(string $sql)
    {
        $this->database = $this->getConnection();
        try {

        } catch (PDOException $pdoException) {
            $this->database->rollBack();
            return json_encode([
                "errorCode" => $pdoException->getCode(),
                "message" => $pdoException->getMessage(),
                "file" => $pdoException->getFile()]);
        } finally {

        }
    }

    public function Delete(string $sql)
    {
        $this->database = $this->getConnection();
        try {
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->database->beginTransaction();
            $this->database->exec($sql);
            $this->database->commit();
        } catch (PDOException $pdoException) {
            $this->database->rollBack();
            return [
                "errorCode" => $pdoException->getCode(),
                "message" => $pdoException->getMessage(),
                "file" => $pdoException->getFile()];
        } finally {

        }
    }
}