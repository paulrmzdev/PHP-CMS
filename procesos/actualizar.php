<?php 
session_start();
$usersesion = $_SESSION['usuario'];
if($usersesion == null || $usersesion == ''){
		header("Location:../index.php");
		die();
	}
include "conexion.php";

//Registrar inicio
if (isset($_POST['registrarI'])) {
	$titulo = $_POST['titulo'];
	$subtitulo = $_POST['subtitulo'];
	$texto = $_POST['texto'];
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {
			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
			try {
				$sql = 'INSERT INTO Inicio
					SET Titulo="'.$titulo.'", Portada="'.$dato.'", Subtitulo="'.$subtitulo.'", TextoPrincipal="'.$texto.'"';
				$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$res = $mbd->prepare($sql);
				$res->execute();
				echo $res->rowCount()." Datos actualizados correctamente";
				$_SESSION['error']='<div class="exito">Registro exitoso</div>';
				header("Location:../inicio.php");
				} catch (Exception $e) {
					echo "<br>".$e->getMessage();
					$_SESSION['error']='<div class="error">Error al registrar</div>';
				header("Location:../inicio.php");	
				}
		}else{
			$_SESSION['error']='<div class="error">Error, el tipo de archivo no es valido, solo se pueden subir imagenes en formato jpg, jpeg, o png</div>';
				header("Location:../inicio.php");
	}
	}else{
		$_SESSION['error']='<div class="error">Error, el archivo es demasiado grande, debe ser menor a 1 mb</div>';
				header("Location:../inicio.php");
		}
}
//Termina regitrar inicio

//Actualizar datos inicio
if (isset($_POST['actualizar_inicio'])) {
	$titulo = $_POST['titulo'];
	$subtitulo = $_POST['subtitulo'];
	$texto = $_POST['texto'];
	$imagen = $_FILES['imagen']['name'];
	if ($imagen!=null) {
	$tipo_archivo = $_FILES['imagen']['type'];
	$size = $_FILES['imagen']['size'];
	if ($size<=1000000) {
		if ($tipo_archivo=="image/jpg" || $tipo_archivo=="image/jpeg" || $tipo_archivo=="image/png") {

			$ruta = $_FILES['imagen']['tmp_name'];
			$dato = file_get_contents($ruta);
			$dato = addslashes($dato);
		
			$sql = 'UPDATE Inicio
		SET Titulo="'.$titulo.'", Portada="'.$dato.'", Subtitulo="'.$subtitulo.'", TextoPrincipal="'.$texto.'" WHERE idInicio=1';	
			}else{
		$_SESSION['error']='<div class="error">Error, tipo de archivo no valido</div>';
		header("Location:../inicio.php");
		die();
	}}else{
		$_SESSION['error']='<div class="error">Error, archivo demasiado grande</div>';
		header("Location:../inicio.php");
		die();
		}

	}else{
		$sql = 'UPDATE Inicio
		SET Titulo="'.$titulo.'", Subtitulo="'.$subtitulo.'", TextoPrincipal="'.$texto.'" WHERE idInicio=1';
	}
	try {

		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Actualizacion exitosa</div>';
		header("Location:../inicio.php");
		} catch (Exception $e) {
			echo "<br>".$e->getMessage();	
			$_SESSION['error']='<div class="error">Error al actualizar</div>';
			header("Location:../inicio.php");
		}
	}
//Termina Actualizar datos inicio


