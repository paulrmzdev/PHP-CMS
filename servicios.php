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
		<h1>Servicios</h1>
		<section class="contenedor_2columnas">
		<?if (isset($_SESSION['actualizar_servicio'])) {
			$id = $_SESSION['actualizar_servicio'];
			unset($_SESSION['actualizar_servicio']);
			foreach($mbd->query('SELECT * from Servicios WHERE idServicio='.$id.'') as $res){}
				//Actualizar servicio
				echo '<form enctype="multipart/form-data" action="procesos/servicio.php" id="formulario_actualizar" method="post">
			<h2>Actualizar servicio</h2>
			<input type="hidden" name="id" value="'.$res[0].'">
			<input type="text" name="nombre" required placeholder="Nombre de servicio" value="'.$res[1].'">
			<h3>Descripción</h3>
			<textarea rows="10" cols="50" required name="descripcion" placeholder="Insertar descripción">'.$res[2].'</textarea></br>
			<h3>Foto</h3>
			<img src="data:image/png;base64,'.base64_encode($res[3]).'" alt="" class="imagen">
			<input type="file" name="imagen" accept=".jpg,.jpeg,.png">
			<input type="text" placeholder="Duración" required value="'.$res[4].'" name="duracion">
			<label for="categoria">Escoge una categoria:</label>
			<select name="categoria" id="categoria" required>
			<option value="">Seleccione una opción</option>';
			foreach($mbd->query('SELECT * from Categorias') as $res1){
				if ($res[5]==$res1[0]) {
					echo '<option value="'.$res1[0].'" selected>'.$res1[1].'</option>';
				}else{
					echo '<option value="'.$res1[0].'">'.$res1[1].'</option>';
				}
			}
			echo '</select>
			<input type="submit" value="Actualizar" name="actualizarServicio" class="boton">
		</form>';
		}else{
			//Registrar servicio 
			echo '
			<form enctype="multipart/form-data" action="procesos/servicio.php" method="post">
			<h2>Registrar nuevo servicio</h2>
			<input type="text" name="nombre" required placeholder="Nombre del servicio" value="">
			<h3>Descripción</h3>
			<textarea rows="10" cols="50" required name="descripcion" placeholder="Insertar descripción"></textarea></br>
			<h3>Foto</h3>
			<input type="file" name="imagen" required accept=".jpg,.jpeg,.png">
			<input type="text" name="duracion" required placeholder="Duración" value="">
			<label for="categoria">Escoge una categoria:</label>
			<select name="categoria" id="categoria" required>
			<option value="">Seleccione una opción</option>';
			foreach($mbd->query('SELECT * from Categorias') as $res){
				echo '<option value="'.$res[0].'">'.$res[1].'</option>';
			}
			echo '</select>
			<input type="submit" value="Registrar" name="registrar" class="boton">
		</form>';
		}  ?>	

		<script>
			function confirmarE(servicio){
				return confirm("En verdad desea eliminar el servicio "+servicio+"?");
			}

			var boton = document.getElementById("formulario_actualizar");
			boton.addEventListener("submit",confirmarA, false);

			function confirmarA(e){
				var confirmacion = confirm("En verdad desea actualizar el este servicio?");
				if (!confirmacion) {
					e.preventDefault();
				}
			}
		</script>
		<div>
		<h2>Servicios</h2>
		<table>
			<tr>
				<td><h3>Nombre</h3></td>
				<td><h3>Descripcion</h3></td>
				<td><h3>Foto</h3></td>
				<td><h3>Duración</h3></td>
				<td><h3>Categoria</h3></td>
				<td><h3>Acción</h3></td>				
			</tr>
			<?
			foreach($mbd->query('SELECT * from Servicios') as $res){
							echo '<tr>
							<td><h3>'.$res[1].'</h3></td>
							<td><p>'.$res[2].'</p></td>
							<td><img src="data:image/png;base64,'.base64_encode($res[3]).'" alt="" class="imagen"></td>
							<td>'.$res[4].'</td>
							<td>'.$res[5].'</td>
							<td><label class="boton_actualizar"><a href="procesos/servicio.php?accion=actualizar&id='.$res[0].'">Actualizar</a></label>
							</br></br>
							<label class="boton_eliminar"><a href="procesos/servicio.php?accion=eliminar&id='.$res[0].'" onclick="return confirmarE(\''.$res[1].'\');">Eliminar</a></label></td></tr>';
						}
					?>		
					</table>	

	</div>
	</section>
	</div>
	</main>
	<?php //include "includes/footer.php"; ?>
	</body>
</html>