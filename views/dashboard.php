<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Inicio</title>
    <link rel="icon" href="../img/Logo.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../css/generic.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="../js/post.js"></script>
</head>
<body class="dashboard ">
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
            <li><a href = "cerrarsesion.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    <section class = "landing">
        <div class = "dark-overlay">
            <div class="landing-inner">
                <div class="PagCont">
                    <form class="publicar" method="POST" action="<?= $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data">
                        <label>Crear Publicacion:</label>
                        <textarea type="text" name='texto' class="toPost" maxlength="140"></textarea>
                        <div class="options">
                            <input type="file" name="unaimagen" class="botonimagen" alt="Sube una foto" accept="image/png,image/gif,image/jpeg">
                            <input type="submit" class="publBtn" value="Publicar" name="publicar">
                        </div>
                    </form>
                    <div class="wall">
                        <?php

                        if($publicacionesMySQL):
                            $count  = 0;
                        foreach ($publicaciones as $publicacion):
                        ?>
                        <div class="post">
                            <div class="profPic">
                                <?= '<img src="data:image/'.$publicacion['foto_tipo'].';base64,'.base64_encode( $publicacion['foto_contenido'] ).'"/>'?>
                            </div>
                            <div class="contPost">
                                <a href="profile.php?id=<?=$publicacion['userid']?>" class="usr"><?=$publicacion["nombreusuario"]?></a>
                                <p class="textPost"><?= $publicacion['texto'];?></p>
                                <div class="imgContenedor">
                             <?php 
                                if($publicacion['imagen_contenido']){
                                echo '<img src="data:image/'.$publicacion['imagen_tipo'].';base64,'.base64_encode( $publicacion['imagen_contenido'] ).'" width="600" />';
                                } 

                                // L I K E / D I S L I K E
                                $esLike = '';
                                if ($megusta[$count]){$esLike = "";} else {$esLike = " fa-heart-o";}

                                // Esto se ejecutara cuando se presione el Like/Dislike
                                // Cambia el Value del input y actualiza valores
                                if(isset($_POST['like'.$count])) {
                                    if ($megusta[$count]){
                                        $esLike = " fa-heart-o";
                                        $res = $conMeGusta->quitarLike($usuario, $publicacion["id"]);
                                        $likesArray[$count] = $conMeGusta->contarLikes($publicacion["id"]);
                                        $megusta[$count] = $conMeGusta->dioLike($usuario, $publicacion["id"]);
                                    } else {
                                        $esLike = "";
                                        $res = $conMeGusta->darLike($usuario, $publicacion["id"]);
                                        $likesArray[$count] = $conMeGusta->contarLikes($publicacion["id"]);
                                        $megusta[$count] = $conMeGusta->dioLike($usuario, $publicacion["id"]);
                                    }
                                }
                                
                            ?>
                            </div>
                                <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
                                    <button type="submit" class="likeBtn" name='like<?= $count?>' class="likeBtn">
                                        <i class="fa fa-heart<?= $esLike;?>" onclick=like(this)><?= " ".$likesArray[$count];?></i>
                                    </button>

                                </form>
                            </div>
                        </div>  
                        <?php
                        $count++;
                        endforeach;
                    else:
                    ?>
                    <div class="alerta"> No se encontraron mensajes en tu muro.</div>
                    <?php endif; 
                    
                        

                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>