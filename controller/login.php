<?php

    require '../model/Users.php';

    $con = new Users();

    require '../views/login.php';

    // Iniciar sesión
    session_start();
    if(isset($_SESSION["id_usuario"])){
        // Si trata de entrar a login.php estando ya logueado, lo regresa al dashboard
        header("location: dashboard.php");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = $_POST['user'];
        $password = $_POST['pass'];

        // $login = $con->loguinUser($usuario, password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]));
        $login = $con->loginUser($usuario, $password); //Este solo lo usaré mientras configuro bien todo

        if($login){
            $_SESSION["id_usuario"]=$login;
            echo "<script>console.log('-----------".$_SESSION["id_usuario"]."')</script>";
            header("location: dashboard.php");
        } else {
            echo '<script>alert("Error. No se pudo iniciar sesion");</script>';
        }
    }



?>