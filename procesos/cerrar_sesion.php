<?php 
session_start();
$usersesion = $_SESSION['usuario'];
if($usersesion == null || $usersesion == ''){
		header("Location:../index.php");
		die();
	}else {
		session_destroy();
		header("Location:../index.php");	
	}
 ?>
