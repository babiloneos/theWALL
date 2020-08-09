<?php
// Conexión a la base de datos
	require_once '../model/Users.php';
	$con = new Users();

	// Iniciar sesión
	session_start();
	if(isset($_SESSION["id_usuario"])){
		// Si trata de entrar a register.php estando logueado, lo manda al dashboard.php
        header("location: dashboard.php");
	}
	require '../views/register.php';
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Valores del formulario de registro

    	$user= $_POST['user'];
		$nombre = $_POST['nombre'];
    	$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$pas = $_POST['pass'];
		$repeatpas = $_POST['repeatpass'];
		$imagen = $_FILES['perfilimagen'];
		$imageType = pathinfo($imagen['name'],PATHINFO_EXTENSION);

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
		try{
			if(!getimagesize($imagen["tmp_name"]) && !($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" )){
				$regexCheck=TRUE;
				$regexLog = $regexLog."Hay un error con la imagen.\\n";
			}
		} catch (Exception $e){
			echo "";
		}

		if($regexCheck){
			echo '<script>alert("'.$regexLog.'");</script>';
			exit("Error en registro");
		} else{
			// echo "<script>console.log('Todo ok con los datos')</script>";
		}
		
		// 2.- Verificamos que usuario y correo no exista antes:
			//Si existe, mostrar alerta
		if($con->idByCamp("nombreusuario",$user)){
			echo '<script>alert("Nombre de usuario no disponible.");</script>';
			exit("Error en registro");
		}
		if($con->idByCamp("email",$email)){
			echo '<script>alert("Ya hay una cuenta con ese correo");</script>';
			exit("Error en registro");
		}
				//Si no existe, Seguir

		// 3.- Registramos usuario	  $usr, $name, $lastname, $mail, $pass, $pic, $picFormat
		$respuesta = $con->registUser($user, $nombre, $apellido, $email, $pas, $imagen['tmp_name'], $imageType);

		// 4.- Alerta de Completo y regresamos a index.php
		if($respuesta){
				 $_SESSION['registro'] = "El registro se ha completado con éxito: inicia sesión.";
			}else{
				$_SESSION['registro'] = "El usuario no se pudo registrar. Intente de nuevo, por favor.";
		}
		
		header('Location: ../index.php');
}
?>