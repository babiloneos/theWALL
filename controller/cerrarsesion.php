<?php
session_start();
if(!isset($_SESSION["id_usuario"])){
    // Si trata de entrar a cerrarsession.php sin estar logueado
    header("location: login.php");
}

// Destruimos la sesion
session_unset();
session_destroy();

// Regresamos al index
header("location: ../index.php");

?>



