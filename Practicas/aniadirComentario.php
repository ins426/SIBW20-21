<?php
    include("bd.php");

    session_start();
    $conexion = new BD();
    $identificado = false;

    if(isset($_SESSION['identificado'])) {
        $identificado = true;
    }

    $evento = $conexion->getEvento();


    if($identificado) {
        $usuario = $conexion->getUsuario($_SESSION['nickUsuario']);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $identificado) { 
        if(isset($_POST['comentario'])) {
            $comentario = $_POST['comentario'];
            $conexion->aniadirComentario($evento['id'], $usuario['nick'],$usuario['email'], $comentario);

            header("Location: evento.php?ev=".$evento['id']);

            exit();

        }
    }
?>