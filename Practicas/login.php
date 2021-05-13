<?php
    require_once "./vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $Twig = new \Twig\Environment($loader);

    $conexion = new BD();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nick = $_POST['nick'];
        $pass = $_POST['pass'];

        if($conexion->checkLogin($nick,$pass)){
            session_start();
            $_SESSION['nickUsuario'] = $nick;
            $_SESSION['identificado'] = 1;

            header("refresh:1;url=portada.php");
        }
        else{
            header("Location: login.php");
        }
    }

    echo $Twig->render('login.html', []);
?>