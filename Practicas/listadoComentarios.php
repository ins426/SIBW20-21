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

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $comentarios = $conexion->buscaComentarios($_POST['autor']);

        if($comentarios == NULL){
            $comentarios =  $conexion->getComentarios();
            header("url=listadoComentarios.php");
        }else{
            header("url=listadoComentarios.php");
        }
    }
    else{
        $comentarios =  $conexion->getComentarios();
    }

    $eventos = $conexion->getEventos();

    $usuario =  $conexion->getUsuario($_SESSION['nickUsuario']);

    if($usuario['moderador'] == 1 && isset($_GET['comentId']) && $_GET['borrar']  == true){
        $conexion->borrarComentario($_GET['comentId']);
        header("Location: listadoComentarios.php");
    }

    echo $Twig->render('listadoComentarios.html',['identificado' => $identificado,'comentarios' => $comentarios,'usuario'=>$usuario,'eventos'=>$eventos]);
?>