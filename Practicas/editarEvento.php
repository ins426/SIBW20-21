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

    echo $Twig->render('editarEvento.html', ['identificado' => $identificado]);
?>