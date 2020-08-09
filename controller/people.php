<?php
    require_once '../model/MeGusta.php';
    $conMeGusta = new MeGusta();
    require_once '../model/Mensaje.php';
    $conMensaje = new Mensaje();
    require_once '../model/Siguiendo.php';
    $conSiguiendo = new Siguiendo();
    require_once '../model/Users.php';
    $conUsers = new Users();
   
   
    // Iniciar sesión
    session_start();
    if(!isset($_SESSION["id_usuario"])){
        // Si trata de entrar a people.php sin estar logueado, lo manda al login.php
        header("location: login.php");
    }

    $usuario = $_SESSION["id_usuario"];

    $busqueda = NULL;
    if(isset($_GET['busqueda'])){
        $busqueda = $_GET['busqueda'];
    }

    $losusuarios = $conUsers->usersBySearch($busqueda);
    $seguidos = $conSiguiendo->SeguidosPor($usuario);



require '../views/people.php';

?>