//Registrar nosotros
if (isset($_POST['registrarN'])) {
	$logo_tipo = $_FILES['logo']['type'];
	$logo_size = $_FILES['logo']['size'];
	$texto = $_POST['texto'];
	$foto_tipo = $_FILES['empresa']['type'];
	$foto_size = $_FILES['empresa']['size'];
	if ($logo_size<=1000000 && $foto_size<=1000000) {
		if ($logo_tipo=="image/jpg" || $logo_tipo=="image/jpeg" || $logo_tipo=="image/png" && $foto_tipo=="image/jpg" || $foto_tipo=="image/jpeg" || $foto_tipo=="image/png") {
			$logo_dato = file_get_contents($_FILES['logo']['tmp_name']);
			$logo_dato = addslashes($logo_dato);
			$foto_dato = file_get_contents($_FILES['empresa']['tmp_name']);
			$foto_dato = addslashes($foto_dato);
			try {
				$sql = 'INSERT INTO Nosotros
					SET Logo="'.$logo_dato.'", InfoEmpresa="'.$texto.'", FotoSpa="'.$foto_dato.'"';
				$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$res = $mbd->prepare($sql);
				$res->execute();
				echo $res->rowCount()." Datos Registrados correctamente";
				$_SESSION['error']='<div class="exito">Registro exitoso</div>';
				header("Location:../nosotros.php");
				} catch (Exception $e) {
					echo "<br>".$e->getMessage();
					$_SESSION['error']='<div class="error">Error al registrar</div>';
				header("Location:../nosotros.php");
				}
		}else{
		$_SESSION['error']='<div class="error">Error, el tipo de archivo no es valido, solo se pueden subir imagenes en formato jpg, jpeg, o png</div>';
				header("Location:../nosotros.php");
			}
	}else{
		$_SESSION['error']='<div class="error">Error, el archivo es demasiado grande, debe ser menor a 1 mb</div>';
		header("Location:../nosotros.php");
		}
}
//Termina regitrar nosotros

//Actualizar datos nosotros
if (isset($_POST['actualizar_nosotros'])) {
	$texto = $_POST['texto'];
	$imagen1 = $_FILES['imagen1']['name'];
	$imagen2 = $_FILES['imagen2']['name'];

	if ($imagen1!=null) {
		if ($imagen2!=null) {
			echo "Se seleccionaron 2 imagenes";
			$tipo_archivo1 = $_FILES['imagen1']['type'];
			$size1 = $_FILES['imagen1']['size'];
			$tipo_archivo2 = $_FILES['imagen2']['type'];
			$size2 = $_FILES['imagen2']['size'];

			if ($size1<=1000000 && $size2<=1000000) {
				if (($tipo_archivo1=="image/jpg" || $tipo_archivo1=="image/jpeg" || $tipo_archivo1=="image/png") && ($tipo_archivo2=="image/jpg" || $tipo_archivo2=="image/jpeg" || $tipo_archivo2=="image/png")) {

					$ruta1 = $_FILES['imagen1']['tmp_name'];
					$dato1 = file_get_contents($ruta1);
					$dato1 = addslashes($dato1);
					$ruta2 = $_FILES['imagen2']['tmp_name'];
					$dato2 = file_get_contents($ruta2);
					$dato2 = addslashes($dato2);
					

					$sql = 'UPDATE Nosotros
				SET Logo="'.$dato1.'", InfoEmpresa="'.$texto.'", FotoSpa="'.$dato2.'" WHERE idNosotros=1';
				}else{
					$_SESSION['error']='<div class="error">Error, tipo de archivo no valido</div>';
					header("Location:../nosotros.php");
					die();
				}
			}else{
				$_SESSION['error']='<div class="error">Error, archivo demasiado grande</div>';
				header("Location:../nosotros.php");
				die();
				}

		}else{
			echo "Se seleccionó solo la imagen1";

			$tipo_archivo1 = $_FILES['imagen1']['type'];
			$size1 = $_FILES['imagen1']['size'];
			
			if ($size1<=1000000) {
				if ($tipo_archivo1=="image/jpg" || $tipo_archivo1=="image/jpeg" || $tipo_archivo1=="image/png") {

					$ruta1 = $_FILES['imagen1']['tmp_name'];
					$dato1 = file_get_contents($ruta1);
					$dato1 = addslashes($dato1);

					$sql = 'UPDATE Nosotros
				SET Logo="'.$dato1.'", InfoEmpresa="'.$texto.'" WHERE idNosotros=1';
				}else{
					$_SESSION['error']='<div class="error">Error, tipo de archivo no valido</div>';
					header("Location:../nosotros.php");
					die();
			}
		}else{
				$_SESSION['error']='<div class="error">Error, archivo demasiado grande</div>';
				header("Location:../nosotros.php");
				die();
				}
		}
	}else{
		if ($imagen2!=null) {

			$tipo_archivo2 = $_FILES['imagen2']['type'];
			$size2 = $_FILES['imagen2']['size'];
			
			if ($size2<=1000000) {
				if ($tipo_archivo2=="image/jpg" || $tipo_archivo2=="image/jpeg" || $tipo_archivo2=="image/png") {

					$ruta2 = $_FILES['imagen2']['tmp_name'];
					$dato2 = file_get_contents($ruta2);
					$dato2 = addslashes($dato2);

					$sql = 'UPDATE Nosotros
				SET InfoEmpresa="'.$texto.'", FotoSpa="'.$dato2.'" WHERE idNosotros=1';
				}else{
					$_SESSION['error']='<div class="error">Error, tipo de archivo no valido</div>';
					header("Location:../nosotros.php");
					die();
			}
		}else{
				$_SESSION['error']='<div class="error">Error, archivo demasiado grande</div>';
				header("Location:../nosotros.php");
				die();
				}

		}else{
			$sql = 'UPDATE Nosotros
				SET InfoEmpresa="'.$texto.'" WHERE idNosotros=1';
		}
	}
	try {
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Datos actualizados correctamente</div>';
		header("Location:../nosotros.php");
		} catch (Exception $e) {
			echo "<br>".$e->getMessage();	
			$_SESSION['error']='<div class="error">Error al actualizar</div>';
		header("Location:../nosotros.php");
		}
	}
