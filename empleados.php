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
		<h1>Empleados</h1>
		<section class="contenedor_2columnas">
		<?if (isset($_SESSION['actualizar_empleado'])) {
			$id = $_SESSION['actualizar_empleado'];
			unset($_SESSION['actualizar_empleado']);
			foreach($mbd->query('SELECT * from Empleados WHERE idEmpleado='.$id.'') as $res){}
				//Actualizar empleado
				echo '<form enctype="multipart/form-data" action="procesos/empleado.php" id="formulario_actualizar" method="post">
			<h2>Actualizar empleado</h2>
			<input type="hidden" name="id" value="'.$res[0].'">
			<input type="text" name="nombre" required placeholder="Nombre de empleado" value="'.$res[1].'">
			<input type="text" placeholder="Puesto" required value="'.$res[2].'" name="puesto"></input>
			<h3>Foto de empleado</h3>
			<img src="data:image/png;base64,'.base64_encode($res[3]).'" alt="" class="empleado">
			<input type="file" name="imagen" accept=".jpg,.jpeg,.png">
			<input type="submit" value="Actualizar" name="actualizarEmpleado" class="boton">
		</form>';
		}else{
			//Registrar empleado 
			echo '<form enctype="multipart/form-data" action="procesos/empleado.php" method="post">
			<h2>Registrar nuevo empleado</h2>
			<input type="text" name="nombre" required placeholder="Nombre de empleado" value="">
			<input type="text" placeholder="Puesto" required value="" name="puesto"></input>
			<h3>Foto de empleado</h3>
			<input type="file" name="imagen" required accept=".jpg,.jpeg,.png">
			<input type="submit" value="Registrar" name="registrar" class="boton">
		</form>';
		}  ?>	
		<script>
			function confirmarE(empleado){
				return confirm("En verdad desea eliminar el empleado "+empleado+"?");
			}

			var boton = document.getElementById("formulario_actualizar");
			boton.addEventListener("submit",confirmarA, false);

			function confirmarA(e){
				var confirmacion = confirm("En verdad desea actualizar el este empleado?");
				if (!confirmacion) {
					e.preventDefault();
				}
			}
		</script>
		<div>
		<h2>Nuestro equipo</h2>
		<table>
			<tr>
				<td><h3>Nombre</h3></td>
				<td><h3>Puesto</h3></td>
				<td><h3>Foto de empleado</h3></td>
				<td><h3>Acción</h3></td>
			</tr>
			<?
				foreach($mbd->query('SELECT * from Empleados') as $res){
					echo 
					'<tr>
						<td><h3>'.$res[1].'</h3></td>
						<td>'.$res[2].'</td>
						<td><img src="data:image/png;base64,'.base64_encode($res[3]).'" alt="" class="empleado"></td>
						<td><label class="boton_actualizar"><a href="procesos/empleado.php?accion=actualizar&id='.$res[0].'">Actualizar</a></label>
							</br></br>
							<label class="boton_eliminar"><a href="procesos/empleado.php?accion=eliminar&id='.$res[0].'" onclick="return confirmarE(\''.$res[1].'\');">Eliminar</a></label></td>
					</tr>';
		
				}
			?>		
		</table>							
	</div>
	</section>
	</div>
	</main>
	<?php //include "includes/footer.php"; 
	?>
	</body>
</html>