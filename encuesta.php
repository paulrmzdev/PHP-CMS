<?php 
session_start();
$usersesion = $_SESSION['usuario'];
if($usersesion == null || $usersesion == ''){
		header("Location:index.php");
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
	?>
	<title>Essence Spa CMS</title>
</head>
<body>
	<?php
		include "procesos/conexion.php";
		include "includes/header.php";
		foreach($mbd->query('SELECT * from Inicio') as $res){
	}
	?> 
	<main>
	<div class="contenedor">
		<h1>Encuesta</h1>
		<form action="#" method="get">
					<h3>Pregunta</h3>	
					<input type="text" id="a" name=""></br>
					<h3>Respuesta 1</h3>
					<input type="text" id="d" name=""></input></br>
					<h3>Respuesta 2</h3>
					<input type="text" id="c" name=""></input></br>
					<h3>Respuesta 3</h3>
					<input type="text" id="d" name=""></input></br>
					<h3>Respuesta 4</h3>
					<input type="text" id="c" name=""></input></br>
			
				<input type="submit" value="ENVIAR" class="boton">
				</form>	
	</div>
	</main>

	<?php //include "includes/footer.php"; ?>
	</body>
</html>