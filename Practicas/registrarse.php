<?php
    require_once "./vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $Twig = new \Twig\Environment($loader);

    $conexion = new BD();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nick = $_POST['nick'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];

        if($conexion->registrarUsuario($nick,$pass,$email)){
           header("refresh:3;url=login.php");
        }
        else{
           header("Location: registrarse.php");
        }
    }

    echo $Twig->render('registrarse.html', []);
?>