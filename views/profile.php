<!doctype html>
<html lang="en">
<?php
	
	require_once '../model/MeGusta.php';
    $conMeGusta = new MeGusta();
    require_once '../model/Mensaje.php';
    $conMensaje = new Mensaje();
    require_once '../model/Siguiendo.php';
    $conSiguiendo = new Siguiendo();
    require_once '../model/Users.php';
    $conUsers = new Users();
    ?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Mi Perfil</title>
  <link rel="icon" href="../img/Logo.ico" type="image/x-icon"/>
  <link rel="stylesheet" type="text/css" href="../css/header.css" />
  <link rel="stylesheet" type="text/css" href="../css/myprofile.css" />
  <link rel="stylesheet" type="text/css" href="../css/generic.css" />
  <link rel="stylesheet" href="../css/people.css">
  <link rel="stylesheet" href="../css/dashboard.css">

  <script src="../js/people.js"></script>
  <script src="../js/post.js"></script>
</head>

<body>
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
					
					<div class="detalles">
						<div class="perfil">
							<div class="profPic">
							<?php 
									if($susdatos['foto_contenido']){
									echo '<img src="data:image/'.$susdatos['foto_tipo'].';base64,'.base64_encode( $susdatos['foto_contenido'] ).'" width="600" />';
									} ?>
							</div>
						
							<div class="names">
								<h2><?= $susdatos['nombre']." ".$susdatos['apellido'];?></h2>
								<h3><?= $susdatos['nombreusuario'];?></h3>
							</div>
						</div>
		
						<hr>
						<div class="siguiendo">

							<?php
								
								if(!empty($usuariosquesigue) && mysqli_num_rows($usuariosquesigue)>=1):
								$count = 0;
								foreach ($usuariosquesigue as $unusuario):		
								?>
								<div class="person">
									<div class="profPic">
									<?php 
										if($unusuario['foto_contenido']){
										echo '<img src="data:image/'.$unusuario['foto_tipo'].';base64,'.base64_encode( $unusuario['foto_contenido'] ).'" width="100" />';
										} ?>
									</div>
									<div class="description">
										<a href="profile.php?id=<?= $unusuario['id']?>" class="usr_name"><?= $unusuario['nombre']." ".$unusuario['apellido'];?></a>
										<p class="usr"><?= $unusuario['nombreusuario'];?></p>
									</div>
                                    
                                    

                                    <?php 

                                	$estaSiguiendo = '';
                                	// $busca['id']
                                	if (in_array($unusuario['id'], $seguidosME)){
                                	    $estaSiguiendo = " unfollowButton";
                                	    $estatus = "Dejar de seguir";
                                	} else {
                                	    $estaSiguiendo = "";
                                	    $estatus = "Seguir";
                                	}
								
									if(isset($_POST['seguir'.$count])){
                                	    // Si lo sigue
                                	    if(in_array($unusuario['id'], $seguidosME)){
                                	        $estaSiguiendo = "";
                                	        $estatus = "Seguir";
                                	        $res1 = $conSiguiendo->dejarDeSeguir($usuario, $unusuario['id']);
                                	    // Si no
                                	    } else {
                                	        $estaSiguiendo = " unfollowButton";
                                	        $estatus = "Dejar de seguir";
                                	        $res1 = $conSiguiendo->seguirA($usuario, $unusuario['id']);
                                	    }
									} ?>

                            		<form action="profile.php?id=<?= $susdatos['id']?>" method="POST" class="follow">
										<button type="submit" class="followButton<?= $estaSiguiendo ?>" onclick=follow(this) name="seguir<?=$count?>"><?= $estatus?></button>   
									</form>


									
								</div>
								<?php
								$count++;
								endforeach;
							else:
							?>
							<div class="alerta"> No sigue a ningún usuario aún!</div>
							<?php endif;  ?>
							</div>
							<span style="display: flex;">
							</span>
					</div>
					<div class="publicaciones">

								<?php
								$loSigues = '';
								if (in_array($unuser, $seguidosME)){
									$loSigues = " unfollowButton";
									$estatus = "Dejar de seguir";
								} else {
									$loSigues = "";
									$estatus = "Seguir";
								}

								if(isset($_POST['seguir'.$count])){
                                    // Si lo sigue
                                    if(in_array($unuser, $seguidosME)){
                                        $loSigues = "";
                                        $estatus = "Seguir";
                                        $res1 = $conSiguiendo->dejarDeSeguir($usuario, $unuser);
                                    // Si no
                                    } else {
                                        $loSigues = " unfollowButton";
                                        $estatus = "Dejar de seguir";
                                        $res1 = $conSiguiendo->seguirA($usuario, $unuser);
                                    }
								} ?>

                            <form action="profile.php?id=<?= $susdatos['id']?>" method="POST" class="follow">
								<button type="submit" class="followButton <?= $loSigues ?>" onclick=follow(this) name="seguir<?=$count?>"><?= $estatus?></button>   
							</form>

						<div class="wall">
                        <?php		
                        	 
							$count  = 0;
							if($suspublis):	
								foreach ($suspublis as $publi):			
									
						?>
							<div class="post">
								<div class="profPic">
									<?php 
										if($susdatos['foto_contenido']){
										echo '<img src="data:image/'.$susdatos['foto_tipo'].';base64,'.base64_encode( $susdatos['foto_contenido'] ).'" width="600" />';
									} ?>
								</div>
								<div class="contPost">
									<a href="profile.php?id=<?=$unuser?>" class="usr"><?= $susdatos['nombreusuario'];?></a>
									<p class="textPost"><?= $publi['texto'];?></p>

									 <div class="imgContenedor">
											<?php 
											
										      if($publi['imagen_contenido']){
												echo '<img src="data:image/'.$publi['imagen_tipo'].';base64,'.base64_encode( $publi['imagen_contenido'] ).'" width="600" />';
												} 

													// L I K E / D I S L I K E
													$esLike = '';
													if ($megusta[$count]){$esLike = "";} else {$esLike = " fa-heart-o";}
					
													// Esto se ejecutara cuando se presione el Like/Dislike
													// Cambia el Value del input y actualiza valores
													if(isset($_POST['like'.$count])) {
														if ($megusta[$count]){
															$esLike = " fa-heart-o";
															$res = $conMeGusta->quitarLike($usuario, $publi["id"]);
															$likesArray[$count] = $conMeGusta->contarLikes($publi["id"]);
															$megusta[$count] = $conMeGusta->dioLike($usuario, $publi["id"]);
														} else {
															$esLike = "";
															$res = $conMeGusta->darLike($usuario, $publi["id"]);
															$likesArray[$count] = $conMeGusta->contarLikes($publi["id"]);
															$megusta[$count] = $conMeGusta->dioLike($usuario, $publi["id"]);
														}
													}
													
												?>
												</div>
													<form action="profile.php?id=<?= $susdatos['id']?>" method="POST">
														<button type="submit" class="likeBtn" name='like<?= $count?>' class="likeBtn">
															<i class="fa fa-heart<?= $esLike;?>"><?= " ".$likesArray[$count];?></i>
														</button>
					
													</form>
												</div>
									</div>

							</div>  
							<?php
							$count++;
							
							endforeach;
						else:
							?>							
							<div class="alerta"> No se encontraron mensajes en el muro.</div>
							<?php endif; ?>	
					</div>				
				</div>
			</div>
	
  		</section>
	</body>
</html>