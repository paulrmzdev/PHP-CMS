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
	?> 
	<main>
	<div class="contenedor">
		<?php if (isset($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			} ?>
		<h1>Información de Contacto</h1>
		<section class="contenedor_2columnas">
		<?$res='';
		foreach($mbd->query('SELECT * from Contacto') as $res){}
		if (!($res==null || $res == '')) {
				//Actualizar contacto
				echo '<form enctype="multipart/form-data" action="procesos/actualizar.php" id="formulario_actualizar" method="post">
			<h2>Actualizar infotmación de contacto</h2>
			<h3>Horarios</h3>
			<textarea rows="10" cols="50" required name="horarios" placeholder="Insertar horarios">'.$res[1].'</textarea></br>
			<h3>Teléfono</h3>
			<input type="text" name="telefono" required placeholder="Insertar número de teléfono" value="'.$res[2].'">
			<h3>Correo electrónico</h3>
			<input type="text" name="correo" required placeholder="Insertar correo electronico" value="'.$res[3].'">
			<h3>URL de Facebook</h3>
			<input type="text" name="facebook" required placeholder="URL de Facebook" value="'.$res[4].'">
			<h3>URL de Instagram</h3>
			<input type="text" name="instagram" required placeholder="URL de Instagram" value="'.$res[5].'">
			<h3>Domicilio</h3>
			<input type="text" name="domicilio" required placeholder="Domicilio" value="'.$res[6].'">
			<input type="submit" value="Actualizar" name="actualizar_contacto" class="boton">
		</form>';
		}else{
			//Registrar contacto 
			echo '<form enctype="multipart/form-data" action="procesos/actualizar.php" method="post">
			<h2>Información de contacto</h2>
			<h3>Horarios</h3>
			<textarea rows="10" cols="50" required name="horarios" placeholder="Insertar horarios"></textarea></br>
			<h3>Teléfono</h3>
			<input type="text" name="telefono" required placeholder="Insertar número de teléfono" value="">
			<h3>Correo electrónico</h3>
			<input type="text" name="correo" required placeholder="Insertar correo electronico" value="">
			<h3>URL de Facebook</h3>
			<input type="text" name="facebook" required placeholder="URL de Facebook" value="">
			<h3>URL de Instagram</h3>
			<input type="text" name="instagram" required placeholder="URL de Instagram" value="">
			<h3>Domicilio</h3>
			<input type="text" name="domicilio" required placeholder="Domicilio" value="">
			<input type="submit" value="Registrar" name="registrarC" class="boton">
		</form>';
		}  ?>	
		<script>
			var boton = document.getElementById("formulario_actualizar");
			boton.addEventListener("submit",confirmarA, false);

			function confirmarA(e){
				var confirmacion = confirm("En verdad desea actualizar la información de contacto?");
				if (!confirmacion) {
					e.preventDefault();
				}
			}
		</script>
	</section>
	</div>
	</main>

	<?php //include "includes/footer.php"; ?>
	</body>
</html>