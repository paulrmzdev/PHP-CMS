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
		$inicio = null;
		foreach($mbd->query('SELECT * from Inicio') as $inicio){
	}
	?> 
	<main>
	<div class="contenedor">
			<?php if (isset($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);
				} ?>
				<h1>Pagina de inicio</h1>
				<section class="contenedor_2columnas">
				<?php  
				if ($inicio==null || $inicio == '') { 
					echo '
					<form enctype="multipart/form-data" action="procesos/actualizar.php" method="POST">
					<h3>Título</h3>	
					<input type="text" required value="" maxlength="45" name="titulo" placeholder="Insertar titulo"></br>
					<h3>Imagen de portada</h3>
					<h4>Insertar imagen para portada</h4>
					<input type="file" name="imagen" required accept=".jpg,.jpeg,.png"></br>
					<h3>Subtitulo</h3>
					<input type="text" required maxlength="45" value="" name="subtitulo" placeholder="Insertar subtitulo"></input></br>
					<h3>Texto principal</h3>
					<textarea rows="10" cols="50" required name="texto" placeholder="Insertar texto principal"></textarea></br>
					<input type="submit" value="Registrar datos" name="registrarI" class="boton">
					</form>';

				}else {
					//Actualizar
					echo '
					<form id="formulario_actualizar" enctype="multipart/form-data" action="procesos/actualizar.php" method="post">
					<h3>Título</h3>	
					<input type="text" required value="'.$inicio[1].'" maxlength="45" name="titulo" placeholder="'.$inicio[1].'"></br>
					<h3>Subtitulo</h3>
					<input type="text" maxlength="45" required value="'. $inicio[3].'" name="subtitulo" placeholder="'. $inicio[3].'"></input></br>
					<h3>Texto principal</h3>
					<textarea rows="10" cols="50" required name="texto" placeholder="'.$inicio[4].'">'.$inicio[4].'</textarea></br>
					<h3>Imagen de portada</h3>
					<img src="data:image/png;base64,'.base64_encode($inicio[2]).'" alt="" class="imagen">
					<input type="file" name="imagen" accept=".jpg,.jpeg,.png"></br>
					<input type="submit" value="Actualizar imagen" name="actualizar_inicio" class="boton">
					</form>
					</section>';
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
		</script>
	</body>
</html>

<?php /*echo '
					<section class="contenedor_2columnas">
					<form enctype="multipart/form-data" action="procesos/actualizar.php" method="post">
					<h3>Título</h3>	
					<input type="text" required value="'.$inicio[1].'" maxlength="45" name="titulo" placeholder="'.$inicio[1].'"></br>
					<h3>Subtitulo</h3>
					<input type="text" maxlength="45" required value="'. $inicio[3].'" name="subtitulo" placeholder="'. $inicio[3].'"></input></br>
					<h3>Texto principal</h3>
					<textarea rows="10" cols="50" required name="texto" placeholder="'.$inicio[4].'">'.$inicio[4].'</textarea></br>
					<input type="submit" value="Actualizar datos" name="actualizarI" class="boton">
					</form>
					<form enctype="multipart/form-data" action="procesos/actualizar.php" method="post">
						<h3>Imagen de portada</h3>
					<img src="data:image/png;base64,'.base64_encode($inicio[2]).'" alt="" class="imagen">
					<input type="file" name="imagen" required accept=".jpg,.jpeg,.png"></br>
					<input type="submit" value="Actualizar imagen" name="actualizar_imgI" class="boton">
					</form>
					</section>';*/ ?>