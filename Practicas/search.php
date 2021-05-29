<?php
    include("bd.php");

    $conexion =  new BD();
    session_start();

    $usuario =  $conexion->getUsuario($_SESSION['nickUsuario']);
    $eventos = $conexion->buscarEvento($_GET['palabra'],$usuario);

    echo(json_encode($eventos));
    return json_encode($eventos);

?>