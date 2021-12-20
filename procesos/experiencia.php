<?php 
session_start();
$usersesion = $_SESSION['usuario'];
if($usersesion == null || $usersesion == ''){
		header("Location:../index.php");
		die();
	}
include "conexion.php";


//Registrar experiencia
if (isset($_POST['registrar'])) {
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	$servicio = $_POST['servicio'];
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {
			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
			try {
				$sql = 'INSERT INTO Experiencias
					SET Resultado="'.$dato.'", CodServicio="'.$servicio.'"';
				$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$res = $mbd->prepare($sql);
				$res->execute();
				echo $res->rowCount()." Datos actualizados correctamente";
				$_SESSION['error']='<div class="exito">Registro exitoso</div>';
				header("Location:../experiencias.php");
				} catch (Exception $e) {
					echo "<br>".$e->getMessage();	
					$_SESSION['error']='<div class="error">Error al registrar</div>';
		header("Location:../experiencias.php");
				}
		}else{
		$_SESSION['error']='<div class="error">Error, el tipo de archivo no es valido, solo se pueden subir imagenes en formato jpg, jpeg, o png</div>';
		header("Location:../experiencias.php");
	}
	}else{
	$_SESSION['error']='<div class="error">Error, el archivo es demasiado grande, debe ser menor a 1 mb</div>';
		header("Location:../experiencias.php");
		}
}
//Termina regitrar experiencia

//Actualizar experiencia 
if (isset($_POST['actualizarExperiencia'])) {
	$id = $_POST['id'];
	$imagen = $_FILES['imagen']['name'];
	$servicio = $_POST['servicio'];
	if ($imagen!=null) {
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {

			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
		
			$sql = 'UPDATE Experiencias
		SET Resultado="'.$dato.'", CodServicio="'.$servicio.'" WHERE idExperiencia='.$id.'';
			}else{
		$_SESSION['error']='<div class="error">Error, tipo de archivo no valido</div>';
		header("Location:../experiencias.php");
		die();
	}}else{
		$_SESSION['error']='<div class="error">Error, archivo demasiado grande</div>';
		header("Location:../experiencias.php");
		die();
		}

	}else{
		$sql = 'UPDATE Experiencias
		SET CodServicio="'.$servicio.'" WHERE idExperiencia='.$id.'';
		header("Location:../experiencias.php");
	}
	try {

		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Actualizacion exitosa</div>';
		header("Location:../experiencias.php");
		} catch (Exception $e) {
			echo $sql ."<br>".$e->getMessage();
			$_SESSION['error']='<div class="error">Error al actualizar</div>'.$e;	
			header("Location:../experiencias.php");
		}
	}
//Termina actualizar experiencia 


//Eliminar experiencia 
if ($_GET['accion']=='eliminar') {
	$id = $_GET['id'];
	try {
		$sql = 'DELETE FROM Experiencias WHERE idExperiencia='.$id.'';

		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="error">Experiencia eliminada</div>';
		header("Location:../experiencias.php");
		} catch (Exception $e) {
			echo "<br>".$e->getMessage();	
			$_SESSION['error']='<div class="error">Error al eliminar</div>';
		header("Location:../experiencias.php");

		}
	}
//Termina eliminar experiencia 


//Identificar experiencia a actualizar 
if ($_GET['accion']=='actualizar') {
	$id = $_GET['id'];
	$_SESSION['actualizar_experiencia']=$id;
	header("Location:../experiencias.php");
}
//Identificar experiencia a actualizar 
