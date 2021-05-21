<?php
    require_once "./vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $Twig = new \Twig\Environment($loader);

    session_start();
    $conexion = new BD();
    $identificado = false;

    if(isset($_SESSION['identificado'])){
        $identificado = true;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conexion->aniadirEvento();
        header("refresh:0.3;url=portada.php");

        exit();
    }

    echo $Twig->render('aniadirEvento.html',['identificado' => $identificado]);
?>