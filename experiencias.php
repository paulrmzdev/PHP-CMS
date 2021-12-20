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
		<h1>Experiencias</h1>
		<section class="contenedor_2columnas">
		<?if (isset($_SESSION['actualizar_experiencia'])) {
			$id = $_SESSION['actualizar_experiencia'];
			unset($_SESSION['actualizar_experiencia']);
			foreach($mbd->query('SELECT * from Experiencias WHERE idExperiencia='.$id.'') as $res){}
				//Actualizar experiencia
				echo '<form enctype="multipart/form-data" action="procesos/experiencia.php" id="formulario_actualizar" method="post">
			<h2>Actualizar experiencia</h2>
			<input type="hidden" name="id" value="'.$res[0].'">
			<h3>Foto de experiencia</h3>
			<img src="data:image/png;base64,'.base64_encode($res[1]).'" alt="" class="experiencia">
			<input type="file" name="imagen" accept=".jpg,.jpeg,.png">
			<label for="servicio">Escoge una servicio:</label>
			<select name="servicio" id="servicio" required>
			<option value="">Seleccione una opción</option>';
			foreach($mbd->query('SELECT * from Servicios') as $res1){
				if ($res[2]==$res1[0]) {
					echo '<option value="'.$res1[0].'" selected>'.$res1[1].'</option>';
				}else{
					echo '<option value="'.$res1[0].'">'.$res1[1].'</option>';
				}
			}
			echo '</select>

			<input type="submit" value="Actualizar" name="actualizarExperiencia" class="boton">
		</form>';
		}else{
			//Registrar experiencia 
			echo '<form enctype="multipart/form-data" action="procesos/experiencia.php" method="post">
			<h2>Registrar nueva experiencia</h2>
			<h3>Foto de experiencia</h3>
			<input type="file" name="imagen" required accept=".jpg,.jpeg,.png">
			<label for="servicio">Escoge una servicio:</label>
			<select name="servicio" id="servicio" required>
			<option value="">Seleccione una opción</option>';
			foreach($mbd->query('SELECT * from Servicios') as $res){
				echo '<option value="'.$res[0].'">'.$res[1].'</option>';
			}
			echo '</select>
			<input type="submit" value="Registrar" name="registrar" class="boton">
		</form>';
		}  ?>	
		<script>
			function confirmarE(){
				return confirm("En verdad desea eliminar la experiencia?");
			}

			var boton = document.getElementById("formulario_actualizar");
			boton.addEventListener("submit",confirmarA, false);

			function confirmarA(e){
				var confirmacion = confirm("En verdad desea actualizar el esta experiencia?");
				if (!confirmacion) {
					e.preventDefault();
				}
			}
		</script>
		<h2>Lista de experiencias</h2>	
		<div class="lista">
			<?
				foreach($mbd->query('SELECT * from Experiencias') as $res){
					echo 
					'<div class="item">
						<img src="data:image/png;base64,'.base64_encode($res[1]).'" alt="" class="imagen">';
						foreach($mbd->query('SELECT * from Servicios WHERE idServicio='.$res[2].'') as $res1){}
					echo '<p>'.$res1[1].'</p>
						<div><label class="boton_actualizar"><a href="procesos/experiencia.php?accion=actualizar&id='.$res[0].'">Actualizar</a></label>
							<label class="boton_eliminar"><a href="procesos/experiencia.php?accion=eliminar&id='.$res[0].'" onclick="return confirmarE();">Eliminar</a></label></div>
					</div>';
		
				}
			?>		
		</div>							
	</section>
	</div>	
	</main>

	<?php //include "includes/footer.php"; ?>
	</body>
</html>