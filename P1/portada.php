<?php
    require_once "./vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $Twig = new \Twig\Environment($loader);
    
    $conexion = new BD();

    $eventos = [];
    $eventos = $conexion->getEventos();
    
    echo $Twig->render('portada.html',['eventos' => $eventos]);
?>
