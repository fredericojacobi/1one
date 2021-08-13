<?php
require "../../../../api/models/Servico.php";
require "../../../../generics/Generics.php";
require "../../../../generics/Constants.php";

$method = $_SERVER['REQUEST_METHOD'];
$generics = new Generics();
switch ($method) {
    case 'POST':
        if (empty($_POST)){
            $generics->Redirect("/servico");
        }
        $servicoModel = new Servico(
            $_POST['Id_Usuario'],
            $_POST['TipoServico'],
            $_POST['Titulo'],
            $_POST['DescricaoCurta'],
            $_POST['DescricaoLonga'],
            $_POST['ValorDesejado'],
            $_POST['DataExpiracao']);

        $url = Constants::API_URL . 'servico.php';
        return $generics->PostMethod($url, $servicoModel);

    case 'GET':
        if (empty($_GET))
            $generics->Redirect("/anuncio/cadastro");
        if ($_GET['id'])
            $url = Constants::API_URL . "servico.php?id=" . $_GET['id'];
        else
            $url = Constants::API_URL . "servico.php";

        echo $generics->GetMethod($url);
        return;
}