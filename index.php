<?php 
	session_start();
	error_reporting(0);
	$usersesion = '';
	$usersesion = $_SESSION['usuario'];
	if(!($usersesion == null || $usersesion == '')){
		header("Location:inicio.php");
		die();
	}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=1">	
	<?php
	include "includes/estilo.php";
	include "procesos/conexion.php";
	?>
	<title>Essence Spa CMS</title>
</head>
<body>
	<main>
	<section class="login">
		<form action="procesos/login.php" method="POST">
				<h1>Administrador de contenido</h1>
					<input type="text" required placeholder="Nombre de usuario" name="user"> </br>
					<input type="password" required placeholder="Contraseña" name="pass"> </input></br>
				<input type="submit" value="Iniciar Sesión" name="submit" class="boton">
				<?  
		$url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
			if (strpos($url, 'error') == true) {
				echo '<span class="error">Usuario o contraseña incorrectos</span>';		
			}
		?>
				</form>	
				<div class="clear"> </div>
			</div>	
	</section>
	</main>

	<?php //include "includes/footer.php"; ?>
	</body>
</html>