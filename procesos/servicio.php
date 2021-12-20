<?php 
session_start();
$usersesion = $_SESSION['usuario'];
if($usersesion == null || $usersesion == ''){
		header("Location:../index.php");
		die();
	}
include "conexion.php";


//Registrar servicio
if (isset($_POST['registrar'])) {
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	$duracion = $_POST['duracion'];
	$categoria = $_POST['categoria'];
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {
			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
			try {
				$sql = 'INSERT INTO Servicios
					SET Nombre="'.$nombre.'", Descripcion="'.$descripcion.'", Img="'.$dato.'", Duracion="'.$duracion.'", Categoria="'.$categoria.'"';
				$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$res = $mbd->prepare($sql);
				$res->execute();
				echo $res->rowCount()." Datos actualizados correctamente";
				$_SESSION['error']='<div class="exito">Registro exitoso</div>';
				header("Location:../servicios.php");
				} catch (Exception $e) {
					echo "<br>".$e->getMessage();	
				}
		}else{
		$_SESSION['error']='<div class="error">Error, el tipo de archivo no es valido, solo se pueden subir imagenes en formato jpg, jpeg, o png</div>';
		header("Location:../servicios.php");
	}
	}else{
	$_SESSION['error']='<div class="error">Error, el archivo es demasiado grande, debe ser menor a 1 mb</div>';
		header("Location:../servicios.php");
		}
}
//Termina regitrar servicio

//Actualizar servicio 
if (isset($_POST['actualizarServicio'])) {
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$imagen = $_FILES['imagen']['name'];
	$duracion = $_POST['duracion'];
	$categoria = $_POST['categoria'];
	
	if ($imagen!=null) {
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {

			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
			$sql = 'UPDATE Servicios SET Nombre="'.$nombre.'", Descripcion="'.$descripcion.'", Img="'.$dato.'", Duracion="'.$duracion.'", Categoria="'.$categoria.'" WHERE idServicio='.$id.'';	
			}else{
		$_SESSION['error']='<div class="error">Error, tipo de archivo no valido</div>';
		header("Location:../servicios.php");
		die();
			}
	}else{
		$_SESSION['error']='<div class="error">Error, archivo demasiado grande</div>';
		header("Location:../servicios.php");
		die();
		}

	}else{
		$sql = 'UPDATE Servicios
		SET Nombre="'.$nombre.'", Descripcion="'.$descripcion.'", Duracion="'.$duracion.'", Categoria="'.$categoria.'" WHERE idServicio='.$id.'';
	}
	
	try {
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Actualizacion exitosa</div>';
		header("Location:../servicios.php");
		} catch (Exception $e) {
			echo "<br>".$e->getMessage();
			$_SESSION['error']='<div class="error">Error al actualizar</div>'.$e;	
		}
	}
//Termina actualizar servicio 


//Eliminar servicio 
if ($_GET['accion']=='eliminar') {
	$id = $_GET['id'];
	try {
		$sql = 'DELETE FROM Servicios WHERE idServicio='.$id.'';
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="error">Servicio eliminado</div>';
		header("Location:../servicios.php");
		} catch (Exception $e) {
			echo $sql ."<br>".$e->getMessage();
			$_SESSION['error']='<div class="error">Error, '.$e.'</div>';
		header("Location:../servicios.php");	
		}
	}
//Termina eliminar servicio 


//Identificar servicio a actualizar 
if ($_GET['accion']=='actualizar') {
	$id = $_GET['id'];
	$_SESSION['actualizar_servicio']=$id;
	header("Location:../servicios.php");
}
//Identificar servicio a actualizar 
