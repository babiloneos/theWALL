<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Configuración</title>
    <link rel="icon" href="../img/Logo.ico" type="image/x-icon"/>
    <link rel = "stylesheet" type = "text/css" href = "../css/header.css"/> 
    <link rel = "stylesheet" type = "text/css" href = "../css/editProfile.css"/>
    <link rel = "stylesheet" type = "text/css" href = "../css/generic.css"/> 
    <script src="../js/editProfile.js"></script>
  </head>
  <body>
    <nav class = "navbar">
        <h1>
            <a href = "dashboard.php">
                <img src="../img/Logo.ico" alt="Logo" class="imgLoged">
                theWALL
            </a>
        </h1>

        <ul class="links">
            
            <li><a href = "dashboard.php">Inicio</a></li>
            <li><a href = "myprofile.php">Perfil</a></li>
            <li><a href = "cerrarsesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
   <!--------------------------------->
  
   <section class = "landing">
    <div class = "dark-overlay">
        <div class="landing-inner">
          <div class="confSpace">
          <?= '<img src="data:image/'.$UsuarioDatos['foto_tipo'].';base64,'.base64_encode( $UsuarioDatos['foto_contenido'] ).'" alt="profPic" class="profPic"/>'?>
            <h1 class = "x-large">Configuración</h1>
            <?php
                if(isset($_SESSION['log_cuenta'])){
                    echo ($_SESSION['log_cuenta']);
                    $_SESSION['log_cuenta'] = "";
                }
            ?>
            <div class="internal">
              <form class="campo" method="post" action="" onsubmit="return validarPerfil()" enctype="multipart/form-data">
                <h3>Perfil</h3>

                  <input type="text" name="user" placeholder="Nombre de Usuario" id="usr_name" class="imputtext" value="<?= $UsuarioDatos['nombreusuario'] ?>">

                  <input type="text" name="nombre" placeholder="Nombre" id="name" class="imputtext" value="<?= $UsuarioDatos['nombre'] ?>">
                        
                  <input type="text" name="apellido" placeholder="Apellido" id="apellido" class="imputtext" value="<?= $UsuarioDatos['apellido'] ?>">
              
                  <label for="circulo">Cambiar foto de perfil</label>
                  <br>
                  <input type="file" accept="image/png,image/gif,image/jpeg" name="perfilimagen" class="perfil" id="fileChooser">
                  <input class="boton" type="submit" value = "Guardar" name="perfil"/>
              </form>
              <div class="divisor"></div>
              <form action="" class="campo" method="POST" onsubmit="return validarCuenta()">
                <h3>Cuenta</h3>
                <input type="text" class = "inputtext" name="email" id="email" placeholder="Email" value="<?= $cuentaDatos['email'] ?>"><br>
                <label for="pass">Cambiar contraseña</label>
                 <br> 
                <input type="password" placeholder="Contraseña" name="pass" id="passwd" class="imputtext" value="<?= $cuentaDatos['contrasenia'] ?>">  
                <input type="password" placeholder="Repetir Contraseña" name="repeatpass" id="confirmpasswd" class="imputtext" value="<?= $cuentaDatos['contrasenia'] ?>">
                <input class="boton" type="submit" value = "Guardar" name="cuenta"/>
              </form>
            </div>
          </div>
        </div>
    </div>
</section>
</body>


</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>