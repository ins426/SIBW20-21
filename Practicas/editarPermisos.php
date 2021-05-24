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
    $usuarios = $conexion->getUsuarios();

    if(isset($_GET['nombre']) && isset($_GET['moderador'])){
        $opcion = 'moderador';
        $conexion->editarPermisos($_GET['nombre'],$opcion,$_GET['moderador']);
        header("Location: editarPermisos.php");
    }

    if(isset($_GET['nombre']) && isset($_GET['gestor'])){
        $opcion = 'gestor';
        $conexion->editarPermisos($_GET['nombre'],$opcion,$_GET['gestor']);
        header("Location: editarPermisos.php");
    }

    if(isset($_GET['nombre']) && isset($_GET['super'])){
        $opcion = 'super';
        $conexion->editarPermisos($_GET['nombre'],$opcion,$_GET['super']);
        header("Location: editarPermisos.php");
    }

    echo $Twig->render('editarPermisos.html',['identificado' => $identificado,'usuario'=>$usuario,'usuarios'=>$usuarios]);
?>