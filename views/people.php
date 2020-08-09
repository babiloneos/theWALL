<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Resultados de busqueda</title>
    <link rel="icon" href="../img/Logo.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../css/generic.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/people.css">
    <script src="../js/people.js"></script>
</head>
<body class="people">
    <!-- Barra superior -->
    <nav class = "navbar">
        <h1>
            <a href = "dashboard.php">
                <img src="../img/Logo.ico" alt="Logo" class="imgLoged">
                theWALL
            </a>
        </h1>

        <form class="search" action="people.php" method="GET">
            <input type="text" name="busqueda" class="searchTerm" placeholder="¿Busca a alguien?">
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
         </form>

        <ul class="links">
            
            <li><a href = "dashboard.php">Inicio</a></li>
            <li><a href = "myprofile.php">Perfil</a></li>
            <li><a href = "cerrarsesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <!-- ~~~~~ o ~~~~~ -->


    <section class = "landing">
        <div class = "dark-overlay">
            <div class="landing-inner">
                <div class="resultados"> 
                    <?php
                    
                    if(!empty($losusuarios) && mysqli_num_rows($losusuarios)>=1):
                        $count = 0;
                        while ($busca = mysqli_fetch_assoc($losusuarios)):

                    ?>

                    
                        <div class="person">
                            <div class="profPic">
                            <?= '<img src="data:image/'.$busca['foto_tipo'].';base64,'.base64_encode( $busca['foto_contenido'] ).'" alt="Foto de perfil"/>'?>
                            </div>
                            <div class="description">
                                <a href="profile.php?id=<?=$busca['id']?>" class="usr_name"><p><?=$busca['nombreusuario']?></p></a>
                                <p class="usr"><?= $busca['nombre'].' '.$busca['apellido']?></p>
                            </div>
                                <?php 

                                $estaSiguiendo = '';
                                // $busca['id']
                                if (in_array($busca['id'], $seguidos)){
                                    $estaSiguiendo = " unfollowButton";
                                    $estatus = "Dejar de seguir";
                                } else {
                                    $estaSiguiendo = "";
                                    $estatus = "Seguir";
                                }
                                
								if(isset($_POST['seguir'.$count])){
                                    // Si lo sigue
                                    if(in_array($busca['id'], $seguidos)){
                                        $estaSiguiendo = "";
                                        $estatus = "Seguir";
                                        $res1 = $conSiguiendo->dejarDeSeguir($usuario, $busca['id']);
                                    // Si no
                                    } else {
                                        $estaSiguiendo = " unfollowButton";
                                        $estatus = "Dejar de seguir";
                                        $res1 = $conSiguiendo->seguirA($usuario, $busca['id']);
                                    }
								} ?>

                            <form action="../controller/people.php?busqueda=<?=$busqueda?>" method="POST" class="follow">
								<button type="submit" class="followButton<?= $estaSiguiendo ?>" onclick=follow(this) name="seguir<?=$count?>"><?= $estatus?></button>   
							</form>
                            
                        </div>
                        <?php
                        $count++;
                        endwhile;
                    else:
                    ?>
                    <div class="alerta"> No se encontraron usuarios relacionados con su búsqueda.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>