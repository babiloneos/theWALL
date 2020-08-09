<?php session_start(); 
    if(isset($_SESSION["id_usuario"])){
        // Si trata de entrar a dashboard.php sin estar logueado, lo manda al login.php
        header("location: controller/dashboard.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Index</title>
    <link rel="icon" href="./img/Logo.ico" type="image/x-icon"/>
    <link rel = "stylesheet" type = "text/css" href = "./css/header.css"/> 
    <link rel = "stylesheet" type = "text/css" href = "./css/index.css"/>
    <link rel = "stylesheet" type = "text/css" href = "./css/generic.css"/> 
  </head>
  <body>
    <nav class = "navbar">
        <h1>
            <a href = "index.php">
                <img src="./img/Logo.ico" alt="Logo">
                theWALL
            </a>
        </h1>

        <form class="search" action="people.php" method="GET">
            <input type="text" name="busqueda" class="searchTerm" placeholder="¿Busca a alguien?">
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
         </form>

        <ul>
            <li><a href = "controller/register.php">Registrarse</a></li>
            <li><a href = "controller/login.php">Iniciar Sesión</a></li>
        </ul>
    </nav>

    <!-- ^^^^^^^^^^^^ -->

    <section class = "landing">
        <div class = "dark-overlay">
            <div class="landing-inner">
                <img src="./img/Logo.png" alt="Logo"class="logoMed">
                <h1 class = "x-large">theWALL</h1>
                <p class="lead">
                   La red social que revolucionará el planeta
                </p>
                <div class="buttons">
                    <a href="controller/register.php" class = "btn btn-primary">Registrate</a>
                    <a href="controller/login.php" class = "btn btn-light">Inicia Sesión</a>
                </div>      
                <?php
                        if(isset($_SESSION['registro'])){
                            echo ($_SESSION['registro']);
                        }
                ?>
            </div>
        </div>

    </section>
</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>