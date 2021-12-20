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
		<h1>Promociones</h1>
		<section class="contenedor_2columnas">
		<?if (isset($_SESSION['actualizar_promocion'])) {
			$id = $_SESSION['actualizar_promocion'];
			unset($_SESSION['actualizar_promocion']);
			foreach($mbd->query('SELECT * from Promociones WHERE idPromocion='.$id.'') as $res){}
				//Actualizar promocion
				echo '<form enctype="multipart/form-data" action="procesos/promocion.php" id="formulario_actualizar" method="post">
			<h2>Actualizar promoción</h2>
			<input type="hidden" name="id" value="'.$res[0].'">
			<input type="text" name="nombre" required placeholder="Nombre de promoción" value="'.$res[1].'">
			<h3>Descripción</h3>
			<textarea rows="10" cols="50" required name="descripcion" placeholder="Insertar descripción">'.$res[2].'</textarea></br>
			<h3>Foto</h3>
			<img src="data:image/png;base64,'.base64_encode($res[3]).'" alt="" class="imagen">
			<input type="file" name="imagen" accept=".jpg,.jpeg,.png">
			<input type="submit" value="Actualizar" name="actualizarPromocion" class="boton">
		</form>';
		}else{
			//Registrar promocion 
			echo '<form enctype="multipart/form-data" action="procesos/promocion.php" method="post">
			<h2>Registrar nueva promoción</h2>
			<input type="text" name="nombre" required placeholder="Nombre de promoción" value="">
			<h3>Descripción</h3>
			<textarea rows="10" cols="50" required name="descripcion" placeholder="Insertar descripción"></textarea></br>
			<h3>Imagen promocional</h3>
			<input type="file" name="imagen" required accept=".jpg,.jpeg,.png">
			<input type="submit" value="Registrar" name="registrar" class="boton">
		</form>';
		}  ?>	
		<script>
			function confirmarE(promocion){
				return confirm("En verdad desea eliminar la promocion "+promocion+"?");
			}

			var boton = document.getElementById("formulario_actualizar");
			boton.addEventListener("submit",confirmarA, false);

			function confirmarA(e){
				var confirmacion = confirm("En verdad desea actualizar el esta promocion?");
				if (!confirmacion) {
					e.preventDefault();
				}
			}
		</script>
		<div>
			<h2>Promociones</h2>
			<table>
				<tr>
					<td><h3>Nombre</h3></td>
					<td><h3>Descripción</h3></td>
					<td><h3>Imagen promocional</h3></td>
					<td><h3>Acción</h3></td>
				</tr>
				<?
				foreach($mbd->query('SELECT * from Promociones') as $res){
								echo '<tr><td><h3>'.$res[1].'</h3></td><td>'.$res[2].'</td><td><img src="data:image/png;base64,'.base64_encode($res[3]).'" alt="" class="imagen"></td><td><label class="boton_actualizar"><a href="procesos/promocion.php?accion=actualizar&id='.$res[0].'">Actualizar</a></label>
							</br></br>
							<label class="boton_eliminar"><a href="procesos/promocion.php?accion=eliminar&id='.$res[0].'" onclick="return confirmarE(\''.$res[1].'\');">Eliminar</a></label></td></tr>';
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