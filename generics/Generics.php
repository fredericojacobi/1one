<?php
require_once "/Users/fredericojacobi/Projetos/1onePHP/api/config/Database.php";
//require "/Users/fredericojacobi/Projetos/1onePHP/generics/Constants.php";

class Generics
{
    public function RemoveEmptyOrNullElements(array $array): array
    {
        return array_filter($array, fn($value) => !is_null($value) && $value !== '');
    }

    /**
     * @param object $array
     * object filled by data to mount insert query
     * @return array|false array on success, false otherwise
     * @author Frederico Jacobi
     * @version 0.0.2
     * @description extract data from objects to mount insert query
     * @since 2021/07/19
     * @lastModifiedDate 2021/07/19
     */

    public function HandleObjectToQueryInsert(array $array)
    {
        $function = new Generics();
        $dataArray = $function->RemoveEmptyOrNullElements($array);
        $columns = array_keys($dataArray);
        $objectValues = array_values($dataArray);
        $implodedHeader = implode(', ', $columns);
        foreach ($objectValues as $key => $value)
            if (!is_numeric($value))
                $objectValues[$key] = "'{$value}'";
        if (empty($implodedHeader) || empty($objectValues))
            return false;
        else
            return
                [
                    "Data" => $objectValues,
                    "Header" => $implodedHeader,
                    "Mask" => $function->MaskData($dataArray, OperationType::INSERT)
                ];
    }

    /**
     * @param object $object
     * object filled by data to mount update query
     * @return array|false array on success, false otherwise
     * @author Frederico Jacobi
     * @version 0.0.1
     * @description extract data from objects to mount update query
     * @since 2021/07/19
     * @lastModifiedDate 2021/07/19
     */

    public function HandleObjectToQueryUpdate(object $object)
    {
        $function = new Generics();
        $dataArray = get_object_vars($object);
        $dataArray = $function->RemoveEmptyOrNullElements($dataArray);
        $arrayReturn = $this->MaskData($dataArray, OperationType::UPDATE);
        if (empty($arrayReturn))
            return false;
        else
            return $arrayReturn;
    }

    public function MaskData(array $arrayData, int $operationType)
    {
        switch ($operationType) {
            case OperationType::INSERT:
                foreach ($arrayData as $key => $value)
                    $arrayData[$key] = "?";
                return $arrayData;
            case OperationType::UPDATE:
                foreach ($arrayData as $key => $value)
                    $arrayData[$key] = "{$key} = ?";
                return $arrayData;
            case OperationType::DELETE:
                return false;
            default:
                return false;
        }
    }

    public function HandleInput(string $inputData)
    {
        $inputData = strip_tags($inputData);
        $inputData = htmlspecialchars($inputData);
        $inputData = stripslashes($inputData);
        $inputData = trim($inputData);
        return $inputData;
    }

    public function DateBrToUS(string $date)
    {
        return DateTime::createFromFormat("d/m/Y", $date)->format("Y-m-d");
    }

    public function Redirect(string $url)
    {
        if (empty($url)) {
            header("/error");
            die();
        } else {
            header($url);
            die();
        }
    }

    public function PostMethod($url, $model)
    {
        if (empty($url) || empty($model)) {

        } else {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($model));
            //curl_setopt($curl, CURLOPT_HTTPHEADER, [
            //    'X-RapidAPI-Host: kvstore.p.rapidapi.com',
            //    'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
            //    'Content-Type: application/json'
            //]);
            $response = curl_exec($curl);
            curl_close($curl);

            echo $response . PHP_EOL;

        }
    }

    public function GetMethod($url)
    {
        if (empty($url)) {
            echo json_encode([
               'Message' => 'Url nao encontrada'
            ]);
        } else {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // ** HEADERS **
//            curl_setopt($curl, CURLOPT_HTTPHEADER, [
//                'Content-Type: application/json'
//            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            echo $response . PHP_EOL;
        }
    }

    public function PutMethod($url, $usuarioModel){
        if(empty($url)){
            echo json_encode([
               'Message' => 'Url nao encontrada'
            ]);
        } else {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($usuarioModel));
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
//                'X-RapidAPI-Host: kvstore.p.rapidapi.com',
//                'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                'Content-Type: application/json'
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            echo $response . PHP_EOL;
        }
    }
}