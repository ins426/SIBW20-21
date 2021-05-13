<?php
    require_once "./vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $Twig = new \Twig\Environment($loader);
    
    $conexion = new BD();
    $identificado = false;
    session_start();

    if(isset($_SESSION['identificado'])){
        $identificado = true;
    }

    $eventos = [];
    $eventos = $conexion->getEventos();
    
    echo $Twig->render('portada.html',['eventos' => $eventos, 'identificado' => $identificado]);
?>
