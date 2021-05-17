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
    $comentario = $conexion->getComentario($_GET['cm']);

    $usuario =  $conexion->getUsuario($_SESSION['nickUsuario']);

    $palabras = $conexion->getPalabrasProhibidas();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        if(isset($_POST['comentario'])) {
            $comentario_texto = $_POST['comentario'];
   
            $conexion->editarComentario($_GET['cm'], $comentario_texto);
            header("Location: evento.php?ev=".$comentario['id_ev']);

            exit();

        }
    }

    echo $Twig->render('editarComentario.html',['comentario' => $comentario,'palabras' => $palabras,'identificado' => $identificado]);
?>