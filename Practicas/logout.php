<?php
    require_once "./vendor/autoload.php";

    session_start();
    session_destroy();
    header("refresh:1;url=portada.php");
    
    exit();
?>