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
    // Si trata de entrar a profile.php sin estar logueado, lo manda al login.php
    header("location: login.php");
}
if($_GET['id']){
    $unuser = $_GET['id'];
}
$usuario = $_SESSION["id_usuario"];

// Obtener mi lista de mensajes:
$suspublis = $conMensaje-> getMisPubli($unuser);

$suspublis2 = $suspublis;

// 2. Obtener lista de personas a las que sigue
$seguidos = $conSiguiendo->SeguidosPor($unuser);
$seguidosME = $conSiguiendo->SeguidosPor($usuario);

$susdatos = $conUsers->contenidoById($unuser);


$usuariosquesigue = $conSiguiendo->getDatosSeguidos($seguidos);


// 3. Obtener lista de 50 publicaciones más recientes de personas a quienes sigue
//      Esto tambien devuelve nombre, apellido, user name y profilPic.
$publicaciones = array();
$likesArray = array();
$megusta = array();

// 3.5. Obtener datos basicos de usuarios a los que sigue 
$users = array();

//Esto nos da como resultado una matriz. el primer [] es el numero de la pub, 
// y el segundo [] seria el contenido de la publicacion
// ej. $publicaciones[0]["texto"]
if ($suspublis2){
    while($row = $suspublis2->fetch_assoc()) {
        $publicaciones[] = $row;
    }

// 4. Obtener likes de las publicaciones obtenidas en un array espejo de las publicaciones
//      y si el usuario dio like
    foreach($publicaciones as $publicacion){
        $likesArray[] = $conMeGusta->contarLikes($publicacion["id"]);
        $megusta[] = $conMeGusta->dioLike($unuser, $publicacion["id"]);
    }
} 

require '../views/profile.php';

?>