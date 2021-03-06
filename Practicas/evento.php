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

    $evento = $conexion->getEvento();
    $imagenes = $conexion->getImagenesEvento();
    $comentarios = $conexion->getComentariosEvento();
    $galeria = $conexion->getImagenesGaleria();
    $palabras = $conexion->getPalabrasProhibidas();

    $usuario =  $conexion->getUsuario($_SESSION['nickUsuario']);
    $etiquetas = $conexion->getEtiquetas($evento['id']);

    if($usuario['moderador'] == 1 && isset($_GET['comentId']) && $_GET['borrar']  == true){
        $conexion->borrarComentario($_GET['comentId']);
        header("Location: evento.php?ev=" . $_GET['ev']);
    }

    if($usuario['gestor'] == 1 && $_GET['borrar_evento']  == true){
        $conexion->borrarEvento($evento['id']);
        header("Location:portada.php");
    }

    echo $Twig->render('evento.html',['evento' => $evento, 'imagenes' => $imagenes,
    'comentarios' => $comentarios,'galeria'=>$galeria, 'palabras'=>$palabras,'identificado' => $identificado, 'usuario' => $usuario,'etiquetas' => $etiquetas]);
?>