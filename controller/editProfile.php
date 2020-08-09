<?php
// Iniciar sesión 
session_start();
if(!isset($_SESSION["id_usuario"])){
    // Si trata de entrar a editProfile.php sin estar logueado, lo manda al login.php
    header("location: login.php");
}

require_once '../model/Users.php';
    $conUsers = new Users();
    $UsuarioDatos = $conUsers->contenidoById($_SESSION['id_usuario']);
    $cuentaDatos = $conUsers->cuentaById($_SESSION['id_usuario']); 
    // print_r($UsuarioDatos['nombreusuario']);


if(isset($_POST['perfil'])){
    $user= $_POST['user'];
	$nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $regexCheck=FALSE;
    $regexLog="";
    
    // 1.- validar que inputs tengan formato solicitado

		if (!preg_match("/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/", $user)){
			$regexCheck=TRUE;
			$regexLog = $regexLog."Nombre de usuario incorrecto.\\n";
		}
		if (!preg_match("/^[A-Za-z]+(?:[ _-][A-Za-z]+)*$/", $nombre)){
			$regexCheck=TRUE;
			$regexLog = $regexLog."Formato de nombre incorrecto.\\n";
		}
		if (!preg_match("/^[A-Za-z]+(?:[ _-][A-Za-z]+)*$/", $apellido)){
			$regexCheck=TRUE;
			$regexLog = $regexLog."Formato de apellido incorrecto.\\n";
        }

        // Si se cargo alguna imagen, entonces verificamos que sea valida.
        if($_FILES['perfilimagen']['size'] != 0){
            $imagen = $_FILES['perfilimagen'];
            $imageType = pathinfo($imagen['name'],PATHINFO_EXTENSION);
            try{
                if(!getimagesize($imagen["tmp_name"]) && !($imageType == "jpg" || $imageType == "png" || $imageType == "jpeg" || $imageType == "gif" )){
                    $regexCheck=TRUE;
                    $regexLog = $regexLog."Hay un error con la imagen.\\n";
                }
            } catch (Exception $e){
                echo "";
            }
        // Si no se cargo ninguna imagen, entonces inicializamos valores a NULL
        } else {
            $imagen['tmp_name'] = NULL;
            $imageType = NULL;
        }

        // Si se capturo algun error en las expresiones regulares, paramos todo y alertamos.
		if($regexCheck){
			echo '<script>alert("'.$regexLog.'");</script>';
			exit("Error en datos");
		}

        // 2.- validar que el username este disponible:
                //Si el username esta usado en la bd y no pertenece a el usuario logueado
                // entonces alertar.
                //En otro caso, continuar.
        $idsConUsername = $conUsers->idByCamp('nombreusuario', $user);
        if(sizeof($idsConUsername) > 0 && !in_array($_SESSION['id_usuario'], $idsConUsername)){
            echo '<script>alert("El nombre de usuario ya está siendo ocupado por alguien más.");</script>';
            $_SESSION['log_cuenta'] = "Nombre de usuario no disponible";
        }else {
            
            // 3.- Registramos usuario	  $usr, $name, $lastname, $mail, $pass, $pic, $picFormat
            $respuesta = $conUsers->updatePerfil($user, $nombre, $apellido, $imagen['tmp_name'], $imageType, $_SESSION['id_usuario']);
    
            // 4.- Alerta de Completo y regresamos a index.php
            if($respuesta){
                $_SESSION['log_cuenta'] = "Los cambios están hechos.";
           }else{
               $_SESSION['log_cuenta'] = "No se pudieron realizar los cambios. Intenta más tarde.";
            }
        }
}

if(isset($_POST['cuenta'])){
    $email = $_POST['email'];
	$pas = $_POST['pass'];
    $repeatpas = $_POST['repeatpass'];
    $regexCheck=FALSE;
    $regexLog="";
    $queryRes=True;
    $queryLog="";
    
    // 1.- validar que inputs tengan formato solicitado
	if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)){
		$regexCheck=TRUE;
        $regexLog = $regexLog."Email no valido.\\n";
	}
	if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/", $pas)){
		$regexCheck=TRUE;
		$regexLog = $regexLog."Password poco segura.\\n";
	}
	if ($repeatpas != $pas){
		$regexCheck=TRUE;
		$regexLog = $regexLog."Los passwords no son iguales.\\n";
    }
    
    if($regexCheck){
        echo '<script>alert("'.$regexLog.'");</script>';
        exit("Error en registro");
    } else{
        // echo "<script>console.log('Todo ok con los datos')</script>";
    }

    // 3.- Registramos usuario	  $usr, $name, $lastname, $mail, $pass, $pic, $picFormat
	$respuesta = $conUsers->updateCuenta($email, $pas, $_SESSION['id_usuario']);
    
    // 4.- Alerta de Completo y regresamos a index.php
	if($respuesta){
			 $_SESSION['log_cuenta'] = "Los cambios están hechos.";
		}else{
			$_SESSION['log_cuenta'] = "No se pudieron realizar los cambios. Intenta más tarde.";
	}
}

require '../views/editProfile.php';

?>