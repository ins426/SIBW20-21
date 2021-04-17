<?php
    require_once "./vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $Twig = new \Twig\Environment($loader);

    $conexion = new BD();

    $evento = $conexion->getEvento();
    $imagenes = $conexion->getImagenesEvento();

    echo $Twig->render('evento_imprimir.html',['evento' => $evento,'imagenes' => $imagenes]);
?>