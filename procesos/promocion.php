<?php 
session_start();
$usersesion = $_SESSION['usuario'];
if($usersesion == null || $usersesion == ''){
		header("Location:../index.php");
		die();
	}
include "conexion.php";



//Registrar promocion
if (isset($_POST['registrar'])) {
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {
			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
			try {
				$sql = 'INSERT INTO Promociones
					SET Nombre="'.$nombre.'", Descripcion="'.$descripcion.'", Img="'.$dato.'"';
				$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$res = $mbd->prepare($sql);
				$res->execute();
				echo $res->rowCount()." Datos actualizados correctamente";
				$_SESSION['error']='<div class="exito">Registro exitoso</div>';
				header("Location:../promociones.php");
				} catch (Exception $e) {
					echo "<br>".$e->getMessage();	
				}
		}else{
		$_SESSION['error']='<div class="error">Error, el tipo de archivo no es valido, solo se pueden subir imagenes en formato jpg, jpeg, o png</div>';
		header("Location:../promociones.php");
	}
	}else{
	$_SESSION['error']='<div class="error">Error, el archivo es demasiado grande, debe ser menor a 1 mb</div>';
		header("Location:../promociones.php");
		}
}
//Termina regitrar promocion


//Identificar promocion a actualizar 
if ($_GET['accion']=='actualizar') {
	$id = $_GET['id'];
	$_SESSION['actualizar_promocion']=$id;
	header("Location:../promociones.php");
}
//Identificar promocion a actualizar 


//Actualizar promocion 
if (isset($_POST['actualizarPromocion'])) {
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$imagen = $_FILES['imagen']['name'];
	if ($imagen!=null) {
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {

			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
			$sql = 'UPDATE Promociones SET Nombre="'.$nombre.'", Descripcion="'.$descripcion.'", Img="'.$dato.'" WHERE idPromocion='.$id.'';	
			}else{
		$_SESSION['error']='<div class="error">Error, tipo de archivo no valido</div>';
		header("Location:../promociones.php");
		die();
			}
	}else{
		$_SESSION['error']='<div class="error">Error, archivo demasiado grande</div>';
		header("Location:../promociones.php");
		die();
		}

	}else{
		$sql = 'UPDATE Promociones
		SET Nombre="'.$nombre.'", Descripcion="'.$descripcion.'" WHERE idPromocion='.$id.'';
	}
	
	try {
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Actualizacion exitosa</div>';
		header("Location:../promociones.php");
		} catch (Exception $e) {
			echo "<br>".$e->getMessage();
			$_SESSION['error']='<div class="error">Error al actualizar</div>'.$e;	
			header("Location:../promociones.php");
		}
	}
//Termina actualizar promocion 

//Eliminar promocion 
if ($_GET['accion']=='eliminar') {
	$id = $_GET['id'];
	try {
		$sql = 'DELETE FROM Promociones WHERE idPromocion='.$id.'';
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="error">Promoción eliminada</div>';
		header("Location:../promociones.php");
		} catch (Exception $e) {
			echo $sql ."<br>".$e->getMessage();
			$_SESSION['error']='<div class="error">Error, '.$e.'</div>';
		header("Location:../promociones.php");	
		}
	}
//Termina eliminar promocion 
