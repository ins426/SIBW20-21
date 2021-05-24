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

    $conexion->buscarEvento($palabra);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $eventos = $conexion->buscarEvento($_POST['palabra']);

        if($eventos == NULL){
            $eventos = $conexion->getEventos();
            header("url=listaEventos.php");
        }else{
            header("url=listaEventos.php");
        }
    }
    else{
        $eventos = $conexion->getEventos();
    }

    echo $Twig->render('listaEventos.html',['identificado' => $identificado,'eventos' => $eventos,'usuario'=>$usuario]);
?>