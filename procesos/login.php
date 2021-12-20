<?php 
session_start();

$user = $_POST['user'];
$pass = $_POST['pass'];
$pass = sha1($pass);


include "conexion.php";
		foreach($mbd->query('SELECT * from Usuarios where Usuario = "'.$user.'"') as $res){
	}

if (count($res)<1) {
	echo "Usuario o contraseña incorrectos";
	header("Location:../index.php?error");
}else{
	if ($res[2]==$pass) {
		$_SESSION['usuario']=$user;
		$_SESSION['tipo_usuario']=$res[3];
	header("Location:../inicio.php");	
	} else {
	session_destroy();
	header("Location:../index.php?error");
}

}
$mbd=null;
?>