//Termina Actualizar datos nosotros


//Registrar contacto
if (isset($_POST['registrarC'])) {
	$horarios = $_POST['horarios'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$facebook = $_POST['facebook'];
	$instagram = $_POST['instagram'];
	$domicilio = $_POST['domicilio'];
	try {
		$sql = 'INSERT INTO Contacto SET Horarios="'.$horarios.'", Telefono="'.$telefono.'", Correo="'.$correo.'", Facebook="'.$facebook.'", Instagram="'.$instagram.'", Domicilio="'.$domicilio.'"';
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Registro exitoso</div>';
		header("Location:../contacto.php");
	} catch (Exception $e) {
		echo "<br>".$e->getMessage();
		$_SESSION['error']='<div class="error">Error al registrar</div>';
		header("Location:../contacto.php");
		}
}
//Termina regitrar contacto

//Actualizar datos contacto
if (isset($_POST['actualizar_contacto'])) {
	$horarios = $_POST['horarios'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$facebook = $_POST['facebook'];
	$instagram = $_POST['instagram'];
	$domicilio = $_POST['domicilio'];
	$sql = 'UPDATE Contacto SET Horarios="'.$horarios.'", Telefono="'.$telefono.'", Correo="'.$correo.'", Facebook="'.$facebook.'", Instagram="'.$instagram.'", Domicilio="'.$domicilio.'" WHERE idContacto=1';
	try {
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$res = $mbd->prepare($sql);
		$res->execute();
		echo $res->rowCount()." Datos actualizados correctamente";
		$_SESSION['error']='<div class="exito">Actualizacion exitosa</div>';
		header("Location:../contacto.php");
		} catch (Exception $e) {
			echo "<br>".$e->getMessage();	
			$_SESSION['error']='<div class="error">Error al actualizar</div>';
		}
	}
//Termina Actualizar datos contecto








/*
Lunes a viernes de 10:00 am a 2:00 pm y 4:00 pm a 8:00 pm.
Sábados de 10:00 am a 3:00 pm

317-3815474

laadiroruee@gmail.com

https://www.facebook.com/Essence-Spa-2218470755089386

https://www.instagram.com/spaess.ence/

Álvaro Obregón #28 colonia Centro, Autlán de Navarro Jalisco


*/