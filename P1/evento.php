<?php
    require_once "./vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $Twig = new \Twig\Environment($loader);

    $conexion = new BD();

    $evento = $conexion->getEvento();
    $imagenes = $conexion->getImagenesEvento();
    $comentarios = $conexion->getComentariosEvento();

    echo $Twig->render('evento.html',['evento' => $evento, 'imagenes' => $imagenes,'comentarios' => $comentarios]);
?>