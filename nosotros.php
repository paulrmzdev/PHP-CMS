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
		$res = null;
		foreach($mbd->query('SELECT * from Nosotros') as $res){
	}
	?> 
	<main>
		<div class="contenedor">
			<?php if (isset($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);
				} ?>
			<h1>Nosotros</h1>
			<section class="contenedor_2columnas">
			<?php  
				if ($res==null || $res == '') { 
					//Registrar
					echo '
					<form enctype="multipart/form-data" action="procesos/actualizar.php" method="POST">
					<h3>Logo</h3>
					<input type="file" name="logo" required accept=".jpg,.jpeg,.png"></br>
					<h3>Información de la empresa</h3>
					<textarea rows="10" cols="50" name="texto" required placeholder="Informacion de la empresa"></textarea></br>
					<h3>Foto de la empresa</h3>
					<input type="file" name="empresa" required accept=".jpg,.jpeg,.png"></br>
					<input type="submit" value="Actualizar" name="registrarN" class="boton">
					</form>';
				}else {
					//Actualizar
					echo '
					<form id="formulario_actualizar" enctype="multipart/form-data" action="procesos/actualizar.php" method="post">
					<h3>Información de la empresa</h3>
					<textarea rows="20" cols="50" name="texto" placeholder="'.$res[2].'">'.$res[2].'</textarea></br>
					<h3>Logo</h3>
					<img src="data:image/png;base64,'.base64_encode($res[1]).'" alt="" class="imagen">
					<input type="file" name="imagen1"  accept=".jpg,.jpeg,.png"></br>
					<h3>Foto de las instalciones</h3>
					<img src="data:image/png;base64,'.base64_encode($res[3]).'" alt="" class="imagen">
					<input type="file" name="imagen2"  accept=".jpg,.jpeg,.png"></br>
					<input type="submit" value="Actualizar datos" name="actualizar_nosotros" class="boton">
					</form>';
				}  
				?>					
		</section>		
	</div>
	</main>
	<script>
		var boton = document.getElementById("formulario_actualizar");
		boton.addEventListener("submit",confirmarA, false);

		function confirmarA(e){
			var confirmacion = confirm("En verdad desea actualizar el este empleado?");
			if (!confirmacion) {
				e.preventDefault();
			}
		}
		</script
	<?php //include "includes/footer.php";

		/*Essence Spa es una empresa fundada el día primero del mes de octubre del año 2018, desde entonces se ha dedicado a ofrecer tratamientos, terapias y sistemas de relajación. La empresa labora de lunes a viernes con horarios de 10:00 am a 2:00 pm y 4:00 pm a 8:00 pm, y sábados de 10:00 am a 3:00 pm en su domicilio Álvaro Obregón #28 colonia Centro, en Autlán de Navarro Jalisco.*/
	 ?>
	</body>
</html>