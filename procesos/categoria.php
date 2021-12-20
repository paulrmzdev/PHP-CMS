<?php 
session_start();
$usersesion = $_SESSION['usuario'];
if($usersesion == null || $usersesion == ''){
		header("Location:../index.php");
		die();
	}
include "conexion.php";


//Registrar categoria
if (isset($_POST['registrar'])) {
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	try {
		$sql = 'INSERT INTO Categorias SET Nombre="'.$nombre.'", Descripcion="'.$descripcion.'"';
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Registro exitoso</div>';
		header("Location:../categorias.php");
	} catch (Exception $e) {
		echo "<br>".$e->getMessage();
		$_SESSION['error']='<div class="exito">Error, no se pudo registrar, '.$e.'</div>';
		header("Location:../categorias.php");	
	}
	
}
//Termina regitrar categoria


//Actualizar categoria 
if (isset($_POST['actualizarCategoria'])) {
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$sql = 'UPDATE Categorias SET Nombre="'.$nombre.'", Descripcion="'.$descripcion.'" WHERE idCategoria='.$id.'';	
	
	try {
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Actualizacion exitosa</div>';
		header("Location:../categorias.php");
		} catch (Exception $e) {
			echo "<br>".$e->getMessage();
			$_SESSION['error']='<div class="error">Error al actualizar</div>'.$e;
			header("Location:../categorias.php");	
		}
	}
//Termina actualizar categoria

//Identificar servicio a actualizar 
if ($_GET['accion']=='actualizar') {
	$id = $_GET['id'];
	$_SESSION['actualizar_categoria']=$id;
	header("Location:../categorias.php");
}
//Identificar servicio a actualizar 

//Eliminar servicio 
if ($_GET['accion']=='eliminar') {
	$id = $_GET['id'];
	try {
		$sql = 'DELETE FROM Categorias WHERE idCategoria='.$id.'';
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="error">Categoría eliminada</div>';
		header("Location:../categorias.php");
		} catch (Exception $e) {
			echo $sql ."<br>".$e->getMessage();
			$_SESSION['error']='<div class="error">Error, '.$e.'</div>';
		header("Location:../categorias.php");	
		}
	}
//Termina eliminar servicio 



