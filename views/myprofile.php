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
									if($misdatos['foto_contenido']){
									echo '<img src="data:image/'.$misdatos['foto_tipo'].';base64,'.base64_encode( $misdatos['foto_contenido'] ).'" width="600" />';
									} ?>
							</div>
						
							<div class="names">
								<h2><?= $misdatos['nombre']." ".$misdatos['apellido'];?></h2>
								<h3><?= $misdatos['nombreusuario'];?></h3>
							</div>
						</div>
		
						<hr>
						<div class="siguiendo">

							<?php
								
								if(!empty($usuariosquesigo) && mysqli_num_rows($usuariosquesigo)>=1):
								$count = 0;
								foreach ($usuariosquesigo as $unusuario):		
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
									if(isset($_POST['seguir'.$count])){
										$res1 = $conSiguiendo->dejarDeSeguir($usuario, $unusuario['id']);
											} ?>

									<div class="follow">
									<form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
										<button type="submit" class="followButton unfollowButton" onclick=follow(this) name="seguir<?= $count?>">Dejar de seguir</button>   
									</form>
									</div>
									
								</div>
								<?php
								$count++;
								endforeach;
							else:
							?>
							<div class="alerta"> No sigues a ningún usuario aún!</div>
							<?php endif;  ?>
							</div>
							<span style="display: flex;">
							<div style="display: flex;" class="editProfile">
								<a href="editProfile.php?id=<?=$usuario?>"><button class="editProfBtn" >Editar Perfil</button></a>
							</div>
							</span>
					</div>
					<div class="publicaciones">
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
															
											
							
										 
							$count  = 0;
						if($mispublis):	
							foreach ($mispublis as $publi):			
									
						?>
							<div class="post">
								<div class="profPic">
									<?php 
										if($misdatos['foto_contenido']){
										echo '<img src="data:image/'.$misdatos['foto_tipo'].';base64,'.base64_encode( $misdatos['foto_contenido'] ).'" width="600" />';
									} ?>
								</div>
								<div class="contPost">
									<a href="profile.php" class="usr"><?= $misdatos['nombreusuario'];?></a>
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
																	$res1 = $conMeGusta->quitarLike($usuario, $publi['id']);
																	$likesArray[$count] = $conMeGusta->contarLikes($publi['id']);
																	$megusta[$count] = $conMeGusta->dioLike($usuario, $publi['id']);
																} else {
																	$esLike = "";
																	$res1 = $conMeGusta->darLike($usuario, $publi['id']);
																	$likesArray[$count] = $conMeGusta->contarLikes($publi['id']);
																	$megusta[$count] = $conMeGusta->dioLike($usuario, $publi['id']);
																}
															}

															if(isset($_POST['eliminar'.$count])) {				
																$res = $conMensaje->eliminarPubli($publi['id']);	
															}
											 ?>
									 </div>
														<div style="display:flex">						
										<form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
											<button type="submit" class="likeBtn" name='like<?= $count?>' class="likeBtn">
											<i class="fa fa-heart<?= $esLike;?>" onclick=like(this)><?= " ".$likesArray[$count];?></i>
											</button>
										</form>
									
										
									
										<form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
											<!-- <?= $publi['id'] ?> -->
											<button type="submit" class="btn " name='eliminar<?= $count?>'>
											Eliminar
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
							<div class="alerta"> No se encontraron mensajes en tu muro.</div>
							<?php endif; ?>	
					</div>				
				</div>
			</div>
	
  		</section>
	</body>
</html>