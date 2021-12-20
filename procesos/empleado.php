<?php 
session_start();
$usersesion = $_SESSION['usuario'];
if($usersesion == null || $usersesion == ''){
		header("Location:../index.php");
		die();
	}
include "conexion.php";


//Registrar empleado
if (isset($_POST['registrar'])) {
	$nombre = $_POST['nombre'];
	$puesto = $_POST['puesto'];
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {
			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
			try {
				$sql = 'INSERT INTO Empleados
					SET Nombre="'.$nombre.'", Puesto="'.$puesto.'", Foto="'.$dato.'"';
				$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$res = $mbd->prepare($sql);
				$res->execute();
				echo $res->rowCount()." Datos actualizados correctamente";
				$_SESSION['error']='<div class="exito">Registro exitoso</div>';
				header("Location:../empleados.php");
				} catch (Exception $e) {
					echo $sql ."<br>".$e->getMessage();	
				}
		}else{
		$_SESSION['error']='<div class="error">Error, el tipo de archivo no es valido, solo se pueden subir imagenes en formato jpg, jpeg, o png</div>';
		header("Location:../empleados.php");
	}
	}else{
	$_SESSION['error']='<div class="error">Error, el archivo es demasiado grande, debe ser menor a 1 mb</div>';
		header("Location:../empleados.php");
		}
}
//Termina regitrar empleado

//Actualizar empleado 
if (isset($_POST['actualizarEmpleado'])) {
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$puesto = $_POST['puesto'];
	$imagen = $_FILES['imagen']['name'];
	if ($imagen!=null) {
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {

			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
		
			$sql = 'UPDATE Empleados
		SET Nombre="'.$nombre.'", Puesto="'.$puesto.'", Foto="'.$dato.'" WHERE idEmpleado='.$id.'';
				
			}else{
		$_SESSION['error']='<div class="error">Error, tipo de archivo no valido</div>';
		header("Location:../empleados.php");
		die();
	}}else{
		$_SESSION['error']='<div class="error">Error, archivo demasiado grande</div>';
		header("Location:../empleados.php");
		die();
		}

	}else{
		$sql = 'UPDATE Empleados
		SET Nombre="'.$nombre.'", Puesto="'.$puesto.'" WHERE idEmpleado='.$id.'';
		header("Location:../empleados.php");
	}
	try {

		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Actualizacion exitosa</div>';
		header("Location:../empleados.php");
		} catch (Exception $e) {
			echo $sql ."<br>".$e->getMessage();
			$_SESSION['error']='<div class="error">Error al actualizar</div>'.$e;	
		}
	}
//Termina actualizar empleado 


//Eliminar empleado 
if ($_GET['accion']=='eliminar') {
	$id = $_GET['id'];
	try {
		$sql = 'DELETE FROM Empleados WHERE idEmpleado='.$id.'';

		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="error">Empleado eliminado</div>';
		header("Location:../empleados.php?exitoso");
		} catch (Exception $e) {
			echo $sql ."<br>".$e->getMessage();	
		}
	}
//Termina eliminar empleado 


//Identificar empleado a actualizar 
if ($_GET['accion']=='actualizar') {
	$id = $_GET['id'];
	$_SESSION['actualizar_empleado']=$id;
	header("Location:../empleados.php");
}
//Identificar empleado a actualizar 
