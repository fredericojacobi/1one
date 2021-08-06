<?php
require "../api/config/Configuration.php";
if(strlen($_SERVER['REQUEST_URI']) > 1){
    header("Location: /src/views{$_SERVER['PATH_INFO']}.php?{$_SERVER['QUERY_STRING']}");
    die();
} else {
    header("Location: src/views/home/home.php");
    die();
}
?>