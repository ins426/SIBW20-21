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

    $usuario_anterior =  $conexion->getUsuario($_SESSION['nickUsuario']);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nick = $_POST['nick'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $res = $conexion->editarUsuario($nick,$email,$pass,$usuario_anterior);

        if($res == false){
            echo'<script type="text/javascript">
                alert("Error, ya existe un usuario con ese nombre");
                </script>';
        }else{
            if($nick != NULL){
                $_SESSION['nickUsuario'] = $nick;
            }
            header("refresh:0.3;url=perfil.php");
        }

    }

    $usuario =  $conexion->getUsuario($_SESSION['nickUsuario']);

    echo $Twig->render('editar_perfil.html',['identificado' => $identificado, 'usuario' => $usuario]);
?>