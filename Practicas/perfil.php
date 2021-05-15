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

    $usuario =  $conexion->getUsuario($_SESSION['nickUsuario']);
    
    echo $Twig->render('perfil.html',['identificado' => $identificado, 'usuario' => $usuario]);
?>