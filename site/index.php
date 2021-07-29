<?php
require "../api/config/Configuration.php";

switch ($_SERVER["REQUEST_URI"]) {
    case "/home":
        header('Location: /src/views/home/home.php');
        die();
    case "/cadastro":
        header('Location: /src/views/cadastro/cadastro.php');
        die();
    case "/cliente":
        header('Location: /src/views/pesquisar/cliente.php');
        die();
    default:
        header('Location: /src/views/home/home.php');
        die();
}
?>