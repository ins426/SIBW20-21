<?php
    require_once "./vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $Twig = new \Twig\Environment($loader);

    $identificado = false;
    session_start();

    if(isset($_SESSION['identificado'])){
        $identificado = true;
    }

    $conexion = new BD();
    $evento = $conexion->getEvento();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        $conexion->editarEvento($evento['id']);
        header("Location: evento.php?ev=".$evento['id']);

        exit();      
    }

    echo $Twig->render('editarEvento.html', ['identificado' => $identificado,'evento' => $evento]);
?>